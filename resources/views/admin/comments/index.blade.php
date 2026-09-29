<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengurusan Komen - MELAKA DIGITAL GUESTBOOK</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        .page-wrapper {
            min-height: 100vh;
        }

        /* =========================================================
           TOP BAR
        ========================================================= */

        .topbar {
            height: 76px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f5b700, #d99a00);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 21px;
            font-weight: 800;
            box-shadow: 0 5px 14px rgba(217, 154, 0, 0.22);
        }

        .brand-title {
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.2px;
            color: #111827;
        }

        .brand-subtitle {
            margin-top: 2px;
            font-size: 12px;
            color: #6b7280;
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 13px;
            border-radius: 999px;
            background: #f3f4f6;
            color: #374151;
            font-size: 12px;
            font-weight: 700;
        }

        /* =========================================================
           MAIN
        ========================================================= */

        .content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 32px 50px;
        }

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .heading-left h1 {
            margin: 0;
            font-size: 28px;
            line-height: 1.2;
            font-weight: 850;
            color: #111827;
            letter-spacing: -0.5px;
        }

        .heading-left p {
            margin: 8px 0 0;
            color: #6b7280;
            font-size: 14px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 10px;
            background: #ffffff;
            border: 1px solid #d9dee7;
            color: #374151;
            text-decoration: none;
            font-size: 13px;
            font-weight: 750;
            transition: all 0.2s ease;
        }

        .back-button:hover {
            background: #f9fafb;
            border-color: #bfc6d2;
            transform: translateY(-1px);
        }

        /* =========================================================
           ALERT
        ========================================================= */

        .alert-success {
            margin-bottom: 20px;
            padding: 14px 17px;
            border-radius: 12px;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* =========================================================
           FILTER & CARIAN EVENT
        ========================================================= */

        .filter-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px 22px;
            margin-bottom: 20px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .filter-title {
            font-size: 13px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 14px;
        }

        .filter-form {
            display: flex;
            align-items: flex-end;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1 1 320px;
            min-width: 280px;
        }

        .filter-search {
            flex: 1 1 420px;
            min-width: 320px;
        }

        .filter-label {
            display: block;
            margin-bottom: 7px;
            font-size: 12px;
            font-weight: 800;
            color: #4b5563;
        }

        .filter-select,
        .filter-input {
            width: 100%;
            min-height: 44px;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            background: #ffffff;
            color: #111827;
            font-size: 13px;
        }

        .filter-select:focus,
        .filter-input:focus {
            outline: none;
            border-color: #861b24;
            box-shadow: 0 0 0 3px rgba(134, 27, 36, 0.10);
        }

        .filter-button,
        .reset-filter-button {
            min-height: 44px;
            padding: 10px 16px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        .filter-button {
            border: 1px solid #861b24;
            background: #861b24;
            color: #ffffff;
        }

        .filter-button:hover {
            background: #6f151d;
        }

        .reset-filter-button {
            border: 1px solid #d1d5db;
            background: #ffffff;
            color: #374151;
        }

        .reset-filter-button:hover {
            background: #f9fafb;
        }

        .active-filter-info {
            margin-top: 12px;
            font-size: 12px;
            color: #6b7280;
        }

        .active-filter-info strong {
            color: #111827;
        }

        /* =========================================================
           SUMMARY
        ========================================================= */

        .summary-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px 22px;
            margin-bottom: 20px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .summary-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-number {
            margin-top: 5px;
            font-size: 28px;
            font-weight: 850;
            color: #111827;
        }

        /* =========================================================
           TABLE CARD
        ========================================================= */

        .table-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .table-header {
            padding: 18px 22px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .table-header-title {
            font-size: 15px;
            font-weight: 800;
            color: #111827;
        }

        .table-header-description {
            margin-top: 3px;
            font-size: 12px;
            color: #6b7280;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px;
        }

        thead {
            background: #f8fafc;
        }

        th {
            padding: 13px 18px;
            text-align: left;
            font-size: 11px;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        td {
            padding: 16px 18px;
            border-bottom: 1px solid #eef1f5;
            vertical-align: top;
            font-size: 13px;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #fafcff;
        }

        .name {
            font-weight: 800;
            color: #111827;
        }

        .organization {
            margin-top: 4px;
            font-size: 12px;
            color: #6b7280;
        }

        .comment-text {
            max-width: 430px;
            line-height: 1.55;
            color: #374151;
            white-space: normal;
            word-break: break-word;
        }

        .date {
            white-space: nowrap;
            color: #6b7280;
            font-size: 12px;
        }

        /* =========================================================
           RATING
        ========================================================= */

        .rating {
            display: inline-flex;
            align-items: center;
            gap: 1px;
            white-space: nowrap;
        }

        .star {
            font-size: 16px;
            color: #f5b700;
        }

        .star.empty {
            color: #d1d5db;
        }

        .rating-number {
            margin-left: 7px;
            font-size: 12px;
            font-weight: 800;
            color: #6b7280;
        }

        /* =========================================================
           STATUS
        ========================================================= */

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            text-transform: capitalize;
        }

        .status-published {
            background: #ecfdf5;
            color: #047857;
        }

        .status-other {
            background: #f3f4f6;
            color: #4b5563;
        }

        /* =========================================================
           DELETE BUTTON
        ========================================================= */

        .delete-button {
            border: 1px solid #fecaca;
            background: #fff;
            color: #dc2626;
            border-radius: 9px;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .delete-button:hover {
            background: #fef2f2;
            border-color: #fca5a5;
        }

        /* =========================================================
           EMPTY
        ========================================================= */

        .empty-state {
            padding: 60px 25px;
            text-align: center;
        }

        .empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
        }

        .empty-title {
            font-size: 16px;
            font-weight: 800;
            color: #374151;
        }

        .empty-description {
            margin-top: 6px;
            color: #9ca3af;
            font-size: 13px;
        }

        /* =========================================================
           PAGINATION
        ========================================================= */

        .pagination-wrapper {
            padding: 18px 22px;
            border-top: 1px solid #e5e7eb;
        }

        .pagination-wrapper nav {
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper svg {
            width: 18px;
            height: 18px;
        }

        /* =========================================================
           CONFIRM MODAL
        ========================================================= */

        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.48);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 100;
        }

        .modal-backdrop.show {
            display: flex;
        }

        .modal {
            width: 100%;
            max-width: 460px;
            background: #ffffff;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 25px 70px rgba(15, 23, 42, 0.25);
        }

        .modal-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            background: #fef2f2;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            margin-bottom: 16px;
        }

        .modal-title {
            margin: 0;
            font-size: 19px;
            font-weight: 850;
            color: #111827;
        }

        .modal-description {
            margin: 9px 0 0;
            font-size: 13px;
            line-height: 1.55;
            color: #6b7280;
        }

        .modal-comment {
            margin-top: 15px;
            padding: 12px 14px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            color: #374151;
            font-size: 13px;
            line-height: 1.5;
        }

        .modal-actions {
            margin-top: 22px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .modal-cancel,
        .modal-delete {
            padding: 10px 16px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
        }

        .modal-cancel {
            border: 1px solid #d1d5db;
            background: #ffffff;
            color: #374151;
        }

        .modal-delete {
            border: 1px solid #dc2626;
            background: #dc2626;
            color: #ffffff;
        }

        .modal-delete:hover {
            background: #b91c1c;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 700px) {
            .topbar {
                padding: 0 16px;
            }

            .brand-subtitle {
                display: none;
            }

            .content {
                padding: 22px 16px 40px;
            }

            .page-heading {
                flex-direction: column;
            }

            .heading-left h1 {
                font-size: 23px;
            }

            .back-button {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

<div class="page-wrapper">

    {{-- =========================================================
         TOP BAR
    ========================================================== --}}
    <header class="topbar">

        <div class="brand">

            <div class="brand-icon">
                MG
            </div>

            <div>
                <div class="brand-title">
                    MELAKA DIGITAL GUESTBOOK
                </div>

                <div class="brand-subtitle">
                    Smart Visitor Registration & Digital Signature
                </div>
            </div>

        </div>

        <div class="admin-badge">
            🛡️ Admin
        </div>

    </header>


    {{-- =========================================================
         CONTENT
    ========================================================== --}}
    <main class="content">

        {{-- PAGE HEADING --}}
        <div class="page-heading">

            <div class="heading-left">

                <h1>
                    Pengurusan Komen
                </h1>

                <p>
                    Semak dan urus komen pengunjung yang dipaparkan di Guestbook Display.
                </p>

            </div>

            <a
                href="{{ route('admin.dashboard') }}"
                class="back-button"
            >
                ← Kembali ke Dashboard
            </a>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))

            <div class="alert-success">
                <span>✓</span>

                <span>
                    {{ session('success') }}
                </span>
            </div>

        @endif


        {{-- SUMMARY --}}
        <div class="summary-card">

            <div class="summary-label">
                Jumlah Komen
            </div>

            <div class="summary-number">
                {{ $comments->total() }}
            </div>

        </div>


        {{-- FILTER & CARIAN EVENT --}}
        <div class="filter-card">

            <div class="filter-title">
                🔎 Carian & Kawalan Komen
            </div>

            <form
                method="GET"
                action="{{ route('admin.comments.index') }}"
                class="filter-form"
            >

                <div class="filter-group">

                    <label
                        for="event_id"
                        class="filter-label"
                    >
                        Pilih Event
                    </label>

                    <select
                        id="event_id"
                        name="event_id"
                        class="filter-select"
                    >

                        <option value="">
                            Semua Event
                        </option>

                        @foreach ($events as $event)

                            <option
                                value="{{ $event->id }}"
                                {{ request('event_id') == $event->id ? 'selected' : '' }}
                            >
                                #{{ $event->id }} — {{ $event->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="filter-search">

                    <label
                        for="search"
                        class="filter-label"
                    >
                        Carian Komen
                    </label>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        class="filter-input"
                        value="{{ request('search') }}"
                        placeholder="Cari nama, organisasi atau kandungan komen..."
                        autocomplete="off"
                    >

                </div>


                <button
                    type="submit"
                    class="filter-button"
                >
                    🔎 Cari
                </button>


                @if (request('event_id') || request('search'))

                    <a
                        href="{{ route('admin.comments.index') }}"
                        class="reset-filter-button"
                    >
                        ↻ Reset
                    </a>

                @endif

            </form>


            @if (request('event_id'))

                @php
                    $selectedEvent = $events->firstWhere(
                        'id',
                        (int) request('event_id')
                    );
                @endphp

                <div class="active-filter-info">

                    Sedang memaparkan komen untuk:
                    <strong>
                        #{{ request('event_id') }}
                        @if ($selectedEvent)
                            — {{ $selectedEvent->name }}
                        @endif
                    </strong>

                </div>

            @endif

        </div>


        {{-- TABLE --}}
        <div class="table-card">

            <div class="table-header">

                <div>
                    <div class="table-header-title">
                        Senarai Komen Pengunjung
                    </div>

                    <div class="table-header-description">
                        Admin boleh memadam komen yang tidak sesuai daripada sistem.
                    </div>
                </div>

            </div>


            @if($comments->count())

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>
                                <th style="width: 17%;">
                                    Pengunjung
                                </th>

                                <th style="width: 18%;">
                                    Event
                                </th>

                                <th style="width: 30%;">
                                    Komen
                                </th>

                                <th style="width: 12%;">
                                    Rating
                                </th>

                                <th style="width: 12%;">
                                    Status
                                </th>

                                <th style="width: 13%;">
                                    Tarikh
                                </th>

                                <th style="width: 10%;">
                                    Tindakan
                                </th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($comments as $comment)

                                <tr>

                                    {{-- PENGUNJUNG --}}
                                    <td>

                                        <div class="name">
                                            {{ $comment->name ?: 'Tanpa Nama' }}
                                        </div>

                                        @if($comment->organization)

                                            <div class="organization">
                                                {{ $comment->organization }}
                                            </div>

                                        @endif

                                    </td>


                                    {{-- EVENT --}}
                                    <td>

                                        @if ($comment->event)

                                            <div class="name">
                                                #{{ $comment->event->id }}
                                            </div>

                                            <div class="organization">
                                                {{ $comment->event->name }}
                                            </div>

                                        @else

                                            <span class="organization">
                                                Event tidak ditemui
                                            </span>

                                        @endif

                                    </td>


                                    {{-- KOMEN --}}
                                    <td>

                                        <div class="comment-text">
                                            {{ $comment->comment ?: 'Tiada komen' }}
                                        </div>

                                    </td>


                                    {{-- RATING --}}
                                    <td>

                                        @php
                                            $rating = (int) ($comment->rating ?? 0);
                                        @endphp

                                        <div class="rating">

                                            @for($i = 1; $i <= 5; $i++)

                                                <span class="star {{ $i <= $rating ? '' : 'empty' }}">
                                                    ★
                                                </span>

                                            @endfor

                                            <span class="rating-number">
                                                {{ $rating }}/5
                                            </span>

                                        </div>

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if($comment->status === 'published')

                                            <span class="status-badge status-published">
                                                Published
                                            </span>

                                        @else

                                            <span class="status-badge status-other">
                                                {{ $comment->status ?: 'N/A' }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- TARIKH --}}
                                    <td>

                                        <div class="date">

                                            {{ $comment->created_at?->format('d/m/Y') }}

                                            <br>

                                            {{ $comment->created_at?->format('H:i') }}

                                        </div>

                                    </td>


                                    {{-- TINDAKAN --}}
                                    <td>

                                        <button
                                            type="button"
                                            class="delete-button"
                                            onclick="openDeleteModal(
                                                {{ $comment->id }},
                                                @js($comment->name ?: 'Tanpa Nama'),
                                                @js($comment->comment ?: 'Tiada komen')
                                            )"
                                        >
                                            🗑️ Padam
                                        </button>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}
                <div class="pagination-wrapper">

                    {{ $comments->links() }}

                </div>

            @else

                {{-- EMPTY STATE --}}
                <div class="empty-state">

                    <div class="empty-icon">
                        💬
                    </div>

                    <div class="empty-title">
                        Tiada komen
                    </div>

                    <div class="empty-description">
                        Belum terdapat komen pengunjung dalam sistem.
                    </div>

                </div>

            @endif

        </div>

    </main>

</div>


{{-- =========================================================
     DELETE CONFIRMATION MODAL
========================================================= --}}
<div
    id="deleteModal"
    class="modal-backdrop"
    onclick="closeDeleteModal(event)"
>

    <div
        class="modal"
        onclick="event.stopPropagation()"
    >

        <div class="modal-icon">
            🗑️
        </div>

        <h2 class="modal-title">
            Padam Komen?
        </h2>

        <p class="modal-description">
            Tindakan ini akan memadam komen tersebut daripada sistem
            dan ia tidak lagi dipaparkan di Guestbook Display.
        </p>

        <div
            id="modalComment"
            class="modal-comment"
        ></div>


        <div class="modal-actions">

            <button
                type="button"
                class="modal-cancel"
                onclick="closeDeleteModal()"
            >
                Batal
            </button>

            <form
                id="deleteCommentForm"
                method="POST"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="modal-delete"
                >
                    Ya, Padam
                </button>

            </form>

        </div>

    </div>

</div>


<script>

    function openDeleteModal(id, name, comment)
    {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteCommentForm');
        const modalComment = document.getElementById('modalComment');

        form.action = "{{ url('/admin/comments') }}/" + id;

        modalComment.innerHTML =
            '<strong>' +
            escapeHtml(name) +
            '</strong><br>' +
            escapeHtml(comment);

        modal.classList.add('show');

        document.body.style.overflow = 'hidden';
    }


    function closeDeleteModal(event = null)
    {
        if (
            event &&
            event.target !== document.getElementById('deleteModal')
        ) {
            return;
        }

        const modal = document.getElementById('deleteModal');

        modal.classList.remove('show');

        document.body.style.overflow = '';
    }


    function escapeHtml(value)
    {
        const div = document.createElement('div');

        div.textContent = value;

        return div.innerHTML;
    }


    document.addEventListener('keydown', function (event)
    {
        if (event.key === 'Escape') {
            closeDeleteModal();
        }
    });

</script>

</body>
</html>