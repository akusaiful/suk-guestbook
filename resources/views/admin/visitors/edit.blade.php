<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengunjung - MELAKA DIGITAL GUESTBOOK</title>
    @vite(['resources/css/app.css'])

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

        .page {
            width: 100%;
            max-width: 900px;
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

        .event-info {
            margin-bottom: 25px;
            padding: 18px;
            background: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 12px;
        }

        .event-info-title {
            margin-bottom: 12px;
            font-size: 14px;
            font-weight: 700;
            color: #374151;
        }

        .event-info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px 20px;
        }

        .event-item-label {
            display: block;
            margin-bottom: 4px;
            font-size: 12px;
            color: #6b7280;
        }

        .event-item-value {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 700;
            color: #374151;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            min-height: 44px;
            padding: 10px 12px;
            border: 1px solid #9ca3af;
            border-radius: 8px;
            background: #ffffff;
            color: #111827;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #861b24;
            box-shadow: 0 0 0 3px rgba(134, 27, 36, 0.12);
        }

        .readonly-box {
            min-height: 44px;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #f9fafb;
            color: #6b7280;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .error-box {
            margin-bottom: 20px;
            padding: 14px 16px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            background: #fef2f2;
            color: #991b1b;
            font-size: 14px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .bottom-actions {
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            flex-wrap: wrap;
        }

        .button {
            min-height: 44px;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        .cancel-button {
            border: 1px solid #9ca3af;
            background: #ffffff;
            color: #374151;
        }

        .cancel-button:hover {
            background: #f3f4f6;
        }

        .save-button {
            border: 1px solid #861b24;
            background: #861b24;
            color: #ffffff;
        }

        .save-button:hover {
            background: #6f151d;
            border-color: #6f151d;
        }

        .delete-form {
            margin: 0;
        }

        .delete-button {
            border: 1px solid #b91c1c;
            background: #b91c1c;
            color: #ffffff;
        }

        .delete-button:hover {
            background: #991b1b;
            border-color: #991b1b;
        }

        @media (max-width: 700px) {
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

            .event-info-grid,
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .bottom-actions {
                flex-direction: column;
            }

            .button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
<div class="page">
    <div class="card">

        <div class="header">
            <div class="title">✏️ Edit Pengunjung</div>
            <div class="subtitle">
                MELAKA DIGITAL GUESTBOOK — Kemaskini Rekod Pengunjung
            </div>
        </div>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="event-info">
            <div class="event-info-title">Maklumat Event</div>

            <div class="event-info-grid">
                <div>
                    <span class="event-item-label">Event ID</span>
                    <div class="event-item-value">
                        #{{ $visitor->event_id ?? '-' }}
                    </div>
                </div>

                <div>
                    <span class="event-item-label">Event</span>
                    <div class="event-item-value">
                        {{ $visitor->event?->name ?? '-' }}
                    </div>
                </div>

                <div>
                    <span class="event-item-label">Tarikh / Masa Rekod</span>
                    <div class="event-item-value">
                        {{ $visitor->created_at?->format('d/m/Y H:i') ?? '-' }}
                    </div>
                </div>

                <div>
                    <span class="event-item-label">No. Kad Pengenalan</span>
                    <div class="readonly-box">
                        {{ $visitor->ic_number ?: '-' }}
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.visitors.update', $visitor) }}">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group full">
                    <label for="name">Nama *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $visitor->name) }}"
                        maxlength="255"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="organization">Organisasi / Jabatan</label>
                    <input
                        type="text"
                        id="organization"
                        name="organization"
                        value="{{ old('organization', $visitor->organization) }}"
                        maxlength="255"
                    >
                </div>

                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $visitor->phone) }}"
                        maxlength="50"
                    >
                </div>

                <div class="form-group full">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $visitor->email) }}"
                        maxlength="255"
                    >
                </div>

                <div class="form-group full">
                    <label for="is_active">Status Rekod</label>
                    <select id="is_active" name="is_active" required>
                        <option value="1" {{ old('is_active', $visitor->is_active) ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="0" {{ old('is_active', $visitor->is_active) ? '' : 'selected' }}>
                            Tidak Aktif
                        </option>
                    </select>
                </div>
            </div>

            <div class="bottom-actions">
                <a
                    href="{{ route('admin.visitors.index') }}"
                    class="button cancel-button"
                >
                    ← Batal
                </a>

                <form
                    method="POST"
                    action="{{ route('admin.visitors.destroy', $visitor) }}"
                    class="delete-form"
                    onsubmit="return confirm('Padam rekod pengunjung ini? Tindakan ini tidak boleh dibatalkan.');"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="button delete-button"
                    >
                        🗑️ Delete
                    </button>
                </form>

                <button
                    type="submit"
                    class="button save-button"
                >
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>
</body>
</html>
