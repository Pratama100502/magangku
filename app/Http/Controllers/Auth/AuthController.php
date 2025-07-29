<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->with('success', 'Login berhasil');
        }

        return redirect('login')->withErrors(['email' => 'Email atau password salah']);
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'username'            => 'required|string|max:255|unique:users',
            'email'               => 'required|email|unique:users',
            'password'            => 'required|confirmed|min:6',
            'asal_kampus'         => 'required|string|max:255',
            'jurusan'             => 'required|string|max:255',
            'nim'                 => 'required|string|max:50',
            'no_hp'               => 'required|string|max:20',
            'keahlian'            => 'nullable|string|max:255',
            'anggota'             => 'nullable|array',
            'anggota.*'           => 'nullable|string|max:255',
            'no_anggota'          => 'nullable|array',
            'no_anggota.*'        => 'nullable|string|max:20',
            'surat_permohonan'    => 'required|file|mimes:pdf,doc,docx|max:2048',
            'surat_project'       => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Simpan file upload ke storage/app/public/uploads
        $suratPermohonanPath = $request->file('surat_permohonan')->store('uploads', 'public');
        $suratProjectPath    = $request->file('surat_project')->store('uploads', 'public');

        // Buat user baru
        $user = User::create([
            'name'             => $request->name,
            'username'         => $request->username,
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
            'asal_kampus'      => $request->asal_kampus,
            'jurusan'          => $request->jurusan,
            'nim'              => $request->nim,
            'no_hp'            => $request->no_hp,
            'keahlian'         => $request->keahlian,
            'anggota'          => $request->anggota,
            'no_anggota'       => $request->no_anggota,
            'surat_permohonan' => $suratPermohonanPath,
            'surat_project'    => $suratProjectPath,
        ]);

        Auth::login($user);

        return redirect('dashboard')->with('success', 'Registrasi berhasil. Selamat datang!');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect('login')->withErrors(['auth' => 'Silakan login terlebih dahulu.']);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login')->with('success', 'Berhasil logout');
    }
}
