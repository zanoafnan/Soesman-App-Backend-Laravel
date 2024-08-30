<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    use HasFactory;

    protected $table = 'kurir';
    protected $primaryKey = 'kurir_id';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'no_telp',
        'alamat',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /*public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'id_kurir', 'kurir_id');
    }*/
}
