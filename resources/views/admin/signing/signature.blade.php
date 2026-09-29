<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Papar Tandatangan - {{ $signer->name }}
    </title>

    @vite([
        'resources/css/app.css'
    ])

    <style>

        body {
            margin: 0;
            min-height: 100vh;
            background: #f3f4f6;
            font-family: Arial, Helvetica, sans-serif;
            color: #111827;
        }

        .page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .card {
            width: 100%;
            max-width: 900px;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 25px;
        }

        .brand {
            font-size: 26px;
            font-weight: 700;
        }

        .event {
            margin-top: 10px;
            font-size: 18px;
            font-weight: 600;
        }

        .location {
            margin-top: 5px;
            color: #6b7280;
            font-size: 14px;
        }

        .signer {
            margin-top: 30px;
            text-align: center;
        }

        .signer-label {
            font-size: 13px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .signer-name {
            margin-top: 8px;
            font-size: 30px;
            font-weight: 700;
        }

        .signer-position {
            margin-top: 5px;
            font-size: 17px;
            color: #374151;
        }

        .signer-org {
            margin-top: 4px;
            font-size: 15px;
            color: #6b7280;
        }

        .signature-section {
            margin-top: 35px;
        }

        .signature-title {
            text-align: center;
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .signature-box {
            min-height: 320px;
            border: 2px dashed #9ca3af;
            border-radius: 14px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .signature-box img {
            max-width: 100%;
            max-height: 280px;
            object-fit: contain;
        }

        .empty {
            text-align: center;
            color: #6b7280;
            padding: 70px 20px;
        }

        .empty-icon {
            font-size: 52px;
            margin-bottom: 15px;
        }

        .empty-title {
            font-size: 20px;
            font-weight: 700;
            color: #374151;
        }

        .empty-text {
            margin-top: 8px;
            font-size: 14px;
        }

        .meta {
            margin-top: 20px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
        }

        .btn-back {
            display: inline-block;
            margin-top: 25px;
            padding: 11px 22px;
            border-radius: 8px;
            background: #ffffff;
            border: 1px solid #d1d5db;
            color: #374151;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-back:hover {
            background: #f9fafb;
        }

        @media (max-width: 700px) {

            .page {
                padding: 15px;
            }

            .card {
                padding: 25px 18px;
            }

            .brand {
                font-size: 21px;
            }

            .signer-name {
                font-size: 24px;
            }

            .signature-box {
                min-height: 240px;
            }

        }

    </style>

</head>


<body>

<div class="page">

    <div class="card">

        <div class="header">

            <div class="brand">
                MELAKA DIGITAL GUESTBOOK
            </div>

            <div class="event">
                {{ $event->name }}
            </div>

            @if ($event->location)

                <div class="location">
                    {{ $event->location }}
                </div>

            @endif

        </div>


        <div class="signer">

            <div class="signer-label">
                Tandatangan Individu
            </div>

            <div class="signer-name">
                {{ $signer->name }}
            </div>

            @if ($signer->position)

                <div class="signer-position">
                    {{ $signer->position }}
                </div>

            @endif

            @if ($signer->organization)

                <div class="signer-org">
                    {{ $signer->organization }}
                </div>

            @endif

        </div>


        <div class="signature-section">

            <div class="signature-title">
                Tandatangan Digital
            </div>


            <div class="signature-box">

                @if ($signature)

                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($signature->signature_path) }}"
                        alt="Tandatangan {{ $signer->name }}"
                    >

                @else

                    <div class="empty">

                        <div class="empty-icon">
                            ✍️
                        </div>

                        <div class="empty-title">
                            Tiada Tandatangan
                        </div>

                        <div class="empty-text">
                            Individu ini belum mempunyai
                            rekod tandatangan untuk event ini.
                        </div>

                    </div>

                @endif

            </div>


            @if ($signature)

                <div class="meta">

                    Signature ID:
                    {{ $signature->id }}

                    &nbsp; • &nbsp;

                    Session ID:
                    {{ $signature->signing_session_id }}

                    &nbsp; • &nbsp;

                    Tarikh:
                    {{ $signature->signed_at?->format('d/m/Y H:i:s') }}

                </div>

            @endif


            <div style="text-align:center;">

                <a
                    href="{{ route('admin.events.signing', ['event' => $event->id]) }}"
                    class="btn-back"
                >
                    ← Kembali
                </a>

            </div>

        </div>

    </div>

</div>

</body>

</html>