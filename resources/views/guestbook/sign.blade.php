<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    >

    <title>
        Tandatangan - {{ $event->name }}
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <link
        rel="stylesheet"
        href="{{ asset('css/guestbook-themes.css') }}"
    >

    <style>

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            min-width: 100%;
            min-height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            overscroll-behavior: none;
            overscroll-behavior-y: none;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: transparent;
            color: var(--gb-text, #111827);
            -webkit-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
        }

        button {
            font-family: inherit;
        }

        .page {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px 8px;
            touch-action: none;
        }

        .signing-card {
            position: relative;
            width: min(1400px, 100%);
            height: calc(100vh - 10px);
            max-height: calc(100vh - 10px);
            min-height: 0;
            padding: 6px 12px;
            background: rgba(255, 250, 242, 0.97);
            border: 1px solid var(--gb-border, #d1d5db);
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(61, 37, 27, 0.10);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* =========================================================
           HEADER
        ========================================================= */

        .top-header {
            position: relative;
            flex: 0 0 auto;
            width: 100%;
            height: clamp(88px, 15.2vh, 128px);
            display: flex;
            align-items: center;
            justify-content: center;
            /*
             * Transparent supaya hujung gambar boleh fade masuk
             * terus ke background signing-card / theme.
             */
            background: transparent !important;
            border: 0 !important;
        }

        /*
         * HEADER IMAGE
         *
         * Sedikit dibesarkan dan edge dibuat lebih lembut supaya
         * gambar tidak nampak seperti kotak yang ditampal.
         * Bahagian kiri, kanan, atas dan bawah fade masuk ke
         * background putih header.
         */
        .header-image-wrap {
            position: relative;
            width: min(1296px, 93.6vw);
            height: clamp(110px, 17.04vh, 158px);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 28px;
        }

        .header-image {
            position: relative;
            z-index: 1;
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            border-radius: 28px;
            mix-blend-mode: multiply;
            isolation: isolate;

            /*
             * Fade sebenar di SEMUA sisi gambar.
             * Bahagian tengah kekal tajam, manakala kiri/kanan/atas/bawah
             * perlahan-lahan hilang ke transparent.
             */
            -webkit-mask-image: radial-gradient(
                ellipse 82% 76% at 50% 50%,
                #000 36%,
                rgba(0,0,0,.98) 52%,
                rgba(0,0,0,.82) 68%,
                rgba(0,0,0,.46) 82%,
                rgba(0,0,0,.12) 94%,
                transparent 100%
            );
            mask-image: radial-gradient(
                ellipse 82% 76% at 50% 50%,
                #000 36%,
                rgba(0,0,0,.98) 52%,
                rgba(0,0,0,.82) 68%,
                rgba(0,0,0,.46) 82%,
                rgba(0,0,0,.12) 94%,
                transparent 100%
            );
            mask-repeat: no-repeat;
            -webkit-mask-repeat: no-repeat;
            mask-size: 100% 100%;
            -webkit-mask-size: 100% 100%;
        }

        /*
         * Lapisan blend tambahan.
         * Ini menutup edge putih imej secara beransur-ansur supaya
         * kotak putih asal dalam PNG tidak lagi nampak keras.
         */
        .header-image-wrap::after {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 3;
            pointer-events: none;
            border-radius: inherit;
            background:
                radial-gradient(
                    ellipse 76% 70% at 50% 50%,
                    rgba(255,250,242,0) 34%,
                    rgba(255,250,242,.08) 48%,
                    rgba(255,250,242,.28) 64%,
                    rgba(255,250,242,.62) 82%,
                    rgba(255,250,242,.98) 100%
                );
        }

        /* Government Blue — blend ke permukaan putih */
        body.guestbook-theme.theme-government-blue .header-image-wrap::after {
            background:
                radial-gradient(
                    ellipse 74% 68% at 50% 50%,
                    rgba(255,255,255,0) 45%,
                    rgba(255,255,255,.08) 58%,
                    rgba(255,255,255,.28) 72%,
                    rgba(255,255,255,.62) 86%,
                    rgba(255,255,255,.98) 100%
                );
        }

        /* Modern Melaka — blend ke permukaan gelap theme */
        body.guestbook-theme.theme-modern-melaka .header-image-wrap::after {
            background:
                radial-gradient(
                    ellipse 74% 68% at 50% 50%,
                    rgba(38,33,28,0) 45%,
                    rgba(38,33,28,.08) 58%,
                    rgba(38,33,28,.28) 72%,
                    rgba(38,33,28,.62) 86%,
                    rgba(38,33,28,.98) 100%
                );
        }

        .realtime {
            position: absolute;
            right: 3px;
            top: 50%;
            transform: translateY(-50%);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 9px;
            color: #6b7280;
            white-space: nowrap;
        }

        .realtime-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #9ca3af;
            flex-shrink: 0;
        }

        .realtime-dot.connected {
            background: #16a34a;
        }

        .realtime-dot.error {
            background: #dc2626;
        }

        .event-title {
            width: 100%;
            flex: 0 0 auto;
            margin: 0;
            padding: 0 10px;
            text-align: center;
            font-size: clamp(13px, 1.55vw, 22px);
            line-height: 1.15;
            font-weight: 800;
            color: var(--gb-text, #3d251b);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* =========================================================
           WAITING
        ========================================================= */

        .waiting-panel {
            flex: 1 1 auto;
            min-height: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 10px 20px;
            overflow: hidden;
        }

        .waiting-inner {
            max-width: 700px;
        }

        .waiting-icon {
            font-size: clamp(38px, 6vw, 62px);
            line-height: 1;
        }

        .waiting-title {
            margin-top: 10px;
            font-size: clamp(20px, 2.1vw, 30px);
            font-weight: 800;
            color: #111827;
        }

        .waiting-text {
            margin-top: 7px;
            font-size: clamp(11px, 1vw, 14px);
            line-height: 1.45;
            color: #6b7280;
        }

        /* =========================================================
           SIGNING CONTENT
        ========================================================= */

        .sign-content {
            flex: 1 1 auto;
            min-height: 0;
            width: 100%;
            margin-top: 3px;
            display: grid;
            grid-template-rows: auto minmax(0, 1fr);
            gap: 7px;
            overflow: hidden;
        }

        /* =========================================================
           SIGNER INFO
           NAMA -> JAWATAN -> TARIKH & MASA
        ========================================================= */

        .signer-info {
            width: 100%;
            text-align: center;
            overflow: hidden;
            padding-top: 10px;
        }

        .signer-name {
            width: 100%;
            font-size: clamp(19px, 2.8vw, 34px);
            line-height: 1.04;
            font-weight: 800;
            color: #111827;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .signer-position {
            margin-top: 2px;
            font-size: clamp(12.1px, 1.265vw, 17.6px);
            line-height: 1.08;
            font-weight: 600;
            color: #4b5563;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .signer-datetime {
            margin-top: 3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: clamp(22px, 4vw, 48px);
        }

        .datetime-item {
            min-width: 90px;
            text-align: center;
        }

        .datetime-label {
            font-size: 8px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .datetime-value {
            margin-top: 1px;
            font-size: clamp(11px, 1.05vw, 15px);
            line-height: 1.05;
            font-weight: 800;
            color: #111827;
            white-space: nowrap;
        }

        /* =========================================================
           SIGNATURE AREA
        ========================================================= */

        .signature-area {
            position: relative;
            min-height: 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            justify-content: flex-start;
            padding-bottom: clamp(28px, 7vh, 72px);
            overflow: hidden;
        }

        .signature-hint {
            flex: 0 0 auto;
            min-height: 14px;
            margin-bottom: 3px;
            text-align: center;
            font-size: clamp(8px, 0.75vw, 10px);
            font-weight: 600;
            color: #6b7280;
            white-space: nowrap;
        }

        .signature-box {
            position: relative;
            flex: 1 1 auto;
            min-height: 0;
            width: 100%;
            height: auto;
            background: #ffffff;
            border: 2px dashed var(--gb-secondary, #c39a52);
            border-radius: 9px;
            overflow: hidden;
            touch-action: none;
        }

        .signature-pad {
            position: absolute;
            inset: 0;
            display: block;
            width: 100%;
            height: 100%;
            background: #ffffff;
            touch-action: none;
            cursor: crosshair;
        }

        /* =========================================================
           TOP-RIGHT CONTROLS INSIDE SIGNATURE PAD
        ========================================================= */

        .signature-controls {
            position: absolute;
            top: 7px;
            right: 8px;
            z-index: 20;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
            padding: 4px 5px;
            border: 1px solid rgba(209, 213, 219, 0.88);
            border-radius: 7px;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .btn-clear,
        .btn-back {
            min-height: 28px;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 9px;
            font-weight: 800;
            cursor: pointer;
            touch-action: manipulation;
            white-space: nowrap;
        }

        .btn-clear {
            min-width: 64px;
            border: 1px solid var(--gb-primary, #861b24);
            background: #ffffff;
            color: var(--gb-primary, #861b24);
        }

        .btn-clear:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        .signature-countdown {
            min-width: 102px;
            max-width: 190px;
            font-size: 9px;
            font-weight: 700;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #6b7280;
        }

        .signature-countdown.active {
            color: #1d4ed8;
        }

        .signature-countdown.ready {
            color: #15803d;
        }

        .signature-countdown.error {
            color: #b91c1c;
            white-space: normal;
        }

        .btn-back {
            display: none;
            min-width: 82px;
            border: none;
            background: var(--gb-primary, #861b24);
            color: #ffffff;
            box-shadow: 0 2px 7px rgba(0, 0, 0, 0.12);
        }

        .btn-back.visible {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* =========================================================
           PORTRAIT NOTICE
        ========================================================= */

        .rotate-screen {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: none;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 30px;
            background: var(--gb-primary, #861b24);
            color: #ffffff;
        }

        .rotate-inner {
            max-width: 420px;
        }

        .rotate-icon {
            font-size: 58px;
            line-height: 1;
            margin-bottom: 15px;
        }

        .rotate-title {
            font-size: 23px;
            line-height: 1.25;
            font-weight: 800;
        }

        .rotate-text {
            margin-top: 9px;
            font-size: 14px;
            line-height: 1.5;
            opacity: 0.95;
        }

        @media (orientation: portrait) {
            .rotate-screen {
                display: flex;
            }
        }

        @media (orientation: landscape) {
            .rotate-screen {
                display: none !important;
            }
        }

        /* =========================================================
           SMALL LANDSCAPE PHONE
        ========================================================= */

        @media (orientation: landscape) and (max-height: 520px) {

            .page {
                padding: 3px 5px;
            }

            .signing-card {
                height: calc(100vh - 6px);
                max-height: calc(100vh - 6px);
                padding: 4px 7px;
                border-radius: 7px;
            }

            .top-header {
                height: 78px;
            }

            .header-image-wrap {
                width: 444px;
                height: 77px;
                border-radius: 18px;
            }

            .header-image {
                border-radius: 18px;
            }

            .realtime {
                right: 1px;
                font-size: 7px;
            }

            .realtime-dot {
                width: 6px;
                height: 6px;
            }

            .event-title {
                font-size: 12px;
                padding: 0 5px;
            }

            .sign-content {
                margin-top: 1px;
                gap: 3px;
            }

            .signer-name {
                font-size: 18px;
                margin-top: 10px;
            }

            .signer-position {
                font-size: 11px;
            }

            .signer-datetime {
                margin-top: 1px;
                gap: 18px;
            }

            .datetime-label {
                font-size: 7px;
            }

            .datetime-value {
                font-size: 9px;
            }

            .signature-hint {
                min-height: 11px;
                margin-bottom: 2px;
                font-size: 7px;
            }

            .signature-area {
                padding-bottom: 18px;
            }

            .signature-box {
                width: 100%;
                height: auto;
                flex: 1 1 auto;
                border-width: 1px;
                border-radius: 6px;
            }

            .signature-controls {
                top: 4px;
                right: 4px;
                gap: 4px;
                padding: 3px 4px;
                border-radius: 5px;
            }

            .btn-clear,
            .btn-back {
                min-height: 24px;
                padding: 4px 8px;
                font-size: 8px;
            }

            .btn-clear {
                min-width: 56px;
            }

            .signature-countdown {
                min-width: 84px;
                max-width: 145px;
                font-size: 7px;
            }

            .btn-back {
                min-width: 72px;
            }
        }

    </style>


    <style id="guestbook-sign-theme-additions">
        /*
         * 5J.2B — THEME UNTUK TABLET SIGN
         *
         * SUMBER: kod sign-blade-csrf-repaired-complete.blade.php
         *
         * HANYA tambah styling theme.
         * Layout A/B/C, canvas, countdown, CSRF repair,
         * Reverb, auto-save 5 saat dan JavaScript asal TIDAK disentuh.
         *
         * Melaka Classic = kekal menggunakan design asal.
         */

        /* ============================================================
           GOVERNMENT BLUE
           ============================================================ */

        body.guestbook-theme.theme-government-blue {
            --gb-primary: #0b4f8a;
            --gb-secondary: #1976b8;
            --gb-surface: #ffffff;
            --gb-border: #c7d8e8;
            --gb-text: #12304a;
            --gb-muted: #5d7387;

            background:
                radial-gradient(
                    circle at 50% 0%,
                    rgba(191, 219, 254, .48),
                    transparent 42%
                ),
                linear-gradient(
                    180deg,
                    #edf5fd 0%,
                    #f7fbff 58%,
                    #e4eef8 100%
                ) !important;
            color: #12304a !important;
        }

        body.guestbook-theme.theme-government-blue .signing-card {
            background: rgba(255,255,255,.98) !important;
            border-color: #c7d8e8 !important;
            box-shadow:
                0 8px 28px rgba(7, 54, 91, .12),
                inset 0 1px 0 rgba(255,255,255,.98) !important;
        }

        body.guestbook-theme.theme-government-blue .top-header {
            background: transparent !important;
            border-bottom: 0 !important;
            border-radius: 8px 8px 0 0;
        }

        body.guestbook-theme.theme-government-blue .event-title {
            color: #0b4f8a !important;
            background: rgba(255,255,255,.92) !important;
            border-color: #c7d8e8 !important;
            box-shadow: 0 4px 12px rgba(7,54,91,.08) !important;
        }

        body.guestbook-theme.theme-government-blue .signer-info {
            color: #12304a !important;
        }

        body.guestbook-theme.theme-government-blue .signer-name {
            color: #0b4f8a !important;
        }

        body.guestbook-theme.theme-government-blue .signer-position {
            color: #47677f !important;
        }

        body.guestbook-theme.theme-government-blue .datetime-label {
            color: #58758b !important;
        }

        body.guestbook-theme.theme-government-blue .datetime-value {
            color: #0b4f8a !important;
        }

        body.guestbook-theme.theme-government-blue .signature-hint {
            color: #58758b !important;
        }

        body.guestbook-theme.theme-government-blue .signature-box {
            background: #ffffff !important;
            border-color: #6ca7d7 !important;
            box-shadow:
                inset 0 0 0 1px rgba(11,79,138,.05),
                0 8px 20px rgba(7,54,91,.10) !important;
        }

        body.guestbook-theme.theme-government-blue .signature-controls {
            background: rgba(239,247,255,.96) !important;
            border-color: #c7d8e8 !important;
            box-shadow: 0 3px 10px rgba(7,54,91,.12) !important;
        }

        body.guestbook-theme.theme-government-blue .btn-clear {
            border-color: #0b4f8a !important;
            background: #ffffff !important;
            color: #0b4f8a !important;
        }

        body.guestbook-theme.theme-government-blue .btn-clear:hover {
            background: #edf5fd !important;
        }

        body.guestbook-theme.theme-government-blue .signature-countdown.active {
            color: #0b4f8a !important;
        }

        body.guestbook-theme.theme-government-blue .signature-countdown.ready {
            color: #15803d !important;
        }

        body.guestbook-theme.theme-government-blue .btn-back {
            background: #0b4f8a !important;
            color: #ffffff !important;
        }

        body.guestbook-theme.theme-government-blue .waiting-panel {
            background:
                linear-gradient(
                    145deg,
                    #f5faff,
                    #e8f3fc
                ) !important;
            border-color: #c7d8e8 !important;
            box-shadow: 0 12px 28px rgba(7,54,91,.10) !important;
        }

        body.guestbook-theme.theme-government-blue .waiting-title {
            color: #0b4f8a !important;
        }

        body.guestbook-theme.theme-government-blue .waiting-text {
            color: #5d7387 !important;
        }

        body.guestbook-theme.theme-government-blue .waiting-icon {
            filter: drop-shadow(0 3px 5px rgba(7,54,91,.12));
        }

        body.guestbook-theme.theme-government-blue .realtime {
            color: #49677e !important;
        }

        body.guestbook-theme.theme-government-blue .realtime-dot {
            box-shadow: 0 0 0 3px rgba(25,118,184,.12) !important;
        }

        body.guestbook-theme.theme-government-blue .rotate-screen {
            background:
                linear-gradient(
                    180deg,
                    #edf5fd 0%,
                    #dcecf9 100%
                ) !important;
            color: #0b4f8a !important;
        }

        body.guestbook-theme.theme-government-blue .rotate-title {
            color: #0b4f8a !important;
        }

        body.guestbook-theme.theme-government-blue .rotate-text {
            color: #47677f !important;
        }


        /* ============================================================
           MODERN MELAKA
           ============================================================ */

        body.guestbook-theme.theme-modern-melaka {
            --gb-primary: #0f766e;
            --gb-secondary: #d4a72c;
            --gb-surface: #fffdf8;
            --gb-border: #bba873;
            --gb-text: #f7f1e7;
            --gb-muted: #d8cdb9;

            background:
                radial-gradient(
                    circle at 50% 0%,
                    rgba(212,167,44,.10),
                    transparent 40%
                ),
                linear-gradient(
                    180deg,
                    #24211d 0%,
                    #302a24 58%,
                    #1f1c19 100%
                ) !important;
            color: #f7f1e7 !important;
        }

        body.guestbook-theme.theme-modern-melaka .signing-card {
            background:
                linear-gradient(
                    180deg,
                    rgba(53,45,37,.98),
                    rgba(38,33,28,.98)
                ) !important;
            border-color: rgba(212,175,55,.42) !important;
            box-shadow:
                0 10px 30px rgba(0,0,0,.34),
                inset 0 1px 0 rgba(255,255,255,.07) !important;
        }

        body.guestbook-theme.theme-modern-melaka .top-header {
            background: transparent !important;
            border-bottom: 0 !important;
            border-radius: 8px 8px 0 0;
        }

        body.guestbook-theme.theme-modern-melaka .event-title {
            color: #f6d878 !important;
            background:
                linear-gradient(
                    145deg,
                    rgba(28,56,54,.98),
                    rgba(34,69,65,.96)
                ) !important;
            border-color: rgba(212,175,55,.42) !important;
            box-shadow:
                0 4px 14px rgba(0,0,0,.24),
                inset 0 1px 0 rgba(255,255,255,.06) !important;
            text-shadow: 0 2px 5px rgba(0,0,0,.55) !important;
        }

        body.guestbook-theme.theme-modern-melaka .signer-info {
            color: #f7f1e7 !important;
        }

        body.guestbook-theme.theme-modern-melaka .signer-name {
            color: #ffe39a !important;
            text-shadow: 0 2px 5px rgba(0,0,0,.42) !important;
        }

        body.guestbook-theme.theme-modern-melaka .signer-position {
            color: #dfd4c2 !important;
        }

        body.guestbook-theme.theme-modern-melaka .datetime-label {
            color: #cdbf9f !important;
        }

        body.guestbook-theme.theme-modern-melaka .datetime-value {
            color: #f6d878 !important;
            text-shadow: 0 1px 3px rgba(0,0,0,.38) !important;
        }

        body.guestbook-theme.theme-modern-melaka .signature-hint {
            color: #d8cdb9 !important;
        }

        body.guestbook-theme.theme-modern-melaka .signature-box {
            background: #fffdf8 !important;
            border-color: #d4af37 !important;
            box-shadow:
                inset 0 0 0 1px rgba(212,175,55,.09),
                0 10px 24px rgba(0,0,0,.24) !important;
        }

        body.guestbook-theme.theme-modern-melaka .signature-controls {
            background: rgba(38,54,51,.96) !important;
            border-color: rgba(212,175,55,.48) !important;
            box-shadow: 0 4px 14px rgba(0,0,0,.28) !important;
        }

        body.guestbook-theme.theme-modern-melaka .btn-clear {
            border-color: #d4af37 !important;
            background: #fffdf8 !important;
            color: #0f766e !important;
        }

        body.guestbook-theme.theme-modern-melaka .btn-clear:hover {
            background: #f8efd4 !important;
        }

        body.guestbook-theme.theme-modern-melaka .signature-countdown {
            color: #dfd4c2 !important;
        }

        body.guestbook-theme.theme-modern-melaka .signature-countdown.active {
            color: #f6d878 !important;
        }

        body.guestbook-theme.theme-modern-melaka .signature-countdown.ready {
            color: #74d4ae !important;
        }

        body.guestbook-theme.theme-modern-melaka .signature-countdown.error {
            color: #ff9d9d !important;
        }

        body.guestbook-theme.theme-modern-melaka .btn-back {
            background: #0f766e !important;
            color: #ffffff !important;
            border: 1px solid rgba(255,255,255,.12) !important;
        }

        body.guestbook-theme.theme-modern-melaka .waiting-panel {
            background:
                linear-gradient(
                    145deg,
                    rgba(39,69,66,.98),
                    rgba(30,50,48,.98)
                ) !important;
            border-color: rgba(212,175,55,.34) !important;
            box-shadow: 0 14px 30px rgba(0,0,0,.26) !important;
        }

        body.guestbook-theme.theme-modern-melaka .waiting-title {
            color: #f6d878 !important;
            text-shadow: 0 2px 4px rgba(0,0,0,.46) !important;
        }

        body.guestbook-theme.theme-modern-melaka .waiting-text {
            color: #d8cdb9 !important;
        }

        body.guestbook-theme.theme-modern-melaka .waiting-icon {
            filter: drop-shadow(0 4px 6px rgba(0,0,0,.32));
        }

        body.guestbook-theme.theme-modern-melaka .realtime {
            color: #cfc2ad !important;
        }

        body.guestbook-theme.theme-modern-melaka .realtime-dot {
            box-shadow: 0 0 0 3px rgba(212,175,55,.10) !important;
        }

        body.guestbook-theme.theme-modern-melaka .rotate-screen {
            background:
                linear-gradient(
                    180deg,
                    #2c2823 0%,
                    #1f1c19 100%
                ) !important;
            color: #f7f1e7 !important;
        }

        body.guestbook-theme.theme-modern-melaka .rotate-title {
            color: #f6d878 !important;
        }

        body.guestbook-theme.theme-modern-melaka .rotate-text {
            color: #d8cdb9 !important;
        }
    </style>

    <style id="header-final-image-alpha-override">
        /*
         * HEADER GUNA GAMBAR BARU YANG SUDAH ADA TRANSPARENT / FEATHERED EDGE.
         * Jadi browser tidak perlu tambah mask / multiply lagi.
         * Ini mengekalkan warna asal artwork dan membenarkan alpha PNG
         * blend terus dengan background page.
         */
        .top-header {
            background: transparent !important;
            border: 0 !important;
        }

        .header-image-wrap {
            background: transparent !important;
            box-shadow: none !important;
        }

        .header-image-wrap::after {
            display: none !important;
            content: none !important;
        }

        .header-image {
            mix-blend-mode: normal !important;
            isolation: auto !important;
            -webkit-mask-image: none !important;
            mask-image: none !important;
            opacity: 1 !important;
        }
    </style>

</head>


<body
    class="guestbook-theme theme-{{ $event->theme ?? 'melaka-classic' }}"
>

    <div
        id="rotate-screen"
        class="rotate-screen"
    >

        <div class="rotate-inner">

            <div class="rotate-icon">
                ↔️
            </div>

            <div class="rotate-title">
                Sila gunakan paparan LANDSCAPE
            </div>

            <div class="rotate-text">
                Paparan tandatangan MELAKA DIGITAL GUESTBOOK
                direka untuk digunakan secara mendatar.
            </div>

        </div>

    </div>


    <main class="page">

        <section class="signing-card">


            {{-- =====================================================
                 HEADER
            ====================================================== --}}

            <div class="top-header" style="background:transparent !important; border:0 !important;">

                <div class="header-image-wrap">

                    <img
                        src="{{ asset('images/bg-signing-tablet.png') }}"
                        alt="MELAKA DIGITAL GUESTBOOK"
                        class="header-image"
                    >

                </div>


                <div class="realtime">

                    <span
                        id="realtime-dot"
                        class="realtime-dot"
                    ></span>

                    <span id="realtime-text">
                        Menyambung realtime...
                    </span>

                </div>

            </div>


            {{-- =====================================================
                 EVENT TITLE
            ====================================================== --}}

            <div
                class="event-title"
                title="{{ $event->name }}"
            >
                {{ $event->name }}
            </div>


            {{-- =====================================================
                 WAITING
            ====================================================== --}}

            <div
                id="waiting-panel"
                class="waiting-panel"
            >

                <div class="waiting-inner">

                    <div class="waiting-icon">
                        ✍️
                    </div>

                    <div class="waiting-title">
                        Menunggu Permintaan Tandatangan
                    </div>

                    <div class="waiting-text">
                        Sila tunggu sehingga Admin memilih
                        individu untuk membuat tandatangan.
                    </div>

                </div>

            </div>


            {{-- =====================================================
                 SIGNING
            ====================================================== --}}

            <div
                id="sign-content"
                class="sign-content"
                style="display: none;"
            >


                {{-- =================================================
                     NAMA / JAWATAN / TARIKH / MASA
                ================================================== --}}

                <div class="signer-info">

                    <div
                        id="signer-name"
                        class="signer-name"
                    >
                        -
                    </div>

                    <div
                        id="signer-position"
                        class="signer-position"
                    >
                        -
                    </div>

                    <div class="signer-datetime">

                        <div class="datetime-item">

                            <div class="datetime-label">
                                Tarikh
                            </div>

                            <div
                                id="signature-date"
                                class="datetime-value"
                            >
                                -
                            </div>

                        </div>


                        <div class="datetime-item">

                            <div class="datetime-label">
                                Masa
                            </div>

                            <div
                                id="signature-time"
                                class="datetime-value"
                            >
                                -
                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     SIGNATURE AREA
                ================================================== --}}

                <div class="signature-area">

                    <div class="signature-hint">
                        Sila tandatangan menggunakan jari atau stylus
                    </div>


                    <div class="signature-box">


                        {{-- =================================================
                             KAWALAN DALAM PENJURU KANAN ATAS
                        ================================================== --}}

                        <div
                            class="signature-controls"
                            id="signature-controls"
                        >

                            <button
                                type="button"
                                id="clear-signature"
                                class="btn-clear"
                            >
                                CLEAR
                            </button>


                            <div
                                id="signature-countdown"
                                class="signature-countdown"
                                aria-live="polite"
                            ></div>


                            <button
                                type="button"
                                id="back-to-waiting"
                                class="btn-back"
                            >
                                ← KEMBALI
                            </button>

                        </div>


                        <canvas
                            id="signature-pad"
                            class="signature-pad"
                            aria-label="Ruang tandatangan digital"
                        ></canvas>


                    </div>

                </div>


            </div>


        </section>

    </main>


    <script type="module">

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                /* ==================================================
                   EVENT
                ================================================== */

                const eventId =
                    {{ $event->id }};

                const channelName =
                    `signing.event.${eventId}`;


                /* ==================================================
                   ELEMENTS
                ================================================== */

                const waitingPanel =
                    document.getElementById(
                        'waiting-panel'
                    );

                const signContent =
                    document.getElementById(
                        'sign-content'
                    );

                const realtimeDot =
                    document.getElementById(
                        'realtime-dot'
                    );

                const realtimeText =
                    document.getElementById(
                        'realtime-text'
                    );

                const signerName =
                    document.getElementById(
                        'signer-name'
                    );

                const signerPosition =
                    document.getElementById(
                        'signer-position'
                    );

                const signatureDate =
                    document.getElementById(
                        'signature-date'
                    );

                const signatureTime =
                    document.getElementById(
                        'signature-time'
                    );

                const clearSignatureButton =
                    document.getElementById(
                        'clear-signature'
                    );

                const signatureCountdown =
                    document.getElementById(
                        'signature-countdown'
                    );

                const backButton =
                    document.getElementById(
                        'back-to-waiting'
                    );

                const signatureCanvas =
                    document.getElementById(
                        'signature-pad'
                    );


                /* ==================================================
                   SIGNATURE PAD
                ================================================== */

                const SignaturePad =
                    window.SignaturePad;

                let signaturePad =
                    null;


                /* ==================================================
                   SESSION
                ================================================== */

                let currentSessionId =
                    null;

                let signatureSaved =
                    false;


                /* ==================================================
                   COUNTDOWN
                ================================================== */

                let saveCountdownTimer =
                    null;

                let saveCountdownSeconds =
                    0;


                /* ==================================================
                   REALTIME
                ================================================== */

                let realtimeInitialized =
                    false;

                let realtimeRetryTimer =
                    null;


                /* ==================================================
                   REALTIME STATUS
                ================================================== */

                function setRealtimeStatus(
                    connected,
                    message
                ) {

                    if (
                        realtimeDot
                    ) {

                        realtimeDot.classList.toggle(
                            'connected',
                            connected
                        );

                        realtimeDot.classList.toggle(
                            'error',
                            !connected
                        );

                    }

                    if (
                        realtimeText
                    ) {

                        realtimeText.textContent =
                            message;

                    }

                }


                /* ==================================================
                   DATE
                ================================================== */

                function formatDate(
                    date
                ) {

                    return new Intl.DateTimeFormat(
                        'ms-MY',
                        {
                            day:
                                '2-digit',

                            month:
                                '2-digit',

                            year:
                                'numeric'
                        }
                    ).format(
                        date
                    );

                }


                /* ==================================================
                   TIME
                ================================================== */

                function formatTime(
                    date
                ) {

                    return new Intl.DateTimeFormat(
                        'ms-MY',
                        {
                            hour:
                                '2-digit',

                            minute:
                                '2-digit',

                            second:
                                '2-digit',

                            hour12:
                                false
                        }
                    ).format(
                        date
                    );

                }


                /* ==================================================
                   LIVE DATE/TIME
                ================================================== */

                function updateDateTime() {

                    if (
                        signatureSaved
                    ) {

                        return;

                    }

                    const now =
                        new Date();

                    if (
                        signatureDate
                    ) {

                        signatureDate.textContent =
                            formatDate(
                                now
                            );

                    }

                    if (
                        signatureTime
                    ) {

                        signatureTime.textContent =
                            formatTime(
                                now
                            );

                    }

                }


                setInterval(
                    updateDateTime,
                    1000
                );

                updateDateTime();


                /* ==================================================
                   INITIALIZE SIGNATURE PAD
                ================================================== */

                function initializeSignaturePad() {

                    if (
                        !signatureCanvas
                    ) {

                        console.warn(
                            'Canvas signature-pad tidak dijumpai.'
                        );

                        return false;

                    }

                    if (
                        !SignaturePad
                    ) {

                        console.error(
                            'SignaturePad tidak tersedia.'
                        );

                        showSignatureError(
                            'Signature Pad tidak tersedia.'
                        );

                        return false;

                    }

                    if (
                        signaturePad &&
                        typeof signaturePad.off ===
                            'function'
                    ) {

                        signaturePad.off();

                    }

                    const rect =
                        signatureCanvas.getBoundingClientRect();

                    if (
                        rect.width <= 0 ||
                        rect.height <= 0
                    ) {

                        return false;

                    }

                    const ratio =
                        Math.max(
                            window.devicePixelRatio ||
                                1,
                            1
                        );

                    signatureCanvas.width =
                        Math.round(
                            rect.width *
                            ratio
                        );

                    signatureCanvas.height =
                        Math.round(
                            rect.height *
                            ratio
                        );

                    const context =
                        signatureCanvas.getContext(
                            '2d'
                        );

                    context.setTransform(
                        1,
                        0,
                        0,
                        1,
                        0,
                        0
                    );

                    context.scale(
                        ratio,
                        ratio
                    );

                    signaturePad =
                        new SignaturePad(
                            signatureCanvas,
                            {
                                backgroundColor:
                                    'rgb(255,255,255)',

                                penColor:
                                    'rgb(17,24,39)',

                                minWidth:
                                    1,

                                maxWidth:
                                    2.5
                            }
                        );


                    signaturePad.addEventListener(
                        'beginStroke',
                        function () {

                            if (
                                signatureSaved
                            ) {

                                return;

                            }

                            stopAutoSaveCountdown();

                        }
                    );


                    signaturePad.addEventListener(
                        'endStroke',
                        function () {

                            if (
                                signatureSaved
                            ) {

                                return;

                            }

                            if (
                                signaturePad &&
                                !signaturePad.isEmpty()
                            ) {

                                startAutoSaveCountdown();

                            }

                        }
                    );


                    return true;

                }


                /* ==================================================
                   STOP COUNTDOWN
                ================================================== */

                function stopAutoSaveCountdown() {

                    if (
                        saveCountdownTimer
                    ) {

                        clearInterval(
                            saveCountdownTimer
                        );

                        saveCountdownTimer =
                            null;

                    }

                    saveCountdownSeconds =
                        0;

                    if (
                        signatureCountdown
                    ) {

                        signatureCountdown.textContent =
                            '';

                        signatureCountdown.classList.remove(
                            'active',
                            'ready',
                            'error'
                        );

                    }

                }


                /* ==================================================
                   COUNTDOWN TEXT
                ================================================== */

                function updateCountdownText() {

                    if (
                        !signatureCountdown
                    ) {

                        return;

                    }

                    if (
                        saveCountdownSeconds > 0
                    ) {

                        signatureCountdown.textContent =
                            'Auto simpan dalam ' +
                            saveCountdownSeconds +
                            ' saat...';

                    }

                }


                /* ==================================================
                   START COUNTDOWN
                ================================================== */

                function startAutoSaveCountdown() {

                    stopAutoSaveCountdown();

                    if (
                        !signaturePad ||
                        signaturePad.isEmpty() ||
                        !currentSessionId ||
                        signatureSaved
                    ) {

                        return;

                    }

                    saveCountdownSeconds =
                        5;

                    if (
                        signatureCountdown
                    ) {

                        signatureCountdown.classList.remove(
                            'ready',
                            'error'
                        );

                        signatureCountdown.classList.add(
                            'active'
                        );

                    }

                    updateCountdownText();


                    saveCountdownTimer =
                        setInterval(
                            function () {

                                saveCountdownSeconds--;

                                updateCountdownText();

                                if (
                                    saveCountdownSeconds <=
                                    0
                                ) {

                                    stopAutoSaveCountdown();

                                    saveSignatureAutomatically();

                                }

                            },
                            1000
                        );

                }


                /* ==================================================
                   CLEAR
                ================================================== */

                function clearSignature() {

                    if (
                        signatureSaved
                    ) {

                        return;

                    }

                    stopAutoSaveCountdown();


                    if (
                        !signaturePad
                    ) {

                        return;

                    }


                    signaturePad.clear();


                    if (
                        signatureCountdown
                    ) {

                        signatureCountdown.textContent =
                            '';

                        signatureCountdown.classList.remove(
                            'active',
                            'ready',
                            'error'
                        );

                    }

                }


                if (
                    clearSignatureButton
                ) {

                    clearSignatureButton.addEventListener(
                        'click',
                        function () {

                            clearSignature();

                        }
                    );

                }


                /* ==================================================
                   ERROR
                ================================================== */

                function showSignatureError(
                    message
                ) {

                    if (
                        !signatureCountdown
                    ) {

                        return;

                    }


                    signatureCountdown.classList.remove(
                        'active',
                        'ready'
                    );


                    signatureCountdown.classList.add(
                        'error'
                    );


                    signatureCountdown.textContent =
                        '❌ ' +
                        message;

                }


                /* ==================================================
                   SAVE SIGNATURE
                ================================================== */

                async function saveSignatureAutomatically() {

                    if (
                        signatureSaved
                    ) {

                        return;

                    }


                    if (
                        !signaturePad
                    ) {

                        showSignatureError(
                            'Signature Pad belum diaktifkan.'
                        );

                        return;

                    }


                    if (
                        signaturePad.isEmpty()
                    ) {

                        showSignatureError(
                            'Signature kosong.'
                        );

                        return;

                    }


                    if (
                        !currentSessionId
                    ) {

                        showSignatureError(
                            'Session tandatangan tidak tersedia.'
                        );

                        return;

                    }


                    const signatureData =
                        signaturePad.toDataURL(
                            'image/png'
                        );


                    const saveUrl =
                        `/guestbook/signing-sessions/${currentSessionId}/signature`;


                    if (
                        signatureCountdown
                    ) {

                        signatureCountdown.classList.remove(
                            'active',
                            'error'
                        );

                        signatureCountdown.classList.add(
                            'ready'
                        );

                        signatureCountdown.textContent =
                            '⏳ Menyemak keselamatan...';

                    }


                    if (
                        clearSignatureButton
                    ) {

                        clearSignatureButton.disabled =
                            true;

                    }


                    /*
                    |------------------------------------------------------
                    | Dapatkan CSRF token TERKINI daripada session Laravel.
                    |
                    | Page tablet boleh dibiarkan terbuka lama. Jadi token
                    | yang berada pada page mungkin sudah tidak sepadan
                    | dengan session semasa. Kita refresh token dahulu
                    | sebelum POST.
                    |------------------------------------------------------
                    */

                    async function getFreshCsrfToken() {

                        const refreshUrl =
                            window.location.href
                            + (
                                window.location.href.includes('?')
                                    ? '&'
                                    : '?'
                            )
                            + '_csrf_refresh='
                            + Date.now();


                        const tokenResponse =
                            await fetch(
                                refreshUrl,
                                {
                                    method:
                                        'GET',

                                    credentials:
                                        'same-origin',

                                    cache:
                                        'no-store',

                                    headers: {
                                        'Accept':
                                            'text/html',

                                        'X-Requested-With':
                                            'XMLHttpRequest',

                                        'Cache-Control':
                                            'no-cache, no-store, max-age=0',

                                        'Pragma':
                                            'no-cache'
                                    }
                                }
                            );


                        if (
                            !tokenResponse.ok
                        ) {

                            throw new Error(
                                'Gagal menyegarkan session keselamatan.'
                            );

                        }


                        const tokenHtml =
                            await tokenResponse.text();


                        const tokenDocument =
                            new DOMParser()
                                .parseFromString(
                                    tokenHtml,
                                    'text/html'
                                );


                        const token =
                            tokenDocument
                                .querySelector(
                                    'meta[name="csrf-token"]'
                                )
                                ?.getAttribute(
                                    'content'
                                );


                        if (
                            !token
                        ) {

                            throw new Error(
                                'Token keselamatan tidak tersedia.'
                            );

                        }


                        /*
                        |--------------------------------------------------
                        | Kemaskini token pada page semasa.
                        |--------------------------------------------------
                        */

                        const currentMeta =
                            document.querySelector(
                                'meta[name="csrf-token"]'
                            );


                        if (
                            currentMeta
                        ) {

                            currentMeta.setAttribute(
                                'content',
                                token
                            );

                        }


                        return token;

                    }


                    /*
                    |------------------------------------------------------
                    | Hantar signature.
                    |------------------------------------------------------
                    */

                    async function postSignature(
                        token
                    ) {

                        return await fetch(
                            saveUrl,
                            {
                                method:
                                    'POST',

                                credentials:
                                    'same-origin',

                                headers: {
                                    'Content-Type':
                                        'application/json',

                                    'Accept':
                                        'application/json',

                                    'X-Requested-With':
                                        'XMLHttpRequest',

                                    'X-CSRF-TOKEN':
                                        token
                                },

                                body:
                                    JSON.stringify(
                                        {
                                            signature:
                                                signatureData
                                        }
                                    )
                            }
                        );

                    }


                    try {

                        /*
                        |==================================================
                        | CUBA 1 — token baharu
                        |==================================================
                        */

                        let csrfToken =
                            await getFreshCsrfToken();


                        let response =
                            await postSignature(
                                csrfToken
                            );


                        /*
                        |==================================================
                        | CUBA 2 — jika masih 419
                        |
                        | Refresh token sekali lagi dan hantar semula.
                        |==================================================
                        */

                        if (
                            response.status ===
                            419
                        ) {

                            console.warn(
                                'CSRF mismatch 419. Refresh token dan cuba semula...'
                            );


                            csrfToken =
                                await getFreshCsrfToken();


                            response =
                                await postSignature(
                                    csrfToken
                                );

                        }


                        const contentType =
                            response.headers.get(
                                'content-type'
                            ) ?? '';


                        let data;


                        if (
                            contentType.includes(
                                'application/json'
                            )
                        ) {

                            data =
                                await response.json();

                        } else {

                            const responseText =
                                await response.text();


                            if (
                                response.status ===
                                419
                            ) {

                                throw new Error(
                                    'Session keselamatan telah tamat. Sila muat semula page tablet dan cuba lagi.'
                                );

                            }


                            throw new Error(
                                responseText ||
                                'Respons server tidak sah.'
                            );

                        }


                        if (
                            !response.ok
                        ) {

                            if (
                                response.status ===
                                419
                            ) {

                                throw new Error(
                                    'Session keselamatan telah tamat. Sila muat semula page tablet dan cuba lagi.'
                                );

                            }


                            throw new Error(
                                data?.message ??
                                'Gagal menyimpan tandatangan.'
                            );

                        }


                        /* ==================================================
                           SAVE BERJAYA
                        ================================================== */

                        signatureSaved =
                            true;


                        if (
                            signaturePad &&
                            typeof signaturePad.off ===
                                'function'
                        ) {

                            signaturePad.off();

                        }


                        const savedAt =
                            new Date();


                        if (
                            signatureDate
                        ) {

                            signatureDate.textContent =
                                formatDate(
                                    savedAt
                                );

                        }


                        if (
                            signatureTime
                        ) {

                            signatureTime.textContent =
                                formatTime(
                                    savedAt
                                );

                        }


                        if (
                            signatureCountdown
                        ) {

                            signatureCountdown.classList.remove(
                                'active',
                                'error'
                            );

                            signatureCountdown.classList.add(
                                'ready'
                            );

                            signatureCountdown.textContent =
                                '✅ Tandatangan berjaya direkodkan.';

                        }


                        if (
                            clearSignatureButton
                        ) {

                            clearSignatureButton.disabled =
                                true;

                        }


                        /*
                         * KEMBALI muncul di penjuru
                         * kanan atas signature pad.
                         */

                        if (
                            backButton
                        ) {

                            backButton.classList.add(
                                'visible'
                            );

                        }


                        console.log(
                            'Signature berjaya disimpan.',
                            data
                        );


                    } catch (
                        error
                    ) {

                        console.error(
                            'Auto-save signature error:',
                            error
                        );


                        if (
                            clearSignatureButton
                        ) {

                            clearSignatureButton.disabled =
                                false;

                        }


                        showSignatureError(
                            error.message ??
                            'Gagal menyimpan tandatangan.'
                        );

                    }

                }


                /* ==================================================
                   SHOW SIGNER
                ================================================== */

                function showSigner(
                    data
                ) {

                    if (
                        !data ||
                        !data.signer
                    ) {

                        console.warn(
                            'Data signer tidak lengkap:',
                            data
                        );

                        return;

                    }


                    const signer =
                        data.signer;


                    currentSessionId =
                        data.session_id ??
                        null;


                    signatureSaved =
                        false;


                    stopAutoSaveCountdown();


                    if (
                        waitingPanel
                    ) {

                        waitingPanel.style.display =
                            'none';

                    }


                    if (
                        signContent
                    ) {

                        signContent.style.display =
                            'grid';

                    }


                    if (
                        backButton
                    ) {

                        backButton.classList.remove(
                            'visible'
                        );

                    }


                    if (
                        clearSignatureButton
                    ) {

                        clearSignatureButton.disabled =
                            false;

                    }


                    if (
                        signerName
                    ) {

                        signerName.textContent =
                            signer.name ??
                            '-';

                    }


                    if (
                        signerPosition
                    ) {

                        signerPosition.textContent =
                            signer.position ??
                            '-';

                    }


                    const now =
                        new Date();


                    if (
                        signatureDate
                    ) {

                        signatureDate.textContent =
                            formatDate(
                                now
                            );

                    }


                    if (
                        signatureTime
                    ) {

                        signatureTime.textContent =
                            formatTime(
                                now
                            );

                    }


                    if (
                        signaturePad
                    ) {

                        if (
                            typeof signaturePad.off ===
                                'function'
                        ) {

                            signaturePad.off();

                        }


                        signaturePad.clear();

                    }


                    requestAnimationFrame(
                        function () {

                            initializeSignaturePad();

                        }
                    );


                    console.log(
                        'Signing session diterima:',
                        data
                    );

                }


                /* ==================================================
                   BACK TO WAITING
                ================================================== */

                function returnToWaiting() {

                    stopAutoSaveCountdown();


                    currentSessionId =
                        null;


                    signatureSaved =
                        false;


                    if (
                        signaturePad
                    ) {

                        if (
                            typeof signaturePad.off ===
                                'function'
                        ) {

                            signaturePad.off();

                        }


                        signaturePad.clear();

                    }


                    if (
                        signContent
                    ) {

                        signContent.style.display =
                            'none';

                    }


                    if (
                        waitingPanel
                    ) {

                        waitingPanel.style.display =
                            'flex';

                    }


                    if (
                        signerName
                    ) {

                        signerName.textContent =
                            '-';

                    }


                    if (
                        signerPosition
                    ) {

                        signerPosition.textContent =
                            '-';

                    }


                    if (
                        signatureDate
                    ) {

                        signatureDate.textContent =
                            formatDate(
                                new Date()
                            );

                    }


                    if (
                        signatureTime
                    ) {

                        signatureTime.textContent =
                            formatTime(
                                new Date()
                            );

                    }


                    if (
                        backButton
                    ) {

                        backButton.classList.remove(
                            'visible'
                        );

                    }


                    if (
                        clearSignatureButton
                    ) {

                        clearSignatureButton.disabled =
                            false;

                    }


                    if (
                        signatureCountdown
                    ) {

                        signatureCountdown.textContent =
                            '';

                        signatureCountdown.classList.remove(
                            'active',
                            'ready',
                            'error'
                        );

                    }


                    console.log(
                        'Kembali ke page menunggu tandatangan.'
                    );

                }


                if (
                    backButton
                ) {

                    backButton.addEventListener(
                        'click',
                        function () {

                            returnToWaiting();

                        }
                    );

                }


                /* ==================================================
                   REALTIME CONNECTION
                ================================================== */

                function updateRealtimeConnectionState(
                    state
                ) {

                    switch (
                        state
                    ) {

                        case 'connected':

                            setRealtimeStatus(
                                true,
                                'Realtime aktif'
                            );

                            break;


                        case 'connecting':

                            setRealtimeStatus(
                                false,
                                'Menyambung realtime...'
                            );

                            break;


                        case 'disconnected':

                            setRealtimeStatus(
                                false,
                                'Realtime terputus'
                            );

                            break;


                        case 'unavailable':

                            setRealtimeStatus(
                                false,
                                'Realtime tidak tersedia'
                            );

                            break;


                        case 'failed':

                            setRealtimeStatus(
                                false,
                                'Ralat sambungan realtime'
                            );

                            break;


                        default:

                            setRealtimeStatus(
                                false,
                                'Menyambung realtime...'
                            );

                    }

                }


                /* ==================================================
                   INITIALIZE REALTIME
                ================================================== */

                function initializeRealtime() {

                    if (
                        realtimeInitialized
                    ) {

                        return true;

                    }


                    if (
                        !window.Echo
                    ) {

                        setRealtimeStatus(
                            false,
                            'Menyambung realtime...'
                        );

                        return false;

                    }


                    const pusher =
                        window.Echo
                            .connector
                            ?.pusher;


                    if (
                        !pusher
                    ) {

                        setRealtimeStatus(
                            false,
                            'Menyambung realtime...'
                        );

                        return false;

                    }


                    realtimeInitialized =
                        true;


                    updateRealtimeConnectionState(
                        pusher.connection.state
                    );


                    pusher.connection.bind(
                        'state_change',
                        function (
                            states
                        ) {

                            updateRealtimeConnectionState(
                                states.current
                            );

                        }
                    );


                    const channel =
                        window.Echo.channel(
                            channelName
                        );


                    console.log(
                        'Tablet subscribed:',
                        channelName
                    );


                    channel.listen(
                        '.signing.session.opened',
                        function (
                            data
                        ) {

                            console.log(
                                'Signing session diterima:',
                                data
                            );


                            showSigner(
                                data
                            );

                        }
                    );


                    /* =================================================
                       REMOTE CANCEL
                    ================================================== */

                    channel.listen(
                        '.signing.session.cancelled',
                        function (
                            data
                        ) {

                            console.log(
                                'Remote CANCEL diterima:',
                                data
                            );


                            /*
                            |----------------------------------------------------------
                            | Pastikan event cancellation adalah untuk session
                            | yang sedang dipaparkan pada tablet.
                            |----------------------------------------------------------
                            */

                            if (
                                currentSessionId &&
                                data &&
                                data.session_id &&
                                String(currentSessionId) !==
                                    String(data.session_id)
                            ) {

                                console.log(
                                    'Cancel diabaikan kerana session ID tidak sepadan:',
                                    data.session_id
                                );

                                return;

                            }


                            /*
                            |----------------------------------------------------------
                            | JANGAN terus kembali ke waiting.
                            | Apabila Admin tekan CANCEL, tablet kekal pada paparan
                            | tandatangan dan hanya keluarkan button KEMBALI.
                            | Pengguna tablet perlu tekan KEMBALI untuk kembali
                            | ke skrin Menunggu Permintaan Tandatangan.
                            |----------------------------------------------------------
                            */

                            stopAutoSaveCountdown();


                            if (
                                signaturePad
                            ) {

                                if (
                                    typeof signaturePad.off ===
                                        'function'
                                ) {

                                    signaturePad.off();

                                }


                                signaturePad.clear();

                            }


                            if (
                                signContent
                            ) {

                                signContent.style.display =
                                    'grid';

                            }


                            if (
                                waitingPanel
                            ) {

                                waitingPanel.style.display =
                                    'none';

                            }


                            if (
                                clearSignatureButton
                            ) {

                                clearSignatureButton.disabled =
                                    true;

                            }


                            if (
                                signatureCountdown
                            ) {

                                signatureCountdown.textContent =
                                    'Tandatangan dibatalkan oleh Admin';

                                signatureCountdown.classList.remove(
                                    'active',
                                    'ready',
                                    'error'
                                );

                                signatureCountdown.classList.add(
                                    'error'
                                );

                            }


                            if (
                                backButton
                            ) {

                                backButton.classList.add(
                                    'visible'
                                );

                            }


                            console.log(
                                'Button KEMBALI dipaparkan pada tablet selepas Admin CANCEL.'
                            );

                        }
                    );


                    /* =================================================
                       REMOTE CLEAR
                    ================================================== */

                    channel.listen(
                        '.signing.session.cleared',
                        function (
                            data
                        ) {

                            console.log(
                                'Remote CLEAR diterima:',
                                data
                            );


                            if (
                                data &&
                                data.session_id
                            ) {

                                currentSessionId =
                                    data.session_id;

                            }


                            signatureSaved =
                                false;


                            stopAutoSaveCountdown();


                            if (
                                signaturePad
                            ) {

                                if (
                                    typeof signaturePad.off ===
                                        'function'
                                ) {

                                    signaturePad.off();

                                }


                                signaturePad.clear();

                            }


                            if (
                                backButton
                            ) {

                                backButton.classList.remove(
                                    'visible'
                                );

                            }


                            if (
                                clearSignatureButton
                            ) {

                                clearSignatureButton.disabled =
                                    false;

                            }


                            requestAnimationFrame(
                                function () {

                                    initializeSignaturePad();

                                }
                            );


                            if (
                                signatureCountdown
                            ) {

                                signatureCountdown.classList.remove(
                                    'active',
                                    'error'
                                );

                                signatureCountdown.classList.add(
                                    'ready'
                                );

                                signatureCountdown.textContent =
                                    '✕ Tandatangan telah di-CLEAR oleh Admin. Sila tandatangan semula.';

                            }

                        }
                    );


                    return true;

                }


                /* ==================================================
                   BLOCK PULL-TO-REFRESH / PAGE GESTURES
                ================================================== */

                document.addEventListener(
                    'touchmove',
                    function (
                        event
                    ) {

                        if (
                            event.target !==
                            signatureCanvas
                        ) {

                            event.preventDefault();

                        }

                    },
                    {
                        passive:
                            false
                    }
                );


                document.addEventListener(
                    'touchstart',
                    function (
                        event
                    ) {

                        if (
                            event.touches.length >
                            1
                        ) {

                            event.preventDefault();

                        }

                    },
                    {
                        passive:
                            false
                    }
                );


                document.addEventListener(
                    'gesturestart',
                    function (
                        event
                    ) {

                        event.preventDefault();

                    },
                    {
                        passive:
                            false
                    }
                );


                document.addEventListener(
                    'contextmenu',
                    function (
                        event
                    ) {

                        event.preventDefault();

                    }
                );


                /* ==================================================
                   LANDSCAPE
                ================================================== */

                async function requestLandscape() {

                    try {

                        if (
                            screen.orientation &&
                            typeof screen.orientation.lock ===
                                'function'
                        ) {

                            await screen.orientation.lock(
                                'landscape'
                            );

                            console.log(
                                'Orientation landscape dicuba.'
                            );

                        }

                    } catch (
                        error
                    ) {

                        console.log(
                            'Browser/peranti tidak membenarkan orientation lock:',
                            error
                        );

                    }

                }


                requestLandscape();


                /* ==================================================
                   REALTIME RETRY
                ================================================== */

                realtimeRetryTimer =
                    setInterval(
                        function () {

                            if (
                                initializeRealtime()
                            ) {

                                clearInterval(
                                    realtimeRetryTimer
                                );

                                realtimeRetryTimer =
                                    null;

                            }

                        },
                        500
                    );


                /* ==================================================
                   START
                ================================================== */

                initializeRealtime();

            }
        );

    </script>

</body>

</html>
