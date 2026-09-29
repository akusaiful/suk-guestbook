<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Signature;
use App\Models\Visitor;
use App\Models\VisitorComment;
use Illuminate\View\View;

class DisplayController extends Controller
{
    /**
     * Paparkan Guestbook Display untuk satu event.
     */
    public function show(Event $event): View
    {
        abort_unless($event->is_active, 404);

        // Semua komen published untuk event ini.
        // View akan pecahkan kepada:
        // - 10 komen terbaru
        // - komen terdahulu dalam bentuk awan
        $allComments = VisitorComment::query()
            ->where('event_id', $event->id)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();

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

        // Kekalkan $comments juga supaya view lama masih serasi
        // sekiranya ada kod lain yang masih menggunakannya.
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
