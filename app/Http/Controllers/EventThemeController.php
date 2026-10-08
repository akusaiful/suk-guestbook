<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $headers = config('guestbook.header_images', []);

        $validated = $request->validate([
            'theme' => [
                'nullable',
                'string',
                'max:50',
                Rule::in(array_keys($themes)),
            ],
            'header_image' => [
                'nullable',
                'string',
                'max:50',
                Rule::in(array_keys($headers)),
            ],
        ]);

        $updates = [];

        if ($request->filled('theme')) {
            $updates['theme'] = $validated['theme'];
        }

        if ($request->filled('header_image')) {
            $updates['header_image'] = $validated['header_image'];
        }

        if ($updates === []) {
            return redirect()
                ->route('admin.events.theme.edit', [
                    'event' => $event->id,
                ])
                ->with('error', 'Tiada perubahan dipilih.');
        }

        $event->update($updates);

        $message = isset($updates['header_image'])
            ? 'Header paparan berjaya dikemaskini.'
            : 'Tema event berjaya dikemaskini.';

        return redirect()
            ->route('admin.events.theme.edit', [
                'event' => $event->id,
            ])
            ->with('success', $message);
    }
}