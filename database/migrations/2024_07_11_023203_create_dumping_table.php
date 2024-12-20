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
        Schema::create('dumpings', function (Blueprint $table) {
            $table->id();
            $table->enum('disposial', ['ipdsidewallutara', 'ss3']);
            $table->float('easting');
            $table->float('northing');
            $table->float('elevation_rl');
            $table->float('elevation_actual');
            $table->foreignId('material_id');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dumpings');
    }
};
