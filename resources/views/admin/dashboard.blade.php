<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Dashboard Admin - Melaka Digital Guestbook
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
            --bg: #f6f1e9;
            --surface: #fffaf2;
            --border: #dbc7ae;
            --text: #3d251b;
            --muted: #77665b;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: var(--text);
            background: var(--bg);
        }

        /* =====================================================
           LAYOUT
        ===================================================== */

        .admin-layout {
            min-height: 100vh;
            display: flex;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            width: 250px;
            flex-shrink: 0;

            min-height: 100vh;

            background:
                linear-gradient(
                    180deg,
                    #861b24 0%,
                    #711720 100%
                );

            color: white;

            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 28px 22px 24px;

            border-bottom:
                1px solid
                rgba(255, 255, 255, 0.15);
        }

        .brand-title {
            font-size: 17px;
            font-weight: 800;
            line-height: 1.3;
        }

        .brand-subtitle {
            margin-top: 5px;

            font-size: 11px;
            line-height: 1.4;

            opacity: 0.75;
        }

        .admin-badge {
            display: inline-block;

            margin-top: 12px;

            padding: 5px 10px;

            border-radius: 999px;

            background:
                rgba(195, 154, 82, 0.22);

            border:
                1px solid
                rgba(195, 154, 82, 0.55);

            color: #f7dfad;

            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .sidebar-nav {
            padding: 20px 12px;

            flex: 1;
        }

        .nav-section {
            margin:
                18px 12px 8px;

            font-size: 10px;
            font-weight: 700;

            letter-spacing: 1px;

            color:
                rgba(255, 255, 255, 0.48);
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 11px;

            padding: 11px 13px;

            margin-bottom: 4px;

            border-radius: 9px;

            color:
                rgba(255, 255, 255, 0.82);

            text-decoration: none;

            font-size: 14px;

            transition:
                background 0.2s,
                color 0.2s;
        }

        .nav-item:hover {
            background:
                rgba(255, 255, 255, 0.10);

            color: white;
        }

        .nav-item.active {
            background:
                rgba(255, 255, 255, 0.15);

            color: white;

            box-shadow:
                inset 3px 0 0 var(--gold);
        }

        .nav-icon {
            width: 24px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-footer {
            padding: 16px;

            border-top:
                1px solid
                rgba(255, 255, 255, 0.12);
        }

        .logout-button {
            width: 100%;

            border: 0;

            padding: 11px;

            border-radius: 8px;

            background:
                rgba(255, 255, 255, 0.08);

            color:
                rgba(255, 255, 255, 0.85);

            cursor: pointer;

            font-size: 13px;
        }

        .logout-button:hover {
            background:
                rgba(255, 255, 255, 0.15);

            color: white;
        }

        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            height: 72px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 30px;

            background:
                rgba(255, 250, 242, 0.96);

            border-bottom:
                1px solid var(--border);
        }

        .page-title {
            margin: 0;

            font-size: 21px;
            font-weight: 800;

            color: var(--text);
        }

        .page-subtitle {
            margin-top: 3px;

            font-size: 12px;

            color: var(--muted);
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--gold-soft);

            color: var(--primary);

            font-weight: 800;
        }

        .admin-name {
            font-size: 13px;
            font-weight: 700;
        }

        .admin-role {
            margin-top: 2px;

            font-size: 11px;
            color: var(--muted);
        }

        .content {
            padding: 28px 30px 40px;
        }

        /* =====================================================
           WELCOME
        ===================================================== */

        .welcome {
            margin-bottom: 24px;
        }

        .welcome h2 {
            margin: 0;

            font-size: 25px;
            font-weight: 800;
        }

        .welcome p {
            margin: 7px 0 0;

            color: var(--muted);

            font-size: 14px;
        }

        /* =====================================================
           STAT CARDS
        ===================================================== */

       .stats-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: 24px;
}

        .stat-card {
            position: relative;

            padding: 22px;

            border-radius: 14px;

            background:
                rgba(255, 250, 242, 0.95);

            border:
                1px solid var(--border);

            box-shadow:
                0 5px 18px
                rgba(61, 37, 27, 0.06);
        }

        .stat-label {
            font-size: 13px;
            font-weight: 600;

            color: var(--muted);
        }

        .stat-value {
            margin-top: 8px;

            font-size: 34px;
            line-height: 1;

            font-weight: 800;

            color: var(--primary);
        }

        .stat-icon {
            position: absolute;

            right: 18px;
            top: 18px;

            width: 44px;
            height: 44px;

            border-radius: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--gold-soft);

            font-size: 21px;
        }

        /* =====================================================
           CONTENT GRID
        ===================================================== */

        .dashboard-grid {
            display: grid;

            grid-template-columns:
                minmax(0, 1.5fr)
                minmax(320px, 0.9fr);

            gap: 20px;
        }

        .panel {
            background:
                rgba(255, 250, 242, 0.96);

            border:
                1px solid var(--border);

            border-radius: 14px;

            box-shadow:
                0 5px 18px
                rgba(61, 37, 27, 0.05);

            overflow: hidden;
        }

        .panel-header {
            padding: 18px 20px;

            border-bottom:
                1px solid var(--border);

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-title {
            margin: 0;

            font-size: 16px;
            font-weight: 800;
        }

        .panel-link {
            color: var(--primary);

            text-decoration: none;

            font-size: 12px;
            font-weight: 700;
        }

        .panel-body {
            padding: 20px;
        }

        /* =====================================================
           ACTIVE EVENTS
        ===================================================== */

        .event-item {
            padding: 17px 0;

            border-bottom:
                1px solid #eadcca;
        }

        .event-item:first-child {
            padding-top: 0;
        }

        .event-item:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .event-name {
            font-size: 15px;
            font-weight: 800;
        }

        .event-meta {
            margin-top: 6px;

            display: flex;
            flex-wrap: wrap;
            gap: 12px;

            color: var(--muted);

            font-size: 12px;
        }

        .event-status {
            display: inline-flex;
            align-items: center;

            margin-top: 9px;

            padding: 4px 9px;

            border-radius: 999px;

            background: #e7f5ec;

            color: #267344;

            font-size: 10px;
            font-weight: 700;
        }

        .event-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;

            margin-top: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 8px 12px;

            border-radius: 7px;

            text-decoration: none;

            font-size: 11px;
            font-weight: 700;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-secondary {
            background: var(--gold-soft);
            color: var(--primary);
        }

        .btn:hover {
            opacity: 0.88;
        }

        /* =====================================================
           COMMENTS
        ===================================================== */

        .comment-item {
            padding: 14px 0;

            border-bottom:
                1px solid #eadcca;
        }

        .comment-item:first-child {
            padding-top: 0;
        }

        .comment-item:last-child {
            border-bottom: 0;
        }

        .comment-name {
            font-size: 13px;
            font-weight: 800;
        }

        .comment-text {
            margin-top: 5px;

            font-size: 12px;
            line-height: 1.5;

            color: var(--muted);
        }

        .comment-date {
            margin-top: 5px;

            font-size: 10px;

            color: #9b8b7f;
        }

        .empty-state {
            padding: 30px 10px;

            text-align: center;

            color: var(--muted);

            font-size: 13px;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1050px) {

            .sidebar {
                width: 220px;
            }

            .content {
                padding: 24px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 800px) {

            .sidebar {
                width: 72px;
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

            .sidebar-footer {
                padding: 10px;
            }

            .logout-button {
                font-size: 0;
            }

            .logout-button::before {
                content: "↪";
                font-size: 18px;
            }

            .topbar {
                padding: 0 20px;
            }

            .stats-grid {
                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }

        }

        @media (max-width: 600px) {

            .topbar {
                height: auto;
                padding: 15px 16px;
            }

            .admin-user {
                display: none;
            }

            .content {
                padding: 20px 16px 30px;
            }

            .welcome h2 {
                font-size: 21px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 18px;
            }

        }

    </style>

</head>


<body>

<div class="admin-layout">


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

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

            {{-- =================================================
                 EVENT AKTIF UTAMA
            ================================================== --}}

            @php
                /*
                | Main Event untuk menu Theme / QR.
                | Gunakan Event ID paling kecil supaya pautan Theme
                | tidak berubah-ubah apabila terdapat beberapa event aktif.
                */
                $mainEvent = $activeEvents
                    ->sortBy('id')
                    ->first();
            @endphp


            {{-- =================================================
                 UTAMA
            ================================================== --}}

            <div class="nav-section">
                UTAMA
            </div>


            <a
                href="{{ route('admin.dashboard') }}"
                class="nav-item active"
            >
                <span class="nav-icon">🏠</span>
                <span>Dashboard</span>
            </a>


            {{-- =================================================
                 PENGURUSAN
            ================================================== --}}

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


            {{-- GAMBAR EVENT — MASUK KE SKRIN PILIH EVENT DAHULU --}}

            <a
                href="{{ route('admin.events.images.choose') }}"
                class="nav-item"
            >
                <span class="nav-icon">🖼️</span>
                <span>Gambar Event</span>
            </a>


            {{-- THEME EVENT --}}

            @if($mainEvent)

                <a
                    href="{{ route('admin.events.theme.edit', $mainEvent) }}"
                    class="nav-item"
                >
                    <span class="nav-icon">🎨</span>
                    <span>Theme</span>
                </a>

            @endif


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
<a href="{{ route('admin.visitors.index') }}" class="nav-item">
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


            {{-- =================================================
                 PAPARAN & LAPORAN
            ================================================== --}}

            <div class="nav-section">
                PAPARAN & LAPORAN
            </div>


            {{-- =================================================
                 LIVE DISPLAY — MASUK KE SKRIN PILIH EVENT DAHULU
                 Hanya event AKTIF dipaparkan pada skrin pemilihan.
            ================================================== --}}

            <a
                href="{{ route('admin.live-display.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">📺</span>
                <span>Live Display</span>
            </a>


            {{-- =================================================
                 GUESTBOOK DIGITAL
            ================================================== --}}

            <a
                href="{{ route('admin.guestbook-digital.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">📖</span>
                <span>Guestbook Digital</span>
            </a>


            {{-- =================================================
                 LAPORAN AKTIVITI
            ================================================== --}}

            <a
                href="{{ route('admin.reporting.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">📊</span>
                <span>Laporan</span>
            </a>


        </nav>


        {{-- =====================================================
             SIDEBAR FOOTER
        ====================================================== --}}

        <div class="sidebar-footer">

            <form
                method="POST"
                action="{{ route('admin.logout') }}"
                id="admin-logout-form"
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


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main class="main">


        {{-- =================================================
             TOPBAR
        ================================================== --}}

        <header class="topbar">

            <div>

                <h1 class="page-title">
                    Dashboard
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


        {{-- =================================================
             CONTENT
        ================================================== --}}

        <div class="content">


            {{-- =================================================
                 WELCOME
            ================================================== --}}

            <div class="welcome">

                <h2>
                    Selamat Datang,
                    {{ auth()->user()->name ?? 'Administrator' }}
                </h2>

                <p>
                    Pantau dan urus operasi
                    Melaka Digital Guestbook
                    melalui dashboard pentadbir.
                </p>

            </div>


            {{-- =================================================
                 STATISTICS
            ================================================== --}}

           <div class="stats-grid">

    {{-- =================================================
         EVENT AKTIF
    ================================================== --}}

    <div class="stat-card">

        <div class="stat-icon">
            📅
        </div>

        <div class="stat-label">
            Event Aktif
        </div>

        <div class="stat-value">
            {{ number_format($totalActiveEvents) }}
        </div>

    </div>


    {{-- =================================================
         JUMLAH PENGUNJUNG
    ================================================== --}}

    <div class="stat-card">

        <div class="stat-icon">
            👥
        </div>

        <div class="stat-label">
            Jumlah Pengunjung
        </div>

        <div class="stat-value">
            {{ number_format($totalVisitors) }}
        </div>

    </div>


    {{-- =================================================
         JUMLAH KOMEN
    ================================================== --}}

    <div class="stat-card">

        <div class="stat-icon">
            💬
        </div>

        <div class="stat-label">
            Jumlah Komen
        </div>

        <div class="stat-value">
            {{ number_format($totalComments) }}
        </div>

    </div>


    {{-- =================================================
         JUMLAH TANDATANGAN
    ================================================== --}}

    <div class="stat-card">

        <div class="stat-icon">
            ✍️
        </div>

        <div class="stat-label">
            Jumlah Tandatangan
        </div>

        <div class="stat-value">
            {{ number_format($totalSignatures) }}
        </div>

    </div>

</div>


            {{-- =================================================
                 DASHBOARD CONTENT
            ================================================== --}}

            <div class="dashboard-grid">


                {{-- =================================================
                     ACTIVE EVENTS
                ================================================== --}}

                <section class="panel">


                    <div class="panel-header">

                        <h3 class="panel-title">
                            📅 Event Aktif
                        </h3>


                        <a
                            href="{{ route('admin.events.index') }}"
                            class="panel-link"
                        >
                            Lihat Semua →
                        </a>

                    </div>


                    <div class="panel-body">


                        @forelse($activeEvents as $event)


                            <div class="event-item">


                                <div class="event-name">
                                    {{ $event->name }}
                                </div>


                               <div class="event-meta">

    <span>
        📅
        {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}
    </span>

    @if($event->location)
        <span>
            📍
            {{ $event->location }}
        </span>
    @endif

    <span>
        👥
        {{ number_format($event->visitor_count ?? 0) }} Pengunjung
    </span>

</div>


                                <div class="event-status">
                                    ● AKTIF
                                </div>


                                {{-- EVENT ACTIONS --}}

                                <div class="event-actions">


                                    {{-- LIVE DISPLAY --}}

                                    <a
                                        href="{{ route('guestbook.display', $event) }}"
                                        target="_blank"
                                        class="btn btn-primary"
                                    >
                                        📺 Live Display
                                    </a>


                                    {{-- QR --}}

                                    <a
                                        href="{{ route('admin.events.qr', $event) }}"
                                        target="_blank"
                                        class="btn btn-secondary"
                                    >
                                        📱 QR
                                    </a>


                                    {{-- SIGN --}}

                                    <a
                                        href="{{ route('admin.events.signing', $event) }}"
                                        class="btn btn-secondary"
                                    >
                                        ✍ Sign
                                    </a>


                                    {{-- THEME --}}

                                    <a
                                        href="{{ route('admin.events.theme.edit', $event) }}"
                                        class="btn btn-secondary"
                                    >
                                        🎨 Theme
                                    </a>
{{-- DAFTAR PENGUNJUNG --}}

<a
    href="{{ route('guestbook.register', $event) }}"
    target="_blank"
    class="btn btn-secondary"
>
    👤 Daftar
</a>
                                </div>


                            </div>


                        @empty


                            <div class="empty-state">

                                Tiada event aktif pada masa ini.

                            </div>


                        @endforelse


                    </div>

                </section>


               {{-- =================================================
     LATEST COMMENTS
================================================== --}}

<section class="panel">

    <div class="panel-header">

        <h3 class="panel-title">
            💬 Komen Terkini
        </h3>

        <a
            href="{{ route('admin.comments.index') }}"
            class="panel-link"
        >
            Lihat Semua →
        </a>

    </div>


    <div class="panel-body">

        @forelse($latestComments as $comment)

            <div class="comment-item">

                {{-- NAMA --}}
                <div class="comment-name">
                    👤 {{ $comment->name ?: 'Tanpa Nama' }}
                </div>


                {{-- ORGANISASI --}}
                @if($comment->organization)

                    <div class="comment-text">
                        🏢 {{ $comment->organization }}
                    </div>

                @endif


                {{-- KOMEN --}}
                <div class="comment-text">
                    💬 "{{ $comment->comment ?: 'Tiada komen' }}"
                </div>


                {{-- EVENT --}}
                @if($comment->event)

                    <div class="comment-date">
                        📅 {{ $comment->event->name }}
                    </div>

                @endif


                {{-- TARIKH --}}
                <div class="comment-date">
                    🕐 {{ optional($comment->created_at)->format('d/m/Y H:i') }}
                </div>


                {{-- RATING --}}
                @if($comment->rating)

                    <div class="comment-date">
                        ⭐ {{ $comment->rating }}/5
                    </div>

                @endif

            </div>

        @empty

            <div class="empty-state">
                Tiada komen lagi.
            </div>

        @endforelse

    </div>

</section>


            </div>


        </div>

    </main>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const logoutForm =
        document.getElementById('admin-logout-form');

    if (logoutForm) {

        logoutForm.addEventListener('submit', function () {

            const button =
                logoutForm.querySelector('.logout-button');

            if (button) {

                button.disabled = true;

                button.innerHTML =
                    '⏳ &nbsp; Sedang log keluar...';

            }

        });

    }

});


/*
|--------------------------------------------------------------------------
| Prevent browser Back/Forward cache from restoring Dashboard
|--------------------------------------------------------------------------
|
| Selepas logout, browser boleh cuba memulihkan halaman lama melalui
| Back/Forward Cache (bfcache). Bila halaman dipulihkan, paksa reload
| supaya Laravel semak semula session authentication.
|
*/

window.addEventListener('pageshow', function (event) {

    if (event.persisted) {

        window.location.reload();

    }

});
</script>

</body>

</html>