<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(
            [
                UserSeeder::class,
                GasolineStationSeeder::class,
                SellerServicesSeeder::class
            ]
        );

        /***actyualizando ***/
        $user1 = User::find(1);

        $user1->gasoline_station_id = 1;
        $user1->save();

        $user2 = User::find(2);

        $user2->gasoline_station_id = 1;
        $user2->save();

        $user3 = User::find(3);

        $user3->gasoline_station_id = 2;
        $user3->save();

        $user3 = User::find(4);

        $user3->gasoline_station_id = 2;
        $user3->save();
    }
}
