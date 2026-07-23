<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class ReportSalesExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize,
    WithStyles,
    WithColumnFormatting,
    WithEvents
{
    protected Collection $reports;
public function registerEvents(): array
{
    return [

        AfterSheet::class => function (AfterSheet $event) {

            $sheet = $event->sheet->getDelegate();

            $lastColumn = $sheet->getHighestColumn();
            $lastRow = $sheet->getHighestRow();

            // Auto Filter
            $sheet->setAutoFilter("A1:{$lastColumn}{$lastRow}");

       // ===============================
// BARIS TOTAL
// ===============================

$totalRow = $lastRow + 1;

$sheet->setCellValue("A{$totalRow}", "TOTAL");

$totals = [

    'H' => $this->reports->sum('renewal_trx'),
    'I' => $this->reports->sum('renewal_rev'),

    'J' => $this->reports->sum('voucher_trx'),
    'K' => $this->reports->sum('voucher_rev'),

    'L' => $this->reports->sum('sa_sp_trx'),
    'M' => $this->reports->sum('sa_sp_rev'),

    'N' => $this->reports->sum('sa_byu_trx'),
    'O' => $this->reports->sum('sa_byu_rev'),

    'P' => $this->reports->sum('mytelkomsel_trx'),

    'Q' => $this->reports->sum('halo_trx'),
    'R' => $this->reports->sum('halo_rev'),

    'S' => $this->reports->sum('orbit_trx'),
    'T' => $this->reports->sum('orbit_rev'),

    'U' => $this->reports->sum('nomor_spesial_trx'),
    'V' => $this->reports->sum('nomor_spesial_rev'),

    'W' => $this->reports->sum('total_trx'),
    'X' => $this->reports->sum('total_rev'),

];

foreach ($totals as $column => $value) {

    $sheet->setCellValue(
        "{$column}{$totalRow}",
        $value
    );

}

$sheet->getStyle("A{$totalRow}:{$lastColumn}{$totalRow}")
    ->getFont()
    ->setBold(true);

$sheet->getStyle("A{$totalRow}:{$lastColumn}{$totalRow}")
    ->getFill()
    ->setFillType(Fill::FILL_SOLID);

$sheet->getStyle("A{$totalRow}:{$lastColumn}{$totalRow}")
    ->getFill()
    ->getStartColor()
    ->setRGB('FFF2CC');

            // Tinggi Header
            $sheet->getRowDimension(1)->setRowHeight(25);

            // Tengah Vertikal
            $sheet->getStyle("A1:{$lastColumn}{$lastRow}")
                ->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        }

    ];
}
    public function __construct(Collection $reports)
{
    $this->reports = $reports;
}

    public function collection()
{
    return $this->reports
        ->values()
        ->map(function ($report, $index) {

            return [

                'No' => $index + 1,

                'Tanggal' => optional($report->report_date)->format('d-m-Y'),

                'Direct Sales' => $report->user?->name,

                'Site ID' => $report->site?->site_id,

                'Site Name' => $report->site?->site_name,

                'Branch' => $report->site?->branch,

                'Cluster' => $report->site?->cluster,

                'Renewal TRX' => $report->renewal_trx,
                'Renewal REV' => $report->renewal_rev,

                'Voucher TRX' => $report->voucher_trx,
                'Voucher REV' => $report->voucher_rev,

                'SA SP TRX' => $report->sa_sp_trx,
                'SA SP REV' => $report->sa_sp_rev,

                'SA BYU TRX' => $report->sa_byu_trx,
                'SA BYU REV' => $report->sa_byu_rev,

                'MyTelkomsel TRX' => $report->mytelkomsel_trx,

                'Halo TRX' => $report->halo_trx,
                'Halo REV' => $report->halo_rev,

                'Orbit TRX' => $report->orbit_trx,
                'Orbit REV' => $report->orbit_rev,

                'Nomor Spesial TRX' => $report->nomor_spesial_trx,
                'Nomor Spesial REV' => $report->nomor_spesial_rev,

                'Total TRX' => $report->total_trx,
                'Total REV' => $report->total_rev,

            ];

        });
}

    public function headings(): array
    {
        return [

    'No',

    'Tanggal',
            'Direct Sales',
            'Site ID',
            'Site Name',
            'Branch',
            'Cluster',

            'Renewal TRX',
            'Renewal REV',

            'Voucher TRX',
            'Voucher REV',

            'SA SP TRX',
            'SA SP REV',

            'SA BYU TRX',
                        'SA BYU REV',

            'MyTelkomsel TRX',

            'Halo TRX',
            'Halo REV',

            'Orbit TRX',
            'Orbit REV',

            'Nomor Spesial TRX',
            'Nomor Spesial REV',

            'Total TRX',
            'Total REV',

        ];
    }

    public function styles(Worksheet $sheet)
{
    $lastColumn = $sheet->getHighestColumn();
    $lastRow = $sheet->getHighestRow();

    // Styling Header
    $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([

        'font' => [
            'bold' => true,
            'size' => 11,
            'color' => [
                'rgb' => 'FFFFFF'
            ],
        ],

        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => '003E7E'
            ],
        ],

        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],

    ]);

    // Border seluruh tabel
    $sheet->getStyle("A1:{$lastColumn}{$lastRow}")
        ->getBorders()
        ->getAllBorders()
        ->setBorderStyle(Border::BORDER_THIN);

        // Semua cell rata tengah vertikal
$sheet->getStyle("A1:{$lastColumn}{$lastRow}")
    ->getAlignment()
    ->setVertical(Alignment::VERTICAL_CENTER);

// Header rata tengah
$sheet->getStyle("A1:{$lastColumn}1")
    ->getAlignment()
    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

    // Tinggi Header
    $sheet->getRowDimension(1)->setRowHeight(30);

    // Wrap text header
$sheet->getStyle("A1:{$lastColumn}1")
    ->getAlignment()
    ->setWrapText(true);

    // Freeze Header
    $sheet->freezePane('A2');

    return [];
}

    public function columnFormats(): array
    {
        return [

    'I' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
    'K' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
    'M' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
    'O' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
    'R' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
    'T' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
    'V' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
    'X' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,

];
    }
}