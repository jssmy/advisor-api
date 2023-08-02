<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasolineStation extends Model
{
    use HasFactory;

    protected $casts = [
        'images' => 'array',
        'location' => 'array'
    ];

    public function subscriptions() {
        return $this->hasMany(SellerServicesContract::class, 'id', 'gasoline_station_id');
    }
}
