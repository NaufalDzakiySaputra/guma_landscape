<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    
    //Nama tabel
    protected $table = 'unit';

    //Primary key custom
    protected $primarykey = 'id_unit';

    //jika primary key bukan increment default 'id'
    public $incrementing = true;

    //jika primary key bertipe integer
    protected $keyType = 'int';

    //field yang boleh diiis mass assigment
    protected $fillable = [
        'nama_unit',
        'harga_weekday',
        'harga_wekeend',
        'harga_libur',
        'harga_libur_besar',
        'kapasitas',
        'status_unit',
        'deskripsi_unit',
    ];
}