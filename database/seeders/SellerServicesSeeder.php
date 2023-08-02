<?php

namespace Database\Seeders;

use App\Models\SellerServices;
use Illuminate\Database\Seeder;

class SellerServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        SellerServices::insert(
            [
                [
                    'name' => 'Servicio de transporte',
                    'planes' => json_encode([
                        [
                            'price' => 50.40,
                            'preriod_time' => 1,
                            'in_time' => 'month',
                            'name' => 'Plan mensual'
                        ],
                        [
                            'price' => 40.00,
                            'preriod_time' => 6,
                            'in_time' => 'month',
                            'name' => 'Plan semestral'
                        ],
                        [
                            'price' => 30.00,
                            'preriod_time' => 1,
                            'in_time' => 'year',
                            'name' => 'Plan anual'
                        ]
                    ]),
                    'services_includes' => json_encode([
                        'Transporte de producto a tarifas del mercado',
                        'Consigue transporte confible y seguro',
                        'Seguimiento del producto transportado',
                    ])
                ],
                [
                    'name' => 'Compara precios',
                    'planes' => json_encode([
                        [
                            'price' => 50.40,
                            'preriod_time' => 1,
                            'in_time' => 'month',
                            'name' => 'Plan mensual'
                        ],
                        [
                            'price' => 40.00,
                            'preriod_time' => 6,
                            'in_time' => 'month',
                            'name' => 'Plan semestral'
                        ],
                        [
                            'price' => 30.00,
                            'preriod_time' => 1,
                            'in_time' => 'year',
                            'name' => 'Plan anual'
                        ]
                    ]),
                    'services_includes' => json_encode([
                        'Transporte de producto a tarifas del mercado',
                        'Consigue transporte confible y seguro',
                        'Seguimiento del producto transportado',
                    ])
                ]
            ]
        );
    }
}
