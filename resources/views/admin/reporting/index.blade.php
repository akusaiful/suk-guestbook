<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Laporan - MELAKA DIGITAL GUESTBOOK
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

    <style>

        * {
            box-sizing: border-box;
        }

        :root {
            --primary: #861b24;
            --primary-dark: #6f151d;
            --gold: #c39a52;
            --gold-soft: #f1e4cf;
            --bg: #f5f1eb;
            --surface: #ffffff;
            --surface-soft: #fffaf3;
            --border: #dfd4c7;
            --text: #3d251b;
            --muted: #776b61;
            --success: #16804a;
            --danger: #b42318;
            --shadow: 0 8px 24px rgba(66, 42, 25, .08);
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(195,154,82,.08), transparent 34%),
                linear-gradient(180deg, #f8f3ec 0%, #f2ede5 100%);
        }

        .admin-layout {
            min-height: 100vh;
            display: flex;
        }

        /* ============================================================
           SIDEBAR
        ============================================================ */

        .sidebar {
            width: 250px;
            flex: 0 0 250px;
            min-height: 100vh;
            background:
                linear-gradient(180deg, #861b24 0%, #731720 55%, #64141b 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            box-shadow: 6px 0 24px rgba(68, 28, 25, .12);
        }

        .sidebar-brand {
            padding: 28px 22px 24px;
            border-bottom: 1px solid rgba(255,255,255,.14);
        }

        .brand-title {
            font-size: 17px;
            font-weight: 900;
            line-height: 1.3;
            letter-spacing: .2px;
        }

        .brand-subtitle {
            margin-top: 6px;
            font-size: 11px;
            line-height: 1.45;
            color: rgba(255,255,255,.75);
        }

        .admin-badge {
            display: inline-block;
            margin-top: 13px;
            padding: 5px 10px;
            border-radius: 999px;
            background: rgba(195,154,82,.18);
            border: 1px solid rgba(245,222,172,.35);
            color: #f6dfae;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 18px 12px;
        }

        .nav-section {
            margin: 18px 12px 8px;
            font-size: 10px;
            font-weight: 800;
            color: rgba(255,255,255,.48);
            letter-spacing: 1.1px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 4px;
            padding: 11px 13px;
            border-radius: 9px;
            color: rgba(255,255,255,.82);
            text-decoration: none;
            font-size: 13px;
            transition: .18s ease;
        }

        .nav-item:hover,
        .nav-item.active {
            color: #fff;
            background: rgba(255,255,255,.11);
        }

        .nav-icon {
            width: 20px;
            flex: 0 0 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 14px 12px 18px;
            border-top: 1px solid rgba(255,255,255,.12);
        }

        .logout-button {
            width: 100%;
            border: 1px solid rgba(255,255,255,.16);
            background: rgba(255,255,255,.08);
            color: #fff;
            border-radius: 9px;
            padding: 11px 13px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
        }

        .logout-button:hover {
            background: rgba(255,255,255,.14);
        }

        /* ============================================================
           MAIN
        ============================================================ */

        .main {
            min-width: 0;
            flex: 1;
        }

        .topbar {
            min-height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 18px 32px;
            background: rgba(255,255,255,.94);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 30;
            backdrop-filter: blur(10px);
        }

        .page-title {
            margin: 0;
            font-size: 25px;
            line-height: 1.1;
            font-weight: 900;
            color: var(--primary);
        }

        .page-subtitle {
            margin-top: 4px;
            font-size: 11px;
            color: var(--muted);
            letter-spacing: .8px;
            text-transform: uppercase;
            font-weight: 700;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: var(--primary);
            color: #fff;
            font-weight: 900;
        }

        .admin-name {
            font-size: 13px;
            font-weight: 800;
        }

        .admin-role {
            margin-top: 2px;
            font-size: 11px;
            color: var(--muted);
        }

        .content {
            padding: 30px 32px 42px;
            max-width: 1550px;
            margin: 0 auto;
        }

        .intro {
            margin-bottom: 22px;
        }

        .intro h2 {
            margin: 0;
            color: var(--text);
            font-size: 21px;
            font-weight: 900;
        }

        .intro p {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        /* ============================================================
           BACK TO DASHBOARD
        ============================================================ */

        .dashboard-back-wrap {
            margin-top: 16px;
        }

        .dashboard-back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 16px;
            border-radius: 9px;
            background: var(--primary);
            color: #ffffff;
            text-decoration: none;
            border: 1px solid var(--primary);
            font-size: 12px;
            font-weight: 800;
            transition: .18s ease;
            box-shadow: 0 4px 12px rgba(134, 27, 36, .16);
        }

        .dashboard-back-btn:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(134, 27, 36, .20);
        }

        .dashboard-back-btn:active {
            transform: translateY(0);
        }

        /* ============================================================
           STATS
        ============================================================ */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            padding: 18px 20px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            inset: 0 auto auto 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--gold));
        }

        .stat-label {
            color: var(--muted);
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .stat-value {
            margin-top: 8px;
            color: var(--primary);
            font-size: 29px;
            line-height: 1;
            font-weight: 950;
        }

        /* ============================================================
           CARD
        ============================================================ */

        .filter-card,
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 15px;
            box-shadow: var(--shadow);
        }

        .filter-card {
            padding: 18px;
            margin-bottom: 20px;
        }

        /* ============================================================
           FILTER
        ============================================================ */

        .filter-grid {
            display: grid;
            grid-template-columns:
                minmax(250px, 1.5fr)
                minmax(160px, .8fr)
                minmax(160px, .8fr)
                auto
                auto;
            gap: 12px;
            align-items: end;
        }

        .field label {
            display: block;
            margin-bottom: 7px;
            font-size: 11px;
            font-weight: 800;
            color: var(--text);
        }

        .field select,
        .field input {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: #fff;
            color: var(--text);
            outline: none;
            font-size: 13px;
        }

        .field select:focus,
        .field input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(195,154,82,.12);
        }

        /* ============================================================
           BUTTON
        ============================================================ */

        .btn {
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 16px;
            border-radius: 9px;
            text-decoration: none;
            border: 1px solid transparent;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-light {
            color: var(--text);
            background: #f8f5f1;
            border-color: var(--border);
        }

        .btn-light:hover {
            background: #f0ebe3;
        }

        .btn-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .btn-export {
            background: #16804a;
            color: #ffffff;
            border-color: #16804a;
        }

        .btn-export:hover {
            background: #126b3e;
            border-color: #126b3e;
        }

        /* ============================================================
           TABLE
        ============================================================ */

        .table-card {
            overflow: hidden;
            margin-bottom: 20px;
        }

        .table-head {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
        }

        .table-title {
            color: var(--text);
            font-size: 15px;
            font-weight: 900;
        }

        .table-caption {
            margin-top: 4px;
            color: var(--muted);
            font-size: 11px;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        th,
        td {
            padding: 13px 15px;
            border-bottom: 1px solid #eee7df;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #fbf8f4;
            color: var(--muted);
            font-size: 10px;
            letter-spacing: .7px;
            text-transform: uppercase;
            font-weight: 900;
            white-space: nowrap;
        }

        td {
            color: var(--text);
            font-size: 12px;
        }

        tbody tr:hover {
            background: #fffaf4;
        }

        .event-id {
            display: inline-flex;
            min-width: 34px;
            height: 28px;
            padding: 0 8px;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background: #f4e8d7;
            color: var(--primary);
            font-weight: 900;
        }

        .event-name {
            max-width: 360px;
            color: var(--text);
            font-weight: 800;
            line-height: 1.4;
        }

        .visitor-name {
            font-weight: 800;
        }

        .number {
            font-size: 14px;
            font-weight: 900;
            color: var(--primary);
        }

        .status {
            display: inline-flex;
            align-items: center;
            min-height: 28px;
            padding: 0 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 900;
        }

        .status.active {
            color: #12623b;
            background: #e8f7ee;
            border: 1px solid #b8e4c9;
        }

        .status.inactive {
            color: #8a2c23;
            background: #fff0ed;
            border: 1px solid #efc2bc;
        }

        .method {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 27px;
            padding: 0 9px;
            border-radius: 7px;
            background: #edf2f7;
            color: #475569;
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .method.qr {
            background: #e9f7ef;
            color: #166534;
        }

        .empty {
            padding: 44px 20px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }

        /* ============================================================
           PAGINATION
        ============================================================ */

        .pagination-wrap {
            padding: 16px 20px;
            border-top: 1px solid var(--border);
        }

        .pagination {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            align-items: center;
        }

        .page-link {
            display: inline-flex;
            min-width: 34px;
            height: 34px;
            padding: 0 10px;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: #fff;
            color: var(--text);
            text-decoration: none;
            font-size: 11px;
            font-weight: 800;
        }

        .page-link.active {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .page-meta {
            margin-top: 9px;
            color: var(--muted);
            font-size: 11px;
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */

        @media (max-width: 1100px) {

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0,1fr));
            }

            .filter-grid {
                grid-template-columns: 1fr 1fr;
            }

            .filter-grid .btn {
                width: 100%;
            }

        }

        @media (max-width: 800px) {

            .sidebar {
                width: 72px;
                flex-basis: 72px;
            }

            .sidebar-brand {
                padding: 20px 10px;
                text-align: center;
            }

            .brand-title,
            .brand-subtitle,
            .admin-badge,
            .nav-section {
                display: none;
            }

            .nav-item {
                justify-content: center;
                padding: 12px;
            }

            .nav-item span:not(.nav-icon) {
                display: none;
            }

            .logout-button {
                font-size: 0;
                padding: 11px;
            }

            .logout-button::before {
                content: "↪";
                font-size: 18px;
            }

            .topbar {
                padding: 15px 18px;
            }

            .admin-user {
                display: none;
            }

            .content {
                padding: 20px 16px 30px;
            }

        }

        @media (max-width: 600px) {

            .stats-grid,
            .filter-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 21px;
            }

            .table-head {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }

        }

    </style>

</head>


<body>

<div class="admin-layout">

    <!-- ============================================================
         SIDEBAR
    ============================================================= -->

    <aside class="sidebar">

        <div class="sidebar-brand">

            <div class="brand-title">
                MELAKA DIGITAL GUESTBOOK
            </div>

            <div class="brand-subtitle">
                Smart Visitor Registration
                & Digital Signature
            </div>

            <span class="admin-badge">
                ADMINISTRATOR
            </span>

        </div>


        <nav class="sidebar-nav">

            <div class="nav-section">
                UTAMA
            </div>

            <a
                href="{{ route('admin.dashboard') }}"
                class="nav-item"
            >
                <span class="nav-icon">🏠</span>
                <span>Dashboard</span>
            </a>


            <div class="nav-section">
                PENGURUSAN
            </div>

            <a
                href="{{ route('admin.events.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">📅</span>
                <span>Event</span>
            </a>

            <a
                href="{{ route('admin.signers.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">✍️</span>
                <span>Signer</span>
            </a>

            <a
                href="{{ route('admin.signatures.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">📝</span>
                <span>Tandatangan</span>
            </a>

            <a
                href="{{ route('admin.visitors.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">👥</span>
                <span>Pengunjung</span>
            </a>

            <a
                href="{{ route('admin.comments.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">💬</span>
                <span>Komen</span>
            </a>


            <div class="nav-section">
                PAPARAN & LAPORAN
            </div>

            <a
                href="{{ route('admin.reporting.index') }}"
                class="nav-item active"
            >
                <span class="nav-icon">📊</span>
                <span>Laporan</span>
            </a>

        </nav>


        <div class="sidebar-footer">

            <form
                method="POST"
                action="{{ route('admin.logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    🚪 &nbsp; Log Keluar
                </button>

            </form>

        </div>

    </aside>


    <!-- ============================================================
         MAIN
    ============================================================= -->

    <main class="main">


        <header class="topbar">

            <div>

                <h1 class="page-title">
                    Laporan
                </h1>

                <div class="page-subtitle">
                    MELAKA DIGITAL GUESTBOOK
                </div>

            </div>


            <div class="admin-user">

                <div class="admin-avatar">
                    A
                </div>

                <div>

                    <div class="admin-name">
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </div>

                    <div class="admin-role">
                        Administrator
                    </div>

                </div>

            </div>

        </header>


        <div class="content">


            <!-- =====================================================
                 INTRO
            ====================================================== -->

            <div class="intro">

                <h2>
                    Laporan Aktiviti Guestbook
                </h2>

                <p>
                    Ringkasan pengunjung, komen diterbitkan dan tandatangan mengikut event.
                </p>


                <div class="dashboard-back-wrap">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="dashboard-back-btn"
                    >
                        ← Kembali ke Dashboard
                    </a>

                </div>

            </div>


            <!-- =====================================================
                 STATS
            ====================================================== -->

            <div class="stats-grid">


                <div class="stat-card">

                    <div class="stat-label">
                        EVENT
                    </div>

                    <div class="stat-value">
                        {{ number_format($totals['events']) }}
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-label">
                        PENGUNJUNG
                    </div>

                    <div class="stat-value">
                        {{ number_format($totals['visitors']) }}
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-label">
                        KOMEN
                    </div>

                    <div class="stat-value">
                        {{ number_format($totals['comments']) }}
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-label">
                        TANDATANGAN
                    </div>

                    <div class="stat-value">
                        {{ number_format($totals['signatures']) }}
                    </div>

                </div>


            </div>


            <!-- =====================================================
                 FILTER
            ====================================================== -->

            <div class="filter-card">


                <form
                    method="GET"
                    action="{{ route('admin.reporting.index') }}"
                >

                    <div class="filter-grid">


                        <div class="field">

                            <label for="event_id">
                                Event
                            </label>

                            <select
                                id="event_id"
                                name="event_id"
                            >

                                <option value="">
                                    Semua Event
                                </option>


                                @foreach ($events as $event)

                                    <option
                                        value="{{ $event->id }}"
                                        @selected((string) $eventId === (string) $event->id)
                                    >
                                        {{ $event->id }} - {{ $event->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="field">

                            <label for="date_from">
                                Tarikh Mula
                            </label>

                            <input
                                type="date"
                                id="date_from"
                                name="date_from"
                                value="{{ $dateFrom }}"
                            >

                        </div>


                        <div class="field">

                            <label for="date_to">
                                Tarikh Akhir
                            </label>

                            <input
                                type="date"
                                id="date_to"
                                name="date_to"
                                value="{{ $dateTo }}"
                            >

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            🔎 Tapis
                        </button>


                        <a
                            href="{{ route('admin.reporting.index') }}"
                            class="btn btn-light"
                        >
                            Reset
                        </a>


                    </div>

                </form>


            </div>


            <!-- =====================================================
                 RINGKASAN EVENT
            ====================================================== -->

            <div class="table-card">


                <div class="table-head">

                    <div class="table-title">
                        Ringkasan Event
                    </div>

                    <div class="table-caption">
                        Statistik dikira berdasarkan penapis yang dipilih.
                    </div>

                </div>


                <div class="table-wrap">


                    @if ($rows->count() > 0)


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
                                        Komen
                                    </th>

                                    <th>
                                        Tandatangan
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                </tr>

                            </thead>


                            <tbody>


                                @foreach ($rows as $row)


                                    <tr>


                                        <td>

                                            <span class="event-id">
                                                {{ $row['event_id'] }}
                                            </span>

                                        </td>


                                        <td>

                                            <div class="event-name">
                                                {{ $row['name'] }}
                                            </div>

                                        </td>


                                        <td>

                                            {{ $row['event_date']
                                                ? \Illuminate\Support\Carbon::parse($row['event_date'])->format('d/m/Y')
                                                : '-' }}

                                        </td>


                                        <td>

                                            {{ $row['location'] ?: '-' }}

                                        </td>


                                        <td>

                                            <span class="number">
                                                {{ number_format($row['visitor_count']) }}
                                            </span>

                                        </td>


                                        <td>

                                            <span class="number">
                                                {{ number_format($row['comment_count']) }}
                                            </span>

                                        </td>


                                        <td>

                                            <span class="number">
                                                {{ number_format($row['signature_count']) }}
                                            </span>

                                        </td>


                                        <td>

                                            <span
                                                class="status {{ $row['is_active'] ? 'active' : 'inactive' }}"
                                            >

                                                {{ $row['is_active'] ? 'Aktif' : 'Tidak Aktif' }}

                                            </span>

                                        </td>


                                    </tr>


                                @endforeach


                            </tbody>


                        </table>


                    @else


                        <div class="empty">
                            Tiada rekod laporan untuk penapis yang dipilih.
                        </div>


                    @endif


                </div>


            </div>


            <!-- =====================================================
                 SENARAI LAPORAN PENGUNJUNG
            ====================================================== -->

            <div class="table-card">


                <div class="table-head">


                    <div>

                        <div class="table-title">
                            Senarai Laporan Pengunjung
                        </div>

                        <div class="table-caption">
                            Rekod pengunjung berdasarkan Event dan tempoh tarikh yang dipilih.
                        </div>

                    </div>


                    <div class="btn-row">


                        <a
                            href="{{ route('admin.reporting.export', request()->query()) }}"
                            class="btn btn-export"
                        >
                            📥 Eksport Excel
                        </a>


                    </div>


                </div>


                <div class="table-wrap">


                    @if ($visitors->count() > 0)


                        <table>


                            <thead>

                                <tr>

                                    <th>
                                        Bil
                                    </th>

                                    <th>
                                        Nama
                                    </th>

                                    <th>
                                        No. Kad Pengenalan
                                    </th>

                                    <th>
                                        Organisasi
                                    </th>

                                    <th>
                                        Telefon
                                    </th>

                                    <th>
                                        Email
                                    </th>

                                    <th>
                                        Event ID
                                    </th>

                                    <th>
                                        Event
                                    </th>

                                    <th>
                                        Kaedah
                                    </th>

                                    <th>
                                        Tarikh / Masa
                                    </th>

                                </tr>

                            </thead>


                            <tbody>


                                @foreach ($visitors as $visitor)


                                    <tr>


                                        <td>

                                            {{ $visitors->firstItem() + $loop->index }}

                                        </td>


                                        <td>

                                            <div class="visitor-name">
                                                {{ $visitor->name }}
                                            </div>

                                        </td>


                                        <td>

                                            {{ $visitor->ic_number ?: '-' }}

                                        </td>


                                        <td>

                                            {{ $visitor->organization ?: '-' }}

                                        </td>


                                        <td>

                                            {{ $visitor->phone ?: '-' }}

                                        </td>


                                        <td>

                                            {{ $visitor->email ?: '-' }}

                                        </td>


                                        <td>

                                            <span class="event-id">
                                                {{ $visitor->event_id }}
                                            </span>

                                        </td>


                                        <td>

                                            <div class="event-name">
                                                {{ $visitor->event_name ?: '-' }}
                                            </div>

                                        </td>


                                        <td>


                                            <span
                                                class="method {{ $visitor->registration_method === 'qr' ? 'qr' : '' }}"
                                            >
                                                {{ strtoupper($visitor->registration_method ?: 'manual') }}
                                            </span>


                                        </td>


                                        <td>

                                            {{ $visitor->checked_in_at
                                                ? \Illuminate\Support\Carbon::parse($visitor->checked_in_at)->format('d/m/Y H:i:s')
                                                : '-' }}

                                        </td>


                                    </tr>


                                @endforeach


                            </tbody>


                        </table>


                    @else


                        <div class="empty">
                            Tiada rekod pengunjung untuk penapis yang dipilih.
                        </div>


                    @endif


                </div>


                <!-- =================================================
                     PAGINATION
                ================================================== -->

                @if ($visitors->hasPages())


                    <div class="pagination-wrap">


                        <div class="pagination">


                            @if ($visitors->onFirstPage())


                                <span class="page-link">
                                    ←
                                </span>


                            @else


                                <a
                                    href="{{ $visitors->previousPageUrl() }}"
                                    class="page-link"
                                >
                                    ←
                                </a>


                            @endif


                            @foreach (
                                $visitors->getUrlRange(
                                    max(1, $visitors->currentPage() - 2),
                                    min($visitors->lastPage(), $visitors->currentPage() + 2)
                                )
                                as $page => $url
                            )


                                <a
                                    href="{{ $url }}"
                                    class="page-link {{ $page == $visitors->currentPage() ? 'active' : '' }}"
                                >
                                    {{ $page }}
                                </a>


                            @endforeach


                            @if ($visitors->hasMorePages())


                                <a
                                    href="{{ $visitors->nextPageUrl() }}"
                                    class="page-link"
                                >
                                    →
                                </a>


                            @else


                                <span class="page-link">
                                    →
                                </span>


                            @endif


                        </div>


                        <div class="page-meta">

                            Menunjukkan
                            {{ $visitors->firstItem() }}
                            hingga
                            {{ $visitors->lastItem() }}
                            daripada
                            {{ $visitors->total() }}
                            rekod pengunjung.

                        </div>


                    </div>


                @endif


            </div>


        </div>


    </main>


</div>


</body>

</html>