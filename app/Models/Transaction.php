<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'menus',
        'nama_customer',
        // ping_nama
        'total_price',
    ];

    protected $casts = [
        'menus' => 'array',
    ];
}
