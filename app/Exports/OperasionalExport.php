<?php
namespace App\Exports;

use App\Models\Operasional;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OperasionalExport
{
    public function export()
    {
        // Path ke template
        $templatePath = storage_path('app/templates/temp-export-operasional.xlsx');

        // Pastikan file ada
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        // Load template
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // Nama PT dan tanggal export
        $namept = 'PT. Fajar Anugerah Dinamika';
        $currentDate = Carbon::now();
        $weekYear = 'W' . $currentDate->format('W') . ' ' . $currentDate->year;
        $downloadDate = $currentDate->format('d M Y');

        // Isi header
        $sheet->setCellValue('E10', ': '. $namept);
        $sheet->setCellValue('E11', ': '. $weekYear);
        $sheet->setCellValue('E12', ': '. $downloadDate);

        // =========================
        // Ambil data operasional
        // =========================
        $data = Operasional::with(['exca', 'dumping', 'material', 'weather', 'waterdepth'])
            ->get();

        $startRow = 17; // baris pertama untuk data sesuai template
        foreach ($data as $i => $op) {
            $row = $startRow + $i;

            // Kolom B adalah awal data (NO) di template-mu
            $sheet->setCellValue('B'.$row, $i + 1); // NO
            $sheet->setCellValue('C'.$row, $op->pit); // PIT
            $sheet->setCellValue('D'.$row, $op->exca->loading_unit ?? '0.0'); // LOADING UNIT

            // LOADING POINT (from exca)
            $sheet->setCellValue('E'.$row, $op->exca->easting ?? '0.0'); // EASTING
            $sheet->setCellValue('F'.$row, $op->exca->northing ?? '0.0'); // NORTHING
            $sheet->setCellValue('G'.$row, $op->exca->elevation_rl ?? '0.0'); // ELEVATION RL
            $sheet->setCellValue('H'.$row, $op->exca->elevation_actual ?? '0.0'); // ELEVATION ACTUAL

            $sheet->setCellValue('I'.$row, $op->dop ?? '-'); // DOP
            $sheet->setCellValue('J'.$row, $op->exca->front_width ?? '0.0'); // FRONT WIDTH
            $sheet->setCellValue('K'.$row, $op->exca->front_height ?? '0.0'); // FRONT HEIGHT

            // WASTE DUMP (from dumping)
            $sheet->setCellValue('L'.$row, $op->dumping->disposial ?? '0.0'); // NAMA DISPOSIAL
            $sheet->setCellValue('M'.$row, $op->dumping->easting ?? '0.0'); // EASTING DUMP
            $sheet->setCellValue('N'.$row, $op->dumping->northing ?? '0.0'); // NORTHING DUMP
            $sheet->setCellValue('O'.$row, $op->dumping->elevation_rl ?? '0.0'); // ELEVATION RL DUMP
            $sheet->setCellValue('P'.$row, $op->dumping->elevation_actual ?? '0.0'); // ELEVATION ACTUAL DUMP

            $sheet->setCellValue('Q'.$row, $op->material->name ?? '-'); // MATERIAL
        }

        // Tentukan folder sementara (misal storage/app/public/exports)
        $tempDir = storage_path('app/public/exports');

        // Pastikan folder temp ada
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $dateFormatted = Carbon::now()->format('dmY');
        $tempFile = $tempDir . '/Operasional-' . $dateFormatted . '.xlsx';

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);
        
        // Return sebagai download dan auto delete
        return response()->download($tempFile)->deleteFileAfterSend();

    }
}
