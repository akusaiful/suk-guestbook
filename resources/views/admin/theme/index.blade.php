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


    <a
        href="{{ route('admin.dashboard') }}"
        class="back"
    >
        ← Kembali ke Admin Dashboard
    </a>

</div>

</body>

</html>