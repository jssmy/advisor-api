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
        Schema::create('seller_services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 155);
            $table->json('planes'); // [{price: '12.3', 'period_time' : 15, 'inTime : 'days' , 'name' : 'Presio mensual'}]
            $table->json('services_includes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_services');
    }
};
