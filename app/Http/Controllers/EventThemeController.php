<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventThemeController extends Controller
{
    public function edit(Event $event): View
    {
        $themes = config('guestbook.themes', []);

        return view('admin.theme.index', [
            'event' => $event,
            'themes' => $themes,
        ]);
    }

    public function update(
        Request $request,
        Event $event
    ): RedirectResponse {
        $themes = config('guestbook.themes', []);

        $validated = $request->validate([
            'theme' => [
                'required',
                'string',
                'max:50',
                function ($attribute, $value, $fail) use ($themes) {
                    if (!array_key_exists($value, $themes)) {
                        $fail('Tema yang dipilih tidak sah.');
                    }
                },
            ],
        ]);

        $event->update([
            'theme' => $validated['theme'],
        ]);

        return redirect()
            ->route('admin.events.theme.edit', [
                'event' => $event->id,
            ])
            ->with(
                'success',
                'Tema event berjaya dikemaskini.'
            );
    }
}