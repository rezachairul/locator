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
            $table->float('easting');
            $table->float('northing');
            $table->float('elevation_rl');
            $table->float('elevation_actual');
            $table->float('front_width');
            $table->float('front_height');
            // $table->foreignId('material_id');
            // $table->enum('material',['s', 'm', 'c', 'b', 'nb', 'otr']);
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
