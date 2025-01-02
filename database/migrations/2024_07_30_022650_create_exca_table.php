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
            $table->enum('pit',['qsv1s', 'qsv3']);
            $table->enum('loading_unit',['fex400_441', 'fex400_419', 'fex400_449', 'fex400_454', 'fex400_456']);
            $table->foreignId('dumping_id');
            $table->decimal('easting');
            $table->decimal('northing');
            $table->decimal('elevation_rl');
            $table->decimal('elevation_actual');
            $table->float('front_width');
            $table->float('front_height');
            $table->foreignId('material_id');
            $table->char('dop');
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
