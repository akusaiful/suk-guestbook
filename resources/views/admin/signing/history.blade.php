<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Rekod Tandatangan - {{ $signer->name }}
    </title>

    @vite(['resources/css/app.css'])

    <style>
        * { box-sizing: border-box; }

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

        .card {
            background: #fff;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            overflow: hidden;
            margin-top: 20px;
        }

        .card-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
        }

        .person-name {
            font-size: 24px;
            font-weight: 700;
        }

        .person-detail {
            margin-top: 6px;
            color: #6b7280;
            font-size: 14px;
        }

        .event-detail {
            margin-top: 6px;
            color: #6b7280;
            font-size: 14px;
        }

        .toolbar {
            margin-top: 16px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
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
            border: 1px solid transparent;
            cursor: pointer;
        }

        .btn-light {
            background: #fff;
            color: #374151;
            border-color: #d1d5db;
        }

        .btn-secondary {
            background: #374151;
            color: #fff;
        }

        .btn-delete {
            background: #dc2626;
            color: #fff;
            border-color: #dc2626;
        }

        .btn-delete:hover {
            background: #b91c1c;
        }

        .empty {
            padding: 40px;
            text-align: center;
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

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: 700;
        }

        .meta-small {
            margin-top: 4px;
            color: #6b7280;
            font-size: 12px;
        }

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
            background: #fff;
        }

        .preview img {
            max-width: 100%;
            max-height: 420px;
            object-fit: contain;
        }

        .modal-meta {
            margin-top: 14px;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
            line-height: 1.6;
        }

        @media (max-width: 700px) {
            .page {
                padding: 20px;
            }

            .card {
                overflow-x: auto;
            }

            table {
                min-width: 850px;
            }
        }
    </style>
</head>

<body>

<div class="page">
    <div class="container">

        <div class="header">
            <div class="title">📚 Rekod Tandatangan Individu</div>

            <div class="subtitle">
                Semua rekod tandatangan bagi individu ini untuk event yang dipilih.
            </div>
        </div>

        <div class="card">

            @if (session('success'))
                <div
                    style="margin:16px 18px 0;padding:12px 14px;border:1px solid #a7f3d0;background:#ecfdf5;color:#065f46;border-radius:10px;font-size:14px;font-weight:600;"
                >
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    style="margin:16px 18px 0;padding:12px 14px;border:1px solid #fecaca;background:#fef2f2;color:#991b1b;border-radius:10px;font-size:14px;font-weight:600;"
                >
                    {{ session('error') }}
                </div>
            @endif

            <div class="card-header">

                <div class="person-name">
                    {{ $signer->name }}
                </div>

                @if ($signer->position || $signer->organization)
                    <div class="person-detail">
                        {{ $signer->position ?? '' }}

                        @if ($signer->position && $signer->organization)
                            •
                        @endif

                        {{ $signer->organization ?? '' }}
                    </div>
                @endif

                <div class="event-detail">
                    Event: <strong>{{ $event->name }}</strong>

                    @if ($event->event_date)
                        • {{ $event->event_date->format('d/m/Y') }}
                    @endif
                </div>

                <div class="toolbar">

                    {{-- KEMBALI KE DASHBOARD --}}
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="btn btn-secondary"
                    >
                        ← Kembali ke Dashboard
                    </a>

                    {{-- KEMBALI KE PENGURUSAN TANDATANGAN EVENT --}}
                    <a
                        href="{{ route('admin.events.signing', ['event' => $event->id]) }}"
                        class="btn btn-light"
                    >
                        ← Kembali ke Tandatangan
                    </a>

                </div>

            </div>

            @if ($signatures->isEmpty())

                <div class="empty">
                    Tiada rekod tandatangan untuk individu ini bagi event tersebut.
                </div>

            @else

                <table>

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tarikh / Masa</th>
                            <th>Session</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($signatures as $signature)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $signature->signed_at?->format('d/m/Y H:i:s') }}
                                </td>

                                <td>
                                    #{{ $signature->signing_session_id }}

                                    <div class="meta-small">
                                        Signature ID: {{ $signature->id }}
                                    </div>
                                </td>

                                <td>
                                    <span class="status">
                                        SIGNED
                                    </span>
                                </td>

                                <td>

                                    <div
                                        style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;"
                                    >

                                        <button
                                            type="button"
                                            class="btn btn-secondary btn-view-signature"
                                            data-signature-url="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($signature->signature_path) }}"
                                            data-signature-id="{{ $signature->id }}"
                                            data-session-id="{{ $signature->signing_session_id }}"
                                            data-signed-at="{{ $signature->signed_at?->format('d/m/Y H:i:s') }}"
                                        >
                                            👁️ Papar Sign
                                        </button>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.events.signing.history.delete', [
                                                'event' => $event->id,
                                                'signer' => $signer->id,
                                                'signature' => $signature->id,
                                            ]) }}"
                                            onsubmit="return confirm('Padam rekod tandatangan ini? Tindakan ini akan memadam imej tandatangan dan rekod tersebut daripada database.')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-delete"
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

            @endif

        </div>

    </div>
</div>


<div
    id="signature-modal"
    class="modal"
    aria-hidden="true"
>

    <div
        class="modal-card"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-title"
    >

        <div class="modal-header">

            <div
                id="modal-title"
                class="modal-title"
            >
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
                style="text-align:center;font-size:22px;font-weight:700;"
            >
                {{ $signer->name }}
            </div>

            <div
                style="text-align:center;margin-top:6px;color:#6b7280;"
            >
                {{ $signer->position ?? '' }}

                @if ($signer->position && $signer->organization)
                    •
                @endif

                {{ $signer->organization ?? '' }}
            </div>

            <div class="preview">

                <img
                    id="modal-signature-image"
                    src=""
                    alt="Tandatangan digital"
                >

            </div>

            <div
                id="modal-signature-meta"
                class="modal-meta"
            ></div>

        </div>

    </div>

</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const modal =
            document.getElementById(
                'signature-modal'
            );

        const closeButton =
            document.getElementById(
                'close-signature-modal'
            );

        const image =
            document.getElementById(
                'modal-signature-image'
            );

        const meta =
            document.getElementById(
                'modal-signature-meta'
            );


        function closeModal() {

            modal.classList.remove(
                'active'
            );

            modal.setAttribute(
                'aria-hidden',
                'true'
            );

            image.removeAttribute(
                'src'
            );

        }


        document
            .querySelectorAll(
                '.btn-view-signature'
            )
            .forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        function () {

                            image.src =
                                button.dataset.signatureUrl ||
                                '';

                            meta.textContent =
                                'Signature ID: ' +
                                (button.dataset.signatureId || '-') +
                                ' • Session ID: ' +
                                (button.dataset.sessionId || '-') +
                                ' • Tarikh: ' +
                                (button.dataset.signedAt || '-');


                            modal.classList.add(
                                'active'
                            );

                            modal.setAttribute(
                                'aria-hidden',
                                'false'
                            );

                        }
                    );

                }
            );


        closeButton.addEventListener(
            'click',
            closeModal
        );


        modal.addEventListener(
            'click',
            function (event) {

                if (
                    event.target === modal
                ) {

                    closeModal();

                }

            }
        );


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

    }
);

</script>

</body>
</html>
