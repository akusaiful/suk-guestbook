<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Pilih Event - Gambar Event - MELAKA DIGITAL GUESTBOOK
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
            background: #f3f4f6;
            color: #111827;
        }

        /*
        |--------------------------------------------------------------------------
        | Header
        |--------------------------------------------------------------------------
        */

        .header {
            background: #ffffff;
            border-bottom: 1px solid #d1d5db;
        }

        .header-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
        }

        .header-title {
            margin: 0;
            font-size: 34px;
            font-weight: 700;
            line-height: 1.2;
        }

        .header-subtitle {
            margin-top: 8px;
            color: #6b7280;
            font-size: 18px;
        }

        /*
        |--------------------------------------------------------------------------
        | Container
        |--------------------------------------------------------------------------
        */

        .container {
            max-width: 1450px;
            margin: 0 auto;
            padding: 40px 30px 55px;
        }

        /*
        |--------------------------------------------------------------------------
        | Page Header
        |--------------------------------------------------------------------------
        */

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .page-title {
            margin: 0;
            font-size: 31px;
            font-weight: 700;
            line-height: 1.25;
        }

        .page-description {
            margin: 8px 0 0;
            color: #6b7280;
            font-size: 18px;
            line-height: 1.6;
        }

        .header-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        /*
        |--------------------------------------------------------------------------
        | Buttons
        |--------------------------------------------------------------------------
        */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            padding: 11px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            line-height: 1.2;
            cursor: pointer;
            border: 1px solid transparent;
            white-space: nowrap;
            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn:focus-visible {
            outline: 3px solid rgba(134, 27, 36, 0.18);
            outline-offset: 2px;
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
            border-color: #6b7280;
        }

        /*
        |--------------------------------------------------------------------------
        | Search Card
        |--------------------------------------------------------------------------
        */

        .search-card {
            margin-bottom: 24px;
            padding: 20px;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .search-form {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto auto;
            align-items: end;
            gap: 10px;
        }

        .search-group {
            min-width: 0;
        }

        .search-label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-size: 15px;
            font-weight: 700;
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

        .search-input::placeholder {
            color: #9ca3af;
        }

        .search-input:focus {
            outline: none;
            border-color: #861b24;
            box-shadow: 0 0 0 3px rgba(134, 27, 36, 0.12);
        }

        .btn-search {
            min-width: 110px;
        }

        .btn-reset {
            min-width: 95px;
        }

        /*
        |--------------------------------------------------------------------------
        | Event Grid
        |--------------------------------------------------------------------------
        */

        .events-card {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .events-header {
            padding: 22px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .events-title {
            margin: 0;
            font-size: 21px;
            font-weight: 800;
        }

        .events-count {
            color: #6b7280;
            font-size: 14px;
            font-weight: 700;
        }

        .event-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            padding: 24px;
        }

        /*
        |--------------------------------------------------------------------------
        | Event Card
        |--------------------------------------------------------------------------
        */

        .event-card {
            position: relative;
            min-width: 0;
            padding: 22px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }

        .event-card:hover {
            transform: translateY(-2px);
            border-color: #c9cdd3;
            box-shadow: 0 7px 18px rgba(0, 0, 0, 0.07);
        }

        .event-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
        }

        .event-id {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 64px;
            min-height: 38px;
            padding: 7px 11px;
            border-radius: 8px;
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            color: #111827;
            font-size: 14px;
            font-weight: 800;
        }

        .event-status {
            display: inline-flex;
            align-items: center;
            min-height: 32px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: 800;
        }

        .event-status.inactive {
            background: #f3f4f6;
            color: #4b5563;
        }

        .event-name {
            margin-top: 16px;
            color: #111827;
            font-size: 21px;
            font-weight: 800;
            line-height: 1.38;
        }

        .event-meta {
            margin-top: 14px;
            display: grid;
            gap: 9px;
        }

        .meta-row {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: #4b5563;
            font-size: 14px;
            line-height: 1.5;
        }

        .meta-icon {
            width: 20px;
            flex: 0 0 20px;
            text-align: center;
        }

        .event-description {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid #f0f1f2;
            color: #6b7280;
            font-size: 13px;
            line-height: 1.55;
        }

        .event-action {
            margin-top: 18px;
        }

        .event-action .btn {
            width: 100%;
            min-height: 46px;
            font-size: 14px;
        }

        /*
        |--------------------------------------------------------------------------
        | Empty State
        |--------------------------------------------------------------------------
        */

        .empty-state {
            padding: 75px 24px;
            text-align: center;
        }

        .empty-icon {
            font-size: 52px;
            line-height: 1;
        }

        .empty-title {
            margin-top: 15px;
            color: #374151;
            font-size: 20px;
            font-weight: 800;
        }

        .empty-text {
            margin-top: 7px;
            color: #6b7280;
            font-size: 15px;
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        .pagination-wrap {
            padding: 0 24px 24px;
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1100px) {

            .event-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }

        @media (max-width: 900px) {

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .header-actions .btn {
                flex: 1;
            }

            .container {
                padding: 30px 18px 40px;
            }

            .search-form {
                grid-template-columns: 1fr;
                align-items: stretch;
            }

            .search-form .btn {
                width: 100%;
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

            .events-header {
                padding: 18px;
                align-items: flex-start;
                flex-direction: column;
            }

            .event-grid {
                grid-template-columns: 1fr;
                padding: 18px;
            }

            .pagination-wrap {
                padding: 0 18px 18px;
            }

        }

    </style>

</head>


<body>

    <header class="header">

        <div class="header-inner">

            <h1 class="header-title">
                MELAKA DIGITAL GUESTBOOK
            </h1>

            <div class="header-subtitle">
                Gambar Event
            </div>

        </div>

    </header>


    <main class="container">

        {{-- =========================================================
             PAGE HEADER
        ========================================================== --}}

        <div class="page-header">

            <div>

                <h2 class="page-title">
                    Pilih Event
                </h2>

                <p class="page-description">
                    Pilih event yang ingin anda uruskan gambarnya.
                    Anda boleh mencari menggunakan Nama Event atau Event ID.
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


        {{-- =========================================================
             CARIAN EVENT
        ========================================================== --}}

        <section class="search-card">

            <form
                method="GET"
                action="{{ route('admin.events.images.choose') }}"
                class="search-form"
            >

                <div class="search-group">

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
                        href="{{ route('admin.events.images.choose') }}"
                        class="btn btn-secondary btn-reset"
                    >
                        ↻ Reset
                    </a>

                @endif

            </form>

        </section>


        {{-- =========================================================
             SENARAI EVENT
        ========================================================== --}}

        <section class="events-card">

            <div class="events-header">

                <h3 class="events-title">
                    Senarai Event
                </h3>

                <div class="events-count">

                    {{ $events->total() }}
                    event

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

                                    <span class="event-status">
                                        ● Aktif
                                    </span>

                                @else

                                    <span class="event-status inactive">
                                        ● Tidak Aktif
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


                            @if ($event->description)

                                <div class="event-description">

                                    {{ $event->description }}

                                </div>

                            @endif


                            <div class="event-action">

                                <a
                                    href="{{ route('admin.events.images.index', ['event' => $event->id]) }}"
                                    class="btn btn-primary"
                                >
                                    🖼️ Urus Gambar Event
                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        🔎
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
