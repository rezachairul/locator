<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcasExport
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data->map(function($item){
            return [
                'pit' => $item->pit_label,
                'loading_unit' => $item->loading_unit_label,
                'easting' => $item->easting,
                'northing' => $item->northing,
                'elevation_rl' => $item->elevation_rl,
                'elevation_actual' => $item->elevation_actual,
                // 'dop' => $item->dop,
                'dop' => trim($item->dop),
                'front_width' => $item->front_width,
                'front_height' => $item->front_height,
                'disposial_label' => $item->dumping->disposial_label ?? '-',
                'w-easting' => $item->dumping->easting ?? '-',
                'w-northing' => $item->dumping->northing ?? '-',
                'w-elevation_rl' => $item->dumping->elevation_rl ?? '-',
                'w-elevation_actual' => $item->dumping->elevation_actual ?? '-',
                'material_name' => $item->material->name ?? '-',
            ];
        });
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
            // dd($item); 
            $sheet->setCellValue("B{$row}", $number);
            $sheet->setCellValue("C{$row}", $item['pit']);
            $sheet->setCellValue("D{$row}", $item['loading_unit']);
            $sheet->setCellValue("E{$row}", $item['easting']);
            $sheet->setCellValue("F{$row}", $item['northing']);
            $sheet->setCellValue("G{$row}", $item['elevation_rl']);
            $sheet->setCellValue("H{$row}", $item['elevation_actual']);
            $sheet->setCellValue("I{$row}", trim($item['dop']));
            $sheet->setCellValue("J{$row}", $item['front_width']);
            $sheet->setCellValue("K{$row}", $item['front_height']);
            // Ambil data dari relasi
            $sheet->setCellValue("L{$row}", $item['disposial_label']);
            $sheet->setCellValue("M{$row}", $item['w-easting']);
            $sheet->setCellValue("N{$row}", $item['w-northing']);
            $sheet->setCellValue("O{$row}", $item['w-elevation_rl']);
            $sheet->setCellValue("P{$row}", $item['w-elevation_actual']);
            $sheet->setCellValue("Q{$row}", $item['material_name']);
            $row++;
            $number++; // Increment nomor urut
        }

        // Simpan file Excel yang telah dimodifikasi ke storage sementara
        $tempDir = storage_path('app/templates');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $tempFile = $tempDir . '/Pemantauan Loading Point dan Dumping Point-'.Carbon::now()->timestamp.'.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        return response()->download($tempFile)->deleteFileAfterSend();
    }
}
