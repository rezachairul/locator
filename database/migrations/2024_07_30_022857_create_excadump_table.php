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
        // Schema::create('excadump', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('exca_id');
        //     $table->unsignedBigInteger('dump_id');
        //     $table->timestamps();
        //     $table->foreign('exca_id')->references('id')->on('exca')->onDelete('cascade');
        //     $table->foreign('dump_id')->references('id')->on('dumping')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excadump');
    }
};
