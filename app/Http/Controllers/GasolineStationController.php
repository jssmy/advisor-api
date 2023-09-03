<?php

namespace App\Http\Controllers;

use App\Models\GasolineStation;
use Illuminate\Http\Request;
use App\Repository\GasolineStationRepository;
use Symfony\Component\HttpFoundation\Response;

class GasolineStationController extends Controller
{
    private GasolineStationRepository  $stationRepository;

    public function __construct()
    {
        $this->stationRepository = new GasolineStationRepository();
    }

    /**
     * @OA\Get(
     *      path="/api/v1/station/recovery-batch/{ruc}",
     *      summary="Get stations recovered",
     *      description="Get stations recovery by batch from OSINERMING by searching ruc",
     *      tags={"search station by ruc"},
     *      @OA\Parameter(
     *                  name="ruc",
     *                  required=true,
     *                  in="path",
     *                  @OA\Schema(type="string")
     * ),
     *      @OA\Parameter(
     *                      name="Authorization",
     *                      required=true,
     *                      in="header",
     *                      @OA\Schema(type="jwt")
     *                  ),
     *      @OA\Response(
     *              response=200,
     *              description="Stations was found like RUC parameter"
     *          ),
     *      @OA\Response(
     *          response=401,
     *          description="Please check your token authorization",
     *       )
     * )
     */
    public function getStationsRecovery(string $ruc)
    {

        $stations = $this->stationRepository->getStationsRecovery($ruc);

        return response()->json($stations);
    }

    /**
     * @OA\Post(
     *          path="/api/v1/station/afiliar",
     *          summary="To afiliate station",
     *          description="To afiliate stations in whosaler comapany",
     *          tags={"To afiliate station"},
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          required=true,
     *          @OA\Schema(type="jwt")
     * 
     *      ),
     *          @OA\RequestBody(
     *              required=true,
     *              description="Request body to afiliate station",
     *              @OA\JsonContent(
     *                  @OA\Property(property="ruc", type="string", maxLength=8, minLength=8),
     *                  @OA\Property(property="company_name", type="string", maxLength=255),
     *                  @OA\Property(property="address", type="string", maxLength=255),
     *                  @OA\Property(
     *                              property="ubigeo",
     *                              type="object",
     *                              @OA\Property(
     *                                  property="deparment",
     *                                  type="object",
     *                                  @OA\Property(property="id", type="string"),
     *                                  @OA\Property(property="name", type="string")
     *                              ),
     *                              @OA\Property(
     *                                  property="province",
     *                                  type="object",
     *                                  @OA\Property(property="id", type="string"),
     *                                  @OA\Property(property="name", type="string")
     *                              ),
     *                              @OA\Property(
     *                                  property="district",
     *                                  type="object",
     *                                  @OA\Property(property="id", type="string"),
     *                                  @OA\Property(property="name", type="string")
     *                              )
     *                  ),
     *                  @OA\Property(
     *                      property="images",
     *                      type="array",
     *                      @OA\Items(
     *                          @OA\Property(property="name", type="string"),
     *                          @OA\Property(property="src", type="base64"),
     *                          @OA\Property(property="type", type="string")
     *                              )
     *                  )
     *              )
     *          ),
     *          @OA\Response(
     *              response=200,
     *              description="The station was afiliated"
     *          ),
     *          @OA\Response(
     *              response=401,
     *              description="Please check your token authorization"
     *          )
     *          
     * )
     * 
     */
    public function afiliarStation(Request $request)
    {
        $user =  auth()->user();
        $user->load('company');

        $station = GasolineStation::updateOrCreate(
            [
                'ruc' => $request->ruc
            ],
            [
                'company_name' => $request->company_name,
                'images' => $request->images,
                'ubigeo' => $request->ubigeo,
                'company_type' => 'retailer',
                'company_name' => $request->company_name,
                'station_has_gasoline_station_id' => $user->company->id
            ]
        );

        return response()->json([
            'message' => 'Station has been afiliate',
            Response::HTTP_OK
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/station/afiliados",
     *      summary="Get alifiate stations",
     *      tags={"Get station afiliates"},
     *      description="Get afiliate stations from whosaler station",
     *      @OA\Parameter(
     *          name="page",
     *          in="query",
     *          required=false,
     *          @OA\Schema(type="int")
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          required=true,
     *          @OA\Schema(type="jwt")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Afiliates stations obtain"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Please check your token authorization",
     *       )
     * )
     * 
     */
    public function getStationsAfiliados(Request $request)
    {
        $user =  auth()->user();
        $user->load('company');
        $stations = GasolineStation::fromStation($user->company->id)
        ->filter($request)
        ->paginate(10);

        return response()->json(
            $stations
        );
    }


/**
 * @OA\Delete(
 *      path="/api/v1/station/unset/{stationId}",
 *      summary="Unset afiliation",
 *      description="Unset afiliaton of station",
 *      tags={"Unset afiliation of station"},
 *      @OA\Parameter(
 *          name="stationId",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="int")
 *      ),
 *      @OA\Parameter(
 *          name="Authorization",
 *          in="header",
 *          required=true,
 *          @OA\Schema(type="jwt")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Station was removed of whosaler"
 *       ),
 *      @OA\Response(
 *          response=401,
 *          description="Please check your token authorization",
 *       ),
 *      @OA\Response(
 *          response=403,
 *          description="You dont have permission to unset this station",
 *       )
 * )
 * ),
 *
 */
    public function unsetAfiliation(int $stationId)
    {
        $user =  auth()->user();
        $user->load('company');

        $station = GasolineStation::fromStation($user->company->id)->find($stationId);

        if (!$station) {
            return response()->json(
                [
                    'message' => 'You dont have permission to unset afiliation of this station'
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $station->unsetAfiliation();
        $station->save();

        return response()->json(
            [
                'message' => 'Unset afiliation succes'
            ],
            Response::HTTP_OK
        );
    }
}
