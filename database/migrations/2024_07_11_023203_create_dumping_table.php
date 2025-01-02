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


// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         // Membuat tabel dumpings
//         Schema::create('dumpings', function (Blueprint $table) {
//             $table->id();
//             $table->enum('disposial', ['ipdsidewallutara', 'ss3']);
//             $table->decimal('easting', 12, 6); // 12 digit total, 6 digit di belakang koma
//             $table->decimal('northing', 12, 6);
//             $table->decimal('elevation_rl', 8, 4); // 8 digit total, 4 digit di belakang koma
//             $table->decimal('elevation_actual', 8, 4);
//             $table->timestamps();
//         });

//         // Membuat fungsi trim_decimal_values
//         DB::statement("
//             CREATE OR REPLACE FUNCTION trim_decimal_values()
//             RETURNS TRIGGER AS $$
//             BEGIN
//                 -- Pangkas angka nol tambahan pada akhir desimal
//                 NEW.easting = TRIM(TRAILING '0' FROM NEW.easting::TEXT)::NUMERIC(12, 6);
//                 NEW.northing = TRIM(TRAILING '0' FROM NEW.northing::TEXT)::NUMERIC(12, 6);
//                 NEW.elevation_rl = TRIM(TRAILING '0' FROM NEW.elevation_rl::TEXT)::NUMERIC(8, 4);
//                 NEW.elevation_actual = TRIM(TRAILING '0' FROM NEW.elevation_actual::TEXT)::NUMERIC(8, 4);

//                 -- Jika titik desimal tidak ada angka di belakang, hilangkan
//                 IF NEW.easting::TEXT LIKE '%.%' THEN
//                     NEW.easting = TRIM(TRAILING '.' FROM NEW.easting::TEXT)::NUMERIC(12, 6);
//                 END IF;
//                 IF NEW.northing::TEXT LIKE '%.%' THEN
//                     NEW.northing = TRIM(TRAILING '.' FROM NEW.northing::TEXT)::NUMERIC(12, 6);
//                 END IF;
//                 IF NEW.elevation_rl::TEXT LIKE '%.%' THEN
//                     NEW.elevation_rl = TRIM(TRAILING '.' FROM NEW.elevation_rl::TEXT)::NUMERIC(8, 4);
//                 END IF;
//                 IF NEW.elevation_actual::TEXT LIKE '%.%' THEN
//                     NEW.elevation_actual = TRIM(TRAILING '.' FROM NEW.elevation_actual::TEXT)::NUMERIC(8, 4);
//                 END IF;

//                 RETURN NEW;
//             END;
//             $$ LANGUAGE plpgsql;
//         ");

//         // Membuat trigger trim_decimal_values_before_insert
//         DB::statement("
//             CREATE TRIGGER trim_decimal_values_before_insert
//             BEFORE INSERT OR UPDATE ON dumpings
//             FOR EACH ROW
//             EXECUTE FUNCTION trim_decimal_values();
//         ");
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         // Hapus trigger dan fungsi terlebih dahulu
//         DB::statement("DROP TRIGGER IF EXISTS trim_decimal_values_before_insert ON dumpings;");
//         DB::statement("DROP FUNCTION IF EXISTS trim_decimal_values;");

//         // Hapus tabel dumpings
//         Schema::dropIfExists('dumpings');
//     }
// };