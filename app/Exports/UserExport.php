<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;


class UserExport
{
    public function export()
    {
        // Path ke template
        $templatePath = storage_path('app/templates/temp-export-user.xlsx');

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

        // Ambil data user admin & operator
        $users = User::select('id', 'name', 'username', 'email', 'role')
            ->whereIn('role', ['admin', 'operator'])
            ->orderByRaw("CASE role WHEN 'admin' THEN 1 WHEN 'operator' THEN 2 END")
            ->get();

        // Mulai baris data dari baris 15
        $startRow = 15;

        // Hitung total
        $totalUser = $users->count();
        $totalAdmin = $users->where('role', 'admin')->count();
        $totalOperator = $users->where('role', 'operator')->count();

        // Tulis ke cell sesuai template
        $sheet->setCellValue('D32', ': ' . $totalUser . ' Orang'); // TOTAL USER
        $sheet->setCellValue('D33', ': ' . $totalAdmin . ' Orang'); // ADMIN
        $sheet->setCellValue('D34', ': ' . $totalOperator . ' Orang'); // OPERATOR

        foreach ($users as $i => $user) {
            $row = $startRow + $i;

            $sheet->setCellValue('B'.$row, $user->id); // NO (ID)
            $sheet->setCellValue('C'.$row, $user->name); // NAME
            $sheet->setCellValue('D'.$row, $user->username); // USERNAME
            $sheet->setCellValueExplicit('E'.$row, $user->email, DataType::TYPE_STRING); // EMAIL
            $sheet->setCellValue('F'.$row, $user->role); // ROLE
        }

        // Tentukan folder sementara
        $tempDir = storage_path('app/public/exports');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Nama file dengan tanggal
        $dateFormatted = $currentDate->format('dmY');
        $tempFile = $tempDir . '/Export-User-' . $dateFormatted . '.xlsx';

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Return response download
        return response()->download($tempFile)->deleteFileAfterSend();
    }
}
