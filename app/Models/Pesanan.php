<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'id_user',
        'items',
        'biaya',
        'total_pembayaran',
        'alamat',
        'status',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'user_id');
    }
}
