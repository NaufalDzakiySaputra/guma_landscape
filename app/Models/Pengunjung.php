<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;
    protected $table = 'pengunjung';
    protected $primaryKey = 'id_pengunjung';
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable =[
        'nama',
        'no_telepon',
        'alamat',
    ];

}
