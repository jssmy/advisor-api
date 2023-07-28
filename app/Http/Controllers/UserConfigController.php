<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserConfigController extends Controller
{
    public function getUserConfigDefault() {
        $user = auth()->user();
        $user->load('grant','company');
        $userConfig = [
            'user' => [
                'name' => $user->name,
                'email'=> $user->email,
                'grant' => $user->grant
            ],
            'subscriptions' => [],
            'permissions' => []
        ];

        if($user->company) {
            $userConfig['company'] = [
                'ruc' => $user->company->ruc,
                'company_name' => $user->company->company_name,
                'company_type' => $user->company->company_type,
                'images' => $user->company->images,
                'location' => $user->company->location,
            ];
        }

        return response()->json(
            $userConfig
        );
    }
}
