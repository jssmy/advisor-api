<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StationRecovery;

class GasolineStationController extends Controller
{
    //

    public function getStationsRecovery() {
        $stations = StationRecovery::all()
                    ->map(function($station) {
                        return [
                            'id' => $station->id,
                            'ruc' => $station->RUC,
                            'name' => $station->RAZON_SOCIAL,
                            'ubigeo' => [
                                'deparment' => $station->DEPARTMENTO,
                                'pronvince' => $station->PROVINCIA,
                                'district' => $station->DISTRITO
                            ]
                        ];
                    });
        return response()->json([
            $stations
        ]);
    }
}
