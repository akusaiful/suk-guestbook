<?php

namespace App\Exports;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VisitorReportExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize
{
    public function __construct(
        protected $eventId = null,
        protected $dateFrom = null,
        protected $dateTo = null
    ) {
    }

    /**
     * Query data pengunjung
     */
    public function query(): Builder
    {
        return Visitor::query()
            ->leftJoin(
                'events',
                'visitors.event_id',
                '=',
                'events.id'
            )
            ->select([
                'visitors.id',
                'visitors.event_id',
                'visitors.name',
                'visitors.ic_number',
                'visitors.organization',
                'visitors.phone',
                'visitors.email',
                'visitors.checked_in_at',
                'visitors.registration_method',
                'events.name as event_name',
            ])

            ->when(
                $this->eventId !== null &&
                $this->eventId !== '',
                function ($query) {

                    $query->where(
                        'visitors.event_id',
                        (int) $this->eventId
                    );

                }
            )

            ->when(
                $this->dateFrom,
                function ($query) {

                    $query->whereDate(
                        'visitors.checked_in_at',
                        '>=',
                        $this->dateFrom
                    );

                }
            )

            ->when(
                $this->dateTo,
                function ($query) {

                    $query->whereDate(
                        'visitors.checked_in_at',
                        '<=',
                        $this->dateTo
                    );

                }
            )

            ->orderByDesc('visitors.checked_in_at')
            ->orderByDesc('visitors.id');
    }


    /**
     * Heading Excel
     */
    public function headings(): array
    {
        return [

            'Bil',
            'Nama',
            'No. Kad Pengenalan',
            'Organisasi',
            'Telefon',
            'Email',
            'Event ID',
            'Event',
            'Kaedah Pendaftaran',
            'Tarikh / Masa',

        ];
    }


    /**
     * Mapping setiap rekod
     */
    public function map($visitor): array
    {
        static $bil = 0;

        $bil++;

        return [

            $bil,

            $visitor->name,

            $visitor->ic_number ?: '-',

            $visitor->organization ?: '-',

            $visitor->phone ?: '-',

            $visitor->email ?: '-',

            $visitor->event_id,

            $visitor->event_name ?: '-',

            strtoupper(
                $visitor->registration_method ?: 'manual'
            ),

            $visitor->checked_in_at
                ? \Illuminate\Support\Carbon::parse(
                    $visitor->checked_in_at
                )->format('d/m/Y H:i:s')
                : '-',

        ];
    }


    /**
     * Style Excel
     */
    public function styles(Worksheet $sheet): array
    {
        $sheet->getStyle('A1:J1')
            ->getFont()
            ->setBold(true);

        $sheet->freezePane('A2');

        return [

            1 => [

                'font' => [
                    'bold' => true,
                ],

            ],

        ];
    }
}