<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Exporter
{
    static public function exportTrainingInfo($trainingId, $db)
    {
        $trainingInfo = $db->getTrainingInfo($trainingId);
        $app_types = $db->getAppTypes();
        $trainingType = '';

        foreach ($app_types as $type)
        {
            if($type['app_id'] == $trainingId)
            {
                $trainingType = $type['app_type'];
            }
        }

        $timestamp = time();
        $filename = "$trainingType".'_'."$timestamp.xlsx";

        //create new spreadsheet and select it
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Date Submitted');
        $sheet->setCellValue('B1', 'Application Status');
        $sheet->setCellValue('C1', 'First Name');
        $sheet->setCellValue('D1', 'Last Name');
        $sheet->setCellValue('E1', 'Phone #');
        $sheet->setCellValue('F1', 'Email');
        $sheet->setCellValue('G1', 'Special Needs');
        $sheet->setCellValue('H1', 'Service Animal');
        $sheet->setCellValue('I1', 'Mobility Need');
        $sheet->setCellValue('J1', 'Needs a Room');
        $sheet->setCellValue('K1', 'Wants a Single Room');
        $sheet->setCellValue('L1', 'Days they Need a Room');
        $sheet->setCellValue('M1', 'Their Gender');
        $sheet->setCellValue('N1', 'Requested Roommate Gender');
        $sheet->setCellValue('O1', 'CPAP User');
        $sheet->setCellValue('P1', "Doesn't mind CPAP using Roommate");
        $sheet->fromArray($trainingInfo, NULL, 'A2');

        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        self::downloadFile($filename);
    }

    static function downloadFile($file)
    {
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            unlink($file);
            exit;
        }
    }
}