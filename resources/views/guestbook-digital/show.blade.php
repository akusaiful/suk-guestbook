<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $event->name }} - Guestbook Digital Melaka
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        :root {
            --maroon: #861b24;
            --maroon-dark: #69131a;
            --gold: #c39a52;
            --gold-light: #f4e5c9;
            --cream: #f7f1e8;
            --cream-2: #fffaf3;
            --brown: #3d251b;
            --muted: #77665b;
            --border: #ddcdb7;
            --white: #ffffff;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family:
                Arial,
                Helvetica,
                sans-serif;
            color: var(--brown);
            background:
                radial-gradient(
                    circle at top center,
                    rgba(195,154,82,.10),
                    transparent 34%
                ),
                linear-gradient(
                    180deg,
                    #f9f5ee 0%,
                    #f3ece2 100%
                );
        }

        a {
            color: inherit;
        }

        .page {
            min-height: 100vh;
        }

        /*
        |--------------------------------------------------------------------------
        | HERO
        |--------------------------------------------------------------------------
        */

        .hero {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(
                    135deg,
                    #6f151d 0%,
                    #861b24 48%,
                    #5d1118 100%
                );
            color: #ffffff;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: .16;
            background:
                radial-gradient(
                    circle at 15% 20%,
                    #ffffff 0 1px,
                    transparent 1.5px
                ),
                radial-gradient(
                    circle at 84% 36%,
                    #ffffff 0 1px,
                    transparent 1.5px
                ),
                radial-gradient(
                    circle at 54% 74%,
                    #ffffff 0 1px,
                    transparent 1.5px
                );
            background-size: 120px 120px, 170px 170px, 145px 145px;
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            max-width: 1650px;
            margin: 0 auto;
            padding: 12px 12px 34px;
        }

        .hero-top {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 20px;
            margin-bottom: 4px;
        }

        /*
        |--------------------------------------------------------------------------
        | HEADER MELAKA DIGITAL GUESTBOOK
        |--------------------------------------------------------------------------
        | Besar ikut hampir penuh kotak header / garisan kuning dalam paparan.
        | Gambar asal dikekalkan dan diskalakan secara responsif tanpa herotkan
        | nisbah imej. object-fit: cover digunakan supaya ruang header penuh.
        */
        .hero-header-image {
            width: 100%;
            max-width: 1382px;
            margin: 0 auto 10px;
            padding: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #ffffff;
            line-height: 0;
        }

        .hero-header-image img {
            width: 100%;
            height: auto;
            max-height: none;
            object-fit: contain;
            object-position: center;
            display: block;
            filter: drop-shadow(0 8px 18px rgba(0,0,0,.18));
        }

        .hero-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 9px 15px;
            border: 1px solid rgba(255,255,255,.28);
            border-radius: 999px;
            color: #ffffff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            background: rgba(255,255,255,.08);
            backdrop-filter: blur(6px);
        }

        .hero-back:hover {
            background: rgba(255,255,255,.14);
        }

        .hero-content {
            max-width: 1060px;
            margin: 0 auto;
            text-align: center;
        }

        .hero-kicker {
            color: #f5dcaa;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .hero-title {
            margin: 7px 0 0;
            font-size: clamp(23px, 2.65vw, 38px);
            font-weight: 900;
            line-height: 1.10;
        }

        .hero-meta {
            margin-top: 13px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 34px;
            padding: 7px 11px;
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 999px;
            background: rgba(255,255,255,.08);
            color: rgba(255,255,255,.94);
            font-size: 11px;
            font-weight: 700;
        }

        /*
        |--------------------------------------------------------------------------
        | EVENT IMAGE
        |--------------------------------------------------------------------------
        */

        .event-cover {
            max-width: 1260px;
            margin: -20px auto 0;
            padding: 0 24px;
            position: relative;
            z-index: 5;
        }

        .cover-card {
            position: relative;
            overflow: hidden;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow:
                0 16px 38px rgba(61,37,27,.15);
        }

        .cover-carousel {
            position: relative;
            min-height: 315px;
            background:
                linear-gradient(
                    135deg,
                    #e9dfd1,
                    #fbf7f0
                );
            overflow: hidden;
            touch-action: pan-y;
        }

        /* =====================================================
           TRUE HORIZONTAL SLIDE ANIMATION
        ===================================================== */

        .cover-track {
            display: flex;
            width: 100%;
            height: 315px;
            transform: translateX(0);
            transition:
                transform .78s cubic-bezier(.22,.61,.36,1);
            will-change: transform;
        }

        .cover-slide {
            position: relative;
            flex: 0 0 100%;
            width: 100%;
            height: 315px;
            overflow: hidden;
        }

        .cover-slide img {
            width: 100%;
            height: 315px;
            display: block;
            object-fit: cover;
            transform: scale(1.001);
        }

        .cover-slide::after {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(
                    180deg,
                    rgba(0,0,0,.02) 34%,
                    rgba(0,0,0,.62) 100%
                );
            pointer-events: none;
        }

        .cover-caption {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 3;
            padding: 18px 22px 46px;
            color: #ffffff;
        }

        .cover-caption-label {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            opacity: .90;
        }

        .cover-caption-text {
            margin-top: 5px;
            font-size: 17px;
            font-weight: 800;
            line-height: 1.35;
            text-shadow: 0 2px 8px rgba(0,0,0,.24);
        }

        .cover-arrow {
            position: absolute;
            top: 50%;
            z-index: 5;
            width: 38px;
            height: 38px;
            margin-top: -19px;
            border: 1px solid rgba(255,255,255,.42);
            border-radius: 50%;
            background: rgba(0,0,0,.30);
            color: #ffffff;
            font-size: 22px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            backdrop-filter: blur(5px);
            transition: background .2s ease, transform .2s ease;
        }

        .cover-arrow:hover {
            background: rgba(0,0,0,.46);
            transform: scale(1.04);
        }

        .cover-arrow.prev {
            left: 14px;
        }

        .cover-arrow.next {
            right: 14px;
        }

        .cover-dots {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 14px;
            z-index: 6;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .cover-dot {
            width: 8px;
            height: 8px;
            padding: 0;
            border: 1px solid rgba(255,255,255,.72);
            border-radius: 50%;
            background: rgba(255,255,255,.38);
            cursor: pointer;
            transition: all .2s ease;
        }

        .cover-dot.active {
            width: 22px;
            border-radius: 999px;
            background: #ffffff;
        }

        @media (prefers-reduced-motion: reduce) {
            .cover-track {
                transition: none !important;
            }
        }

        .cover-counter {
            position: absolute;
            right: 14px;
            bottom: 14px;
            z-index: 6;
            min-height: 27px;
            padding: 5px 9px;
            border: 1px solid rgba(255,255,255,.30);
            border-radius: 999px;
            background: rgba(0,0,0,.30);
            color: #ffffff;
            font-size: 10px;
            font-weight: 800;
            backdrop-filter: blur(5px);
        }

        .no-cover {
            min-height: 315px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 35px;
            background:
                radial-gradient(
                    circle at center,
                    rgba(195,154,82,.12),
                    transparent 55%
                ),
                linear-gradient(
                    135deg,
                    #fffaf3,
                    #efe3d1
                );
        }

        .no-cover-icon {
            font-size: 56px;
        }

        .no-cover-title {
            margin-top: 12px;
            color: var(--brown);
            font-size: 20px;
            font-weight: 900;
        }

        .no-cover-text {
            margin-top: 6px;
            color: var(--muted);
            font-size: 14px;
        }

        /*
        |--------------------------------------------------------------------------
        | MAIN CONTENT
        |--------------------------------------------------------------------------
        */

        .container {
            max-width: 1500px;
            margin: 0 auto;
            padding: 34px 30px 60px;
        }

        .section {
            margin-top: 26px;
        }

        .section:first-child {
            margin-top: 0;
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 16px;
        }

        .section-kicker {
            margin: 0;
            color: var(--maroon);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .section-title {
            margin: 5px 0 0;
            color: var(--brown);
            font-size: clamp(24px, 2.6vw, 34px);
            font-weight: 900;
            line-height: 1.18;
        }

        .section-count {
            flex: 0 0 auto;
            min-height: 38px;
            padding: 8px 12px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: rgba(255,255,255,.76);
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
        }

        /*
        |--------------------------------------------------------------------------
        | STATS
        |--------------------------------------------------------------------------
        */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 14px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            min-height: 125px;
            padding: 22px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: rgba(255,255,255,.94);
            box-shadow: 0 5px 17px rgba(61,37,27,.06);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            right: -24px;
            top: -26px;
            width: 92px;
            height: 92px;
            border-radius: 50%;
            background: rgba(195,154,82,.12);
        }

        .stat-icon {
            font-size: 23px;
        }

        .stat-value {
            margin-top: 8px;
            color: var(--maroon);
            font-size: 34px;
            font-weight: 900;
            line-height: 1;
        }

        .stat-label {
            margin-top: 6px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
        }

        /*
        |--------------------------------------------------------------------------
        | SIGNATURES
        |--------------------------------------------------------------------------
        */

        .signature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 18px;
        }

        .signature-card {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 17px;
            background:
                linear-gradient(
                    145deg,
                    #ffffff 0%,
                    #fffaf2 100%
                );
            box-shadow: 0 7px 22px rgba(61,37,27,.07);
        }

        .signature-top {
            padding: 18px 18px 12px;
            text-align: center;
        }

        .signature-label {
            color: var(--gold);
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .signature-name {
            margin-top: 8px;
            color: var(--brown);
            font-size: 19px;
            font-weight: 900;
            line-height: 1.35;
        }

        .signature-position {
            margin-top: 4px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
            line-height: 1.45;
        }

        .signature-org {
            margin-top: 3px;
            color: #99887b;
            font-size: 12px;
        }

        .signature-image {
            margin: 12px 18px 0;
            min-height: 175px;
            border: 1px dashed #d9c9b5;
            border-radius: 12px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .signature-image img {
            width: 100%;
            max-height: 190px;
            object-fit: contain;
            display: block;
        }

        .signature-footer {
            padding: 14px 18px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .signature-time {
            color: #8b7a6c;
            font-size: 11px;
            line-height: 1.4;
        }

        .signature-badge {
            min-height: 30px;
            padding: 6px 9px;
            border-radius: 999px;
            background: var(--gold-light);
            color: var(--brown);
            font-size: 11px;
            font-weight: 800;
        }

        /*
        |--------------------------------------------------------------------------
        | GUESTS / VISITORS
        |--------------------------------------------------------------------------
        */

        .guest-layout {
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 18px;
        }

        .panel {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: rgba(255,255,255,.96);
            box-shadow: 0 5px 17px rgba(61,37,27,.06);
        }

        .panel-header {
            padding: 17px 19px;
            border-bottom: 1px solid #eadcca;
        }

        .panel-title {
            margin: 0;
            color: var(--brown);
            font-size: 18px;
            font-weight: 900;
        }

        .panel-subtitle {
            margin-top: 4px;
            color: var(--muted);
            font-size: 12px;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .visitor-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 680px;
        }

        .visitor-table th {
            padding: 13px 15px;
            text-align: left;
            color: #7d6d60;
            background: #faf7f2;
            border-bottom: 1px solid #eadfce;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .visitor-table td {
            padding: 14px 15px;
            color: #4e4138;
            border-bottom: 1px solid #efe5d8;
            font-size: 13px;
            vertical-align: top;
        }

        .visitor-table tr:last-child td {
            border-bottom: none;
        }

        .visitor-name {
            color: var(--brown);
            font-weight: 800;
        }

        .visitor-org {
            margin-top: 3px;
            color: #8a796c;
            font-size: 11px;
        }

        .method-badge {
            display: inline-flex;
            min-height: 28px;
            align-items: center;
            padding: 5px 8px;
            border-radius: 999px;
            background: #f3eee7;
            color: #6d5d50;
            font-size: 10px;
            font-weight: 800;
        }

        /*
        |--------------------------------------------------------------------------
        | COMMENTS
        |--------------------------------------------------------------------------
        */

        .comments-list {
            padding: 5px 18px 18px;
            max-height: 540px;
            overflow-y: auto;
        }

        .comment-card {
            padding: 15px 0;
            border-bottom: 1px solid #efe5d8;
        }

        .comment-card:last-child {
            border-bottom: none;
        }

        .comment-quote {
            color: var(--maroon);
            font-size: 22px;
            font-weight: 900;
            line-height: 1;
        }

        .comment-text {
            margin-top: 6px;
            color: #4f4239;
            font-size: 14px;
            line-height: 1.65;
        }

        .comment-meta {
            margin-top: 9px;
            color: #948477;
            font-size: 11px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | GALLERY
        |--------------------------------------------------------------------------
        */

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            gap: 14px;
        }

        .gallery-item {
            overflow: hidden;
            aspect-ratio: 16/10;
            border-radius: 13px;
            border: 1px solid var(--border);
            background: #f0e8de;
            box-shadow: 0 4px 13px rgba(61,37,27,.05);
        }

        .gallery-item a,
        .gallery-item img {
            width: 100%;
            height: 100%;
            display: block;
        }

        .gallery-item img {
            object-fit: cover;
            transition: transform .25s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.04);
        }

        /*
        |--------------------------------------------------------------------------
        | EMPTY
        |--------------------------------------------------------------------------
        */

        .empty {
            padding: 48px 24px;
            text-align: center;
            color: var(--muted);
        }

        .empty-icon {
            font-size: 45px;
        }

        .empty-title {
            margin-top: 10px;
            color: var(--brown);
            font-size: 18px;
            font-weight: 900;
        }

        .empty-text {
            margin-top: 5px;
            font-size: 13px;
        }

        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        .footer {
            padding: 25px 30px 35px;
            text-align: center;
            color: #8c7b6e;
            font-size: 11px;
        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1100px) {

            .cover-carousel {
                min-height: 290px;
            }

            .cover-slide img {
                height: 290px;
            }

            .signature-grid {
                grid-template-columns: repeat(2, minmax(0,1fr));
            }

            .gallery-grid {
                grid-template-columns: repeat(3, minmax(0,1fr));
            }

        }

        @media (max-width: 900px) {

            .hero-inner,
            .container,
            .event-cover,
            .footer {
                padding-left: 18px;
                padding-right: 18px;
            }

            .guest-layout {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(3, minmax(0,1fr));
            }

        }

        @media (max-width: 650px) {

            .hero-inner {
                padding-top: 25px;
                padding-bottom: 35px;
            }

            .hero-top {
                align-items: flex-end;
                flex-direction: column;
                margin-bottom: 8px;
            }

            .hero-header-image {
                width: calc(100vw - 20px);
                height: auto;
                border-radius: 11px;
            }

            .hero-header-image img {
                width: 100%;
                height: auto;
                max-height: none;
                object-fit: contain;
                object-position: center;
            }

            .hero-title {
                font-size: 25px;
            }

            .event-cover {
                margin-top: -14px;
                padding-left: 14px;
                padding-right: 14px;
            }

            .cover-card {
                border-radius: 14px;
            }

            .cover-carousel {
                min-height: 230px;
            }

            .cover-slide img {
                height: 230px;
            }

            .cover-caption {
                padding: 14px 16px 42px;
            }

            .cover-caption-text {
                font-size: 14px;
            }

            .cover-arrow {
                width: 34px;
                height: 34px;
                margin-top: -17px;
            }

            .container {
                padding-top: 25px;
                padding-bottom: 45px;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .stats-grid,
            .signature-grid,
            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                min-height: 108px;
            }

        }

    </style>

</head>


<body>

<div class="page">

    {{-- =========================================================
         HERO
    ========================================================== --}}

    <section class="hero">

        <div class="hero-inner">

            <div class="hero-top">

                <a
                    href="{{ route('admin.guestbook-digital.index') }}"
                    class="hero-back"
                >
                    ← Senarai Guestbook
                </a>

            </div>


            <div class="hero-header-image">

                <img
                    src="{{ asset('images/melaka-digital-guestbook-header.png') }}"
                    alt="Melaka Digital Guestbook"
                >

            </div>


            <div class="hero-content">

                <div class="hero-kicker">
                    Guestbook Digital Melaka
                </div>

                <h1 class="hero-title">
                    {{ $event->name }}
                </h1>

                <div class="hero-meta">

                    <span class="hero-pill">
                        📅
                        {{ optional($event->event_date)->format('d/m/Y') ?? '-' }}
                    </span>

                    <span class="hero-pill">
                        📍
                        {{ $event->location ?: '-' }}
                    </span>

                    <span class="hero-pill">
                        Event ID {{ $event->id }}
                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         EVENT COVER / GALLERY
    ========================================================== --}}

    <div class="event-cover">

        <div class="cover-card">

            @if ($images->count())

                <div
                    class="cover-carousel"
                    id="event-image-carousel"
                    tabindex="0"
                    aria-label="Paparan slideshow gambar event"
                >

                    <div
                        class="cover-track"
                        id="event-image-track"
                    >

                        @foreach ($images as $index => $image)

                            <div
                                class="cover-slide"
                                data-slide="{{ $index }}"
                                aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
                            >

                            <a
                                href="{{ asset('storage/' . $image->image_path) }}"
                                target="_blank"
                                rel="noopener"
                                title="Buka gambar penuh"
                            >

                                <img
                                    src="{{ asset('storage/' . $image->image_path) }}"
                                    alt="{{ $image->caption ?: $event->name }}"
                                    loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                >

                            </a>

                            @if ($image->caption)

                                <div class="cover-caption">

                                    <div class="cover-caption-label">
                                        Gambar Event {{ $index + 1 }} / {{ $images->count() }}
                                    </div>

                                    <div class="cover-caption-text">
                                        {{ $image->caption }}
                                    </div>

                                </div>

                            @else

                                <div class="cover-caption">

                                    <div class="cover-caption-label">
                                        Gambar Event {{ $index + 1 }} / {{ $images->count() }}
                                    </div>

                                    <div class="cover-caption-text">
                                        {{ $event->name }}
                                    </div>

                                </div>

                            @endif

                        </div>

                        @endforeach

                    </div>


                    @if ($images->count() > 1)

                        <button
                            type="button"
                            class="cover-arrow prev"
                            id="event-image-prev"
                            aria-label="Gambar sebelum"
                        >
                            ‹
                        </button>

                        <button
                            type="button"
                            class="cover-arrow next"
                            id="event-image-next"
                            aria-label="Gambar seterusnya"
                        >
                            ›
                        </button>

                        <div
                            class="cover-dots"
                            id="event-image-dots"
                            aria-label="Pilih gambar"
                        >

                            @foreach ($images as $index => $image)

                                <button
                                    type="button"
                                    class="cover-dot {{ $index === 0 ? 'active' : '' }}"
                                    data-slide-to="{{ $index }}"
                                    aria-label="Paparkan gambar {{ $index + 1 }}"
                                ></button>

                            @endforeach

                        </div>

                        <div
                            class="cover-counter"
                            id="event-image-counter"
                        >
                            1 / {{ $images->count() }}
                        </div>

                    @endif

                </div>

            @else

                <div class="no-cover">

                    <div>

                        <div class="no-cover-icon">
                            📖
                        </div>

                        <div class="no-cover-title">
                            Guestbook Digital Melaka
                        </div>

                        <div class="no-cover-text">
                            Tiada gambar event dimuat naik.
                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>


    <main class="container">

        {{-- =========================================================
             STATS
        ========================================================== --}}

        <section class="section">

            <div class="section-heading">

                <div>

                    <p class="section-kicker">
                        Ringkasan Event
                    </p>

                    <h2 class="section-title">
                        Kenangan & Rekod Tetamu
                    </h2>

                </div>

            </div>


            <div class="stats-grid">

                <article class="stat-card">

                    <div class="stat-icon">
                        👥
                    </div>

                    <div class="stat-value">
                        {{ number_format($visitorCount) }}
                    </div>

                    <div class="stat-label">
                        Jumlah Pengunjung
                    </div>

                </article>


                <article class="stat-card">

                    <div class="stat-icon">
                        ✍️
                    </div>

                    <div class="stat-value">
                        {{ number_format($signatureCount) }}
                    </div>

                    <div class="stat-label">
                        Tetamu Yang Menandatangani
                    </div>

                </article>


                <article class="stat-card">

                    <div class="stat-icon">
                        💬
                    </div>

                    <div class="stat-value">
                        {{ number_format($commentCount) }}
                    </div>

                    <div class="stat-label">
                        Komen Event
                    </div>

                </article>

            </div>

        </section>


        {{-- =========================================================
             VIP / SIGNATURES
        ========================================================== --}}

        <section class="section">

            <div class="section-heading">

                <div>

                    <p class="section-kicker">
                        Tandatangan
                    </p>

                    <h2 class="section-title">
                        Tetamu Kehormat & Penandatangan
                    </h2>

                </div>

                <div class="section-count">
                    {{ $signatureCount }} tandatangan
                </div>

            </div>


            @if ($signatures->count())

                <div class="signature-grid">

                    @foreach ($signatures as $signature)

                        @php
                            $signer = $signature->signingSession?->signer;
                        @endphp

                        <article class="signature-card">

                            <div class="signature-top">

                                <div class="signature-label">
                                    Tetamu / Penandatangan
                                </div>

                                <div class="signature-name">
                                    {{ $signer?->name ?? 'Tetamu' }}
                                </div>

                                <div class="signature-position">
                                    {{ $signer?->position ?? '-' }}
                                </div>

                                @if ($signer?->organization)

                                    <div class="signature-org">
                                        {{ $signer->organization }}
                                    </div>

                                @endif

                            </div>


                            <div class="signature-image">

                                @if ($signature->signature_path)

                                    <img
                                        src="{{ asset('storage/' . $signature->signature_path) }}"
                                        alt="Tandatangan {{ $signer?->name ?? 'Tetamu' }}"
                                        loading="lazy"
                                    >

                                @else

                                    <span style="color:#9a8a7b;font-size:13px;">
                                        Tandatangan tidak tersedia
                                    </span>

                                @endif

                            </div>


                            <div class="signature-footer">

                                <div class="signature-time">

                                    {{ optional($signature->signed_at)->format('d/m/Y H:i:s') ?? '-' }}

                                </div>

                                <div class="signature-badge">
                                    ✓ Direkodkan
                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="panel">

                    <div class="empty">

                        <div class="empty-icon">
                            ✍️
                        </div>

                        <div class="empty-title">
                            Belum ada tandatangan
                        </div>

                        <div class="empty-text">
                            Belum ada tetamu yang direkodkan membuat tandatangan untuk event ini.
                        </div>

                    </div>

                </div>

            @endif

        </section>


        {{-- =========================================================
             VISITORS + COMMENTS
        ========================================================== --}}

        <section class="section">

            <div class="section-heading">

                <div>

                    <p class="section-kicker">
                        Buku Tetamu
                    </p>

                    <h2 class="section-title">
                        Pengunjung & Komen
                    </h2>

                </div>

            </div>


            <div class="guest-layout">

                {{-- VISITORS --}}

                <div class="panel">

                    <div class="panel-header">

                        <h3 class="panel-title">
                            Senarai Pengunjung
                        </h3>

                        <div class="panel-subtitle">
                            {{ number_format($visitorCount) }} rekod pengunjung
                        </div>

                    </div>


                    @if ($visitors->count())

                        <div class="table-wrap">

                            <table class="visitor-table">

                                <thead>

                                    <tr>

                                        <th>
                                            Bil
                                        </th>

                                        <th>
                                            Nama / Organisasi
                                        </th>

                                        <th>
                                            Tarikh & Masa
                                        </th>

                                        <th>
                                            Kaedah
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($visitors as $index => $visitor)

                                        <tr>

                                            <td>
                                                {{ $index + 1 }}
                                            </td>

                                            <td>

                                                <div class="visitor-name">
                                                    {{ $visitor->name }}
                                                </div>

                                                @if ($visitor->organization)

                                                    <div class="visitor-org">
                                                        {{ $visitor->organization }}
                                                    </div>

                                                @endif

                                            </td>

                                            <td>
                                                {{ optional($visitor->checked_in_at)->format('d/m/Y H:i:s') ?? '-' }}
                                            </td>

                                            <td>

                                                <span class="method-badge">
                                                    {{ strtoupper($visitor->registration_method ?? 'manual') }}
                                                </span>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="empty">

                            <div class="empty-icon">
                                👥
                            </div>

                            <div class="empty-title">
                                Belum ada pengunjung
                            </div>

                            <div class="empty-text">
                                Tiada rekod pengunjung untuk event ini.
                            </div>

                        </div>

                    @endif

                </div>


                {{-- COMMENTS --}}

                <div class="panel">

                    <div class="panel-header">

                        <h3 class="panel-title">
                            Komen Tetamu
                        </h3>

                        <div class="panel-subtitle">
                            Komen yang telah diterbitkan
                        </div>

                    </div>


                    @if ($comments->count())

                        <div class="comments-list">

                            @foreach ($comments as $comment)

                                <article class="comment-card">

                                    <div class="comment-quote">
                                        “
                                    </div>

                                    <div class="comment-text">
                                        {{ $comment->comment ?? '-' }}
                                    </div>

                                    <div class="comment-meta">

                                        {{ optional($comment->published_at)->format('d/m/Y H:i') ?? '-' }}

                                        @if ($comment->visitor_id)
                                            · Visitor #{{ $comment->visitor_id }}
                                        @endif

                                    </div>

                                </article>

                            @endforeach

                        </div>

                    @else

                        <div class="empty">

                            <div class="empty-icon">
                                💬
                            </div>

                            <div class="empty-title">
                                Belum ada komen
                            </div>

                            <div class="empty-text">
                                Tiada komen diterbitkan untuk event ini.
                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </section>


        {{-- =========================================================
             FULL GALLERY
        ========================================================== --}}

        @if ($images->count() > 3)

            <section class="section">

                <div class="section-heading">

                    <div>

                        <p class="section-kicker">
                            Galeri
                        </p>

                        <h2 class="section-title">
                            Semua Gambar Event
                        </h2>

                    </div>

                    <div class="section-count">
                        {{ $images->count() }} gambar
                    </div>

                </div>


                <div class="gallery-grid">

                    @foreach ($images as $image)

                        <div class="gallery-item">

                            <a
                                href="{{ asset('storage/' . $image->image_path) }}"
                                target="_blank"
                                rel="noopener"
                                title="{{ $image->caption ?: 'Lihat gambar penuh' }}"
                            >

                                <img
                                    src="{{ asset('storage/' . $image->image_path) }}"
                                    alt="{{ $image->caption ?: 'Gambar event' }}"
                                    loading="lazy"
                                >

                            </a>

                        </div>

                    @endforeach

                </div>

            </section>

        @endif

    </main>


    <footer class="footer">

        MELAKA DIGITAL GUESTBOOK
        ·
        Guestbook Digital Melaka

        @if ($event->event_date)
            · {{ $event->event_date->format('Y') }}
        @endif

    </footer>

</div>



    @if ($images->count() > 1)

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const carousel = document.getElementById('event-image-carousel');
                if (!carousel) return;

                const track = document.getElementById('event-image-track');
                const slides = Array.from(carousel.querySelectorAll('.cover-slide'));
                const dots = Array.from(carousel.querySelectorAll('.cover-dot'));
                const counter = document.getElementById('event-image-counter');
                const previous = document.getElementById('event-image-prev');
                const next = document.getElementById('event-image-next');

                let current = 0;
                let timer = null;
                const interval = 5000;

                function updateUI() {
                    slides.forEach((slide, i) => {
                        slide.setAttribute('aria-hidden', i === current ? 'false' : 'true');
                    });

                    dots.forEach((dot, i) => {
                        dot.classList.toggle('active', i === current);
                    });

                    if (counter) {
                        counter.textContent = (current + 1) + ' / ' + slides.length;
                    }
                }

                function showSlide(index, animate = true) {
                    if (!track || !slides.length) return;

                    current = (index + slides.length) % slides.length;

                    if (animate) {
                        track.style.transition = 'transform .78s cubic-bezier(.22,.61,.36,1)';
                    } else {
                        track.style.transition = 'none';
                    }

                    track.style.transform = 'translateX(-' + (current * 100) + '%)';
                    updateUI();
                }

                function startAutoPlay() {
                    stopAutoPlay();
                    timer = window.setInterval(() => showSlide(current + 1), interval);
                }

                function stopAutoPlay() {
                    if (timer) {
                        window.clearInterval(timer);
                        timer = null;
                    }
                }

                previous?.addEventListener('click', function () {
                    showSlide(current - 1);
                    startAutoPlay();
                });

                next?.addEventListener('click', function () {
                    showSlide(current + 1);
                    startAutoPlay();
                });

                dots.forEach((dot) => {
                    dot.addEventListener('click', function () {
                        const target = Number(dot.dataset.slideTo || 0);
                        showSlide(target);
                        startAutoPlay();
                    });
                });

                carousel.addEventListener('mouseenter', stopAutoPlay);
                carousel.addEventListener('mouseleave', startAutoPlay);
                carousel.addEventListener('focusin', stopAutoPlay);
                carousel.addEventListener('focusout', startAutoPlay);

                let touchStartX = null;

                carousel.addEventListener('touchstart', function (event) {
                    touchStartX = event.changedTouches?.[0]?.clientX ?? null;
                    stopAutoPlay();
                }, { passive: true });

                carousel.addEventListener('touchend', function (event) {
                    if (touchStartX === null) {
                        startAutoPlay();
                        return;
                    }

                    const touchEndX = event.changedTouches?.[0]?.clientX ?? touchStartX;
                    const distance = touchEndX - touchStartX;

                    if (Math.abs(distance) > 40) {
                        showSlide(distance < 0 ? current + 1 : current - 1);
                    }

                    touchStartX = null;
                    startAutoPlay();
                }, { passive: true });

                document.addEventListener('keydown', function (event) {
                    if (document.activeElement === carousel || carousel.contains(document.activeElement)) {
                        if (event.key === 'ArrowLeft') {
                            showSlide(current - 1);
                            startAutoPlay();
                        }

                        if (event.key === 'ArrowRight') {
                            showSlide(current + 1);
                            startAutoPlay();
                        }
                    }
                });

                window.addEventListener('resize', function () {
                    showSlide(current, false);
                });

                if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    if (track) {
                        track.style.transition = 'none';
                    }
                }

                showSlide(0, false);
                startAutoPlay();
            });
        </script>

    @endif
</body>

</html>
