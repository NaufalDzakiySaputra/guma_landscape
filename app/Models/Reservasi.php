<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    
    protected $table = 'reservasi';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_reservasi' => 'date',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'status_reservasi' => 'string',
        'jumlah_orang' => 'int',
        'total_harga' => 'int',
    ];
    /**
     * Relasi belongsTo ke model Pengunjung.
     */
    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class, 'id_pengunjung', 'id_pengunjung');
    }
}
