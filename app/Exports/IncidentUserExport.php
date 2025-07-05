<?php

namespace App\Exports;

use App\Models\IncidentUser;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class IncidentUserExport
{
    protected $filter;

    // Constructor untuk menerima filter
    public function __construct($filter = 'all')
    {
        $this->filter = $filter;
    }

    public function export()
    {
        try {
            $filter = $this->filter;

            // Path ke template
            $templatePath = storage_path('app/templates/temp-export-user-report.xlsx');

            if (!file_exists($templatePath)) {
                throw new \Exception('Template file not found: ' . $templatePath);
            }

            // Load template
            $spreadsheet = IOFactory::load($templatePath);
            $sheet = $spreadsheet->getActiveSheet();

            // Header info
            $namept = 'PT. Fajar Anugerah Dinamika';
            $currentDate = Carbon::now();
            $weekYear = 'W' . $currentDate->format('W') . ' ' . $currentDate->year;
            $downloadDate = $currentDate->format('d M Y');

            $sheet->setCellValue('E10', ': '. $namept);
            $sheet->setCellValue('E11', ': '. $weekYear);
            $sheet->setCellValue('E12', ': '. $downloadDate);

            // Query data sesuai filter
            $query = IncidentUser::with('user_report');

            if ($filter == 'today') {
                $query->whereDate('created_at', Carbon::today());
            } elseif ($filter == 'last_week') {
                $query->whereBetween('created_at', [
                    Carbon::now()->subWeek()->startOfWeek(),
                    Carbon::now()->subWeek()->endOfWeek(),
                ]);
            } elseif ($filter == 'last_month') {
                $query->whereMonth('created_at', Carbon::now()->subMonth()->month)
                      ->whereYear('created_at', Carbon::now()->subMonth()->year);
            }

            $incidentUsers = $query->get();

            // Isi data ke template
            $startRow = 15;
            $no = 1;

            foreach ($incidentUsers as $incident) {
                $report = $incident->user_report;

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

            // Tentukan folder sementara
            $tempDir = storage_path('app/public/exports');
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0777, true);
            }

            // Nama file sesuai filter + tanggal
            $dateFormatted = $currentDate->format('dmY_His');
            $filterName = strtoupper(str_replace('_', '', $filter)); // contoh: LASTWEEK
            $tempFile = $tempDir . '/Export-IncidentUser-' . $filterName . '-' . $dateFormatted . '.xlsx';

            // Simpan file sementara
            $writer = new Xlsx($spreadsheet);
            $writer->save($tempFile);
            dd('File saved to: ' . $tempFile);

            return response()->download($tempFile)->deleteFileAfterSend();

        } catch (\Exception $e) {
            return back()->with('error', 'Export failed: ' . $e->getMessage());
        }
    }
}
