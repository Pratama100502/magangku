<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\dokumen;
use App\Models\PesertaMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        $query = PesertaMagang::with('dokumen')
            ->whereIn('status', ['aktif', 'selesai']);

        if (request('nama')) {
            $query->where('nama', 'like', '%' . request('nama') . '%');
        }

        $pesertaMagang = $query->paginate(10);

        $jenisDokumen = [
            'permohonan_magang',
            'proposal_proyek',
            'laporan_bulan_1',
            'laporan_bulan_2',
            'laporan_bulan_3',
            'laporan_bulan_4',
            'laporan_bulan_5',
            'laporan_bulan_akhir',
            'lainnya',
        ];

        return view('halaman_admin.manajemen_laporan.index', compact('pesertaMagang'));
    }

    public function create()
    {
        $pesertaMagang = PesertaMagang::with('dokumen')->get();

        $jenisDokumen = [
            'permohonan_magang' => 'Permohonan Magang',
            'proposal_proyek' => 'Proposal Proyek',
            'laporan_bulan_1' => 'Laporan Bulanan 1',
            'laporan_bulan_2' => 'Laporan Bulanan 2',
            'laporan_bulan_3' => 'Laporan Bulanan 3',
            'laporan_bulan_4' => 'Laporan Bulanan 4',
            'laporan_bulan_5' => 'Laporan Bulanan 5',
            'laporan_bulan_akhir' => 'Laporan Bulan Akhir',
            'lainnya' => 'Lainnya',
        ];

        return view('halaman_admin.manajemen_laporan.create', compact('pesertaMagang', 'jenisDokumen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peserta_id' => 'required|exists:peserta_magang,id',
            'jenis_dokumen' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->jenis_dokumen !== 'lainnya') {
            $exists = dokumen::where('peserta_id', $request->peserta_id)
                ->where('jenis_dokumen', $request->jenis_dokumen)
                ->exists();

            if ($exists) {
                return redirect()->back()->with('error', 'Dokumen dengan jenis tersebut sudah pernah diunggah untuk peserta ini.');
            }
        }

        $folderMap = [
            'permohonan_magang' => 'surat_permohonan',
            'proposal_proyek' => 'proposal_proyek',
            'laporan_bulan_1' => 'laporan_bulan_1',
            'laporan_bulan_2' => 'laporan_bulan_2',
            'laporan_bulan_3' => 'laporan_bulan_3',
            'laporan_bulan_4' => 'laporan_bulan_4',
            'laporan_bulan_5' => 'laporan_bulan_5',
            'laporan_bulan_akhir' => 'laporan_akhir',
            'lainnya' => 'lainnya',
        ];

        $folder = 'uploads/' . ($folderMap[$request->jenis_dokumen] ?? 'lainnya');

        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        $filePath = $request->file('file')->store($folder, 'public');

        dokumen::create([
            'peserta_id' => $request->peserta_id,
            'jenis_dokumen' => $request->jenis_dokumen,
            'file_path' => $filePath,
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diunggah.');
    }

    public function destroyAll()
    {
        try {
            $allDocuments = dokumen::all();

            foreach ($allDocuments as $document) {
                if (Storage::disk('public')->exists($document->file_path)) {
                    Storage::disk('public')->delete($document->file_path);
                }
            }

            dokumen::truncate();

            return redirect()->route('dokumen.index')->with('success', 'Semua dokumen berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('dokumen.index')
                ->with('error', 'Gagal menghapus semua dokumen: ' . $e->getMessage());
        }
    }
}
