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
        Schema::create('incident_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_report_id')->constrained('user_reports')->onDelete('cascade');
            $table->string('status')->default('none')->after('user_report_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_users');
    }
};
