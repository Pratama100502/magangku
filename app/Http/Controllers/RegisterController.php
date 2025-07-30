<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\PesertaMagang;
use App\Models\Dokumen;
use App\Models\Anggota;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.registration');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'nama'              => 'required|string|max:255',
            'email'             => 'required|email|unique:peserta_magang,email',
            'password'          => 'required|confirmed|min:6',
            'asal_sekolah'      => 'required|string|max:255',
            'jurusan'           => 'required|string|max:255',
            'nim'               => 'required|string|max:50|unique:peserta_magang,nim',
            'no_hp'             => 'required|string|max:20',
            'anggota'           => 'nullable|array',
            'anggota.*'         => 'nullable|string|max:255',
            'no_anggota'        => 'nullable|array',
            'no_anggota.*'      => 'nullable|string|max:20',
            'surat_permohonan'  => 'required|file|mimes:pdf,doc,docx|max:2048',
            'proposal_proyek'     => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Simpan data peserta
        $peserta = PesertaMagang::create([
            'nama'             => $request->nama,
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
            'asal_sekolah'     => $request->asal_sekolah,
            'jurusan'          => $request->jurusan,
            'nim'              => $request->nim,
            'no_hp'            => $request->no_hp,
        ]);

        // Upload dokumen
        $permohonanPath = $request->file('surat_permohonan')->store('dokumen', 'public');
        $projectPath    = $request->file('proposal_proyek')->store('dokumen', 'public');

        Dokumen::create([
            'peserta_magang_id' => $peserta->id,
            'jenis_dokumen'     => 'permohonan_magang',
            'file_path'         => $permohonanPath,
        ]);

        Dokumen::create([
            'peserta_magang_id' => $peserta->id,
            'jenis_dokumen'     => 'proposal_proyek',
            'file_path'         => $projectPath,
        ]);

        // Simpan anggota (jika ada)
        if ($request->anggota && $request->no_anggota) {
            foreach ($request->anggota as $i => $nama) {
                if (!empty($nama)) {
                    Anggota::create([
                        'ketua_id' => $peserta->id,
                        'nama'     => $nama,
                        'no_hp'    => $request->no_anggota[$i] ?? null,
                    ]);
                }
            }
        }

        // Login otomatis
        Auth::guard('peserta')->login($peserta);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }
}
