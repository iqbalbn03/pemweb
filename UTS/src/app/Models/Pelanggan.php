<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';

    protected $fillable = [
        'nama',
        'no_wa',
        'langganan',
        'image',
        'status',
    ];

    // Relasi ke Sharing (one to one / one to many sesuai kebutuhan)
    public function sharing()
    {
        return $this->hasOne(Sharing::class, 'pelanggan_id');
    }

    // Relasi ke Privasi
    public function privasi()
    {
        return $this->hasOne(Privasi::class, 'pelanggan_id');
    }
}
