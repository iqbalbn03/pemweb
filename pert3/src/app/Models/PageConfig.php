<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageConfig extends Model
{
    protected $table = 'page_configs';
    protected $fillable = [
        'title',
        'detail',
        'image',
    ];
}
