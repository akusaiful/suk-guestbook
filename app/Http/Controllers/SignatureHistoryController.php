<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Signature;
use App\Models\Signer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SignatureHistoryController extends Controller
{
    /**
     * Paparkan semua rekod tandatangan dengan carian dan penapis.
     */
    public function index(Request $request): View
    {
        $events = Event::query()
            ->orderByDesc('event_date')
            ->orderBy('name')
            ->get();

        $search = trim(
            (string) $request->input('search', '')
        );

        $eventId = $request->input('event_id');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $signatures = Signature::query()
            ->with([
                'signingSession.signer',
                'signingSession.event',
            ])
            ->when(
                $search !== '',
                function ($query) use ($search) {
                    $query->whereHas(
                        'signingSession.signer',
                        function ($signerQuery) use ($search) {
                            $signerQuery->where(
                                function ($query) use ($search) {
                                    $query
                                        ->where(
                                            'name',
                                            'like',
                                            "%{$search}%"
                                        )
                                        ->orWhere(
                                            'position',
                                            'like',
                                            "%{$search}%"
                                        )
                                        ->orWhere(
                                            'organization',
                                            'like',
                                            "%{$search}%"
                                        );
                                }
                            );
                        }
                    );
                }
            )
            ->when(
                $eventId !== null &&
                $eventId !== '',
                function ($query) use ($eventId) {
                    $query->whereHas(
                        'signingSession',
                        function ($sessionQuery) use ($eventId) {
                            $sessionQuery->where(
                                'event_id',
                                $eventId
                            );
                        }
                    );
                }
            )
            ->when(
                $dateFrom,
                function ($query) use ($dateFrom) {
                    $query->whereDate(
                        'signed_at',
                        '>=',
                        $dateFrom
                    );
                }
            )
            ->when(
                $dateTo,
                function ($query) use ($dateTo) {
                    $query->whereDate(
                        'signed_at',
                        '<=',
                        $dateTo
                    );
                }
            )
            ->latest('signed_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.signatures.index', [
            'events' => $events,
            'signatures' => $signatures,
            'search' => $search,
            'eventId' => $eventId,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
        ]);
    }

    /**
     * Paparkan semua rekod tandatangan bagi seorang individu
     * dalam satu event.
     */
    public function signerHistory(
        Event $event,
        Signer $signer
    ): View {
        abort_unless(
            $event->is_active,
            404
        );

        abort_unless(
            $signer->is_active,
            404
        );

        $signatures = Signature::query()
            ->whereHas(
                'signingSession',
                function ($query) use ($event, $signer) {
                    $query
                        ->where(
                            'event_id',
                            $event->id
                        )
                        ->where(
                            'signer_id',
                            $signer->id
                        );
                }
            )
            ->with([
                'signingSession.signer',
                'signingSession.event',
            ])
            ->latest('signed_at')
            ->get();

        return view('admin.signing.history', [
            'event' => $event,
            'signer' => $signer,
            'signatures' => $signatures,
        ]);
    }

    /**
     * Padam satu rekod tandatangan.
     *
     * Hanya rekod yang benar-benar dimiliki oleh
     * event dan signer tersebut boleh dipadam.
     */
    public function destroy(
        Event $event,
        Signer $signer,
        Signature $signature
    ): RedirectResponse {
        $signature->load([
            'signingSession.event',
            'signingSession.signer',
        ]);

        abort_unless(
            $signature->signingSession &&
            (int) $signature->signingSession->event_id ===
                (int) $event->id &&
            (int) $signature->signingSession->signer_id ===
                (int) $signer->id,
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Padam fail PNG tandatangan
        |--------------------------------------------------------------------------
        */
        if ($signature->signature_path) {
            Storage::disk('public')->delete(
                $signature->signature_path
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Padam rekod signature daripada database
        |--------------------------------------------------------------------------
        */
        $signature->delete();

        /*
        |--------------------------------------------------------------------------
        | Kembali ke halaman history
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route(
                'admin.events.signing.history',
                [
                    'event' => $event->id,
                    'signer' => $signer->id,
                ]
            )
            ->with(
                'success',
                'Rekod tandatangan telah berjaya dipadam.'
            );
    }
}
