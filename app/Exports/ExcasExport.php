<?php

// namespace App\Exports;

// use App\Models\Exca;
// use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class ExcasExport implements FromCollection
// {
//     use Exportable;
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Exca::all();
//     }
// }


namespace App\Exports;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcasExport
{
    private $data;

    public function collection($data)
    {
        $this->data = $data;
    }

    public function export()
    {
        // Path ke template Excel
        $templatePath = storage_path('app/templates/template-Load-Waste.xls');

        // Pastikan file template ada
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        // Load template sebagai Spreadsheet
        $spreadsheet = IOFactory::load($templatePath);

        // Ambil worksheet pertama
        $sheet = $spreadsheet->getActiveSheet();

        // Masukkan data ke template (contoh data mulai dari baris 17)
        $row = 17;
        $number = 1;
        foreach ($this->data as $item) {
            $sheet->setCellValue("B{$row}", $number);
            $sheet->setCellValue("C{$row}", $item['pit']);
            $sheet->setCellValue("D{$row}", $item['loading_unit']);
            $sheet->setCellValue("E{$row}", $item['easting']);
            $sheet->setCellValue("F{$row}", $item['northing']);
            $sheet->setCellValue("G{$row}", $item['elevation_rl']);
            $sheet->setCellValue("H{$row}", $item['elevation_actual']);
            $sheet->setCellValue("I{$row}", $item['dop']);
            $sheet->setCellValue("J{$row}", $item['front_width']);
            $sheet->setCellValue("K{$row}", $item['front_height']);
            $sheet->setCellValue("L{$row}", $item['dumping_id']);
            $sheet->setCellValue("Q{$row}", $item['material_id']);
            $row++;
            $number++; // Increment nomor urut
        }

        // Simpan file Excel yang telah dimodifikasi ke storage sementara
        $tempDir = storage_path('app/templates');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $tempFile = $tempDir . '/Pemantauan Loading Point dan Dumping Point.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        return response()->download($tempFile)->deleteFileAfterSend();
    }
}




// namespace App\Exports;

// use App\Models\Exca;
// use Maatwebsite\Excel\Concerns\Exportable;
// use PhpOffice\PhpSpreadsheet\IOFactory;

// class ExcasExport
// {
//     use Exportable;

//     public function collection()
//     {
//         // Path template Excel
//         $templatePath = storage_path('app/templates/template-Load-Waste.xlsx');
//         $outputPath = storage_path('app/public/exports/Load_Point_Output.xlsx');

//         // Pastikan file template ada
//         if (!file_exists($templatePath)) {
//             return response()->json(['message' => 'Template file not found'], 404);
//         }

//         // Load template Excel
//         $spreadsheet = IOFactory::load($templatePath);
//         $worksheet = $spreadsheet->getActiveSheet();

//         // Isi data dari database
//         $data = Exca::all();
//         $startRow = 17; // Baris awal untuk data

//         foreach ($data as $key => $row) {
//             $worksheet->setCellValue('B' . ($startRow + $key), $key + 1); // No
//             $worksheet->setCellValue('C' . ($startRow + $key), $row->pit);
//             $worksheet->setCellValue('D' . ($startRow + $key), $row->loading_unit);
//             $worksheet->setCellValue('E' . ($startRow + $key), $row->easting);
//             $worksheet->setCellValue('F' . ($startRow + $key), $row->northing);
//             $worksheet->setCellValue('G' . ($startRow + $key), $row->elevation_rl);
//             $worksheet->setCellValue('H' . ($startRow + $key), $row->elevation_actual);
//             $worksheet->setCellValue('I' . ($startRow + $key), $row->dop);
//             $worksheet->setCellValue('J' . ($startRow + $key), $row->front_width);
//             $worksheet->setCellValue('K' . ($startRow + $key), $row->front_height);
//             $worksheet->setCellValue('L' . ($startRow + $key), $row->dumping_id);
//             $worksheet->setCellValue('Q' . ($startRow + $key), $row->material_id);
//         }

//         // Simpan file output
//         $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//         $writer->save($outputPath);

//         // Kembalikan file ke user
//         return response()->download($outputPath)->deleteFileAfterSend();
//     }
// }