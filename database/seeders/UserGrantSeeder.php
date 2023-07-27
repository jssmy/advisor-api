<?php

namespace Database\Seeders;

use App\Models\UserGrant;

use Illuminate\Database\Seeder;

class UserGrantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        UserGrant::insert(
            [
                [
                    'name' => 'Advisor Administrador'
                ],
                [
                    'name' => 'Advisor Supervisor'
                ],
                [
                    'name' => 'Retailer Administrador'
                ],
                [
                    'name' => 'Retailer Supervisor'
                ]
            ]
        );
    }
}
