<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class SigningController extends Controller
{
    public function tablet(Event $event): View
    {
        abort_unless($event->is_active, 404);

        return view('guestbook.sign', [
            'event' => $event,
        ]);
    }
}