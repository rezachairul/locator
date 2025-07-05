<?php
namespace App\Exports;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Models\Weather;
use App\Models\Material;
use App\Models\Waterdepth;
use App\Models\Operasional;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

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
        // Ambil semua material untuk header dinamis
        // =========================
        $materials = Material::all();
        $startColIndex = 17;

        // Tulis "MATERIAL" di kolom Q15
        $sheet->setCellValue('Q14', 'MATERIAL');

        // Jika ingin merge cell Q14 dan Q15 sampai kolom terakhir material
        $lastColIndex = 16 + count($materials); // Q=16
        $lastColLetter = Coordinate::stringFromColumnIndex($lastColIndex);
        // Merge Q14 sampai kolom terakhir di baris 15
        $sheet->mergeCells("Q14:{$lastColLetter}15");

        // Atur alignment rata tengah horizontal dan vertikal
        $sheet->getStyle("Q14:{$lastColLetter}15")->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);


        // Header material di baris 16
        foreach ($materials as $index => $material) {
            $colLetter = Coordinate::stringFromColumnIndex(17 + $index);
            $singkatan = strtoupper(substr($material->name,0,3));
            $sheet->setCellValue($colLetter . '16', $singkatan);
        }

        // ============================
        // GENERATE DAN TULIS DATA WATERDEPTH & WEATHER
        // ============================

        // Tentukan bulan dan tahun saat ini
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        // Ambil jumlah hari dalam bulan ini
        $daysInMonth = Carbon::now()->daysInMonth;

        // Generate tanggal dari 1 sampai jumlah hari
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($year, $month, $day);
            $row = 27 + $day;

            // Ambil data waterdepth sesuai tanggal
            $waterdepth = Waterdepth::whereDate('created_at', $date)->first();

            // Ambil data weather sesuai tanggal
            $weather = Weather::whereDate('created_at', $date)->first();

            // ====================
            // Tulis ke WATERDEPTH
            // ====================
            $sheet->setCellValue('B'.$row, $date->format('d')); // Tanggal
            $sheet->setCellValue('E'.$row, $waterdepth->qsv_1 ?? '0.0'); // sump_qsv1
            $sheet->setCellValue('G'.$row, $waterdepth->h4 ?? '0.0'); // sump_h4

            // ====================
            // Tulis ke WEATHER
            // ====================
            $sheet->setCellValue('L'.$row, $date->format('d')); // Tanggal
            $sheet->setCellValue('N'.$row, $weather->curah_hujan ?? '0.0'); // curah hujan
        }

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

            // =========================
            // Ceklis material sesuai data operasional
            // =========================
            foreach ($materials as $index => $material) {
                $colLetter = Coordinate::stringFromColumnIndex($startColIndex + $index);
                if ($op->material && strtolower($op->material->name) == strtolower($material->name)) {
                    $sheet->setCellValue($colLetter . $row, '✔');
                }
            }
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
