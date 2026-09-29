<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        {{ $event->name }} - MELAKA DIGITAL GUESTBOOK
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
           background: transparent;
            color: #111827;
        }

       .header {
    width: 100%;
    margin: 0;
    padding: 0;
    background: transparent;
    border: 0;
    text-align: center;
    position: relative;
    z-index: 1;
    overflow: hidden;
}

        .header-image {
            display: block;
            width: 100%;
            height: auto;
            max-width: 100%;
            margin: 0;
            object-fit: contain;
        }

        .logo-title,
        .subtitle {
            display: none;
        }

        .container {
            max-width: 700px;
            margin: 30px auto;
            padding: 0 20px 40px;
        }

        .event-card {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 20px;
        }

        .event-name {
            font-size: 22px;
            font-weight: 700;
        }

        .event-info {
            margin-top: 8px;
            color: #6b7280;
            font-size: 14px;
        }

       .form-card {
    background: rgba(255, 250, 242, 0.97);
    border: 1px solid var(--gb-border, #dbc7ae);
    border-radius: 18px;
    padding: 28px;
    box-shadow: 0 10px 30px rgba(61, 37, 27, 0.08);
}

.form-card h2 {
    color: var(--gb-primary, #861b24);
    font-size: 22px;
    font-weight: 800;
}

.form-card > p {
    line-height: 1.6;
}

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

      input,
textarea {
    width: 100%;
    padding: 13px 15px;
    border: 1px solid var(--gb-border, #dbc7ae);
    border-radius: 10px;
    font-size: 15px;
    font-family: inherit;
    background: #fffdf9;
    color: #3d251b;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

input::placeholder,
textarea::placeholder {
    color: #a89a8f;
}

input:hover,
textarea:hover {
    border-color: #c39a52;
}

input:focus,
textarea:focus {
    outline: none;
    border-color: var(--gb-primary, #861b24);
    box-shadow: 0 0 0 3px rgba(134, 27, 36, 0.08);
    background: #ffffff;
}

textarea {
    min-height: 130px;
    resize: vertical;
}

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #111827;
        }

        .required {
            color: #dc2626;
        }

        .error {
            margin-top: 5px;
            color: #dc2626;
            font-size: 14px;
        }
.rating-group {
    display: flex;
    gap: 5px;
    align-items: center;
    padding: 5px 0;
}

.rating-star {
    margin: 0;
    cursor: pointer;
}

.rating-star input {
    display: none;
}

.rating-star span {
    display: inline-block;
    font-size: 38px;
    line-height: 1;
    color: #d6d3d1;
    cursor: pointer;
    transition: color 0.18s ease, transform 0.18s ease;
}

.rating-star:hover span {
    color: #f59e0b;
    transform: scale(1.08);
}

/* Bintang dipilih */
.rating-group:has(.rating-star:nth-child(1) input:checked)
    .rating-star:nth-child(-n+1) span,
.rating-group:has(.rating-star:nth-child(2) input:checked)
    .rating-star:nth-child(-n+2) span,
.rating-group:has(.rating-star:nth-child(3) input:checked)
    .rating-star:nth-child(-n+3) span,
.rating-group:has(.rating-star:nth-child(4) input:checked)
    .rating-star:nth-child(-n+4) span,
.rating-group:has(.rating-star:nth-child(5) input:checked)
    .rating-star:nth-child(-n+5) span {
    color: #f59e0b;
}
4. Save dan ref
        .button-area {
            margin-top: 25px;
        }

       .submit-button {
    width: 100%;
    padding: 14px 20px;
    background: var(--gb-primary, #861b24);
    color: #ffffff;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 800;
    letter-spacing: 0.2px;
    cursor: pointer;
    box-shadow: 0 6px 16px rgba(134, 27, 36, 0.18);
    transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
}

.submit-button:hover {
    background: var(--gb-primary-dark, #6f151d);
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(134, 27, 36, 0.24);
}

.submit-button:active {
    transform: translateY(0);
        .note {
            margin-top: 15px;
            color: #6b7280;
            font-size: 13px;
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/guestbook-themes.css') }}">
</head>

<body class="guestbook-theme theme-{{ $event->theme ?? 'melaka-classic' }}">

<header class="header">

    <img
        src="{{ asset('images/bg-terbaru.png') }}"
        alt="MELAKA DIGITAL GUESTBOOK"
        class="header-image"
    >

</header>


<main class="container">

    {{-- Event --}}
    <div class="event-card">

        <div class="event-name">
            {{ $event->name }}
        </div>

        <div class="event-info">

            Tarikh:
            {{ $event->event_date->format('d/m/Y') }}

            @if ($event->location)
                <br>
                Lokasi:
                {{ $event->location }}
            @endif

        </div>

    </div>


    {{-- Form --}}
    <div class="form-card">

        <h2 style="margin-top: 0;">
           Daftar Pelawat & Komen
        </h2>

        <p style="color:#6b7280;">
            Sila lengkapkan maklumat anda dan tinggalkan komen
            mengenai event ini.
        </p>


        <form
            method="POST"
            action="{{ route('guestbook.register.store', $event) }}">

            @csrf


            {{-- Nama --}}
            <div class="form-group">

                <label for="name">
                    Nama <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    placeholder="Nama penuh">

                @error('name')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Organisasi --}}
            <div class="form-group">

                <label for="organization">
                    Organisasi / Jabatan
                </label>

                <input
                    type="text"
                    id="organization"
                    name="organization"
                    value="{{ old('organization') }}"
                    placeholder="Nama organisasi atau jabatan">

                @error('organization')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Telefon --}}
            <div class="form-group">

                <label for="phone">
                    No. Telefon
                </label>

                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="Contoh: 0123456789">

                @error('phone')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Email --}}
            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="nama@example.com">

                @error('email')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

{{-- Tujuan Kunjungan --}}
{{-- Disabled: tidak dipaparkan kepada pengunjung --}}

{{-- Rating --}}
<div class="form-group">

    <label>
        Penilaian Anda
    </label>

    <div class="rating-group">

        @for ($i = 1; $i <= 5; $i++)

            <label class="rating-star">

                <input
                    type="radio"
                    name="rating"
                    value="{{ $i }}"
                    {{ old('rating') == $i ? 'checked' : '' }}>

                <span>★</span>

            </label>

        @endfor

    </div>

    @error('rating')
        <div class="error">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Komen --}}
<div class="form-group">

    <label for="comment">
        Komen
    </label>

    <textarea
        id="comment"
        name="comment"
        placeholder="Tulis komen atau ucapan anda mengenai event ini...">{{ old('comment') }}</textarea>

    @error('comment')
        <div class="error">
            {{ $message }}
        </div>
    @enderror

</div>


<div class="button-area">

                <button
                    type="submit"
                    class="submit-button">

                    HANTAR PENDAFTARAN

                </button>

            </div>

            <div class="note">
                Maklumat anda akan direkodkan sebagai pengunjung
                bagi event ini.
            </div>

        </form>

    </div>

</main>

</body>

</html>