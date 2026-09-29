<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search'));

        $events = Event::query()
            ->select('events.*')
            ->selectSub(function ($query) {
                $query
                    ->from('visitors')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn(
                        'visitors.event_id',
                        'events.id'
                    );
            }, 'visitor_count')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {

                    // Cari berdasarkan nama event
                    $q->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );

                    // Cari berdasarkan Event ID jika input nombor
                    if (ctype_digit($search)) {
                        $q->orWhere(
                            'id',
                            (int) $search
                        );
                    }
                });
            })
            ->orderBy('event_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'admin.events.index',
            compact('events')
        );
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] =
            $request->boolean('is_active');

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with(
                'success',
                'Event berjaya ditambah.'
            );
    }

    public function edit(Event $event): View
    {
        return view(
            'admin.events.edit',
            compact('event')
        );
    }

    public function update(
        Request $request,
        Event $event
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] =
            $request->boolean('is_active');

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with(
                'success',
                'Event berjaya dikemaskini.'
            );
    }

    public function destroy(
        Event $event
    ): RedirectResponse {
        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with(
                'success',
                'Event berjaya dipadam.'
            );
    }
}