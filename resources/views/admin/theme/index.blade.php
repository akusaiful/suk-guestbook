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
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fa;
            color: #172033;
        }

        .page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 30px;
        }

        .header {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 22px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .header p {
            margin: 8px 0 0;
            color: #64748b;
        }

        .message {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 12px;
            background: #dcfce7;
            color: #166534;
            font-size: 14px;
            font-weight: 600;
        }

        .theme-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .theme-card {
            background: #ffffff;
            border: 2px solid #e5e7eb;
            border-radius: 18px;
            overflow: hidden;
            transition: .2s ease;
        }

        .theme-card.active {
            border-color: #9f1d24;
        }

        .theme-card:hover {
            transform: translateY(-2px);
        }

        .preview {
            min-height: 180px;
            padding: 18px;
            display: flex;
            align-items: flex-end;
        }

        .preview-inner {
            width: 100%;
            padding: 18px;
            border-radius: 15px;
            color: #ffffff;
        }

        .melaka-classic {
            background:
                linear-gradient(
                    135deg,
                    #3a0710,
                    #861b24,
                    #c39a52
                );
        }

        .government-blue {
            background:
                linear-gradient(
                    135deg,
                    #0b2f5b,
                    #0b5cab,
                    #38bdf8
                );
        }

        .modern-melaka {
            background:
                linear-gradient(
                    135deg,
                    #1f2937,
                    #9a3412,
                    #ea580c
                );
        }

        .card-body {
            padding: 18px;
        }

        .theme-name {
            font-size: 18px;
            font-weight: 800;
        }

        .theme-description {
            margin-top: 6px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .badge {
            display: inline-block;
            margin-bottom: 10px;
            padding: 5px 9px;
            border-radius: 999px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 11px;
            font-weight: 800;
        }

        .button {
            margin-top: 16px;
            border: 0;
            border-radius: 10px;
            padding: 10px 14px;
            background: #9f1d24;
            color: #ffffff;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
        }

        .button:hover {
            background: #861b24;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 14px;
            border-radius: 10px;
            background: #eef2f7;
            color: #334155;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
        }

        /* =========================================================
           HEADER ARTWORK SELECTOR
        ========================================================== */

        .section-block {
            margin-top: 30px;
        }

        .section-heading {
            margin: 0 0 6px;
            font-size: 22px;
            font-weight: 800;
        }

        .section-description {
            margin: 0 0 16px;
            color: #64748b;
            font-size: 14px;
            line-height: 1.5;
        }

        .header-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }

        .header-card {
            background: #ffffff;
            border: 2px solid #e5e7eb;
            border-radius: 18px;
            overflow: hidden;
            transition: .2s ease;
        }

        .header-card.active {
            border-color: #9f1d24;
            box-shadow: 0 0 0 3px rgba(159, 29, 36, .08);
        }

        .header-card:hover {
            transform: translateY(-2px);
        }

        .header-preview {
            aspect-ratio: 1460 / 426;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .header-preview img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: fill;
        }

        .header-body {
            padding: 16px;
        }

        .header-name {
            font-size: 17px;
            font-weight: 800;
        }

        .header-description {
            margin-top: 6px;
            min-height: 40px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.45;
        }

        .header-button {
            width: 100%;
            margin-top: 14px;
            border: 0;
            border-radius: 10px;
            padding: 10px 12px;
            background: #9f1d24;
            color: #ffffff;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
        }

        .header-button:hover {
            background: #861b24;
        }

        @media (max-width: 1100px) {
            .header-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .header-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {

            .theme-grid {
                grid-template-columns: 1fr;
            }

            .page {
                padding: 18px;
            }

        }

    </style>

</head>

<body>

<div class="page">

    <div class="header">

        <h1>
            🎨 Tema Paparan
        </h1>

        <p>
            Event:
            <strong>
                {{ $event->name }}
            </strong>
        </p>

    </div>


    @if (session('success'))

        <div class="message">

            {{ session('success') }}

        </div>

    @endif


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

                <div class="preview {{ $key }}">

                    <div class="preview-inner">

                        <div
                            style="
                                font-size:12px;
                                opacity:.85;
                            "
                        >
                            MELAKA DIGITAL GUESTBOOK
                        </div>

                        <div
                            style="
                                margin-top:6px;
                                font-size:21px;
                                font-weight:800;
                            "
                        >
                            {{ $theme['name'] }}
                        </div>

                    </div>

                </div>


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
                        action="{{ route('admin.events.theme.update', [
                            'event' => $event->id
                        ]) }}"
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
                            Gunakan Tema
                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    </div>




    <div class="section-block">

        <h2 class="section-heading">
            Header Paparan
        </h2>

        <p class="section-description">
            Pilih artwork untuk Header 1-4. Saiz, kedudukan dan susunan header
            pada Main Display dikekalkan; hanya gambar header yang berubah.
        </p>

        <div class="header-grid">

            @php
                $headerImages = config('guestbook.header_images', []);
                $currentHeader = $event->header_image
                    ?? config('guestbook.default_header_image', 'header-1');
            @endphp

            @foreach ($headerImages as $key => $header)

                @php
                    $isHeaderActive = $currentHeader === $key;
                @endphp

                <div class="header-card {{ $isHeaderActive ? 'active' : '' }}">

                    <div class="header-preview">
                        <img
                            src="{{ asset($header['image']) }}"
                            alt="{{ $header['name'] }}"
                        >
                    </div>

                    <div class="header-body">

                        @if ($isHeaderActive)
                            <div class="badge">
                                ✓ HEADER SEMASA
                            </div>
                        @endif

                        <div class="header-name">
                            {{ $header['name'] }}
                        </div>

                        <div class="header-description">
                            {{ $header['description'] }}
                        </div>

                        <form
                            method="POST"
                            action="{{ route('admin.events.theme.update', [
                                'event' => $event->id
                            ]) }}"
                        >

                            @csrf

                            @method('PUT')

                            <input
                                type="hidden"
                                name="header_image"
                                value="{{ $key }}"
                            >

                            <button
                                type="submit"
                                class="header-button"
                            >
                                Gunakan Header
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    </div>


    <a
        href="{{ route('admin.dashboard') }}"
        class="back"
    >
        ← Kembali ke Admin Dashboard
    </a>

</div>

</body>

</html>