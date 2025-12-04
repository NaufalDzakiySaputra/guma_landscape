<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index($id)
    {
        $reservasi = Reservasi::with('pengunjung', 'detail.unit')->findOrFail($id);
        return view('pembayaran.index', compact('reservasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_reservasi' => 'required',
            'metode_pembayaran' => 'required',
            'jumlah_bayar' => 'required|numeric',
        ]);

        Pembayaran::create([
            'id_reservasi' => $request->id_reservasi,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_bayar' => $request->jumlah_bayar,
            'status_pembayaran' => 'paid',
            'tanggal_bayar' => now(),
        ]);

        $reservasi = Reservasi::find($request->id_reservasi);
        $reservasi->status_reservasi = 'confirmed';
        $reservasi->save();

        return redirect('/')->with('success', 'Pembayaran Berhasil!');
    }
}