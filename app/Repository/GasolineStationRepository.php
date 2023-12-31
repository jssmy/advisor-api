<?php

namespace App\Repository;

use App\Models\GasolineStation;
use App\Models\StationRecovery;
class GasolineStationRepository {
    
    public function getStationsRecovery(string $ruc) {
        $user =  auth()->user();
        $user->load('company');
        $companyAfiliados = GasolineStation::FromStation($user->company->id);
        $stations = StationRecovery::where('RUC', 'like', "$ruc%")
            ->whereNotIn('RUC', $companyAfiliados->pluck('ruc')->toArray())
            ->groupBy(
            [
                'RUC',
                'RAZON_SOCIAL',
                'DIRECCION',
                'DEPARTAMENTO',
                'PROVINCIA',
                'DISTRITO'
            ]
        )->get([
            'RUC',
            'RAZON_SOCIAL',
            'DIRECCION',
            'DEPARTAMENTO',
            'PROVINCIA',
            'DISTRITO'
        ])
        ->map(function($station) {
            
            return [
                'ruc' => $station->RUC,
                'name' => $station->RAZON_SOCIAL,
                'address' => $station->DIRECCION,
                'ubigeo' => [
                    'deparment' => $station->DEPARTAMENTO,
                    'pronvince' => $station->PROVINCIA,
                    'district' => $station->DISTRITO
                ]
            ];
        });

        return $stations;

    }
}