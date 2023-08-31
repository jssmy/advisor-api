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
                'images' => json_encode($request->images),
                'company_type' => 'retailer',
                'company_name' => $request->company_name,
                'images' => json_encode($request->images),
                'station_has_gasoline_station_id' => $stationId
            ]
        );

        return response()->json([
            'message' => 'Station has been afiliate',
            Response::HTTP_OK
        ]);

        
    }

    public function getStationsAfiliados(int $stationId) {
        return response()->json(
            GasolineStation::fromStation($stationId)->get()
        );
    }
}
