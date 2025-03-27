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
        Schema::create('excas', function (Blueprint $table) {
            $table->id();
            $table->string('loading_unit');
            $table->decimal('easting');
            $table->decimal('northing');
            $table->decimal('elevation_rl');
            $table->decimal('elevation_actual');
            $table->float('front_width');
            $table->float('front_height');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excas');
    }
};
