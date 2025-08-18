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

        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->string('name');       // nama file user-friendly
            $table->string('type');       // ecw / mbtiles / tif / tiff
            $table->string('filename');   // nama file maps di storage
            $table->string('path');       // path file maps
            $table->bigInteger('size')->nullable();

            // Kolom baru untuk file points
            $table->string('point_filename')->nullable(); // nama file JSON / GeoJSON
            $table->string('point_path')->nullable();     // path file point

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maps');
    }
};
