<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MentorModel;
use Illuminate\Support\Facades\Hash;

class MentorController extends Controller
{
    public function index(Request $request)
    {
        $query = MentorModel::latest();

        // Pencarian berdasarkan nama jika ada
        if ($request->has('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        $mentors = $query->paginate(10)->appends($request->query());

        return view('halaman_admin.manajemen_mentor.index', compact('mentors'));
    }

    public function create()
    {
        return view('halaman_admin.manajemen_mentor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:mentor,email',
            'bidang' => 'required',
            'password' => 'required',
        ], [
            'nama.required' => 'Nama harus di isi.',
            'no_hp.required' => 'No Hp harus di isi.',
            'email.required' => 'Email harus di isi.',
            'email.unique' => 'Email sudah terdaftar gunakan email lain.',
            'bidang.required' => 'Bidang harus di isi.',
            'password.required' => 'Password harus di isi.',
        ]);

        try {

            MentorModel::create([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'bidang' => $request->bidang,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $mentor = MentorModel::findOrFail($id);
        return view('halaman_admin.manajemen_mentor.update', compact('mentor'));
    }

    public function update(Request $request, $id)
    {
        $mentor = MentorModel::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:mentor,email,' . $id,
            'bidang' => 'required',
            'password' => 'nullable',
        ], [
            'nama.required' => 'Nama harus di isi.',
            'no_hp.required' => 'No Hp harus di isi.',
            'email.required' => 'Email harus di isi.',
            'email.unique' => 'Email sudah terdaftar gunakan email lain.',
            'bidang.required' => 'Bidang harus di isi.',
        ]);

        try {
            $mentor->update([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'bidang' => $request->bidang,
            ]);

            if ($request->filled('password')) {
                $mentor->update(['password' => Hash::make($request->password)]);
            }

            return redirect()->back()->with('success', 'Data mentor berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        try {
            $mentor = MentorModel::findOrFail($id);
            $mentor->delete();
            return redirect()->route('mentor.index')->with('success', 'Mentor berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
