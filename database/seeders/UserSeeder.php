<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserGrant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::insert(
            [
                [
                    'national_id' => '73365266',
                    'national_type' => 'dni',
                    'name' => 'Joset Manihuari Yaricahua',
                    'email' => 'jost.manihuari@gamail.com',
                    'telephone' => '968122367',
                    'grant_id' => 1,
                    'password' => Hash::make('123456789'),
                    'gasoline_station_id' => null
                ],
                [
                    'national_id' => '73365265',
                    'national_type' => 'dni',
                    'name' => 'Roberto Carlos Bolaños',
                    'email' => 'robert.bolanios@gamail.com',
                    'telephone' => '968122361',
                    'grant_id' => 3,
                    'password' => Hash::make('123456789'),
                    'gasoline_station_id' => null
                ]
            ]
        );
    }
}
