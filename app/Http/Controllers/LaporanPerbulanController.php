<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanPerbulanController extends Controller
{
    public function index()
    {
        // Ambil semua file dalam folder laporan-perbulan dari storage/public
        $files = Storage::disk('public')->files('laporan-perbulan');
        return view('layouts.laporan-perbulan.index', compact('files'));
    }

    public function upload(Request $request)
    {
        // Validasi file yang diupload harus PDF dan maksimal 2MB
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // Ambil file
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Simpan ke storage/app/public/laporan-perbulan
        $file->storeAs('laporan-perbulan', $filename, 'public');

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diupload.');
    }

    public function download($file)
    {
        $path = 'laporan-perbulan/' . $file;

        // Cek apakah file ada
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($path);
    }
}
