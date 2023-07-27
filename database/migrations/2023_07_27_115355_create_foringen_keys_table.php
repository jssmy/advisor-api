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

            $table->foreignId('grant_id')
                ->references('id')
                ->on('user_grants');

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



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_grant_id_foreign');
            $table->dropColumn('grant_id');

            $table->dropForeign('users_gasoline_station_id_foreign');
            $table->dropColumn('gasoline_station_id');

            $table->dropForeign('users_created_by_user_id_foreign');
            $table->dropColumn('created_by_user_id');

        });

        Schema::table('gasoline_stations', function (Blueprint $table) {
            $table->dropForeign('gasoline_stations_station_has_gasoline_station_id_foreign');
            $table->dropColumn('station_has_gasoline_station_id');
        });
    }
};
