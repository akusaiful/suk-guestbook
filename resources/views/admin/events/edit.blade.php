<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Event - MELAKA DIGITAL GUESTBOOK</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }

        .header {
            background: #ffffff;
            border-bottom: 1px solid #d1d5db;
            padding: 20px 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 6px 0 0;
            color: #6b7280;
            font-size: 14px;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 30px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #9ca3af;
            border-radius: 8px;
            font-size: 16px;
            background: #ffffff;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        textarea:focus {
            outline: none;
            border-color: #111827;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
        }

        .checkbox-group input {
            width: 18px;
            height: 18px;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            border-top: 1px solid #e5e7eb;
            padding-top: 22px;
        }

        .btn {
            display: inline-block;
            padding: 12px 22px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
        }

        .btn-cancel {
            background: #ffffff;
            color: #111827;
            border: 1px solid #9ca3af;
        }

        .btn-save {
            background: #111827;
            color: #ffffff;
        }

        .btn-save:hover {
            background: #000000;
        }
    </style>
</head>

<body>

<div class="header">

    <h1>
        MELAKA DIGITAL GUESTBOOK
    </h1>

    <p>
        Edit Event
    </p>

</div>

<div class="container">

    <div class="card">

        <form
            method="POST"
            action="{{ route('admin.events.update', $event) }}">

            @csrf
            @method('PUT')

            {{-- Nama Event --}}
            <div class="form-group">

                <label for="name">
                    Nama Event
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $event->name) }}"
                    required>

                @error('name')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- Tarikh --}}
            <div class="form-group">

                <label for="event_date">
                    Tarikh Event
                </label>

                <input
                    type="date"
                    id="event_date"
                    name="event_date"
                    value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}"
                    required>

                @error('event_date')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- Lokasi --}}
            <div class="form-group">

                <label for="location">
                    Lokasi
                </label>

                <input
                    type="text"
                    id="location"
                    name="location"
                    value="{{ old('location', $event->location) }}"
                    placeholder="Contoh: Seri Negeri Melaka">

                @error('location')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- Keterangan --}}
            <div class="form-group">

                <label for="description">
                    Keterangan
                </label>

                <textarea
                    id="description"
                    name="description"
                    placeholder="Masukkan keterangan event">{{ old('description', $event->description) }}</textarea>

                @error('description')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- Status --}}
            <div class="checkbox-group">

                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $event->is_active) ? 'checked' : '' }}>

                <label
                    for="is_active"
                    style="margin: 0;">
                    Event Aktif
                </label>

            </div>

            {{-- Actions --}}
            <div class="actions">

                <a
                    href="{{ route('admin.events.index') }}"
                    class="btn btn-cancel">
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-save">
                    KEMASKINI EVENT
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>