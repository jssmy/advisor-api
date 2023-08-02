<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //users
        Schema::table('users', function (Blueprint $table) {

            $table->foreignId('created_by_user_id')
                ->nullable()
                ->references('id')
                ->on('users');

            $table->foreignId('gasoline_station_id')
                ->nullable()
                ->references('id')
                ->on('gasoline_stations');
        });

        //gasoline stations

        Schema::table('gasoline_stations', function (Blueprint $table) {

            $table->foreignId('station_has_gasoline_station_id')
                ->nullable()
                ->references('id')
                ->on('gasoline_stations');
        });

        // contracted seller services
        Schema::table('seller_services_contracts', function (Blueprint $table) {

            $table->foreignId('seller_service_id')
            ->references('id')
            ->on('seller_services');

            $table->foreignId('gasoline_station_id')
                ->references('id')
                ->on('gasoline_stations');

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign('users_gasoline_station_id_foreign');
            $table->dropColumn('gasoline_station_id');

            $table->dropForeign('users_created_by_user_id_foreign');
            $table->dropColumn('created_by_user_id');

        });

        Schema::table('gasoline_stations', function (Blueprint $table) {
            $table->dropForeign('gasoline_stations_station_has_gasoline_station_id_foreign');
            $table->dropColumn('station_has_gasoline_station_id');
        });

        // contracted seller services
        Schema::table('seller_services_contracts', function (Blueprint $table) {

            $table->dropForeign('seller_services_contracts_seller_service_id_foreign');
            $table->dropColumn('seller_service_id');

            $table->dropForeign('seller_services_contracts_gasoline_station_id_foreign');
            $table->dropColumn('gasoline_station_id');

        });
    }
};
