<?php

namespace App\Imports;


use App\Models\Exca;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ExcasImport implements ToCollection, WithHeadingRow, WithStartRow
{
    public function startRow(): int
        {
            return 17; // Data dimulai dari baris ke-17
        }
    public function collection(Collection $rows)
    {
        // dd($rows);
        
        foreach ($rows as $row) 
        {
            // dd($row->toArray());
            try {
                // Pastikan header dan data yang dibutuhkan tersedia
                if (!$this->isValidRow($row)) {
                    throw new \Exception('Header atau data yang dibutuhkan tidak ditemukan.');
                }

                // Buat data baru di database
                Exca::create([
                    'pit' => $row['PIT'], // Header sesuai dengan file Excel
                    'loading_unit' => trim($row['LOADING UNIT']),
                    'easting' => (float) $row['EASTING'],
                    'northing' => (float) $row['NORTHING'],
                    'elevation_rl' => (int) $row['RL'],
                    'elevation_actual' => (float) $row['ACTUAL'],
                    'dop' => $row['DOP'],
                    'front_width' => trim((float) $row['FRONT WIDTH (METER)']),
                    'front_height' => trim((float) $row['FRONT HEIGHT (METER)']),
                    'disposial_label' => trim($row['NAMA DISPOSIAL']),
                    'material_name' => $row['MATERIAL'],
                ]);
            } catch (\Exception $e) {
                // Log error atau tambahkan penanganan error lain
                Log::error('Gagal mengimpor data: ' . $e->getMessage());
                continue; // Lanjutkan ke baris berikutnya jika ada error
            }
        }
    }

    /**
     * Validasi apakah row valid dan memiliki semua header yang dibutuhkan.
     */
    private function isValidRow($row): bool
    {
        $requiredHeaders = [
            'PIT', 'LOADING UNIT', 'EASTING', 'NORTHING', 'RL', 'ACTUAL',
            'DOP', 'FRONT WIDTH (METER)', 'FRONT HEIGHT (METER)', 'NAMA DISPOSIAL', 'MATERIAL'
        ];

        foreach ($requiredHeaders as $header) {
            if (!isset($row[$header])) {
                return false;
            }
        }

        return true;
    }
}
