<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MentorModel;
use App\Models\PesertaMagang;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PesertaMagangController extends Controller
{
    public function index(Request $request)
    {
        $query = PesertaMagang::where('role', '!=', 'admin')->with('mentor', 'anggota')->latest();

        if (!$request->has('status') || $request->status == 'semua') {
        } else {
            $query->where('status', $request->status);
        }

        // if (!$request->has('status')) {
        //     $query->where('status', 'semua aktif');
        // }

        if ($request->has('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        if (
            $request->filled('tanggal_mulai') &&
            $request->filled('tanggal_selesai')
        ) {
            $tanggalMulai = Carbon::parse($request->tanggal_mulai)->startOfDay();
            $tanggalSelesai = Carbon::parse($request->tanggal_selesai)->endOfDay();

            $query->where(function ($q) use ($tanggalMulai, $tanggalSelesai) {
                $q->where('tanggal_mulai', '<=', $tanggalSelesai)
                    ->where('tanggal_selesai', '>=', $tanggalMulai);
            });
        }

        $pesertas = $query->paginate(10)->appends($request->query());

        return view('halaman_admin.manajemen_peserta_magang.index', compact('pesertas'));
    }

    public function create()
    {
        $mentors = MentorModel::all();
        return view('halaman_admin.manajemen_peserta_magang.create', compact('mentors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required|email|unique:peserta_magang,email',
            'password' => 'required',
            'no_hp' => 'required',
            'asal_sekolah' => 'required',
            'jurusan' => 'required',
            'status' => 'required|in:mengajukan,diterima,diterima_dan_loa_dapat_di_ambil,aktif,selesai,ditolak',
            'catatan' => 'nullable',
            'mentor_id' => 'nullable',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'anggota' => 'nullable|array',
            'anggota.*.nama' => 'required_with:anggota',
            'anggota.*.no_hp' => 'required_with:anggota.*.nama',
        ]);

        try {
            DB::beginTransaction();

            $peserta = PesertaMagang::create([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_hp' => $request->no_hp,
                'asal_sekolah' => $request->asal_sekolah,
                'jurusan' => $request->jurusan,
                'status' => $request->status,
                'catatan' => $request->catatan,
                'mentor_id' => $request->mentor_id,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);

            // Jika ada data anggota, simpan ke tabel anggota
            if ($request->has('nama_anggota') && is_array($request->nama_anggota)) {
                foreach ($request->nama_anggota as $item) {
                    $peserta->anggota()->create([
                        'nama_anggota' => $item['nama_anggota'],
                        'no_hp_anggota' => $item['no_hp_anggota'],
                        'ketua_id' => $peserta->id,
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Data peserta dan anggota berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function edit($id)
    {
        $peserta = PesertaMagang::with('anggota')->findOrFail($id);
        $mentors = MentorModel::all();
        return view('halaman_admin.manajemen_peserta_magang.update', compact('peserta', 'mentors'));
    }

    public function update(Request $request, $id)
    {
        $peserta = PesertaMagang::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required|email|unique:peserta_magang,email,' . $peserta->id,
            'no_hp' => 'required',
            'asal_sekolah' => 'required',
            'jurusan' => 'required',
            'status' => 'required|in:mengajukan,diterima,diterima_dan_loa_dapat_di_ambil,aktif,selesai,ditolak',
            'catatan' => 'nullable',
            'mentor_id' => 'nullable',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'anggota' => 'nullable|array',
            'anggota.*.id' => 'sometimes|exists:anggota,id',
            'anggota.*.nama' => 'required_with:anggota.*.no_hp',
            'anggota.*.no_hp' => 'required_with:anggota.*.nama',
        ]);

        try {
            DB::beginTransaction();

            $peserta->update([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'asal_sekolah' => $request->asal_sekolah,
                'jurusan' => $request->jurusan,
                'status' => $request->status,
                'catatan' => $request->catatan,
                'mentor_id' => $request->mentor_id,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);

            // Jika password diisi, update password
            if ($request->filled('password')) {
                $peserta->update(['password' => Hash::make($request->password)]);
            }

            $existingAnggotaIds = $peserta->anggota->pluck('id')->toArray();
            $submittedAnggotaIds = [];

            if ($request->has('anggota')) {
                foreach ($request->anggota as $item) {
                    if (isset($item['id'])) {

                        $anggota = $peserta->anggota()->find($item['id']);
                        if ($anggota) {
                            $anggota->update([
                                'nama_anggota' => $item['nama_anggota'],
                                'no_hp_anggota' => $item['no_hp_anggota']
                            ]);
                            $submittedAnggotaIds[] = $item['id'];
                        }
                    } else {

                        $peserta->anggota()->create([
                            'nama_anggota' => $item['nama_anggota'],
                            'no_hp_anggota' => $item['no_hp_anggota'],
                            'ketua_id' => $peserta->id
                        ]);
                    }
                }
            }

            $anggotaToDelete = array_diff($existingAnggotaIds, $submittedAnggotaIds);
            if (!empty($anggotaToDelete)) {
                $peserta->anggota()->whereIn('id', $anggotaToDelete)->delete();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Data peserta dan anggota berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function show($id)
    {
        $peserta = PesertaMagang::with(['mentor', 'anggota'])->findOrFail($id);
        return view('halaman_admin.manajemen_peserta_magang.show', compact('peserta'));
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $peserta = PesertaMagang::with(['anggota', 'dokumen'])->findOrFail($id);

            if ($peserta->dokumen) {
                $peserta->dokumen()->delete();
            }

            $peserta->anggota()->delete();

            $peserta->delete();

            DB::commit();

            return redirect()->route('peserta.index')
                ->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:mengajukan,aktif,selesai,ditolak'
        ]);

        $peserta = PesertaMagang::findOrFail($id);
        $peserta->status = $request->status;
        $peserta->save();

        return redirect()->back()->with('success', 'Status peserta berhasil diperbarui.');
    }
}
