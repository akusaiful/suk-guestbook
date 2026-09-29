<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Senarai Pengunjung - MELAKA DIGITAL GUESTBOOK
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

            background: #f3f4f6;

            color: #111827;
        }

        .page {
            width: 100%;

            max-width: 1200px;

            margin: 40px auto;

            padding: 20px;
        }

        .card {
            background: #ffffff;

            border: 1px solid #d1d5db;

            border-radius: 16px;

            padding: 30px;
        }

        .header {
            margin-bottom: 25px;
        }

        .title {
            font-size: 28px;

            font-weight: 700;
        }

        .subtitle {
            margin-top: 6px;

            color: #6b7280;

            font-size: 14px;
        }

        /*
        |--------------------------------------------------------------------------
        | Filter & Search
        |--------------------------------------------------------------------------
        */

        .filter-card {
            margin-bottom: 25px;

            padding: 20px;

            background: #f9fafb;

            border: 1px solid #d1d5db;

            border-radius: 12px;
        }

        .filter-card form {
            display: flex;

            align-items: end;

            gap: 12px;

            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;

            min-width: 280px;
        }

        .search-group {
            min-width: 360px;
        }

        .event-group {
            min-width: 320px;
        }

        .filter-group label {
            display: block;

            margin-bottom: 8px;

            font-size: 14px;

            font-weight: 700;

            color: #374151;
        }

        .filter-group select,
        .filter-group input[type="text"] {
            width: 100%;

            min-height: 44px;

            padding: 10px 12px;

            border: 1px solid #9ca3af;

            border-radius: 8px;

            background: #ffffff;

            color: #111827;

            font-size: 14px;
        }

        .filter-group select {
            cursor: pointer;
        }

        .filter-group input[type="text"]::placeholder {
            color: #9ca3af;
        }

        .filter-group select:focus,
        .filter-group input[type="text"]:focus {
            outline: none;

            border-color: #861b24;

            box-shadow:
                0 0 0 3px rgba(134, 27, 36, 0.12);
        }

        .filter-button,
        .reset-button {
            min-height: 44px;

            padding: 10px 18px;

            border-radius: 8px;

            font-size: 14px;

            font-weight: 600;

            text-decoration: none;

            cursor: pointer;
        }

        .filter-button {
            border: 1px solid #111827;

            background: #111827;

            color: #ffffff;
        }

        .filter-button:hover {
            background: #000000;
        }

        .reset-button {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            border: 1px solid #9ca3af;

            background: #ffffff;

            color: #374151;
        }

        .reset-button:hover {
            background: #f3f4f6;
        }
.export-button {
    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-height: 44px;

    padding: 10px 18px;

    border-radius: 8px;

    border: 1px solid #166534;

    background: #166534;

    color: #ffffff;

    font-size: 14px;

    font-weight: 600;

    text-decoration: none;

    white-space: nowrap;

    transition:
        background 0.2s ease,
        border-color 0.2s ease;
}

.export-button:hover {
    background: #14532d;

    border-color: #14532d;
}
        /*
        |--------------------------------------------------------------------------
        | Table
        |--------------------------------------------------------------------------
        */

        .table-wrapper {
            width: 100%;

            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 1240px;
        }

        th,
        td {
            padding: 14px 12px;

            border-bottom: 1px solid #e5e7eb;

            text-align: left;

            vertical-align: middle;
        }

        th {
            background: #f9fafb;

            font-size: 13px;

            font-weight: 700;

            color: #374151;

            white-space: nowrap;
        }

        td {
            font-size: 14px;

            color: #374151;
        }

        .ic-number {
            font-family:
                "Courier New",
                monospace;

            font-weight: 600;

            color: #111827;

            white-space: nowrap;
        }

        .event-id {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 42px;

            padding: 5px 9px;

            border-radius: 6px;

            background: #f3f4f6;

            color: #374151;

            font-size: 13px;

            font-weight: 700;
        }

        .empty {
            padding: 40px 20px;

            text-align: center;

            color: #6b7280;
        }

        /*
        |--------------------------------------------------------------------------
        | Bottom Actions
        |--------------------------------------------------------------------------
        */

        .bottom-actions {
            margin-top: 28px;

            padding-top: 22px;

            border-top: 1px solid #e5e7eb;

            display: flex;

            align-items: flex-end;

            justify-content: space-between;

            gap: 20px;

            flex-wrap: wrap;
        }

        /*
        |--------------------------------------------------------------------------
        | Custom Pagination
        |--------------------------------------------------------------------------
        */

        .pagination-area {
            flex: 1;

            min-width: 320px;
        }

        .pagination-info {
            margin-bottom: 10px;

            font-size: 14px;

            color: #6b7280;
        }

        .pagination-info strong {
            color: #111827;

            font-weight: 700;
        }

        .pagination-controls {
            display: inline-flex;

            align-items: center;

            gap: 5px;

            flex-wrap: wrap;
        }

        .pagination-link {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 38px;

            height: 38px;

            padding: 0 12px;

            border: 1px solid #d1d5db;

            border-radius: 8px;

            background: #ffffff;

            color: #374151;

            font-size: 14px;

            font-weight: 600;

            text-decoration: none;

            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                color 0.2s ease;
        }

        .pagination-link:hover {
            background: #f3f4f6;

            border-color: #9ca3af;

            color: #111827;
        }

        .pagination-link.active {
            border-color: #861b24;

            background: #861b24;

            color: #ffffff;
        }

        .pagination-link.disabled {
            opacity: 0.45;

            cursor: not-allowed;

            pointer-events: none;

            background: #f9fafb;
        }

        .pagination-prev,
        .pagination-next {
            padding-left: 14px;

            padding-right: 14px;
        }

        /*
        |--------------------------------------------------------------------------
        | Dashboard Button
        |--------------------------------------------------------------------------
        */

        .dashboard-button {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-height: 44px;

            padding: 10px 20px;

            border-radius: 8px;

            border: 1px solid #861b24;

            background: #861b24;

            color: #ffffff;

            font-size: 14px;

            font-weight: 600;

            text-decoration: none;

            white-space: nowrap;

            transition:
                background 0.2s ease,
                border-color 0.2s ease;
        }

        .dashboard-button:hover {
            background: #6f151d;

            border-color: #6f151d;
        }

        /*
        |--------------------------------------------------------------------------
        | Visitor Actions
        |--------------------------------------------------------------------------
        */

        .action-buttons {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .edit-button,
        .delete-button {
            min-height: 38px;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        .edit-button {
            border: 1px solid #1d4ed8;
            background: #eff6ff;
            color: #1d4ed8;
        }

        .edit-button:hover {
            background: #dbeafe;
        }

        .delete-form {
            margin: 0;
        }

        .delete-button {
            border: 1px solid #b91c1c;
            background: #fef2f2;
            color: #b91c1c;
        }

        .delete-button:hover {
            background: #fee2e2;
        }

        /*
        |--------------------------------------------------------------------------
        | Mobile
        |--------------------------------------------------------------------------
        */

        @media (max-width: 600px) {

            .page {
                margin: 20px auto;

                padding: 10px;
            }

            .card {
                padding: 20px;
            }

            .title {
                font-size: 23px;
            }

            .filter-card form {
                align-items: stretch;

                flex-direction: column;
            }

            .filter-group,
            .search-group,
            .event-group {
                min-width: 100%;
            }

          .filter-button,
.reset-button,
.export-button {
    width: 100%;
}

            .bottom-actions {
                flex-direction: column;

                align-items: stretch;
            }

            .pagination-area {
                width: 100%;

                min-width: 100%;
            }

            .pagination-controls {
                width: 100%;
            }

            .pagination-link {
                min-width: 36px;

                height: 36px;

                padding: 0 10px;
            }

            .dashboard-button {
                width: 100%;
            }

            .action-buttons {
                width: 100%;
                flex-direction: column;
                align-items: stretch;
            }

            .edit-button,
            .delete-button {
                width: 100%;
            }

        }

    </style>

</head>


<body>

<div class="page">

    <div class="card">

        {{-- =========================================================
             HEADER
        ========================================================== --}}

        <div class="header">

            <div class="title">
                👥 Senarai Pengunjung
            </div>

            <div class="subtitle">
                MELAKA DIGITAL GUESTBOOK — Rekod Pengunjung
            </div>

        </div>


        {{-- =========================================================
             CARIAN & FILTER EVENT
        ========================================================== --}}

        <div class="filter-card">

            <form
                method="GET"
                action="{{ route('admin.visitors.index') }}">

                {{-- =========================
                     CARIAN PENGUNJUNG
                ========================== --}}

                <div class="filter-group search-group">

                    <label for="search">
                        Carian Pengunjung
                    </label>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama, no. kad pengenalan atau organisasi..."
                        autocomplete="off"
                    >

                </div>


                {{-- =========================
                     FILTER EVENT
                ========================== --}}

                <div class="filter-group event-group">

                    <label for="event_id">
                        Pilih Event
                    </label>

                    <select
                        id="event_id"
                        name="event_id">

                        <option value="">
                            Semua Event
                        </option>

                        @foreach ($events as $event)

                            <option
                                value="{{ $event->id }}"
                                {{ request('event_id') == $event->id ? 'selected' : '' }}>

                                #{{ $event->id }} —
                                {{ $event->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- =========================
                     BUTANG CARI
                ========================== --}}

                <button
                    type="submit"
                    class="filter-button">

                    🔎 Cari

                </button>


                {{-- =========================
                     RESET
                ========================== --}}

               @if (request('search') || request('event_id'))

    <a
        href="{{ route('admin.visitors.index') }}"
        class="reset-button">

        ↻ Reset

    </a>

@endif


<a
    href="{{ route('admin.visitors.export', [
        'search' => request('search'),
        'event_id' => request('event_id'),
    ]) }}"
    class="export-button">

    📊 Export Excel

</a>

            </form>

        </div>


        {{-- =========================================================
             SENARAI PENGUNJUNG
        ========================================================== --}}

        @if ($visitors->count())

            <div class="table-wrapper">

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
                                Organisasi / Jabatan
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
                                Tarikh / Masa
                            </th>

                            <th>
                                Tindakan
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($visitors as $visitor)

                            <tr>

                                {{-- Bil --}}

                                <td>
                                    {{ $visitors->firstItem() + $loop->index }}
                                </td>


                                {{-- Nama --}}

                                <td>
                                    {{ $visitor->name ?? '-' }}
                                </td>


                                {{-- No. Kad Pengenalan --}}

                                <td>

                                    @if ($visitor->ic_number)

                                        <span class="ic-number">
                                            {{ $visitor->ic_number }}
                                        </span>

                                    @else

                                        -

                                    @endif

                                </td>


                                {{-- Organisasi --}}

                                <td>
                                    {{ $visitor->organization ?? '-' }}
                                </td>


                                {{-- Telefon --}}

                                <td>
                                    {{ $visitor->phone ?? '-' }}
                                </td>


                                {{-- Email --}}

                                <td>
                                    {{ $visitor->email ?? '-' }}
                                </td>


                                {{-- Event ID --}}

                                <td>

                                    @if ($visitor->event_id)

                                        <span class="event-id">
                                            #{{ $visitor->event_id }}
                                        </span>

                                    @else

                                        -

                                    @endif

                                </td>


                                {{-- Tarikh / Masa --}}

                                <td>
                                    {{ $visitor->created_at?->format('d/m/Y H:i') ?? '-' }}
                                </td>

                                {{-- Tindakan --}}

                                <td>
                                    <div class="action-buttons">

                                        <a
                                            href="{{ route('admin.visitors.edit', $visitor) }}"
                                            class="edit-button">
                                            ✏️ Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.visitors.destroy', $visitor) }}"
                                            class="delete-form"
                                            onsubmit="return confirm('Padam rekod pengunjung ini? Tindakan ini tidak boleh dibatalkan.');">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="delete-button">
                                                🗑️ Delete
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
                 PAGINATION + DASHBOARD
            ====================================================== --}}

            <div class="bottom-actions">

                <div class="pagination-area">

                    <div class="pagination-info">

                        Menunjukkan
                        <strong>{{ $visitors->firstItem() }}</strong>
                        hingga
                        <strong>{{ $visitors->lastItem() }}</strong>
                        daripada
                        <strong>{{ $visitors->total() }}</strong>
                        rekod

                    </div>


                    <div class="pagination-controls">

                        {{-- Previous --}}

                        @if ($visitors->onFirstPage())

                            <span class="pagination-link pagination-prev disabled">
                                ← Sebelum
                            </span>

                        @else

                            <a
                                href="{{ $visitors->previousPageUrl() }}"
                                class="pagination-link pagination-prev">

                                ← Sebelum

                            </a>

                        @endif


                        {{-- Page Numbers --}}

                        @php

                            $startPage = max(
                                1,
                                $visitors->currentPage() - 2
                            );

                            $endPage = min(
                                $visitors->lastPage(),
                                $visitors->currentPage() + 2
                            );

                        @endphp


                        @if ($startPage > 1)

                            <a
                                href="{{ $visitors->url(1) }}"
                                class="pagination-link">

                                1

                            </a>

                            @if ($startPage > 2)

                                <span class="pagination-link disabled">
                                    ...
                                </span>

                            @endif

                        @endif


                        @for ($page = $startPage; $page <= $endPage; $page++)

                            @if ($page == $visitors->currentPage())

                                <span
                                    class="pagination-link active">

                                    {{ $page }}

                                </span>

                            @else

                                <a
                                    href="{{ $visitors->url($page) }}"
                                    class="pagination-link">

                                    {{ $page }}

                                </a>

                            @endif

                        @endfor


                        @if ($endPage < $visitors->lastPage())

                            @if ($endPage < $visitors->lastPage() - 1)

                                <span class="pagination-link disabled">
                                    ...
                                </span>

                            @endif

                            <a
                                href="{{ $visitors->url($visitors->lastPage()) }}"
                                class="pagination-link">

                                {{ $visitors->lastPage() }}

                            </a>

                        @endif


                        {{-- Next --}}

                        @if ($visitors->hasMorePages())

                            <a
                                href="{{ $visitors->nextPageUrl() }}"
                                class="pagination-link pagination-next">

                                Seterusnya →

                            </a>

                        @else

                            <span class="pagination-link pagination-next disabled">
                                Seterusnya →
                            </span>

                        @endif

                    </div>

                </div>


                {{-- =========================
                     KEMBALI DASHBOARD
                ========================== --}}

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="dashboard-button">

                    ← Kembali ke Dashboard

                </a>

            </div>

        @else

            <div class="empty">

                Tiada rekod pengunjung ditemui.

            </div>


            {{-- =========================
                 DASHBOARD - TIADA REKOD
            ========================== --}}

            <div class="bottom-actions">

                <div class="pagination-area"></div>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="dashboard-button">

                    ← Kembali ke Dashboard

                </a>

            </div>

        @endif

    </div>

</div>

</body>

</html>