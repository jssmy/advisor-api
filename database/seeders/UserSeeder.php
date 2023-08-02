<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $adminRole = Role::create(['name' => 'Admin retailer']);
        $supervisorRole = Role::create(['name' => 'Supervisor retailer']);

        $adminRolewholesaler = Role::create(['name' => 'Admin wholesaler']);
        $supervisorRolewholesaler = Role::create(['name' => 'Supervisor wholesaler']);


        $menu = Permission::create([
            'name' => 'Estaciones afiliadas',
            'type' => 'menu',
            'route' => 'stations'
        ]);

        $permissionComparaPrecios = Permission::create([
            'name' => 'Compara precios',
            'type' => 'menu',
            'route' => 'seller-services'
        ]);

        $permissionServicioTransporte = Permission::create([
            'name' => 'Servicio de transporte',
            'type' => 'menu',
            'route' => 'seller-services'
        ]);

        $permissionConsultoria = Permission::create([
            'name' => 'Consultoría',
            'type' => 'menu',
            'route' => 'seller-services'
        ]);


        $adminRole->givePermissionTo($permissionConsultoria);
        $adminRole->givePermissionTo($permissionServicioTransporte);
        $adminRole->givePermissionTo($permissionComparaPrecios);

        $supervisorRole->givePermissionTo($permissionConsultoria);
        $supervisorRole->givePermissionTo($permissionServicioTransporte);
        $supervisorRole->givePermissionTo($permissionComparaPrecios);


        $adminRolewholesaler->givePermissionTo($permissionConsultoria);
        $adminRolewholesaler->givePermissionTo($permissionServicioTransporte);
        $adminRolewholesaler->givePermissionTo($permissionComparaPrecios);
        $adminRolewholesaler->givePermissionTo($menu);

        $supervisorRolewholesaler->givePermissionTo($permissionConsultoria);
        $supervisorRolewholesaler->givePermissionTo($permissionServicioTransporte);
        $supervisorRolewholesaler->givePermissionTo($permissionComparaPrecios);
        $supervisorRolewholesaler->givePermissionTo($menu);



        User::insert(
            [
                [
                    'national_id' => '73365266',
                    'national_type' => 'dni',
                    'name' => 'Joset Manihuari Yaricahua',
                    'email' => 'jost.manihuari@gamail.com',
                    'telephone' => '968122367',
                    'password' => Hash::make('123456789'),
                    'gasoline_station_id' => null
                ],
                [
                    'national_id' => '73365265',
                    'national_type' => 'dni',
                    'name' => 'Roberto Carlos Bolaños',
                    'email' => 'robert.bolanios@gamail.com',
                    'telephone' => '968122361',
                    'password' => Hash::make('123456789'),
                    'gasoline_station_id' => null
                ],
                [
                    'national_id' => '73365267',
                    'national_type' => 'dni',
                    'name' => 'Carla Diaz',
                    'email' => 'carla.diaz@gamail.com',
                    'telephone' => '968122321',
                    'password' => Hash::make('123456789'),
                    'gasoline_station_id' => null
                ],
                [
                    'national_id' => '73365222',
                    'national_type' => 'dni',
                    'name' => 'Ricardo DIaz',
                    'email' => 'RIcardo.diaz@gamail.com',
                    'telephone' => '918122321',
                    'password' => Hash::make('123456789'),
                    'gasoline_station_id' => null
                ],
            ]
        );

        $users = User::all();
        $adminUser = collect($users)->where('id',1)->first();
        $supervisorUser = collect($users)->where('id',2)->first();

        $adminUser->assignRole(['Admin retailer']);
        $supervisorUser->assignRole(['Supervisor retailer']);



        $adminUserwholesaler = collect($users)->where('id',3)->first();
        $supervisorUserwholesaler = collect($users)->where('id',4)->first();

        $adminUserwholesaler->assignRole(['Admin wholesaler']);
        $supervisorUserwholesaler->assignRole(['Supervisor wholesaler']);


    }
}
