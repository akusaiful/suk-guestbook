<!DOCTYPE html>

<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Tambah Penandatangan - MELAKA DIGITAL GUESTBOOK
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


        .header {

            background: #ffffff;

            border-bottom:
                1px solid #d1d5db;

            padding:
                20px 30px;
        }


        .header h1 {

            margin: 0;

            font-size: 24px;
        }


        .header p {

            margin:
                6px 0 0;

            color: #6b7280;

            font-size: 14px;
        }


        .container {

            max-width:
                900px;

            margin:
                40px auto;

            padding:
                0 20px;
        }


        .card {

            background:
                #ffffff;

            border:
                1px solid #d1d5db;

            border-radius:
                12px;

            padding:
                30px;
        }


        .form-group {

            margin-bottom:
                22px;
        }


        label {

            display:
                block;

            font-weight:
                600;

            margin-bottom:
                8px;
        }


        input[type="text"],
        input[type="email"] {

            width:
                100%;

            padding:
                12px 14px;

            border:
                1px solid #9ca3af;

            border-radius:
                8px;

            font-size:
                16px;

            background:
                #ffffff;
        }


        input:focus {

            outline:
                none;

            border-color:
                #111827;
        }


        .checkbox-group {

            display:
                flex;

            align-items:
                center;

            gap:
                8px;

            margin-bottom:
                25px;
        }


        .checkbox-group input {

            width:
                18px;

            height:
                18px;
        }


        .error {

            color:
                #dc2626;

            font-size:
                14px;

            margin-top:
                5px;
        }


        .actions {

            display:
                flex;

            justify-content:
                flex-end;

            gap:
                12px;

            border-top:
                1px solid #e5e7eb;

            padding-top:
                22px;
        }


        .btn {

            display:
                inline-block;

            padding:
                12px 22px;

            border-radius:
                8px;

            font-size:
                15px;

            font-weight:
                600;

            text-decoration:
                none;

            cursor:
                pointer;

            border:
                none;
        }


        .btn-cancel {

            background:
                #ffffff;

            color:
                #111827;

            border:
                1px solid #9ca3af;
        }


        .btn-save {

            background:
                #111827;

            color:
                #ffffff;
        }


        .btn-save:hover {

            background:
                #000000;
        }


        @media (max-width: 600px) {

            .header {

                padding:
                    18px 20px;
            }


            .header h1 {

                font-size:
                    21px;
            }


            .container {

                margin:
                    25px auto;

                padding:
                    0 15px;
            }


            .card {

                padding:
                    22px 18px;
            }


            .actions {

                flex-direction:
                    column;
            }


            .btn {

                width:
                    100%;

                text-align:
                    center;
            }

        }

    </style>

</head>


<body>


<div class="header">

    <h1>
        MELAKA DIGITAL GUESTBOOK
    </h1>

    <p>
        Tambah Penandatangan
    </p>

</div>


<div class="container">

    <div class="card">


        <form
            method="POST"
            action="{{ route('admin.signers.store') }}"
        >

            @csrf


            {{-- =====================================================
                 NAMA
            ====================================================== --}}

            <div class="form-group">

                <label for="name">
                    Nama
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    placeholder="Nama penuh"
                >

                @error('name')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =====================================================
                 JAWATAN
            ====================================================== --}}

            <div class="form-group">

                <label for="position">
                    Jawatan
                </label>

                <input
                    type="text"
                    id="position"
                    name="position"
                    value="{{ old('position') }}"
                    placeholder="Contoh: Yang Berhormat / Pengarah / Pegawai"
                >

                @error('position')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =====================================================
                 ORGANISASI
            ====================================================== --}}

            <div class="form-group">

                <label for="organization">
                    Organisasi / Jabatan
                </label>

                <input
                    type="text"
                    id="organization"
                    name="organization"
                    value="{{ old('organization') }}"
                    placeholder="Nama organisasi atau jabatan"
                >

                @error('organization')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =====================================================
                 TELEFON
            ====================================================== --}}

            <div class="form-group">

                <label for="phone">
                    No. Telefon
                </label>

                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="Contoh: 0123456789"
                >

                @error('phone')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =====================================================
                 EMAIL
            ====================================================== --}}

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="nama@contoh.gov.my"
                >

                @error('email')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =====================================================
                 STATUS
            ====================================================== --}}

            <div class="checkbox-group">

                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    {{ old('is_active', true) ? 'checked' : '' }}
                >

                <label
                    for="is_active"
                    style="margin: 0;"
                >
                    Penandatangan Aktif
                </label>

            </div>


            {{-- =====================================================
                 ACTIONS
            ====================================================== --}}

            <div class="actions">

                <a
                    href="{{ route('admin.signers.index') }}"
                    class="btn btn-cancel"
                >
                    Batal
                </a>


                <button
                    type="submit"
                    class="btn btn-save"
                >
                    SIMPAN PENANDATANGAN
                </button>

            </div>


        </form>

    </div>

</div>


</body>

</html>