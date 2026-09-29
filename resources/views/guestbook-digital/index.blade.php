<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Guestbook Digital Melaka - MELAKA DIGITAL GUESTBOOK
    </title>

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
                linear-gradient(
                    180deg,
                    #f8f3eb 0%,
                    #f3eee6 100%
                );
            color: #111827;
        }

        /* =========================================================
           HEADER MELAKA DIGITAL GUESTBOOK
           Menggunakan artwork/banner rasmi sebagai hero header.
           Simpan artwork di:
           public/images/melaka-digital-guestbook-header.png
           ========================================================= */

        .header {
            position: relative;
            width: 100%;
            min-height: 270px;
            overflow: hidden;
            border-bottom: 4px solid #c9a34e;
            background:
                #0b2b59 url("{{ asset('images/melaka-digital-guestbook-header.png') }}")
                center center / cover no-repeat;
            box-shadow: 0 8px 24px rgba(15, 35, 65, .18);
        }

        .header::after {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: linear-gradient(
                180deg,
                rgba(0, 0, 0, .02) 0%,
                rgba(0, 0, 0, 0) 55%,
                rgba(0, 0, 0, .12) 100%
            );
        }

        .header-inner {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1600px;
            min-height: 270px;
            margin: 0 auto;
            padding: 0;
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
        }

        /* Artwork sudah mengandungi tajuk MELAKA DIGITAL GUESTBOOK,
           jadi teks header lama tidak dipaparkan. */
        .header-title,
        .header-subtitle {
            display: none;
        }

        .container {
            max-width: 1450px;
            margin: 0 auto;
            padding: 40px 30px 55px;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .page-title {
            margin: 0;
            color: #3d251b;
            font-size: 31px;
            font-weight: 800;
            line-height: 1.25;
        }

        .page-description {
            margin: 8px 0 0;
            color: #77665b;
            font-size: 17px;
            line-height: 1.6;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 10px 17px;
            border-radius: 8px;
            text-decoration: none;
            border: 1px solid transparent;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition:
                background-color .2s ease,
                border-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: #861b24;
            border-color: #861b24;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(134,27,36,.12);
        }

        .btn-primary:hover {
            background: #711720;
            border-color: #711720;
        }

        .btn-secondary {
            background: #ffffff;
            border-color: #9ca3af;
            color: #111827;
        }

        .btn-secondary:hover {
            background: #f9fafb;
            border-color: #6b7280;
        }

        .search-card {
            margin-bottom: 24px;
            padding: 20px;
            background: rgba(255,255,255,.98);
            border: 1px solid #d8cbb9;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(61,37,27,.05);
        }

        .search-form {
            display: grid;
            grid-template-columns: minmax(0,1fr) auto auto;
            align-items: end;
            gap: 10px;
        }

        .search-label {
            display: block;
            margin-bottom: 8px;
            color: #4b4039;
            font-size: 15px;
            font-weight: 800;
        }

        .search-input {
            width: 100%;
            min-height: 50px;
            padding: 11px 14px;
            border: 1px solid #9ca3af;
            border-radius: 8px;
            background: #ffffff;
            color: #111827;
            font-size: 16px;
        }

        .search-input:focus {
            outline: none;
            border-color: #861b24;
            box-shadow: 0 0 0 3px rgba(134,27,36,.12);
        }

        .btn-search {
            min-width: 110px;
        }

        .events-card {
            background: rgba(255,255,255,.98);
            border: 1px solid #d8cbb9;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 14px rgba(61,37,27,.05);
        }

        .events-header {
            padding: 22px 24px;
            border-bottom: 1px solid #eadcca;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .events-title {
            margin: 0;
            color: #3d251b;
            font-size: 21px;
            font-weight: 800;
        }

        .events-count {
            color: #77665b;
            font-size: 14px;
            font-weight: 700;
        }

        .event-grid {
            display: grid;
            grid-template-columns: repeat(2,minmax(0,1fr));
            gap: 20px;
            padding: 24px;
        }

        .event-card {
            position: relative;
            padding: 22px;
            min-width: 0;
            background:
                linear-gradient(
                    145deg,
                    #ffffff 0%,
                    #fffaf3 100%
                );
            border: 1px solid #e7d8c3;
            border-radius: 15px;
            box-shadow: 0 5px 16px rgba(61,37,27,.05);
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }

        .event-card:hover {
            transform: translateY(-2px);
            border-color: #c9b99f;
            box-shadow: 0 10px 24px rgba(61,37,27,.09);
        }

        .event-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 18px;
            bottom: 18px;
            width: 4px;
            border-radius: 0 5px 5px 0;
            background: #c39a52;
        }

        .event-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .event-id {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 36px;
            padding: 7px 11px;
            border-radius: 8px;
            background: #f4ede3;
            border: 1px solid #ddcdb7;
            color: #3d251b;
            font-size: 13px;
            font-weight: 800;
        }

        .status {
            display: inline-flex;
            align-items: center;
            min-height: 32px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #e7f5ec;
            color: #267344;
            font-size: 12px;
            font-weight: 800;
        }

        .status.inactive {
            background: #f3f4f6;
            color: #4b5563;
        }

        .event-name {
            margin-top: 16px;
            color: #3d251b;
            font-size: 21px;
            font-weight: 800;
            line-height: 1.42;
        }

        .event-meta {
            margin-top: 15px;
            display: grid;
            gap: 9px;
        }

        .meta-row {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: #5f5148;
            font-size: 14px;
            line-height: 1.5;
        }

        .meta-icon {
            width: 21px;
            flex: 0 0 21px;
            text-align: center;
        }

        .event-stats {
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid #ede3d7;
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 10px;
        }

        .mini-stat {
            padding: 11px 12px;
            border-radius: 9px;
            background: #faf7f1;
            border: 1px solid #eee3d5;
        }

        .mini-stat-value {
            color: #861b24;
            font-size: 20px;
            font-weight: 800;
        }

        .mini-stat-label {
            margin-top: 3px;
            color: #77665b;
            font-size: 11px;
            font-weight: 700;
        }

        .event-action {
            margin-top: 17px;
        }

        .event-action .btn {
            width: 100%;
            min-height: 48px;
        }

        .empty-state {
            padding: 80px 25px;
            text-align: center;
        }

        .empty-icon {
            font-size: 54px;
        }

        .empty-title {
            margin-top: 14px;
            color: #3d251b;
            font-size: 21px;
            font-weight: 800;
        }

        .empty-text {
            margin-top: 7px;
            color: #77665b;
            font-size: 15px;
        }

        .pagination-wrap {
            padding: 0 24px 24px;
        }

        @media (max-width: 950px) {

            .event-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 900px) {

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions .btn {
                flex: 1;
            }

            .search-form {
                grid-template-columns: 1fr;
            }

            .search-form .btn {
                width: 100%;
            }

            .container {
                padding: 30px 18px 40px;
            }

        }

        @media (max-width: 600px) {

            .header-inner {
                padding: 20px 15px;
            }

            .header-title {
                font-size: 27px;
            }

            .header-subtitle {
                font-size: 16px;
            }

            .container {
                padding: 24px 12px 35px;
            }

            .page-title {
                font-size: 26px;
            }

            .page-description {
                font-size: 16px;
            }

            .header-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .header-actions .btn {
                width: 100%;
                flex: none;
            }

            .event-grid {
                padding: 18px;
            }

            .events-header {
                padding: 18px;
                align-items: flex-start;
                flex-direction: column;
            }

            .pagination-wrap {
                padding: 0 18px 18px;
            }

        }

    </style>

</head>


<body>

    <header class="header" aria-label="Melaka Digital Guestbook">

        <div class="header-inner">
            {{-- Tajuk berada terus dalam artwork header. --}}
        </div>

    </header>


    <main class="container">

        <div class="page-header">

            <div>

                <h2 class="page-title">
                    Guestbook Digital Melaka
                </h2>

                <p class="page-description">
                    Pilih event untuk membuka arkib buku tetamu digital,
                    termasuk gambar event, tetamu yang menandatangani,
                    pengunjung dan komen.
                </p>

            </div>


            <div class="header-actions">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="btn btn-secondary"
                >
                    ← Dashboard
                </a>

            </div>

        </div>


        <section class="search-card">

            <form
                method="GET"
                action="{{ route('admin.guestbook-digital.index') }}"
                class="search-form"
            >

                <div>

                    <label
                        for="search"
                        class="search-label"
                    >
                        Carian Nama Event atau Event ID
                    </label>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ $search }}"
                        class="search-input"
                        placeholder="Contoh: Majlis Amanat KSN atau 2"
                        autocomplete="off"
                    >

                </div>


                <button
                    type="submit"
                    class="btn btn-primary btn-search"
                >
                    🔎 Cari
                </button>


                @if ($search !== '')

                    <a
                        href="{{ route('admin.guestbook-digital.index') }}"
                        class="btn btn-secondary"
                    >
                        ↻ Reset
                    </a>

                @endif

            </form>

        </section>


        <section class="events-card">

            <div class="events-header">

                <h3 class="events-title">
                    Pilih Event
                </h3>

                <div class="events-count">
                    {{ $events->total() }} event
                </div>

            </div>


            @if ($events->count())

                <div class="event-grid">

                    @foreach ($events as $event)

                        <article class="event-card">

                            <div class="event-top">

                                <span class="event-id">
                                    ID {{ $event->id }}
                                </span>


                                @if ($event->is_active)

                                    <span class="status">
                                        ● Aktif
                                    </span>

                                @else

                                    <span class="status inactive">
                                        ● Arkib
                                    </span>

                                @endif

                            </div>


                            <div class="event-name">
                                {{ $event->name }}
                            </div>


                            <div class="event-meta">

                                <div class="meta-row">

                                    <span class="meta-icon">
                                        📅
                                    </span>

                                    <span>
                                        {{ optional($event->event_date)->format('d/m/Y') ?? '-' }}
                                    </span>

                                </div>


                                <div class="meta-row">

                                    <span class="meta-icon">
                                        📍
                                    </span>

                                    <span>
                                        {{ $event->location ?: '-' }}
                                    </span>

                                </div>

                            </div>


                            <div class="event-stats">

                                <div class="mini-stat">

                                    <div class="mini-stat-value">
                                        {{ number_format($event->visitors_count ?? 0) }}
                                    </div>

                                    <div class="mini-stat-label">
                                        Pengunjung
                                    </div>

                                </div>


                                <div class="mini-stat">

                                    <div class="mini-stat-value">
                                        {{ number_format($event->visitor_comments_count ?? 0) }}
                                    </div>

                                    <div class="mini-stat-label">
                                        Komen
                                    </div>

                                </div>

                            </div>


                            <div class="event-action">

                                <a
                                    href="{{ route('guestbook-digital.show', ['event' => $event->id]) }}"
                                    class="btn btn-primary"
                                >
                                    📖 Buka Guestbook Digital
                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        📖
                    </div>

                    <div class="empty-title">
                        Event tidak dijumpai
                    </div>

                    <div class="empty-text">
                        Tiada event yang sepadan dengan carian
                        "{{ $search }}".
                    </div>

                </div>

            @endif


            @if ($events->hasPages())

                <div class="pagination-wrap">
                    {{ $events->links() }}
                </div>

            @endif

        </section>

    </main>

</body>

</html>
