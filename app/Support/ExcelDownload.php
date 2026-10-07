<?php

namespace App\Support;

use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExcelDownload
{
    /**
     * @param  array<int, string>  $headers
     * @param  iterable<array<int, mixed>>  $rows
     * @param  array<int, int>  $textColumns  One-based spreadsheet column indexes.
     */
    public static function download(
        string $filename,
        string $sheetTitle,
        array $headers,
        iterable $rows,
        array $textColumns
    ): StreamedResponse {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle($sheetTitle);
        $sheet->fromArray($headers, null, 'A1');
        $sheet->getStyle('1:1')->getFont()->setBold(true);
        $sheet->freezePane('A2');

        foreach ($rows as $rowNumber => $row) {
            $excelRow = $rowNumber + 2;

            foreach (array_values($row) as $columnOffset => $value) {
                $column = $columnOffset + 1;
                $cell = $sheet->getCell([$column, $excelRow]);

                if (in_array($column, $textColumns, true)) {
                    $cell->setValueExplicit(
                        $value === null ? '' : (string) $value,
                        DataType::TYPE_STRING
                    );
                } else {
                    $cell->setValue($value);
                }
            }
        }

        $sheet->setAutoFilter($sheet->calculateWorksheetDimension());

        for ($column = 1; $column <= count($headers); $column++) {
            $sheet->getColumnDimensionByColumn($column)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(
            static function () use ($writer): void {
                $writer->save('php://output');
            },
            $filename,
            ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
        );
    }
}
