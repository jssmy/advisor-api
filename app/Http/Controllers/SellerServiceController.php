<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;



class SellerServiceController extends Controller
{

    public function __construct() {
        
    }

public function getServices() {
    
    return response()->json(
        [],
        Response::HTTP_OK
    );

}

}
