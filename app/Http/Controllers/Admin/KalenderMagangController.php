<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PesertaMagang;

class KalenderMagangController extends Controller
{
    public function index()
    {
        return view('halaman_admin.kalender_magang.index');
    }

    public function getData()
    {
        $peserta = PesertaMagang::where('status', 'aktif')
            ->select('nama', 'tanggal_mulai', 'tanggal_selesai')
            ->get();

        $events = [];

        foreach ($peserta as $item) {
            $events[] = [
                'title' => $item->nama,
                'start' => $item->tanggal_mulai,
                'end'   => date('Y-m-d', strtotime($item->tanggal_selesai . ' +1 day')),
                'color' => '#28a745'
            ];
        }

        return response()->json($events);
    }
}
