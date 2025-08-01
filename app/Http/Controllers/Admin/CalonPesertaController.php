<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesertaMagang;
use Illuminate\Http\Request;

class CalonPesertaController extends Controller
{
    public function index(Request $request)
    {
        $query = PesertaMagang::with(['mentor', 'anggota', 'dokumen'])
            ->where('status', 'mengajukan')
            ->latest();

        if ($request->has('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        $pesertas = $query->paginate(10)->appends($request->query());

        $pesertas->getCollection()->transform(function ($peserta) {
            $peserta->total_anggota = $peserta->anggota->count();

            $peserta->has_permohonan = $peserta->dokumen->contains('jenis_dokumen', 'permohonan_magang');

            $peserta->has_proposal = $peserta->dokumen->contains('jenis_dokumen', 'proposal_proyek');

            return $peserta;
        });

        return view('halaman_admin.calon_peserta_magang.index', compact('pesertas'));
    }
}
