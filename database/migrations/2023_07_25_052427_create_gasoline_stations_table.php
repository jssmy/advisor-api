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
        Schema::create('gasoline_stations', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->char('ruc',12)->unique();
            $table->enum('company_type',['retailer','wholesaler'])
                ->default('retailer');
            $table->string('company_name');
            $table->json('images');
            $table->json('location')->nullable();
            $table->boolean('state')->default(true);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gasoline_stations');
    }
};

