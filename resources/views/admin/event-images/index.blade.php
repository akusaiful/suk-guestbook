<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Gambar Event - MELAKA DIGITAL GUESTBOOK
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

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /*
        |--------------------------------------------------------------------------
        | Event Summary
        |--------------------------------------------------------------------------
        */

        .event-summary {
            display: grid;
            grid-template-columns: 1.45fr 0.55fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .summary-card {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .summary-kicker {
            margin: 0 0 7px;
            color: #6b7280;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .summary-name {
            margin: 0;
            color: #111827;
            font-size: 26px;
            font-weight: 800;
            line-height: 1.35;
        }

        .summary-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 38px;
            padding: 8px 12px;
            border-radius: 999px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            color: #374151;
            font-size: 14px;
            font-weight: 700;
        }

        .summary-stat {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .summary-stat-number {
            color: #111827;
            font-size: 42px;
            font-weight: 800;
            line-height: 1;
        }

        .summary-stat-label {
            margin-top: 8px;
            color: #6b7280;
            font-size: 15px;
            font-weight: 700;
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Card
        |--------------------------------------------------------------------------
        */

        .upload-card {
            margin-bottom: 24px;
            padding: 24px;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .section-title {
            margin: 0;
            font-size: 21px;
            font-weight: 800;
            line-height: 1.3;
        }

        .section-description {
            margin: 7px 0 0;
            color: #6b7280;
            font-size: 15px;
            line-height: 1.55;
        }

        .upload-form {
            margin-top: 20px;
            display: grid;
            grid-template-columns: minmax(0, 1.35fr) minmax(280px, 0.72fr) auto;
            align-items: start;
            gap: 12px;
        }

        .upload-form > .btn {
            margin-top: 29px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-size: 15px;
            font-weight: 700;
        }

        .field input[type="file"],
        .field input[type="text"] {
            width: 100%;
            min-height: 50px;
            padding: 11px 14px;
            border: 1px solid #9ca3af;
            border-radius: 8px;
            background: #ffffff;
            color: #111827;
            font-size: 15px;
        }

        .field input:focus {
            outline: none;
            border-color: #861b24;
            box-shadow: 0 0 0 3px rgba(134, 27, 36, 0.12);
        }

        .upload-help {
            margin-top: 8px;
            color: #6b7280;
            font-size: 13px;
            line-height: 1.45;
        }

        /*
        |--------------------------------------------------------------------------
        | Gallery
        |--------------------------------------------------------------------------
        */

        .gallery-card {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .gallery-header {
            padding: 22px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .gallery-count {
            color: #6b7280;
            font-size: 14px;
            font-weight: 700;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            padding: 24px;
        }

        .image-card {
            min-width: 0;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 2px 7px rgba(0, 0, 0, 0.05);
        }

        .image-frame {
            position: relative;
            aspect-ratio: 16 / 10;
            overflow: hidden;
            background: #f3f4f6;
        }

        .image-frame img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            transition: transform 0.25s ease;
        }

        .image-card:hover .image-frame img {
            transform: scale(1.03);
        }

        .image-body {
            padding: 14px;
        }

        .image-caption {
            min-height: 22px;
            color: #111827;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.45;
            word-break: break-word;
        }

        .image-date {
            margin-top: 7px;
            color: #6b7280;
            font-size: 12px;
        }

        .image-actions {
            margin-top: 12px;
            display: flex;
            justify-content: flex-end;
        }

        .image-actions .btn {
            min-height: 40px;
            padding: 8px 13px;
            font-size: 13px;
        }

        .empty-gallery {
            padding: 70px 24px;
            text-align: center;
            color: #6b7280;
        }

        .empty-icon {
            font-size: 48px;
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
            font-size: 15px;
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1100px) {

            .event-summary {
                grid-template-columns: 1fr;
            }

            .summary-stat {
                align-items: flex-start;
                text-align: left;
            }

            .gallery-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
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

            .upload-form {
                grid-template-columns: 1fr;
            }

            .upload-form > .btn {
                width: 100%;
                margin-top: 0;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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

            .summary-card,
            .upload-card {
                padding: 18px;
            }

            .summary-name {
                font-size: 22px;
            }

            .gallery-header {
                padding: 18px;
                align-items: flex-start;
                flex-direction: column;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
                padding: 18px;
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
                    Gambar Event
                </h2>

                <p class="page-description">
                    Urus galeri gambar untuk event yang dipilih.
                    Gambar ini akan digunakan dalam Guestbook Digital Melaka.
                </p>

            </div>


            <div class="header-actions">

                <a
                    href="{{ route('admin.events.index') }}"
                    class="btn btn-secondary"
                >
                    ← Senarai Event
                </a>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="btn btn-secondary"
                >
                    Dashboard
                </a>

            </div>

        </div>


        {{-- =========================================================
             ALERT
        ========================================================== --}}

        @if (session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        @if ($errors->any())

            <div class="alert alert-error">

                {{ $errors->first() }}

            </div>

        @endif


        {{-- =========================================================
             EVENT SUMMARY
        ========================================================== --}}

        <section class="event-summary">

            <div class="summary-card">

                <p class="summary-kicker">
                    Event Dipilih
                </p>

                <h3 class="summary-name">
                    {{ $event->name }}
                </h3>

                <div class="summary-meta">

                    <span class="meta-pill">
                        📅
                        {{ optional($event->event_date)->format('d/m/Y') ?? '-' }}
                    </span>

                    <span class="meta-pill">
                        📍
                        {{ $event->location ?? '-' }}
                    </span>

                    <span class="meta-pill">
                        ID: {{ $event->id }}
                    </span>

                </div>

            </div>


            <div class="summary-card summary-stat">

                <div class="summary-stat-number">
                    {{ $images->count() }}
                </div>

                <div class="summary-stat-label">
                    Jumlah Gambar Event
                </div>

            </div>

        </section>


        {{-- =========================================================
             UPLOAD
        ========================================================== --}}

        <section class="upload-card">

            <h3 class="section-title">
                📸 Tambah Gambar Event
            </h3>

            <p class="section-description">
                Muat naik gambar acara. Pilihan format: JPG, JPEG, PNG atau WebP.
                Saiz maksimum 10MB untuk satu gambar.
            </p>


            <form
                method="POST"
                action="{{ route('admin.events.images.store', ['event' => $event->id]) }}"
                enctype="multipart/form-data"
                class="upload-form"
            >

                @csrf

                <div class="field">

                    <label for="image">
                        Gambar Event
                    </label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        required
                    >

                    <div class="upload-help">
                        Pilih satu gambar pada satu-satu masa.
                    </div>

                </div>


                <div class="field">

                    <label for="caption">
                        Keterangan / Caption
                    </label>

                    <input
                        type="text"
                        id="caption"
                        name="caption"
                        value="{{ old('caption') }}"
                        maxlength="255"
                        placeholder="Contoh: Sesi bergambar tetamu kehormat"
                    >

                </div>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    ↑ Upload Gambar
                </button>

            </form>

        </section>


        {{-- =========================================================
             GALLERY
        ========================================================== --}}

        <section class="gallery-card">

            <div class="gallery-header">

                <div>
                    <h3 class="section-title">
                        Galeri Event
                    </h3>
                </div>

                <div class="gallery-count">
                    {{ $images->count() }} gambar
                </div>

            </div>


            @if ($images->count())

                <div class="gallery-grid">

                    @foreach ($images as $image)

                        <article class="image-card">

                            <div class="image-frame">

                                <a
                                    href="{{ asset('storage/' . $image->image_path) }}"
                                    target="_blank"
                                    rel="noopener"
                                    aria-label="Lihat gambar penuh"
                                >

                                    <img
                                        src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="{{ $image->caption ?: 'Gambar event' }}"
                                        loading="lazy"
                                    >

                                </a>

                            </div>


                            <div class="image-body">

                                <div class="image-caption">
                                    {{ $image->caption ?: 'Tiada caption' }}
                                </div>

                                <div class="image-date">
                                    Ditambah
                                    {{ optional($image->created_at)->format('d/m/Y H:i') ?? '-' }}
                                </div>


                                <div class="image-actions">

                                    <form
                                        method="POST"
                                        action="{{ route('admin.events.images.destroy', [
                                            'event' => $event->id,
                                            'eventImage' => $image->id,
                                        ]) }}"
                                        onsubmit="return confirm('Adakah anda pasti mahu memadam gambar ini?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                        >
                                            🗑 Padam
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-gallery">

                    <div class="empty-icon">
                        🖼️
                    </div>

                    <div class="empty-title">
                        Belum ada gambar event
                    </div>

                    <div class="empty-text">
                        Gunakan borang di atas untuk menambah gambar pertama bagi event ini.
                    </div>

                </div>

            @endif

        </section>

    </main>


</body>

</html>
