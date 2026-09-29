<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        QR Pendaftaran - {{ $event->name }}
    </title>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/qr.js'])

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f3f4f6;

            color: #111827;
        }

        .page {
            width: 100%;

            max-width: 900px;

            margin: 40px auto;

            padding: 20px;
        }

        .card {
            background: #ffffff;

            border: 1px solid #d1d5db;

            border-radius: 16px;

            padding: 30px;
        }

        /*
        |--------------------------------------------------------------------------
        | Header
        |--------------------------------------------------------------------------
        */

        .header {
            text-align: center;

            margin-bottom: 25px;
        }

        .title {
            font-size: 28px;

            font-weight: 700;
        }

        .subtitle {
            margin-top: 6px;

            color: #6b7280;

            font-size: 14px;
        }

        .event-name {
            margin-top: 18px;

            font-size: 24px;

            font-weight: 700;
        }

        .event-info {
            margin-top: 8px;

            color: #6b7280;

            font-size: 15px;

            line-height: 1.7;
        }

        /*
        |--------------------------------------------------------------------------
        | Event Selector
        |--------------------------------------------------------------------------
        */

        .event-selector {
            width: 100%;

            max-width: 620px;

            margin: 25px auto 0;

            text-align: left;
        }

        .event-selector label {
            display: block;

            margin-bottom: 8px;

            font-size: 14px;

            font-weight: 700;

            color: #374151;
        }

        .event-selector select {
            width: 100%;

            min-height: 48px;

            padding: 12px 14px;

            border: 1px solid #9ca3af;

            border-radius: 10px;

            background: #ffffff;

            color: #111827;

            font-size: 15px;

            cursor: pointer;

            outline: none;
        }

        .event-selector select:focus {
            border-color: #861b24;

            box-shadow: 0 0 0 3px rgba(134, 27, 36, 0.12);
        }

        /*
        |--------------------------------------------------------------------------
        | QR Section
        |--------------------------------------------------------------------------
        */

        .qr-section {

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            padding: 25px 10px;
        }

        .qr-wrapper {

            width: 360px;

            max-width: 100%;

            padding: 20px;

            background: #ffffff;

            border: 1px solid #d1d5db;

            border-radius: 16px;

            display: flex;

            align-items: center;

            justify-content: center;
        }

        #qr-code {

            display: block;

            width: 320px;

            height: 320px;

            max-width: 100%;
        }

        /*
        |--------------------------------------------------------------------------
        | Instruction
        |--------------------------------------------------------------------------
        */

        .instruction {

            margin-top: 25px;

            text-align: center;

            font-size: 21px;

            font-weight: 700;
        }

        .instruction-sub {

            margin-top: 8px;

            text-align: center;

            color: #6b7280;

            font-size: 15px;

            line-height: 1.6;
        }

        /*
        |--------------------------------------------------------------------------
        | URL
        |--------------------------------------------------------------------------
        */

        .url-label {

            margin-top: 25px;

            text-align: center;

            font-size: 13px;

            font-weight: 700;

            color: #6b7280;
        }

        .url-box {

            width: 100%;

            margin-top: 8px;

            padding: 14px 16px;

            background: #f9fafb;

            border: 1px solid #d1d5db;

            border-radius: 8px;

            word-break: break-all;

            text-align: center;

            font-size: 14px;

            color: #374151;
        }

        /*
        |--------------------------------------------------------------------------
        | Error
        |--------------------------------------------------------------------------
        */

        .error {

            width: 100%;

            margin-top: 15px;

            padding: 14px;

            color: #b91c1c;

            background: #fef2f2;

            border: 1px solid #fecaca;

            border-radius: 8px;

            text-align: center;

            font-size: 14px;
        }

        /*
        |--------------------------------------------------------------------------
        | Buttons
        |--------------------------------------------------------------------------
        */

        .actions {

            display: flex;

            align-items: center;

            justify-content: center;

            flex-wrap: wrap;

            gap: 12px;

            margin-top: 25px;
        }

        .btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-height: 44px;

            padding: 11px 20px;

            border-radius: 8px;

            text-decoration: none;

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            border: 1px solid transparent;

            white-space: nowrap;
        }

        .btn-primary {

            background: #111827;

            color: #ffffff;

            border-color: #111827;
        }

        .btn-primary:hover {

            background: #000000;

            border-color: #000000;
        }

        .btn-secondary {

            background: #ffffff;

            color: #111827;

            border-color: #9ca3af;
        }

        .btn-secondary:hover {

            background: #f9fafb;
        }

        /*
        |--------------------------------------------------------------------------
        | Mobile
        |--------------------------------------------------------------------------
        */

        @media (max-width: 600px) {

            .page {

                margin: 20px auto;

                padding: 10px;

            }

            .card {

                padding: 20px;

            }

            .title {

                font-size: 23px;

            }

            .event-name {

                font-size: 20px;

            }

            #qr-code {

                width: 280px;

                height: 280px;

            }

            .instruction {

                font-size: 18px;

            }

            .event-selector {
                margin-top: 20px;
            }

        }

        /*
        |--------------------------------------------------------------------------
        | Print
        |--------------------------------------------------------------------------
        */

        @media print {

            body {

                background: #ffffff;

            }

            .page {

                max-width: none;

                margin: 0;

                padding: 0;

            }

            .card {

                border: none;

                border-radius: 0;

                box-shadow: none;

            }

            .actions,
            .url-label,
            .url-box,
            .event-selector {

                display: none !important;

            }

            .qr-wrapper {

                border: none;

                padding: 10px;

            }

            .qr-section {

                padding-top: 10px;

            }

        }

    </style>

</head>


<body>


<div class="page">

    <div class="card">


        {{-- ============================================================
             HEADER
        ============================================================= --}}

        <div class="header">

            <div class="title">
                MELAKA DIGITAL GUESTBOOK
            </div>

            <div class="subtitle">
                Smart Visitor Registration & Digital Signature
            </div>


            <div class="event-name">
                {{ $event->name }}
            </div>


            <div class="event-info">

                <div>
                    Tarikh:
                    {{ $event->event_date->format('d/m/Y') }}
                </div>


                @if ($event->location)

                    <div>
                        Lokasi:
                        {{ $event->location }}
                    </div>

                @endif

            </div>


            {{-- ========================================================
                 PILIH EVENT
            ========================================================= --}}

            <div class="event-selector">

                <label for="event-select">
                    Pilih Event Aktif
                </label>

                <select
                    id="event-select"
                    onchange="if (this.value) window.location.href = this.value;">

                    @foreach ($activeEvents as $activeEvent)

                        <option
                            value="{{ route('admin.events.qr', $activeEvent) }}"
                            {{ $activeEvent->id == $event->id ? 'selected' : '' }}>

                            {{ $activeEvent->name }}

                        </option>

                    @endforeach

                </select>

            </div>

        </div>


        {{-- ============================================================
             QR
        ============================================================= --}}

        <div class="qr-section">


            <div class="qr-wrapper">

                <canvas
                    id="qr-code"
                    width="320"
                    height="320">
                </canvas>

            </div>


            {{-- URL untuk qr.js --}}

            <div
                id="qr-url"
                data-url="{{ $registerUrl }}"
                style="display: none;">
            </div>


            {{-- Error --}}

            <div
                id="qr-error"
                class="error"
                style="display: none;">
            </div>


            {{-- Instruction --}}

            <div class="instruction">

                📱 SCAN UNTUK PENDAFTARAN

            </div>


            <div class="instruction-sub">

                Imbas kod QR menggunakan telefon anda
                untuk mendaftar sebagai pengunjung
                dan meninggalkan ucapan untuk event ini.

            </div>


            {{-- URL --}}

            <div class="url-label">

                URL PENDAFTARAN

            </div>


            <div class="url-box">

                {{ $registerUrl }}

            </div>


            {{-- Actions --}}

            <div class="actions">


                <button
                    type="button"
                    id="print-qr"
                    class="btn btn-primary">

                    CETAK QR

                </button>


                <a
                    href="{{ route('admin.events.index') }}"
                    class="btn btn-secondary">

                    KEMBALI

                </a>


            </div>


        </div>


    </div>

</div>


{{-- ================================================================
     PRINT
================================================================ --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const printButton =
            document.getElementById('print-qr');


        if (printButton) {

            printButton.addEventListener(
                'click',
                function () {

                    window.print();

                }
            );

        }

    }
);

</script>


</body>

</html>