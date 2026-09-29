<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class GuestbookQrController extends Controller
{
    public function show(Event $event): View
    {
        $activeEvents = Event::query()
            ->where('is_active', true)
            ->orderBy('event_date')
            ->orderBy('id')
            ->get();

        $registerUrl = route('guestbook.register', $event);

        return view('admin.events.qr', [
            'event' => $event,
            'activeEvents' => $activeEvents,
            'registerUrl' => $registerUrl,
        ]);
    }
}