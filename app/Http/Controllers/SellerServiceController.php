<?php

namespace App\Http\Controllers;

use App\Models\SellerServices;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerServiceController extends Controller
{
    //

public function getServices() {
    $sellerServices = SellerServices::all();

    return response()->json(
        $sellerServices,
        Response::HTTP_OK
    );

}

}
