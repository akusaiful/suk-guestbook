<?php

namespace App\Http\Controllers;

use App\Models\Signer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SignerController extends Controller
{
    public function index(): View
    {
        $signers = Signer::orderBy('name')->get();

        return view('admin.signers.index', compact('signers'));
    }

    public function create(): View
    {
        return view('admin.signers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'organization' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'photo' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Signer::create($validated);

        return redirect()
            ->route('admin.signers.index')
            ->with('success', 'Penandatangan berjaya ditambah.');
    }

    public function edit(Signer $signer): View
    {
        return view('admin.signers.edit', compact('signer'));
    }

    public function update(Request $request, Signer $signer): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'organization' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'photo' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $signer->update($validated);

        return redirect()
            ->route('admin.signers.index')
            ->with('success', 'Penandatangan berjaya dikemaskini.');
    }

    public function destroy(Signer $signer): RedirectResponse
    {
        $signer->delete();

        return redirect()
            ->route('admin.signers.index')
            ->with('success', 'Penandatangan berjaya dipadam.');
    }
}