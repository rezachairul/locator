<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;


class UserExport
{
    
    protected $role;

    public function __construct($role = null)
    {
        $this->role = $role;
    }
    public function export()
    {
        // Path ke template
        $templatePath = storage_path('app/templates/temp-export-user.xlsx');

        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        $namept = 'PT. Fajar Anugerah Dinamika';
        $currentDate = Carbon::now();
        $weekYear = 'W' . $currentDate->format('W') . ' ' . $currentDate->year;
        $downloadDate = $currentDate->format('d M Y');

        // Isi header di template
        $sheet->setCellValue('E10', ': '. $namept);
        $sheet->setCellValue('E11', ': '. $weekYear);
        $sheet->setCellValue('E12', ': '. $downloadDate);

        // 🔧 Query user sesuai role
        $query = User::select('id', 'name', 'username', 'email', 'role');

        if ($this->role) {
            $query->where('role', $this->role);
        } else {
            $query->whereIn('role', ['admin', 'operator']);
        }

        $query->whereDate('created_at', Carbon::today());
        $users = $query->orderByRaw("CASE WHEN role = 'admin' THEN 1 ELSE 2 END")->get();

        // Hitung total
        $totalUser = $users->count();
        $totalAdmin = $users->where('role', 'admin')->count();
        $totalOperator = $users->where('role', 'operator')->count();

        // Tulis ke cell sesuai template
        $sheet->setCellValue('D32', ': ' . $totalUser . ' Orang'); // TOTAL USER
        $sheet->setCellValue('D33', ': ' . $totalAdmin . ' Orang'); // ADMIN
        $sheet->setCellValue('D34', ': ' . $totalOperator . ' Orang'); // OPERATOR

        // Mulai baris data dari baris 15
        $startRow = 15;

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

        // 🔥 Tentukan nama role di file
        $roleName = $this->role ? strtoupper($this->role) : 'ALL';

        // Nama file dengan ROLE + Tanggal
        $dateFormatted = $currentDate->format('dmY_His');
        $tempFile = $tempDir . '/Export-User-' . $roleName . '-' . $dateFormatted . '.xlsx';

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Return response download
        return response()->download($tempFile)->deleteFileAfterSend();
    }

}
