<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MentorModel;
use App\Models\PesertaMagang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pesertaAktif = PesertaMagang::where('status', 'aktif')->count();
        $pesertaMendaftar = PesertaMagang::where('status', 'mengajukan')->count();
        $totalMentor = MentorModel::count();
        $totalPeserta = PesertaMagang::count();
        $pesertaSelesai = PesertaMagang::where('status', 'selesai')->count();

        return view('halaman_admin.dashboard', compact(
            'pesertaAktif',
            'pesertaMendaftar',
            'totalMentor',
            'totalPeserta',
            'pesertaSelesai',
        ));
    }

    public function indexPeserta() {
        return view('halaman_peserta.dashboard');
    }
}
