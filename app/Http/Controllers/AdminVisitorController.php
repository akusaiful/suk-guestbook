<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $events = Event::query()
            ->orderBy('event_date')
            ->orderBy('id')
            ->get();

        return view('admin.visitors.index', [
            'visitors' => $visitors,
            'events' => $events,
        ]);
    }

    public function edit(Visitor $visitor): View
    {
        $visitor->load('event');

        return view('admin.visitors.edit', compact('visitor'));
    }

    public function update(Request $request, Visitor $visitor): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'organization' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ]);

        $visitor->update([
            'name' => $validated['name'],
            'organization' => $validated['organization'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'is_active' => (bool) $validated['is_active'],
        ]);

        return redirect()
            ->route('admin.visitors.index')
            ->with('success', 'Maklumat pengunjung berjaya dikemaskini.');
    }

    public function destroy(Visitor $visitor): RedirectResponse
    {
        DB::transaction(function () use ($visitor) {
            $visitor->comments()->delete();
            $visitor->delete();
        });

        return redirect()
            ->route('admin.visitors.index')
            ->with('success', 'Rekod pengunjung berjaya dipadam.');
    }
}
