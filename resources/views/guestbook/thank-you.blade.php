<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Terima Kasih - MELAKA DIGITAL GUESTBOOK
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

    .page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
    }

    .card {
        width: 100%;
        max-width: 600px;
        background: rgba(255, 250, 242, 0.96);
        border: 1px solid var(--gb-border, #dbc7ae);
        border-radius: 18px;
        padding: 42px;
        text-align: center;
        box-shadow: 0 12px 35px rgba(61, 37, 27, 0.10);
    }

    .icon {
        width: 72px;
        height: 72px;
        margin: 0 auto 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e7f5ec;
        font-size: 36px;
    }

    h1 {
        margin: 0 0 10px;
        font-size: 30px;
        font-weight: 800;
        color: var(--gb-primary, #861b24);
    }

    .event {
        margin-top: 20px;
        font-size: 18px;
        font-weight: 800;
        color: #3d251b;
    }

    .message {
        margin-top: 14px;
        color: #77665b;
        line-height: 1.7;
        font-size: 14px;
    }

    .success-note {
        margin-top: 20px;
        padding: 13px 16px;
        border-radius: 10px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #047857;
        font-size: 13px;
        font-weight: 700;
    }

    .button {
        display: inline-block;
        margin-top: 26px;
        padding: 13px 22px;
        border-radius: 9px;
        background: var(--gb-primary, #861b24);
        color: #ffffff;
        text-decoration: none;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .button:hover {
        background: var(--gb-primary-dark, #6f151d);
        transform: translateY(-1px);
    }

    @media (max-width: 600px) {
        .page {
            padding: 20px;
        }

        .card {
            padding: 30px 22px;
        }

        h1 {
            font-size: 25px;
        }

        .event {
            font-size: 16px;
        }
    }
</style>
</head>

<body>

<div class="page">

    <div class="card">

        <div class="icon">
            ✅
        </div>

        <h1>
            Terima Kasih!
        </h1>

        <div class="event">
            {{ $event->name }}
        </div>

        <div class="message">
    Pendaftaran anda telah berjaya direkodkan.
    <br>
    Komen anda juga telah berjaya dihantar
    ke Melaka Digital Guestbook.
</div>

<div class="success-note">
    ✓ Terima kasih kerana berkunjung dan berkongsi bersama kami.
</div>

        <a
            href="{{ route('guestbook.register', $event) }}"
            class="button">

            Kembali ke Pendaftaran

        </a>

    </div>

</div>

</body>

</html>