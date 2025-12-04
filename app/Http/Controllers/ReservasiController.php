<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use App\Models\Reservasi;
use App\Models\DetailReservasi;
use App\Models\Unit;
use App\Models\HariLibur;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{
    /**
     * Menampilkan form reservasi
     */
    public function index()
    {
        // Ambil unit yang available
        $units = Unit::where('status_unit', 'available')->get();
        
        // Jika tidak ada unit, buat sample data
        if ($units->isEmpty()) {
            $this->buatSampleUnit();
            $units = Unit::where('status_unit', 'available')->get();
        }
        
        return view('reservasi.index', compact('units'));
    }

    /**
     * Menyimpan data reservasi
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'id_unit' => 'required|exists:unit,id_unit',
            'jumlah_orang' => 'required|integer|min:1|max:10'
        ]);

        try {
            DB::beginTransaction();

            // Cari atau buat pengunjung berdasarkan nomor telepon
            $pengunjung = Pengunjung::firstOrCreate(
                ['no_telepon' => $validated['no_telepon']],
                [
                    'nama' => $validated['nama'],
                    'alamat' => $validated['alamat'] ?? null
                ]
            );

            // Hitung jumlah hari
            $checkIn = Carbon::parse($validated['tanggal_mulai']);
            $checkOut = Carbon::parse($validated['tanggal_selesai']);
            $jumlahHari = $checkIn->diffInDays($checkOut);

            // Ambil data unit
            $unit = Unit::findOrFail($validated['id_unit']);

            // Validasi kapasitas
            if ($validated['jumlah_orang'] > $unit->kapasitas) {
                return back()->withErrors([
                    'jumlah_orang' => 'Jumlah orang melebihi kapasitas villa. Kapasitas maksimal: ' . $unit->kapasitas . ' orang'
                ])->withInput();
            }

            // Hitung total harga
            $totalHarga = $this->hitungTotalHarga($unit->harga_unit, $checkIn, $checkOut);

            // Buat reservasi
            $reservasi = Reservasi::create([
                'id_pengunjung' => $pengunjung->id_pengunjung,
                'status_reservasi' => 'pending',
                'jumlah_orang' => $validated['jumlah_orang'],
                'waktu_reservasi' => now()->format('H:i:s'),
                'tanggal_reservasi' => now()->format('Y-m-d'),
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'tanggal_selesai' => $validated['tanggal_selesai'],
                'total_harga' => $totalHarga
            ]);

            // Buat detail reservasi
            DetailReservasi::create([
                'id_reservasi' => $reservasi->id_reservasi,
                'id_unit' => $unit->id_unit,
                'jumlah_hari' => $jumlahHari,
                'subtotal' => $totalHarga
            ]);

            // Update status unit
            $unit->update(['status_unit' => 'reserved']);

            DB::commit();

            // Redirect ke halaman pembayaran
            return redirect()->route('pembayaran.index', $reservasi->id_reservasi)
                            ->with('success', 'Reservasi berhasil dibuat! Silakan lanjutkan pembayaran.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withErrors([
                'error' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
            ])->withInput();
        }
    }

    /**
     * Hitung total harga dengan memperhitungkan hari libur
     */
    private function hitungTotalHarga($hargaPerMalam, $checkIn, $checkOut)
    {
        $totalHarga = 0;
        $currentDate = $checkIn->copy();

        while ($currentDate->lt($checkOut)) {
            // Cek apakah hari libur
            $isHoliday = HariLibur::where('tanggal', $currentDate->format('Y-m-d'))->first();
            
            if ($isHoliday) {
                // Tambahkan kenaikan harga untuk hari libur
                $persentaseKenaikan = $this->getPersentaseKenaikan($isHoliday->jenis_libur);
                $hargaHariIni = $hargaPerMalam * (1 + ($persentaseKenaikan / 100));
            } else {
                $hargaHariIni = $hargaPerMalam;
            }

            $totalHarga += $hargaHariIni;
            $currentDate->addDay();
        }

        return $totalHarga;
    }

    /**
     * Tentukan persentase kenaikan berdasarkan jenis libur
     */
    private function getPersentaseKenaikan($jenisLibur)
    {
        return match($jenisLibur) {
            'nasional' => 25,
            'weekend_spesial' => 20,
            'hari_besar' => 30,
            default => 0
        };
    }

    /**
     * Buat sample data unit jika tidak ada
     */
    private function buatSampleUnit()
    {
        $units = [
            [
                'nama_unit' => 'Villa Standard',
                'harga_unit' => 500000,
                'kapasitas' => 2,
                'status_unit' => 'available',
                'deskripsi_unit' => 'Villa nyaman dengan fasilitas standar, cocok untuk pasangan'
            ],
            [
                'nama_unit' => 'Villa Deluxe',
                'harga_unit' => 750000,
                'kapasitas' => 4,
                'status_unit' => 'available',
                'deskripsi_unit' => 'Villa mewah dengan pemandangan alam, cocok untuk keluarga kecil'
            ],
            [
                'nama_unit' => 'Villa Premium',
                'harga_unit' => 1000000,
                'kapasitas' => 6,
                'status_unit' => 'available',
                'deskripsi_unit' => 'Villa eksklusif dengan fasilitas lengkap, cocok untuk gathering'
            ]
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }

    /**
     * API untuk cek ketersediaan unit berdasarkan tanggal
     */
    public function cekKetersediaan(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'unit_id' => 'nullable|exists:unit,id_unit'
        ]);

        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);

        $availableUnits = Unit::where('status_unit', 'available')
            ->whereDoesntHave('detailReservasi', function($query) use ($checkIn, $checkOut) {
                $query->whereHas('reservasi', function($q) use ($checkIn, $checkOut) {
                    $q->where(function($q2) use ($checkIn, $checkOut) {
                        $q2->whereBetween('tanggal_mulai', [$checkIn, $checkOut])
                           ->orWhereBetween('tanggal_selesai', [$checkIn, $checkOut])
                           ->orWhere(function($q3) use ($checkIn, $checkOut) {
                               $q3->where('tanggal_mulai', '<=', $checkIn)
                                  ->where('tanggal_selesai', '>=', $checkOut);
                           });
                    })->whereIn('status_reservasi', ['pending', 'confirmed']);
                });
            });

        if ($request->unit_id) {
            $availableUnits->where('id_unit', $request->unit_id);
        }

        $availableUnits = $availableUnits->get();

        return response()->json([
            'tersedia' => $availableUnits->isNotEmpty(),
            'units' => $availableUnits,
            'check_in' => $checkIn->format('d M Y'),
            'check_out' => $checkOut->format('d M Y'),
            'total_hari' => $checkIn->diffInDays($checkOut)
        ]);
    }
}