<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Signature;
use App\Models\Visitor;
use App\Models\VisitorComment;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Dashboard utama Admin.
     */
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | EVENT AKTIF
        |--------------------------------------------------------------------------
        */
        $activeEvents = Event::query()
            ->where('is_active', true)
            ->orderByDesc('event_date')
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | JUMLAH EVENT AKTIF
        |--------------------------------------------------------------------------
        */
        $totalActiveEvents = $activeEvents->count();

        /*
        |--------------------------------------------------------------------------
        | JUMLAH PENGUNJUNG KESELURUHAN
        |--------------------------------------------------------------------------
        */
        $totalVisitors = Visitor::query()
            ->count();

        /*
        |--------------------------------------------------------------------------
        | JUMLAH KOMEN PUBLISHED
        |--------------------------------------------------------------------------
        */
        $totalComments = VisitorComment::query()
            ->where('status', 'published')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | JUMLAH TANDATANGAN
        |--------------------------------------------------------------------------
        */
        $totalSignatures = Signature::query()
            ->count();

        /*
        |--------------------------------------------------------------------------
        | JUMLAH PENGUNJUNG MENGIKUT EVENT
        |--------------------------------------------------------------------------
        */
        $visitorCountsByEvent = Visitor::query()
            ->selectRaw('event_id, COUNT(*) as total')
            ->groupBy('event_id')
            ->pluck('total', 'event_id');

        /*
        |--------------------------------------------------------------------------
        | TAMBAH visitor_count KE SETIAP EVENT
        |--------------------------------------------------------------------------
        */
        $activeEvents->each(function ($event) use ($visitorCountsByEvent) {

            $event->visitor_count = (int) (
                $visitorCountsByEvent[$event->id] ?? 0
            );

        });

        /*
        |--------------------------------------------------------------------------
        | KOMEN TERKINI
        |--------------------------------------------------------------------------
        */
        $latestComments = VisitorComment::query()
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD VIEW
        |--------------------------------------------------------------------------
        */
        return view('admin.dashboard', [
            'activeEvents' => $activeEvents,

            'totalActiveEvents' => $totalActiveEvents,

            'totalVisitors' => $totalVisitors,

            'totalComments' => $totalComments,

            'totalSignatures' => $totalSignatures,

            'latestComments' => $latestComments,
        ]);
    }
}