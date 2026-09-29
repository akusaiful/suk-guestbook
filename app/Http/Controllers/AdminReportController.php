<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Signature;
use App\Models\Visitor;
use App\Models\VisitorComment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminReportController extends Controller
{
    /**
     * Laporan Guestbook:
     * - Ringkasan event
     * - Senarai pengunjung
     * - Penapis event / tarikh
     */
    public function index(Request $request): View
    {
        $events = Event::query()
            ->orderByDesc('event_date')
            ->orderByDesc('id')
            ->get();

        $eventId = $request->input('event_id');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $reportEvents = $events
            ->when(
                $eventId !== null && $eventId !== '',
                fn ($collection) => $collection->where('id', (int) $eventId)
            )
            ->values();

        $rows = $reportEvents->map(function (Event $event) use ($dateFrom, $dateTo) {

            $visitors = Visitor::query()
                ->where('event_id', $event->id)
                ->when($dateFrom, function ($query) use ($dateFrom) {
                    $query->whereDate('checked_in_at', '>=', $dateFrom);
                })
                ->when($dateTo, function ($query) use ($dateTo) {
                    $query->whereDate('checked_in_at', '<=', $dateTo);
                })
                ->count();

            $comments = VisitorComment::query()
                ->where('event_id', $event->id)
                ->where('status', 'published')
                ->when($dateFrom, function ($query) use ($dateFrom) {
                    $query->whereDate('published_at', '>=', $dateFrom);
                })
                ->when($dateTo, function ($query) use ($dateTo) {
                    $query->whereDate('published_at', '<=', $dateTo);
                })
                ->count();

            $signatures = Signature::query()
                ->whereHas('signingSession', function ($query) use ($event) {
                    $query->where('event_id', $event->id);
                })
                ->when($dateFrom, function ($query) use ($dateFrom) {
                    $query->whereDate('signed_at', '>=', $dateFrom);
                })
                ->when($dateTo, function ($query) use ($dateTo) {
                    $query->whereDate('signed_at', '<=', $dateTo);
                })
                ->count();

            return [
                'event_id' => $event->id,
                'name' => $event->name,
                'event_date' => $event->event_date,
                'location' => $event->location,
                'is_active' => (bool) $event->is_active,
                'visitor_count' => $visitors,
                'comment_count' => $comments,
                'signature_count' => $signatures,
                'total_activity' => $visitors + $comments + $signatures,
            ];
        });

        $totals = [
            'events' => $rows->count(),
            'visitors' => $rows->sum('visitor_count'),
            'comments' => $rows->sum('comment_count'),
            'signatures' => $rows->sum('signature_count'),
        ];

        /*
        |--------------------------------------------------------------------------
        | Senarai Pengunjung
        |--------------------------------------------------------------------------
        */
        $visitorsQuery = Visitor::query()
            ->leftJoin('events', 'visitors.event_id', '=', 'events.id')
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
                $eventId !== null && $eventId !== '',
                function ($query) use ($eventId) {
                    $query->where('visitors.event_id', (int) $eventId);
                }
            )
            ->when(
                $dateFrom,
                function ($query) use ($dateFrom) {
                    $query->whereDate('visitors.checked_in_at', '>=', $dateFrom);
                }
            )
            ->when(
                $dateTo,
                function ($query) use ($dateTo) {
                    $query->whereDate('visitors.checked_in_at', '<=', $dateTo);
                }
            )
            ->orderByDesc('visitors.checked_in_at')
            ->orderByDesc('visitors.id');

        $visitors = $visitorsQuery
            ->paginate(20, ['*'], 'visitors_page')
            ->withQueryString();

        return view('admin.reporting.index', [
            'events' => $events,
            'rows' => $rows,
            'totals' => $totals,
            'visitors' => $visitors,
            'eventId' => $eventId,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
        ]);
    }

    /**
     * Export senarai pengunjung berdasarkan filter yang sama.
     */
    public function export(Request $request)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\VisitorReportExport(
                $request->input('event_id'),
                $request->input('date_from'),
                $request->input('date_to')
            ),
            'laporan-pengunjung-guestbook-' . now()->format('Ymd_His') . '.xlsx'
        );
    }
}