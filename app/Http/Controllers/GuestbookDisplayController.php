<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Signature;
use App\Models\Visitor;
use App\Models\VisitorComment;
use Illuminate\View\View;

class GuestbookDisplayController extends Controller
{
    /**
     * Paparkan Guestbook Display bagi sesuatu event.
     */
    public function show(Event $event): View
    {
        abort_unless($event->is_active, 404);

        /*
        |--------------------------------------------------------------------------
        | Semua komen published
        |--------------------------------------------------------------------------
        | Semua komen dihantar ke view supaya:
        | - 10 komen terbaru dipaparkan di sebelah kiri
        | - komen selepas 10 terbaru dipaparkan dalam bentuk awan di sebelah kanan
        */
        $allComments = VisitorComment::query()
            ->where('event_id', $event->id)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */
        $visitorCount = Visitor::query()
            ->where('event_id', $event->id)
            ->count();

        $commentCount = VisitorComment::query()
            ->where('event_id', $event->id)
            ->where('status', 'published')
            ->count();

        $signatureCount = Signature::query()
            ->whereHas('signingSession', function ($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Keserasian dengan view lama
        |--------------------------------------------------------------------------
        */
        $comments = $allComments->take(10);

        return view('guestbook.display', [
            'event' => $event,
            'comments' => $comments,
            'allComments' => $allComments,
            'visitorCount' => $visitorCount,
            'commentCount' => $commentCount,
            'signatureCount' => $signatureCount,
        ]);
    }
}
