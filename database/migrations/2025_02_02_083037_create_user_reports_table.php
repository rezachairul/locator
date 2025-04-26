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
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->string('victim_name');
            $table->integer('victim_age')->nullable();
            $table->string('injury_category'); // pilihan: Ringan, Sedang, Berat, Fatal
            $table->string('activity');
            $table->string('incident_type'); // pilihan: Tertimpa, Tergelincir, dll
            $table->dateTime('incident_date_time');
            $table->string('incident_location');
            $table->string('asset_damage'); // pilihan: Ya, Tidak
            $table->string('environmental_impact'); // pilihan: Ya, Tidak
            $table->text('incident_description');
            $table->string('report_by');
            $table->dateTime('report_date_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reports');
    }
};
