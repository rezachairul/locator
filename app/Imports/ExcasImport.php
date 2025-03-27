<?php

namespace App\Imports;


use App\Models\Exca;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
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
    }


}
