<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login - Melaka Digital Guestbook</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: #3d251b;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(195, 154, 82, 0.16),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 20%,
                    rgba(134, 27, 36, 0.10),
                    transparent 32%
                ),
                linear-gradient(
                    180deg,
                    #f7f1e8 0%,
                    #fbf7f1 100%
                );

            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 430px;
        }

        .login-card {
            position: relative;
            overflow: hidden;

            background: rgba(255, 250, 242, 0.96);
            border: 1px solid #dbc7ae;
            border-radius: 22px;

            padding: 38px 34px;

            box-shadow:
                0 20px 55px rgba(61, 37, 27, 0.15);
        }

        .login-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;

            height: 6px;

            background: linear-gradient(
                90deg,
                #861b24,
                #c39a52,
                #861b24
            );
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-icon {
            width: 72px;
            height: 72px;

            margin: 0 auto 18px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #861b24;
            color: #fffaf2;

            font-size: 30px;

            box-shadow:
                0 8px 20px rgba(134, 27, 36, 0.25);
        }

        .brand h1 {
            margin: 0;

            font-size: 23px;
            font-weight: 800;
            letter-spacing: 0.4px;

            color: #861b24;
        }

        .brand p {
            margin: 8px 0 0;

            font-size: 14px;
            color: #77665b;
        }

        .admin-label {
            display: inline-block;

            margin-top: 12px;
            padding: 5px 12px;

            border-radius: 999px;

            background: #f1e4cf;
            color: #861b24;

            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

            font-size: 14px;
            font-weight: 700;

            color: #3d251b;
        }

        .form-input {
            width: 100%;

            padding: 13px 14px;

            border: 1px solid #dbc7ae;
            border-radius: 10px;

            background: #fffdf9;

            font-size: 15px;
            color: #3d251b;

            outline: none;

            transition:
                border-color 0.2s,
                box-shadow 0.2s;
        }

        .form-input:focus {
            border-color: #c39a52;

            box-shadow:
                0 0 0 3px rgba(195, 154, 82, 0.15);
        }

        .error-message {
            margin-top: 7px;

            font-size: 13px;
            color: #b42318;
        }

        .login-button {
            width: 100%;

            border: none;
            border-radius: 10px;

            padding: 14px 18px;

            background: #861b24;
            color: white;

            font-size: 15px;
            font-weight: 700;

            cursor: pointer;

            transition:
                transform 0.15s,
                background 0.2s,
                box-shadow 0.2s;
        }

        .login-button:hover {
            background: #6f151d;

            transform: translateY(-1px);

            box-shadow:
                0 8px 18px rgba(134, 27, 36, 0.22);
        }

        .footer {
            text-align: center;

            margin-top: 24px;

            font-size: 12px;
            color: #77665b;
        }

        @media (max-width: 480px) {
            body {
                padding: 16px;
            }

            .login-card {
                padding: 32px 24px;
                border-radius: 18px;
            }

            .brand h1 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <div class="brand">

            <div class="brand-icon">
                🔐
            </div>

            <h1>
                MELAKA DIGITAL GUESTBOOK
            </h1>

            <p>
                Smart Visitor Registration & Digital Signature
            </p>

            <span class="admin-label">
                ADMINISTRATOR
            </span>

        </div>

        <form method="POST" action="{{ route('admin.login.submit') }}">

            @csrf

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    class="form-input"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email admin"
                    required
                    autofocus
                >

                @error('email')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="form-group">

                <label for="password">
                    Kata Laluan
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-input"
                    placeholder="Masukkan kata laluan"
                    required
                >

                @error('password')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <button
                type="submit"
                class="login-button"
            >
                LOG MASUK ADMIN
            </button>

        </form>

        <div class="footer">
            © {{ date('Y') }} Kerajaan Negeri Melaka
        </div>

    </div>

</div>

</body>
</html>