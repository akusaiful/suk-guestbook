<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\VisitorComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCommentController extends Controller
{
    /**
     * Paparkan senarai semua komen untuk pengurusan admin.
     *
     * Penapis:
     * - Event
     * - Carian nama / organisasi / komen
     */
    public function index(Request $request): View
    {
        $query = VisitorComment::query()
            ->with('event')
            ->orderByDesc('created_at')
            ->orderByDesc('id');

        /*
        |--------------------------------------------------------------------------
        | FILTER EVENT
        |--------------------------------------------------------------------------
        */
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->integer('event_id'));
        }

        /*
        |--------------------------------------------------------------------------
        | CARIAN KOMEN
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('organization', 'like', '%' . $search . '%')
                    ->orWhere('comment', 'like', '%' . $search . '%');
            });
        }

        $comments = $query
            ->paginate(20)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | SENARAI EVENT UNTUK FILTER
        |--------------------------------------------------------------------------
        */
        $events = Event::query()
            ->orderBy('event_date')
            ->orderBy('id')
            ->get();

        return view('admin.comments.index', [
            'comments' => $comments,
            'events' => $events,
        ]);
    }

    /**
     * Padam komen.
     */
    public function destroy(VisitorComment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()
            ->route('admin.comments.index')
            ->with('success', 'Komen berjaya dipadam.');
    }
}
