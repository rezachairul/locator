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
        Schema::create('operasionals', function (Blueprint $table) {
            $table->id();
            $table->string('pit');
            $table->foreignId('loading_unit_id')->constrained('excas')->onDelete('cascade');
            $table->string('dop');
            $table->foreignId('dumping_id')->constrained('dumpings')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operasionals');
    }
};
