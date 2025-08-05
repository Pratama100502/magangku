<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\PesertaMagang;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // if (Auth::guard('peserta')->attempt($credentials)) {
        //     return redirect()->intended('dashboard')->with('success', 'Login berhasil!');
        // }
        if (Auth::guard('peserta')->attempt($credentials)) {
            $user = Auth::guard('peserta')->user();

            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin.index');
            } elseif ($user->role === 'peserta') {
                return redirect()->route('peserta.dashboard');
            }
        }

        return redirect()->route('login')->withErrors(['email' => 'Email atau password salah']);
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            'nama'               => 'required|string|max:255',
            'email'              => 'required|email|unique:peserta_magang,email',
            'password'           => 'required|confirmed|min:6',
            'asal_sekolah'       => 'required|string|max:255',
            'jurusan'            => 'required|string|max:255',
            'nim'                => 'required|string|max:50',
            'no_hp'              => 'required|string|max:20',
            'tanggal_mulai'      => 'date',
            'tanggal_selesai'    => 'date',
            'nama_anggota'       => 'nullable|array',
            'nama_anggota.*'     => 'nullable|string|max:255',
            'no_hp_anggota'      => 'nullable|array',
            'no_hp_anggota.*'    => 'nullable|string|max:20',
            'surat_permohonan'   => 'required|file|mimes:pdf,doc,docx|max:2048',
            'proposal_proyek'    => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        try {
            // Simpan file
            $permohonanPath = $request->file('surat_permohonan')->store('uploads/surat_permohonan', 'public');
            $proposalPath   = $request->file('proposal_proyek')->store('uploads/proposal_proyek', 'public');

            DB::beginTransaction();

            // Simpan ke tabel peserta_magang
            $peserta = PesertaMagang::create([
                'nama'        => $request->nama,
                'email'       => $request->email,
                'password'    => Hash::make($request->password),
                'asal_sekolah' => $request->asal_sekolah,
                'jurusan'     => $request->jurusan,
                'nim'         => $request->nim,
                'no_hp'       => $request->no_hp,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai
            ]);

            // Simpan ke tabel anggota
            if (!empty($request->nama_anggota) && !empty($request->no_hp_anggota)) {
                foreach ($request->nama_anggota as $i => $namaAnggota) {
                    if ($namaAnggota && !empty($request->no_hp_anggota[$i])) {
                        DB::table('anggota')->insert([
                            'ketua_id' => $peserta->id,
                            'nama_anggota' => $namaAnggota,
                            'no_hp_anggota' => $request->no_hp_anggota[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            // Simpan ke tabel dokumen (dua entri: permohonan & proposal)
            DB::table('dokumen')->insert([
                [
                    'peserta_id'     => $peserta->id,
                    'jenis_dokumen'  => 'permohonan_magang',
                    'file_path'      => $permohonanPath,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ],
                [
                    'peserta_id'     => $peserta->id,
                    'jenis_dokumen'  => 'proposal_proyek',
                    'file_path'      => $proposalPath,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]
            ]);

            DB::commit();

            Auth::guard('peserta')->login($peserta);
            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'error' => 'Terjadi kesalahan saat registrasi: ' . $e->getMessage()
            ])->withInput();
        }
    }


    public function dashboard()
    {
        if (Auth::guard('peserta')->check()) {
            return view('dashboard');
        }

        return redirect()->route('login')->withErrors(['auth' => 'Silakan login terlebih dahulu.']);
    }

    public function logout()
    {
        Session::flush();
        Auth::guard('peserta')->logout();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
