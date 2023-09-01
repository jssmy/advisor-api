<?php

namespace App\Http\Controllers;

use App\Models\GasolineStation;
use Illuminate\Http\Request;
use App\Repository\GasolineStationRepository;
use Symfony\Component\HttpFoundation\Response;


class GasolineStationController extends Controller
{
    private GasolineStationRepository  $stationRepository;

    public function __construct() {
        $this->stationRepository = new GasolineStationRepository();
    }

    public function getStationsRecovery(string $ruc) {
      
        $stations = $this->stationRepository->getStationsRecovery($ruc);

        return response()->json($stations);
    }


    public function afiliarStation(int $stationId, Request $request) {

        $station = GasolineStation::updateOrCreate(
            [
                'ruc' => $request->ruc
            ],
            [
                'company_name' => $request->company_name,
                'images' => $request->images,
                'company_type' => 'retailer',
                'company_name' => $request->company_name,   
                'station_has_gasoline_station_id' => $stationId
            ]
        );

        return response()->json([
            'message' => 'Station has been afiliate',
            Response::HTTP_OK
        ]);

        
    }

    public function getStationsAfiliados() {
        $user =  auth()->user();
        $user->load('company');
        $stations = GasolineStation::fromStation($user->company->id)->get();

        return response()->json(
            $stations
        );
    }
}
