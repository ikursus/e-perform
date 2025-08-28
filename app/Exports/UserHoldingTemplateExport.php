<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class UserHoldingTemplateExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    protected $sampleData;

    public function __construct($sampleData = [])
    {
        $this->sampleData = $sampleData;
    }

    /**
     * Return the array data for export.
     */
    public function array(): array
    {
        return $this->sampleData;
    }

    /**
     * Define the headings for the Excel file.
     */
    public function headings(): array
    {
        return [
            'fund_name',
            'fund_code', 
            'date',
            'trans_type',
            'tot_inv',
            'nav',
            'cur_val',
            'Unreal_pl_myr',
            'Unreal_pl_percent'
        ];
    }

    /**
     * Define column widths.
     */
    public function columnWidths(): array
    {
        return [
            'A' => 50,  // fund_name
            'B' => 15,  // fund_code
            'C' => 15,  // date
            'D' => 15,  // trans_type
            'E' => 15,  // tot_inv
            'F' => 10,  // nav
            'G' => 15,  // cur_val
            'H' => 15,  // Unreal_pl_myr
            'I' => 18,  // Unreal_pl_percent
        ];
    }

    /**
     * Apply styles to the worksheet.
     */
    public function styles(Worksheet $sheet)
    {
        // Style the header row
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '155E75'] // Dark blue-green
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ]);

        // Style data rows if sample data exists
        if (!empty($this->sampleData)) {
            $lastRow = count($this->sampleData) + 1;
            $sheet->getStyle("A2:I{$lastRow}")->applyFromArray([
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC']
                    ]
                ]
            ]);

            // Style numeric columns
            $sheet->getStyle("E2:I{$lastRow}")->applyFromArray([
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT
                ]
            ]);
        }

        // Add instructions below the data
        $instructionRow = count($this->sampleData) + 3;
        $sheet->setCellValue("A{$instructionRow}", 'ARAHAN PENGGUNAAN TEMPLATE:');
        $sheet->getStyle("A{$instructionRow}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '155E75']]
        ]);

        $instructions = [
            '1. fund_name: Nama penuh dana/fund',
            '2. fund_code: Kod dana (contoh: PM1, PM2, dll)',
            '3. date: Tarikh transaksi (format: dd/mm/yyyy)',
            '4. trans_type: Jenis transaksi (SA=Subscription, SW=Switch, RD=Redemption, DV=Dividend)',
            '5. tot_inv: Jumlah pelaburan (angka sahaja, tanpa koma)',
            '6. nav: Net Asset Value (angka sahaja)',
            '7. cur_val: Nilai semasa (angka sahaja, tanpa koma)',
            '8. Unreal_pl_myr: Untung/Rugi belum direalisasi dalam RM',
            '9. Unreal_pl_percent: Untung/Rugi belum direalisasi dalam peratus'
        ];

        foreach ($instructions as $index => $instruction) {
            $row = $instructionRow + $index + 1;
            $sheet->setCellValue("A{$row}", $instruction);
            $sheet->getStyle("A{$row}")->applyFromArray([
                'font' => ['size' => 10],
                'alignment' => ['wrapText' => true]
            ]);
        }

        // Merge cells for instructions
        foreach ($instructions as $index => $instruction) {
            $row = $instructionRow + $index + 1;
            $sheet->mergeCells("A{$row}:I{$row}");
        }

        return $sheet;
    }
}