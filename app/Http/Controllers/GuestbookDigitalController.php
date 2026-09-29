<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Signature;
use App\Models\Visitor;
use App\Models\VisitorComment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuestbookDigitalController extends Controller
{
    /**
     * Paparkan senarai event untuk Guestbook Digital Melaka.
     *
     * Semua event dipaparkan, termasuk event lama / tidak aktif,
     * kerana modul ini berfungsi sebagai arkib guestbook.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search', ''));

        $events = Event::query()
            ->when($search !== '', function ($query) use ($search) {

                $query->where(function ($query) use ($search) {

                    $query->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );

                    if (ctype_digit($search)) {
                        $query->orWhere(
                            'id',
                            (int) $search
                        );
                    }

                });
            })
            ->withCount([
                'visitors',
                'visitorComments',
            ])
            ->orderByDesc('event_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view(
            'guestbook-digital.index',
            [
                'events' => $events,
                'search' => $search,
            ]
        );
    }

    /**
     * Paparkan Guestbook Digital bagi satu event.
     *
     * Semua data digabungkan berdasarkan event:
     * - maklumat event
     * - gambar event
     * - tandatangan
     * - pengunjung
     * - komen published
     */
    public function show(Event $event): View
    {
        /*
        |--------------------------------------------------------------------------
        | Gambar Event
        |--------------------------------------------------------------------------
        */

        $images = $event->images()
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Tandatangan Tetamu / VIP
        |--------------------------------------------------------------------------
        |
        | Setiap signature dihubungkan melalui signing session
        | kepada signer dan event.
        |
        */

        $signatures = Signature::query()
            ->whereHas('signingSession', function ($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->with([
                'signingSession.signer',
                'signingSession.event',
            ])
            ->latest('signed_at')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Pengunjung
        |--------------------------------------------------------------------------
        */

        $visitors = Visitor::query()
            ->where('event_id', $event->id)
            ->latest('checked_in_at')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Komen Published
        |--------------------------------------------------------------------------
        */

        $comments = VisitorComment::query()
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

        $visitorCount = $visitors->count();

        $signatureCount = $signatures->count();

        $commentCount = $comments->count();

        /*
        |--------------------------------------------------------------------------
        | Guestbook Digital
        |--------------------------------------------------------------------------
        */

        return view(
            'guestbook-digital.show',
            [
                'event' => $event,
                'images' => $images,
                'signatures' => $signatures,
                'visitors' => $visitors,
                'comments' => $comments,
                'visitorCount' => $visitorCount,
                'signatureCount' => $signatureCount,
                'commentCount' => $commentCount,
            ]
        );
    }
}