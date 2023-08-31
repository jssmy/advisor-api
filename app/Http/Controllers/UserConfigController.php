<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserConfigController extends Controller
{
    public function getUserConfigDefault() {
        $user = auth()->user();
        $user->load('company','roles');
        $role = collect($user->roles)->first();

        $permissions = $user->getAllPermissions()->map(function ($permision) {
            return [
                'id' => $permision->id,
                'name' => $permision->name,
                'type' => $permision->type,
                'route' => $permision->route
            ];
        });
        $userConfig = [
            'user' => [
                'name' => $user->name,
                'email'=> $user->email
            ],
            'grant' => [
                'id' => $role->id,
                'name' => $role->name
            ],
            'permissions' => $permissions,
            'subscriptions' => []
        ];

        if($user->company) {
            $user->company->load('subscriptions');
            $userConfig['company'] = [
                'id'=> $user->company->id,
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
