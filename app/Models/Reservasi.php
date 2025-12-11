<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    
    protected $table = 'reservasi';
    protected $fillable = [
        'status_reservasi',
        'jumlah_orang',
        'waktu_reservasi',
        'tanggal_reservasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_harga',
        'id_pengunjung',
    ];


    protected $casts = [
        'tanggal_reservasi' => 'date',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'status_reservasi' => 'string',
        'jumlah_orang' => 'int',
        'total_harga' => 'int',
    ];
  
    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class, 'id_pengunjung', 'id_pengunjung');
    }
}
