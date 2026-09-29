<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rekod Tandatangan</title>

    @vite(['resources/css/app.css'])

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
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 24px;
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

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .btn-primary {
            background: #0b5cab;
            color: #fff;
        }

        .btn-primary:hover {
            background: #084a89;
        }

        .btn-light {
            background: #fff;
            color: #374151;
            border-color: #d1d5db;
        }

        .btn-light:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        .btn-dashboard {
            background: #fff;
            color: #374151;
            border-color: #d1d5db;
        }

        .btn-dashboard:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        .btn-secondary {
            background: #374151;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #1f2937;
        }

        /*
        |--------------------------------------------------------------------------
        | DELETE BUTTON
        |--------------------------------------------------------------------------
        */

        .btn-danger {
            background: #dc2626;
            color: #fff;
            border-color: #dc2626;
        }

        .btn-danger:hover {
            background: #b91c1c;
            border-color: #b91c1c;
        }

        .filter-card,
        .section {
            background: #fff;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            overflow: hidden;
        }

        .filter-body {
            padding: 22px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 2fr 1.3fr 1fr 1fr auto;
            gap: 12px;
            align-items: end;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #4b5563;
            margin-bottom: 6px;
        }

        input,
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font: inherit;
            background: #fff;
        }

        .help {
            margin-top: 8px;
            font-size: 12px;
            color: #6b7280;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
        }

        .count {
            font-size: 13px;
            color: #6b7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px 16px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #f9fafb;
            font-size: 12px;
            text-transform: uppercase;
            color: #6b7280;
        }

        .name {
            font-weight: 700;
        }

        .detail {
            margin-top: 4px;
            color: #6b7280;
            font-size: 13px;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: 700;
        }

        .empty {
            padding: 40px;
            text-align: center;
            color: #6b7280;
        }

        .pagination {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            padding: 20px;
        }

        .pagination a,
        .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            text-decoration: none;
            color: #374151;
            background: #fff;
            font-size: 13px;
        }

        .pagination .active {
            background: #0b5cab;
            color: #fff;
            border-color: #0b5cab;
        }

        /*
        |--------------------------------------------------------------------------
        | ALERT
        |--------------------------------------------------------------------------
        */

        .alert {
            margin-bottom: 20px;
            padding: 14px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .alert-success {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        /*
        |--------------------------------------------------------------------------
        | MODAL
        |--------------------------------------------------------------------------
        */

        .modal {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: rgba(17, 24, 39, .65);
        }

        .modal.active {
            display: flex;
        }

        .modal-card {
            width: 100%;
            max-width: 760px;
            max-height: 92vh;
            overflow: auto;
            background: #fff;
            border-radius: 16px;
            border: 1px solid #d1d5db;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 22px;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
        }

        .modal-body {
            padding: 24px;
        }

        .preview {
            min-height: 300px;
            margin-top: 18px;
            padding: 20px;
            border: 2px dashed #9ca3af;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .preview img {
            max-width: 100%;
            max-height: 380px;
            object-fit: contain;
        }

        .meta {
            margin-top: 14px;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
            line-height: 1.6;
        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 950px) {

            .filter-grid {
                grid-template-columns: 1fr 1fr;
            }

            .filter-action {
                grid-column: span 2;
            }
        }

        @media (max-width: 700px) {

            .page {
                padding: 20px;
            }

            .section {
                overflow-x: auto;
            }

            table {
                min-width: 1100px;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="container">

        {{-- ============================================================
             HEADER
        ============================================================ --}}

        <div class="header">

            <div class="title">
                📚 Rekod Tandatangan
            </div>

            <div class="subtitle">
                Carian dan sejarah semua tandatangan yang telah direkodkan dalam sistem.
            </div>

            <div class="toolbar">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="btn btn-dashboard"
                >
                    ← Kembali ke Dashboard
                </a>

            </div>

        </div>


        {{-- ============================================================
             SUCCESS / ERROR MESSAGE
        ============================================================ --}}

        @if (session('success'))

            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>

        @endif


        @if (session('error'))

            <div class="alert alert-error">
                ❌ {{ session('error') }}
            </div>

        @endif


        {{-- ============================================================
             FILTER
        ============================================================ --}}

        <div class="filter-card">

            <form
                method="GET"
                action="{{ route('admin.signatures.index') }}"
            >

                <div class="filter-body">

                    <div class="filter-grid">

                        <div>

                            <label for="search">
                                Nama / Organisasi / Jawatan
                            </label>

                            <input
                                id="search"
                                type="text"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Contoh: MOHD ALI / JPA"
                            >

                        </div>


                        <div>

                            <label for="event_id">
                                Event
                            </label>

                            <select
                                id="event_id"
                                name="event_id"
                            >

                                <option value="">
                                    Semua Event
                                </option>

                                @foreach ($events as $event)

                                    <option
                                        value="{{ $event->id }}"
                                        @selected((string) $eventId === (string) $event->id)
                                    >
                                        {{ $event->name }}
                                        —
                                        {{ $event->event_date?->format('d/m/Y') }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div>

                            <label for="date_from">
                                Tarikh Dari
                            </label>

                            <input
                                id="date_from"
                                type="date"
                                name="date_from"
                                value="{{ $dateFrom }}"
                            >

                        </div>


                        <div>

                            <label for="date_to">
                                Tarikh Hingga
                            </label>

                            <input
                                id="date_to"
                                type="date"
                                name="date_to"
                                value="{{ $dateTo }}"
                            >

                        </div>


                        <div class="filter-action">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                🔍 Cari
                            </button>

                            <a
                                href="{{ route('admin.signatures.index') }}"
                                class="btn btn-light"
                                style="margin-left:6px;"
                            >
                                Reset
                            </a>

                        </div>

                    </div>


                    <div class="help">
                        Carian dibuat berdasarkan nama, jawatan atau organisasi.
                        Tarikh merujuk kepada masa tandatangan direkodkan.
                    </div>

                </div>

            </form>

        </div>


        {{-- ============================================================
             SIGNATURE LIST
        ============================================================ --}}

        <div
            class="section"
            style="margin-top:24px;"
        >

            <div class="section-header">

                <div class="section-title">
                    Senarai Rekod
                </div>

                <div class="count">
                    Jumlah paparan: {{ $signatures->count() }}
                </div>

            </div>


            @if ($signatures->isEmpty())

                <div class="empty">
                    Tiada rekod tandatangan ditemui berdasarkan carian / penapis.
                </div>

            @else

                <table>

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>
                                Tarikh / Masa
                            </th>

                            <th>
                                Individu
                            </th>

                            <th>
                                Event
                            </th>

                            <th>
                                Session
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Tindakan
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($signatures as $signature)

                            @php

                                $signer =
                                    $signature->signingSession?->signer;

                                $event =
                                    $signature->signingSession?->event;

                            @endphp


                            <tr>

                                {{-- NUMBER --}}

                                <td>
                                    {{ $signatures->firstItem() + $loop->index }}
                                </td>


                                {{-- DATE --}}

                                <td>
                                    {{ $signature->signed_at?->format('d/m/Y H:i:s') }}
                                </td>


                                {{-- SIGNER --}}

                                <td>

                                    <div class="name">
                                        {{ $signer?->name ?? '-' }}
                                    </div>

                                    @if ($signer?->position || $signer?->organization)

                                        <div class="detail">

                                            {{ $signer?->position ?? '' }}

                                            @if ($signer?->position && $signer?->organization)
                                                •
                                            @endif

                                            {{ $signer?->organization ?? '' }}

                                        </div>

                                    @endif

                                </td>


                                {{-- EVENT --}}

                                <td>

                                    <div class="name">
                                        {{ $event?->name ?? '-' }}
                                    </div>

                                    @if ($event?->event_date)

                                        <div class="detail">
                                            {{ $event->event_date->format('d/m/Y') }}
                                        </div>

                                    @endif

                                </td>


                                {{-- SESSION --}}

                                <td>
                                    #{{ $signature->signing_session_id }}
                                </td>


                                {{-- STATUS --}}

                                <td>

                                    <span class="status">
                                        SIGNED
                                    </span>

                                </td>


                                {{-- ACTION --}}

                                <td>

                                    <div
                                        style="
                                            display:flex;
                                            gap:6px;
                                            flex-wrap:wrap;
                                        "
                                    >

                                        {{-- VIEW --}}

                                        <button
                                            type="button"
                                            class="btn btn-secondary btn-view-signature"

                                            data-signature-url="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($signature->signature_path) }}"

                                            data-signer-name="{{ $signer?->name ?? '-' }}"

                                            data-signer-detail="{{ trim(
                                                ($signer?->position ?? '') .
                                                (($signer?->position && $signer?->organization) ? ' • ' : '') .
                                                ($signer?->organization ?? '')
                                            ) }}"

                                            data-event-name="{{ $event?->name ?? '-' }}"

                                            data-signature-id="{{ $signature->id }}"

                                            data-session-id="{{ $signature->signing_session_id }}"

                                            data-signed-at="{{ $signature->signed_at?->format('d/m/Y H:i:s') }}"
                                        >

                                            👁️ Papar

                                        </button>


                                        {{-- DELETE --}}

                                        <form
                                            method="POST"
                                            action="{{ route('admin.signatures.destroy', $signature->id) }}"

                                            onsubmit="return confirm(
                                                'Anda pasti mahu memadam rekod tandatangan ini?\n\n' +
                                                'Individu: {{ addslashes($signer?->name ?? '-') }}\n' +
                                                'Event: {{ addslashes($event?->name ?? '-') }}\n\n' +
                                                'Tindakan ini tidak boleh dibuat asal.'
                                            );"

                                            style="display:inline;"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                            >
                                                🗑️ Padam
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>


                {{-- PAGINATION --}}

                <div class="pagination">

                    {{ $signatures->onEachSide(1)->links() }}

                </div>

            @endif

        </div>

    </div>

</div>


{{-- ================================================================
     SIGNATURE PREVIEW MODAL
================================================================ --}}

<div
    id="signature-modal"
    class="modal"
    aria-hidden="true"
>

    <div
        class="modal-card"
        role="dialog"
        aria-modal="true"
    >

        <div class="modal-header">

            <div class="modal-title">
                Papar Tandatangan
            </div>

            <button
                type="button"
                id="close-signature-modal"
                class="btn btn-light"
            >
                ✕ Tutup
            </button>

        </div>


        <div class="modal-body">

            <div
                id="modal-signer-name"
                style="
                    text-align:center;
                    font-size:24px;
                    font-weight:700;
                "
            ></div>


            <div
                id="modal-signer-detail"
                style="
                    text-align:center;
                    margin-top:6px;
                    color:#6b7280;
                "
            ></div>


            <div
                id="modal-event-name"
                style="
                    text-align:center;
                    margin-top:6px;
                    color:#6b7280;
                    font-size:13px;
                "
            ></div>


            <div class="preview">

                <img
                    id="modal-signature-image"
                    src=""
                    alt="Tandatangan digital"
                >

            </div>


            <div
                id="modal-signature-meta"
                class="meta"
            ></div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | MODAL ELEMENTS
    |--------------------------------------------------------------------------
    */

    const modal =
        document.getElementById('signature-modal');

    const closeButton =
        document.getElementById('close-signature-modal');

    const image =
        document.getElementById('modal-signature-image');

    const signerName =
        document.getElementById('modal-signer-name');

    const signerDetail =
        document.getElementById('modal-signer-detail');

    const eventName =
        document.getElementById('modal-event-name');

    const meta =
        document.getElementById('modal-signature-meta');


    /*
    |--------------------------------------------------------------------------
    | CLOSE MODAL
    |--------------------------------------------------------------------------
    */

    function closeModal() {

        modal.classList.remove('active');

        modal.setAttribute(
            'aria-hidden',
            'true'
        );

        image.removeAttribute('src');

    }


    /*
    |--------------------------------------------------------------------------
    | VIEW SIGNATURE
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.btn-view-signature')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                signerName.textContent =
                    button.dataset.signerName || '-';

                signerDetail.textContent =
                    button.dataset.signerDetail || '';

                eventName.textContent =
                    'Event: ' +
                    (button.dataset.eventName || '-');

                image.src =
                    button.dataset.signatureUrl || '';

                meta.textContent =
                    'Signature ID: ' +
                    (button.dataset.signatureId || '-') +

                    ' • Session ID: ' +
                    (button.dataset.sessionId || '-') +

                    ' • Tarikh: ' +
                    (button.dataset.signedAt || '-');


                modal.classList.add('active');

                modal.setAttribute(
                    'aria-hidden',
                    'false'
                );

            });

        });


    /*
    |--------------------------------------------------------------------------
    | CLOSE BUTTON
    |--------------------------------------------------------------------------
    */

    closeButton.addEventListener(
        'click',
        closeModal
    );


    /*
    |--------------------------------------------------------------------------
    | CLICK OUTSIDE MODAL
    |--------------------------------------------------------------------------
    */

    modal.addEventListener(
        'click',
        function (event) {

            if (event.target === modal) {

                closeModal();

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | ESC KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                modal.classList.contains('active')
            ) {

                closeModal();

            }

        }
    );

});

</script>

</body>

</html>