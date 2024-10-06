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
        Schema::create('weathers', function (Blueprint $table) {
            $table->id();
            $table->enum('cuaca', ['cerah', 'cerah_berawan', 'berawan', 'berawan_tebal', 'hujan_ringan', 'hujan_sedang', 'hujan_lebat', 'hujan_petir', 'kabut']);
            $table->float('curah_hujan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weathers');
    }
};
