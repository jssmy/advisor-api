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
        Schema::create('station_has_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id')
                ->references('id')
                ->on('gasoline_stations');

            $table->foreignId('service_id')
                ->references('id')
                ->on('station_services');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('station_has_service', function (Blueprint $table) {
            $table->dropForeign('station_has_service_station_id_foreign');
            $table->dropColumn('station_id');

            $table->dropForeign('station_has_service_service_id_foreign');
            $table->dropColumn('service_id');
        });
        Schema::dropIfExists('station_has_service');
    }
};
