<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Tema Event - MELAKA DIGITAL GUESTBOOK
    </title>

    @vite(['resources/css/app.css'])


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

            background:
                #f5f7fa;

            color:
                #172033;
        }


        .page {
            max-width:
                1180px;

            margin:
                0 auto;

            padding:
                30px;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .header {

            background:
                #ffffff;

            border:
                1px solid #e5e7eb;

            border-radius:
                18px;

            padding:
                24px;

            margin-bottom:
                22px;

            box-shadow:
                0 4px 18px rgba(15, 23, 42, .04);
        }


        .header-top {

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                20px;
        }


        .header-content h1 {

            margin:
                0;

            font-size:
                28px;

            font-weight:
                800;

            color:
                #172033;
        }


        .header-content p {

            margin:
                8px 0 0;

            color:
                #64748b;

            font-size:
                14px;

            line-height:
                1.5;
        }


        .event-info {

            margin-top:
                18px;

            padding:
                14px 16px;

            background:
                #f8fafc;

            border:
                1px solid #e2e8f0;

            border-radius:
                12px;
        }


        .event-label {

            font-size:
                11px;

            color:
                #64748b;

            font-weight:
                800;

            text-transform:
                uppercase;

            letter-spacing:
                .06em;
        }


        .event-id {

            display:
                inline-block;

            margin-top:
                6px;

            padding:
                4px 8px;

            border-radius:
                7px;

            background:
                #eef2f7;

            color:
                #334155;

            font-size:
                11px;

            font-weight:
                800;
        }


        .event-name {

            margin-top:
                8px;

            font-size:
                16px;

            font-weight:
                800;

            line-height:
                1.4;

            color:
                #172033;
        }


        /* =========================================================
           MESSAGE
        ========================================================== */

        .message {

            margin-bottom:
                18px;

            padding:
                13px 15px;

            border-radius:
                12px;

            background:
                #dcfce7;

            border:
                1px solid #bbf7d0;

            color:
                #166534;

            font-size:
                14px;

            font-weight:
                700;
        }


        /* =========================================================
           THEME GRID
        ========================================================== */

        .theme-grid {

            display:
                grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap:
                18px;
        }


        /* =========================================================
           THEME CARD
        ========================================================== */

        .theme-card {

            background:
                #ffffff;

            border:
                2px solid #e5e7eb;

            border-radius:
                18px;

            overflow:
                hidden;

            transition:
                .2s ease;

            box-shadow:
                0 4px 14px rgba(15, 23, 42, .04);
        }


        .theme-card:hover {

            transform:
                translateY(-3px);

            box-shadow:
                0 10px 26px rgba(15, 23, 42, .08);
        }


        .theme-card.active {

            border-color:
                #9f1d24;

            box-shadow:
                0 0 0 3px rgba(159, 29, 36, .08),
                0 10px 26px rgba(15, 23, 42, .08);
        }


        /* =========================================================
           PREVIEW
        ========================================================== */

        .preview {

            min-height:
                200px;

            padding:
                18px;

            display:
                flex;

            align-items:
                flex-end;
        }


        .preview-inner {

            width:
                100%;

            min-height:
                120px;

            padding:
                20px;

            border-radius:
                15px;

            color:
                #ffffff;

            display:
                flex;

            flex-direction:
                column;

            justify-content:
                flex-end;

            position:
                relative;

            overflow:
                hidden;
        }


        /* =========================================================
           MELAKA CLASSIC
        ========================================================== */

        .melaka-classic {

            background:
                linear-gradient(
                    135deg,
                    #3a0710 0%,
                    #861b24 48%,
                    #c39a52 100%
                );
        }


        .melaka-classic::before {

            content:
                "";

            position:
                absolute;

            width:
                170px;

            height:
                170px;

            right:
                -60px;

            top:
                -65px;

            border:
                26px solid rgba(255,255,255,.08);

            border-radius:
                50%;
        }


        .melaka-classic::after {

            content:
                "";

            position:
                absolute;

            width:
                100px;

            height:
                100px;

            left:
                -45px;

            bottom:
                -45px;

            border:
                16px solid rgba(255,255,255,.07);

            border-radius:
                50%;
        }


        /* =========================================================
           GOVERNMENT BLUE
        ========================================================== */

        .government-blue {

            background:
                linear-gradient(
                    135deg,
                    #0b2f5b 0%,
                    #0b5cab 55%,
                    #38bdf8 100%
                );
        }


        .government-blue::before {

            content:
                "";

            position:
                absolute;

            width:
                180px;

            height:
                180px;

            right:
                -60px;

            bottom:
                -80px;

            border-radius:
                50%;

            background:
                rgba(255,255,255,.08);
        }


        /* =========================================================
           MODERN MELAKA
        ========================================================== */

        .modern-melaka {

            background:
                linear-gradient(
                    135deg,
                    #1f2937 0%,
                    #9a3412 55%,
                    #ea580c 100%
                );
        }


        .modern-melaka::before {

            content:
                "";

            position:
                absolute;

            width:
                140px;

            height:
                140px;

            right:
                -30px;

            top:
                -45px;

            border-radius:
                50%;

            background:
                rgba(255,255,255,.07);
        }


        /* =========================================================
           PREVIEW TEXT
        ========================================================== */

        .preview-brand {

            position:
                relative;

            z-index:
                2;

            font-size:
                11px;

            letter-spacing:
                .08em;

            font-weight:
                800;

            opacity:
                .88;
        }


        .preview-title {

            position:
                relative;

            z-index:
                2;

            margin-top:
                7px;

            font-size:
                22px;

            line-height:
                1.15;

            font-weight:
                900;
        }


        .preview-line {

            position:
                relative;

            z-index:
                2;

            margin-top:
                14px;

            width:
                75px;

            height:
                4px;

            border-radius:
                5px;

            background:
                rgba(255,255,255,.9);
        }


        /* =========================================================
           CARD BODY
        ========================================================== */

        .card-body {

            padding:
                18px;
        }


        .badge {

            display:
                inline-flex;

            align-items:
                center;

            gap:
                5px;

            margin-bottom:
                10px;

            padding:
                5px 9px;

            border-radius:
                999px;

            background:
                #fee2e2;

            color:
                #991b1b;

            font-size:
                11px;

            font-weight:
                800;
        }


        .theme-name {

            font-size:
                18px;

            font-weight:
                800;

            color:
                #172033;
        }


        .theme-description {

            margin-top:
                7px;

            min-height:
                42px;

            color:
                #64748b;

            font-size:
                13px;

            line-height:
                1.5;
        }


        /* =========================================================
           BUTTON
        ========================================================== */

        .button {

            width:
                100%;

            margin-top:
                16px;

            border:
                0;

            border-radius:
                10px;

            padding:
                11px 14px;

            background:
                #9f1d24;

            color:
                #ffffff;

            font-size:
                13px;

            font-weight:
                800;

            cursor:
                pointer;

            transition:
                .2s ease;
        }


        .button:hover {

            background:
                #861b24;
        }


        .theme-card.active .button {

            background:
                #6f1319;
        }


        .theme-card.active .button:hover {

            background:
                #561015;
        }


        /* =========================================================
           BACK BUTTON
        ========================================================== */

        .back {

            display:
                inline-flex;

            align-items:
                center;

            gap:
                6px;

            margin-top:
                22px;

            padding:
                10px 14px;

            border-radius:
                10px;

            background:
                #eef2f7;

            color:
                #334155;

            text-decoration:
                none;

            font-size:
                13px;

            font-weight:
                700;

            transition:
                .2s ease;
        }


        .back:hover {

            background:
                #e2e8f0;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1000px) {

            .theme-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 700px) {

            .page {

                padding:
                    18px;
            }


            .header {

                padding:
                    18px;
            }


            .header-content h1 {

                font-size:
                    23px;
            }


            .theme-grid {

                grid-template-columns:
                    1fr;
            }

        }

    </style>

</head>


<body>

<div class="page">


    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="header">


        <div class="header-top">

            <div class="header-content">

                <h1>
                    🎨 Tema Paparan
                </h1>

                <p>
                    Pilih tema paparan untuk
                    MELAKA DIGITAL GUESTBOOK.
                </p>

            </div>

        </div>


        <div class="event-info">

            <div class="event-label">
                EVENT DIPILIH
            </div>


            <div class="event-id">
                EVENT ID: {{ $event->id }}
            </div>


            <div class="event-name">
                {{ $event->name }}
            </div>

        </div>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if (session('success'))

        <div class="message">

            ✅ {{ session('success') }}

        </div>

    @endif


    {{-- =========================================================
         THEME CARDS
    ========================================================== --}}

    <div class="theme-grid">


        @foreach ($themes as $key => $theme)


            @php

                $currentTheme =
                    $event->theme
                    ?? config('guestbook.default_theme');

                $isActive =
                    $currentTheme === $key;

            @endphp


            <div
                class="theme-card {{ $isActive ? 'active' : '' }}"
            >


                {{-- =================================================
                     PREVIEW
                ================================================== --}}

                <div
                    class="preview {{ $key }}"
                >

                    <div class="preview-inner">


                        <div class="preview-brand">

                            MELAKA DIGITAL GUESTBOOK

                        </div>


                        <div class="preview-title">

                            {{ $theme['name'] }}

                        </div>


                        <div class="preview-line"></div>


                    </div>

                </div>


                {{-- =================================================
                     CARD BODY
                ================================================== --}}

                <div class="card-body">


                    @if ($isActive)

                        <div class="badge">

                            ✓ TEMA SEMASA

                        </div>

                    @endif


                    <div class="theme-name">

                        {{ $theme['name'] }}

                    </div>


                    <div class="theme-description">

                        {{ $theme['description'] }}

                    </div>


                    <form
                        method="POST"
                        action="{{ route(
                            'admin.events.theme.update',
                            [
                                'event' => $event->id
                            ]
                        ) }}"
                    >

                        @csrf

                        @method('PUT')


                        <input
                            type="hidden"
                            name="theme"
                            value="{{ $key }}"
                        >


                        <button
                            type="submit"
                            class="button"
                        >

                            @if ($isActive)

                                ✓ Tema Sedang Digunakan

                            @else

                                Gunakan Tema

                            @endif

                        </button>

                    </form>


                </div>

            </div>


        @endforeach


    </div>


    {{-- =========================================================
         BACK
    ========================================================== --}}

    <a
        href="{{ route('admin.dashboard') }}"
        class="back"
    >

        ← Kembali ke Admin Dashboard

    </a>


</div>

</body>

</html>