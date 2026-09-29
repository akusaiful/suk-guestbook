<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\View\View;

class AdminVisitorController extends Controller
{
    public function index(): View
    {
        $query = Visitor::query()
            ->with('event')
            ->orderByDesc('created_at')
            ->orderByDesc('id');

        if (request()->filled('event_id')) {
            $query->where('event_id', request('event_id'));
        }

        if (request()->filled('search')) {
            $search = trim(request('search'));

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('ic_number', 'like', '%' . $search . '%')
                    ->orWhere('organization', 'like', '%' . $search . '%');
            });
        }

        $visitors = $query->paginate(20)->withQueryString();

        $events = \App\Models\Event::query()
            ->orderBy('event_date')
            ->orderBy('id')
            ->get();

        return view('admin.visitors.index', [
            'visitors' => $visitors,
            'events' => $events,
        ]);
    }
}