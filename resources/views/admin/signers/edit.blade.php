<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Edit Penandatangan - MELAKA DIGITAL GUESTBOOK
    </title>

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
        input[type="email"] {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #9ca3af;
            border-radius: 8px;
            font-size: 16px;
            background: #ffffff;
        }

        input:focus {
            outline: none;
            border-color: #111827;
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
        Edit Penandatangan
    </p>

</div>

<div class="container">

    <div class="card">

        <form
            method="POST"
            action="{{ route('admin.signers.update', $signer) }}">

            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="form-group">

                <label for="name">
                    Nama
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $signer->name) }}"
                    required>

                @error('name')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- Jawatan --}}
            <div class="form-group">

                <label for="position">
                    Jawatan
                </label>

                <input
                    type="text"
                    id="position"
                    name="position"
                    value="{{ old('position', $signer->position) }}">

                @error('position')
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
                    value="{{ old('organization', $signer->organization) }}">

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
                    value="{{ old('phone', $signer->phone) }}">

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
                    value="{{ old('email', $signer->email) }}">

                @error('email')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- Photo --}}
            <div class="form-group">

                <label for="photo">
                    Gambar
                </label>

                <input
                    type="text"
                    id="photo"
                    name="photo"
                    value="{{ old('photo', $signer->photo) }}"
                    placeholder="Contoh: signers/ahmad.jpg">

                @error('photo')
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
                    {{ old('is_active', $signer->is_active) ? 'checked' : '' }}>

                <label
                    for="is_active"
                    style="margin: 0;">
                    Penandatangan Aktif
                </label>

            </div>

            {{-- Actions --}}
            <div class="actions">

                <a
                    href="{{ route('admin.signers.index') }}"
                    class="btn btn-cancel">
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-save">
                    KEMASKINI PENANDATANGAN
                </button>

            </div>

        </form>

    </div>

</div>

</body>

</html>