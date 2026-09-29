<?php

namespace App\Http\Controllers;

use App\Events\SigningSessionCancelled;
use App\Events\SigningSessionCleared;
use App\Events\SigningSessionOpened;
use App\Models\Event;
use App\Models\Signer;
use App\Models\SigningSession;
use App\Models\Signature;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SigningSessionController extends Controller
{
    /**
     * Paparkan senarai individu untuk event.
     */
    public function index(Event $event): View
    {
        /*
        |--------------------------------------------------------------------------
        | Hanya signer yang telah dipilih untuk event ini
        |--------------------------------------------------------------------------
        */

        $signers = $event->signers()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Senarai signer yang belum dipilih untuk event ini
        |--------------------------------------------------------------------------
        |
        | Data diambil daripada rekod MASTER signers.
        | Signer yang sudah ditambah ke event tidak akan dipaparkan lagi
        | dalam senarai ini.
        |
        */

        $availableSigners = Signer::query()
            ->where('is_active', true)
            ->whereDoesntHave('events', function ($query) use ($event) {
                $query->where('events.id', $event->id);
            })
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Sesi tandatangan terbaharu untuk event ini
        |--------------------------------------------------------------------------
        */

        $latestSessions = SigningSession::query()
            ->where('event_id', $event->id)
            ->with('signer')
            ->latest()
            ->take(20)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Tandatangan terakhir setiap individu
        |--------------------------------------------------------------------------
        */

        $latestSignatures = Signature::query()
            ->whereHas('signingSession', function ($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->with('signingSession')
            ->latest('id')
            ->get()
            ->unique('signingSession.signer_id')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Hantar data ke view
        |--------------------------------------------------------------------------
        */

        return view('admin.signing.index', [
            'event' => $event,
            'signers' => $signers,
            'availableSigners' => $availableSigners,
            'latestSessions' => $latestSessions,
            'latestSignatures' => $latestSignatures,
        ]);
    }

    /**
     * Tambah signer sedia ada ke event.
     *
     * Signer diambil daripada MASTER TABLE signers.
     * Hubungan akan disimpan dalam event_signers.
     */
    public function addSigner(
        Event $event,
        Signer $signer
    ): RedirectResponse {
        /*
        |--------------------------------------------------------------------------
        | Event mesti aktif
        |--------------------------------------------------------------------------
        */

        abort_unless($event->is_active, 404);

        /*
        |--------------------------------------------------------------------------
        | Signer mesti aktif
        |--------------------------------------------------------------------------
        */

        abort_unless($signer->is_active, 404);

        /*
        |--------------------------------------------------------------------------
        | Semak sama ada signer sudah ditambah ke event
        |--------------------------------------------------------------------------
        */

        $alreadyAssigned = $event->signers()
            ->where('signer_id', $signer->id)
            ->exists();

        /*
        |--------------------------------------------------------------------------
        | Jika sudah ada
        |--------------------------------------------------------------------------
        */

        if ($alreadyAssigned) {
            return redirect()
                ->route('admin.events.signing', [
                    'event' => $event->id,
                ])
                ->with(
                    'error',
                    $signer->name
                    . ' telah ditambah ke event ini.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Tambah hubungan event ↔ signer
        |--------------------------------------------------------------------------
        */

        $event->signers()->attach($signer->id);

        /*
        |--------------------------------------------------------------------------
        | Kembali ke halaman signing
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.events.signing', [
                'event' => $event->id,
            ])
            ->with(
                'success',
                $signer->name
                . ' telah ditambah ke event ini.'
            );
    }
    /**
 * Buang signer daripada event.
 *
 * Fungsi ini hanya membuang hubungan
 * event ↔ signer daripada jadual event_signers.
 *
 * Rekod master signer dalam jadual signers
 * TIDAK akan dipadam.
 */
public function removeSigner(
    Event $event,
    Signer $signer
): RedirectResponse {
    abort_unless($event->is_active, 404);

    abort_unless($signer->is_active, 404);

    /*
    |--------------------------------------------------------------------------
    | Semak sama ada signer memang telah dipilih untuk event ini
    |--------------------------------------------------------------------------
    */

    $assigned = $event->signers()
        ->where('signer_id', $signer->id)
        ->exists();

    if (!$assigned) {
        return redirect()
            ->route('admin.events.signing', [
                'event' => $event->id,
            ])
            ->with(
                'error',
                $signer->name . ' tidak terdapat dalam event ini.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Buang hubungan event ↔ signer
    |--------------------------------------------------------------------------
    |
    | Hanya pivot event_signers akan dipadam.
    | Rekod master dalam signers kekal.
    |
    */

    $event->signers()->detach($signer->id);

    return redirect()
        ->route('admin.events.signing', [
            'event' => $event->id,
        ])
        ->with(
            'success',
            $signer->name . ' telah dikeluarkan daripada event ini.'
        );
}

    /**
     * Paparkan tandatangan terakhir individu.
     */
    public function showSignature(
        Event $event,
        Signer $signer
    ): View {
        abort_unless($event->is_active, 404);

        abort_unless($signer->is_active, 404);

        /*
        |--------------------------------------------------------------------------
        | Cari tandatangan terakhir signer untuk event ini
        |--------------------------------------------------------------------------
        */

        $signature = Signature::query()
            ->whereHas('signingSession', function ($query) use ($event, $signer) {
                $query
                    ->where('event_id', $event->id)
                    ->where('signer_id', $signer->id);
            })
            ->with('signingSession')
            ->latest('id')
            ->first();

        return view('admin.signing.signature', [
            'event' => $event,
            'signer' => $signer,
            'signature' => $signature,
        ]);
    }

    /**
     * Hantar permintaan tandatangan kepada individu.
     */
    public function requestSign(
        Request $request,
        Event $event,
        Signer $signer
    ): RedirectResponse {
        abort_unless($event->is_active, 404);

        abort_unless($signer->is_active, 404);

        /*
        |--------------------------------------------------------------------------
        | Batalkan sesi aktif sebelumnya untuk event ini
        |--------------------------------------------------------------------------
        */

        SigningSession::query()
            ->where('event_id', $event->id)
            ->whereIn('status', [
                'waiting',
                'signing',
            ])
            ->update([
                'status' => 'cancelled',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Cipta sesi tandatangan baharu
        |--------------------------------------------------------------------------
        */

        $session = SigningSession::create([
            'event_id' => $event->id,
            'signer_id' => $signer->id,
            'status' => 'signing',
            'opened_at' => now(),
            'signed_at' => null,
            'device_id' => null,
            'ip_address' => $request->ip(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Hantar arahan ke Tablet / Phone melalui Realtime
        |--------------------------------------------------------------------------
        */

        SigningSessionOpened::dispatch($session);

        /*
        |--------------------------------------------------------------------------
        | Kembali ke halaman signing Admin
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.events.signing', [
                'event' => $event->id,
            ])
            ->with(
                'success',
                'Permintaan tandatangan telah dihantar kepada '
                . $signer->name
                . '.'
            );
    }

    /**
     * CLEAR SIGN dari Admin.
     *
     * Fungsi ini TIDAK membatalkan sesi tandatangan.
     *
     * Ia hanya menghantar arahan realtime kepada
     * Tablet / Phone supaya ruang tandatangan
     * dikosongkan.
     *
     * Status sesi kekal "signing".
     */
    public function clearSign(
        Request $request,
        Event $event,
        Signer $signer
    ): RedirectResponse {
        abort_unless($event->is_active, 404);

        abort_unless($signer->is_active, 404);

        /*
        |--------------------------------------------------------------------------
        | Cari sesi tandatangan yang sedang aktif
        |--------------------------------------------------------------------------
        */

        $session = SigningSession::query()
            ->where('event_id', $event->id)
            ->where('signer_id', $signer->id)
            ->where('status', 'signing')
            ->latest('id')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Tiada sesi aktif
        |--------------------------------------------------------------------------
        */

        if (!$session) {
            return redirect()
                ->route('admin.events.signing', [
                    'event' => $event->id,
                ])
                ->with(
                    'error',
                    'Tiada sesi tandatangan yang sedang aktif '
                    . 'untuk individu ini.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | JANGAN tukar status kepada cancelled
        |--------------------------------------------------------------------------
        |
        | CLEAR SIGN Admin hanya clear canvas pada telefon.
        | Sesi masih kekal aktif dengan status "signing".
        |
        */

        /*
        |--------------------------------------------------------------------------
        | Hantar arahan CLEAR melalui Realtime
        |--------------------------------------------------------------------------
        */

        SigningSessionCleared::dispatch($session);

        /*
        |--------------------------------------------------------------------------
        | Kembali ke halaman signing Admin
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.events.signing', [
                'event' => $event->id,
            ])
            ->with(
                'success',
                'Ruang tandatangan '
                . $signer->name
                . ' telah di-CLEAR.'
            );
    }

    /**
     * CANCEL SIGN dari Admin.
     *
     * Batalkan sesi tandatangan yang sedang aktif dan hantar arahan
     * realtime kepada Tablet supaya terus kembali ke skrin menunggu.
     */
    public function cancelSign(
        Request $request,
        Event $event,
        Signer $signer
    ): RedirectResponse {
        abort_unless($event->is_active, 404);
        abort_unless($signer->is_active, 404);

        $session = SigningSession::query()
            ->where('event_id', $event->id)
            ->where('signer_id', $signer->id)
            ->where('status', 'signing')
            ->latest('id')
            ->first();

        if (!$session) {
            return redirect()
                ->route('admin.events.signing', [
                    'event' => $event->id,
                ])
                ->with(
                    'error',
                    'Tiada sesi tandatangan aktif untuk ' . $signer->name . '.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Tandakan sesi sebagai CANCELLED
        |--------------------------------------------------------------------------
        */
        $session->status = 'cancelled';
        $session->save();

        /*
        |--------------------------------------------------------------------------
        | Hantar arahan realtime kepada Tablet
        |--------------------------------------------------------------------------
        */
        SigningSessionCancelled::dispatch($session->fresh('signer'));

        return redirect()
            ->route('admin.events.signing', [
                'event' => $event->id,
            ])
            ->with(
                'success',
                'Sesi tandatangan untuk ' . $signer->name . ' telah dibatalkan.'
            );
    }

}