<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomExport implements FromCollection, WithHeadings,ShouldAutoSize, WithStyles, WithCustomStartCell
{
    protected $rows;
    protected $heading;
    protected $title;

    function __construct($headings,$rows,$title) {
        $this->rows = $rows;
        $this->heading = $headings;
        $this->title = $title;
    }

    public function collection()
    {
        return collect($this->rows);
    }

    public function headings(): array
    {
        return array($this->heading);
    }

    public function styles(Worksheet $sheet)
    {
        $cells = $this->headingCellLength();
        $startCells = $this->startCellLength();
        $sheet->mergeCells($cells);
        $sheet->setCellValue('A1',$this->title);
        $sheet->getStyle('A1')->getFont();
        $sheet->getStyle($cells)->getFont()->setBold(true);
        $sheet->getStyle($startCells)->getFont()->setBold(true);
        $sheet->getStyle('A1')->applyFromArray(
            [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'font' => [
                    'bold' => true,
                    'size' => 25
                ],

            ]
        );
    }

    public function headingCellLength(): string
    {
        $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        return 'A1:'.$string[count($this->heading)-1].'1';
    }

    public function startCellLength(): string
    {
        $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        return 'A2:'.$string[count($this->heading)-1].'2';
    }

    public function startCell(): string
    {
        return 'A2';
    }

}
