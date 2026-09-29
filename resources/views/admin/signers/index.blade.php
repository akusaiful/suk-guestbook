<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Penandatangan - MELAKA DIGITAL GUESTBOOK
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

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


        /* =========================================================
           LAYOUT
        ========================================================== */

        .page {
            min-height: 100vh;

            padding: 40px 30px 55px;
        }


        .container {
            width: 100%;

            max-width: 1500px;

            margin: 0 auto;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .top-header {
            background: #ffffff;

            border-bottom: 1px solid #d1d5db;

            margin: -40px -30px 35px;

            padding: 24px 30px;
        }


        .top-header-inner {
            width: 100%;

            max-width: 1500px;

            margin: 0 auto;
        }


        .brand-title {
            margin: 0;

            font-size: 34px;

            font-weight: 800;

            line-height: 1.2;

            color: #111827;
        }


        .brand-subtitle {
            margin-top: 8px;

            font-size: 18px;

            line-height: 1.5;

            color: #6b7280;
        }


        /* =========================================================
           MAIN CARD
        ========================================================== */

        .main-card {
            background: #ffffff;

            border: 1px solid #d1d5db;

            border-radius: 14px;

            overflow: hidden;

            box-shadow:
                0 2px 10px rgba(0, 0, 0, 0.04);
        }


        /* =========================================================
           PAGE HEADER
        ========================================================== */

        .card-header {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 25px;

            padding: 28px 30px;

            border-bottom: 1px solid #e5e7eb;
        }


        .card-header-content {
            min-width: 0;
        }


        .page-title {
            margin: 0;

            font-size: 30px;

            font-weight: 800;

            line-height: 1.25;

            color: #111827;
        }


        .page-description {
            margin: 8px 0 0;

            font-size: 17px;

            line-height: 1.6;

            color: #6b7280;
        }


        /* =========================================================
           HEADER ACTIONS
        ========================================================== */

        .header-actions {
            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 10px;

            flex-wrap: wrap;

            flex-shrink: 0;
        }


        /* =========================================================
           BUTTON BASE
        ========================================================== */

        .btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-height: 48px;

            padding: 11px 18px;

            border-radius: 8px;

            border: 1px solid transparent;

            text-decoration: none;

            font-size: 16px;

            font-weight: 700;

            line-height: 1.2;

            cursor: pointer;

            white-space: nowrap;

            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                color 0.2s ease,
                box-shadow 0.2s ease;

            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        .btn:focus-visible {
            outline: 3px solid rgba(134, 27, 36, 0.18);

            outline-offset: 2px;
        }


        /* =========================================================
           DASHBOARD
        ========================================================== */

        .btn-dashboard {
            background: #ffffff;

            color: #111827;

            border-color: #9ca3af;
        }


        .btn-dashboard:hover {
            background: #f9fafb;

            border-color: #6b7280;
        }


        /* =========================================================
           PRIMARY
        ========================================================== */

        .btn-primary {
            background: #111827;

            color: #ffffff;

            border-color: #111827;
        }


        .btn-primary:hover {
            background: #000000;

            border-color: #000000;
        }


        /* =========================================================
           EXPORT EXCEL
        ========================================================== */

        .btn-excel {
            background: #ffffff;
            color: #166534;
            border-color: #86efac;
        }


        .btn-excel:hover {
            background: #f0fdf4;
            border-color: #4ade80;
        }


        /* =========================================================
           SECONDARY
        ========================================================== */

        .btn-secondary {
            background: #ffffff;

            color: #111827;

            border-color: #9ca3af;
        }


        .btn-secondary:hover {
            background: #f9fafb;

            border-color: #6b7280;
        }


        /* =========================================================
           DANGER
        ========================================================== */

        .btn-danger {
            background: #ffffff;

            color: #b91c1c;

            border-color: #fca5a5;
        }


        .btn-danger:hover {
            background: #fef2f2;

            border-color: #dc2626;
        }


        /* =========================================================
           SUCCESS ALERT
        ========================================================== */

        .alert {
            margin: 22px 30px;

            padding: 15px 18px;

            border-radius: 8px;

            font-size: 16px;

            line-height: 1.5;
        }


        .alert-success {
            background: #ecfdf5;

            color: #166534;

            border: 1px solid #bbf7d0;
        }


        /* =========================================================
           TABLE CARD BODY
        ========================================================== */

        .table-section {
            padding: 0;
        }


        .table-wrapper {
            width: 100%;

            overflow-x: auto;
        }


        table {
            width: 100%;

            min-width: 1100px;

            border-collapse: collapse;
        }


        thead {
            background: #f9fafb;
        }


        th {
            padding: 18px 22px;

            text-align: left;

            font-size: 14px;

            font-weight: 800;

            color: #4b5563;

            text-transform: uppercase;

            letter-spacing: 0.03em;

            white-space: nowrap;

            border-bottom: 1px solid #e5e7eb;
        }


        td {
            padding: 22px;

            vertical-align: middle;

            border-bottom: 1px solid #e5e7eb;

            font-size: 16px;

            color: #111827;
        }


        tbody tr:last-child td {
            border-bottom: none;
        }


        tbody tr:hover {
            background: #fafafa;
        }


        /* =========================================================
           SIGNER NAME
        ========================================================== */

        .signer-name {
            font-size: 18px;

            font-weight: 800;

            line-height: 1.4;

            color: #111827;
        }


        .signer-email {
            margin-top: 5px;

            font-size: 14px;

            line-height: 1.4;

            color: #6b7280;
        }


        .signer-detail {
            color: #374151;

            line-height: 1.5;
        }


        /* =========================================================
           STATUS
        ========================================================== */

        .status {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-height: 34px;

            padding: 7px 13px;

            border-radius: 999px;

            font-size: 14px;

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


        /* =========================================================
           ACTIONS
        ========================================================== */

        .action-group {
            display: grid;

            grid-template-columns:
                repeat(2, 110px);

            align-items: stretch;

            justify-content: end;

            gap: 8px;
        }


        .action-group .btn {
            width: 110px;

            min-height: 44px;

            padding: 10px 12px;

            font-size: 14px;

            text-align: center;
        }


        .action-group form {
            width: 110px;

            margin: 0;
        }


        .action-group form .btn {
            width: 110px;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .empty {
            padding: 60px 20px;

            text-align: center;

            color: #6b7280;

            font-size: 16px;
        }


        /* =========================================================
           FOOTER ACTION
        ========================================================== */

        .card-footer {
            display: flex;

            align-items: center;

            justify-content: flex-start;

            padding: 22px 30px;

            border-top: 1px solid #e5e7eb;

            background: #ffffff;
        }


        /* =========================================================
           MOBILE / TABLET
        ========================================================== */

        @media (max-width: 900px) {

            .page {
                padding: 28px 18px 40px;
            }


            .top-header {
                margin:
                    -28px -18px 28px;

                padding:
                    22px 18px;
            }


            .brand-title {
                font-size: 28px;
            }


            .brand-subtitle {
                font-size: 16px;
            }


            .card-header {
                align-items: flex-start;

                flex-direction: column;

                padding: 24px 20px;
            }


            .header-actions {
                width: 100%;

                justify-content: flex-start;
            }


            .header-actions .btn {
                flex: 1;
            }


            .alert {
                margin:
                    20px;
            }


            .card-footer {
                padding:
                    20px;
            }

        }


        @media (max-width: 600px) {

            .page {
                padding:
                    22px 12px 32px;
            }


            .top-header {
                margin:
                    -22px -12px 22px;

                padding:
                    20px 12px;
            }


            .brand-title {
                font-size: 24px;
            }


            .brand-subtitle {
                font-size: 15px;
            }


            .main-card {
                border-radius: 12px;
            }


            .page-title {
                font-size: 25px;
            }


            .page-description {
                font-size: 15px;
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


            .alert {
                margin:
                    16px;
            }


            .card-footer {
                padding:
                    16px;
            }


            .card-footer .btn {
                width: 100%;
            }


            .action-group {
                justify-content: start;
            }

        }

    </style>

</head>


<body>

<div class="page">

    {{-- =========================================================
         TOP HEADER
    ========================================================== --}}

    <header class="top-header">

        <div class="top-header-inner">

            <h1 class="brand-title">
                MELAKA DIGITAL GUESTBOOK
            </h1>

            <div class="brand-subtitle">
                Pengurusan Penandatangan
            </div>

        </div>

    </header>


    <div class="container">

        {{-- =========================================================
             MAIN CARD
        ========================================================== --}}

        <div class="main-card">


            {{-- =====================================================
                 CARD HEADER
            ====================================================== --}}

            <div class="card-header">

                <div class="card-header-content">

                    <h2 class="page-title">
                        Senarai Penandatangan
                    </h2>

                    <p class="page-description">
                        Senarai individu yang boleh dipilih oleh Admin
                        untuk tandatangan.
                    </p>

                </div>


                {{-- =================================================
                     HEADER ACTIONS
                ================================================== --}}

                <div class="header-actions">

                    {{-- KEMBALI DASHBOARD --}}

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="btn btn-dashboard"
                    >
                        ← Kembali ke Dashboard
                    </a>


                    {{-- EXPORT EXCEL --}}

                    <button
                        type="button"
                        id="export-signers-excel"
                        class="btn btn-excel"
                    >
                        📊 Export Excel
                    </button>


                    {{-- TAMBAH PENANDATANGAN --}}


                    <a
                        href="{{ route('admin.signers.create') }}"
                        class="btn btn-primary"
                    >
                        + Tambah Penandatangan
                    </a>

                </div>

            </div>


            {{-- =====================================================
                 SUCCESS MESSAGE
            ====================================================== --}}

            @if (session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif


            @php
                /*
                |----------------------------------------------------------------------
                | Event berkaitan untuk setiap penandatangan
                |----------------------------------------------------------------------
                | Seorang penandatangan boleh digunakan untuk lebih daripada satu event.
                | Data diambil melalui jadual signing_sessions.
                */
                $signerEventMap = \App\Models\SigningSession::query()
                    ->with(['event:id,name'])
                    ->get([
                        'signer_id',
                        'event_id',
                    ])
                    ->groupBy('signer_id');
            @endphp


            {{-- =====================================================
                 TABLE
            ====================================================== --}}

            <div class="table-section">

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    Nama
                                </th>

                                <th>
                                    Jawatan
                                </th>

                                <th>
                                    Organisasi
                                </th>

                                
                                <th>
                                    Event
                                </th><th>
                                    Telefon
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

                        @forelse ($signers as $signer)

                            <tr>


                                {{-- =================================================
                                     NAMA
                                ================================================== --}}

                                <td>

                                    <div class="signer-name">
                                        {{ $signer->name }}
                                    </div>


                                    @if ($signer->email)

                                        <div class="signer-email">
                                            {{ $signer->email }}
                                        </div>

                                    @endif

                                </td>


                                {{-- =================================================
                                     JAWATAN
                                ================================================== --}}

                                <td>

                                    <div class="signer-detail">
                                        {{ $signer->position ?? '-' }}
                                    </div>

                                </td>


                                {{-- =================================================
                                     ORGANISASI
                                ================================================== --}}

                                <td>

                                    <div class="signer-detail">
                                        {{ $signer->organization ?? '-' }}
                                    </div>

                                </td>


                                {{-- =================================================
                                     EVENT
                                ================================================== --}}

                                <td>

                                    @php
                                        $eventsForSigner = $signerEventMap
                                            ->get($signer->id, collect())
                                            ->map(fn ($session) => $session->event)
                                            ->filter()
                                            ->unique('id')
                                            ->values();
                                    @endphp

                                    @forelse ($eventsForSigner as $signerEvent)

                                        <div class="signer-detail">
                                            <strong>#{{ $signerEvent->id }}</strong>
                                            — {{ $signerEvent->name }}
                                        </div>

                                    @empty

                                        <div class="signer-detail">
                                            -
                                        </div>

                                    @endforelse

                                </td>



                                {{-- =================================================
                                     TELEFON
                                ================================================== --}}

                                <td>

                                    <div class="signer-detail">
                                        {{ $signer->phone ?? '-' }}
                                    </div>

                                </td>


                                {{-- =================================================
                                     STATUS
                                ================================================== --}}

                                <td>

                                    @if ($signer->is_active)

                                        <span class="status status-active">
                                            ● &nbsp; Aktif
                                        </span>

                                    @else

                                        <span class="status status-inactive">
                                            ● &nbsp; Tidak Aktif
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                     TINDAKAN
                                ================================================== --}}

                                <td>

                                    <div class="action-group">


                                        {{-- EDIT --}}

                                        <a
                                            href="{{ route('admin.signers.edit', $signer) }}"
                                            class="btn btn-secondary"
                                        >
                                            Edit
                                        </a>


                                        {{-- PADAM --}}

                                        <form
                                            action="{{ route('admin.signers.destroy', $signer) }}"
                                            method="POST"
                                            onsubmit="return confirm('Padam penandatangan ini?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                            >
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
                                    class="empty"
                                >
                                    Belum ada penandatangan.
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- =====================================================
                 FOOTER
            ====================================================== --}}

            <div class="card-footer">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="btn btn-dashboard"
                >
                    ← Kembali ke Dashboard
                </a>

            </div>


        </div>

    </div>

</div>


<script>
    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const exportButton =
                document.getElementById(
                    'export-signers-excel'
                );


            if (!exportButton) {
                return;
            }


            exportButton.addEventListener(
                'click',
                function () {

                    const sourceTable =
                        document.querySelector(
                            '.table-section table'
                        );


                    if (!sourceTable) {

                        alert(
                            'Tiada data penandatangan untuk dieksport.'
                        );

                        return;
                    }


                    const table =
                        sourceTable.cloneNode(true);


                    /*
                    |----------------------------------------------------------------------
                    | Buang kolum Tindakan.
                    |---------------------------------------------------------------------- 
                    */

                    table
                        .querySelectorAll('tr')
                        .forEach(
                            function (row) {

                                const cells =
                                    row.querySelectorAll(
                                        'th, td'
                                    );


                                if (cells.length > 0) {
                                    cells[cells.length - 1].remove();
                                }

                            }
                        );


                    const html =
                        '<!DOCTYPE html>' +
                        '<html>' +
                        '<head>' +
                        '<meta charset="UTF-8">' +
                        '</head>' +
                        '<body>' +
                        '<h2>MELAKA DIGITAL GUESTBOOK - SENARAI PENANDATANGAN</h2>' +
                        '<p>Tarikh Export: ' +
                        new Date().toLocaleString('ms-MY') +
                        '</p>' +
                        table.outerHTML +
                        '</body>' +
                        '</html>';


                    const blob =
                        new Blob(
                            [html],
                            {
                                type:
                                    'application/vnd.ms-excel;charset=utf-8;'
                            }
                        );


                    const url =
                        URL.createObjectURL(blob);


                    const link =
                        document.createElement('a');


                    const now =
                        new Date();


                    const datePart =
                        now.getFullYear() +
                        '-' +
                        String(
                            now.getMonth() + 1
                        ).padStart(2, '0') +
                        '-' +
                        String(
                            now.getDate()
                        ).padStart(2, '0');


                    link.href = url;


                    link.download =
                        'senarai-penandatangan-' +
                        datePart +
                        '.xls';


                    document.body.appendChild(link);

                    link.click();

                    link.remove();

                    URL.revokeObjectURL(url);

                }
            );

        }
    );
</script>

</body>

</html>