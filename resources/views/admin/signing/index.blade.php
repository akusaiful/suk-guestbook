<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Minta Tandatangan - {{ $event->name }}
    </title>

    @vite([
        'resources/css/app.css'
    ])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }

        .page {
            min-height: 100vh;
            padding: 40px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 28px;
        }

        .title {
            font-size: 30px;
            font-weight: 700;
        }

        .subtitle {
            margin-top: 8px;
            color: #6b7280;
            font-size: 15px;
        }

        .event-card {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 24px;
        }

        .event-name {
            font-size: 22px;
            font-weight: 700;
        }

        .event-location {
            margin-top: 6px;
            color: #6b7280;
        }

        .success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 24px;
        }

        .error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 24px;
        }

        .section {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            overflow: hidden;
        }

        .section-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
        }

        .section-header-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
        }

        .section-subtitle {
            margin-top: 5px;
            color: #6b7280;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 16px 18px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        th {
            background: #f9fafb;
            font-size: 13px;
            text-transform: uppercase;
            color: #6b7280;
        }

        .person-name {
            font-weight: 700;
        }

        .person-detail {
            margin-top: 4px;
            color: #6b7280;
            font-size: 14px;
        }

        .action-group {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
            transition: 0.15s ease;
        }

        .btn-primary {
            background: #0b5cab;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: #084c8d;
        }

        .btn-danger {
            background: #dc2626;
            color: #ffffff;
            border: 1px solid #dc2626;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .btn-secondary {
            background: #374151;
            color: #ffffff;
            border: 1px solid #374151;
        }

        .btn-secondary:hover {
            background: #1f2937;
        }

        .btn-light {
            background: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-light:hover {
            background: #f9fafb;
        }

        .btn-success {
            background: #047857;
            color: #ffffff;
            border: 1px solid #047857;
        }

        .btn-success:hover {
            background: #065f46;
        }

        .btn:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        .btn:disabled:hover {
            background: inherit;
        }

        .empty {
            padding: 30px;
            text-align: center;
            color: #6b7280;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 700;
        }

        .status-signing {
            background: #fef3c7;
            color: #92400e;
        }

        .status-signed {
            background: #dcfce7;
            color: #166534;
        }

        .status-cancelled {
            background: #f3f4f6;
            color: #4b5563;
        }

        .status-waiting {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .clear-note {
            margin-top: 6px;
            color: #9ca3af;
            font-size: 11px;
        }

        /* ============================================================
           ADD SIGNER MODAL
        ============================================================ */

        .add-signer-modal,
        .signature-modal {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: rgba(17, 24, 39, 0.65);
        }

        .add-signer-modal.active,
        .signature-modal.active {
            display: flex;
        }

        .add-signer-modal-card {
            width: 100%;
            max-width: 760px;
            max-height: 90vh;
            overflow: hidden;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #d1d5db;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.22);
        }

        .add-signer-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 22px;
            border-bottom: 1px solid #e5e7eb;
        }

        .add-signer-modal-title {
            font-size: 20px;
            font-weight: 700;
        }

        .add-signer-modal-subtitle {
            margin-top: 4px;
            color: #6b7280;
            font-size: 13px;
        }

        .add-signer-modal-body {
            padding: 20px;
            overflow-y: auto;
            max-height: calc(90vh - 100px);
        }

        .signer-search-wrap {
            margin-bottom: 18px;
        }

        .signer-search-label {
            display: block;
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .signer-search {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
        }

        .signer-search:focus {
            border-color: #0b5cab;
            box-shadow: 0 0 0 3px rgba(11, 92, 171, 0.12);
        }

        .available-count {
            margin-bottom: 12px;
            color: #6b7280;
            font-size: 13px;
        }

        .available-signers {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .available-signer-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #ffffff;
        }

        .available-signer-item:hover {
            background: #f9fafb;
            border-color: #cbd5e1;
        }

        .available-signer-info {
            min-width: 0;
        }

        .available-signer-name {
            font-weight: 700;
            color: #111827;
        }

        .available-signer-detail {
            margin-top: 4px;
            color: #6b7280;
            font-size: 13px;
            line-height: 1.5;
        }

        .available-signer-action {
            flex-shrink: 0;
        }

        .no-search-result {
            display: none;
            padding: 25px;
            text-align: center;
            color: #6b7280;
            border: 1px dashed #d1d5db;
            border-radius: 10px;
        }

        .no-available-signer {
            padding: 30px;
            text-align: center;
            color: #6b7280;
            background: #f9fafb;
            border-radius: 10px;
        }

        /* ============================================================
           SIGNATURE MODAL
        ============================================================ */

        .signature-modal-card {
            width: 100%;
            max-width: 760px;
            max-height: 92vh;
            overflow: auto;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #d1d5db;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.22);
        }

        .signature-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 22px;
            border-bottom: 1px solid #e5e7eb;
        }

        .signature-modal-title {
            font-size: 18px;
            font-weight: 700;
        }

        .signature-modal-body {
            padding: 24px;
        }

        .signature-person {
            text-align: center;
        }

        .signature-person-name {
            font-size: 24px;
            font-weight: 700;
        }

        .signature-person-detail {
            margin-top: 5px;
            color: #6b7280;
            font-size: 14px;
        }

        .signature-preview {
            margin-top: 22px;
            min-height: 280px;
            border: 2px dashed #9ca3af;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            padding: 20px;
        }

        .signature-preview img {
            display: block;
            max-width: 100%;
            max-height: 360px;
            object-fit: contain;
        }

        .signature-meta {
            margin-top: 16px;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
            line-height: 1.6;
        }

        .signature-previews {
            margin-top: 22px;
            display: grid;
            grid-template-columns: minmax(0, 3fr) minmax(260px, 1fr);
            gap: 18px;
            align-items: stretch;
        }

        .signature-preview-card {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            background: #ffffff;
            overflow: hidden;
        }

        .signature-preview-label {
            padding: 11px 14px;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .3px;
            color: #374151;
            text-transform: uppercase;
            text-align: center;
        }

        .signature-preview {
            margin-top: 0;
            min-height: 280px;
            border: 0;
            border-radius: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            padding: 18px;
        }

        .signature-preview img {
            display: block;
            max-width: 100%;
            max-height: 360px;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .signature-preview.empty {
            min-height: 280px;
            color: #9ca3af;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
        }

        @media (max-width: 900px) {
            .signature-previews {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {

            .page {
                padding: 20px;
            }

            table {
                min-width: 900px;
            }

            .section {
                overflow-x: auto;
            }

            .add-signer-modal-card {
                max-height: 94vh;
            }

            .available-signer-item {
                flex-direction: column;
                align-items: stretch;
            }

            .available-signer-action {
                width: 100%;
            }

            .available-signer-action .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="container">

        {{-- ============================================================
             HEADER
        ============================================================= --}}

        <div class="header">

            <div class="title">
                Minta Tandatangan
            </div>

            <div class="subtitle">
                Pilih individu untuk sesi tandatangan digital
            </div>

            <div
                style="
                    margin-top: 14px;
                    display: flex;
                    flex-wrap: wrap;
                    gap: 8px;
                "
            >

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="btn btn-light"
                >
                    ← Kembali ke Dashboard
                </a>

                <a
                    href="{{ route('admin.signatures.index') }}"
                    class="btn btn-light"
                >
                    📚 Rekod Tandatangan
                </a>

            </div>

        </div>


        {{-- ============================================================
             SUCCESS MESSAGE
        ============================================================= --}}

        @if (session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif


        {{-- ============================================================
             ERROR MESSAGE
        ============================================================= --}}

        @if (session('error'))

            <div class="error">
                {{ session('error') }}
            </div>

        @endif


        {{-- ============================================================
             EVENT INFORMATION
        ============================================================= --}}

        <div class="event-card">

            <div class="event-name">
                {{ $event->name }}
            </div>

            @if ($event->location)

                <div class="event-location">
                    {{ $event->location }}
                </div>

            @endif

            <div class="event-location">
                Tarikh:
                {{ $event->event_date?->format('d/m/Y') }}
            </div>

        </div>


        {{-- ============================================================
             INDIVIDUAL / SIGNER
        ============================================================= --}}

        <div class="section">

            <div
                class="section-header section-header-flex"
            >

                <div>

                    <div class="section-title">
                        👤 Individu / Tetamu
                    </div>

                    <div class="section-subtitle">
                        Individu yang telah dipilih untuk Event ID
                        {{ $event->id }}
                    </div>

                </div>

                <button
                    type="button"
                    class="btn btn-primary"
                    id="open-add-signer-modal"
                >
                    ➕ Add Signer
                </button>

            </div>


            @if ($signers->isEmpty())

                <div class="empty">
                    Tiada individu aktif untuk event ini.
                </div>

            @else

                <table>

                    <thead>

                        <tr>
                            <th>Nama</th>
                            <th>Jawatan</th>
                            <th>Organisasi</th>
                            <th>Tindakan</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($signers as $signer)

                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | Cari sesi tandatangan aktif untuk individu ini
                                |--------------------------------------------------------------------------
                                */

                                $activeSession = $latestSessions->first(
                                    function ($session) use ($signer) {
                                        return
                                            (int) $session->signer_id === (int) $signer->id
                                            &&
                                            $session->status === 'signing';
                                    }
                                );

                            @endphp


                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | Tandatangan terakhir individu untuk event ini
                                |--------------------------------------------------------------------------
                                */

                                $latestSignature = \App\Models\Signature::query()
                                    ->whereHas('signingSession', function ($query) use ($event, $signer) {
                                        $query
                                            ->where('event_id', $event->id)
                                            ->where('signer_id', $signer->id);
                                    })
                                    ->latest('id')
                                    ->first();

                            @endphp


                            <tr>

                                {{-- ====================================================
                                     NAMA
                                ===================================================== --}}

                                <td>

                                    <div class="person-name">
                                        {{ $signer->name }}
                                    </div>

                                </td>


                                {{-- ====================================================
                                     JAWATAN
                                ===================================================== --}}

                                <td>

                                    {{ $signer->position ?? '-' }}

                                </td>


                                {{-- ====================================================
                                     ORGANISASI
                                ===================================================== --}}

                                <td>

                                    {{ $signer->organization ?? '-' }}

                                </td>


                                {{-- ====================================================
                                     TINDAKAN
                                ===================================================== --}}

                                <td>

                                    <div class="action-group">

                                        {{-- ====================================================
                                             MINTA SIGN
                                        ===================================================== --}}

                                        <form
                                            method="POST"
                                            action="{{ route('admin.events.signing.request', [
                                                'event' => $event->id,
                                                'signer' => $signer->id,
                                            ]) }}"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn btn-primary"
                                            >
                                                ✍️ Minta Sign
                                            </button>

                                        </form>


                                        {{-- ====================================================
                                             CLEAR SIGN
                                        ===================================================== --}}

                                        <form
                                            method="POST"
                                            action="{{ route('admin.events.signing.clear', [
                                                'event' => $event->id,
                                                'signer' => $signer->id,
                                            ]) }}"
                                            onsubmit="return confirm('Clear sesi tandatangan untuk {{ $signer->name }}?')"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                                {{ $activeSession ? '' : 'disabled' }}
                                            >
                                                🗑️ Clear Sign
                                            </button>

                                        </form>


                                        {{-- ====================================================
                                             CANCEL SIGN
                                        ===================================================== --}}

                                        <form
                                            method="POST"
                                            action="{{ route('admin.events.signing.cancel', [
                                                'event' => $event->id,
                                                'signer' => $signer->id,
                                            ]) }}"
                                            onsubmit="return confirm('Batalkan sesi tandatangan untuk {{ $signer->name }}? Tablet akan kembali ke skrin menunggu.')"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                                {{ $activeSession ? '' : 'disabled' }}
                                            >
                                                ❌ Cancel Sign
                                            </button>

                                        </form>


                                        {{-- ====================================================
                                             PAPAR SIGN
                                        ===================================================== --}}

                                        @if ($latestSignature)

                                            <button
                                                type="button"
                                                class="btn btn-secondary btn-view-signature"
                                                data-signature-url="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($latestSignature->signature_path) }}"
                                                data-greeting-url="{{ !empty($latestSignature->greeting_path) ? \Illuminate\Support\Facades\Storage::disk('public')->url($latestSignature->greeting_path) : '' }}"
                                                data-signer-name="{{ $signer->name }}"
                                                data-signer-position="{{ $signer->position ?? '' }}"
                                                data-signer-organization="{{ $signer->organization ?? '' }}"
                                                data-signature-id="{{ $latestSignature->id }}"
                                                data-session-id="{{ $latestSignature->signing_session_id }}"
                                                data-signed-at="{{ $latestSignature->signed_at?->format('d/m/Y H:i:s') }}"
                                            >
                                                👁️ Papar Sign
                                            </button>

                                        @else

                                            <button
                                                type="button"
                                                class="btn btn-light"
                                                disabled
                                            >
                                                👁️ Papar Sign
                                            </button>

                                        @endif


                                        {{-- ====================================================
                                             REKOD SIGN
                                        ===================================================== --}}

                                        <a
                                            href="{{ route('admin.events.signing.history', [
                                                'event' => $event->id,
                                                'signer' => $signer->id,
                                            ]) }}"
                                            class="btn btn-light"
                                        >
                                            📚 Rekod Sign
                                        </a>

                                        {{-- ====================================================
                                             REMOVE SIGNER DARI EVENT
                                        ===================================================== --}}

                                        <form
                                            method="POST"
                                            action="{{ route('admin.events.signing.remove', [
                                                'event' => $event->id,
                                                'signer' => $signer->id,
                                            ]) }}"
                                            onsubmit="return confirm('Buang {{ addslashes($signer->name) }} daripada Event ID {{ $event->id }}? Rekod signer master TIDAK akan dipadam.')"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                            >
                                                🗑️ Remove
                                            </button>

                                        </form>

                                    </div>


                                    {{-- ====================================================
                                         STATUS SESI AKTIF
                                    ===================================================== --}}

                                    @if ($activeSession)

                                        <div class="clear-note">
                                            Sesi #{{ $activeSession->id }}
                                            sedang menunggu tandatangan.
                                        </div>

                                    @else

                                        <div class="clear-note">
                                            Tiada sesi tandatangan aktif.
                                        </div>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @endif

        </div>


        {{-- ============================================================
             LATEST SESSIONS
        ============================================================= --}}

        @if ($latestSessions->isNotEmpty())

            <div
                class="section"
                style="margin-top: 24px;"
            >

                <div class="section-header">

                    <div class="section-title">
                        📝 Sesi Terbaharu
                    </div>

                </div>

                <table>

                    <thead>

                        <tr>
                            <th>Individu</th>
                            <th>Status</th>
                            <th>Dibuka</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($latestSessions as $session)

                            <tr>

                                <td>

                                    {{ $session->signer->name }}

                                </td>

                                <td>

                                    @php

                                        $statusClass = match ($session->status) {
                                            'signing' => 'status-signing',
                                            'signed' => 'status-signed',
                                            'cancelled' => 'status-cancelled',
                                            'waiting' => 'status-waiting',
                                            default => '',
                                        };

                                    @endphp

                                    <span
                                        class="status {{ $statusClass }}"
                                    >
                                        {{ strtoupper($session->status) }}
                                    </span>

                                </td>

                                <td>

                                    {{ $session->opened_at?->format('d/m/Y H:i:s') }}

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>


{{-- ============================================================
     ADD SIGNER MODAL
============================================================= --}}

<div
    id="add-signer-modal"
    class="add-signer-modal"
    aria-hidden="true"
>

    <div
        class="add-signer-modal-card"
        role="dialog"
        aria-modal="true"
        aria-labelledby="add-signer-modal-title"
    >

        <div class="add-signer-modal-header">

            <div>

                <div
                    id="add-signer-modal-title"
                    class="add-signer-modal-title"
                >
                    ➕ Tambah Signer
                </div>

                <div class="add-signer-modal-subtitle">
                    Pilih signer sedia ada daripada rekod sistem.
                </div>

            </div>

            <button
                type="button"
                id="close-add-signer-modal"
                class="btn btn-light"
            >
                ✕ Tutup
            </button>

        </div>


        <div class="add-signer-modal-body">

            @if ($availableSigners->isEmpty())

                <div class="no-available-signer">

                    <div
                        style="
                            font-size: 30px;
                            margin-bottom: 8px;
                        "
                    >
                        ✅
                    </div>

                    <div
                        style="
                            font-weight: 700;
                            color: #374151;
                        "
                    >
                        Semua signer aktif telah dipilih.
                    </div>

                    <div
                        style="
                            margin-top: 5px;
                            font-size: 13px;
                        "
                    >
                        Tiada rekod signer lain yang boleh ditambah
                        ke event ini.
                    </div>

                </div>

            @else

                <div class="signer-search-wrap">

                    <label
                        for="signer-search"
                        class="signer-search-label"
                    >
                        🔎 Cari Signer
                    </label>

                    <input
                        type="text"
                        id="signer-search"
                        class="signer-search"
                        placeholder="Cari nama, jawatan atau organisasi..."
                        autocomplete="off"
                    >

                </div>


                <div
                    id="available-signer-count"
                    class="available-count"
                >
                    {{ $availableSigners->count() }}
                    signer tersedia
                </div>


                <div
                    id="available-signers"
                    class="available-signers"
                >

                    @foreach ($availableSigners as $availableSigner)

                        <div
                            class="available-signer-item"
                            data-search="{{ strtolower(
                                $availableSigner->name . ' ' .
                                ($availableSigner->position ?? '') . ' ' .
                                ($availableSigner->organization ?? '')
                            ) }}"
                        >

                            <div class="available-signer-info">

                                <div class="available-signer-name">
                                    {{ $availableSigner->name }}
                                </div>

                                <div class="available-signer-detail">

                                    @if ($availableSigner->position)
                                        {{ $availableSigner->position }}
                                    @endif

                                    @if ($availableSigner->position && $availableSigner->organization)
                                        •
                                    @endif

                                    @if ($availableSigner->organization)
                                        {{ $availableSigner->organization }}
                                    @endif

                                    @if (
                                        !$availableSigner->position
                                        && !$availableSigner->organization
                                    )
                                        -
                                    @endif

                                </div>

                            </div>


                            <div class="available-signer-action">

                                <form
                                    method="POST"
                                    action="{{ route('admin.events.signing.add', [
                                        'event' => $event->id,
                                        'signer' => $availableSigner->id,
                                    ]) }}"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-success"
                                        onclick="return confirm('Tambah {{ $availableSigner->name }} ke Event ID {{ $event->id }}?')"
                                    >
                                        ➕ Tambah ke Event
                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>


                <div
                    id="no-search-result"
                    class="no-search-result"
                >
                    Tiada signer dijumpai berdasarkan carian.
                </div>

            @endif

        </div>

    </div>

</div>


{{-- ============================================================
     PAPAR SIGN MODAL
============================================================= --}}

<div
    id="signature-modal"
    class="signature-modal"
    aria-hidden="true"
>

    <div
        class="signature-modal-card"
        role="dialog"
        aria-modal="true"
        aria-labelledby="signature-modal-title"
    >

        <div class="signature-modal-header">

            <div
                id="signature-modal-title"
                class="signature-modal-title"
            >
                Papar Tandatangan & Catatan
            </div>

            <button
                type="button"
                id="close-signature-modal"
                class="btn btn-light"
            >
                ✕ Tutup
            </button>

        </div>

        <div class="signature-modal-body">

            <div class="signature-person">

                <div
                    id="modal-signer-name"
                    class="signature-person-name"
                ></div>

                <div
                    id="modal-signer-detail"
                    class="signature-person-detail"
                ></div>

            </div>

            <div class="signature-previews">

                <div class="signature-preview-card">

                    <div class="signature-preview-label">
                        Tandatangan
                    </div>

                    <div class="signature-preview">

                        <img
                            id="modal-signature-image"
                            src=""
                            alt="Tandatangan digital"
                        >

                    </div>

                </div>


                <div class="signature-preview-card">

                    <div class="signature-preview-label">
                        Catatan / Ucapan
                    </div>

                    <div
                        id="modal-greeting-preview"
                        class="signature-preview empty"
                    >
                        Tiada catatan direkodkan.
                    </div>

                </div>

            </div>

            <div
                id="modal-signature-meta"
                class="signature-meta"
            ></div>

        </div>

    </div>

</div>


<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            /* ========================================================
               ADD SIGNER MODAL
            ======================================================== */

            const addSignerModal = document.getElementById(
                'add-signer-modal'
            );

            const openAddSignerButton = document.getElementById(
                'open-add-signer-modal'
            );

            const closeAddSignerButton = document.getElementById(
                'close-add-signer-modal'
            );


            function openAddSignerModal() {

                if (!addSignerModal) {
                    return;
                }

                addSignerModal.classList.add('active');

                addSignerModal.setAttribute(
                    'aria-hidden',
                    'false'
                );

                const searchInput = document.getElementById(
                    'signer-search'
                );

                if (searchInput) {

                    searchInput.value = '';

                    setTimeout(
                        function () {
                            searchInput.focus();
                        },
                        100
                    );

                }

            }


            function closeAddSignerModal() {

                if (!addSignerModal) {
                    return;
                }

                addSignerModal.classList.remove('active');

                addSignerModal.setAttribute(
                    'aria-hidden',
                    'true'
                );

            }


            if (openAddSignerButton) {

                openAddSignerButton.addEventListener(
                    'click',
                    openAddSignerModal
                );

            }


            if (closeAddSignerButton) {

                closeAddSignerButton.addEventListener(
                    'click',
                    closeAddSignerModal
                );

            }


            if (addSignerModal) {

                addSignerModal.addEventListener(
                    'click',
                    function (event) {

                        if (event.target === addSignerModal) {
                            closeAddSignerModal();
                        }

                    }
                );

            }


            /* ========================================================
               SEARCH SIGNER
            ======================================================== */

            const signerSearch = document.getElementById(
                'signer-search'
            );

            const signerItems = document.querySelectorAll(
                '.available-signer-item'
            );

            const noSearchResult = document.getElementById(
                'no-search-result'
            );

            const availableSignerCount = document.getElementById(
                'available-signer-count'
            );


            function filterSigners() {

                if (!signerSearch) {
                    return;
                }

                const keyword = signerSearch.value
                    .trim()
                    .toLowerCase();

                let visibleCount = 0;


                signerItems.forEach(
                    function (item) {

                        const searchableText =
                            item.dataset.search || '';

                        const matched =
                            keyword === ''
                            ||
                            searchableText.includes(keyword);

                        if (matched) {

                            item.style.display = 'flex';

                            visibleCount++;

                        } else {

                            item.style.display = 'none';

                        }

                    }
                );


                if (availableSignerCount) {

                    availableSignerCount.textContent =
                        visibleCount
                        + (
                            visibleCount === 1
                                ? ' signer dijumpai'
                                : ' signer dijumpai'
                        );

                }


                if (noSearchResult) {

                    noSearchResult.style.display =
                        visibleCount === 0
                            ? 'block'
                            : 'none';

                }

            }


            if (signerSearch) {

                signerSearch.addEventListener(
                    'input',
                    filterSigners
                );

            }


            /* ========================================================
               SIGNATURE MODAL
            ======================================================== */

            const signatureModal = document.getElementById(
                'signature-modal'
            );

            const closeSignatureButton = document.getElementById(
                'close-signature-modal'
            );

            const image = document.getElementById(
                'modal-signature-image'
            );

            const greetingPreview = document.getElementById(
                'modal-greeting-preview'
            );

            const signerName = document.getElementById(
                'modal-signer-name'
            );

            const signerDetail = document.getElementById(
                'modal-signer-detail'
            );

            const signatureMeta = document.getElementById(
                'modal-signature-meta'
            );


            function closeSignatureModal() {

                if (!signatureModal) {
                    return;
                }

                signatureModal.classList.remove('active');

                signatureModal.setAttribute(
                    'aria-hidden',
                    'true'
                );

                if (image) {
                    image.removeAttribute('src');
                }

                if (greetingPreview) {
                    greetingPreview.innerHTML =
                        'Tiada catatan direkodkan.';
                    greetingPreview.classList.add('empty');
                }

            }


            document
                .querySelectorAll('.btn-view-signature')
                .forEach(
                    function (button) {

                        button.addEventListener(
                            'click',
                            function () {

                                const details = [
                                    button.dataset.signerPosition || '',
                                    button.dataset.signerOrganization || ''
                                ].filter(Boolean);


                                if (signerName) {

                                    signerName.textContent =
                                        button.dataset.signerName
                                        || '-';

                                }


                                if (signerDetail) {

                                    signerDetail.textContent =
                                        details.join(' • ');

                                }


                                if (image) {

                                    image.src =
                                        button.dataset.signatureUrl
                                        || '';

                                }


                                if (greetingPreview) {

                                    const greetingUrl =
                                        button.dataset.greetingUrl
                                        || '';

                                    if (greetingUrl) {

                                        greetingPreview.classList.remove('empty');
                                        greetingPreview.innerHTML =
                                            '<img src="' +
                                            greetingUrl.replaceAll('"', '&quot;') +
                                            '" alt="Catatan / Ucapan">';

                                    } else {

                                        greetingPreview.classList.add('empty');
                                        greetingPreview.textContent =
                                            'Tiada catatan direkodkan.';

                                    }

                                }


                                if (signatureMeta) {

                                    signatureMeta.textContent =
                                        'Signature ID: '
                                        + (
                                            button.dataset.signatureId
                                            || '-'
                                        )
                                        + ' • Session ID: '
                                        + (
                                            button.dataset.sessionId
                                            || '-'
                                        )
                                        + ' • Tarikh: '
                                        + (
                                            button.dataset.signedAt
                                            || '-'
                                        );

                                }


                                if (signatureModal) {

                                    signatureModal.classList.add(
                                        'active'
                                    );

                                    signatureModal.setAttribute(
                                        'aria-hidden',
                                        'false'
                                    );

                                }

                            }
                        );

                    }
                );


            if (closeSignatureButton) {

                closeSignatureButton.addEventListener(
                    'click',
                    closeSignatureModal
                );

            }


            if (signatureModal) {

                signatureModal.addEventListener(
                    'click',
                    function (event) {

                        if (event.target === signatureModal) {
                            closeSignatureModal();
                        }

                    }
                );

            }


            /* ========================================================
               ESC KEY
            ======================================================== */

            document.addEventListener(
                'keydown',
                function (event) {

                    if (event.key !== 'Escape') {
                        return;
                    }


                    if (
                        addSignerModal
                        &&
                        addSignerModal.classList.contains('active')
                    ) {

                        closeAddSignerModal();

                    }


                    if (
                        signatureModal
                        &&
                        signatureModal.classList.contains('active')
                    ) {

                        closeSignatureModal();

                    }

                }
            );

        }
    );


            /* ========================================================
               AUTO REFRESH APABILA SIGNATURE BAHARU DISIMPAN
               --------------------------------------------------------
               Page ini akan semak signature ID terkini setiap 2 saat.
               Jika ada signature baharu dalam database, page akan
               refresh sendiri supaya "Papar Sign" terus dikemas kini.
            ======================================================== */

            let previousSignatureState =
                getSignatureStateFromPage();

            let signatureRefreshBusy = false;


            function getSignatureStateFromPage(
                sourceDocument = document
            ) {

                const signatureButtons =
                    sourceDocument.querySelectorAll(
                        '.btn-view-signature[data-signature-id]'
                    );

                return Array.from(signatureButtons)
                    .map(function (button) {

                        return (
                            button.dataset.signatureId
                            || ''
                        );

                    })
                    .filter(Boolean)
                    .sort()
                    .join(',');

            }


            async function checkForNewSignature() {

                if (signatureRefreshBusy) {
                    return;
                }

                signatureRefreshBusy = true;


                try {

                    const response =
                        await fetch(
                            window.location.href,
                            {
                                method: 'GET',
                                cache: 'no-store',
                                headers: {
                                    'X-Requested-With':
                                        'XMLHttpRequest',
                                    'Cache-Control':
                                        'no-cache'
                                }
                            }
                        );


                    if (!response.ok) {

                        return;

                    }


                    const html =
                        await response.text();


                    const parser =
                        new DOMParser();


                    const serverDocument =
                        parser.parseFromString(
                            html,
                            'text/html'
                        );


                    const currentSignatureState =
                        getSignatureStateFromPage(
                            serverDocument
                        );


                    /*
                    |--------------------------------------------------
                    | Signature ID berubah
                    |--------------------------------------------------
                    | Ini bermaksud signature baharu telah masuk
                    | ke database untuk event ini.
                    */

                    if (
                        currentSignatureState !==
                        previousSignatureState
                    ) {

                        console.log(
                            'Signature baharu dikesan. Refresh admin signing page...'
                        );

                        window.location.reload();

                        return;

                    }

                } catch (error) {

                    console.warn(
                        'Auto refresh signature gagal:',
                        error
                    );

                } finally {

                    signatureRefreshBusy = false;

                }

            }


            /*
            |----------------------------------------------------------
            | Semak setiap 2 saat.
            |----------------------------------------------------------
            */

            setInterval(
                checkForNewSignature,
                2000
            );


</script>


</body>

</html>