<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerServices extends Model
{
    use HasFactory;
    protected $casts = [
        'planes' => 'array',
        'services_includes' => 'array'
    ];
}
