<?php

namespace Database\Seeders;

use App\Models\GasolineStation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GasolineStationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        GasolineStation::insert(
            [
                [
                    'ruc'=>'10733652662',
                    'company_type'=>'retailer',
                    'company_name'=>'Petro Perú',
                    'images'=> json_encode(
                        [
                            'logo_sm' => 'logo_sm.svg',
                            'logo' => 'logo.svg'
                        ]
                    ),
                    'location' => json_encode(
                        [
                            'latitude' => '-12121212.1212',
                            'longitude' => '-12121212.1212',
                        ]
                    ),
                    'state' => true
                ],
                [
                    'ruc'=>'10233652662',
                    'company_type'=>'wholesaler',
                    'company_name'=>'Petro Bolivia',
                    'images'=> json_encode(
                        [
                            'logo_sm' => 'logo_sm.svg',
                            'logo' => 'logo.svg'
                        ]
                    ),
                    'location' => json_encode(
                        [
                            'latitude' => '-12121212.1212',
                            'longitude' => '-12121212.1212',
                        ]
                    ),
                    'state' => true
                ]
            ]
        );

    }
}
