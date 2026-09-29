<?php

namespace App\Http\Controllers;

use App\Events\CommentPublished;
use App\Events\VisitorRegistered;
use App\Models\Event;
use App\Models\Visitor;
use App\Models\VisitorComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorRegistrationController extends Controller
{
    public function create(Event $event): View
    {
        abort_unless($event->is_active, 404);

        return view('guestbook.register', compact('event'));
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        abort_unless($event->is_active, 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'organization' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'purpose' => ['nullable', 'string', 'max:255'],
            'comment' => ['nullable', 'string', 'max:2000'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Simpan Visitor
        |--------------------------------------------------------------------------
        */

        $visitor = Visitor::create([
            'event_id' => $event->id,
            'name' => $validated['name'],
            'organization' => $validated['organization'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'purpose' => $validated['purpose'] ?? null,
            'checked_in_at' => now(),
            'registration_method' => 'qr',
            'is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Realtime: Visitor Registered
        |--------------------------------------------------------------------------
        */

        VisitorRegistered::dispatch($visitor);

        /*
        |--------------------------------------------------------------------------
        | Simpan Comment HANYA jika visitor isi komen
        |--------------------------------------------------------------------------
        */

        $commentText = trim($validated['comment'] ?? '');

        if ($commentText !== '') {

            $comment = VisitorComment::create([
                'event_id' => $event->id,
                'visitor_id' => $visitor->id,
                'name' => $visitor->name,
                'organization' => $visitor->organization,
                'comment' => $commentText,
                'rating' => $validated['rating'] ?? null,
                'status' => 'published',
                'published_at' => now(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | Realtime: Comment Published
            |--------------------------------------------------------------------------
            */

            CommentPublished::dispatch($comment);
        }

        return redirect()
            ->route('guestbook.thank-you', $event)
            ->with(
                'success',
                'Terima kasih. Pendaftaran anda telah berjaya direkodkan.'
            );
    }

    public function thankYou(Event $event): View
    {
        return view('guestbook.thank-you', compact('event'));
    }
}
