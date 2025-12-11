<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $pendapatan = Pembayaran::sum('jumlah_bayar');
        $total_reservasi = Reservasi::count();
        $reservasi_bulan_ini = Reservasi::whereMonth('created_at', now()->month)->get();

        return view('gm.laporan.index', compact('pendapatan', 'total_reservasi', 'reservasi_bulan_ini'));
    }
}
