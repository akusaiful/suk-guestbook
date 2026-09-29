<?php

namespace App\Exports;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class VisitorsExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithEvents,
    WithColumnWidths
{
    public function __construct(
        protected ?int $eventId = null,
        protected ?string $search = null
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Query Data
    |--------------------------------------------------------------------------
    */

    public function query(): Builder
    {
        $query = Visitor::query()
            ->with('event')
            ->orderByDesc('created_at')
            ->orderByDesc('id');

        /*
        |--------------------------------------------------------------------------
        | Filter Event
        |--------------------------------------------------------------------------
        */

        if ($this->eventId) {
            $query->where('event_id', $this->eventId);
        }

        /*
        |--------------------------------------------------------------------------
        | Carian Nama / IC / Organisasi
        |--------------------------------------------------------------------------
        */

        if ($this->search !== null && $this->search !== '') {

            $search = trim($this->search);

            $query->where(function (Builder $q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere(
                        'ic_number',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'organization',
                        'like',
                        '%' . $search . '%'
                    );

            });
        }

        return $query;
    }

    /*
    |--------------------------------------------------------------------------
    | Heading Excel
    |--------------------------------------------------------------------------
    */

    public function headings(): array
    {
        return [
            'Bil',
            'Nama',
            'No. Kad Pengenalan',
            'Organisasi / Jabatan',
            'Telefon',
            'Email',
            'Event ID',
            'Nama Event',
            'Tarikh / Masa',
            'Kaedah Pendaftaran',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Mapping Data
    |--------------------------------------------------------------------------
    */

    public function map($visitor): array
    {
        static $bil = 0;

        $bil++;

        return [
            $bil,
            $visitor->name ?? '-',
            $visitor->ic_number ?? '-',
            $visitor->organization ?? '-',
            $visitor->phone ?? '-',
            $visitor->email ?? '-',
            $visitor->event_id
                ? '#' . $visitor->event_id
                : '-',
            $visitor->event?->name ?? '-',
            $visitor->created_at?->format('d/m/Y H:i') ?? '-',
            $visitor->registration_method ?? '-',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Column Width
    |--------------------------------------------------------------------------
    */

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 28,
            'C' => 22,
            'D' => 30,
            'E' => 18,
            'F' => 30,
            'G' => 12,
            'H' => 45,
            'I' => 22,
            'J' => 22,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Excel Events
    |--------------------------------------------------------------------------
    */

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                /*
                |--------------------------------------------------------------------------
                | Tambah 3 baris untuk Tajuk
                |--------------------------------------------------------------------------
                */

                $sheet->insertNewRowBefore(1, 3);

                /*
                |--------------------------------------------------------------------------
                | Tajuk Utama
                |--------------------------------------------------------------------------
                */

                $sheet->mergeCells('A1:J1');

                $sheet->setCellValue(
                    'A1',
                    'MELAKA DIGITAL GUESTBOOK'
                );

                /*
                |--------------------------------------------------------------------------
                | Sub Tajuk
                |--------------------------------------------------------------------------
                */

                $sheet->mergeCells('A2:J2');

                $sheet->setCellValue(
                    'A2',
                    'SENARAI PENGUNJUNG'
                );

                /*
                |--------------------------------------------------------------------------
                | Tarikh Export
                |--------------------------------------------------------------------------
                */

                $sheet->mergeCells('A3:J3');

                $sheet->setCellValue(
                    'A3',
                    'Tarikh Export: ' . now()->format('d/m/Y H:i')
                );

                /*
                |--------------------------------------------------------------------------
                | Style Tajuk Utama
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A1:J1')->applyFromArray([

                    'font' => [
                        'bold' => true,
                        'size' => 18,
                        'color' => [
                            'rgb' => 'FFFFFF',
                        ],
                    ],

                    'fill' => [
                        'fillType' => 'solid',
                        'color' => [
                            'rgb' => '861B24',
                        ],
                    ],

                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],

                ]);

                /*
                |--------------------------------------------------------------------------
                | Style Sub Tajuk
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A2:J2')->applyFromArray([

                    'font' => [
                        'bold' => true,
                        'size' => 13,
                        'color' => [
                            'rgb' => '861B24',
                        ],
                    ],

                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],

                ]);

                /*
                |--------------------------------------------------------------------------
                | Style Tarikh Export
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A3:J3')->applyFromArray([

                    'font' => [
                        'italic' => true,
                        'size' => 10,
                        'color' => [
                            'rgb' => '6B7280',
                        ],
                    ],

                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],

                ]);

                /*
                |--------------------------------------------------------------------------
                | Header Jadual
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A4:J4')->applyFromArray([

                    'font' => [
                        'bold' => true,
                        'color' => [
                            'rgb' => 'FFFFFF',
                        ],
                    ],

                    'fill' => [
                        'fillType' => 'solid',
                        'color' => [
                            'rgb' => '861B24',
                        ],
                    ],

                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],

                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin',
                            'color' => [
                                'rgb' => 'D1D5DB',
                            ],
                        ],
                    ],

                ]);

                /*
                |--------------------------------------------------------------------------
                | Highest Row
                |--------------------------------------------------------------------------
                */

                $highestRow = $sheet->getHighestRow();

                /*
                |--------------------------------------------------------------------------
                | Border Semua Data
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    'A4:J' . $highestRow
                )->getBorders()->getAllBorders()->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                );

                /*
                |--------------------------------------------------------------------------
                | Alignment Data
                |--------------------------------------------------------------------------
                */

                if ($highestRow >= 5) {

                    $sheet->getStyle(
                        'A5:A' . $highestRow
                    )->getAlignment()->setHorizontal('center');

                    $sheet->getStyle(
                        'G5:G' . $highestRow
                    )->getAlignment()->setHorizontal('center');

                    $sheet->getStyle(
                        'I5:I' . $highestRow
                    )->getAlignment()->setHorizontal('center');

                    $sheet->getStyle(
                        'J5:J' . $highestRow
                    )->getAlignment()->setHorizontal('center');

                }

                /*
                |--------------------------------------------------------------------------
                | Vertical Alignment + Wrap
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    'A4:J' . $highestRow
                )->getAlignment()->setVertical('center');

                $sheet->getStyle(
                    'A4:J' . $highestRow
                )->getAlignment()->setWrapText(true);

                /*
                |--------------------------------------------------------------------------
                | Row Height
                |--------------------------------------------------------------------------
                */

                $sheet->getRowDimension(1)->setRowHeight(32);

                $sheet->getRowDimension(2)->setRowHeight(24);

                $sheet->getRowDimension(3)->setRowHeight(20);

                $sheet->getRowDimension(4)->setRowHeight(30);

                /*
                |--------------------------------------------------------------------------
                | Freeze Header
                |--------------------------------------------------------------------------
                */

                $sheet->freezePane('A5');

                /*
                |--------------------------------------------------------------------------
                | Auto Filter
                |--------------------------------------------------------------------------
                */

                $sheet->setAutoFilter(
                    'A4:J' . $highestRow
                );

                /*
                |--------------------------------------------------------------------------
                | Print Settings
                |--------------------------------------------------------------------------
                */

                $sheet->getPageSetup()
                    ->setOrientation(
                        \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
                    );

                $sheet->getPageSetup()
                    ->setFitToWidth(1);

                $sheet->getPageSetup()
                    ->setFitToHeight(0);

            },

        ];
    }
}