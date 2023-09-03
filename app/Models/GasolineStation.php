<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasolineStation extends Model
{
    use HasFactory;
    protected $fillable = [
        'ruc',
        'company_type',
        'company_name',
        'images',
        'ubigeo',
        'location',
        'station_has_gasoline_station_id'
    ];

    protected $casts = [
        'images' => 'array',
        'location' => 'array',
        'ubigeo' => 'array'
    ];

    public function subscriptions()
    {
        return $this->hasMany(SellerServicesContract::class, 'id', 'station_has_gasoline_station_id');
    }

    public function scopeActive($query)
    {
        return $query->where('state', 1);
    }


    public function scopeFromStation($query, $stationId)
    {
        return $query->where('station_has_gasoline_station_id', $stationId);
    }

    public function unsetAfiliation() {
        $this->station_has_gasoline_station_id = null;
    }

}
