<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventImageController extends Controller
{
    /**
     * Paparkan halaman pilih event untuk pengurusan gambar.
     *
     * Semua event boleh dipilih, termasuk event yang telah tidak aktif,
     * kerana gambar event juga diperlukan sebagai rekod / arkib.
     *
     * Carian boleh dibuat berdasarkan nama event.
     */
    public function chooseEvent(Request $request): View
    {
        $search = trim((string) $request->input('search', ''));

        $events = Event::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {

                    $query->where('name', 'like', '%' . $search . '%');

                    if (ctype_digit($search)) {
                        $query->orWhere('id', (int) $search);
                    }

                });
            })
            ->orderByDesc('event_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.event-images.choose', [
            'events' => $events,
            'search' => $search,
        ]);
    }

    /**
     * Paparkan senarai semua gambar untuk sesuatu event.
     */
    public function index(Event $event): View
    {
        $images = $event->images()
            ->latest()
            ->get();

        return view('admin.event-images.index', [
            'event' => $event,
            'images' => $images,
        ]);
    }

    /**
     * Simpan gambar event.
     */
    public function store(
        Request $request,
        Event $event
    ): RedirectResponse {
        $validated = $request->validate([
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
            'caption' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $path = $request
            ->file('image')
            ->store('event-images', 'public');

        EventImage::create([
            'event_id' => $event->id,
            'image_path' => $path,
            'caption' => $validated['caption'] ?? null,
        ]);

        return redirect()
            ->route('admin.events.images.index', [
                'event' => $event->id,
            ])
            ->with(
                'success',
                'Gambar event berjaya dimuat naik.'
            );
    }

    /**
     * Padam gambar event.
     */
    public function destroy(
        Event $event,
        EventImage $eventImage
    ): RedirectResponse {
        abort_unless(
            $eventImage->event_id === $event->id,
            404
        );

        if (
            !empty($eventImage->image_path)
            && Storage::disk('public')->exists(
                $eventImage->image_path
            )
        ) {
            Storage::disk('public')->delete(
                $eventImage->image_path
            );
        }

        $eventImage->delete();

        return redirect()
            ->route('admin.events.images.index', [
                'event' => $event->id,
            ])
            ->with(
                'success',
                'Gambar event berjaya dipadam.'
            );
    }
}
