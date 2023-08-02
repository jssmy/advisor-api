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
        Schema::create('seller_services_contracts', function (Blueprint $table) {
            $table->id();
            $table->decimal('price');
            $table->integer('period_time');
            $table->enum('in_time', ['days', 'months','years']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_services_contracts');
    }
};
