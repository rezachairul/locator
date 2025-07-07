<?php

namespace App\Exports;

use App\Models\UserReport;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class UserReportsExport
{
    public function export()
    {
        try {
            // Path ke template
            $templatePath = storage_path('app/templates/temp-export-user-report.xlsx'); 

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

            // Isi header di template
            $sheet->setCellValue('E10', ': '. $namept);
            $sheet->setCellValue('E11', ': '. $weekYear);
            $sheet->setCellValue('E12', ': '. $downloadDate);

            // Ambil data user reports
            $userReports = UserReport::all();

            // Baris awal data
            $startRow = 15;
            $no = 1;

            foreach ($userReports as $report) {
                $sheet->setCellValue('B' . $startRow, $no);
                $sheet->setCellValue('C' . $startRow, $report->victim_name);
                $sheet->setCellValue('D' . $startRow, $report->victim_age);
                $sheet->setCellValue('E' . $startRow, $report->injury_category);
                $sheet->setCellValue('F' . $startRow, $report->activity);
                $sheet->setCellValue('G' . $startRow, $report->incident_location);
                $sheet->setCellValue('H' . $startRow, $report->incident_type);
                $sheet->setCellValue('I' . $startRow, Carbon::parse($report->incident_date_time)->format('d-m-Y H:i'));
                $sheet->setCellValue('J' . $startRow, $report->asset_damage);
                $sheet->setCellValue('K' . $startRow, $report->environmental_impact);
                $sheet->setCellValue('L' . $startRow, $report->incident_description);
                $sheet->setCellValue('M' . $startRow, $report->report_by);
                $sheet->setCellValue('N' . $startRow, Carbon::parse($report->report_date_time)->format('d-m-Y H:i'));

                $startRow++;
                $no++;
            }

            $tempDir = storage_path('app/public/exports');
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0777, true);
            }

            // Nama file dengan tanggal
            $dateFormatted = Carbon::now()->format('dmY');
            $tempFile = $tempDir . '/Export-User-Report-' . $dateFormatted . '.xlsx';

            // Simpan file sementara
            $writer = new Xlsx($spreadsheet);
            $writer->save($tempFile);

            // Return response download dan hapus file setelah download selesai
            return response()->download($tempFile)->deleteFileAfterSend();

        } catch (\Exception $e) {
            return back()->with('error', 'Export failed: ' . $e->getMessage());
        }
    }
}
