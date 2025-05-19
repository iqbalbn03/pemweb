<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sharing extends Model
{
    use HasFactory;

    protected $table = 'sharing';

    protected $fillable = [
        'pelanggan_id',
        'waktu_beli',
        'waktu_habis',
    ];

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
}
