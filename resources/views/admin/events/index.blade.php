<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Event Management - MELAKA DIGITAL GUESTBOOK
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

            padding: 24px 24px;
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
            max-width: 1500px;

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


        /*
        |--------------------------------------------------------------------------
        | Header Actions
        |--------------------------------------------------------------------------
        */

        .header-actions {
            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 10px;

            flex-wrap: wrap;
        }


        /*
        |--------------------------------------------------------------------------
        | Buttons - MYDS Inspired
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
                box-shadow 0.2s ease;
        }


        .btn:focus-visible {
            outline: 3px solid rgba(134, 27, 36, 0.18);

            outline-offset: 2px;
        }


        /*
        |--------------------------------------------------------------------------
        | Primary
        |--------------------------------------------------------------------------
        */

        .btn-primary {
            background: #111827;

            color: #ffffff;

            border-color: #111827;
        }


        .btn-primary:hover {
            background: #000000;

            border-color: #000000;
        }


        /*
        |--------------------------------------------------------------------------
        | Secondary
        |--------------------------------------------------------------------------
        */

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
        | Danger
        |--------------------------------------------------------------------------
        */

        .btn-danger {
            background: #ffffff;

            color: #b91c1c;

            border-color: #fca5a5;
        }


        .btn-danger:hover {
            background: #fef2f2;

            border-color: #dc2626;
        }


        /*
        |--------------------------------------------------------------------------
        | Dashboard Button
        |--------------------------------------------------------------------------
        */

        .btn-dashboard {
            background: #ffffff;

            color: #111827;

            border-color: #9ca3af;
        }


        .btn-dashboard:hover {
            background: #f9fafb;

            border-color: #6b7280;
        }


        /*
        |--------------------------------------------------------------------------
        | Alert
        |--------------------------------------------------------------------------
        */

        .alert {
            margin-bottom: 20px;

            padding: 15px 18px;

            border-radius: 8px;

            font-size: 16px;
        }


        .alert-success {
            background: #ecfdf5;

            color: #166534;

            border: 1px solid #bbf7d0;
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

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.04);
        }


        .search-card form {
            display: flex;

            align-items: end;

            gap: 10px;

            flex-wrap: wrap;
        }


        .search-group {
            flex: 1;

            min-width: 360px;
        }


        .search-group label {
            display: block;

            margin-bottom: 8px;

            color: #374151;

            font-size: 15px;

            font-weight: 700;
        }


        .search-group input {
            width: 100%;

            min-height: 50px;

            padding: 11px 14px;

            border: 1px solid #9ca3af;

            border-radius: 8px;

            background: #ffffff;

            color: #111827;

            font-size: 16px;
        }


        .search-group input::placeholder {
            color: #9ca3af;
        }


        .search-group input:focus {
            outline: none;

            border-color: #861b24;

            box-shadow:
                0 0 0 3px rgba(134, 27, 36, 0.12);
        }


        .btn-search {
            min-width: 105px;

            background: #111827;

            color: #ffffff;

            border-color: #111827;
        }


        .btn-search:hover {
            background: #000000;

            border-color: #000000;
        }


        .btn-reset {
            min-width: 95px;

            background: #ffffff;

            color: #374151;

            border-color: #9ca3af;
        }


        .btn-reset:hover {
            background: #f9fafb;

            border-color: #6b7280;
        }


        /*
        |--------------------------------------------------------------------------
        | Table Card
        |--------------------------------------------------------------------------
        */

        .table-card {
            background: #ffffff;

            border: 1px solid #d1d5db;

            border-radius: 12px;

            overflow: hidden;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.04);
        }


        .table-wrapper {
            width: 100%;

            overflow-x: auto;
        }


        table {
            width: 100%;

            min-width: 1200px;

            border-collapse: collapse;
        }


        thead {
            background: #f9fafb;
        }


        th {
            padding: 19px 22px;

            text-align: left;

            font-size: 16px;

            font-weight: 700;

            color: #6b7280;

            text-transform: uppercase;

            letter-spacing: 0.03em;

            border-bottom: 1px solid #e5e7eb;

            white-space: nowrap;
        }


        td {
            padding: 23px 22px;

            vertical-align: middle;

            border-bottom: 1px solid #e5e7eb;

            font-size: 18px;
        }


        tbody tr:last-child td {
            border-bottom: none;
        }


        tbody tr:hover {
            background: #fafafa;
        }


        /*
        |--------------------------------------------------------------------------
        | Event ID
        |--------------------------------------------------------------------------
        */

        .event-id-cell {
            width: 110px;

            text-align: center;
        }


        .event-id {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 76px;

            min-height: 62px;

            padding: 8px 18px;

            border-radius: 10px;

            background: #f3f4f6;

            border: 1px solid #d1d5db;

            color: #111827;

            font-size: 28px;

            font-weight: 800;

            line-height: 1;
        }


        /*
        |--------------------------------------------------------------------------
        | Event Name
        |--------------------------------------------------------------------------
        */

        .event-name {
            font-size: 21px;

            font-weight: 700;

            color: #111827;

            line-height: 1.45;
        }


        .event-description {
            margin-top: 8px;

            color: #6b7280;

            font-size: 17px;

            line-height: 1.55;

            max-width: 460px;
        }


        /*
        |--------------------------------------------------------------------------
        | Text
        |--------------------------------------------------------------------------
        */

        .text-muted {
            color: #4b5563;

            font-size: 18px;

            line-height: 1.5;
        }


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        .status {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            min-height: 42px;

            padding: 8px 15px;

            border-radius: 999px;

            font-size: 16px;

            font-weight: 700;

            white-space: nowrap;
        }


        .status-active {
            background: #dcfce7;

            color: #166534;
        }


        .status-inactive {
            background: #f3f4f6;

            color: #4b5563;
        }


        /*
        |--------------------------------------------------------------------------
        | Action Buttons
        |--------------------------------------------------------------------------
        */

        .actions {
            display: grid;

            grid-template-columns:
                repeat(3, 145px);

            align-items: stretch;

            justify-content: end;

            gap: 10px;
        }


        .actions .btn {
            width: 145px;

            min-height: 48px;

            padding: 10px 12px;

            border-radius: 8px;

            font-size: 14px;

            font-weight: 600;

            text-align: center;

            justify-content: center;
        }


        .actions form {
            width: 145px;

            margin: 0 !important;
        }


        .actions form .btn {
            width: 145px;
        }


        /*
        |--------------------------------------------------------------------------
        | Empty
        |--------------------------------------------------------------------------
        */

        .empty {
            padding: 55px 20px;

            text-align: center;

            color: #6b7280;

            font-size: 16px;
        }


        /*
        |--------------------------------------------------------------------------
        | Mobile
        |--------------------------------------------------------------------------
        */

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


            .search-card form {
                align-items: stretch;
            }


            .search-group {
                min-width: 100%;
            }


            .actions {
                justify-content: start;
            }

        }


        @media (max-width: 600px) {

            .container {
                padding: 24px 12px 35px;
            }


            .header-inner {
                padding: 20px 15px;
            }


            .header-title {
                font-size: 27px;
            }


            .header-subtitle {
                font-size: 16px;
            }


            .page-title {
                font-size: 26px;
            }


            .page-description {
                font-size: 16px;
            }


            .header-actions {
                width: 100%;

                flex-direction: column;

                align-items: stretch;
            }


            .header-actions .btn {
                width: 100%;

                flex: none;
            }


            .search-card form {
                flex-direction: column;

                align-items: stretch;
            }


            .search-group {
                min-width: 100%;
            }


            .search-card .btn {
                width: 100%;
            }


            .actions {
                grid-template-columns:
                    repeat(3, 135px);

                gap: 8px;
            }


            .actions .btn,
            .actions form,
            .actions form .btn {
                width: 135px;
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
            Event Management
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
                Senarai Event
            </h2>


            <p class="page-description">
                Urus event atau program Guestbook.
            </p>

        </div>


        {{-- =====================================================
             HEADER ACTIONS
        ====================================================== --}}

        <div class="header-actions">


            {{-- KEMBALI DASHBOARD --}}

            <a
                href="{{ route('admin.dashboard') }}"
                class="btn btn-dashboard">

                ← Kembali ke Dashboard

            </a>


            {{-- TAMBAH EVENT --}}

            <a
                href="{{ route('admin.events.create') }}"
                class="btn btn-primary">

                + Tambah Event

            </a>


        </div>

    </div>



    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if (session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif



    {{-- =========================================================
         CARIAN EVENT
    ========================================================== --}}

    <div class="search-card">

        <form
            method="GET"
            action="{{ route('admin.events.index') }}">


            {{-- CARIAN --}}

            <div class="search-group">

                <label for="search">
                    Carian Event
                </label>


                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama event atau Event ID..."
                    autocomplete="off"
                >

            </div>



            {{-- CARI --}}

            <button
                type="submit"
                class="btn btn-search">

                🔎 Cari

            </button>



            {{-- RESET --}}

            @if (request('search'))

                <a
                    href="{{ route('admin.events.index') }}"
                    class="btn btn-reset">

                    ↻ Reset

                </a>

            @endif


        </form>

    </div>



    {{-- =========================================================
         EVENT TABLE
    ========================================================== --}}

    <div class="table-card">

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Event ID
                        </th>


                        <th>
                            Event
                        </th>


                        <th>
                            Tarikh
                        </th>


                        <th>
                            Lokasi
                        </th>


                        <th>
                            Pengunjung
                        </th>


                        <th>
                            Status
                        </th>


                        <th style="text-align: right;">
                            Tindakan
                        </th>

                    </tr>

                </thead>


                <tbody>


                @forelse ($events as $event)

                    <tr>


                        {{-- =================================================
                             EVENT ID
                        ================================================== --}}

                        <td class="event-id-cell">

                            <span class="event-id">

                                {{ $event->id }}

                            </span>

                        </td>



                        {{-- =================================================
                             EVENT
                        ================================================== --}}

                        <td>

                            <div class="event-name">

                                {{ $event->name }}

                            </div>


                            @if ($event->description)

                                <div class="event-description">

                                    {{ $event->description }}

                                </div>

                            @endif

                        </td>



                        {{-- =================================================
                             TARIKH
                        ================================================== --}}

                        <td>

                            <div class="text-muted">

                                {{ $event->event_date->format('d/m/Y') }}

                            </div>

                        </td>



                        {{-- =================================================
                             LOKASI
                        ================================================== --}}

                        <td>

                            <div class="text-muted">

                                {{ $event->location ?? '-' }}

                            </div>

                        </td>



                        {{-- =================================================
                             JUMLAH PENGUNJUNG
                        ================================================== --}}

                        <td>

                            <div class="text-muted">

                                {{ number_format($event->visitor_count ?? 0) }}

                            </div>

                        </td>



                        {{-- =================================================
                             STATUS
                        ================================================== --}}

                        <td>

                            @if ($event->is_active)

                                <span class="status status-active">

                                    ●
                                    Aktif

                                </span>

                            @else

                                <span class="status status-inactive">

                                    ●
                                    Tidak Aktif

                                </span>

                            @endif

                        </td>



                        {{-- =================================================
                             TINDAKAN
                        ================================================== --}}

                        <td>

                            <div class="actions">


                                {{-- QR Pendaftaran --}}

                                <a
                                    href="{{ route('admin.events.qr', ['event' => $event->id]) }}"
                                    class="btn btn-primary">

                                    QR Pendaftaran

                                </a>



                                {{-- Edit --}}

                                <a
                                    href="{{ route('admin.events.edit', ['event' => $event->id]) }}"
                                    class="btn btn-secondary">

                                    Edit

                                </a>



                                {{-- Padam --}}

                                <form
                                    action="{{ route('admin.events.destroy', ['event' => $event->id]) }}"
                                    method="POST">

                                    @csrf

                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                        onclick="return confirm('Adakah anda pasti mahu memadam event ini?');">

                                        Padam

                                    </button>

                                </form>


                            </div>

                        </td>


                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="empty">

                            Belum ada event.

                        </td>

                    </tr>

                @endforelse


                </tbody>

            </table>

        </div>

    </div>


</main>


</body>

</html>