<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Logo extends Model
{
    protected $table = 'logos';
    protected $fillable = [
        'title',
        'image',
    ];
}
