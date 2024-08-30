<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
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

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'id_user', 'user_id');
    }
}
