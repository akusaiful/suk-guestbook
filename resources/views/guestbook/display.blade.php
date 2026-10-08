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

    @php
        $headerImages = config('guestbook.header_images', []);
        $selectedHeaderKey = $event->header_image
            ?? config('guestbook.default_header_image', 'header-1');

        $selectedHeader = $headerImages[$selectedHeaderKey]
            ?? $headerImages[config('guestbook.default_header_image', 'header-1')]
            ?? [
                'image' => 'images/bg-terbaru.png',
            ];
    @endphp

    {{-- Laravel Vite + Echo + Reverb --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/guestbook-themes.css') }}">

    <style>
        * { box-sizing: border-box; }

        html,
        body {
            min-height: 100%;
        }

        body {
            margin: 0;
            min-height: 100vh;
            min-height: 100dvh;
            font-family: Arial, Helvetica, sans-serif;
            background: transparent !important;
            color: #111827;
        }

        body.guestbook-theme {
            min-height: 100vh;
            min-height: 100dvh;
            background:
                radial-gradient(circle at 50% 0%, rgba(255, 244, 190, 0.34), transparent 42%),
                linear-gradient(180deg, #f8f1e6 0%, #fbf6ed 58%, #f3eadc 100%) !important;
            overflow-x: hidden;
        }

        /*
        |----------------------------------------------------------------------
        | Melaka Classic Header Background
        |----------------------------------------------------------------------
        | Hanya berada dalam kawasan header yang Fie tandakan.
        | Tidak memenuhi keseluruhan skrin.
        */
        /*
        |------------------------------------------------------------------
        | HEADER BAHARU — A kiri tinggi + kapal, B kanan diturunkan + putih
        |------------------------------------------------------------------
        */
        .guestbook-theme.theme-melaka-classic::before {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 50% !important;
            height: 430px !important;
            background-size: cover !important;
            background-position: center 34% !important;
            background-repeat: no-repeat !important;
            opacity: 0.98 !important;
            filter:
                saturate(1.22)
                brightness(1.18)
                contrast(0.96)
                !important;
            transform: none !important;
            border-radius: 0 0 26px 0 !important;
            overflow: hidden;
            z-index: 0 !important;
            pointer-events: none;
        }

        .header {
            position: relative;
            z-index: 8;
            height: 430px;
            margin: 0 0 25px;
            text-align: left;
        }

        /*
         * A — kiri: kawasan tinggi seperti bentuk bertingkat / Z terbalik.
         * Kapal + header memenuhi keseluruhan kawasan A.
         */
        .header-split {
            position: relative;
            z-index: 8;
            width: 100%;
            height: 430px;
            display: grid;
            grid-template-columns: 50% 50%;
            align-items: start;
            overflow: visible;
            border-radius: 0;
            box-shadow: none;
        }

        .header-left {
            position: relative;
            min-width: 0;
            height: 430px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 28px;
            background: transparent !important;
            overflow: hidden;
            border-radius: 0 0 28px 0;
        }

        .header-left::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0,0,0,.02), rgba(0,0,0,.10));
            pointer-events: none;
        }

        /*
         * B — kanan: diturunkan sedikit dan putih bersih.
         */
        .header-right {
            position: relative;
            min-width: 0;
            height: 250px;
            margin-top: 38px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 28px 34px;
            text-align: center;
            background: #ffffff !important;
            border: 1px solid #e6dccb;
            border-left: 3px solid #D4AF37;
            border-radius: 0 0 18px 18px;
            box-shadow: 0 12px 28px rgba(15,23,42,.10);
        }

        .header-right::before {
            display: none !important;
        }

        .guestbook-header-logo {
            display: block;
            width: min(94%, 690px);
            max-height: 235px;
            height: auto;
            margin: 0 auto;
            object-fit: contain;
            position: relative;
            z-index: 2;
            filter: drop-shadow(0 5px 8px rgba(30,18,0,.45)) !important;
            background: transparent !important;
        }

        .header-right .event,
        .header-right .location {
            position: relative;
            z-index: 2;
            max-width: 100%;
            text-transform: uppercase !important;
            text-align: center;
            background: transparent !important;
            -webkit-text-fill-color: #B8860B !important;
            color: #B8860B !important;
            font-family: Georgia, "Times New Roman", serif !important;
            font-weight: 900 !important;
            -webkit-text-stroke: .45px #6f5100 !important;
            text-shadow: 0 1px 2px rgba(255,255,255,.95) !important;
        }

        .header-right .event {
            margin: 0 !important;
            font-size: clamp(24px, 2.35vw, 42px) !important;
            line-height: 1.12 !important;
            letter-spacing: 1.5px !important;
        }

        .header-right .location {
            margin: 18px 0 0 !important;
            font-size: clamp(18px, 1.55vw, 28px) !important;
            line-height: 1.18 !important;
            letter-spacing: 2px !important;
        }

        @media (max-width: 1100px) {
            .guestbook-theme.theme-melaka-classic::before { width: 50% !important; }
            .header-split { grid-template-columns: 50% 50%; }
            .header-right { padding: 22px 20px; }
            .header-right .event { font-size: clamp(21px, 2.7vw, 34px) !important; }
            .header-right .location { font-size: clamp(16px, 1.9vw, 23px) !important; }
        }

        @media (max-width: 700px) {
            .guestbook-theme.theme-melaka-classic::before {
                width: 100% !important;
                height: 210px !important;
                border-radius: 0 !important;
            }
            .header, .header-split { height: auto; min-height: 390px; }
            .header-split { grid-template-columns: 1fr; }
            .header-left { height: 210px; min-height: 210px; border-radius: 0; }
            .header-right {
                height: 180px;
                min-height: 180px;
                margin-top: 0;
                border-left: 0;
                border-top: 3px solid #D4AF37;
                border-radius: 0 0 18px 18px;
            }
            .guestbook-header-logo { width: 86%; max-height: 130px; }
        }

        .realtime-status {
            max-width: 1100px;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 13px;
            color: #6b7280;
        }

        .status-dot { width: 9px; height: 9px; border-radius: 50%; background: #9ca3af; }
        .status-dot.connected { background: #16a34a; }
        .status-dot.disconnected { background: #dc2626; }

        /* RIGHT COLUMN: QR -> PENGUNJUNG -> KOMEN */
        .stats {
            position: absolute;
            top: 540px;
            right: 40px;
            width: 250px;
            height: 550px;
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: repeat(3, 170px);
            gap: 20px;
            margin: 0;
            padding: 0;
            z-index: 20;
        }

        .stat {
            position: relative;
            width: 250px;
            height: 170px;
            background: var(--gb-surface);
            border: 1px solid var(--gb-border);
            border-radius: 18px;
            padding: 18px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(15,23,42,.07);
        }

        .stat::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg,var(--gb-primary),var(--gb-secondary));
        }

        .stats > .stat:nth-child(2) {
            background: linear-gradient(145deg,var(--gb-surface),color-mix(in srgb,var(--gb-primary) 5%,var(--gb-surface)));
        }
        .stats > .stat:nth-child(3) {
            background: linear-gradient(145deg,var(--gb-surface),color-mix(in srgb,var(--gb-secondary) 7%,var(--gb-surface)));
        }

        .stat-label {
            color: var(--gb-muted);
            font-size: 16px;
            font-weight: 900;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .stat-value {
            margin-top: 10px;
            font-size: 48px;
            font-weight: 900;
            line-height: 1;
            letter-spacing: -.5px;
            color: var(--gb-primary);
        }

        .event-qr-card {
            position: relative;
            width: 250px;
            height: 170px;
            margin: 0;
            padding: 14px 18px;
            background: var(--gb-surface);
            border: 1px solid var(--gb-border);
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 16px 36px rgba(15,23,42,.12);
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .event-qr-title { margin-bottom: 2px; font-size: 12px; line-height: 1.2; font-weight: 900; letter-spacing: 1px; color: var(--gb-text); text-transform: uppercase; }
        .event-qr-subtitle { margin-top: -3px; font-size: 9px; font-weight: 800; letter-spacing: .8px; color: var(--gb-primary); text-transform: uppercase; }
        .event-qr-canvas { display: block; width: 122px !important; height: 122px !important; margin: 3px auto 0; background: #ffffff !important; padding: 4px !important; border-radius: 4px; image-rendering: pixelated; }
        .event-qr-caption { margin-top: 3px; font-size: 8px; line-height: 1.2; color: var(--gb-muted); }
        .event-qr-error { display: none; margin-top: 8px; font-size: 11px; line-height: 1.35; color: #b91c1c; }

        /* LEFT AREA: GUESTBOOK, aligned with the three right boxes */
        .guestbook {
            position: absolute;
            top: 540px;
            left: 40px;
            right: 330px;
            width: auto;
            min-height: 550px;
            margin: 0;
            background: #6b4a20 !important;
            border: 2px solid rgba(255,215,0,.82);
            border-radius: 16px;
            padding: 30px;
            overflow: hidden;
            z-index: 10;
            isolation: isolate;
            box-shadow: 0 18px 45px rgba(40,24,8,.24), inset 0 0 0 1px rgba(255,255,255,.35);
        }

        /*
         * BACKGROUND SLIDESHOW GUESTBOOK
         * 4 gambar Melaka, bertukar setiap 4 saat dan looping.
         * Menggunakan <img> + JavaScript supaya lebih konsisten pada TV/Chrome.
         */
        .guestbook-bg-slideshow {
            position: absolute;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            border-radius: inherit;
            pointer-events: none;
            background: #6b4a20;
        }

        .guestbook-bg-slide {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
            display: block;
            opacity: 0;
            transform: scale(1.03);
            transition: opacity 1s ease-in-out, transform 5s ease-in-out;
            will-change: opacity, transform;
        }

        .guestbook-bg-slide.is-active {
            opacity: 1;
            transform: scale(1);
        }

        .guestbook-bg-shade {
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            background: linear-gradient(180deg, rgba(20,12,4,.10), rgba(20,12,4,.18));
        }

        .guestbook > .guestbook-bg-slideshow,
        .guestbook > .guestbook-bg-shade {
            position: absolute;
        }

        .guestbook > *:not(.guestbook-bg-slideshow):not(.guestbook-bg-shade) {
            position: relative;
            z-index: 2;
        }

        .guestbook-heading-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
            margin-bottom: 24px;
        }

        .guestbook-title {
            flex: 0 0 auto;
            min-width: 220px;
            font-size: 34px;
            font-weight: 900;
            margin: 0;
            color: #861b24;
            white-space: nowrap;
        }

        .display-datetime {
            flex: 1 1 auto;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 14px;
            min-width: 0;
        }

        .datetime-card {
            flex: 0 0 auto;
            min-width: 0;
            height: 86px;
            padding: 8px 14px;
            border: 1px solid #dcc9a7;
            border-radius: 14px;
            background: linear-gradient(180deg, rgba(255,255,255,.98), rgba(249,242,230,.98));
            box-shadow: 0 6px 16px rgba(61,37,27,.12), inset 0 1px 0 rgba(255,255,255,.95);
            display: flex;
            align-items: center;
            justify-content: center;
        }

                .date-card { width: 560px; }

        /* DATE ONLY - large display */
        .date-card-only-fix {
            width: 560px;
        }


        .flip-display {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 68px;
            perspective: 1100px;
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
        }

        .clock-digit {
            position: relative;
            display: inline-flex;
            width: 50px;
            height: 70px;
            perspective: 900px;
            transform-style: preserve-3d;
        }

        .clock-digit > span {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: linear-gradient(180deg, rgba(255,255,255,.99) 0%, rgba(255,255,255,.94) 47%, rgba(239,230,213,.99) 48%, rgba(239,230,213,.99) 52%, rgba(255,255,255,.99) 53%, rgba(255,255,255,.92) 100%);
            color: #861b24;
            font-size: 48px;
            font-weight: 950;
            line-height: 1;
            box-shadow: 0 4px 10px rgba(15,23,42,.16), inset 0 1px 0 rgba(255,255,255,.98);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        .clock-digit .digit-current { z-index: 2; }
        .clock-digit .digit-next {
            z-index: 1;
            transform: rotateX(90deg);
            transform-origin: center bottom;
        }

        .clock-digit.is-flipping .digit-current {
            animation: clockFlipOut .62s cubic-bezier(.4,0,.2,1) forwards;
            transform-origin: center top;
        }

        .clock-digit.is-flipping .digit-next {
            animation: clockFlipIn .62s cubic-bezier(.4,0,.2,1) forwards;
            transform-origin: center bottom;
        }

        .clock-separator {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 13px;
            height: 62px;
            color: #861b24;
            font-size: 35px;
            font-weight: 950;
            padding-bottom: 2px;
        }

        .date-word { display: none; }

        .date-space { display: none; }

        .date-digit { width: 56px; height: 72px; }
        .date-digit > span { font-size: 50px; font-weight: 950; }
        .date-separator {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 72px;
            color: #861b24;
            font-size: 44px;
            font-weight: 950;
            line-height: 1;
        }

        .comment-topline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .comment-topline .comment-name {
            margin: 0;
            flex: 1 1 auto;
            min-width: 0;
        }

        .comment-topline .comment-rating {
            flex: 0 0 auto;
            margin: 0;
            white-space: nowrap;
        }

        .rating-feedback {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-left: 8px;
            padding: 4px 9px;
            border-radius: 999px;
            background: #fffaf0;
            border: 1px solid #ead8ad;
            color: #6b4f16;
            font-size: 15px;
            font-weight: 900;
            letter-spacing: 0;
            white-space: nowrap;
        }

        .rating-feedback-emoji {
            font-size: 22px;
            line-height: 1;
        }

        .cloud-emoji {
            display: block;
            margin: 0 0 6px;
            font-size: 26px;
            line-height: 1;
        }

        @keyframes clockFlipOut {
            0% { transform: rotateX(0deg); }
            100% { transform: rotateX(-90deg); }
        }

        @keyframes clockFlipIn {
            0% { transform: rotateX(90deg); }
            100% { transform: rotateX(0deg); }
        }

        @media (max-width: 1100px) {
            .guestbook-heading-row { align-items: flex-start; }
            .display-datetime { gap: 8px; }
                        .date-card { width: 380px; }
            .date-digit { width: 43px; height: 58px; }
            .date-digit > span { font-size: 38px; }
            .date-separator { width: 12px; height: 58px; font-size: 32px; }
        }

        @media (max-width: 700px) {
            .guestbook-heading-row { flex-direction: column; align-items: stretch; }
            .guestbook-title { font-size: 28px; }
            .display-datetime { justify-content: flex-start; flex-wrap: wrap; }
            .date-card { width: 100%; }
        }

        .guestbook-columns {
            display: grid;
            grid-template-columns: minmax(0,1.15fr) minmax(390px,.85fr);
            min-height: 420px;
            background: transparent;
        }

        .latest-comments-panel { min-width: 0; padding-right: 34px; }
        .latest-comments-heading,.old-comments-heading { display: flex; align-items: center; gap: 9px; margin-bottom: 15px; }
        .latest-comments-heading span:last-child,.old-comments-heading span:last-child {
            font-size: 20px;
            font-weight: 900;
            letter-spacing: .4px;
            color: #5a3a08;
            text-transform: uppercase;
            text-shadow: 0 1px 0 rgba(255,255,255,.9);
        }
        #latest-comments-container {
            position: relative;
            height: 430px;
            max-height: 430px;
            overflow: hidden;
            padding: 4px 8px 4px 4px;
        }

        .comment {
            margin: 0 0 14px;
            padding: 18px 20px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(15,23,42,.08);
            animation: commentIn .45s ease;
        }

        .comment:last-child {
            margin-bottom: 0;
        }

        .comment-name {
            font-size: 22px;
            font-weight: 800;
            color: #2f241f;
        }

        .comment-org {
            margin-top: 5px;
            color: #6b7280;
            font-size: 16px;
            font-weight: 500;
        }

        .comment-rating {
            margin-top: 8px;
            font-size: 20px;
            letter-spacing: 2px;
            color: #f59e0b;
            line-height: 1;
        }

        .comment-text {
            margin-top: 12px;
            font-size: 21px;
            line-height: 1.5;
            color: #374151;
        }
        .empty { text-align: center; color: #6b7280; padding: 40px 15px; }

        .old-comments-panel {
            min-width: 0;
            border-left: 1px solid rgba(120,88,40,.30);
            padding-left: 28px;
            background: transparent;
        }
        .old-comments-caption { margin: -5px 0 12px; color: #6b7280; font-size: 12px; line-height: 1.45; }

        .cloud-stage {
            position: relative;
            min-height: 430px;
            overflow: hidden;
            border-radius: 18px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.34);
            box-shadow: inset 0 1px 0 rgba(255,255,255,.45);
        }
        /* Komen terdahulu: speech/dialog bubble */
        .cloud {
            position:absolute;
            display:flex;
            align-items:center;
            justify-content:center;
            width:210px;
            min-height:112px;
            padding:20px 24px;
            text-align:center;
            background:#ffffff;
            border:1px solid #d1d5db;
            border-radius:18px;
            box-shadow:0 10px 24px rgba(15,23,42,.10);
            color:#1f2937;
            font-size:15px;
            line-height:1.42;
            opacity:0;
            transform:translate3d(0,36px,0) scale(.82) rotate(-2deg);
            transition:opacity .42s ease,transform .42s cubic-bezier(.22,.8,.24,1);
        }

        .cloud.active {
            opacity:1;
            transform:translate3d(0,0,0) scale(1) rotate(0deg);
        }

        .cloud::before {
            content:"";
            position:absolute;
            left:28px;
            bottom:-12px;
            width:24px;
            height:24px;
            background:inherit;
            border-right:1px solid currentColor;
            border-bottom:1px solid currentColor;
            transform:rotate(45deg);
            z-index:-1;
        }

        .cloud::after {
            display:none;
        }

        .cloud-name {
            font-weight:800;
            margin-bottom:5px;
            font-size:13px;
        }

        .cloud-message {
            font-size:15px;
            font-weight:500;
        }
        .cloud:nth-child(1) { background: linear-gradient(145deg, #fff7d6, #ffe9a8); border-color: #d6a63c; }
        .cloud:nth-child(2) { background: linear-gradient(145deg, #e8f5ff, #cfe8ff); border-color: #7eb5e8; }
        .cloud:nth-child(3) { background: linear-gradient(145deg, #f5e8ff, #e8ccff); border-color: #ad82d8; }
        .cloud:nth-child(4) { background: linear-gradient(145deg, #e5fff1, #c7f2dc); border-color: #72b992; }
        .cloud:nth-child(5) { background: linear-gradient(145deg, #ffe8ed, #ffcbd6); border-color: #d98a9d; }
        .cloud:nth-child(6) { background: linear-gradient(145deg, #fff0df, #ffd8b2); border-color: #d69b5c; }

        .cloud:nth-child(1)::before { background:#fff7d6; border-color:#d6a63c; }
        .cloud:nth-child(2)::before { background:#e8f5ff; border-color:#7eb5e8; }
        .cloud:nth-child(3)::before { background:#f5e8ff; border-color:#ad82d8; }
        .cloud:nth-child(4)::before { background:#e5fff1; border-color:#72b992; }
        .cloud:nth-child(5)::before { background:#ffe8ed; border-color:#d98a9d; }
        .cloud:nth-child(6)::before { background:#fff0df; border-color:#d69b5c; }
        .cloud-pos-1 { left:6%; top:12%; animation:cloudFloat1 3.8s ease-in-out infinite; }
        .cloud-pos-2 { right:6%; top:7%; animation:cloudFloat2 4.2s ease-in-out infinite; }
        .cloud-pos-3 { left:27%; top:34%; animation:cloudFloat3 4.0s ease-in-out infinite; }
        .cloud-pos-4 { right:20%; top:43%; animation:cloudFloat4 4.4s ease-in-out infinite; }
        .cloud-pos-5 { left:8%; bottom:8%; animation:cloudFloat5 4.1s ease-in-out infinite; }
        .cloud-pos-6 { right:4%; bottom:4%; animation:cloudFloat6 3.9s ease-in-out infinite; }
        /* override old slower declarations */
        .cloud-pos-1,.cloud-pos-2,.cloud-pos-3,.cloud-pos-4,.cloud-pos-5,.cloud-pos-6 { animation-timing-function:ease-in-out; }
        .cloud-empty { height:100%; min-height:320px; display:flex; align-items:center; justify-content:center; text-align:center; padding:30px; color:#94a3b8; font-size:14px; }

        @keyframes cloudFloat1 { 0%,100%{transform:translate3d(0,0,0) rotate(-2deg)} 50%{transform:translate3d(7px,-10px,0) rotate(2deg)} }
        @keyframes cloudFloat2 { 0%,100%{transform:translate3d(0,0,0) rotate(2deg)} 50%{transform:translate3d(-9px,8px,0) rotate(-2deg)} }
        @keyframes cloudFloat3 { 0%,100%{transform:translate3d(0,0,0) rotate(-1deg)} 50%{transform:translate3d(10px,-7px,0) rotate(2deg)} }
        @keyframes cloudFloat4 { 0%,100%{transform:translate3d(0,0,0) rotate(1deg)} 50%{transform:translate3d(-8px,10px,0) rotate(-2deg)} }
        @keyframes cloudFloat5 { 0%,100%{transform:translate3d(0,0,0) rotate(1deg)} 50%{transform:translate3d(7px,-8px,0) rotate(-2deg)} }
        @keyframes cloudFloat6 { 0%,100%{transform:translate3d(0,0,0) rotate(-1deg)} 50%{transform:translate3d(-7px,-9px,0) rotate(2deg)} }
        @keyframes commentIn { from{opacity:0;transform:translateY(-8px)} to{opacity:1;transform:translateY(0)} }

        /* ============================================================
           FLIP NUMBER COUNTER
        ============================================================= */
        .stat-value.flip-counter {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 2px;
            min-height: 58px;
            perspective: 700px;
            font-variant-numeric: tabular-nums;
        }

        .flip-digit {
            position: relative;
            display: inline-block;
            width: .68em;
            height: 1.05em;
            perspective: 700px;
            transform-style: preserve-3d;
        }

        .flip-digit > span {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background:
                linear-gradient(
                    180deg,
                    rgba(255,255,255,.98) 0%,
                    rgba(255,255,255,.90) 47%,
                    rgba(247,241,232,.96) 48%,
                    rgba(247,241,232,.96) 52%,
                    rgba(255,255,255,.98) 53%,
                    rgba(255,255,255,.88) 100%
                );
            color: var(--gb-primary);
            box-shadow:
                0 4px 10px rgba(15,23,42,.12),
                inset 0 1px 0 rgba(255,255,255,.95);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            line-height: 1;
        }

        .flip-digit .digit-current {
            z-index: 2;
        }

        .flip-digit .digit-next {
            z-index: 1;
            transform: rotateX(90deg);
            transform-origin: center bottom;
        }

        .flip-digit.is-flipping .digit-current {
            animation: flipNumberOut .52s cubic-bezier(.4,0,.2,1) forwards;
            transform-origin: center top;
        }

        .flip-digit.is-flipping .digit-next {
            animation: flipNumberIn .52s cubic-bezier(.4,0,.2,1) forwards;
            transform-origin: center bottom;
        }

        @keyframes flipNumberOut {
            0%   { transform: rotateX(0deg); }
            100% { transform: rotateX(-90deg); }
        }

        @keyframes flipNumberIn {
            0%   { transform: rotateX(90deg); }
            100% { transform: rotateX(0deg); }
        }

        @media (max-width: 700px) {
            .stat-value.flip-counter {
                min-height: 52px;
            }
        }

        
/* Komen terdahulu: keluar -> masuk -> naik -> kiri/kanan -> keluar, looping laju */
.cloud {
    animation: olderCommentFastLoop 6.5s cubic-bezier(.45,0,.25,1) infinite;
    will-change: transform, opacity;
}

.cloud:nth-child(2n) {
    animation-duration: 5.8s;
    animation-delay: -1.4s;
}

.cloud:nth-child(3n) {
    animation-duration: 6.2s;
    animation-delay: -2.6s;
}

.cloud:nth-child(4n) {
    animation-duration: 5.5s;
    animation-delay: -3.3s;
}

@keyframes olderCommentFastLoop {
    0% {
        opacity: 0;
        transform: translate3d(0, 120px, 0) scale(.72) rotate(-2deg);
    }
    10% {
        opacity: .92;
        transform: translate3d(-12px, 45px, 0) scale(.94) rotate(1deg);
    }
    24% {
        opacity: 1;
        transform: translate3d(30px, 5px, 0) scale(1) rotate(-1deg);
    }
    42% {
        opacity: .96;
        transform: translate3d(-42px, -45px, 0) scale(1.02) rotate(1.5deg);
    }
    60% {
        opacity: .9;
        transform: translate3d(48px, -95px, 0) scale(.98) rotate(-1deg);
    }
    76% {
        opacity: .7;
        transform: translate3d(-30px, -145px, 0) scale(.9) rotate(2deg);
    }
    88% {
        opacity: .35;
        transform: translate3d(18px, -205px, 0) scale(.78) rotate(-2deg);
    }
    100% {
        opacity: 0;
        transform: translate3d(-10px, -270px, 0) scale(.62) rotate(2deg);
    }
}

@media (prefers-reduced-motion: reduce) {
            .comment,.cloud { animation:none !important; }
            .cloud { transition:none; }
            .flip-digit.is-flipping .digit-current,
            .flip-digit.is-flipping .digit-next {
                animation:none !important;
            }
        }

        @media (max-width: 900px) {
            .stats { position:relative; top:auto; right:auto; width:100%; height:auto; display:grid; grid-template-columns:1fr; grid-template-rows:auto; gap:18px; margin:18px auto 30px; }
            .stats .event-qr-card,.stats .stat { width:100%; height:170px; }
            .guestbook { position:relative; top:auto; left:auto; right:auto; width:100%; min-height:0; margin:0 auto; }
            .guestbook-columns { grid-template-columns:1fr; }
            .latest-comments-panel { padding-right:0; }
            .old-comments-panel { border-left:none; border-top:1px solid #e5e7eb; padding-left:0; padding-top:24px; margin-top:20px; }
        }

        @media (max-width: 700px) {
            .page { padding:20px; }

            .guestbook-header-logo {
                width: 88vw;
                max-width: 92%;
                margin: -6px auto 0;
            }
            .guestbook-theme.theme-melaka-classic .event { margin-top:12px; font-size:34px !important; letter-spacing:1px; }
            .comment { padding:16px 18px; }
            .comment-name { font-size:19px; }
            .comment-org { font-size:14px; }
            .comment-text { font-size:18px; }
            .guestbook { padding:20px; }
            .guestbook-columns { min-height:0; }
            #latest-comments-container { height: auto; max-height: none; }
            .cloud-stage { min-height:340px; }
            .cloud { width:165px; min-height:88px; padding:16px 18px; }
        }


        /* ============================================================
         * V39 — SUSUNAN HEADER IKUT LAKARAN FIE
         * A = satu kotak penuh untuk BG kapal / slideshow akan datang
         * B = panel event + lokasi putih
         * Kandungan bawah dinaikkan ke garisan pemisah
         * Realtime dipindahkan ke penjuru kiri atas skrin
         * ============================================================ */
        .guestbook-theme.theme-melaka-classic::before {
            display: none !important;
        }

        .header {
            position: relative;
            z-index: 8;
            height: 390px !important;
            margin: 0 40px 0 !important;
            padding: 0 !important;
            text-align: left;
        }

        .header-split {
            position: relative;
            z-index: 8;
            width: 100% !important;
            height: 390px !important;
            display: grid !important;
            grid-template-columns: minmax(0, 1fr) 250px !important;
            column-gap: 40px !important;
            align-items: start !important;
            overflow: visible !important;
            border-radius: 0 !important;
        }

        /* A — satu kotak tunggal untuk background kapal / animasi nanti */
        .header-left {
            position: relative !important;
            width: 100% !important;
            height: 390px !important;
            min-width: 0 !important;
            display: flex !important;
            align-items: flex-end !important;
            justify-content: center !important;
            padding: 0 30px 24px !important;
            overflow: hidden !important;
            border-radius: 0 0 18px 18px !important;
            background-image: url('{{ asset('images/pic-kapal.png') }}') !important;
            background-size: cover !important;
            background-position: center center !important;
            background-repeat: no-repeat !important;
            box-shadow: 0 14px 32px rgba(15,23,42,.12) !important;
        }

        .header-left::after {
            content: '' !important;
            position: absolute !important;
            inset: 0 !important;
            background: linear-gradient(180deg, rgba(0,0,0,.02) 0%, rgba(0,0,0,.05) 48%, rgba(0,0,0,.16) 100%) !important;
            pointer-events: none !important;
            z-index: 1 !important;
        }

        /* Header logo diturunkan supaya gambar kapal lebih jelas */
        .guestbook-header-logo {
            position: absolute !important;
            z-index: 2 !important;
            left: 50% !important;
            bottom: 22px !important;
            transform: translateX(-50%) !important;
            width: min(95%, 950px) !important;
            max-width: 950px !important;
            max-height: 231px !important;
            height: auto !important;
            margin: 0 !important;
            object-fit: contain !important;
            filter: drop-shadow(0 6px 9px rgba(30,18,0,.50)) !important;
            background: transparent !important;
        }

        /* B — panel event/lokasi putih, diturunkan sedikit */
        .header-right {
            position: relative !important;
            width: 250px !important;
            height: 280px !important;
            min-width: 250px !important;
            margin: 30px 0 0 !important;
            padding: 30px 20px !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-left: 4px solid #D4AF37 !important;
            border-radius: 0 0 18px 18px !important;
            box-shadow: 0 12px 28px rgba(15,23,42,.10) !important;
            overflow: hidden !important;
        }

        .header-right::before {
            display: none !important;
        }

        .header-right .event,
        .header-right .location {
            position: relative !important;
            z-index: 2 !important;
            max-width: 100% !important;
            text-transform: uppercase !important;
            text-align: center !important;
            background: transparent !important;
            -webkit-text-fill-color: #B8860B !important;
            color: #B8860B !important;
            font-family: Georgia, "Times New Roman", serif !important;
            font-weight: 900 !important;
            -webkit-text-stroke: .35px #6f5100 !important;
            text-shadow: 0 1px 2px rgba(255,255,255,.95) !important;
        }

        .header-right .event {
            margin: 0 !important;
            font-size: clamp(19px, 2.05vw, 34px) !important;
            line-height: 1.12 !important;
            letter-spacing: 1.2px !important;
        }

        .header-right .location {
            margin: 18px 0 0 !important;
            font-size: clamp(15px, 1.35vw, 24px) !important;
            line-height: 1.18 !important;
            letter-spacing: 1.5px !important;
        }

        /* ============================================================
         * V46 — CONNECTOR / TALI ANTARA KOTAK
         * Garisan penghubung halus di ruang yang Fie tandakan.
         * Tidak mengubah saiz atau kedudukan layout utama.
         * ============================================================ */
        .header-split::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 3px;
            transform: translateX(-50%);
            background: linear-gradient(180deg, rgba(212,175,55,.9), rgba(212,175,55,.55), rgba(212,175,55,.9));
            box-shadow: 0 0 8px rgba(212,175,55,.35);
            z-index: 20;
            pointer-events: none;
        }

        .header::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: -14px;
            height: 3px;
            background: linear-gradient(90deg, rgba(212,175,55,.15), rgba(212,175,55,.85), rgba(212,175,55,.15));
            box-shadow: 0 0 7px rgba(212,175,55,.25);
            z-index: 20;
            pointer-events: none;
        }

        @media (max-width: 900px) {
            .header-split::after { display: none; }
        }

        /* Realtime — penjuru kiri atas skrin */
        .realtime-status {
            position: fixed !important;
            top: 8px !important;
            left: 10px !important;
            z-index: 9999 !important;
            width: auto !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 3px 7px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 6px !important;
            font-size: 11px !important;
            color: #6b7280 !important;
            background: rgba(255,255,255,.78) !important;
            border-radius: 999px !important;
            box-shadow: 0 2px 8px rgba(15,23,42,.08) !important;
        }

        /* Naikkan Guestbook + 3 kotak kanan ke atas */
        .guestbook {
            top: 420px !important;
        }

        .stats {
            top: 420px !important;
        }

        @media (max-width: 1100px) {
            .header { margin-left: 24px !important; margin-right: 24px !important; }
            .header-split { grid-template-columns: minmax(0,1fr) 220px !important; column-gap: 24px !important; }
            .header-right { width: 220px !important; min-width: 220px !important; }
            .stats { right: 24px !important; }
            .guestbook { left: 24px !important; right: 292px !important; }
        }

        @media (max-width: 900px) {
            .header { height: auto !important; margin: 0 20px !important; }
            .header-split { height: auto !important; grid-template-columns: 1fr !important; row-gap: 16px !important; }
            .header-left { height: 300px !important; }
            .header-right { width: 100% !important; min-width: 0 !important; height: 190px !important; margin: 0 !important; }
            .guestbook, .stats { top: auto !important; }
            .realtime-status { top: 8px !important; left: 10px !important; }
        }


        /* ============================================================
         * V40 — HEADER AKHIR
         * A = kapal + MELAKA DIGITAL GUESTBOOK
         * B = EVENT + LOCATION, background biru laut + tulisan gold
         * Bahagian bawah tidak disentuh.
         * ============================================================ */
        .header {
            height: 390px !important;
        }

        .header-split {
            grid-template-columns: minmax(0, 1fr) 380px !important;
            column-gap: 24px !important;
            height: 390px !important;
        }

        /* A — satu kotak untuk kapal + header */
        .header-left {
            height: 390px !important;
            min-height: 390px !important;
            background-image: url('{{ asset('images/pic-kapal.png') }}') !important;
            background-size: cover !important;
            background-position: center center !important;
            background-repeat: no-repeat !important;
            border-radius: 0 0 18px 18px !important;
        }

        .guestbook-header-logo {
            left: 50% !important;
            bottom: 22px !important;
            width: min(78%, 780px) !important;
            max-width: 780px !important;
            max-height: 185px !important;
        }

        /* B — biru laut, event/location gold dan uppercase */
        .header-right {
            width: 380px !important;
            min-width: 380px !important;
            height: 300px !important;
            margin: 30px 0 0 !important;
            padding: 30px 28px !important;
            background: linear-gradient(145deg, #075985 0%, #0e7490 52%, #155e75 100%) !important;
            border: 1px solid rgba(255,255,255,.28) !important;
            border-left: 5px solid #FFD700 !important;
            border-radius: 0 0 18px 18px !important;
            box-shadow: 0 12px 28px rgba(15,23,42,.18) !important;
        }

        .header-right .event,
        .header-right .location {
            text-transform: uppercase !important;
            color: #FFD700 !important;
            -webkit-text-fill-color: #FFD700 !important;
            -webkit-text-stroke: .45px #7a5600 !important;
            text-shadow:
                0 2px 0 rgba(77,52,0,.55),
                0 3px 8px rgba(0,0,0,.30) !important;
        }

        .header-right .event {
            font-size: clamp(20px, 2.1vw, 34px) !important;
            line-height: 1.12 !important;
            letter-spacing: 1.1px !important;
        }

        .header-right .location {
            margin-top: 20px !important;
            font-size: clamp(15px, 1.35vw, 23px) !important;
            line-height: 1.2 !important;
            letter-spacing: 1.4px !important;
        }

        @media (max-width: 1100px) and (min-width: 761px) {
            .header-split {
                grid-template-columns: minmax(0, 1fr) 310px !important;
                column-gap: 18px !important;
            }
            .header-right {
                width: 310px !important;
                min-width: 310px !important;
                padding: 24px 18px !important;
            }
        }

        @media (max-width: 760px) {
            .header-split {
                grid-template-columns: 1fr !important;
                row-gap: 14px !important;
                height: auto !important;
            }
            .header-left {
                height: 300px !important;
                min-height: 300px !important;
            }
            .header-right {
                width: 100% !important;
                min-width: 0 !important;
                height: 210px !important;
                margin: 0 !important;
            }
        }

        /* V42 FINAL FIX — A dan B BETUL-BETUL 50/50 */
        .header-split {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            column-gap: 20px !important;
            width: 100% !important;
            height: 390px !important;
        }

        .header-left,
        .header-right {
            width: 100% !important;
            min-width: 0 !important;
            box-sizing: border-box !important;
            height: 390px !important;
        }

        .header-left {
            margin: 0 !important;
        }

        .header-right {
            margin: 0 !important;
        }

        @media (max-width: 760px) {
            .header-split {
                grid-template-columns: 1fr !important;
                height: auto !important;
            }
            .header-left {
                height: 300px !important;
            }
            .header-right {
                height: 210px !important;
            }
        }

        /* V43 — B background slideshow + TV viewport centering */
        .header-right {
            position: relative !important;
            overflow: hidden !important;
            isolation: isolate !important;
        }

        .header-right-bg {
            position: absolute !important;
            inset: 0 !important;
            z-index: 0 !important;
            overflow: hidden !important;
            border-radius: inherit !important;
            pointer-events: none !important;
            background: #0b6175 !important;
        }

        .header-right-bg-slide {
            position: absolute !important;
            inset: 0 !important;
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center center !important;
            opacity: 0 !important;
            transform: scale(1.04) !important;
            transition: opacity 1.15s ease-in-out, transform 4.2s ease-in-out !important;
            display: block !important;
        }

        .header-right-bg-slide.is-active {
            opacity: 1 !important;
            transform: scale(1) !important;
        }

        .header-right-bg-overlay {
            position: absolute !important;
            inset: 0 !important;
            z-index: 1 !important;
            background: linear-gradient(180deg, rgba(0,48,63,.48), rgba(0,55,72,.60)) !important;
        }

        .header-right .event,
        .header-right .location {
            position: relative !important;
            z-index: 3 !important;
            color: #FFD700 !important;
            -webkit-text-fill-color: #FFD700 !important;
            -webkit-text-stroke: .5px #5f4500 !important;
            text-shadow: 0 2px 4px rgba(0,0,0,.65), 0 0 10px rgba(255,215,0,.18) !important;
        }

        /* TV/full-screen: pusatkan keseluruhan paparan supaya ruang atas/bawah seimbang. */
        @media (min-width: 1101px) {
            .header {
                margin-top: var(--tv-top-space, 0px) !important;
            }
            .guestbook {
                top: var(--tv-guestbook-top, 420px) !important;
            }
            .stats {
                top: var(--tv-guestbook-top, 420px) !important;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .header-right-bg-slide {
                transition: none !important;
                transform: none !important;
            }
        }


/* V44 — TV 1-PAGE FIT + DATE 20% SMALLER + B BACKGROUND FADED */
html, body {
    width: 100% !important;
    height: 100% !important;
    overflow: hidden !important;
}

body.guestbook-theme {
    height: 100vh !important;
    height: 100dvh !important;
    min-height: 0 !important;
    overflow: hidden !important;
}

.page {
    position: relative !important;
    width: 100% !important;
    height: 100vh !important;
    height: 100dvh !important;
    min-height: 0 !important;
    overflow: hidden !important;
}

/* Header + content dikira ikut tinggi skrin supaya muat satu paparan */
.header {
    height: 34vh !important;
    min-height: 0 !important;
    margin: 0 28px 0 !important;
}

.header-split {
    height: 34vh !important;
    min-height: 0 !important;
}

.header-left,
.header-right {
    height: 34vh !important;
    min-height: 0 !important;
}

.header-right {
    margin-top: 0 !important;
}

/* Logo sedikit dikecilkan supaya ruang A lebih kemas */
.guestbook-header-logo {
    width: min(76%, 700px) !important;
    max-height: 16vh !important;
    bottom: 2vh !important;
}

/* B: gambar lebih pudar, teks gold kekal tajam */
.header-right-bg-slide {
    opacity: 0 !important;
    filter: saturate(.72) brightness(.78) !important;
    transition: opacity 1.35s ease-in-out, transform 4.2s ease-in-out !important;
}

.header-right-bg-slide.is-active {
    opacity: .28 !important;
}

.header-right-bg-overlay {
    background: linear-gradient(
        180deg,
        rgba(0,48,63,.78),
        rgba(0,55,72,.86)
    ) !important;
}

.header-right .event,
.header-right .location {
    text-shadow: 0 2px 5px rgba(0,0,0,.82), 0 0 12px rgba(255,215,0,.16) !important;
}

/* Tarikh: kecilkan lebih kurang 20% */
.datetime-card {
    height: 69px !important;
    padding: 6px 11px !important;
    border-radius: 12px !important;
}

.date-digit {
    width: 45px !important;
    height: 58px !important;
}

.date-digit > span {
    font-size: 40px !important;
}

.date-separator {
    width: 15px !important;
    height: 58px !important;
    font-size: 35px !important;
}

/* Guestbook + 3 kotak kanan: fit dalam satu viewport */
.guestbook {
    top: 36vh !important;
    height: 62vh !important;
    min-height: 0 !important;
    padding: 24px !important;
}

.stats {
    top: 36vh !important;
    height: 62vh !important;
    grid-template-rows: repeat(3, minmax(0, 1fr)) !important;
    gap: 12px !important;
}

.stat,
.event-qr-card {
    height: auto !important;
    min-height: 0 !important;
}

/* Jangan benarkan kandungan guestbook melampaui kotak */
.guestbook-columns {
    min-height: 0 !important;
    height: calc(100% - 70px) !important;
}

#latest-comments-container {
    height: calc(100% - 42px) !important;
    max-height: none !important;
}

.cloud-stage {
    height: 100% !important;
    min-height: 0 !important;
}

/* Fullscreen/TV desktop: sentiasa satu halaman tanpa scroll */
@media (min-width: 1101px) {
    .header { margin-left: 28px !important; margin-right: 28px !important; }
    .guestbook { left: 28px !important; right: 320px !important; }
    .stats { right: 28px !important; width: 270px !important; }
    .stat, .event-qr-card { width: 270px !important; }
}

</style>



<style>
/* V45 — A: logo naik ke tengah kapal | B: background lebih jelas */
@media (min-width: 761px) {
    .guestbook-header-logo {
        bottom: 8vh !important;
    }
}

/* B: naikkan semula visibility gambar supaya animasi jelas */
.header-right-bg-slide {
    filter: saturate(0.95) brightness(0.98) !important;
    transition: opacity 1.15s ease-in-out, transform 4.2s ease-in-out !important;
}

.header-right-bg-slide.is-active {
    opacity: 0.58 !important;
}

.header-right-bg-overlay {
    background: linear-gradient(
        180deg,
        rgba(0,48,63,.30),
        rgba(0,55,72,.40)
    ) !important;
}
</style>

<style>
/* V47 — Header +10% daripada V46 | Tali emas +15% */
@media (min-width: 761px) {
    .guestbook-header-logo {
        width: min(83.6%, 770px) !important;
        max-height: 17.6vh !important;
    }

    .header-split::after {
        width: 3.45px !important;
    }

    .header::after {
        height: 3.45px !important;
    }
}
</style>

<style>
/* ============================================================
 * V50 — HEADER PREMIUM 70 / 30
 *
 * A = 70% (ATAS)
 * B = 30% (BAWAH)
 *
 * HANYA HEADER A/B DIUBAH.
 * GUESTBOOK, QR, COUNTER, KOMEN, TARIKH & REALTIME KEKAL.
 * ============================================================ */

@media (min-width: 761px) {

    /* Kekalkan jumlah header supaya Guestbook kekal pada kedudukan asal. */
    .header {
        height: 34vh !important;
        min-height: 0 !important;
        margin-left: 28px !important;
        margin-right: 28px !important;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        padding: 0 !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    /* A + B disusun MENEGAK, bukan kiri/kanan. */
    .header-split {
        position: relative !important;
        width: 100% !important;
        height: 34vh !important;
        min-height: 0 !important;

        display: flex !important;
        flex-direction: column !important;

        gap: 0 !important;
        row-gap: 0 !important;
        column-gap: 0 !important;

        align-items: stretch !important;
        overflow: hidden !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    /* Buang connector/tali lama kerana A dan B sekarang stacked. */
    .header-split::after,
    .header::after {
        display: none !important;
        content: none !important;
    }

    /* =========================================================
       A — 70% ATAS
       ========================================================= */
    .header-left {
        position: relative !important;
        width: 100% !important;
        height: 70% !important;
        min-height: 0 !important;
        flex: 0 0 70% !important;

        display: block !important;
        margin: 0 !important;
        padding: 0 !important;

        background: #ffffff !important;
        background-image: none !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        overflow: hidden !important;
    }

    .header-left::after {
        display: none !important;
        content: none !important;
    }

    /* Header artwork baharu */
    .guestbook-header-logo {
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;

        width: 100% !important;
        height: 100% !important;

        max-width: none !important;
        max-height: none !important;
        margin: 0 !important;
        padding: 0 !important;

        transform: none !important;

        display: block !important;
        object-fit: cover !important;
        object-position: center 30% !important;

        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;

        filter: none !important;
    }

    /* =========================================================
       B — 30% BAWAH
       Event + Lokasi + slideshow sedia ada
       ========================================================= */
    .header-right {
        position: relative !important;
        width: 100% !important;
        height: 30% !important;
        min-height: 0 !important;
        flex: 0 0 30% !important;

        margin: 0 !important;
        padding: 4px 55px !important;

        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;

        text-align: center !important;
        overflow: hidden !important;
        isolation: isolate !important;

        background: #0b6175 !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    /* Slideshow B kekal dan memenuhi seluruh ruang B. */
    .header-right-bg {
        position: absolute !important;
        inset: 0 !important;
        width: 100% !important;
        height: 100% !important;
        z-index: 0 !important;
        overflow: hidden !important;
        border-radius: 0 !important;
        pointer-events: none !important;
    }

    .header-right-bg-slide {
        position: absolute !important;
        inset: 0 !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center center !important;
        opacity: 0 !important;
        transform: scale(1.04) !important;
        transition: opacity 1.15s ease-in-out, transform 4.2s ease-in-out !important;
        display: block !important;
    }

    .header-right-bg-slide.is-active {
        opacity: .58 !important;
        transform: scale(1) !important;
    }

    .header-right-bg-overlay {
        position: absolute !important;
        inset: 0 !important;
        z-index: 1 !important;
        background: linear-gradient(
            180deg,
            rgba(0,48,63,.30),
            rgba(0,55,72,.40)
        ) !important;
    }

    /* Event */
    .header-right .event {
        position: relative !important;
        z-index: 3 !important;
        width: 100% !important;
        max-width: 1500px !important;
        margin: 0 !important;
        padding: 0 !important;

        text-align: center !important;
        text-transform: uppercase !important;

        font-family: Georgia, "Times New Roman", serif !important;
        font-size: clamp(16px, 1.7vw, 30px) !important;
        line-height: 1.04 !important;
        letter-spacing: 1.1px !important;
        font-weight: 900 !important;

        color: #FFD700 !important;
        -webkit-text-fill-color: #FFD700 !important;
        -webkit-text-stroke: .65px #5f4500 !important;
        text-shadow:
            0 3px 7px rgba(0,0,0,.78),
            0 0 14px rgba(255,215,0,.20) !important;

        background: transparent !important;
    }

    /* Lokasi */
    .header-right .location {
        position: relative !important;
        z-index: 3 !important;
        width: 100% !important;
        max-width: 1450px !important;
        margin: 5px 0 0 !important;
        padding: 0 !important;

        text-align: center !important;
        text-transform: uppercase !important;

        font-family: Georgia, "Times New Roman", serif !important;
        font-size: clamp(12px, 1.0vw, 19px) !important;
        line-height: 1.05 !important;
        letter-spacing: 1px !important;
        font-weight: 800 !important;

        color: #FFD700 !important;
        -webkit-text-fill-color: #FFD700 !important;
        -webkit-text-stroke: .45px #5f4500 !important;
        text-shadow:
            0 3px 6px rgba(0,0,0,.78),
            0 0 12px rgba(255,215,0,.18) !important;

        background: transparent !important;
    }
}

/* Tablet/telefon — masih stacked, A 70% / B 30%. */
@media (max-width: 760px) {
    .header-split {
        display: flex !important;
        flex-direction: column !important;
        gap: 0 !important;
        height: 390px !important;
    }

    .header-left {
        width: 100% !important;
        height: 70% !important;
        min-height: 0 !important;
        flex: 0 0 70% !important;
        margin: 0 !important;
        padding: 0 !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        overflow: hidden !important;
        background: #ffffff !important;
    }

    .header-left::after {
        display: none !important;
        content: none !important;
    }

    .guestbook-header-logo {
        position: absolute !important;
        inset: 0 !important;
        width: 100% !important;
        height: 100% !important;
        max-width: none !important;
        max-height: none !important;
        margin: 0 !important;
        transform: none !important;
        object-fit: cover !important;
        object-position: center 30% !important;
    }

    .header-right {
        width: 100% !important;
        height: 30% !important;
        min-height: 0 !important;
        flex: 0 0 30% !important;
        margin: 0 !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .header-split::after,
    .header::after {
        display: none !important;
        content: none !important;
    }
}
</style>

<style>
/* ============================================================
 * V50 — A 70% ATAS / B 30% BAWAH
 * Artwork A diturunkan ke object-position 30% supaya
 * Jata Melaka lebih jelas. C / Guestbook tidak disentuh.
 * ============================================================ */

/* ============================================================
 * V49 — KOMEN TERDAHULU PREMIUM / LUTSINAR
 * C: buang kotak latar, kekalkan animasi, cerahkan bubble,
 *    dan kuatkan keterbacaan teks.
 * Guestbook lain TIDAK disentuh.
 * ============================================================ */

.old-comments-panel {
    border-left: 0 !important;
    padding-left: 20px !important;
    background: transparent !important;
}

.old-comments-caption {
    color: rgba(255,255,255,.88) !important;
    font-weight: 600 !important;
    text-shadow: 0 1px 3px rgba(15,23,42,.55) !important;
}

.cloud-stage {
    background: transparent !important;
    border: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    padding: 8px !important;
}

.cloud-empty {
    background: transparent !important;
    border: 0 !important;
    box-shadow: none !important;
    color: rgba(255,255,255,.82) !important;
    text-shadow: 0 1px 3px rgba(15,23,42,.55) !important;
}

/* Semua bubble jadi separa lutsinar + warna moden */
.cloud {
    backdrop-filter: blur(8px) saturate(135%) !important;
    -webkit-backdrop-filter: blur(8px) saturate(135%) !important;
    border-width: 1.5px !important;
    box-shadow:
        0 14px 32px rgba(15,23,42,.14),
        inset 0 1px 0 rgba(255,255,255,.72) !important;
    color: #102033 !important;
}

.cloud:nth-child(1) {
    background: linear-gradient(
        145deg,
        rgba(255,245,196,.88),
        rgba(255,221,120,.68)
    ) !important;
    border-color: rgba(245,183,62,.92) !important;
}

.cloud:nth-child(2) {
    background: linear-gradient(
        145deg,
        rgba(203,236,255,.88),
        rgba(126,202,255,.64)
    ) !important;
    border-color: rgba(89,169,232,.90) !important;
}

.cloud:nth-child(3) {
    background: linear-gradient(
        145deg,
        rgba(232,215,255,.88),
        rgba(193,156,255,.64)
    ) !important;
    border-color: rgba(155,117,226,.90) !important;
}

.cloud:nth-child(4) {
    background: linear-gradient(
        145deg,
        rgba(209,255,234,.88),
        rgba(135,231,187,.64)
    ) !important;
    border-color: rgba(83,185,135,.90) !important;
}

.cloud:nth-child(5) {
    background: linear-gradient(
        145deg,
        rgba(255,220,228,.88),
        rgba(255,166,188,.64)
    ) !important;
    border-color: rgba(225,116,143,.90) !important;
}

.cloud:nth-child(6) {
    background: linear-gradient(
        145deg,
        rgba(219,248,255,.88),
        rgba(128,220,235,.64)
    ) !important;
    border-color: rgba(73,175,196,.90) !important;
}

/* Ekor bubble ikut warna masing-masing */
.cloud:nth-child(1)::before {
    background: rgba(255,221,120,.84) !important;
    border-color: rgba(245,183,62,.92) !important;
}

.cloud:nth-child(2)::before {
    background: rgba(126,202,255,.70) !important;
    border-color: rgba(89,169,232,.90) !important;
}

.cloud:nth-child(3)::before {
    background: rgba(193,156,255,.70) !important;
    border-color: rgba(155,117,226,.90) !important;
}

.cloud:nth-child(4)::before {
    background: rgba(135,231,187,.70) !important;
    border-color: rgba(83,185,135,.90) !important;
}

.cloud:nth-child(5)::before {
    background: rgba(255,166,188,.70) !important;
    border-color: rgba(225,116,143,.90) !important;
}

.cloud:nth-child(6)::before {
    background: rgba(128,220,235,.70) !important;
    border-color: rgba(73,175,196,.90) !important;
}

.cloud-name {
    color: #132238 !important;
    font-size: 15px !important;
    font-weight: 900 !important;
    line-height: 1.25 !important;
    text-shadow: 0 1px 0 rgba(255,255,255,.72) !important;
}

.cloud-message {
    color: #1f2937 !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    line-height: 1.4 !important;
    text-shadow: 0 1px 0 rgba(255,255,255,.62) !important;
}

.cloud .comment-rating {
    color: #f59e0b !important;
    font-size: 18px !important;
    letter-spacing: 1.5px !important;
    text-shadow: 0 1px 2px rgba(255,255,255,.55) !important;
}

.cloud-emoji {
    font-size: 29px !important;
    filter: drop-shadow(0 2px 3px rgba(15,23,42,.16)) !important;
}

/* Tajuk C lebih jelas tetapi masih ringan */
.old-comments-heading span:last-child {
    color: #ffffff !important;
    font-weight: 900 !important;
    text-shadow:
        0 2px 4px rgba(15,23,42,.62),
        0 0 8px rgba(255,255,255,.16) !important;
}

.old-comments-heading span:first-child {
    filter: drop-shadow(0 2px 3px rgba(15,23,42,.24)) !important;
}

@media (max-width: 700px) {
    .old-comments-panel {
        padding-left: 0 !important;
    }

    .cloud-stage {
        padding: 4px !important;
    }

    .cloud-name {
        font-size: 13px !important;
    }

    .cloud-message {
        font-size: 14px !important;
    }
}

@media (prefers-reduced-motion: reduce) {
    .cloud {
        animation: none !important;
        transition: none !important;
    }
}
</style>

<style>
/* V51 — KOTAK KOMEN SEMASA: LIGHT PURPLE MODEN */
.comment {
    background: rgba(245, 240, 255, 0.96) !important;
    border: 1px solid rgba(196, 181, 253, 0.72) !important;
    box-shadow:
        0 10px 24px rgba(109, 83, 173, 0.10),
        inset 0 1px 0 rgba(255,255,255,.88) !important;
}

.comment-name {
    color: #2f2550 !important;
}

.comment-org {
    color: #6b5b85 !important;
}

.comment-text {
    color: #3f3656 !important;
}

@media (max-width: 700px) {
    .comment {
        background: rgba(245, 240, 255, 0.96) !important;
    }
}
</style>


<style>
/* ============================================================
 * V52 — FINAL HEADER FIT / JATA MELAKA
 *
 * Header A:
 * 1. Seluruh artwork bg-utama mesti nampak.
 * 2. Tiada crop menggunakan object-fit: cover.
 * 3. MELAKA DIGITAL GUESTBOOK mesti kelihatan penuh.
 * 4. Jata Melaka kekal kelihatan tetapi lebih kecil.
 * 5. Artwork dipusatkan secara menegak + mendatar.
 *
 * Header B, Guestbook, QR, counter, komen dan realtime tidak disentuh.
 * ============================================================ */

@media (min-width: 761px) {

    .header-left {
        position: relative !important;

        width: 100% !important;
        height: 70% !important;
        min-height: 0 !important;
        flex: 0 0 70% !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        margin: 0 !important;
        padding: 0 !important;

        background: #ffffff !important;
        background-image: none !important;

        overflow: hidden !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .header-left::after {
        display: none !important;
        content: none !important;
    }

    .guestbook-header-logo {
        position: relative !important;

        left: auto !important;
        top: auto !important;
        right: auto !important;
        bottom: auto !important;

        transform: none !important;

        /*
         * Fit penuh tanpa crop.
         * Tinggi 90% mengecilkan artwork sedikit supaya
         * Jata Melaka tidak terlalu besar dan semua teks
         * "MELAKA DIGITAL GUESTBOOK" kekal nampak.
         */
        width: 96% !important;
        height: 90% !important;

        max-width: none !important;
        max-height: none !important;

        margin: 0 auto !important;
        padding: 0 !important;

        object-fit: contain !important;
        object-position: center center !important;

        display: block !important;

        background: transparent !important;

        border: 0 !important;
        border-radius: 0 !important;

        filter: drop-shadow(
            0 4px 7px rgba(30,18,0,.18)
        ) !important;
    }
}


/* ============================================================
 * TABLET / TELEFON LANDSCAPE
 * ============================================================ */

@media (
    min-width: 761px
) and (
    max-width: 1100px
) {

    .guestbook-header-logo {
        width: 94% !important;
        height: 88% !important;
        object-fit: contain !important;
        object-position: center center !important;
    }
}


/* ============================================================
 * TV / DESKTOP BESAR
 * ============================================================ */

@media (min-width: 1601px) {

    .guestbook-header-logo {
        width: 94% !important;
        height: 88% !important;
        object-fit: contain !important;
        object-position: center center !important;
    }
}


/* ============================================================
 * MOBILE
 * ============================================================ */

@media (max-width: 760px) {

    .header-left {
        width: 100% !important;
        height: 70% !important;
        min-height: 0 !important;
        flex: 0 0 70% !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        padding: 0 !important;

        background: #ffffff !important;
        background-image: none !important;

        overflow: hidden !important;
    }

    .header-left::after {
        display: none !important;
        content: none !important;
    }

    .guestbook-header-logo {
        position: relative !important;

        inset: auto !important;

        transform: none !important;

        width: 96% !important;
        height: 88% !important;

        max-width: none !important;
        max-height: none !important;

        margin: 0 auto !important;

        object-fit: contain !important;
        object-position: center center !important;

        display: block !important;

        filter: none !important;
    }
}
</style>


<style>
/* ============================================================
 * V54 FINAL — BG-UTAMA FULL HEADER
 *
 * FINAL RULE:
 * - Gunakan bg-utama.png sebagai artwork header
 * - Header A penuh kiri -> kanan
 * - Tiada ruang kosong putih kiri / kanan
 * - Seluruh artwork dipaksa fit dalam header tanpa crop
 * - Tulisan MELAKA DIGITAL GUESTBOOK mesti kelihatan
 * - Jata Melaka mesti kelihatan
 * - Guestbook / QR / counter / komen tidak disentuh
 * ============================================================ */

@media (min-width: 761px) {

    .header {
        width: calc(100% - 56px) !important;
        margin-left: 28px !important;
        margin-right: 28px !important;
        height: 34vh !important;
        min-height: 0 !important;
        overflow: hidden !important;
    }

    .header-split {
        display: flex !important;
        flex-direction: column !important;
        width: 100% !important;
        height: 34vh !important;
        min-height: 0 !important;
        gap: 0 !important;
        row-gap: 0 !important;
        column-gap: 0 !important;
        overflow: hidden !important;
        border: 0 !important;
        border-radius: 0 !important;
    }

    /* Header A */
    .header-left {
        position: relative !important;
        width: 100% !important;
        height: 70% !important;
        min-height: 0 !important;
        flex: 0 0 70% !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
        overflow: hidden !important;
        background: #ffffff !important;
        background-image: none !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .header-left::after {
        display: none !important;
        content: none !important;
    }

    /*
     * BG-UTAMA:
     * 1410 x 452, jadi kita stretch tepat memenuhi
     * kotak header A supaya tiada gap kiri/kanan
     * dan tiada crop pada artwork / tulisan / jata.
     */
    .guestbook-header-logo {
        position: absolute !important;
        inset: 0 !important;
        left: 0 !important;
        top: 0 !important;
        bottom: auto !important;
        width: 100% !important;
        height: 100% !important;
        max-width: none !important;
        max-height: none !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
        transform: none !important;
        object-fit: fill !important;
        object-position: center center !important;
        background: #ffffff !important;
        border: 0 !important;
        border-radius: 0 !important;
        filter: none !important;
    }

    /* Header B kekal 30% */
    .header-right {
        width: 100% !important;
        height: 30% !important;
        min-height: 0 !important;
        flex: 0 0 30% !important;
        margin: 0 !important;
        padding: 4px 55px !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }
}

/* Desktop besar */
@media (min-width: 1400px) {

    .header {
        width: calc(100% - 56px) !important;
    }

    .guestbook-header-logo {
        /*
         * Pastikan artwork menggunakan keseluruhan ruang.
         * Tiada lagi 70%-80% seperti override lama.
         */
        width: 100% !important;
        height: 100% !important;
        object-fit: fill !important;
    }
}

/* Tablet */
@media (min-width: 761px) and (max-width: 1100px) {

    .header {
        width: calc(100% - 40px) !important;
        margin-left: 20px !important;
        margin-right: 20px !important;
    }

    .guestbook-header-logo {
        width: 100% !important;
        height: 100% !important;
        object-fit: fill !important;
    }
}

/* Telefon */
@media (max-width: 760px) {

    .header {
        width: 100% !important;
        margin: 0 !important;
        height: auto !important;
    }

    .header-split {
        width: 100% !important;
        height: auto !important;
    }

    .header-left {
        width: 100% !important;
        height: 70% !important;
        min-height: 0 !important;
        flex: 0 0 70% !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
        overflow: hidden !important;
        background: #ffffff !important;
    }

    .guestbook-header-logo {
        position: absolute !important;
        inset: 0 !important;
        width: 100% !important;
        height: 100% !important;
        max-width: none !important;
        max-height: none !important;
        margin: 0 !important;
        transform: none !important;
        object-fit: fill !important;
        object-position: center center !important;
    }

    .header-right {
        width: 100% !important;
        height: 30% !important;
        min-height: 0 !important;
        flex: 0 0 30% !important;
        margin: 0 !important;
    }
}
</style>


<style>
/* ============================================================
 * FINAL REQUEST — HEADER / B / TARIKH
 *
 * A = BG-UTAMA GOLD CLASSIC
 * B = EVENT + LOKASI + JATA + TARIKH + HARI
 * Guestbook lain tidak disentuh.
 * ============================================================ */

@media (min-width: 761px) {

    /* ---------------------------------------------------------
       HEADER A
       --------------------------------------------------------- */

    .header-left {
        position: relative !important;
        overflow: hidden !important;
        background: #ffffff !important;
        background-image: none !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .guestbook-header-logo {
        width: 100% !important;
        height: auto !important;
        max-width: none !important;
        max-height: 100% !important;
        margin: 0 !important;
        object-fit: contain !important;
        object-position: center center !important;
        transform: none !important;
        display: block !important;
    }

    /* ---------------------------------------------------------
       HEADER B
       --------------------------------------------------------- */

    .header-right {
        position: relative !important;

        display: flex !important;

        flex-direction: column !important;

        align-items: center !important;

        justify-content: center !important;

        width: 100% !important;

        padding:
            5px 360px 5px 40px !important;

        overflow: hidden !important;
    }

    .header-right-bg,
    .header-right-bg-slide,
    .header-right-bg-overlay {
        pointer-events: none !important;
    }

    .header-right .event {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        text-align: center !important;
        font-size:
            clamp(
                15px,
                1.7vw,
                28px
            ) !important;
        line-height: 1.05 !important;
        letter-spacing: .8px !important;
    }

    .header-right .location {
        width: 100% !important;
        max-width: 100% !important;
        margin: 4px 0 0 !important;
        text-align: center !important;
        font-size:
            clamp(
                10px,
                .95vw,
                16px
            ) !important;
        line-height: 1.05 !important;
        letter-spacing: .7px !important;
    }

    .header-b-meta {

        position: absolute !important;

        top: 50% !important;

        right: 18px !important;

        transform: translateY(-50%) !important;

        z-index: 5 !important;

        display: flex !important;

        align-items: center !important;

        justify-content: center !important;

        gap: 10px !important;

        min-width: 175px !important;

        height: 100% !important;

    }

    .header-b-crest {

        display: block !important;

        width:
            clamp(
                38px,
                4vw,
                58px
            ) !important;

        height:
            clamp(
                48px,
                5.6vh,
                68px
            ) !important;

        object-fit: contain !important;

        object-position: center center !important;

        flex: 0 0 auto !important;

        filter:
            drop-shadow(
                0 2px 3px
                rgba(0,0,0,.22)
            ) !important;

    }

    .header-b-date-wrap {

        display: flex !important;

        flex-direction: column !important;

        align-items: center !important;

        justify-content: center !important;

        gap: 3px !important;

        min-width: 0 !important;

    }

    .header-b-date-card {

        display: flex !important;

        align-items: center !important;

        justify-content: center !important;

        height:
            clamp(
                38px,
                5.3vh,
                52px
            ) !important;

        padding:
            3px 7px !important;

        border-radius:
            8px !important;

        background:
            linear-gradient(
                180deg,
                rgba(255,255,255,.98),
                rgba(247,241,232,.96)
            ) !important;

        border:
            1px solid
            rgba(212,175,55,.58) !important;

        box-shadow:
            0 3px 9px
            rgba(15,23,42,.10) !important;

        overflow: hidden !important;

    }

    .header-b-date {

        display: inline-flex !important;

        align-items: center !important;

        justify-content: center !important;

        gap: 2px !important;

        min-height: 0 !important;

    }

    .header-b-date .date-digit {

        width:
            clamp(
                22px,
                2.1vw,
                31px
            ) !important;

        height:
            clamp(
                29px,
                3.7vh,
                39px
            ) !important;

    }

    .header-b-date .date-digit > span {

        font-size:
            clamp(
                19px,
                1.75vw,
                27px
            ) !important;

        border-radius:
            4px !important;

        box-shadow:
            0 2px 5px
            rgba(15,23,42,.11) !important;

    }

    .header-b-date .date-separator {

        width:
            clamp(
                6px,
                .55vw,
                9px
            ) !important;

        height:
            clamp(
                29px,
                3.7vh,
                39px
            ) !important;

        font-size:
            clamp(
                15px,
                1.4vw,
                21px
            ) !important;

    }

    /* ---------------------------------------------------------
       HARI — FLIP TEXT
       --------------------------------------------------------- */

    .day-flip-display {

        display: inline-flex !important;

        align-items: center !important;

        justify-content: center !important;

        gap: 2px !important;

        min-height: 0 !important;

    }

    .day-flip-letter {

        position: relative !important;

        width:
            clamp(
                14px,
                1.2vw,
                19px
            ) !important;

        height:
            clamp(
                18px,
                2.1vh,
                23px
            ) !important;

        perspective: 500px !important;

        transform-style: preserve-3d !important;

    }

    .day-flip-letter > span {

        position: absolute !important;

        inset: 0 !important;

        display: flex !important;

        align-items: center !important;

        justify-content: center !important;

        border-radius: 3px !important;

        background:
            linear-gradient(
                180deg,
                rgba(255,255,255,.99) 0%,
                rgba(255,255,255,.94) 47%,
                rgba(239,230,213,.99) 48%,
                rgba(239,230,213,.99) 52%,
                rgba(255,255,255,.99) 53%,
                rgba(255,255,255,.92) 100%
            ) !important;

        color:
            var(--gb-primary) !important;

        font-size:
            clamp(
                8px,
                .72vw,
                11px
            ) !important;

        line-height: 1 !important;

        font-weight: 950 !important;

        box-shadow:
            0 2px 4px
            rgba(15,23,42,.12) !important;

        backface-visibility: hidden !important;

        -webkit-backface-visibility: hidden !important;

    }

    .day-flip-letter .day-current {

        z-index: 2 !important;

    }

    .day-flip-letter .day-next {

        z-index: 1 !important;

        transform:
            rotateX(90deg) !important;

        transform-origin:
            center bottom !important;

    }

    .day-flip-letter.is-flipping .day-current {

        animation:
            dayFlipOut
            .52s
            cubic-bezier(.4,0,.2,1)
            forwards !important;

        transform-origin:
            center top !important;

    }

    .day-flip-letter.is-flipping .day-next {

        animation:
            dayFlipIn
            .52s
            cubic-bezier(.4,0,.2,1)
            forwards !important;

        transform-origin:
            center bottom !important;

    }

    @keyframes dayFlipOut {

        0% {
            transform: rotateX(0deg);
        }

        100% {
            transform: rotateX(-90deg);
        }

    }

    @keyframes dayFlipIn {

        0% {
            transform: rotateX(90deg);
        }

        100% {
            transform: rotateX(0deg);
        }

    }

}


@media (max-width: 1100px) and (min-width: 761px) {

    .header-right {

        padding:
            4px 185px 4px 12px !important;

    }

    .header-b-meta {

        min-width: 160px !important;

        gap: 7px !important;

    }

    .header-b-crest {

        width: 40px !important;

        height: 50px !important;

    }

}


@media (max-width: 760px) {

    .header-right {

        display: grid !important;

        grid-template-columns: 1fr !important;

        grid-template-rows: auto auto !important;

        gap: 4px !important;

        padding: 6px 12px !important;

    }

    .header-right .event {

        font-size: 16px !important;

    }

    .header-right .location {

        font-size: 10px !important;

    }

    .header-b-meta {

        min-height: 36px !important;

        height: auto !important;

    }

    .header-b-crest {

        width: 35px !important;

        height: 42px !important;

    }

}
</style>


<style>
/* FINAL TIGHTENING — Tarikh 30% lebih kecil dalam B */
@media (min-width: 761px) {
    .header-b-date-card {
        transform: scale(.92);
        transform-origin: center center;
    }
}
</style>


<style>
/* ============================================================
 * V57 FINAL — HEADER BESAR, SHARP & TIDAK STRETCH
 *
 * A:
 * - Guna bg-utama-gold-classic.png
 * - Besarkan header
 * - Lebarkan sehingga 96vw
 * - Kekalkan nisbah asal 1447 x 287
 * - Tiada stretch / tiada distortion
 *
 * B:
 * - Jata berasingan dibuang
 * - Tarikh kekal kecil
 * - HARI dibesarkan 30%
 *
 * Bahagian Guestbook / QR / Counter / Komen tidak diubah.
 * ============================================================ */

@media (min-width: 761px) {

    /* =========================================================
       A — HEADER ARTWORK
       ========================================================= */

    .header {
        width: 96vw !important;
        margin-left: auto !important;
        margin-right: auto !important;
        margin-bottom: 0 !important;
        height: calc(19.04vw + 67px) !important;
        min-height: 0 !important;
        overflow: visible !important;
    }

    .header-split {
        width: 100% !important;
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 0 !important;
        overflow: visible !important;
    }

    .header-left {
        width: 100% !important;
        height: 12.04vw !important;
        min-height: 0 !important;
        flex: 0 0 12.04vw !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        margin: 0 !important;
        padding: 0 !important;

        background: #ffffff !important;
        background-image: none !important;

        overflow: hidden !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .header-left::after {
        display: none !important;
        content: none !important;
    }

    .guestbook-header-logo {
        position: relative !important;

        left: auto !important;
        top: auto !important;
        right: auto !important;
        bottom: auto !important;

        width: 100% !important;
        height: 100% !important;

        max-width: none !important;
        max-height: none !important;

        margin: 0 !important;
        padding: 0 !important;

        transform: none !important;

        display: block !important;

        /*
         * PNG mempunyai nisbah 1447:287.
         * Parent juga dikunci kepada nisbah yang sama.
         * Jadi image memenuhi ruang dengan tajam tanpa stretch.
         */
        object-fit: contain !important;
        object-position: center center !important;

        background: transparent !important;

        filter: drop-shadow(
            0 3px 7px
            rgba(30,18,0,.16)
        ) !important;
    }


    /* =========================================================
       B — EVENT / LOKASI / TARIKH / HARI
       ========================================================= */

    .header-right {
        width: 100% !important;
        height: 320x !important;
        min-height: 67px !important;
        flex: 0 0 67px !important;

        margin: 0 !important;
        padding:
            4px 205px 4px 24px !important;

        overflow: hidden !important;
    }

    /* Jata berasingan dalam B dibuang terus */
    .header-b-crest {
        display: none !important;
    }

    .header-b-meta {
        right:34px !important;
        min-width: 150px !important;
        gap: 6px !important;
    }


    /* ---------------------------------------------------------
       TARIKH — kekalkan kecil seperti arahan sebelumnya
       --------------------------------------------------------- */

    .header-b-date-card {
        transform: scale(.92) !important;
        transform-origin: center center !important;
    }


    /* ---------------------------------------------------------
       HARI — BESARKAN 30%
       --------------------------------------------------------- */

    .day-flip-letter {
        width:
            clamp(
                18px,
                1.56vw,
                25px
            ) !important;

        height:
            clamp(
                23px,
                2.73vh,
                30px
            ) !important;
    }

    .day-flip-letter > span {
        font-size:
            clamp(
                10px,
                .94vw,
                14px
            ) !important;

        border-radius: 4px !important;
    }

    .day-flip-display {
        gap: 3px !important;
    }


    /* ---------------------------------------------------------
       TARIKH — sedikit kemas supaya seimbang dengan HARI
       --------------------------------------------------------- */

    .header-b-date-card {
        height:
            clamp(
                38px,
                4.9vh,
                48px
            ) !important;
        padding: 3px 7px !important;
    }

    .header-b-date .date-digit {
        width:
            clamp(
                22px,
                1.95vw,
                29px
            ) !important;

        height:
            clamp(
                28px,
                3.5vh,
                37px
            ) !important;
    }

    .header-b-date .date-digit > span {
        font-size:
            clamp(
                18px,
                1.65vw,
                25px
            ) !important;
    }

    .header-b-date .date-separator {
        width:
            clamp(
                6px,
                .52vw,
                8px
            ) !important;

        height:
            clamp(
                28px,
                3.5vh,
                37px
            ) !important;

        font-size:
            clamp(
                14px,
                1.3vw,
                20px
            ) !important;
    }


    /* =========================================================
       B — TEKS EVENT / LOKASI
       ========================================================= */

    .header-right .event {
        font-size:
            clamp(
                15px,
                1.55vw,
                27px
            ) !important;

        line-height:
            1.02 !important;

        letter-spacing:
            .75px !important;
    }

    .header-right .location {
        margin-top: 3px !important;

        font-size:
            clamp(
                10px,
                .88vw,
                16px
            ) !important;

        line-height:
            1.02 !important;
    }


    /* =========================================================
       GUESTBOOK / STATS — IKUT TURUN SUPAYA TAK BERTINDIH
       ========================================================= */

    .guestbook,
    .stats {
        top:
            calc(
                19.04vw + 79px
            ) !important;
    }
}


/* ============================================================
 * TV BESAR
 * ============================================================ */

@media (min-width: 1600px) {

    .header {
        width: 96vw !important;
        height:
            calc(
                19.04vw + 67px
            ) !important;
    }

    .header-left {
        height:
            19.04vw !important;

        flex-basis:
            19.04vw !important;
    }

    .guestbook-header-logo {
        width: 100% !important;
        height: 100% !important;
        object-fit: contain !important;
    }
}


/* ============================================================
 * TABLET LANDSCAPE
 * ============================================================ */

@media (
    min-width: 761px
) and (
    max-width: 1100px
) {

    .header {
        width: 96vw !important;
    }

    .header-left {
        height:
            19.04vw !important;

        flex-basis:
            19.04vw !important;
    }

    .header-right {
        height: 67px !important;
        flex-basis: 67px !important;
    }

    .guestbook,
    .stats {
        top:
            calc(
                19.04vw + 79px
            ) !important;
    }
}


/* ============================================================
 * MOBILE
 * ============================================================ */

@media (max-width: 760px) {

    .header {
        width: 100% !important;
        height: auto !important;
        margin: 0 !important;
    }

    .header-split {
        width: 100% !important;
        height: auto !important;
    }

    .header-left {
        width: 100% !important;

        height:
            calc(
                100vw * .19834
            ) !important;

        min-height: 0 !important;

        flex: 0 0
            calc(
                100vw * .19834
            ) !important;

        padding: 0 !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        background: #ffffff !important;

        overflow: hidden !important;
    }

    .guestbook-header-logo {
        position: relative !important;

        inset: auto !important;

        width: 100% !important;
        height: 100% !important;

        max-width: none !important;
        max-height: none !important;

        margin: 0 !important;

        object-fit: contain !important;
        object-position: center center !important;

        transform: none !important;
    }

    .header-b-crest {
        display: none !important;
    }

    .day-flip-letter {
        width: 16px !important;
        height: 21px !important;
    }

    .day-flip-letter > span {
        font-size: 9px !important;
    }
}
</style>



<style>
/* ============================================================
 * V60 FINAL — A -20% / B +20% / HEADER FULL + EDGE FADE
 *
 * Guna terus kod Fie sebagai base.
 * Hanya override saiz A/B dan kemasan tepi header.
 * ============================================================ */

@media (min-width: 761px) {

    /* ---------------------------------------------------------
       HEADER KESELURUHAN
       A lama = 19.04vw
       A baru = 15.232vw  (20% lebih rendah)
       B lama = 67px
       B baru = 80px      (20% lebih tinggi, dibundarkan)
       --------------------------------------------------------- */

    .header {
        width: 96vw !important;
        margin-left: auto !important;
        margin-right: auto !important;
        margin-bottom: 0 !important;
        height: calc(15.232vw + 80px) !important;
        min-height: 0 !important;
        overflow: visible !important;
    }

    .header-split {
        width: 100% !important;
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 0 !important;
        overflow: visible !important;
    }

    /* ---------------------------------------------------------
       RUANG A — 20% LEBIH RENDAH
       --------------------------------------------------------- */

    .header-left {
        position: relative !important;
        width: 100% !important;
        height: 15.232vw !important;
        min-height: 0 !important;
        flex: 0 0 15.232vw !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        margin: 0 !important;
        padding: 0 !important;

        background: #ffffff !important;
        background-image: none !important;

        overflow: hidden !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        /* Fade lembut pada semua hujung A */
        -webkit-mask-image: radial-gradient(
            ellipse at center,
            #000 70%,
            rgba(0,0,0,.92) 80%,
            transparent 100%
        ) !important;
        mask-image: radial-gradient(
            ellipse at center,
            #000 70%,
            rgba(0,0,0,.92) 80%,
            transparent 100%
        ) !important;
    }

    /* Edge fade / soft shadow transparent */
    .header-left::after {
        display: block !important;
        content: '' !important;
        position: absolute !important;
        inset: 0 !important;
        z-index: 3 !important;
        pointer-events: none !important;
        background:
            linear-gradient(90deg,
                rgba(255,255,255,.96) 0%,
                rgba(255,255,255,0) 7%,
                rgba(255,255,255,0) 93%,
                rgba(255,255,255,.96) 100%),
            linear-gradient(180deg,
                rgba(255,255,255,.88) 0%,
                rgba(255,255,255,0) 10%,
                rgba(255,255,255,0) 90%,
                rgba(255,255,255,.88) 100%);
        box-shadow: inset 0 0 32px 10px rgba(255,255,255,.70) !important;
    }

    /* ---------------------------------------------------------
       BG-UTAMA — PENUH DALAM A, TIADA STRETCH
       --------------------------------------------------------- */

    .guestbook-header-logo {
        position: relative !important;
        left: auto !important;
        top: auto !important;
        right: auto !important;
        bottom: auto !important;

        width: 100% !important;
        height: 100% !important;
        max-width: none !important;
        max-height: none !important;

        margin: 0 !important;
        padding: 0 !important;
        transform: none !important;

        display: block !important;

        /* Kekalkan nisbah gambar, penuh ruang tanpa stretch */
        object-fit: cover !important;
        object-position: center center !important;

        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;

        filter: drop-shadow(0 3px 8px rgba(30,18,0,.15)) !important;
    }

    /* ---------------------------------------------------------
       RUANG B — 20% LEBIH TINGGI
       --------------------------------------------------------- */

    .header-right {
        width: 100% !important;
        height: 80px !important;
        min-height: 80px !important;
        flex: 0 0 80px !important;

        margin: 0 !important;
        padding: 5px 205px 5px 24px !important;
        overflow: hidden !important;
    }

    /* Event + Location: ruang tambahan B boleh digunakan,
       tetapi saiz elemen asal dikekalkan. */

    /* ---------------------------------------------------------
       TARIKH / HARI — kekal di B jika masih digunakan oleh kod Fie
       --------------------------------------------------------- */

    .header-b-meta {
        right: 34px !important;
        min-width: 150px !important;
        gap: 6px !important;
    }

    /* ---------------------------------------------------------
       CONTENT BAWAH — ikut kedudukan baru A+B + gap 12px
       --------------------------------------------------------- */

    .guestbook,
    .stats {
        top: calc(15.232vw + 92px) !important;
    }
}

/* ============================================================
 * TV BESAR — nilai A/B sama, jangan kembali ke 19.04vw
 * ============================================================ */

@media (min-width: 1600px) {
    .header {
        width: 96vw !important;
        height: calc(15.232vw + 80px) !important;
    }

    .header-left {
        height: 15.232vw !important;
        flex: 0 0 15.232vw !important;
    }

    .header-right {
        height: 80px !important;
        min-height: 80px !important;
        flex: 0 0 80px !important;
    }

    .guestbook-header-logo {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center center !important;
    }
}

/* ============================================================
 * TABLET LANDSCAPE
 * ============================================================ */

@media (min-width: 761px) and (max-width: 1100px) {
    .header {
        width: 96vw !important;
        height: calc(15.232vw + 80px) !important;
    }

    .header-left {
        height: 15.232vw !important;
        flex: 0 0 15.232vw !important;
    }

    .header-right {
        height: 80px !important;
        min-height: 80px !important;
        flex: 0 0 80px !important;
        padding: 5px 185px 5px 12px !important;
    }

    .guestbook,
    .stats {
        top: calc(15.232vw + 92px) !important;
    }
}

/* ============================================================
 * MOBILE — kekalkan responsive asal Fie
 * ============================================================ */

@media (max-width: 760px) {
    .header-left::after {
        display: block !important;
    }

    .guestbook-header-logo {
        object-fit: cover !important;
        object-position: center center !important;
    }
}
</style>



<style>
/* ============================================================
 * V61 FINAL — A LOCK / B +40% KE BAWAH / LOCATION = EVENT
 *
 * A DIKUNCI:
 * - Jangan ubah tinggi, lebar atau gambar A.
 *
 * B:
 * - 80px -> 112px (+40%)
 * - Ruang lebihan digunakan ke bawah.
 *
 * BAWAH:
 * - Guestbook + 3 kotak kanan turun 32px,
 *   selari dengan tambahan tinggi B.
 *
 * FONT:
 * - LOCATION disamakan tepat dengan EVENT.
 * ============================================================ */

@media (min-width: 761px) {

    /* =========================
       A — LOCKED
       ========================= */

    .header-left {
        width: 100% !important;
        height: 15.232vw !important;
        min-height: 0 !important;
        flex: 0 0 15.232vw !important;
    }

    .guestbook-header-logo {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center center !important;
    }


    /* =========================
       B — +40%
       ========================= */

    .header-right {
        width: 100% !important;
        height: 112px !important;
        min-height: 112px !important;
        flex: 0 0 112px !important;

        /* jangan ubah susunan dalaman B */
        margin: 0 !important;
        overflow: hidden !important;
    }


    /* =========================
       HEADER TOTAL
       ========================= */

    .header {
        width: 96vw !important;
        height: calc(15.232vw + 112px) !important;
        min-height: 0 !important;
    }

    .header-split {
        width: 100% !important;
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 0 !important;
    }


    /* =========================
       EVENT
       ========================= */

    .header-right .event {
        font-size: clamp(
            15px,
            1.55vw,
            27px
        ) !important;

        line-height: 1.02 !important;
    }


    /* =========================
       LOCATION = SAMA SAIZ EVENT
       ========================= */

    .header-right .location {
        margin-top: 4px !important;

        font-size: clamp(
            15px,
            1.55vw,
            27px
        ) !important;

        line-height: 1.02 !important;
    }


    /* =========================
       TARIKH / HARI
       Kekalkan di B
       ========================= */

    .header-b-meta {
        right: 34px !important;
        min-width: 150px !important;
    }


    /* =========================
       GUESTBOOK + 3 KOTAK
       TURUN 32px
       ========================= */

    .guestbook,
    .stats {
        top: calc(
            15.232vw + 124px
        ) !important;
    }
}


/* ============================================================
 * TV BESAR
 * ============================================================ */

@media (min-width: 1600px) {

    .header-left {
        height: 15.232vw !important;
        flex-basis: 15.232vw !important;
    }

    .header-right {
        height: 112px !important;
        min-height: 112px !important;
        flex-basis: 112px !important;
    }

    .header {
        height: calc(15.232vw + 112px) !important;
    }

    .guestbook,
    .stats {
        top: calc(
            15.232vw + 124px
        ) !important;
    }

    .header-right .event,
    .header-right .location {
        font-size: clamp(
            15px,
            1.55vw,
            27px
        ) !important;
    }
}


/* ============================================================
 * TABLET LANDSCAPE
 * ============================================================ */

@media (min-width: 761px) and (max-width: 1100px) {

    .header-left {
        height: 15.232vw !important;
        flex-basis: 15.232vw !important;
    }

    .header-right {
        height: 112px !important;
        min-height: 112px !important;
        flex-basis: 112px !important;
    }

    .header {
        height: calc(15.232vw + 112px) !important;
    }

    .guestbook,
    .stats {
        top: calc(
            15.232vw + 124px
        ) !important;
    }

    .header-right .event,
    .header-right .location {
        font-size: clamp(
            15px,
            1.55vw,
            27px
        ) !important;
    }
}
</style>

<style>
/* ============================================================
 * V58 — B +40% / REMOVE GUESTBOOK TITLE / EVENT+LOCATION +30%
 *
 * LOCK:
 * - RUANG A TIDAK DIUBAH
 * - BG-UTAMA TIDAK DIUBAH
 * - Tarikh + Hari tidak disentuh
 * - Guestbook / QR / Counter / Komen lain tidak disentuh
 * ============================================================ */

@media (min-width: 761px) {

    /* B: 112px -> 157px (+40%) */
    .header-right {
        height: 157px !important;
        min-height: 157px !important;
        flex: 0 0 157px !important;
    }

    .header {
        height: calc(15.232vw + 157px) !important;
    }

    /* Tolak kandungan bawah mengikut pertambahan B (+45px). */
    .guestbook,
    .stats {
        top: calc(15.232vw + 169px) !important;
    }

    /* Buang baris tajuk GUESTBOOK daripada kawasan kandungan. */
    .guestbook-heading-row {
        display: none !important;
        height: 0 !important;
        min-height: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .guestbook-title {
        display: none !important;
    }

    /* Event + Location 30% lebih besar.
       Asal: clamp(15px, 1.55vw, 27px)
       Baru: clamp(19.5px, 2.015vw, 35px) */
    .header-right .event,
    .header-right .location {
        font-size: clamp(
            19.5px,
            2.015vw,
            35px
        ) !important;
        line-height: 1.02 !important;
    }

    .header-right .location {
        margin-top: 4px !important;
    }
}

/* TV BESAR — A LOCK, B sahaja dibesarkan */
@media (min-width: 1600px) {

    .header-left {
        height: 15.232vw !important;
        flex-basis: 15.232vw !important;
    }

    .header-right {
        height: 157px !important;
        min-height: 157px !important;
        flex-basis: 157px !important;
    }

    .header {
        height: calc(15.232vw + 157px) !important;
    }

    .guestbook,
    .stats {
        top: calc(15.232vw + 169px) !important;
    }

    .header-right .event,
    .header-right .location {
        font-size: clamp(
            19.5px,
            2.015vw,
            35px
        ) !important;
    }
}

/* TABLET LANDSCAPE — A LOCK, B sahaja dibesarkan */
@media (min-width: 761px) and (max-width: 1100px) {

    .header-left {
        height: 15.232vw !important;
        flex-basis: 15.232vw !important;
    }

    .header-right {
        height: 157px !important;
        min-height: 157px !important;
        flex-basis: 157px !important;
    }

    .header {
        height: calc(15.232vw + 157px) !important;
    }

    .guestbook,
    .stats {
        top: calc(15.232vw + 169px) !important;
    }

    .header-right .event,
    .header-right .location {
        font-size: clamp(
            19.5px,
            2.015vw,
            35px
        ) !important;
    }
}
</style>

<style>
/* ============================================================
 * V62 FINAL — TARIKH + HARI KE ATAS KOMEN TERDAHULU
 *
 * LOCK:
 * - RUANG A TIDAK DIUBAH.
 * - SAIZ / GAMBAR A TIDAK DIUBAH.
 * - RUANG B EVENT + LOKASI TIDAK DIUBAH.
 * - GUESTBOOK / QR / COUNTER / KOMEN TIDAK DIUBAH.
 * - Hanya TARIKH + HARI dipindahkan ke panel Komen Terdahulu.
 * ============================================================ */

@media (min-width: 761px) {

    /* Panel kanan menjadi rujukan kedudukan tarikh/hari. */
    .old-comments-panel {
        position: relative !important;
        padding-top: 64px !important;
    }

    /* Tarikh + hari di penjuru kanan atas panel.
       Tiada kotak / background — transparent. */
    .old-comments-panel > .header-b-meta {
        position: absolute !important;
        top: 0 !important;
        right: 0 !important;

        z-index: 30 !important;

        width: auto !important;
        min-width: 0 !important;
        height: auto !important;

        margin: 0 !important;
        padding: 0 !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        background: transparent !important;
        border: 0 !important;

        pointer-events: none !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date-wrap {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;

        gap: 3px !important;
        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
    }

    /* =========================================================
       TARIKH — TRANSPARENT + BOLD
       ========================================================= */

    .old-comments-panel > .header-b-meta .header-b-date-card {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        width: auto !important;
        height: auto !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        transform: none !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 2px !important;

        min-height: 0 !important;
        background: transparent !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-digit {
        width: 25px !important;
        height: 34px !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-digit > span {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        width: 100% !important;
        height: 100% !important;

        padding: 0 !important;

        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .7px #3b1f0b !important;

        font-size: 25px !important;
        font-weight: 950 !important;
        line-height: 1 !important;

        text-shadow:
            0 2px 3px rgba(0,0,0,.95),
            0 0 8px rgba(0,0,0,.55) !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-separator {
        width: 7px !important;
        height: 34px !important;

        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .6px #3b1f0b !important;

        font-size: 20px !important;
        font-weight: 950 !important;
        line-height: 1 !important;

        text-shadow: 0 2px 3px rgba(0,0,0,.95) !important;
    }

    /* =========================================================
       HARI — SAMA BESAR DENGAN TARIKH
       ========================================================= */

    .old-comments-panel > .header-b-meta .day-flip-display {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;

        gap: 2px !important;
        min-height: 34px !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
    }

    .old-comments-panel > .header-b-meta .day-flip-letter {
        position: relative !important;

        width: 25px !important;
        height: 34px !important;

        perspective: 600px !important;
        transform-style: preserve-3d !important;
    }

    .old-comments-panel > .header-b-meta .day-flip-letter > span {
        position: absolute !important;
        inset: 0 !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        width: 100% !important;
        height: 100% !important;

        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .7px #3b1f0b !important;

        font-size: 25px !important;
        font-weight: 950 !important;
        line-height: 1 !important;

        text-shadow:
            0 2px 3px rgba(0,0,0,.95),
            0 0 8px rgba(0,0,0,.55) !important;

        backface-visibility: hidden !important;
        -webkit-backface-visibility: hidden !important;
    }

    .old-comments-panel > .header-b-meta .day-flip-letter .day-current {
        z-index: 2 !important;
    }

    .old-comments-panel > .header-b-meta .day-flip-letter .day-next {
        z-index: 1 !important;
        transform: rotateX(90deg) !important;
        transform-origin: center bottom !important;
    }

    /* Tajuk Komen Terdahulu berada di bawah tarikh/hari. */
    .old-comments-panel > .old-comments-heading {
        position: relative !important;
        z-index: 2 !important;
        margin-top: 0 !important;
    }
}

/* Mobile: kekalkan susunan responsif, tarikh/hari atas panel. */
@media (max-width: 760px) {

    .old-comments-panel {
        position: relative !important;
        padding-top: 54px !important;
    }

    .old-comments-panel > .header-b-meta {
        position: absolute !important;
        top: 0 !important;
        right: 0 !important;

        display: flex !important;
        width: auto !important;
        height: auto !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date-card,
    .old-comments-panel > .header-b-meta .header-b-date,
    .old-comments-panel > .header-b-meta .day-flip-display {
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    .old-comments-panel > .header-b-meta .date-digit {
        width: 20px !important;
        height: 28px !important;
    }

    .old-comments-panel > .header-b-meta .date-digit > span,
    .old-comments-panel > .header-b-meta .day-flip-letter > span {
        font-size: 20px !important;
        font-weight: 950 !important;
    }

    .old-comments-panel > .header-b-meta .day-flip-letter {
        width: 20px !important;
        height: 28px !important;
    }
}
</style>


<style>
/* ============================================================
 * V63 FINAL — TARIKH/HARI TURUN + EVENT/LOCATION +20%
 *
 * LOCK:
 * - RUANG A TIDAK DIUBAH.
 * - ARTWORK A TIDAK DIUBAH.
 * - SAIZ DAN KEDUDUKAN GUESTBOOK / QR / COUNTER / KOMEN
 *   TIDAK DIUBAH.
 * - Hanya kedudukan TARIKH/HARI dan saiz + alignment
 *   EVENT/LOCATION dilaraskan.
 * ============================================================ */

@media (min-width: 761px) {

    /* =========================================================
       TARIKH + HARI
       Turun lagi sedikit dalam ruang Komen Terdahulu.
       ========================================================= */

    .old-comments-panel {
        padding-top: 100px !important;
    }

    .old-comments-panel > .header-b-meta {
        top: 30px !important;
        right: 0 !important;

        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }


    /* =========================================================
       EVENT + LOCATION
       Besarkan 20% daripada V58:
       19.5px / 2.015vw / 35px
       -> 23.4px / 2.418vw / 42px
       ========================================================= */

    .header-right {
        /* Kekalkan struktur B; teks diletakkan semula
           di tengah keseluruhan ruang B. */
        text-align: center !important;
    }

    .header-right .event,
    .header-right .location {
        font-size: clamp(
            23.4px,
            2.418vw,
            42px
        ) !important;

        text-align: center !important;
        font-weight: 900 !important;
        line-height: 1.02 !important;

        /*
         * B sekarang mempunyai ruang kanan untuk tarikh/hari.
         * Translate separuh ruang tersebut supaya pusat teks
         * kembali tepat ke tengah keseluruhan B.
         */
        transform: translateX(102px) !important;
    }

    .header-right .location {
        margin-top: 4px !important;
    }
}


/* ============================================================
 * TV BESAR
 * ============================================================ */

@media (min-width: 1600px) {

    .old-comments-panel {
        padding-top: 100px !important;
    }

    .old-comments-panel > .header-b-meta {
        top: 30px !important;
        right: 0 !important;
    }

    .header-right .event,
    .header-right .location {
        font-size: clamp(
            23.4px,
            2.418vw,
            42px
        ) !important;

        transform: translateX(102px) !important;
    }
}


/* ============================================================
 * TABLET LANDSCAPE
 * ============================================================ */

@media (min-width: 761px) and (max-width: 1100px) {

    .old-comments-panel {
        padding-top: 92px !important;
    }

    .old-comments-panel > .header-b-meta {
        top: 24px !important;
        right: 0 !important;
    }

    .header-right .event,
    .header-right .location {
        font-size: clamp(
            19px,
            2.418vw,
            31px
        ) !important;

        transform: translateX(80px) !important;
    }
}


/* ============================================================
 * MOBILE
 * Jangan ganggu susunan mobile asal.
 * ============================================================ */

@media (max-width: 760px) {

    .header-right .event,
    .header-right .location {
        transform: none !important;
    }

    .old-comments-panel {
        padding-top: 54px !important;
    }

    .old-comments-panel > .header-b-meta {
        top: 0 !important;
        right: 0 !important;
    }
}
</style>


<style>
/* ============================================================
 * V64 FINAL — TARIKH/HARI +10% / LOCATION -10% / CLOUD LEBIH CERAH
 *
 * LOCK:
 * - RUANG A TIDAK DIUBAH.
 * - ARTWORK A TIDAK DIUBAH.
 * - KEDUDUKAN GUESTBOOK / QR / COUNTER / KOMEN TIDAK DIUBAH.
 * - ANIMASI KOMEN TERDAHULU KEKAL.
 *
 * PERUBAHAN SAHAJA:
 * - Tarikh + Hari dibesarkan 10%.
 * - Tarikh + Hari diturunkan sedikit lagi dalam panel
 *   Komen Terdahulu.
 * - Location dikecilkan 10% daripada saiz V63.
 * - Event kekal saiz V63.
 * - Warna bubble Komen Terdahulu dicerahkan.
 * ============================================================ */

@media (min-width: 761px) {

    /* =========================================================
       TARIKH + HARI — BESAR 10% DAN TURUN LAGI
       ========================================================= */

    .old-comments-panel {
        padding-top: 118px !important;
    }

    .old-comments-panel > .header-b-meta {
        top: 48px !important;
        right: 0 !important;

        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-digit,
    .old-comments-panel > .header-b-meta .day-flip-letter {
        width: 28px !important;
        height: 38px !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-digit > span,
    .old-comments-panel > .header-b-meta .day-flip-letter > span {
        font-size: 28px !important;
        font-weight: 950 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .75px #3b1f0b !important;

        text-shadow:
            0 2px 3px rgba(0,0,0,.98),
            0 0 9px rgba(0,0,0,.58) !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-separator {
        width: 8px !important;
        height: 38px !important;
        font-size: 22px !important;
        font-weight: 950 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .65px #3b1f0b !important;

        text-shadow:
            0 2px 3px rgba(0,0,0,.98) !important;
    }

    .old-comments-panel > .header-b-meta .day-flip-display {
        min-height: 38px !important;
        gap: 2px !important;
    }


    /* =========================================================
       EVENT — KEKAL SAIZ V63, CENTER
       ========================================================= */

    .header-right .event {
        font-size: clamp(
            23.4px,
            2.418vw,
            42px
        ) !important;

        text-align: center !important;
        transform: translateX(102px) !important;
    }


    /* =========================================================
       LOCATION — KECIL 10% DARIPADA V63
       V63: 23.4px / 2.418vw / 42px
       V64: 21.1px / 2.176vw / 37.8px
       ========================================================= */

    .header-right .location {
        font-size: clamp(
            21.1px,
            2.176vw,
            38px
        ) !important;

        margin-top: 4px !important;
        text-align: center !important;
        transform: translateX(102px) !important;
    }


    /* =========================================================
       KOMEN TERDAHULU — BUBBLE LEBIH CERAH
       Animasi / kedudukan / saiz bubble tidak diubah.
       ========================================================= */

    .cloud {
        border-width: 1.5px !important;

        box-shadow:
            0 16px 34px rgba(15,23,42,.18),
            inset 0 1px 0 rgba(255,255,255,.92),
            inset 0 -1px 0 rgba(255,255,255,.28) !important;
    }

    .cloud:nth-child(1) {
        background: linear-gradient(
            145deg,
            rgba(255,250,214,.98),
            rgba(255,231,132,.86)
        ) !important;
        border-color: rgba(245,183,62,.98) !important;
    }

    .cloud:nth-child(2) {
        background: linear-gradient(
            145deg,
            rgba(220,244,255,.98),
            rgba(148,216,255,.84)
        ) !important;
        border-color: rgba(89,169,232,.98) !important;
    }

    .cloud:nth-child(3) {
        background: linear-gradient(
            145deg,
            rgba(244,232,255,.98),
            rgba(209,181,255,.84)
        ) !important;
        border-color: rgba(155,117,226,.98) !important;
    }

    .cloud:nth-child(4) {
        background: linear-gradient(
            145deg,
            rgba(224,255,239,.98),
            rgba(155,238,199,.84)
        ) !important;
        border-color: rgba(83,185,135,.98) !important;
    }

    .cloud:nth-child(5) {
        background: linear-gradient(
            145deg,
            rgba(255,232,238,.98),
            rgba(255,187,204,.84)
        ) !important;
        border-color: rgba(225,116,143,.98) !important;
    }

    .cloud:nth-child(6) {
        background: linear-gradient(
            145deg,
            rgba(228,250,255,.98),
            rgba(151,230,242,.84)
        ) !important;
        border-color: rgba(73,175,196,.98) !important;
    }

    .cloud:nth-child(1)::before {
        background: rgba(255,231,132,.90) !important;
        border-color: rgba(245,183,62,.98) !important;
    }

    .cloud:nth-child(2)::before {
        background: rgba(148,216,255,.88) !important;
        border-color: rgba(89,169,232,.98) !important;
    }

    .cloud:nth-child(3)::before {
        background: rgba(209,181,255,.88) !important;
        border-color: rgba(155,117,226,.98) !important;
    }

    .cloud:nth-child(4)::before {
        background: rgba(155,238,199,.88) !important;
        border-color: rgba(83,185,135,.98) !important;
    }

    .cloud:nth-child(5)::before {
        background: rgba(255,187,204,.88) !important;
        border-color: rgba(225,116,143,.98) !important;
    }

    .cloud:nth-child(6)::before {
        background: rgba(151,230,242,.88) !important;
        border-color: rgba(73,175,196,.98) !important;
    }
}


/* ============================================================
 * TV BESAR
 * ============================================================ */

@media (min-width: 1600px) {

    .old-comments-panel {
        padding-top: 118px !important;
    }

    .old-comments-panel > .header-b-meta {
        top: 48px !important;
        right: 0 !important;
    }

    .header-right .event {
        font-size: clamp(
            23.4px,
            2.418vw,
            42px
        ) !important;
        transform: translateX(102px) !important;
    }

    .header-right .location {
        font-size: clamp(
            21.1px,
            2.176vw,
            38px
        ) !important;
        transform: translateX(102px) !important;
    }
}


/* ============================================================
 * TABLET LANDSCAPE
 * ============================================================ */

@media (min-width: 761px) and (max-width: 1100px) {

    .old-comments-panel {
        padding-top: 106px !important;
    }

    .old-comments-panel > .header-b-meta {
        top: 38px !important;
        right: 0 !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-digit,
    .old-comments-panel > .header-b-meta .day-flip-letter {
        width: 24px !important;
        height: 33px !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-digit > span,
    .old-comments-panel > .header-b-meta .day-flip-letter > span {
        font-size: 24px !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-separator {
        width: 7px !important;
        height: 33px !important;
        font-size: 19px !important;
    }

    .header-right .event {
        font-size: clamp(
            19px,
            2.418vw,
            31px
        ) !important;
        transform: translateX(80px) !important;
    }

    .header-right .location {
        font-size: clamp(
            17.1px,
            2.176vw,
            34px
        ) !important;
        transform: translateX(80px) !important;
    }
}


/* ============================================================
 * MOBILE
 * ============================================================ */

@media (max-width: 760px) {

    .header-right .event,
    .header-right .location {
        transform: none !important;
    }

    .header-right .location {
        font-size: 14.4px !important;
    }

    .old-comments-panel {
        padding-top: 54px !important;
    }

    .old-comments-panel > .header-b-meta {
        top: 0 !important;
        right: 0 !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-digit,
    .old-comments-panel > .header-b-meta .day-flip-letter {
        width: 22px !important;
        height: 30px !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-digit > span,
    .old-comments-panel > .header-b-meta .day-flip-letter > span {
        font-size: 22px !important;
    }
}
</style>


<style>
/* ============================================================
 * FINAL REQUEST — PANJANG KOTAK 7 KOMEN TERKINI -30%
 *
 * LOCK:
 * - HEADER A / B KEKAL
 * - TARIKH + HARI KEKAL
 * - KOMEN TERDAHULU + ANIMASI KEKAL
 * - QR / COUNTER / REALTIME KEKAL
 *
 * HANYA KOTAK KOMEN TERKINI DIALIH:
 * panjang/LEBAR kotak menjadi 70% daripada asal.
 * ============================================================ */

@media (min-width: 761px) {
    #latest-comments-container .comment {
        width: 70% !important;
        max-width: 70% !important;
        margin-right: auto !important;
    }
}

/* Mobile kekal penuh supaya responsive asal tidak rosak. */
@media (max-width: 760px) {
    #latest-comments-container .comment {
        width: 100% !important;
        max-width: 100% !important;
    }
}
</style>


<style>
/* ============================================================
 * V65 FINAL — 3 KOTAK KANAN TRANSPARENT + RUANG C FULL WIDTH
 *
 * LOCK:
 * - HEADER A / B KEKAL
 * - TARIKH + HARI KEKAL
 * - 7 KOMEN TERKINI KEKAL
 * - ANIMASI KOMEN TERDAHULU KEKAL
 * - FLIP NUMBER KEKAL
 * - QR KEKAL
 * - REALTIME KEKAL
 *
 * PERUBAHAN SAHAJA:
 * 1. Guestbook diperpanjang sampai hujung kanan.
 * 2. Ruang C (Komen Terdahulu) mendapat ruang tambahan.
 * 3. 3 kotak kanan dijadikan transparent.
 * 4. Kandungan QR + flip number + label kekal jelas.
 * ============================================================ */

@media (min-width: 901px) {

    /* Guestbook — penuh sampai hujung kanan */
    .guestbook {
        left: 28px !important;
        right: 28px !important;
        width: auto !important;
    }

    /* Ruang C — diperbesarkan menggunakan ruang sidebar lama */
    .guestbook-columns {
        grid-template-columns:
            minmax(0, 1.00fr)
            minmax(0, 1.32fr) !important;
        width: 100% !important;
    }

    .latest-comments-panel {
        min-width: 0 !important;
        padding-right: 34px !important;
    }

    .old-comments-panel {
        min-width: 0 !important;
        padding-left: 28px !important;
        padding-right: 0 !important;
    }

    /* 3 kotak kanan — transparent, tetapi kandungan kekal */
    .stats {
        right: 28px !important;
        width: 270px !important;
        background: transparent !important;
        pointer-events: none !important;
        z-index: 35 !important;
    }

    .stats .stat,
    .stats .event-qr-card {
        width: 270px !important;
        background: transparent !important;
        border: 0 !important;
        border-color: transparent !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
        pointer-events: none !important;
    }

    /* Buang garisan atas kotak stat */
    .stats .stat::before {
        display: none !important;
        content: none !important;
    }

    /* QR — kekal jelas */
    .stats .event-qr-card {
        padding: 14px 18px !important;
    }

    .stats .event-qr-title,
    .stats .event-qr-subtitle,
    .stats .event-qr-caption {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        font-weight: 900 !important;
        text-shadow:
            0 2px 4px rgba(0,0,0,.95),
            0 0 8px rgba(0,0,0,.65) !important;
    }

    .stats .event-qr-subtitle {
        color: #FFE27A !important;
        -webkit-text-fill-color: #FFE27A !important;
    }

    .stats .event-qr-canvas {
        filter:
            drop-shadow(0 2px 4px rgba(255,255,255,.90))
            drop-shadow(0 3px 6px rgba(0,0,0,.65)) !important;
    }

    /* Label stat — bold dan terang */
    .stats .stat-label {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        font-weight: 950 !important;
        text-shadow:
            0 2px 4px rgba(0,0,0,.98),
            0 0 9px rgba(0,0,0,.70) !important;
    }

    /* Flip number — animasi asal kekal */
    .stats .stat-value.flip-counter {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        font-weight: 950 !important;
        text-shadow: 0 3px 5px rgba(0,0,0,.85) !important;
    }

    .stats .flip-digit > span {
        color: var(--gb-primary) !important;
        font-weight: 950 !important;
    }

    /* C — tajuk/penerangan kekal jelas di atas background */
    .old-comments-panel > .old-comments-heading,
    .old-comments-panel > .old-comments-caption {
        position: relative !important;
        z-index: 4 !important;
    }

    .old-comments-panel > .old-comments-caption {
        color: rgba(255,255,255,.94) !important;
        font-weight: 700 !important;
        text-shadow: 0 2px 4px rgba(0,0,0,.80) !important;
    }
}

/* Responsive mobile/tablet — layout asal dikekalkan */
@media (max-width: 900px) {

    .guestbook {
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
    }

    .stats {
        position: relative !important;
        right: auto !important;
        width: 100% !important;
        pointer-events: auto !important;
        z-index: 20 !important;
    }

    .stats .stat,
    .stats .event-qr-card {
        width: 100% !important;
        background: var(--gb-surface) !important;
        border: 1px solid var(--gb-border) !important;
        border-radius: 18px !important;
        box-shadow: 0 12px 30px rgba(15,23,42,.07) !important;
    }

    .stats .stat::before {
        display: block !important;
        content: "" !important;
    }
}
</style>

<style>
/* ============================================================
 * V66 FINAL — 3 KOTAK KE ATAS RUANG C + C PENUH KE KANAN
 *
 * GUNA TERUS KOD FIE SEBELUM INI.
 *
 * LOCK:
 * - HEADER A / B KEKAL
 * - ARTWORK A KEKAL
 * - EVENT / LOCATION KEKAL
 * - TARIKH + HARI KEKAL
 * - 7 KOMEN TERKINI KEKAL
 * - ANIMASI KOMEN TERDAHULU KEKAL
 * - FLIP NUMBER KEKAL
 * - QR / REALTIME / JAVASCRIPT KEKAL
 *
 * PERUBAHAN SAHAJA:
 * - 3 kotak QR / Pengunjung / Komen dipindahkan secara
 *   visual ke bahagian atas Ruang C.
 * - Semua kotak luar transparent.
 * - 3 kotak disusun mendatar.
 * - Ruang C diperbesar sehingga hujung kanan guestbook.
 * ============================================================ */

@media (min-width: 901px) {

    /* =========================================================
       GUESTBOOK — penuh sampai hujung kanan
       ========================================================= */

    .guestbook {
        left: 28px !important;
        right: 28px !important;
        width: auto !important;
    }

    /* =========================================================
       SUSUNAN UTAMA:
       Kiri = 42% untuk 5 komen terkini
       C    = 58% untuk komen terdahulu + 3 info
       ========================================================= */

    .guestbook-columns {
        width: 100% !important;
        grid-template-columns:
            minmax(0, .42fr)
            minmax(0, .58fr) !important;
    }

    .latest-comments-panel {
        min-width: 0 !important;
        padding-right: 34px !important;
    }

    .old-comments-panel {
        position: relative !important;
        min-width: 0 !important;
        padding-left: 28px !important;
        padding-right: 0 !important;
        background: transparent !important;
    }

    /* =========================================================
       3 KOTAK — SEKARANG BERADA DALAM RUANG C
       ========================================================= */

    .old-comments-panel > .stats {
        position: absolute !important;

        top: 0 !important;
        left: 28px !important;
        right: 215px !important;

        width: auto !important;
        height: 92px !important;

        margin: 0 !important;
        padding: 0 !important;

        display: grid !important;
        grid-template-columns:
            repeat(3, minmax(0, 1fr)) !important;
        grid-template-rows: 92px !important;

        gap: 10px !important;

        background: transparent !important;

        pointer-events: none !important;
        z-index: 35 !important;
    }

    /* Semua 3 panel luar transparent */
    .old-comments-panel > .stats > .event-qr-card,
    .old-comments-panel > .stats > .stat {
        width: 100% !important;
        height: 92px !important;
        min-width: 0 !important;

        margin: 0 !important;
        padding: 4px 6px !important;

        background: transparent !important;
        border: 0 !important;
        border-color: transparent !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;

        pointer-events: none !important;

        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;

        overflow: hidden !important;
    }

    .old-comments-panel > .stats > .stat::before {
        display: none !important;
        content: none !important;
    }

    /* =========================================================
       QR — transparent, kandungan kekal jelas
       ========================================================= */

    .old-comments-panel > .stats .event-qr-title,
    .old-comments-panel > .stats .event-qr-subtitle,
    .old-comments-panel > .stats .event-qr-caption {
        position: relative !important;
        z-index: 2 !important;

        font-weight: 950 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        text-shadow:
            0 2px 4px rgba(0,0,0,.98),
            0 0 9px rgba(0,0,0,.72) !important;
    }

    .old-comments-panel > .stats .event-qr-title {
        font-size: 11px !important;
        line-height: 1.05 !important;
        letter-spacing: .9px !important;
        margin-bottom: 1px !important;
    }

    .old-comments-panel > .stats .event-qr-subtitle {
        font-size: 8px !important;
        line-height: 1.05 !important;
        letter-spacing: .6px !important;
        color: #FFE27A !important;
        -webkit-text-fill-color: #FFE27A !important;
    }

    .old-comments-panel > .stats .event-qr-canvas {
        display: block !important;
        width: 60px !important;
        height: 60px !important;
        margin: 2px auto 0 !important;

        filter:
            drop-shadow(0 2px 4px rgba(255,255,255,.95))
            drop-shadow(0 3px 6px rgba(0,0,0,.72)) !important;
    }

    .old-comments-panel > .stats .event-qr-caption {
        margin-top: 1px !important;
        font-size: 7px !important;
        line-height: 1.05 !important;
    }

    /* =========================================================
       LABEL STAT — bold dan terang
       ========================================================= */

    .old-comments-panel > .stats .stat-label {
        margin: 0 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        font-size: 12px !important;
        font-weight: 950 !important;
        line-height: 1.05 !important;
        letter-spacing: 1.2px !important;

        text-shadow:
            0 2px 4px rgba(0,0,0,.98),
            0 0 9px rgba(0,0,0,.74) !important;
    }

    /* =========================================================
       FLIP NUMBER — ANIMASI ASAL KEKAL
       ========================================================= */

    .old-comments-panel > .stats .stat-value.flip-counter {
        margin-top: 6px !important;
        min-height: 42px !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        font-weight: 950 !important;

        text-shadow:
            0 3px 5px rgba(0,0,0,.90) !important;
    }

    .old-comments-panel > .stats .flip-digit > span {
        font-weight: 950 !important;
    }

    /* =========================================================
       RUANG C:
       Pastikan tajuk bermula di bawah baris 3 kotak.
       Tarikh/hari kekal di kawasan atas kanan.
       ========================================================= */

    .old-comments-panel > .old-comments-heading,
    .old-comments-panel > .old-comments-caption,
    .old-comments-panel > .cloud-stage {
        position: relative !important;
        z-index: 4 !important;
    }

    .old-comments-panel > .old-comments-caption {
        color: rgba(255,255,255,.94) !important;
        font-weight: 700 !important;
        text-shadow:
            0 2px 4px rgba(0,0,0,.80) !important;
    }

    /* Heading C kekal di bawah kawasan maklumat atas */
    .old-comments-panel > .old-comments-heading {
        margin-top: 0 !important;
    }

    /* =========================================================
       TARIKH / HARI — KEKAL DI KANAN
       ========================================================= */

    .old-comments-panel > .header-b-meta {
        z-index: 40 !important;
    }
}

/* ============================================================
 * TV BESAR
 * ============================================================ */

@media (min-width: 1600px) {

    .guestbook-columns {
        grid-template-columns:
            minmax(0, .42fr)
            minmax(0, .58fr) !important;
    }

    .old-comments-panel > .stats {
        left: 28px !important;
        right: 215px !important;
        height: 92px !important;
        grid-template-rows: 92px !important;
    }
}

/* ============================================================
 * TABLET LANDSCAPE
 * ============================================================ */

@media (min-width: 761px) and (max-width: 1100px) {

    .guestbook-columns {
        grid-template-columns:
            minmax(0, .40fr)
            minmax(0, .60fr) !important;
    }

    .old-comments-panel > .stats {
        left: 18px !important;
        right: 145px !important;
        height: 82px !important;
        grid-template-rows: 82px !important;
        gap: 6px !important;
    }

    .old-comments-panel > .stats > .event-qr-card,
    .old-comments-panel > .stats > .stat {
        height: 82px !important;
    }

    .old-comments-panel > .stats .event-qr-canvas {
        width: 50px !important;
        height: 50px !important;
    }

    .old-comments-panel > .stats .stat-label {
        font-size: 10px !important;
    }

    .old-comments-panel > .stats .stat-value.flip-counter {
        min-height: 36px !important;
        margin-top: 4px !important;
    }

    .old-comments-panel > .stats .event-qr-title {
        font-size: 9px !important;
    }

    .old-comments-panel > .stats .event-qr-subtitle {
        font-size: 7px !important;
    }
}

/* ============================================================
 * MOBILE
 * ============================================================ */

@media (max-width: 760px) {

    .old-comments-panel {
        position: relative !important;
    }

    .old-comments-panel > .stats {
        position: relative !important;
        top: auto !important;
        left: auto !important;
        right: auto !important;

        width: 100% !important;
        height: auto !important;

        margin: 0 0 12px !important;
        padding: 0 !important;

        display: grid !important;
        grid-template-columns: 1fr !important;
        grid-template-rows: auto !important;
        gap: 12px !important;

        pointer-events: none !important;
        z-index: 10 !important;
    }

    .old-comments-panel > .stats > .event-qr-card,
    .old-comments-panel > .stats > .stat {
        width: 100% !important;
        height: 150px !important;
        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }
}
</style>


<style>
/* ============================================================
 * V67 FINAL — QR BESAR + FLIP STAT 40% LEBIH BESAR
 *
 * GUNA TERUS KOD FIE V66 SEBAGAI BASE.
 *
 * LOCK:
 * - HEADER A / B TIDAK DIUBAH
 * - ARTWORK A TIDAK DIUBAH
 * - EVENT / LOCATION TIDAK DIUBAH
 * - TARIKH + HARI TIDAK DIUBAH
 * - 7 KOMEN TERKINI TIDAK DIUBAH
 * - ANIMASI KOMEN TERDAHULU TIDAK DIUBAH
 * - REALTIME / JAVASCRIPT TIDAK DIUBAH
 * - SUSUNAN RUANG C KEKAL
 *
 * PERUBAHAN SAHAJA:
 * - QR diletakkan paling kiri dalam baris info Ruang C,
 *   iaitu terus sebelah panel Komen Terbaru.
 * - QR dibesarkan semaksimum yang praktikal.
 * - Label JUMLAH PENGUNJUNG / KOMEN dibesarkan 40%.
 * - Nombor flip JUMLAH PENGUNJUNG / KOMEN dibesarkan 40%.
 * - Semua panel info kekal transparent.
 * ============================================================ */

@media (min-width: 901px) {

    /* =========================================================
       BARIS 3 INFO DALAM RUANG C
       QR = kolum paling kiri, terus sebelah Komen Terbaru.
       ========================================================= */

    .old-comments-panel > .stats {
        left: 28px !important;
        right: 215px !important;

        height: 148px !important;
        grid-template-columns:
            minmax(190px, 1.35fr)
            minmax(135px, .90fr)
            minmax(135px, .90fr) !important;

        grid-template-rows: 148px !important;
        gap: 8px !important;

        background: transparent !important;
    }


    /* =========================================================
       SEMUA 3 PANEL — TRANSPARENT
       ========================================================= */

    .old-comments-panel > .stats > .event-qr-card,
    .old-comments-panel > .stats > .stat {

        width: 100% !important;
        height: 148px !important;

        margin: 0 !important;
        padding: 2px 6px !important;

        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;

        overflow: visible !important;
    }

    .old-comments-panel > .stats .stat::before {
        display: none !important;
        content: none !important;
    }


    /* =========================================================
       QR — BESAR / MAKSIMUM
       ========================================================= */

    .old-comments-panel > .stats > .event-qr-card {
        justify-content: center !important;
        overflow: visible !important;
    }

    .old-comments-panel > .stats .event-qr-title {
        margin-bottom: 1px !important;
        font-size: 13px !important;
        line-height: 1.05 !important;
        letter-spacing: .8px !important;
        font-weight: 950 !important;
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        text-shadow:
            0 2px 4px rgba(0,0,0,.98),
            0 0 9px rgba(0,0,0,.72) !important;
    }

    .old-comments-panel > .stats .event-qr-subtitle {
        margin: 0 !important;
        font-size: 9px !important;
        line-height: 1.05 !important;
        letter-spacing: .55px !important;
        font-weight: 950 !important;
        color: #FFE27A !important;
        -webkit-text-fill-color: #FFE27A !important;
        text-shadow:
            0 2px 4px rgba(0,0,0,.95) !important;
    }

    .old-comments-panel > .stats .event-qr-canvas {
        display: block !important;

        /*
         * QR asal 60px.
         * V67 = 105px — cukup besar untuk scan,
         * tetapi masih muat dalam satu baris info.
         */
        width: 105px !important;
        height: 105px !important;

        margin: 2px auto 0 !important;

        filter:
            drop-shadow(0 2px 4px rgba(255,255,255,.98))
            drop-shadow(0 3px 7px rgba(0,0,0,.78)) !important;
    }

    .old-comments-panel > .stats .event-qr-caption {
        margin-top: 1px !important;
        font-size: 7px !important;
        line-height: 1 !important;
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        font-weight: 800 !important;
        text-shadow:
            0 2px 4px rgba(0,0,0,.90) !important;
    }


    /* =========================================================
       LABEL STAT — 40% LEBIH BESAR
       Asal V66 = 12px
       Baru = 17px
       ========================================================= */

    .old-comments-panel > .stats .stat-label {
        margin: 0 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        font-size: 17px !important;
        font-weight: 950 !important;
        line-height: 1.05 !important;
        letter-spacing: 1.3px !important;

        text-align: center !important;

        text-shadow:
            0 2px 5px rgba(0,0,0,.99),
            0 0 10px rgba(0,0,0,.78) !important;
    }


    /* =========================================================
       FLIP NUMBER — 40% LEBIH BESAR
       Global V66 mengikut saiz default.
       V67 dikunci kepada 67px.
       ========================================================= */

    .old-comments-panel > .stats .stat-value.flip-counter {
        margin-top: 7px !important;
        min-height: 59px !important;

        font-size: 67px !important;
        line-height: .92 !important;
        letter-spacing: -.5px !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        font-weight: 950 !important;

        text-shadow:
            0 4px 7px rgba(0,0,0,.96),
            0 0 10px rgba(0,0,0,.42) !important;
    }

    .old-comments-panel > .stats .flip-digit {
        width: .68em !important;
        height: 1.05em !important;
    }

    .old-comments-panel > .stats .flip-digit > span {
        font-weight: 950 !important;
        border-radius: 7px !important;
        box-shadow:
            0 4px 10px rgba(15,23,42,.18),
            inset 0 1px 0 rgba(255,255,255,.98) !important;
    }


    /* =========================================================
       C — TAJUK / CAPTION
       Turunkan kandungan sedikit supaya QR besar tidak
       bertindih dengan tajuk Komen Terdahulu.
       ========================================================= */

    .old-comments-panel > .old-comments-heading {
        margin-top: 12px !important;
    }

    .old-comments-panel > .old-comments-caption {
        margin-top: -5px !important;
    }
}


/* ============================================================
 * TV BESAR
 * ============================================================ */

@media (min-width: 1600px) {

    .old-comments-panel > .stats {
        left: 28px !important;
        right: 215px !important;
        height: 148px !important;
        grid-template-columns:
            minmax(210px, 1.35fr)
            minmax(145px, .90fr)
            minmax(145px, .90fr) !important;
        grid-template-rows: 148px !important;
        gap: 10px !important;
    }

    .old-comments-panel > .stats > .event-qr-card,
    .old-comments-panel > .stats > .stat {
        height: 148px !important;
    }

    .old-comments-panel > .stats .event-qr-canvas {
        width: 115px !important;
        height: 115px !important;
    }

    .old-comments-panel > .stats .stat-label {
        font-size: 17px !important;
    }

    .old-comments-panel > .stats .stat-value.flip-counter {
        font-size: 67px !important;
        min-height: 59px !important;
    }

    .old-comments-panel > .old-comments-heading {
        margin-top: 12px !important;
    }
}


/* ============================================================
 * TABLET LANDSCAPE
 * QR masih dibesarkan tetapi kekal muat.
 * ============================================================ */

@media (min-width: 761px) and (max-width: 1100px) {

    .old-comments-panel > .stats {
        left: 18px !important;
        right: 145px !important;
        height: 116px !important;
        grid-template-columns:
            minmax(120px, 1.25fr)
            minmax(95px, .9fr)
            minmax(95px, .9fr) !important;
        grid-template-rows: 116px !important;
        gap: 5px !important;
    }

    .old-comments-panel > .stats > .event-qr-card,
    .old-comments-panel > .stats > .stat {
        height: 116px !important;
    }

    .old-comments-panel > .stats .event-qr-title {
        font-size: 9px !important;
    }

    .old-comments-panel > .stats .event-qr-subtitle {
        font-size: 6px !important;
    }

    .old-comments-panel > .stats .event-qr-canvas {
        width: 76px !important;
        height: 76px !important;
    }

    .old-comments-panel > .stats .event-qr-caption {
        font-size: 5.5px !important;
    }

    .old-comments-panel > .stats .stat-label {
        font-size: 13px !important;
        letter-spacing: .8px !important;
    }

    .old-comments-panel > .stats .stat-value.flip-counter {
        font-size: 49px !important;
        min-height: 45px !important;
        margin-top: 4px !important;
    }

    .old-comments-panel > .stats .flip-digit {
        width: .68em !important;
        height: 1.05em !important;
    }

    .old-comments-panel > .old-comments-heading {
        margin-top: 8px !important;
    }
}


/* ============================================================
 * MOBILE
 * Kekalkan responsive asal.
 * ============================================================ */

@media (max-width: 760px) {

    .old-comments-panel > .stats {
        position: relative !important;
        left: auto !important;
        right: auto !important;
        top: auto !important;

        width: 100% !important;
        height: auto !important;

        display: grid !important;
        grid-template-columns: 1fr !important;
        grid-template-rows: auto !important;
        gap: 12px !important;
    }

    .old-comments-panel > .stats > .event-qr-card,
    .old-comments-panel > .stats > .stat {
        width: 100% !important;
        height: 150px !important;
    }

    .old-comments-panel > .stats .event-qr-canvas {
        width: 100px !important;
        height: 100px !important;
    }

    .old-comments-panel > .stats .stat-label {
        font-size: 17px !important;
    }

    .old-comments-panel > .stats .stat-value.flip-counter {
        font-size: 67px !important;
        min-height: 59px !important;
    }
}
</style>



<style>
/* ============================================================
 * V68 FINAL — QR +30% / FLIP +30% / KOMEN TERDAHULU TURUN 20%
 *
 * GUNA 100% KOD FIE V67 SEBAGAI BASE.
 *
 * LOCK:
 * - HEADER A / B KEKAL
 * - ARTWORK A KEKAL
 * - EVENT / LOCATION KEKAL
 * - TARIKH + HARI KEKAL
 * - 7 KOMEN TERKINI KEKAL
 * - ANIMASI KOMEN TERDAHULU KEKAL
 * - REALTIME / JAVASCRIPT KEKAL
 * - SUSUNAN RUANG C KEKAL
 *
 * PERUBAHAN SAHAJA:
 * 1. QR dibesarkan 30%.
 * 2. JUMLAH PENGUNJUNG + KOMEN label dibesarkan 30%.
 * 3. Nombor FLIP JUMLAH PENGUNJUNG + KOMEN dibesarkan 30%.
 * 4. Tajuk "KOMEN TERDAHULU" diturunkan lagi 30px
 *    (anggaran 20% daripada kedudukan visual semasa).
 * ============================================================ */

@media (min-width: 901px) {

    /* =========================================================
       QR — +30%
       V67: 105px -> V68: 137px
       ========================================================= */

    .old-comments-panel > .stats .event-qr-canvas {
        width: 137px !important;
        height: 137px !important;
        margin: 2px auto 0 !important;
    }

    .old-comments-panel > .stats .event-qr-card {
        overflow: visible !important;
    }

    /* Pastikan QR kekal tajam / mudah diimbas */
    .old-comments-panel > .stats .event-qr-canvas {
        filter:
            drop-shadow(0 2px 5px rgba(255,255,255,.98))
            drop-shadow(0 4px 8px rgba(0,0,0,.82)) !important;
    }


    /* =========================================================
       LABEL — +30%
       V67: 17px -> 22px
       ========================================================= */

    .old-comments-panel > .stats .stat-label {
        font-size: 22px !important;
        line-height: 1 !important;
        letter-spacing: 1.2px !important;
        font-weight: 950 !important;
    }


    /* =========================================================
       FLIP NUMBER — +30%
       V67: 67px -> 87px
       Animasi FLIP asal dikekalkan.
       ========================================================= */

    .old-comments-panel > .stats .stat-value.flip-counter {
        font-size: 87px !important;
        min-height: 76px !important;
        margin-top: 7px !important;
        line-height: .88 !important;
        font-weight: 950 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        text-shadow:
            0 4px 8px rgba(0,0,0,.98),
            0 0 12px rgba(0,0,0,.45) !important;
    }

    .old-comments-panel > .stats .flip-digit {
        width: .68em !important;
        height: 1.05em !important;
    }

    .old-comments-panel > .stats .flip-digit > span {
        font-weight: 950 !important;
    }


    /* =========================================================
       KOMEN TERDAHULU — TURUN 30px
       ========================================================= */

    .old-comments-panel > .old-comments-heading {
        margin-top: 42px !important;
    }

    .old-comments-panel > .old-comments-caption {
        margin-top: -5px !important;
    }
}


/* ============================================================
 * TV BESAR
 * ============================================================ */

@media (min-width: 1600px) {

    /* QR +30% daripada V67 TV: 115px -> 150px */
    .old-comments-panel > .stats .event-qr-canvas {
        width: 150px !important;
        height: 150px !important;
    }

    /* Label +30% */
    .old-comments-panel > .stats .stat-label {
        font-size: 22px !important;
    }

    /* Flip +30% */
    .old-comments-panel > .stats .stat-value.flip-counter {
        font-size: 87px !important;
        min-height: 76px !important;
    }

    /* Komen Terdahulu turun lagi 30px */
    .old-comments-panel > .old-comments-heading {
        margin-top: 42px !important;
    }
}


/* ============================================================
 * TABLET LANDSCAPE
 * ============================================================ */

@media (min-width: 761px) and (max-width: 1100px) {

    /* QR V67 76px -> +30% ≈ 99px */
    .old-comments-panel > .stats .event-qr-canvas {
        width: 99px !important;
        height: 99px !important;
    }

    /* Label V67 13px -> +30% ≈ 17px */
    .old-comments-panel > .stats .stat-label {
        font-size: 17px !important;
        letter-spacing: .8px !important;
    }

    /* Flip V67 49px -> +30% ≈ 64px */
    .old-comments-panel > .stats .stat-value.flip-counter {
        font-size: 64px !important;
        min-height: 58px !important;
        margin-top: 4px !important;
    }

    /* Komen Terdahulu turun lagi */
    .old-comments-panel > .old-comments-heading {
        margin-top: 38px !important;
    }
}


/* ============================================================
 * MOBILE
 * Jangan ganggu layout mobile V67.
 * ============================================================ */

@media (max-width: 760px) {

    .old-comments-panel > .old-comments-heading {
        margin-top: 12px !important;
    }

}
</style>


<style>
/* ============================================================
 * V69 FINAL — CLEAN INFO + 10 KOMEN LAMA RANDOM
 *
 * GUNA 100% KOD FIE SEBAGAI BASE.
 *
 * LOCK:
 * - HEADER A / B
 * - EVENT / LOCATION
 * - TARIKH / HARI
 * - 7 KOMEN TERKINI + DATA / REALTIME
 * - QR + FLIP NUMBER
 * - BACKGROUND SLIDESHOW
 *
 * PERUBAHAN SAHAJA:
 * 1. Buang tulisan "5 KOMEN TERBARU".
 * 2. Buang tulisan "KOMEN TERDAHULU".
 * 3. Buang ayat penerangan di bawah Komen Terdahulu.
 * 4. Besarkan teks QR "QR PENDAFTARAN" + "SCAN UNTUK PENDAFTARAN".
 * 5. Selaraskan JUMLAH PENGUNJUNG + KOMEN pada kedudukan yang sama.
 * 6. Paparkan sehingga 10 komen terdahulu serentak.
 * 7. Setiap pusingan random: dialog / bulat sahaja.
 * 8. Loop komen terdahulu kekal.
 * ============================================================ */

@media (min-width: 901px) {

    /* =========================================================
       1 — BUANG TAJUK PAPARAN
       ========================================================= */

    .old-comments-panel > .old-comments-heading,
    .latest-comments-panel > .latest-comments-heading,
    .old-comments-panel > .old-comments-caption {
        display: none !important;
    }

    /* Buang juga mesej kosong daripada memenuhi Ruang C. */
    .old-comments-panel > .cloud-stage .cloud-empty {
        display: none !important;
    }


    /* =========================================================
       2 — RUANG C: JARAK CLOUD BERKEMAS
       Stats duduk di atas, cloud bermula di bawah baris info.
       ========================================================= */

    .old-comments-panel > .cloud-stage {
        margin-top: 32px !important;
        min-height: 0 !important;
        height: calc(100% - 170px) !important;

        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }


    /* =========================================================
       3 — QR: TAJUK LEBIH BESAR DAN JELAS
       ========================================================= */

    .old-comments-panel > .stats .event-qr-title {
        font-size: 17px !important;
        line-height: 1 !important;
        letter-spacing: 1px !important;
        font-weight: 950 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        text-align: center !important;

        text-shadow:
            0 2px 5px rgba(0,0,0,.98),
            0 0 10px rgba(0,0,0,.78) !important;
    }

    .old-comments-panel > .stats .event-qr-subtitle {
        font-size: 12px !important;
        line-height: 1 !important;
        letter-spacing: .8px !important;
        font-weight: 950 !important;

        color: #FFE27A !important;
        -webkit-text-fill-color: #FFE27A !important;

        text-align: center !important;

        text-shadow:
            0 2px 5px rgba(0,0,0,.98) !important;
    }


    /* =========================================================
       4 — PENGUNJUNG + KOMEN
       Kedua-duanya tepat satu baseline / satu susunan.
       ========================================================= */

    .old-comments-panel > .stats > .stat:nth-child(2),
    .old-comments-panel > .stats > .stat:nth-child(3) {

        height: 148px !important;

        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: flex-start !important;

        padding:
            16px 6px 4px !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {

        width: 100% !important;
        min-height: 44px !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        margin: 0 !important;
        padding: 0 !important;

        text-align: center !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        font-size: 22px !important;
        line-height: 1 !important;
        letter-spacing: 1.2px !important;
        font-weight: 950 !important;

        text-shadow:
            0 3px 6px rgba(0,0,0,.99),
            0 0 11px rgba(0,0,0,.75) !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {

        margin-top: 4px !important;

        min-height: 76px !important;

        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }


    /* =========================================================
       5 — 10 KOMEN TERDAHULU
       ========================================================= */

    .old-comments-panel > .cloud-stage {
        overflow: hidden !important;
    }

    .old-comments-panel > .cloud-stage .cloud {
        width: 190px !important;
        min-height: 104px !important;
        padding: 18px 22px !important;

        backdrop-filter: blur(8px) saturate(140%) !important;
        -webkit-backdrop-filter: blur(8px) saturate(140%) !important;

        border-width: 1.5px !important;

        box-shadow:
            0 14px 32px rgba(15,23,42,.20),
            inset 0 1px 0 rgba(255,255,255,.92) !important;

        color: #122033 !important;
    }

    /* Dialog */
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog {
        border-radius: 18px !important;
        clip-path: none !important;
        padding: 18px 22px !important;

        background:
            linear-gradient(
                145deg,
                rgba(255,250,214,.98),
                rgba(255,220,112,.84)
            ) !important;

        border-color: rgba(245,183,62,.98) !important;
    }

    .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog::before {
        display: block !important;
        content: "" !important;
        left: 28px !important;
        bottom: -12px !important;
        width: 24px !important;
        height: 24px !important;

        background: rgba(255,220,112,.88) !important;
        border-right: 1px solid rgba(245,183,62,.98) !important;
        border-bottom: 1px solid rgba(245,183,62,.98) !important;

        transform: rotate(45deg) !important;
    }


    /* Awan */
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-cloud {
        border-radius:
            52% 48% 46% 54% /
            58% 45% 55% 42% !important;

        background:
            linear-gradient(
                145deg,
                rgba(226,248,255,.98),
                rgba(126,210,255,.82)
            ) !important;

        border-color: rgba(78,166,228,.98) !important;
    }

    .old-comments-panel > .cloud-stage .cloud.cloud-shape-cloud::before {
        display: none !important;
    }


    /* Hati */
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-heart {

        width: 186px !important;
        min-height: 160px !important;

        padding: 34px 28px 26px !important;

        border: 0 !important;
        border-radius: 0 !important;

        clip-path: polygon(
            50% 100%,
            8% 62%,
            0% 38%,
            1% 21%,
            10% 8%,
            24% 2%,
            38% 6%,
            50% 20%,
            62% 6%,
            76% 2%,
            90% 8%,
            99% 21%,
            100% 38%,
            92% 62%
        ) !important;

        background:
            linear-gradient(
                145deg,
                rgba(255,225,234,.99),
                rgba(255,132,169,.86)
            ) !important;

        box-shadow:
            0 14px 30px rgba(125,30,68,.22) !important;
    }

    .old-comments-panel > .cloud-stage .cloud.cloud-shape-heart::before {
        display: none !important;
    }


    /* Rounded / random keempat */
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-round {
        width: 150px !important;
        min-width: 150px !important;
        height: 150px !important;
        min-height: 150px !important;

        padding: 26px 18px !important;

        border-radius: 50% !important;

        background:
            radial-gradient(
                circle at 32% 28%,
                rgba(255,255,255,.98) 0%,
                rgba(220,245,255,.96) 35%,
                rgba(135,211,255,.88) 100%
            ) !important;

        border-color: rgba(72,163,222,.98) !important;
    }

    .old-comments-panel > .cloud-stage .cloud.cloud-shape-round::before {
        display: none !important;
    }


    /* Teks cloud kekal jelas */
    .old-comments-panel > .cloud-stage .cloud-name {
        color: #102033 !important;
        font-size: 14px !important;
        font-weight: 950 !important;
        line-height: 1.24 !important;

        text-shadow:
            0 1px 0 rgba(255,255,255,.90) !important;
    }

    .old-comments-panel > .cloud-stage .cloud-message {
        color: #182433 !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        line-height: 1.34 !important;

        text-shadow:
            0 1px 0 rgba(255,255,255,.78) !important;
    }

    .old-comments-panel > .cloud-stage .cloud .comment-rating {
        font-size: 17px !important;
        letter-spacing: 1px !important;
        font-weight: 950 !important;
    }
}


/* ============================================================
 * TV BESAR
 * ============================================================ */

@media (min-width: 1600px) {

    .old-comments-panel > .stats .event-qr-title {
        font-size: 18px !important;
    }

    .old-comments-panel > .stats .event-qr-subtitle {
        font-size: 13px !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        font-size: 23px !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        font-size: 87px !important;
    }

    .old-comments-panel > .cloud-stage .cloud {
        width: 205px !important;
        min-height: 112px !important;
    }

    .old-comments-panel > .cloud-stage .cloud.cloud-shape-heart {
        width: 200px !important;
        min-height: 172px !important;
    }
}


/* ============================================================
 * TABLET LANDSCAPE
 * ============================================================ */

@media (min-width: 761px) and (max-width: 1100px) {

    .old-comments-panel > .old-comments-heading,
    .latest-comments-panel > .latest-comments-heading,
    .old-comments-panel > .old-comments-caption {
        display: none !important;
    }

    .old-comments-panel > .cloud-stage .cloud-empty {
        display: none !important;
    }

    .old-comments-panel > .stats .event-qr-title {
        font-size: 12px !important;
    }

    .old-comments-panel > .stats .event-qr-subtitle {
        font-size: 8px !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        font-size: 17px !important;
        min-height: 36px !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2),
    .old-comments-panel > .stats > .stat:nth-child(3) {
        padding-top: 10px !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        margin-top: 2px !important;
        min-height: 58px !important;
        font-size: 64px !important;
    }

    .old-comments-panel > .cloud-stage {
        margin-top: 22px !important;
        height: calc(100% - 145px) !important;
    }

    .old-comments-panel > .cloud-stage .cloud {
        width: 165px !important;
        min-height: 92px !important;
        padding: 15px 18px !important;
    }

    .old-comments-panel > .cloud-stage .cloud.cloud-shape-heart {
        width: 160px !important;
        min-height: 138px !important;
        padding: 30px 22px 22px !important;
    }

    .old-comments-panel > .cloud-stage .cloud-name {
        font-size: 13px !important;
    }

    .old-comments-panel > .cloud-stage .cloud-message {
        font-size: 14px !important;
    }
}


/* ============================================================
 * MOBILE
 * ============================================================ */

@media (max-width: 760px) {

    .latest-comments-panel > .latest-comments-heading,
    .old-comments-panel > .old-comments-heading,
    .old-comments-panel > .old-comments-caption {
        display: none !important;
    }

    .old-comments-panel > .cloud-stage .cloud-empty {
        display: none !important;
    }
}
</style>


<style>
/* ============================================================
 * V69 — 4 KEDUDUKAN TAMBAHAN UNTUK 10 CLOUD
 * ============================================================ */

@media (min-width: 901px) {

    .old-comments-panel > .cloud-stage .cloud-pos-1  { left: 3%;  top: 4%; }
    .old-comments-panel > .cloud-stage .cloud-pos-2  { right: 3%; top: 5%; }
    .old-comments-panel > .cloud-stage .cloud-pos-3  { left: 21%; top: 18%; }
    .old-comments-panel > .cloud-stage .cloud-pos-4  { right: 18%; top: 18%; }
    .old-comments-panel > .cloud-stage .cloud-pos-5  { left: 44%; top: 4%; }
    .old-comments-panel > .cloud-stage .cloud-pos-6  { right: 44%; top: 31%; }

    .old-comments-panel > .cloud-stage .cloud-pos-7  { left: 5%;  bottom: 13%; }
    .old-comments-panel > .cloud-stage .cloud-pos-8  { right: 4%; bottom: 13%; }
    .old-comments-panel > .cloud-stage .cloud-pos-9  { left: 29%; bottom: 1%; }
    .old-comments-panel > .cloud-stage .cloud-pos-10 { right: 28%; bottom: 1%; }
}
</style>


<style>
/* ============================================================
 * V70 — QR +40% / EVENT-LOCATION WHITE / DIALOG + CIRCLE
 *
 * HANYA UBAH:
 * - QR + teks QR dibesarkan 40%
 * - EVENT + LOCATION tukar ke putih/kelabu cerah
 * - Animasi komen lama: DIALOG + BULAT sahaja
 * - 10 komen lama dipilih secara rawak setiap looping
 *
 * SEMUA BAHAGIAN LAIN KEKAL.
 * ============================================================ */

@media (min-width: 901px) {

    /* ---------------------------------------------------------
       EVENT + LOCATION — warna sama keluarga putih/kelabu
       dengan nombor flip
       --------------------------------------------------------- */

    .header-right .event,
    .header-right .location {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .55px #3b3b3b !important;

        text-shadow:
            0 3px 5px rgba(0,0,0,.96),
            0 0 10px rgba(255,255,255,.16) !important;
    }

    /* ---------------------------------------------------------
       QR — 40% LEBIH BESAR DARIPADA V69
       V69:
       title    17px
       subtitle 12px
       canvas   60px
       --------------------------------------------------------- */

    .old-comments-panel > .stats > .event-qr-card {
        overflow: visible !important;
        z-index: 50 !important;
    }

    .old-comments-panel > .stats .event-qr-title {
        font-size: 24px !important;
        line-height: 1 !important;
        letter-spacing: 1.2px !important;
        font-weight: 950 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        text-shadow:
            0 3px 6px rgba(0,0,0,.98),
            0 0 12px rgba(255,255,255,.18) !important;

        transform: none !important;
    }

    .old-comments-panel > .stats .event-qr-subtitle {
        font-size: 17px !important;
        line-height: 1 !important;
        letter-spacing: .9px !important;
        font-weight: 950 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        text-shadow:
            0 3px 6px rgba(0,0,0,.98),
            0 0 10px rgba(255,255,255,.16) !important;
    }

    .old-comments-panel > .stats .event-qr-canvas {
        width: 84px !important;
        height: 84px !important;
        margin: 4px auto 0 !important;

        filter:
            drop-shadow(0 2px 5px rgba(255,255,255,.98))
            drop-shadow(0 4px 8px rgba(0,0,0,.78)) !important;
    }

    .old-comments-panel > .stats .event-qr-caption {
        font-size: 10px !important;
        font-weight: 900 !important;
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        text-shadow:
            0 2px 4px rgba(0,0,0,.92) !important;
    }

    /* ---------------------------------------------------------
       BULAT — pastikan bulat penuh
       --------------------------------------------------------- */

    .old-comments-panel > .cloud-stage .cloud.cloud-shape-round {
        width: 150px !important;
        min-width: 150px !important;
        height: 150px !important;
        min-height: 150px !important;

        border-radius: 50% !important;
        padding: 26px 18px !important;
    }

}

/* TV BESAR */
@media (min-width: 1600px) {

    .header-right .event,
    .header-right .location {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .65px #333333 !important;

        text-shadow:
            0 3px 6px rgba(0,0,0,.98),
            0 0 12px rgba(255,255,255,.18) !important;
    }

    .old-comments-panel > .stats .event-qr-title {
        font-size: 25px !important;
    }

    .old-comments-panel > .stats .event-qr-subtitle {
        font-size: 18px !important;
    }

    .old-comments-panel > .stats .event-qr-canvas {
        width: 90px !important;
        height: 90px !important;
    }
}

/* TABLET LANDSCAPE */
@media (min-width: 761px) and (max-width: 1100px) {

    .header-right .event,
    .header-right .location {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .45px #3b3b3b !important;
    }

    .old-comments-panel > .stats .event-qr-title {
        font-size: 17px !important;
    }

    .old-comments-panel > .stats .event-qr-subtitle {
        font-size: 11px !important;
    }

    .old-comments-panel > .stats .event-qr-canvas {
        width: 70px !important;
        height: 70px !important;
    }
}

/* MOBILE */
@media (max-width: 760px) {

    .header-right .event,
    .header-right .location {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .45px #3b3b3b !important;
    }

    .old-comments-panel > .stats .event-qr-title {
        font-size: 16px !important;
    }

    .old-comments-panel > .stats .event-qr-subtitle {
        font-size: 10px !important;
    }

    .old-comments-panel > .stats .event-qr-canvas {
        width: 62px !important;
        height: 62px !important;
    }

    .old-comments-panel > .cloud-stage .cloud.cloud-shape-round {
        width: 130px !important;
        min-width: 130px !important;
        height: 130px !important;
        min-height: 130px !important;
        border-radius: 50% !important;
    }
}
</style>


<style>
/* ============================================================
 * V71 FINAL — QR PINDAH KE KOTAK KIRI HEADER
 *
 * HANYA UBAH:
 * - QR + teks QR dipindahkan ke Header A / kiri.
 * - QR dibesarkan 120% daripada saiz semasa V70:
 *   90px -> 108px untuk TV besar.
 * - QR tanpa panel putih supaya sebati dengan artwork header.
 *
 * YANG LAIN KEKAL.
 * ============================================================ */

@media (min-width: 901px) {

    /* ---------------------------------------------------------
       QR DALAM HEADER A — KOTAK KIRI
       --------------------------------------------------------- */

    .header-left > .event-qr-card {

        position: absolute !important;

        top: 10px !important;
        left: 6% !important;

        width: 190px !important;
        max-width: 190px !important;

        height: auto !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        display: flex !important;
        flex-direction: column !important;

        align-items: center !important;
        justify-content: flex-start !important;

        text-align: center !important;

        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        overflow: visible !important;

        z-index: 20 !important;
    }

    /* Tajuk QR kekal jelas atas artwork. */
    .header-left > .event-qr-card .event-qr-title {

        margin: 0 0 2px !important;

        font-size: 20px !important;
        line-height: 1 !important;

        font-weight: 950 !important;
        letter-spacing: 1px !important;

        white-space: nowrap !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        text-shadow:
            0 3px 6px rgba(0,0,0,.98),
            0 0 10px rgba(0,0,0,.82) !important;
    }

    /* "SCAN UNTUK PENDAFTARAN" */
    .header-left > .event-qr-card .event-qr-subtitle {

        margin: 0 !important;

        font-size: 14px !important;
        line-height: 1 !important;

        font-weight: 950 !important;
        letter-spacing: .8px !important;

        white-space: nowrap !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        text-shadow:
            0 3px 5px rgba(0,0,0,.98) !important;
    }

    /* QR 120% daripada V70 TV: 90px -> 108px */
    .header-left > .event-qr-card .event-qr-canvas {

        display: block !important;

        width: 108px !important;
        height: 108px !important;

        margin: 5px auto 0 !important;

        background: #FFFFFF !important;

        filter:
            drop-shadow(0 2px 5px rgba(255,255,255,.98))
            drop-shadow(0 4px 8px rgba(0,0,0,.82)) !important;
    }

    .header-left > .event-qr-card .event-qr-caption {

        margin: 3px 0 0 !important;

        font-size: 9px !important;
        line-height: 1.1 !important;

        font-weight: 900 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        white-space: nowrap !important;

        text-shadow:
            0 2px 4px rgba(0,0,0,.96) !important;
    }

    .header-left > .event-qr-card .event-qr-error {
        margin-top: 5px !important;
    }
}


/* ============================================================
 * TV BESAR — QR 120% DARIPADA 90px = 108px
 * Kedudukan kekal di kotak kiri Header A.
 * ============================================================ */

@media (min-width: 1600px) {

    .header-left > .event-qr-card {

        top: 10px !important;
        left: 5.8% !important;

        width: 205px !important;
        max-width: 205px !important;
    }

    .header-left > .event-qr-card .event-qr-title {
        font-size: 21px !important;
    }

    .header-left > .event-qr-card .event-qr-subtitle {
        font-size: 15px !important;
    }

    .header-left > .event-qr-card .event-qr-canvas {
        width: 108px !important;
        height: 108px !important;
    }

    .header-left > .event-qr-card .event-qr-caption {
        font-size: 9px !important;
    }
}


/* ============================================================
 * TABLET LANDSCAPE
 * V70 tablet: 70px -> 120% ≈ 84px
 * ============================================================ */

@media (min-width: 761px) and (max-width: 900px) {

    .header-left > .event-qr-card {

        top: 6px !important;
        left: 3% !important;

        width: 155px !important;
        max-width: 155px !important;
    }

    .header-left > .event-qr-card .event-qr-title {
        font-size: 15px !important;
    }

    .header-left > .event-qr-card .event-qr-subtitle {
        font-size: 10px !important;
    }

    .header-left > .event-qr-card .event-qr-canvas {
        width: 84px !important;
        height: 84px !important;
        margin-top: 3px !important;
    }

    .header-left > .event-qr-card .event-qr-caption {
        font-size: 7px !important;
    }
}


/* ============================================================
 * MOBILE
 * QR dikekalkan tetapi dikecilkan supaya tidak menutup
 * keseluruhan Header A yang pendek.
 * ============================================================ */

@media (max-width: 760px) {

    .header-left {
        position: relative !important;
        overflow: visible !important;
    }

    .header-left > .event-qr-card {

        position: absolute !important;

        top: 4px !important;
        left: 5px !important;

        width: 115px !important;
        max-width: 115px !important;

        height: auto !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;

        z-index: 30 !important;
    }

    .header-left > .event-qr-card .event-qr-title {
        font-size: 11px !important;
        white-space: nowrap !important;
    }

    .header-left > .event-qr-card .event-qr-subtitle {
        font-size: 7px !important;
        white-space: nowrap !important;
    }

    .header-left > .event-qr-card .event-qr-canvas {
        width: 72px !important;
        height: 72px !important;
        margin: 2px auto 0 !important;
    }

    .header-left > .event-qr-card .event-qr-caption {
        font-size: 6px !important;
    }
}
</style>


<style>
/* ============================================================
 * V72 FINAL — QR 3X + KOMEN KE KIRI + DIALOG SAHAJA
 *
 * LOCK:
 * - Semua header / artwork / event / location KEKAL.
 * - Tarikh + hari KEKAL.
 * - Flip number KEKAL.
 * - 10 komen terdahulu random + looping KEKAL.
 * - Realtime / slideshow / fungsi lain KEKAL.
 *
 * UBAH SAHAJA:
 * 1. QR diperbesarkan 3X daripada V71:
 *      108px -> 324px (desktop/TV)
 * 2. QR kekal di kiri Header A.
 * 3. Kotak komen terkini ditolak sedikit lagi ke kiri.
 * 4. Semua komen terdahulu dipaksa berbentuk DIALOG BOX sahaja.
 * 5. Warna dialog dipadatkan / dicerahkan supaya lebih jelas.
 * ============================================================ */

@media (min-width: 901px) {

    /* =========================================================
       QR — 3X SAIZ V71
       ========================================================= */

    .header-left {
        overflow: visible !important;
    }

    .header-left > .event-qr-card {
        top: 2px !important;
        left: 1.5% !important;

        width: 360px !important;
        max-width: 360px !important;

        height: auto !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: flex-start !important;

        overflow: visible !important;
        z-index: 60 !important;
    }

    .header-left > .event-qr-card .event-qr-title {
        margin: 0 !important;
        font-size: 24px !important;
        line-height: 1 !important;
        font-weight: 950 !important;
        white-space: nowrap !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        text-shadow:
            0 3px 7px rgba(0,0,0,.98),
            0 0 12px rgba(0,0,0,.85) !important;
    }

    .header-left > .event-qr-card .event-qr-subtitle {
        margin: 2px 0 0 !important;
        font-size: 17px !important;
        line-height: 1 !important;
        font-weight: 950 !important;
        white-space: nowrap !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        text-shadow:
            0 3px 6px rgba(0,0,0,.98) !important;
    }

    /* QR sebenar = 324px */
    .header-left > .event-qr-card .event-qr-canvas {
        display: block !important;

        width: 324px !important;
        height: 324px !important;

        margin: 6px auto 0 !important;

        background: #FFFFFF !important;

        filter:
            drop-shadow(0 2px 6px rgba(255,255,255,.98))
            drop-shadow(0 5px 12px rgba(0,0,0,.88)) !important;
    }

    .header-left > .event-qr-card .event-qr-caption {
        margin: 5px 0 0 !important;
        font-size: 11px !important;
        line-height: 1 !important;
        font-weight: 900 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        white-space: nowrap !important;

        text-shadow:
            0 2px 5px rgba(0,0,0,.98) !important;
    }


    /* =========================================================
       KOMEN TERKINI — TOLAK LAGI KE KIRI
       ========================================================= */

    #latest-comments-container .comment {
        margin-left: -18px !important;
        margin-right: auto !important;
    }


    /* =========================================================
       KOMEN TERDAHULU — DIALOG BOX SAHAJA
       ========================================================= */

    .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog,
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-round {
        width: 190px !important;
        min-width: 190px !important;
        min-height: 104px !important;
        height: auto !important;

        padding: 18px 22px !important;

        border-radius: 18px !important;
        clip-path: none !important;

        background:
            linear-gradient(
                145deg,
                rgba(255,252,220,.99),
                rgba(255,224,105,.94)
            ) !important;

        border: 2px solid rgba(255,199,45,.99) !important;

        box-shadow:
            0 16px 34px rgba(20,22,28,.26),
            inset 0 1px 0 rgba(255,255,255,.98),
            inset 0 -1px 0 rgba(255,255,255,.36) !important;

        color: #102033 !important;
    }

    /* Ekor dialog */
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog::before,
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-round::before {
        display: block !important;
        content: "" !important;

        left: 28px !important;
        bottom: -13px !important;

        width: 24px !important;
        height: 24px !important;

        background: #FFE075 !important;

        border-right: 2px solid rgba(255,199,45,.99) !important;
        border-bottom: 2px solid rgba(255,199,45,.99) !important;

        transform: rotate(45deg) !important;
        z-index: -1 !important;
    }

    /* Nama + mesej lebih terang / pekat */
    .old-comments-panel > .cloud-stage .cloud-name {
        color: #0D1B2A !important;
        font-size: 14px !important;
        font-weight: 950 !important;
        line-height: 1.24 !important;

        text-shadow:
            0 1px 0 rgba(255,255,255,.96) !important;
    }

    .old-comments-panel > .cloud-stage .cloud-message {
        color: #162536 !important;
        font-size: 15px !important;
        font-weight: 850 !important;
        line-height: 1.34 !important;

        text-shadow:
            0 1px 0 rgba(255,255,255,.88) !important;
    }

    .old-comments-panel > .cloud-stage .cloud .comment-rating {
        color: #F59E0B !important;
        font-size: 17px !important;
        font-weight: 950 !important;
        text-shadow:
            0 1px 2px rgba(255,255,255,.72) !important;
    }
}


/* ============================================================
 * TV BESAR
 * ============================================================ */

@media (min-width: 1600px) {

    .header-left > .event-qr-card {
        left: 1.5% !important;
        width: 360px !important;
        max-width: 360px !important;
    }

    .header-left > .event-qr-card .event-qr-title {
        font-size: 26px !important;
    }

    .header-left > .event-qr-card .event-qr-subtitle {
        font-size: 18px !important;
    }

    .header-left > .event-qr-card .event-qr-canvas {
        width: 324px !important;
        height: 324px !important;
    }

    .header-left > .event-qr-card .event-qr-caption {
        font-size: 11px !important;
    }

    #latest-comments-container .comment {
        margin-left: -22px !important;
    }

    .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog,
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-round {
        width: 205px !important;
        min-width: 205px !important;
        min-height: 112px !important;
    }
}


/* ============================================================
 * TABLET LANDSCAPE
 * QR 3X daripada V71 tablet: 84px -> 252px
 * ============================================================ */

@media (min-width: 761px) and (max-width: 900px) {

    .header-left {
        overflow: visible !important;
    }

    .header-left > .event-qr-card {
        top: 0 !important;
        left: 1% !important;
        width: 280px !important;
        max-width: 280px !important;
    }

    .header-left > .event-qr-card .event-qr-title {
        font-size: 17px !important;
    }

    .header-left > .event-qr-card .event-qr-subtitle {
        font-size: 12px !important;
    }

    .header-left > .event-qr-card .event-qr-canvas {
        width: 252px !important;
        height: 252px !important;
    }

    .header-left > .event-qr-card .event-qr-caption {
        font-size: 8px !important;
    }

    #latest-comments-container .comment {
        margin-left: -12px !important;
    }

    .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog,
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-round {
        width: 165px !important;
        min-width: 165px !important;
        min-height: 92px !important;
    }
}


/* ============================================================
 * MOBILE
 * ============================================================ */

@media (max-width: 760px) {

    .header-left {
        overflow: visible !important;
    }

    .header-left > .event-qr-card {
        top: 0 !important;
        left: 2px !important;
        width: 230px !important;
        max-width: 230px !important;
    }

    .header-left > .event-qr-card .event-qr-title {
        font-size: 13px !important;
    }

    .header-left > .event-qr-card .event-qr-subtitle {
        font-size: 8px !important;
    }

    .header-left > .event-qr-card .event-qr-canvas {
        width: 216px !important;
        height: 216px !important;
    }

    .header-left > .event-qr-card .event-qr-caption {
        font-size: 6px !important;
    }

    #latest-comments-container .comment {
        margin-left: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Mobile juga paksa dialog sahaja */
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog,
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-round {
        width: 165px !important;
        min-width: 165px !important;
        min-height: 92px !important;
        border-radius: 18px !important;
        clip-path: none !important;
    }
}
</style>


<style>
/* ============================================================
 * V73 FINAL — QR -40% + KOMEN TERKINI KETENGAH + ROUNDED
 *
 * LOCK:
 * - Semua header / artwork / event / location KEKAL.
 * - Tarikh + hari KEKAL.
 * - Flip number KEKAL.
 * - Realtime / slideshow / 10 komen terdahulu KEKAL.
 * - Saiz lebar 70% kotak komen terkini KEKAL.
 *
 * UBAH SAHAJA:
 * 1. QR dikecilkan 40% daripada saiz V72.
 * 2. Kotak komen terkini digerakkan sedikit ke tengah.
 * 3. Semua bucu kotak komen terkini dipastikan rounded.
 * ============================================================ */

@media (min-width: 901px) {

    /* =========================================================
       QR — 40% LEBIH KECIL
       V72: 324px
       V73: 194px (≈ 60%)
       ========================================================= */

    .header-left > .event-qr-card .event-qr-canvas {
        width: 194px !important;
        height: 194px !important;
    }

    /* =========================================================
       KOMEN TERKINI — KETENGAH SEDIKIT
       Lebar 70% KEKAL.
       ========================================================= */

    #latest-comments-container .comment {
        width: 70% !important;
        max-width: 70% !important;
        margin-left: 7% !important;
        margin-right: auto !important;

        border-radius: 18px !important;
        overflow: hidden !important;
    }
}


/* ============================================================
 * TV BESAR
 * ============================================================ */

@media (min-width: 1600px) {

    .header-left > .event-qr-card .event-qr-canvas {
        width: 194px !important;
        height: 194px !important;
    }

    #latest-comments-container .comment {
        width: 70% !important;
        max-width: 70% !important;
        margin-left: 7% !important;
        margin-right: auto !important;
        border-radius: 18px !important;
        overflow: hidden !important;
    }
}


/* ============================================================
 * TABLET LANDSCAPE
 * ============================================================ */

@media (min-width: 761px) and (max-width: 900px) {

    /* V72: 252px -> V73: ≈151px */
    .header-left > .event-qr-card .event-qr-canvas {
        width: 151px !important;
        height: 151px !important;
    }

    #latest-comments-container .comment {
        width: 70% !important;
        max-width: 70% !important;
        margin-left: 7% !important;
        margin-right: auto !important;
        border-radius: 18px !important;
        overflow: hidden !important;
    }
}


/* ============================================================
 * MOBILE
 * ============================================================ */

@media (max-width: 760px) {

    /* V72: 216px -> V73: ≈130px */
    .header-left > .event-qr-card .event-qr-canvas {
        width: 130px !important;
        height: 130px !important;
    }

    #latest-comments-container .comment {
        width: 100% !important;
        max-width: 100% !important;
        margin-left: 0 !important;
        margin-right: auto !important;
        border-radius: 18px !important;
        overflow: hidden !important;
    }
}
</style>


<style>
/* ============================================================
 * FIE FINAL FIX — KOMEN TERKINI + KOMEN TERDAHULU
 *
 * 1. Kotak Komen Terkini dipanjangkan sedikit.
 * 2. Organisasi dipaksa SATU BARIS.
 * 3. Komen terdahulu kembali WARNA-WARNI.
 * 4. Animasi / kedudukan / fungsi lain KEKAL.
 * ============================================================ */

/* ------------------------------------------------------------
   KOMEN TERKINI
   ------------------------------------------------------------ */

/* Panjangkan kotak komen supaya ruang nama + organisasi lebih luas */
#latest-comments-container .comment {
    width: calc(100% + 26px) !important;
    max-width: none !important;
    margin-right: 0 !important;
}

/* Organisasi sentiasa satu baris */
#latest-comments-container .comment-org {
    display: block !important;
    width: 100% !important;
    max-width: 100% !important;
    white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    line-height: 1.25 !important;
}

/* Nama juga jangan pecah terlalu sempit */
#latest-comments-container .comment-name {
    min-width: 0 !important;
    overflow-wrap: normal !important;
    word-break: normal !important;
}

/* ------------------------------------------------------------
   KOMEN TERDAHULU — WARNA-WARNI
   ------------------------------------------------------------ */

/* Kuning / emas */
.old-comments-panel > .cloud-stage .cloud:nth-child(1) {
    background: linear-gradient(145deg, #fff8c9 0%, #ffd85c 100%) !important;
    border-color: #e4ad22 !important;
}
.old-comments-panel > .cloud-stage .cloud:nth-child(1)::before {
    background: #ffd85c !important;
    border-color: #e4ad22 !important;
}

/* Biru */
.old-comments-panel > .cloud-stage .cloud:nth-child(2) {
    background: linear-gradient(145deg, #e4f6ff 0%, #79caff 100%) !important;
    border-color: #4299d1 !important;
}
.old-comments-panel > .cloud-stage .cloud:nth-child(2)::before {
    background: #79caff !important;
    border-color: #4299d1 !important;
}

/* Ungu */
.old-comments-panel > .cloud-stage .cloud:nth-child(3) {
    background: linear-gradient(145deg, #f4e8ff 0%, #c99aff 100%) !important;
    border-color: #9964cf !important;
}
.old-comments-panel > .cloud-stage .cloud:nth-child(3)::before {
    background: #c99aff !important;
    border-color: #9964cf !important;
}

/* Hijau */
.old-comments-panel > .cloud-stage .cloud:nth-child(4) {
    background: linear-gradient(145deg, #e5fff1 0%, #7de0ad 100%) !important;
    border-color: #45a978 !important;
}
.old-comments-panel > .cloud-stage .cloud:nth-child(4)::before {
    background: #7de0ad !important;
    border-color: #45a978 !important;
}

/* Merah jambu */
.old-comments-panel > .cloud-stage .cloud:nth-child(5) {
    background: linear-gradient(145deg, #ffe8f0 0%, #ff9fbd 100%) !important;
    border-color: #d8668b !important;
}
.old-comments-panel > .cloud-stage .cloud:nth-child(5)::before {
    background: #ff9fbd !important;
    border-color: #d8668b !important;
}

/* Turquoise */
.old-comments-panel > .cloud-stage .cloud:nth-child(6) {
    background: linear-gradient(145deg, #e2fbff 0%, #6fd9df 100%) !important;
    border-color: #3ba6ad !important;
}
.old-comments-panel > .cloud-stage .cloud:nth-child(6)::before {
    background: #6fd9df !important;
    border-color: #3ba6ad !important;
}

/* Jika lebih daripada 6 bubble, ulang palette warna */
.old-comments-panel > .cloud-stage .cloud:nth-child(7) {
    background: linear-gradient(145deg, #fff0df 0%, #ffb76b 100%) !important;
    border-color: #d88932 !important;
}
.old-comments-panel > .cloud-stage .cloud:nth-child(7)::before {
    background: #ffb76b !important;
    border-color: #d88932 !important;
}

.old-comments-panel > .cloud-stage .cloud:nth-child(8) {
    background: linear-gradient(145deg, #e9edff 0%, #9aaeff 100%) !important;
    border-color: #6278d6 !important;
}
.old-comments-panel > .cloud-stage .cloud:nth-child(8)::before {
    background: #9aaeff !important;
    border-color: #6278d6 !important;
}

/* Teks bubble kekal jelas */
.old-comments-panel > .cloud-stage .cloud-name {
    color: #102033 !important;
}

.old-comments-panel > .cloud-stage .cloud-message {
    color: #162536 !important;
}

/* Bintang kekal jelas */
.old-comments-panel > .cloud-stage .cloud .comment-rating {
    color: #f59e0b !important;
}

/* TV besar — kotak komen terkini turut dipanjangkan */
@media (min-width: 1600px) {
    #latest-comments-container .comment {
        width: calc(100% + 30px) !important;
    }
}

/* Mobile — jangan biarkan kotak terkeluar */
@media (max-width: 900px) {
    #latest-comments-container .comment {
        width: 100% !important;
        max-width: 100% !important;
    }
}
</style>


<style>
/* ============================================================
 * FIE — FINAL KEMASKAN KOMEN TERKINI
 *
 * HANYA ubah kawasan 5 Komen Terkini:
 * - Kotak dikecilkan sedikit
 * - Kotak ditarik ke kiri
 * - Ruang kanan cukup untuk rating + BAGUS / TERIMA KASIH
 * - Semua bucu kotak rounded
 * - Nama / organisasi tidak diubah fungsi
 * - Komen terdahulu, animasi, header, QR, counter dll KEKAL
 * ============================================================ */

@media (min-width: 901px) {

    #latest-comments-container .comment {
        width: calc(100% - 22px) !important;
        max-width: calc(100% - 22px) !important;

        /* tarik ke kiri */
        margin-left: -18px !important;
        margin-right: auto !important;

        /* kotak kemas + rounded penuh */
        padding: 14px 16px !important;
        border-radius: 18px !important;
        overflow: hidden !important;

        box-sizing: border-box !important;
    }

    /* Baris nama + rating + BAGUS/TERIMA KASIH */
    #latest-comments-container .comment-topline {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
        gap: 8px !important;
        width: 100% !important;
        min-width: 0 !important;
    }

    /* Nama ambil ruang yang tinggal sahaja */
    #latest-comments-container .comment-topline .comment-name {
        flex: 1 1 auto !important;
        min-width: 0 !important;

        font-size: 20px !important;
        line-height: 1.15 !important;

        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;

        overflow-wrap: normal !important;
        word-break: normal !important;
    }

    /* Bintang sedikit kecil supaya tidak menghimpit */
    #latest-comments-container .comment-topline .comment-rating {
        flex: 0 0 auto !important;
        margin: 0 !important;

        font-size: 17px !important;
        letter-spacing: 1px !important;
        line-height: 1 !important;

        white-space: nowrap !important;
    }

    /* BAGUS / TERIMA KASIH sentiasa nampak penuh */
    #latest-comments-container .rating-feedback {
        flex: 0 0 auto !important;
        margin-left: 2px !important;

        padding: 4px 8px !important;
        gap: 4px !important;

        border-radius: 999px !important;

        font-size: 13px !important;
        line-height: 1 !important;

        white-space: nowrap !important;
        overflow: visible !important;
    }

    #latest-comments-container .rating-feedback-emoji {
        font-size: 18px !important;
        line-height: 1 !important;
    }

    /* Organisasi kekal satu baris */
    #latest-comments-container .comment-org {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;

        margin-top: 5px !important;

        font-size: 15px !important;
        line-height: 1.2 !important;

        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    /* Teks komen sedikit kemas */
    #latest-comments-container .comment-text {
        margin-top: 10px !important;
        font-size: 19px !important;
        line-height: 1.35 !important;
    }
}

/* TV besar — kekalkan bentuk yang sama tetapi beri sedikit ruang tambahan */
@media (min-width: 1600px) {

    #latest-comments-container .comment {
        width: calc(100% - 28px) !important;
        max-width: calc(100% - 28px) !important;
        margin-left: -22px !important;

        padding: 15px 18px !important;
        border-radius: 18px !important;
    }

    #latest-comments-container .comment-topline {
        gap: 9px !important;
    }

    #latest-comments-container .comment-topline .comment-name {
        font-size: 21px !important;
    }

    #latest-comments-container .comment-topline .comment-rating {
        font-size: 18px !important;
    }

    #latest-comments-container .rating-feedback {
        font-size: 13px !important;
        padding: 4px 9px !important;
    }

    #latest-comments-container .comment-text {
        font-size: 20px !important;
    }
}

/* Tablet / skrin kecil — responsive asal kekal */
@media (max-width: 900px) {

    #latest-comments-container .comment {
        width: calc(100% - 8px) !important;
        max-width: calc(100% - 8px) !important;

        margin-left: 0 !important;
        margin-right: auto !important;

        border-radius: 18px !important;
        overflow: hidden !important;
        box-sizing: border-box !important;
    }

    #latest-comments-container .comment-topline {
        gap: 6px !important;
    }

    #latest-comments-container .comment-topline .comment-name {
        min-width: 0 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    #latest-comments-container .rating-feedback {
        flex: 0 0 auto !important;
        white-space: nowrap !important;
    }
}
</style>


<style>
/* ============================================================
 * FIE — FINAL BETUL-BETUL KEMAS
 *
 * HANYA:
 * 1. Kotak Komen Terkini ditarik lagi ke kiri.
 * 2. Kotak dikecilkan sedikit di sebelah kanan supaya
 *    rating + BAGUS / TERIMA KASIH ada ruang.
 * 3. Semua bucu kotak Komen Terkini rounded.
 * 4. Nama, organisasi dan teks komen diberi ruang dari
 *    tepi kotak supaya tidak nampak terhimpit.
 * 5. Background animasi EVENT / LOCATION dicerahkan sedikit.
 *
 * LAIN-LAIN KEKAL.
 * ============================================================ */

/* ------------------------------------------------------------
   KOMEN TERKINI — DESKTOP / TV
   ------------------------------------------------------------ */
@media (min-width: 901px) {

    #latest-comments-container .comment {
        /* penuhkan bahagian kiri, tetapi pendek sedikit di kanan */
        width: calc(100% - 38px) !important;
        max-width: calc(100% - 38px) !important;

        /* tarik kotak lebih rapat ke kiri */
        margin-left: -30px !important;
        margin-right: auto !important;

        /* ruang sebenar antara isi dengan kotak */
        padding: 16px 20px !important;

        /* semua hujung rounded */
        border-radius: 20px !important;
        overflow: hidden !important;

        box-sizing: border-box !important;
    }

    /* Nama + rating + feedback */
    #latest-comments-container .comment-topline {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
        gap: 8px !important;
        width: 100% !important;
        min-width: 0 !important;
    }

    /* Nama ada ruang dari kiri dan tidak pecah */
    #latest-comments-container .comment-topline .comment-name {
        flex: 1 1 auto !important;
        min-width: 0 !important;

        font-size: 20px !important;
        line-height: 1.15 !important;

        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;

        overflow-wrap: normal !important;
        word-break: normal !important;
    }

    /* Rating sedikit kecil supaya feedback tidak terhimpit */
    #latest-comments-container .comment-topline .comment-rating {
        flex: 0 0 auto !important;
        margin: 0 !important;

        font-size: 17px !important;
        letter-spacing: 1px !important;
        line-height: 1 !important;

        white-space: nowrap !important;
    }

    /* BAGUS / TERIMA KASIH */
    #latest-comments-container .rating-feedback {
        flex: 0 0 auto !important;
        margin-left: 2px !important;

        padding: 5px 9px !important;
        gap: 4px !important;

        border-radius: 999px !important;

        font-size: 13px !important;
        line-height: 1 !important;

        white-space: nowrap !important;
        overflow: visible !important;
    }

    #latest-comments-container .rating-feedback-emoji {
        font-size: 18px !important;
        line-height: 1 !important;
    }

    /* Organisasi ada ruang dan kekal satu baris */
    #latest-comments-container .comment-org {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;

        margin-top: 6px !important;

        font-size: 15px !important;
        line-height: 1.2 !important;

        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    /* Komen ada ruang dari kotak */
    #latest-comments-container .comment-text {
        margin-top: 10px !important;
        font-size: 19px !important;
        line-height: 1.35 !important;

        overflow-wrap: break-word !important;
        word-break: normal !important;
    }
}

/* ------------------------------------------------------------
   TV BESAR
   ------------------------------------------------------------ */
@media (min-width: 1600px) {

    #latest-comments-container .comment {
        width: calc(100% - 44px) !important;
        max-width: calc(100% - 44px) !important;
        margin-left: -34px !important;
        margin-right: auto !important;

        padding: 16px 20px !important;
        border-radius: 20px !important;
    }

    #latest-comments-container .comment-topline {
        gap: 9px !important;
    }

    #latest-comments-container .comment-topline .comment-name {
        font-size: 20px !important;
    }

    #latest-comments-container .comment-topline .comment-rating {
        font-size: 17px !important;
    }

    #latest-comments-container .rating-feedback {
        font-size: 13px !important;
        padding: 5px 9px !important;
    }

    #latest-comments-container .comment-text {
        font-size: 19px !important;
    }
}

/* ------------------------------------------------------------
   EVENT / LOCATION — ANIMASI BACKGROUND LEBIH CERAH
   ------------------------------------------------------------ */
.header-right-bg-slide {
    filter: saturate(.95) brightness(1.08) contrast(1.02) !important;
    transition:
        opacity 1.35s ease-in-out,
        transform 4.2s ease-in-out,
        filter 1.35s ease-in-out !important;
}

.header-right-bg-slide.is-active {
    opacity: .42 !important;
}

.header-right-bg-overlay {
    background: linear-gradient(
        180deg,
        rgba(0,48,63,.48),
        rgba(0,55,72,.58)
    ) !important;
}

/* ------------------------------------------------------------
   MOBILE / TABLET — RESPONSIVE KEKAL
   ------------------------------------------------------------ */
@media (max-width: 900px) {

    #latest-comments-container .comment {
        width: calc(100% - 8px) !important;
        max-width: calc(100% - 8px) !important;
        margin-left: 0 !important;
        margin-right: auto !important;

        padding: 15px 18px !important;
        border-radius: 18px !important;
        overflow: hidden !important;
        box-sizing: border-box !important;
    }
}
</style>


<style id="fie-final-comment-box-repair">
/* ============================================================
   FIE FINAL REPAIR
   Komen Terkini:
   - JANGAN negative margin (itu yang menyebabkan nama sebelah
     kiri TERPOTONG seperti screenshot).
   - Kotak penuh dalam kawasan kiri.
   - Semua bucu rounded.
   - Nama ada ruang dari border.
   - Nama tidak dipaksa pecah kerana rating.
   - Rating + feedback kekal di kanan.
   ============================================================ */

#latest-comments-container {
    width: 100% !important;
    max-width: 100% !important;
    padding: 4px 0 4px 0 !important;
    overflow: hidden !important;
}

/* Kotak komen: FULL WIDTH, TIDAK TERPOTONG */
#latest-comments-container .comment {
    width: 100% !important;
    max-width: 100% !important;

    /* PENTING: jangan guna margin-left negatif */
    margin-left: 0 !important;
    margin-right: 0 !important;

    /* ruang isi dengan border */
    padding: 15px 18px !important;

    /* semua penjuru rounded */
    border-radius: 20px !important;

    box-sizing: border-box !important;
    overflow: hidden !important;
}

/* Baris nama + rating */
#latest-comments-container .comment-topline {
    width: 100% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
    gap: 10px !important;
}

/* Nama:
   - satu baris
   - tidak clipped
   - ambil ruang yang ada
*/
#latest-comments-container .comment-topline .comment-name {
    flex: 1 1 auto !important;
    min-width: 0 !important;

    margin: 0 !important;
    padding: 0 !important;

    font-size: clamp(17px, 1.35vw, 22px) !important;
    line-height: 1.2 !important;
    font-weight: 800 !important;

    white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
}

/* Rating jangan mengecil / jangan menolak nama keluar */
#latest-comments-container .comment-topline .comment-rating {
    flex: 0 0 auto !important;
    margin: 0 !important;
    padding: 0 !important;

    font-size: 17px !important;
    line-height: 1 !important;
    letter-spacing: 1px !important;
    white-space: nowrap !important;
}

/* Feedback pill */
#latest-comments-container .rating-feedback {
    flex: 0 0 auto !important;
    margin: 0 0 0 1px !important;
    padding: 5px 9px !important;

    border-radius: 999px !important;

    font-size: 13px !important;
    line-height: 1 !important;
    white-space: nowrap !important;
}

/* Organisasi */
#latest-comments-container .comment-org {
    width: 100% !important;
    margin-top: 6px !important;
    padding: 0 !important;

    font-size: 15px !important;
    line-height: 1.2 !important;

    white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
}

/* Teks komen */
#latest-comments-container .comment-text {
    width: 100% !important;
    margin-top: 9px !important;
    padding: 0 !important;

    font-size: 18px !important;
    line-height: 1.35 !important;

    overflow-wrap: break-word !important;
    word-break: normal !important;
}

/* Panel kiri: gunakan ruang kiri sepenuhnya tanpa mengubah
   susunan panel komen lama */
.latest-comments-panel {
    min-width: 0 !important;
    padding-right: 20px !important;
}

/* TV besar */
@media (min-width: 1500px) {
    #latest-comments-container .comment {
        padding: 15px 20px !important;
        border-radius: 20px !important;
    }

    #latest-comments-container .comment-topline {
        gap: 10px !important;
    }

    #latest-comments-container .comment-topline .comment-name {
        font-size: 20px !important;
    }

    #latest-comments-container .comment-topline .comment-rating {
        font-size: 17px !important;
    }

    #latest-comments-container .rating-feedback {
        font-size: 13px !important;
        padding: 5px 10px !important;
    }

    #latest-comments-container .comment-text {
        font-size: 19px !important;
    }
}

/* ============================================================
   EVENT / LOCATION BACKGROUND
   Lebih CERAH daripada versi sebelumnya tetapi tulisan gold
   kekal jelas.
   ============================================================ */
.header-right-bg-slide {
    filter: saturate(.95) brightness(1.10) contrast(1.02) !important;
}

.header-right-bg-slide.is-active {
    opacity: .42 !important;
}

.header-right-bg-overlay {
    background: linear-gradient(
        180deg,
        rgba(0,48,63,.52),
        rgba(0,55,72,.62)
    ) !important;
}

/* Mobile */
@media (max-width: 900px) {
    .latest-comments-panel {
        padding-right: 0 !important;
    }

    #latest-comments-container .comment {
        width: 100% !important;
        max-width: 100% !important;
        margin-left: 0 !important;
        padding: 14px 16px !important;
        border-radius: 18px !important;
    }
}
</style>


<style id="fie-move-comment-counter-to-x">
/* ============================================================
   FIE — ALIHKAN COUNTER "KOMEN" KE TEMPAT X
   HANYA COUNTER KOMEN DIPINDAHKAN.
   COUNTER PENGUNJUNG, KOTAK KOMEN, BUBBLE, HEADER, QR,
   ANIMASI DAN JAVASCRIPT TIDAK DIUBAH.
   ============================================================ */

@media (min-width: 901px) {

    /* Slot pertama = QR tersembunyi
       Slot kedua = JUMLAH PENGUNJUNG
       Slot ketiga = KOMEN */
    .old-comments-panel > .stats > .stat:nth-child(3) {
        position: relative !important;

        /* Alih ke kanan — ke kawasan yang Fie tandakan X */
        left: 105px !important;
        transform: none !important;

        /* Pastikan counter tidak mengecil */
        z-index: 60 !important;
    }
}

/* Tablet/mobile: jangan bawa offset desktop */
@media (max-width: 900px) {
    .old-comments-panel > .stats > .stat:nth-child(3) {
        left: auto !important;
        transform: none !important;
    }
}


        /* ============================================================
         * V47 — EVENT + LOCATION CINEMATIC SLIDE
         * Event  : kiri -> tengah -> kiri, looping
         * Location: kanan -> tengah -> kanan, looping
         * Tidak mengubah layout / saiz panel B.
         * ============================================================ */

        .header-right .event,
        .header-right .location {
            will-change: transform, opacity;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            transform-style: preserve-3d;
        }

        .header-right .event {
            animation:
                eventSlideCinematic 8.5s
                cubic-bezier(.22,.61,.36,1)
                infinite;
        }

        .header-right .location {
            animation:
                locationSlideCinematic 8.5s
                cubic-bezier(.22,.61,.36,1)
                infinite;
            animation-delay: .8s;
        }

        @keyframes eventSlideCinematic {
            0% {
                opacity: 0;
                transform: translate3d(-125%, 0, 0);
            }

            12% {
                opacity: 1;
                transform: translate3d(-18%, 0, 0);
            }

            24% {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }

            62% {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }

            76% {
                opacity: .96;
                transform: translate3d(-8%, 0, 0);
            }

            88% {
                opacity: .35;
                transform: translate3d(-75%, 0, 0);
            }

            100% {
                opacity: 0;
                transform: translate3d(-125%, 0, 0);
            }
        }

        @keyframes locationSlideCinematic {
            0% {
                opacity: 0;
                transform: translate3d(125%, 0, 0);
            }

            12% {
                opacity: 1;
                transform: translate3d(18%, 0, 0);
            }

            24% {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }

            62% {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }

            76% {
                opacity: .96;
                transform: translate3d(8%, 0, 0);
            }

            88% {
                opacity: .35;
                transform: translate3d(75%, 0, 0);
            }

            100% {
                opacity: 0;
                transform: translate3d(125%, 0, 0);
            }
        }

        /* Mobile/tablet — gerakan sedikit lebih pendek supaya kemas */
        @media (max-width: 760px) {
            .header-right .event {
                animation-duration: 7.5s;
            }

            .header-right .location {
                animation-duration: 7.5s;
                animation-delay: .55s;
            }
        }

        /* Jika pengguna/TV menggunakan reduced motion, kekalkan tulisan statik */
        @media (prefers-reduced-motion: reduce) {
            .header-right .event,
            .header-right .location {
                animation: none !important;
                transform: none !important;
                opacity: 1 !important;
            }
        }

</style>






<style id="fie-event-location-color-cycle-final">
/* ============================================================
 * V50 FINAL — 4 WARNA FONT
 * Tidak sentuh animation slide V47.
 * Warna dikawal terus melalui JavaScript inline !important
 * supaya mengatasi CSS lama yang menetapkan WHITE !important.
 * ============================================================ */
.header-right .event,
.header-right .location {
    transition:
        color .9s ease-in-out,
        -webkit-text-fill-color .9s ease-in-out,
        text-shadow .9s ease-in-out !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const targets = document.querySelectorAll(
        '.header-right .event, .header-right .location'
    );

    if (!targets.length) return;

    const colors = [
        {
            color: '#FFFFFF',
            stroke: '#3b3b3b',
            glow: 'rgba(255,255,255,.18)'
        },
        {
            color: '#FFD700',
            stroke: '#6f5100',
            glow: 'rgba(255,215,0,.34)'
        },
        {
            color: '#E87500',
            stroke: '#7A3200',
            glow: 'rgba(128,0,32,.30)'
        },
        {
            color: '#F1F5F9',
            stroke: '#7d8793',
            glow: 'rgba(255,255,255,.45)'
        }
    ];

    let colorIndex = 0;

    function applyColor(el, item) {
        el.style.setProperty('color', item.color, 'important');
        el.style.setProperty('-webkit-text-fill-color', item.color, 'important');
        el.style.setProperty('-webkit-text-stroke', '.55px ' + item.stroke, 'important');
        el.style.setProperty(
            'text-shadow',
            '0 3px 6px rgba(0,0,0,.96), 0 0 12px ' + item.glow,
            'important'
        );
    }

    // Semua mula dengan PUTIH.
    targets.forEach(function (el) {
        applyColor(el, colors[0]);
    });

    // Tukar: Putih -> Kuning -> Maroon -> Silver -> ulang.
    setInterval(function () {
        colorIndex = (colorIndex + 1) % colors.length;

        targets.forEach(function (el) {
            applyColor(el, colors[colorIndex]);
        });
    }, 3000);
});
</script>


<style id="fie-montserrat-event-location-final">
/* ============================================================
 * FIE FINAL — FONT EVENT + LOCATION
 * EVENT     : Montserrat ExtraBold 800
 * LOCATION  : Montserrat SemiBold 600
 * Kekalkan animation slide + 4 warna sedia ada.
 * ============================================================ */

/* Load Montserrat */
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600;800&display=swap');

.header-right .event,
.header-right .location {
    font-family: 'Montserrat', Arial, Helvetica, sans-serif !important;
    font-style: normal !important;
    font-variant: normal !important;
    text-rendering: geometricPrecision !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
}

.header-right .event {
    font-weight: 800 !important;
    letter-spacing: .75px !important;
}

.header-right .location {
    font-weight: 600 !important;
    letter-spacing: .45px !important;
}

/* Pastikan warna 4-warna + animation sedia ada kekal */
.header-right .event,
.header-right .location {
    animation-play-state: running !important;
}
</style>

<style id="qr-label-white-box-final">
@media (min-width: 901px) {
  .header-left > .event-qr-card .event-qr-title,
  .header-left > .event-qr-card .event-qr-subtitle {
    display: inline-block !important;
    width: fit-content !important;
    max-width: 100% !important;
    background: #ffffff !important;
    color: #000000 !important;
    -webkit-text-fill-color: #000000 !important;
    -webkit-text-stroke: 0 !important;
    text-shadow: none !important;
    border-radius: 4px !important;
    padding: 3px 8px !important;
  }
  .header-left > .event-qr-card .event-qr-title { margin: 0 0 2px !important; }
  .header-left > .event-qr-card .event-qr-subtitle { margin: 0 !important; }
}
</style>


    <style id="guestbook-theme-additions">
        /*
         * THEME ADDITION SAHAJA
         * Kod asal Fie dikekalkan.
         * Layout / JavaScript / QR / Reverb tidak disentuh.
         */

        /* ============================================================
           THEME: GOVERNMENT BLUE
           ============================================================ */
        body.guestbook-theme.theme-government-blue {
            --gb-primary: #0b4f8a;
            --gb-secondary: #1976b8;
            --gb-surface: #ffffff;
            --gb-border: #c7d8e8;
            --gb-text: #12304a;
            --gb-muted: #5d7387;

            background:
                radial-gradient(circle at 50% 0%, rgba(211, 232, 250, .65), transparent 42%),
                linear-gradient(180deg, #eef6ff 0%, #f8fbff 58%, #e8f1f9 100%) !important;
        }

        body.guestbook-theme.theme-government-blue .header-left::after {
            background:
                linear-gradient(
                    180deg,
                    rgba(4, 53, 94, .08) 0%,
                    rgba(11, 79, 138, .12) 52%,
                    rgba(5, 48, 87, .28) 100%
                ) !important;
        }

        body.guestbook-theme.theme-government-blue .header-right {
            background:
                linear-gradient(145deg, #0b4f8a 0%, #1769a5 52%, #0a5d8f 100%)
                !important;
            border-color: rgba(255,255,255,.28) !important;
            border-left-color: #d4af37 !important;
            box-shadow: 0 12px 28px rgba(7, 56, 94, .24) !important;
        }

        body.guestbook-theme.theme-government-blue .header-right .event,
        body.guestbook-theme.theme-government-blue .header-right .location {
            color: #ffffff !important;
            -webkit-text-fill-color: #ffffff !important;
            -webkit-text-stroke: .35px rgba(0, 0, 0, .25) !important;
            text-shadow: 0 2px 5px rgba(0,0,0,.38) !important;
        }

        body.guestbook-theme.theme-government-blue .header-right-bg {
            background: #0a4b7c !important;
        }

        body.guestbook-theme.theme-government-blue .header-right-bg-overlay {
            background:
                linear-gradient(
                    180deg,
                    rgba(4, 45, 78, .72),
                    rgba(6, 67, 108, .82)
                ) !important;
        }

        body.guestbook-theme.theme-government-blue .guestbook {
            background: #164f7e !important;
            border-color: rgba(214, 234, 251, .82) !important;
            box-shadow:
                0 18px 45px rgba(7, 54, 91, .20),
                inset 0 0 0 1px rgba(255,255,255,.25) !important;
        }

        body.guestbook-theme.theme-government-blue .guestbook-bg-slideshow {
            background: #164f7e !important;
        }

        body.guestbook-theme.theme-government-blue .guestbook-bg-shade {
            background:
                linear-gradient(
                    180deg,
                    rgba(6, 44, 76, .30),
                    rgba(9, 63, 101, .48)
                ) !important;
        }

        body.guestbook-theme.theme-government-blue .guestbook-title {
            color: #ffffff !important;
            text-shadow: 0 2px 4px rgba(0,0,0,.35);
        }

        body.guestbook-theme.theme-government-blue .latest-comments-heading span:last-child,
        body.guestbook-theme.theme-government-blue .old-comments-heading span:last-child {
            color: #e8f4ff !important;
            text-shadow: 0 1px 2px rgba(0,0,0,.35);
        }

        body.guestbook-theme.theme-government-blue .datetime-card {
            border-color: #b8cfe3 !important;
            background:
                linear-gradient(180deg, rgba(255,255,255,.99), rgba(239,247,255,.98))
                !important;
            box-shadow:
                0 6px 16px rgba(7,54,91,.16),
                inset 0 1px 0 rgba(255,255,255,.98) !important;
        }

        body.guestbook-theme.theme-government-blue .clock-digit > span,
        body.guestbook-theme.theme-government-blue .date-digit > span,
        body.guestbook-theme.theme-government-blue .flip-digit > span {
            color: #0b4f8a !important;
            border-color: #d3e1ee !important;
        }

        body.guestbook-theme.theme-government-blue .clock-separator,
        body.guestbook-theme.theme-government-blue .date-separator {
            color: #0b4f8a !important;
        }

        body.guestbook-theme.theme-government-blue .event-qr-card,
        body.guestbook-theme.theme-government-blue .stat {
            background: #ffffff !important;
            border-color: #c7d8e8 !important;
            box-shadow: 0 12px 30px rgba(7,54,91,.12) !important;
        }

        body.guestbook-theme.theme-government-blue .event-qr-title,
        body.guestbook-theme.theme-government-blue .stat-label {
            color: #365d79 !important;
        }

        body.guestbook-theme.theme-government-blue .event-qr-subtitle,
        body.guestbook-theme.theme-government-blue .stat-value {
            color: #0b4f8a !important;
        }

        body.guestbook-theme.theme-government-blue .stat::before {
            background: linear-gradient(90deg, #0b4f8a, #2e87c5) !important;
        }

        body.guestbook-theme.theme-government-blue .comment {
            border-color: #cbdceb !important;
            box-shadow: 0 8px 20px rgba(7,54,91,.10) !important;
        }

        body.guestbook-theme.theme-government-blue .comment-name {
            color: #173b57 !important;
        }

        body.guestbook-theme.theme-government-blue .comment-org,
        body.guestbook-theme.theme-government-blue .comment-text {
            color: #48657c !important;
        }

        body.guestbook-theme.theme-government-blue .comment-rating {
            color: #e3a91b !important;
        }

        body.guestbook-theme.theme-government-blue .cloud-stage {
            background: rgba(235, 246, 255, .13) !important;
            border-color: rgba(213, 233, 249, .45) !important;
        }

        /* ============================================================
           THEME: MODERN MELAKA
           ============================================================ */
        body.guestbook-theme.theme-modern-melaka {
            --gb-primary: #0f766e;
            --gb-secondary: #d4a72c;
            --gb-surface: #fffdf8;
            --gb-border: #dbcda8;
            --gb-text: #2d2a24;
            --gb-muted: #6d685d;

            background:
                radial-gradient(circle at 50% 0%, rgba(255, 224, 157, .16), transparent 40%),
                linear-gradient(180deg, #26231f 0%, #312a23 58%, #1f1d1a 100%) !important;
            color: #f7f1e7;
        }

        body.guestbook-theme.theme-modern-melaka .header-left::after {
            background:
                linear-gradient(
                    180deg,
                    rgba(10, 9, 8, .10) 0%,
                    rgba(31, 24, 15, .24) 52%,
                    rgba(16, 13, 10, .52) 100%
                ) !important;
        }

        body.guestbook-theme.theme-modern-melaka .header-right {
            background:
                linear-gradient(145deg, #263b3b 0%, #174e50 52%, #203532 100%)
                !important;
            border-color: rgba(212,175,55,.34) !important;
            border-left-color: #d4af37 !important;
            box-shadow: 0 12px 30px rgba(0,0,0,.30) !important;
        }

        body.guestbook-theme.theme-modern-melaka .header-right .event,
        body.guestbook-theme.theme-modern-melaka .header-right .location {
            color: #f6d878 !important;
            -webkit-text-fill-color: #f6d878 !important;
            -webkit-text-stroke: .35px #5c4300 !important;
            text-shadow:
                0 2px 4px rgba(0,0,0,.62),
                0 0 10px rgba(246,216,120,.12) !important;
        }

        body.guestbook-theme.theme-modern-melaka .header-right-bg {
            background: #1b3535 !important;
        }

        body.guestbook-theme.theme-modern-melaka .header-right-bg-overlay {
            background:
                linear-gradient(
                    180deg,
                    rgba(14, 30, 30, .72),
                    rgba(18, 56, 52, .82)
                ) !important;
        }

        body.guestbook-theme.theme-modern-melaka .guestbook {
            background: #473b2c !important;
            border-color: rgba(231, 202, 116, .72) !important;
            box-shadow:
                0 18px 45px rgba(0,0,0,.34),
                inset 0 0 0 1px rgba(255,255,255,.14) !important;
        }

        body.guestbook-theme.theme-modern-melaka .guestbook-bg-slideshow {
            background: #473b2c !important;
        }

        body.guestbook-theme.theme-modern-melaka .guestbook-bg-shade {
            background:
                linear-gradient(
                    180deg,
                    rgba(28, 21, 12, .34),
                    rgba(23, 18, 12, .62)
                ) !important;
        }

        body.guestbook-theme.theme-modern-melaka .guestbook-title {
            color: #ffe29a !important;
            text-shadow: 0 2px 5px rgba(0,0,0,.55);
        }

        body.guestbook-theme.theme-modern-melaka .latest-comments-heading span:last-child,
        body.guestbook-theme.theme-modern-melaka .old-comments-heading span:last-child {
            color: #f7df9d !important;
            text-shadow: 0 1px 2px rgba(0,0,0,.55);
        }

        body.guestbook-theme.theme-modern-melaka .datetime-card {
            border-color: #bda96f !important;
            background:
                linear-gradient(180deg, rgba(255,252,244,.99), rgba(246,236,213,.98))
                !important;
            box-shadow:
                0 6px 18px rgba(0,0,0,.22),
                inset 0 1px 0 rgba(255,255,255,.98) !important;
        }

        body.guestbook-theme.theme-modern-melaka .clock-digit > span,
        body.guestbook-theme.theme-modern-melaka .date-digit > span,
        body.guestbook-theme.theme-modern-melaka .flip-digit > span {
            color: #315b59 !important;
            border-color: #ddcfab !important;
        }

        body.guestbook-theme.theme-modern-melaka .clock-separator,
        body.guestbook-theme.theme-modern-melaka .date-separator {
            color: #8a6b19 !important;
        }

        body.guestbook-theme.theme-modern-melaka .event-qr-card,
        body.guestbook-theme.theme-modern-melaka .stat {
            background: #fffdf8 !important;
            border-color: #dbcda8 !important;
            box-shadow: 0 12px 30px rgba(0,0,0,.18) !important;
        }

        body.guestbook-theme.theme-modern-melaka .event-qr-title,
        body.guestbook-theme.theme-modern-melaka .stat-label {
            color: #554f43 !important;
        }

        body.guestbook-theme.theme-modern-melaka .event-qr-subtitle,
        body.guestbook-theme.theme-modern-melaka .stat-value {
            color: #0f766e !important;
        }

        body.guestbook-theme.theme-modern-melaka .stat::before {
            background: linear-gradient(90deg, #0f766e, #d4a72c) !important;
        }

        body.guestbook-theme.theme-modern-melaka .comment {
            background: #fffdf8 !important;
            border-color: #e2d6b9 !important;
            box-shadow: 0 8px 20px rgba(0,0,0,.16) !important;
        }

        body.guestbook-theme.theme-modern-melaka .comment-name {
            color: #2d2a24 !important;
        }

        body.guestbook-theme.theme-modern-melaka .comment-org,
        body.guestbook-theme.theme-modern-melaka .comment-text {
            color: #625c51 !important;
        }

        body.guestbook-theme.theme-modern-melaka .comment-rating {
            color: #d39e1e !important;
        }

        body.guestbook-theme.theme-modern-melaka .cloud-stage {
            background: rgba(255, 248, 229, .08) !important;
            border-color: rgba(236, 214, 159, .30) !important;
        }
    </style>


<style id="fie-final-counter-transparent-visible">
/* ============================================================
 * FIE FINAL — JUMLAH PENGUNJUNG + KOMEN
 *
 * FINAL FIX:
 * - Tiada kotak putih
 * - Tiada background / gradient
 * - Tiada border
 * - Tiada shadow
 * - Label + nombor putih
 * - Nombor 50% daripada saiz flip besar V68/V67
 * - Animasi flip KEKAL
 * - Paksa digit sentiasa visible walaupun CSS theme lama
 *   cuba menetapkan background / warna lain.
 * ============================================================ */

@media (min-width: 901px) {

    /* Ruang statistik sendiri juga lutsinar */
    .old-comments-panel > .stats {
        background: transparent !important;
        background-image: none !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    /* Hanya 2 statistik ini: PENGUNJUNG + KOMEN */
    .old-comments-panel > .stats > .stat:nth-child(2),
    .old-comments-panel > .stats > .stat:nth-child(3) {
        width: 135px !important;
        height: 85px !important;
        min-height: 85px !important;

        margin: 0 !important;
        padding: 4px !important;

        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;

        background: transparent !important;
        background-image: none !important;
        border: 0 !important;
        border-color: transparent !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        outline: none !important;
        overflow: visible !important;
    }

    /* Buang garisan/pseudo element lama */
    .old-comments-panel > .stats > .stat:nth-child(2)::before,
    .old-comments-panel > .stats > .stat:nth-child(3)::before,
    .old-comments-panel > .stats > .stat:nth-child(2)::after,
    .old-comments-panel > .stats > .stat:nth-child(3)::after {
        display: none !important;
        content: none !important;
        background: none !important;
        box-shadow: none !important;
    }

    /* Label — 50% kecil, putih, kosong tanpa background */
    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        position: relative !important;
        z-index: 10 !important;

        width: auto !important;
        min-height: 0 !important;
        height: auto !important;

        margin: 0 !important;
        padding: 0 !important;

        display: block !important;

        background: transparent !important;
        background-image: none !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: 0 !important;

        font-size: 11px !important;
        line-height: 1.1 !important;
        font-weight: 900 !important;
        letter-spacing: .7px !important;
        white-space: nowrap !important;
        text-align: center !important;

        text-shadow: none !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* =========================================================
       WRAPPER NOMBOR
       ========================================================= */
    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        position: relative !important;
        z-index: 11 !important;

        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 1px !important;

        width: auto !important;
        min-width: 0 !important;
        height: 46px !important;
        min-height: 46px !important;

        margin: 2px 0 0 !important;
        padding: 0 !important;

        background: transparent !important;
        background-image: none !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        outline: none !important;
        overflow: visible !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: 0 !important;

        font-size: 44px !important;
        line-height: 1 !important;
        font-weight: 950 !important;
        letter-spacing: -.5px !important;

        text-shadow: none !important;
        opacity: 1 !important;
        visibility: visible !important;
        perspective: 700px !important;
    }

    /* =========================================================
       DIGIT — INILAH YANG BUANG KOTAK PUTIH SEBENAR
       ========================================================= */
    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit {
        position: relative !important;
        display: inline-block !important;

        width: .68em !important;
        height: 1.05em !important;
        min-width: 0 !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
        background-image: none !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        outline: none !important;

        opacity: 1 !important;
        visibility: visible !important;
        overflow: visible !important;

        perspective: 700px !important;
        transform-style: preserve-3d !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit > span,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit > span {
        position: absolute !important;
        inset: 0 !important;

        width: 100% !important;
        height: 100% !important;
        min-width: 0 !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        /* TIADA kotak putih langsung */
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        border: 0 !important;
        border-color: transparent !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        outline: none !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: 0 !important;

        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 44px !important;
        line-height: 1 !important;
        font-weight: 950 !important;
        text-align: center !important;

        text-shadow: none !important;
        opacity: 1 !important;
        visibility: visible !important;

        backface-visibility: hidden !important;
        -webkit-backface-visibility: hidden !important;
    }

    /* Current digit sentiasa di atas */
    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit .digit-current,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit .digit-current {
        z-index: 2 !important;
        transform: none !important;
    }

    /* Next digit kekal untuk animasi flip */
    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit .digit-next,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit .digit-next {
        z-index: 1 !important;
        transform: rotateX(90deg) !important;
        transform-origin: center bottom !important;
    }
}

/* TV BESAR — sedikit lebih besar, tetapi masih 50% daripada V68 */
@media (min-width: 1600px) {
    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        font-size: 11px !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        font-size: 44px !important;
        height: 46px !important;
        min-height: 46px !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit > span,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit > span {
        font-size: 44px !important;
    }
}

/* Tablet */
@media (min-width: 761px) and (max-width: 1100px) {
    .old-comments-panel > .stats > .stat:nth-child(2),
    .old-comments-panel > .stats > .stat:nth-child(3) {
        width: 115px !important;
        height: 72px !important;
        min-height: 72px !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        font-size: 9px !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        font-size: 32px !important;
        height: 34px !important;
        min-height: 34px !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit > span,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit > span {
        font-size: 32px !important;
    }
}

/* Mobile */
@media (max-width: 760px) {
    .old-comments-panel > .stats > .stat:nth-child(2),
    .old-comments-panel > .stats > .stat:nth-child(3) {
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        background: transparent !important;
        box-shadow: none !important;
        text-shadow: none !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        background: transparent !important;
        box-shadow: none !important;
        text-shadow: none !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit > span,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit > span {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        background: transparent !important;
        box-shadow: none !important;
        text-shadow: none !important;
    }
}
</style>


<style id="fie-counter-same-as-scan-move-visitor-x">
/* ============================================================
 * FIE FINAL — JUMLAH PENGUNJUNG / KOMEN
 *
 * 1. Background putih pada kedua-dua counter DIBUANG terus.
 * 2. Label + nombor flip dibesarkan dan disamakan secara visual
 *    dengan teks "SCAN UNTUK PENDAFTARAN".
 * 3. Nombor flip kekal sebagai FLIP animation.
 * 4. JUMLAH PENGUNJUNG dialihkan ke kawasan tanda X merah.
 * 5. KOMEN dikekalkan pada slot asal.
 * 6. QR / header / komen / cloud / realtime tidak diubah.
 * ============================================================ */

@media (min-width: 901px) {

    /* ---------------------------------------------------------
       CONTAINER COUNTER — TRANSPARENT
       --------------------------------------------------------- */
    body.guestbook-theme
    .old-comments-panel > .stats {
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    /* ---------------------------------------------------------
       DUA COUNTER — TRANSPARENT SEPENUHNYA
       --------------------------------------------------------- */
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2),
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) {
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        border: 0 !important;
        border-color: transparent !important;
        border-radius: 0 !important;

        box-shadow: none !important;
        outline: none !important;

        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;

        overflow: visible !important;
    }

    /* Buang garisan atas stat */
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2)::before,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3)::before {
        display: none !important;
        content: none !important;
    }


    /* =========================================================
       LABEL
       Samakan saiz secara visual dengan
       "SCAN UNTUK PENDAFTARAN"
       ========================================================= */

    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        width: auto !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;
        border: 0 !important;
        box-shadow: none !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .35px rgba(0,0,0,.70) !important;

        /*
         * V71 QR subtitle = 17px.
         * 21px dipilih supaya pada TV hasil visual sama
         * dengan saiz "SCAN UNTUK PENDAFTARAN" yang dilihat
         * pada paparan semasa.
         */
        font-size: 21px !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        letter-spacing: 1px !important;

        text-align: center !important;
        white-space: nowrap !important;

        text-shadow: none !important;

        opacity: 1 !important;
        visibility: visible !important;
    }


    /* =========================================================
       FLIP NUMBER
       SAIZ VISUAL SAMA DENGAN LABEL / SCAN
       ========================================================= */

    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        display: inline-flex !important;

        align-items: center !important;
        justify-content: center !important;

        gap: 1px !important;

        width: auto !important;
        height: 27px !important;
        min-height: 27px !important;

        margin: 4px 0 0 !important;
        padding: 0 !important;

        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .35px rgba(0,0,0,.70) !important;

        font-size: 21px !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        letter-spacing: 0 !important;

        text-shadow: none !important;

        opacity: 1 !important;
        visibility: visible !important;

        overflow: visible !important;
    }


    /* =========================================================
       FLIP DIGIT — TIADA KOTAK PUTIH LANGSUNG
       ========================================================= */

    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit {
        position: relative !important;

        display: inline-block !important;

        width: .68em !important;
        height: 1.05em !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        overflow: visible !important;
    }

    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit > span,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit > span {
        position: absolute !important;
        inset: 0 !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        width: 100% !important;
        height: 100% !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .35px rgba(0,0,0,.70) !important;

        font-size: 21px !important;
        font-weight: 950 !important;
        line-height: 1 !important;

        text-shadow: none !important;

        opacity: 1 !important;
        visibility: visible !important;

        backface-visibility: hidden !important;
        -webkit-backface-visibility: hidden !important;
    }

    /* Current digit */
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit .digit-current,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit .digit-current {
        z-index: 2 !important;
    }

    /* Next digit — animation FLIP asal dikekalkan */
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit .digit-next,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit .digit-next {
        z-index: 1 !important;
        transform: rotateX(90deg) !important;
        transform-origin: center bottom !important;
    }


    /* =========================================================
       JUMLAH PENGUNJUNG → TANDA X MERAH

       Screenshot 1618px:
       counter asal sekitar x=775
       tanda X sekitar x=920
       offset visual ≈ +105px
       ========================================================= */

    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) {
        position: relative !important;

        left: 105px !important;
        transform: none !important;

        z-index: 80 !important;
    }


    /* KOMEN — KEKALKAN SLOT, JANGAN ALIH */
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) {
        position: relative !important;

        z-index: 80 !important;
    }
}


/* ============================================================
   TV BESAR — sedikit lagi tepat ke arah tanda X
   ============================================================ */

@media (min-width: 1600px) {

    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) {
        left: 105px !important;
    }

    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        font-size: 21px !important;
    }

    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit > span,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit > span {
        font-size: 21px !important;
    }
}


/* ============================================================
   TABLET LANDSCAPE
   ============================================================ */

@media (min-width: 761px) and (max-width: 1100px) {

    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) {
        left: 80px !important;
    }

    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        font-size: 17px !important;
    }

    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit > span,
    body.guestbook-theme
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit > span {
        font-size: 17px !important;
    }
}
</style>



<style id="fie-final-counter-same-as-date-day">
/* ============================================================
 * FIE FINAL — COUNTER SAMA FONT + SAIZ DENGAN TARIKH / HARI
 *
 * RUJUKAN TEPAT:
 * - Tarikh / Hari desktop = Arial, 28px, weight 950
 * - Putih
 * - Stroke gelap
 * - Shadow sama
 *
 * HANYA:
 * 1. JUMLAH PENGUNJUNG
 * 2. NOMBOR PENGUNJUNG
 * 3. KOMEN
 * 4. NOMBOR KOMEN
 *
 * Semua panel kekal transparent.
 * Flip animation KEKAL.
 * ============================================================ */

@media (min-width: 901px) {

    /* Pastikan kedua-dua counter tidak ada kotak */
    .old-comments-panel > .stats > .stat:nth-child(2),
    .old-comments-panel > .stats > .stat:nth-child(3) {
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        overflow: visible !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2)::before,
    .old-comments-panel > .stats > .stat:nth-child(3)::before {
        display: none !important;
        content: none !important;
    }

    /* =========================================================
       LABEL
       SAMA SAIZ + FONT DENGAN TARIKH / HARI
       ========================================================= */

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        display: block !important;

        width: auto !important;
        min-width: max-content !important;
        height: auto !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        border: 0 !important;
        box-shadow: none !important;

        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 28px !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        letter-spacing: 0 !important;
        text-transform: uppercase !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .75px #3b1f0b !important;

        text-align: center !important;
        white-space: nowrap !important;

        text-shadow:
            0 2px 3px rgba(0,0,0,.98),
            0 0 9px rgba(0,0,0,.58) !important;

        opacity: 1 !important;
        visibility: visible !important;
    }

    /* =========================================================
       NOMBOR FLIP
       SAMA SAIZ + FONT DENGAN TARIKH / HARI
       ========================================================= */

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;

        width: auto !important;
        min-width: 0 !important;

        height: 38px !important;
        min-height: 38px !important;

        margin: 4px 0 0 !important;
        padding: 0 !important;

        gap: 2px !important;

        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 28px !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        letter-spacing: 0 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .75px #3b1f0b !important;

        text-shadow:
            0 2px 3px rgba(0,0,0,.98),
            0 0 9px rgba(0,0,0,.58) !important;

        opacity: 1 !important;
        visibility: visible !important;

        overflow: visible !important;
    }

    /* =========================================================
       SETIAP DIGIT FLIP
       ========================================================= */

    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit {
        width: .68em !important;
        height: 1.05em !important;

        min-width: 0 !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        overflow: visible !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit > span,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit > span {
        position: absolute !important;
        inset: 0 !important;

        width: 100% !important;
        height: 100% !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        margin: 0 !important;
        padding: 0 !important;

        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 28px !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        letter-spacing: 0 !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .75px #3b1f0b !important;

        text-shadow:
            0 2px 3px rgba(0,0,0,.98),
            0 0 9px rgba(0,0,0,.58) !important;

        backface-visibility: hidden !important;
        -webkit-backface-visibility: hidden !important;

        opacity: 1 !important;
        visibility: visible !important;
    }

    /* CURRENT DIGIT */
    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit .digit-current,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit .digit-current {
        z-index: 2 !important;
    }

    /* NEXT DIGIT — FLIP KEKAL */
    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit .digit-next,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit .digit-next {
        z-index: 1 !important;
        transform: rotateX(90deg) !important;
        transform-origin: center bottom !important;
    }
}


/* ============================================================
 * TV BESAR
 * TARIKH / HARI DALAM KOD FIE = 28px
 * Jadi counter juga KEKAL 28px.
 * ============================================================ */

@media (min-width: 1600px) {

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label,

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter,

    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit > span,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit > span {
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 28px !important;
        font-weight: 950 !important;
    }
}


/* ============================================================
 * TABLET LANDSCAPE
 * Rujukan tarikh/hari tablet dalam kod Fie = 24px.
 * ============================================================ */

@media (min-width: 761px) and (max-width: 1100px) {

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label,

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter,

    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit > span,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit > span {
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 24px !important;
        font-weight: 950 !important;
    }
}


/* ============================================================
 * MOBILE
 * Rujukan tarikh/hari mobile dalam kod Fie = 22px.
 * ============================================================ */

@media (max-width: 760px) {

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label,

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter,

    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit > span,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit > span {
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 22px !important;
        font-weight: 950 !important;
    }
}
</style>



<style id="fie-premium-display-v74">
/* ============================================================
 * FIE PREMIUM DISPLAY V74
 * REKAAN BERDASARKAN SCREENSHOT RUJUKAN + KOD DISPLAY FIE
 *
 * KEKAL:
 * - Realtime Echo / Reverb
 * - QR generation + URL
 * - Tarikh + Hari flip
 * - Counter pengunjung + komen
 * - Komen terkini realtime
 * - Komen terdahulu + animasi / random / looping
 * - Heritage background slideshow
 *
 * VISUAL:
 * - Header maroon dengan sempadan/margin yang jelas.
 * - Artwork header tidak memenuhi keseluruhan skrin.
 * - Event + lokasi kemas di ruang B.
 * - Semua kandungan utama muat 1 skrin TV LED desktop.
 * - Komen terkini menggunakan SATU warna kuning dalam bentuk dialog box.
 * ============================================================ */

@media (min-width: 901px) {

    html,
    body {
        width: 100% !important;
        height: 100% !important;
        min-height: 100% !important;
        overflow: hidden !important;
    }

    body.guestbook-theme {
        width: 100% !important;
        height: 100vh !important;
        height: 100dvh !important;
        min-height: 0 !important;
        overflow: hidden !important;
        background:
            linear-gradient(180deg,
                #861b24 0%,
                #861b24 46%,
                #f8f2e8 46%,
                #f8f2e8 100%) !important;
    }

    .page {
        position: relative !important;
        width: 100% !important;
        height: 100vh !important;
        height: 100dvh !important;
        min-height: 0 !important;
        overflow: hidden !important;
    }

    /* =========================================================
       HEADER
       ========================================================= */

    .header {
        position: relative !important;
        z-index: 30 !important;
        width: 94vw !important;
        height: 46vh !important;
        min-height: 0 !important;
        margin: 0 auto !important;
        padding: 0 !important;
        overflow: visible !important;
        text-align: center !important;
        background: transparent !important;
    }

    .header-split {
        position: relative !important;
        display: flex !important;
        flex-direction: column !important;
        width: 100% !important;
        height: 46vh !important;
        min-height: 0 !important;
        gap: 0 !important;
        overflow: visible !important;
    }

    .header-split::after,
    .header::after {
        display: none !important;
        content: none !important;
    }

    /* ---------------------------------------------------------
       A — ARTWORK HEADER DENGAN SEMPADAN
       --------------------------------------------------------- */

    .header-left {
        position: relative !important;
        z-index: 2 !important;
        width: 100% !important;
        height: 23vh !important;
        min-height: 0 !important;
        flex: 0 0 23vh !important;
        margin: 0 !important;
        padding: 1.3vh 0 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        overflow: hidden !important;
        background: transparent !important;
        background-image: none !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .header-left::after {
        display: none !important;
        content: none !important;
    }

    .guestbook-header-logo {
        position: relative !important;
        left: auto !important;
        right: auto !important;
        top: auto !important;
        bottom: auto !important;
        z-index: 5 !important;
        width: 100% !important;
        height: 20vh !important;
        max-width: none !important;
        max-height: none !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
        object-fit: cover !important;
        object-position: center 29% !important;
        transform: none !important;
        background: #ffffff !important;
        border: 2px solid rgba(212,175,55,.9) !important;
        border-radius: 18px !important;
        box-shadow:
            0 12px 28px rgba(39,12,16,.26),
            inset 0 1px 0 rgba(255,255,255,.96) !important;
        filter: none !important;
    }

    /* ---------------------------------------------------------
       B — EVENT + LOCATION
       --------------------------------------------------------- */

    .header-right {
        position: relative !important;
        z-index: 3 !important;
        width: 100% !important;
        height: 22vh !important;
        min-height: 0 !important;
        flex: 0 0 22vh !important;
        margin: 0 !important;
        padding: 1vh 4vw 0 !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        gap: .7vh !important;
        text-align: center !important;
        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        overflow: hidden !important;
    }

    .header-right-bg {
        position: absolute !important;
        inset: 0 !important;
        z-index: 0 !important;
        opacity: .07 !important;
        overflow: hidden !important;
        border-radius: 18px !important;
        pointer-events: none !important;
    }

    .header-right-bg-slide {
        object-fit: cover !important;
        object-position: center center !important;
        opacity: 0 !important;
        filter: saturate(.70) brightness(.58) contrast(.96) !important;
    }

    .header-right-bg-slide.is-active { opacity: 1 !important; }

    .header-right-bg-overlay {
        background: linear-gradient(180deg, rgba(134,27,36,.42), rgba(105,19,26,.72)) !important;
    }

    .header-right .event,
    .header-right .location {
        position: relative !important;
        z-index: 4 !important;
        max-width: 92% !important;
        margin: 0 !important;
        padding: 0 !important;
        background: transparent !important;
        text-align: center !important;
        transform: none !important;
        animation: none !important;
        opacity: 1 !important;
        font-family: Arial, Helvetica, sans-serif !important;
        font-weight: 900 !important;
        color: #ffffff !important;
        -webkit-text-fill-color: #ffffff !important;
        -webkit-text-stroke: .35px rgba(36,11,14,.40) !important;
        text-shadow: 0 3px 9px rgba(0,0,0,.42) !important;
    }

    .header-right .event {
        font-size: clamp(23px, 2.55vw, 40px) !important;
        line-height: 1.08 !important;
    }

    .header-right .location {
        color: #f6d878 !important;
        -webkit-text-fill-color: #f6d878 !important;
        font-size: clamp(14px, 1.2vw, 20px) !important;
        line-height: 1.15 !important;
        font-weight: 800 !important;
        letter-spacing: .35px !important;
    }

    /* =========================================================
       REALTIME
       ========================================================= */

    .realtime-status {
        position: fixed !important;
        top: 7px !important;
        left: 10px !important;
        z-index: 9999 !important;
        margin: 0 !important;
        padding: 3px 7px !important;
        border-radius: 999px !important;
        background: rgba(255,255,255,.72) !important;
        box-shadow: 0 2px 8px rgba(0,0,0,.08) !important;
        font-size: 9px !important;
    }

    /* =========================================================
       GUESTBOOK / BAHAGIAN BAWAH
       ========================================================= */

    .guestbook {
        position: absolute !important;
        z-index: 40 !important;
        left: 2.7vw !important;
        right: 2.7vw !important;
        top: 44.6vh !important;
        bottom: 1.7vh !important;
        width: auto !important;
        height: auto !important;
        min-height: 0 !important;
        margin: 0 !important;
        padding: 1.55vh 1.7vw 1vh !important;
        background: rgba(255,252,246,.985) !important;
        border: 1px solid #e2cfb1 !important;
        border-radius: 18px !important;
        box-shadow:
            0 18px 44px rgba(61,37,27,.13),
            inset 0 1px 0 rgba(255,255,255,.95) !important;
        overflow: hidden !important;
        isolation: isolate !important;
    }

    .guestbook-bg-slideshow { opacity: .055 !important; }
    .guestbook-bg-shade { background: rgba(255,250,242,.65) !important; }
    .guestbook-bg-slide { filter: saturate(.72) brightness(1.16) !important; }

    .guestbook-heading-row {
        height: 6.7vh !important;
        min-height: 0 !important;
        display: flex !important;
        align-items: end !important;
        justify-content: flex-start !important;
        margin: 0 0 .4vh !important;
        padding: 0 !important;
    }

    .guestbook-kicker {
        margin: 0 0 .15vh !important;
        color: #861b24 !important;
        font-size: clamp(9px, .72vw, 12px) !important;
        font-weight: 900 !important;
        letter-spacing: .10em !important;
        text-transform: uppercase !important;
    }

    .guestbook-title {
        min-width: 0 !important;
        margin: 0 !important;
        color: #3d251b !important;
        font-size: clamp(20px, 2vw, 31px) !important;
        font-weight: 900 !important;
        line-height: 1.02 !important;
        white-space: nowrap !important;
    }

    /* =========================================================
       COLUMNS
       ========================================================= */

    .guestbook-columns {
        display: grid !important;
        grid-template-columns: minmax(0,.96fr) minmax(0,1.04fr) !important;
        gap: 1.5vw !important;
        width: 100% !important;
        height: calc(100% - 7.1vh) !important;
        min-height: 0 !important;
    }

    .latest-comments-panel {
        min-width: 0 !important;
        height: 100% !important;
        padding: 0 1vw 0 0 !important;
        overflow: hidden !important;
    }

    .latest-comments-heading,
    .old-comments-heading,
    .old-comments-caption {
        display: none !important;
    }

    #latest-comments-container {
        width: 100% !important;
        height: 100% !important;
        max-height: none !important;
        padding: .25vh 0 !important;
        overflow: hidden !important;
    }

    /* =========================================================
       KOMEN TERKINI — KUNING DIALOG BOX SAHAJA
       ========================================================= */

    #latest-comments-container .comment,
    #latest-comments-container .comment:nth-child(n) {
        width: 94% !important;
        max-width: 94% !important;
        margin: 0 auto 1vh !important;
        padding: 1.0vh 1.05vw !important;
        background: linear-gradient(145deg,#fff9d9 0%,#ffe27a 100%) !important;
        background-color: #ffe27a !important;
        background-image: linear-gradient(145deg,#fff9d9 0%,#ffe27a 100%) !important;
        border: 1px solid #d3a329 !important;
        border-radius: 18px !important;
        box-shadow:
            0 7px 16px rgba(120,82,8,.13),
            inset 0 1px 0 rgba(255,255,255,.90) !important;
        overflow: hidden !important;
        color: #3e2d16 !important;
    }

    #latest-comments-container .comment-topline {
        width: 100% !important;
        display: flex !important;
        align-items: center !important;
        gap: .45vw !important;
    }

    #latest-comments-container .comment-topline .comment-name {
        flex: 1 1 auto !important;
        min-width: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        color: #3a2a18 !important;
        font-size: clamp(15px,1.08vw,20px) !important;
        font-weight: 900 !important;
        line-height: 1.08 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    #latest-comments-container .comment-topline .comment-rating {
        flex: 0 0 auto !important;
        margin: 0 !important;
        color: #ce8b00 !important;
        font-size: clamp(12px,.88vw,16px) !important;
        letter-spacing: .5px !important;
        white-space: nowrap !important;
    }

    #latest-comments-container .rating-feedback {
        flex: 0 0 auto !important;
        margin: 0 !important;
        padding: 3px 7px !important;
        border-radius: 999px !important;
        background: rgba(255,255,255,.52) !important;
        border: 1px solid rgba(185,128,11,.30) !important;
        color: #6e4a05 !important;
        font-size: clamp(9px,.65vw,12px) !important;
        font-weight: 900 !important;
        white-space: nowrap !important;
    }

    #latest-comments-container .rating-feedback-emoji {
        font-size: clamp(12px,.78vw,16px) !important;
    }

    #latest-comments-container .comment-org {
        width: 100% !important;
        margin-top: .38vh !important;
        color: #735b2f !important;
        font-size: clamp(9px,.72vw,13px) !important;
        font-weight: 700 !important;
        line-height: 1.12 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    #latest-comments-container .comment-text {
        width: 100% !important;
        margin-top: .45vh !important;
        color: #4c3920 !important;
        font-size: clamp(11px,.88vw,16px) !important;
        font-weight: 700 !important;
        line-height: 1.23 !important;
        overflow-wrap: break-word !important;
    }

    /* =========================================================
       PANEL KANAN
       ========================================================= */

    .old-comments-panel {
        position: relative !important;
        min-width: 0 !important;
        height: 100% !important;
        padding: 5vh 0 0 !important;
        border-left: 1px solid #e5d6bf !important;
        overflow: hidden !important;
        background: transparent !important;
    }

    /* DATE + DAY — small strip at top-right */
    .old-comments-panel > .header-b-meta {
        position: absolute !important;
        top: .2vh !important;
        right: 0 !important;
        z-index: 50 !important;
        width: auto !important;
        height: 4.2vh !important;
        margin: 0 !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: flex-end !important;
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
        pointer-events: none !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date-wrap {
        display: flex !important;
        align-items: center !important;
        gap: .5vw !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date-card,
    .old-comments-panel > .header-b-meta .header-b-date,
    .old-comments-panel > .header-b-meta .day-flip-display {
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date-card {
        width: auto !important;
        height: auto !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date {
        display: inline-flex !important;
        align-items: center !important;
        gap: 1px !important;
        min-height: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .old-comments-panel > .header-b-meta .date-digit,
    .old-comments-panel > .header-b-meta .day-flip-letter {
        width: 17px !important;
        height: 24px !important;
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    .old-comments-panel > .header-b-meta .date-digit > span,
    .old-comments-panel > .header-b-meta .date-separator,
    .old-comments-panel > .header-b-meta .day-flip-letter > span {
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 17px !important;
        font-weight: 950 !important;
        color: #861b24 !important;
        -webkit-text-fill-color: #861b24 !important;
        -webkit-text-stroke: .3px #5d381e !important;
        text-shadow: 0 1px 2px rgba(255,255,255,.95) !important;
    }

    .old-comments-panel > .header-b-meta .date-separator {
        width: 6px !important;
        height: 24px !important;
    }

    .old-comments-panel > .header-b-meta .day-flip-display {
        min-height: 24px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 1px !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* =========================================================
       QR + PENGUNJUNG + KOMEN
       ========================================================= */

    .old-comments-panel > .stats {
        position: relative !important;
        top: auto !important;
        right: auto !important;
        left: auto !important;
        width: 100% !important;
        height: 12vh !important;
        min-height: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        display: grid !important;
        grid-template-columns: 1.10fr .95fr .95fr !important;
        gap: .65vw !important;
        background: transparent !important;
        overflow: hidden !important;
    }

    .old-comments-panel > .stats > .event-qr-card,
    .old-comments-panel > .stats > .stat {
        position: relative !important;
        top: auto !important;
        left: auto !important;
        right: auto !important;
        transform: none !important;
        width: 100% !important;
        height: 12vh !important;
        min-width: 0 !important;
        min-height: 0 !important;
        margin: 0 !important;
        padding: .5vh .5vw !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        background: linear-gradient(180deg,#ffffff 0%,#fbf5ea 100%) !important;
        border: 1px solid #dbc6a6 !important;
        border-radius: 14px !important;
        box-shadow: 0 6px 15px rgba(61,37,27,.08) !important;
        overflow: hidden !important;
    }

    .old-comments-panel > .stats > .stat::before {
        display: none !important;
        content: none !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        margin: 0 !important;
        color: #861b24 !important;
        -webkit-text-fill-color: #861b24 !important;
        font-size: clamp(8px,.62vw,11px) !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        white-space: nowrap !important;
        text-shadow: none !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
        margin: .1vh 0 0 !important;
        color: #8a6b30 !important;
        -webkit-text-fill-color: #8a6b30 !important;
        font-size: clamp(6px,.46vw,8px) !important;
        font-weight: 900 !important;
        line-height: 1 !important;
        white-space: nowrap !important;
        text-shadow: none !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 7.5vh !important;
        height: 7.5vh !important;
        margin: .18vh auto 0 !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-caption,
    .old-comments-panel > .stats > .event-qr-card .event-qr-error {
        display: none !important;
    }

    .old-comments-panel > .stats > .stat .stat-label {
        margin: 0 !important;
        padding: 0 !important;
        color: #7a6554 !important;
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: clamp(8px,.60vw,11px) !important;
        font-weight: 900 !important;
        line-height: 1 !important;
        letter-spacing: .035em !important;
        text-transform: uppercase !important;
        white-space: nowrap !important;
        text-shadow: none !important;
    }

    .old-comments-panel > .stats > .stat .stat-value.flip-counter {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: auto !important;
        height: 6.2vh !important;
        min-height: 0 !important;
        margin: .15vh 0 0 !important;
        padding: 0 !important;
        gap: 1px !important;
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
        color: #861b24 !important;
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: clamp(20px,2.15vw,32px) !important;
        font-weight: 950 !important;
        line-height: 1 !important;
    }

    .old-comments-panel > .stats > .stat .flip-digit {
        width: .61em !important;
        height: 1em !important;
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    .old-comments-panel > .stats > .stat .flip-digit > span {
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
        color: #861b24 !important;
        -webkit-text-fill-color: #861b24 !important;
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: clamp(20px,2.15vw,32px) !important;
        font-weight: 950 !important;
        text-shadow: none !important;
    }

    /* =========================================================
       KOMEN TERDAHULU — KEKAL DALAM SATU RUANG
       ========================================================= */

    .old-comments-panel > .cloud-stage {
        position: relative !important;
        width: 100% !important;
        height: calc(100% - 12vh) !important;
        min-height: 0 !important;
        margin: .55vh 0 0 !important;
        padding: .2vh .15vw !important;
        overflow: hidden !important;
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
        border-radius: 0 !important;
    }

    .old-comments-panel > .cloud-stage .cloud,
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog,
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-round {
        width: 185px !important;
        min-width: 185px !important;
        min-height: 90px !important;
        padding: 14px 17px !important;
        border-radius: 18px !important;
        clip-path: none !important;
        shape-outside: none !important;
        box-shadow: 0 8px 18px rgba(61,37,27,.10) !important;
    }

    .old-comments-panel > .cloud-stage .cloud-name {
        font-size: 12px !important;
        line-height: 1.13 !important;
        font-weight: 900 !important;
    }

    .old-comments-panel > .cloud-stage .cloud-message {
        margin-top: 4px !important;
        font-size: 13px !important;
        line-height: 1.28 !important;
        font-weight: 700 !important;
    }

    .old-comments-panel > .cloud-stage .cloud .comment-rating {
        font-size: 12px !important;
    }
}

/* ============================================================
 * TV BESAR
 * ============================================================ */
@media (min-width: 1600px) {
    .guestbook { left: 2.4vw !important; right: 2.4vw !important; }
    .old-comments-panel > .cloud-stage .cloud,
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog,
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-round {
        width: 200px !important;
        min-width: 200px !important;
        min-height: 96px !important;
    }
}

/* ============================================================
 * TABLET LANDSCAPE
 * ============================================================ */
@media (min-width: 761px) and (max-width: 900px) {
    .header { height: 420px !important; }
    .header-split { height: 420px !important; }
    .header-left { height: 210px !important; flex-basis: 210px !important; }
    .header-right { height: 210px !important; flex-basis: 210px !important; }
    .guestbook {
        position: relative !important;
        top: auto !important;
        left: auto !important;
        right: auto !important;
        bottom: auto !important;
        width: calc(100% - 36px) !important;
        height: auto !important;
        margin: 16px auto 20px !important;
    }
}
</style>


<style id="fie-v77-display-final-fix">
/* ============================================================
 * FIE V77 — FINAL DISPLAY FIX
 *
 * BASE:
 * Guna TERUS kod asal Fie yang dimuat naik.
 *
 * SAHAJA YANG DIUBAH:
 * 1. Header dibesarkan sedikit ke bawah supaya "GUESTBOOK"
 *    nampak penuh.
 * 2. QR = 130% daripada 194px (252px), tanpa kotak.
 * 3. Tarikh + Hari = MAROON.
 * 4. Jumlah Pengunjung + Komen + nombor flip = MAROON.
 * 5. Background slideshow 7 gambar Melaka diterangkan semula
 *    dan kelihatan jelas di belakang KOMEN TERKINI + KOMEN TERDAHULU.
 * 6. Tajuk dipaparkan sebagai "KOMEN TERKINI".
 *
 * JANGAN ubah Reverb / Echo / Controller / fungsi JS asal.
 * ============================================================ */

/* ============================================================
   1 — HEADER: BESAR SEDIKIT + NAMPakkan "GUESTBOOK"
   ============================================================ */
@media (min-width: 761px) {

    .header {
        height: calc(17vw + 80px) !important;
        min-height: 0 !important;
        overflow: visible !important;
    }

    .header-split {
        height: calc(17vw + 80px) !important;
        min-height: 0 !important;
    }

    .header-left {
        height: 17vw !important;
        min-height: 0 !important;
        flex: 0 0 17vw !important;
        overflow: hidden !important;
    }

    .guestbook-header-logo {
        width: 100% !important;
        height: 100% !important;
        max-width: none !important;
        max-height: none !important;
        object-fit: cover !important;

        /*
         * Sedikit turunkan viewport imej supaya bahagian bawah
         * perkataan GUESTBOOK lebih jelas.
         */
        object-position: center 65% !important;
    }

    /*
     * Kekalkan ruang B dalam header, jangan ganggu fungsi lain.
     */
    .header-right {
        height: 80px !important;
        min-height: 80px !important;
        flex: 0 0 80px !important;
    }
}

/* TV besar */
@media (min-width: 1600px) {

    .header {
        height: calc(17vw + 80px) !important;
    }

    .header-split {
        height: calc(17vw + 80px) !important;
    }

    .header-left {
        height: 17vw !important;
        flex-basis: 17vw !important;
    }

    .guestbook-header-logo {
        object-fit: cover !important;
        object-position: center 65% !important;
    }
}


/* ============================================================
   2 — QR: 130% + TIADA KOTAK KELILING
   ============================================================ */

/*
 * QR masih menggunakan struktur asal Fie:
 * .event-qr-card di dalam .stats.
 * Kita buang background / border / shadow kotak sahaja.
 */
.old-comments-panel > .stats > .event-qr-card {
    background: transparent !important;
    background-color: transparent !important;
    background-image: none !important;

    border: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;

    outline: none !important;

    padding: 0 !important;
}

/* QR title/subtitle kekal jelas tanpa kotak. */
.old-comments-panel > .stats > .event-qr-card .event-qr-title,
.old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
    background: transparent !important;
    border: 0 !important;
    text-shadow: 0 2px 4px rgba(255,255,255,.82) !important;
}

/*
 * 194px asal -> 252px (lebih kurang 130%).
 * Gunakan CSS hanya sebagai reinforcement kepada QRCode.toCanvas().
 */
.old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
    width: 252px !important;
    height: 252px !important;
    max-width: none !important;
    max-height: none !important;
    display: block !important;
    margin: 4px auto 0 !important;
}


/* ============================================================
   3 — TARIKH + HARI = MAROON
   ============================================================ */

.old-comments-panel > .header-b-meta .header-b-date .date-digit > span,
.old-comments-panel > .header-b-meta .header-b-date .date-separator,
.old-comments-panel > .header-b-meta .day-flip-letter > span {
    color: #861b24 !important;
    -webkit-text-fill-color: #861b24 !important;
    -webkit-text-stroke-color: #5d1a22 !important;

    text-shadow:
        0 1px 2px rgba(255,255,255,.96),
        0 1px 2px rgba(134,27,36,.18) !important;
}

/* Pastikan box flip tarikh/hari tidak hilangkan warna maroon. */
.old-comments-panel > .header-b-meta .header-b-date-card,
.old-comments-panel > .header-b-meta .header-b-date,
.old-comments-panel > .header-b-meta .day-flip-display {
    color: #861b24 !important;
}


/* ============================================================
   4 — JUMLAH PENGUNJUNG + KOMEN = MAROON
       TERMASUK NOMBOR FLIP
   ============================================================ */

.old-comments-panel > .stats > .stat .stat-label,
.old-comments-panel > .stats > .stat .stat-value.flip-counter,
.old-comments-panel > .stats > .stat .flip-digit > span,
#visitor-count,
#comment-count {
    color: #861b24 !important;
    -webkit-text-fill-color: #861b24 !important;
    -webkit-text-stroke-color: #5d1a22 !important;
    text-shadow:
        0 1px 2px rgba(255,255,255,.96),
        0 1px 2px rgba(134,27,36,.18) !important;
}

/*
 * JS "copy exact style" asal Fie mengambil gaya daripada TARIKH.
 * Oleh sebab TARIKH sekarang maroon, counter juga akan ikut maroon.
 */


/* ============================================================
   5 — BACKGROUND SLIDESHOW:
       TERANG + JELAS DI BELAKANG KOMEN
   ============================================================ */

/*
 * Ini menggunakan slideshow asal Fie:
 * #guestbook-bg-slideshow
 * dan JavaScript asal Fie yang menukar gambar setiap 4 saat.
 *
 * Kita cuma keluarkan semula opacity yang terlalu rendah.
 */
.guestbook {
    background: rgba(255,252,246,.40) !important;
    background-color: rgba(255,252,246,.40) !important;
}

/* Gambar slideshow sangat jelas tetapi masih ada lapisan
   lembut supaya tulisan / komen kekal mudah dibaca. */
.guestbook-bg-slideshow {
    opacity: 1 !important;
    z-index: 0 !important;
}

.guestbook-bg-slide {
    opacity: 0 !important;

    filter:
        saturate(1.18)
        brightness(1.15)
        contrast(1.02) !important;

    transform: scale(1.03) !important;

    transition:
        opacity 1.15s ease-in-out,
        transform 4.5s ease-in-out !important;

    will-change: opacity, transform;
}

.guestbook-bg-slide.is-active {
    opacity: .50 !important;
    transform: scale(1) !important;
}

/* Light overlay sahaja — bukan menutup gambar. */
.guestbook-bg-shade {
    background:
        linear-gradient(
            180deg,
            rgba(255,255,255,.14),
            rgba(255,248,230,.18)
        ) !important;
}

/*
 * Pastikan kedua-dua kawasan komen benar-benar transparent
 * supaya animasi gambar belakang boleh dilihat.
 */
.latest-comments-panel,
.old-comments-panel,
#latest-comments-container,
.old-comments-panel > .cloud-stage {
    background: transparent !important;
}


/* ============================================================
   6 — KOMEN TERKINI:
       KUNING SAHAJA + GAMBAR BELAKANG BOLEH DILIHAT
   ============================================================ */

#latest-comments-container .comment,
#latest-comments-container .comment:nth-child(n) {
    background:
        linear-gradient(
            145deg,
            rgba(255,249,217,.94) 0%,
            rgba(255,226,122,.94) 100%
        ) !important;

    background-color: rgba(255,226,122,.94) !important;

    border: 1px solid rgba(211,163,41,.96) !important;
    border-radius: 18px !important;

    box-shadow:
        0 8px 18px rgba(120,82,8,.18),
        inset 0 1px 0 rgba(255,255,255,.92) !important;
}


/* ============================================================
   7 — TAJUK
   ============================================================ */

/* HTML asal sudah ditukar kepada KOMEN TERKINI.
   Selector ini hanya mengukuhkan gaya. */
.guestbook-kicker {
    color: #861b24 !important;
}


/* ============================================================
   RESPONSIVE QR
   ============================================================ */

/* Desktop/TV utama — QR 252px. */
@media (min-width: 901px) {
    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 252px !important;
        height: 252px !important;
    }
}

/* Tablet — kekalkan kadar lebih kecil supaya tidak pecah layout. */
@media (min-width: 761px) and (max-width: 900px) {
    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 184px !important;
        height: 184px !important;
    }
}

/* Mobile */
@media (max-width: 760px) {

    .guestbook-bg-slide {
        opacity: 0 !important;
    }

    .guestbook-bg-slide.is-active {
        opacity: .38 !important;
    }

    .old-comments-panel > .stats > .event-qr-card {
        overflow: visible !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 130px !important;
        height: 130px !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-digit > span,
    .old-comments-panel > .header-b-meta .header-b-date .date-separator,
    .old-comments-panel > .header-b-meta .day-flip-letter > span,
    .old-comments-panel > .stats > .stat .stat-label,
    .old-comments-panel > .stats > .stat .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat .flip-digit > span {
        color: #861b24 !important;
        -webkit-text-fill-color: #861b24 !important;
    }
}
</style>


<style id="fie-v78-tv-precision-fix">
/* ============================================================
 * FIE V78 — TV DISPLAY PRECISION FIX
 *
 * BASE:
 * Guna 100% kod asal Fie daripada Pasted text 20260928-205419.txt
 * dan hanya override perkara yang diminta.
 *
 * 1. HEADER dinaikkan/ditetapkan supaya bahagian artwork berhenti
 *    pada garisan pemisah dan EVENT + LOCATION dapat ruang sendiri.
 * 2. QR 50% daripada saiz V77 (252px -> 126px), tanpa kotak.
 * 3. TARIKH + HARI + COUNTER = PUTIH.
 * 4. Background gambar animasi KOMEN TERKINI + TERDAHULU:
 *    lebih pekat, lebih saturated, opacity lebih tinggi.
 * 5. Event + Location kekal besar dan mudah dibaca.
 * ============================================================ */

@media (min-width: 1101px) {

    /* =========================================================
       1 — HEADER
       Artwork A berhenti lebih awal; B dapat ruang penuh
       untuk EVENT + LOCATION.
       ========================================================= */

    .header {
        height: 39vh !important;
        min-height: 0 !important;
        margin: 0 auto !important;
        overflow: visible !important;
    }

    .header-split {
        height: 39vh !important;
        min-height: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 0 !important;
        overflow: visible !important;
    }

    .header-left {
        width: 100% !important;
        height: 27vh !important;
        min-height: 0 !important;
        flex: 0 0 27vh !important;
        margin: 0 !important;
        padding: 1.1vh 0 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        overflow: hidden !important;
        background: transparent !important;
    }

    .guestbook-header-logo {
        position: relative !important;
        left: auto !important;
        top: auto !important;
        right: auto !important;
        bottom: auto !important;

        width: 100% !important;
        height: 25.5vh !important;
        max-width: none !important;
        max-height: none !important;

        margin: 0 !important;
        padding: 0 !important;

        object-fit: cover !important;

        /*
         * Fokus sedikit ke bahagian bawah artwork supaya
         * perkataan GUESTBOOK keluar penuh.
         */
        object-position: center 68% !important;

        border: 2px solid rgba(212,175,55,.92) !important;
        border-radius: 18px !important;

        box-shadow:
            0 12px 28px rgba(39,12,16,.26),
            inset 0 1px 0 rgba(255,255,255,.96) !important;

        filter: none !important;
        background: #ffffff !important;
    }

    /* =========================================================
       B — EVENT + LOCATION
       ========================================================= */

    .header-right {
        width: 100% !important;
        height: 12vh !important;
        min-height: 12vh !important;
        flex: 0 0 12vh !important;

        margin: 0 !important;
        padding: .3vh 3vw .5vh !important;

        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;

        gap: .45vh !important;
        overflow: visible !important;

        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .header-right-bg {
        position: absolute !important;
        inset: 0 !important;
        z-index: 0 !important;
        opacity: .16 !important;
        overflow: hidden !important;
        border-radius: 0 !important;
        pointer-events: none !important;
    }

    .header-right-bg-slide {
        object-fit: cover !important;
        object-position: center center !important;
        opacity: 0 !important;
        filter: saturate(.80) brightness(.72) contrast(1.02) !important;
    }

    .header-right-bg-slide.is-active {
        opacity: 1 !important;
    }

    .header-right-bg-overlay {
        background:
            linear-gradient(
                180deg,
                rgba(134,27,36,.30),
                rgba(105,19,26,.58)
            ) !important;
    }

    .header-right .event {
        position: relative !important;
        z-index: 5 !important;

        width: 100% !important;
        max-width: 96% !important;
        margin: 0 !important;
        padding: 0 !important;

        font-size: clamp(22px, 2.40vw, 40px) !important;
        line-height: 1.04 !important;
        letter-spacing: .7px !important;

        text-align: center !important;
        white-space: normal !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .55px rgba(60,8,14,.72) !important;

        text-shadow:
            0 3px 7px rgba(0,0,0,.92),
            0 0 11px rgba(255,255,255,.16) !important;
    }

    .header-right .location {
        position: relative !important;
        z-index: 5 !important;

        width: 100% !important;
        max-width: 96% !important;
        margin: 0 !important;
        padding: 0 !important;

        font-size: clamp(15px, 1.35vw, 23px) !important;
        line-height: 1.05 !important;
        letter-spacing: .35px !important;

        text-align: center !important;
        white-space: normal !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .45px rgba(60,8,14,.72) !important;

        text-shadow:
            0 2px 6px rgba(0,0,0,.92),
            0 0 10px rgba(255,255,255,.14) !important;
    }

    /*
     * Header colour-cycle asal Fie menggunakan inline !important.
     * Untuk V78, Event + Location kekal PUTIH seperti paparan
     * yang diminta tanpa mengganggu animation Reverb/JS.
     */
    .header-right .event,
    .header-right .location {
        animation-play-state: running !important;
    }

    /*
     * Kandungan utama dinaikkan rapat ke bawah header supaya
     * keseluruhan paparan TV kekal seimbang dan satu skrin.
     */
    .guestbook {
        top: 40vh !important;
    }

    /* =========================================================
       2 — QR
       252px -> 126px
       TIADA kotak keliling
       ========================================================= */

    .old-comments-panel > .stats > .event-qr-card {
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        outline: none !important;

        padding: 0 !important;
        overflow: visible !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title,
    .old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
        background: transparent !important;
        border: 0 !important;
        text-shadow:
            0 2px 4px rgba(255,255,255,.90) !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 126px !important;
        height: 126px !important;
        max-width: none !important;
        max-height: none !important;
        display: block !important;
        margin: 3px auto 0 !important;
    }

    /* =========================================================
       3 — TARIKH + HARI + COUNTER = PUTIH
       ========================================================= */

    .old-comments-panel > .header-b-meta .header-b-date .date-digit > span,
    .old-comments-panel > .header-b-meta .header-b-date .date-separator,
    .old-comments-panel > .header-b-meta .day-flip-letter > span,
    .old-comments-panel > .header-b-meta .header-b-date,
    .old-comments-panel > .header-b-meta .day-flip-display {

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .45px rgba(70,10,16,.78) !important;

        text-shadow:
            0 2px 4px rgba(0,0,0,.78),
            0 0 8px rgba(255,255,255,.20) !important;
    }

    .old-comments-panel > .stats > .stat .stat-label,
    .old-comments-panel > .stats > .stat .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat .flip-digit > span,
    #visitor-count,
    #comment-count {

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .45px rgba(70,10,16,.78) !important;

        text-shadow:
            0 2px 4px rgba(0,0,0,.78),
            0 0 8px rgba(255,255,255,.18) !important;
    }

    /* Flip box tetap transparent. */
    .old-comments-panel > .stats > .stat .flip-digit,
    .old-comments-panel > .stats > .stat .flip-digit > span,
    .old-comments-panel > .stats > .stat .stat-value.flip-counter {
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    /* =========================================================
       4 — ANIMASI GAMBAR KOMEN:
       LEBIH PEKAT + LEBIH TERANG
       ========================================================= */

    .guestbook {
        background:
            rgba(255,252,246,.18) !important;
        background-color:
            rgba(255,252,246,.18) !important;
    }

    .guestbook-bg-slideshow {
        opacity: 1 !important;
        z-index: 0 !important;
    }

    .guestbook-bg-slide {
        opacity: 0 !important;

        filter:
            saturate(1.34)
            brightness(1.06)
            contrast(1.12) !important;

        transform: scale(1.045) !important;

        transition:
            opacity 1.15s ease-in-out,
            transform 5s ease-in-out !important;

        will-change: opacity, transform;
    }

    .guestbook-bg-slide.is-active {
        opacity: .68 !important;
        transform: scale(1) !important;
    }

    .guestbook-bg-shade {
        background:
            linear-gradient(
                180deg,
                rgba(255,248,230,.05),
                rgba(255,244,218,.09)
            ) !important;
    }

    /*
     * Kedua-dua panel transparent supaya gambar benar-benar kelihatan
     * bergerak di belakang Komen Terkini + Komen Terdahulu.
     */
    .guestbook-columns,
    .latest-comments-panel,
    #latest-comments-container,
    .old-comments-panel,
    .old-comments-panel > .cloud-stage {
        background: transparent !important;
    }

    /* Komen terkini kekal kuning sahaja. */
    #latest-comments-container .comment,
    #latest-comments-container .comment:nth-child(n) {
        background:
            linear-gradient(
                145deg,
                rgba(255,249,217,.94),
                rgba(255,226,122,.94)
            ) !important;

        border: 1px solid rgba(211,163,41,.96) !important;
        border-radius: 18px !important;

        box-shadow:
            0 8px 18px rgba(120,82,8,.22),
            inset 0 1px 0 rgba(255,255,255,.92) !important;
    }

    /*
     * Komen terdahulu: bubble kekal dialog sahaja, tetapi background
     * gambar di belakang lebih jelas.
     */
    .old-comments-panel > .cloud-stage .cloud,
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog,
    .old-comments-panel > .cloud-stage .cloud.cloud-shape-round {
        border-radius: 18px !important;
        clip-path: none !important;
        box-shadow:
            0 9px 20px rgba(61,37,27,.22) !important;
    }

    /* Sempadan pemisah halus sahaja. */
    .header::after {
        display: block !important;
        content: '' !important;
        position: absolute !important;
        left: 0 !important;
        right: 0 !important;
        bottom: -2px !important;
        height: 2px !important;
        background:
            linear-gradient(
                90deg,
                rgba(212,175,55,.12),
                rgba(212,175,55,.92),
                rgba(212,175,55,.12)
            ) !important;
        box-shadow:
            0 0 8px rgba(212,175,55,.28) !important;
        pointer-events: none !important;
        z-index: 20 !important;
    }
}

/* ============================================================
   TV 1600px+
   Kekalkan nisbah yang sama, tetapi sedikit lebih besar dan selesa.
   ============================================================ */
@media (min-width: 1600px) {

    .header {
        height: 39vh !important;
    }

    .header-split {
        height: 39vh !important;
    }

    .header-left {
        height: 27vh !important;
        flex-basis: 27vh !important;
    }

    .guestbook-header-logo {
        height: 25.5vh !important;
        object-position: center 68% !important;
    }

    .header-right {
        height: 12vh !important;
        min-height: 12vh !important;
        flex-basis: 12vh !important;
    }

    .guestbook {
        top: 40vh !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 126px !important;
        height: 126px !important;
    }

    .guestbook-bg-slide.is-active {
        opacity: .68 !important;
    }
}

/* ============================================================
   TABLET
   ============================================================ */
@media (min-width: 761px) and (max-width: 1100px) {

    .header {
        height: 420px !important;
    }

    .header-split {
        height: 420px !important;
        display: flex !important;
        flex-direction: column !important;
    }

    .header-left {
        width: 100% !important;
        height: 235px !important;
        flex: 0 0 235px !important;
    }

    .guestbook-header-logo {
        height: 218px !important;
        width: 100% !important;
        object-fit: cover !important;
        object-position: center 68% !important;
    }

    .header-right {
        width: 100% !important;
        height: 185px !important;
        min-height: 185px !important;
        flex: 0 0 185px !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 126px !important;
        height: 126px !important;
    }

    .guestbook-bg-slide.is-active {
        opacity: .58 !important;
    }
}

/* ============================================================
   MOBILE — jangan rosakkan layout asal
   ============================================================ */
@media (max-width: 760px) {

    .guestbook-header-logo {
        object-position: center 68% !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 126px !important;
        height: 126px !important;
    }

    .guestbook-bg-slide.is-active {
        opacity: .48 !important;
    }

    .old-comments-panel > .header-b-meta .header-b-date .date-digit > span,
    .old-comments-panel > .header-b-meta .header-b-date .date-separator,
    .old-comments-panel > .header-b-meta .day-flip-letter > span,
    .old-comments-panel > .stats > .stat .stat-label,
    .old-comments-panel > .stats > .stat .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat .flip-digit > span {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .35px rgba(70,10,16,.78) !important;
    }
}
</style>



<style id="fie-v82-display-clean-premium">
/* ============================================================
 * FIE V82 — DISPLAY CLEAN / PREMIUM
 *
 * Berdasarkan terus kod Fie yang diberikan.
 *
 * PERUBAHAN:
 * 1. Buang ruang kosong besar sebelum KOMEN TERKINI.
 * 2. Naikkan KOMEN TERKINI + KOMEN TERDAHULU ke atas.
 * 3. Besarkan QR + tulisan QR.
 * 4. Besarkan header dan lembutkan/fade edge supaya blended.
 * 5. Tukar font EVENT + LOCATION kepada gaya serif premium.
 *
 * Reverb / Echo / JS / Controller / database / QR function
 * tidak disentuh.
 * ============================================================ */

@media (min-width: 901px) {

    /* =========================================================
       1 — BUANG RUANG KOSONG ATAS
       V81 meletakkan latest-comments-panel top:40%.
       Kita kembalikan ke bahagian atas.
       ========================================================= */

    .latest-comments-panel {
        position: relative !important;
        top: 0 !important;
        height: 100% !important;
        min-height: 0 !important;
        margin-top: 0 !important;
        padding-top: 0 !important;
        overflow: hidden !important;
    }

    #latest-comments-container {
        height: 100% !important;
        max-height: none !important;
        overflow: hidden !important;
    }

    /* Header kecil KOMEN TERKINI duduk rapat di atas. */
    .guestbook-heading-row {
        height: 3.6vh !important;
        min-height: 0 !important;
        margin: 0 0 .35vh !important;
        padding: 0 !important;
        align-items: center !important;
    }

    .guestbook-kicker {
        margin: 0 !important;
        font-size: clamp(10px, .78vw, 14px) !important;
        line-height: 1 !important;
        letter-spacing: .10em !important;
    }

    /* Tajuk panjang dibuang supaya tiada ruang kosong tambahan. */
    .guestbook-title {
        display: none !important;
    }

    /* =========================================================
       2 — KOMEN TERDAHULU NAIK
       ========================================================= */

    .old-comments-panel {
        position: relative !important;
        top: 0 !important;
        padding-top: 0 !important;
        margin-top: 0 !important;
    }

    .old-comments-panel > .cloud-stage {
        margin-top: .1vh !important;
        padding-top: 0 !important;
    }

    /* =========================================================
       3 — QR LEBIH BESAR
       ========================================================= */

    .old-comments-panel > .stats {
        height: 17vh !important;
        min-height: 0 !important;
        grid-template-rows: 17vh !important;
        gap: .75vw !important;
        margin-top: 0 !important;
        padding-top: 0 !important;
        transform: translateY(-.15vh) !important;
    }

    .old-comments-panel > .stats > .event-qr-card,
    .old-comments-panel > .stats > .stat {
        height: 17vh !important;
        min-height: 0 !important;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    .old-comments-panel > .stats > .event-qr-card {
        justify-content: center !important;
        overflow: visible !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        font-size: clamp(14px, .95vw, 18px) !important;
        line-height: 1.05 !important;
        letter-spacing: 1px !important;
        font-weight: 950 !important;
        white-space: nowrap !important;
        margin: 0 !important;
        text-shadow:
            0 2px 4px rgba(255,255,255,.96),
            0 1px 4px rgba(70,10,16,.18) !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
        font-size: clamp(9px, .62vw, 12px) !important;
        line-height: 1.05 !important;
        letter-spacing: .65px !important;
        font-weight: 950 !important;
        margin: 2px 0 0 !important;
        white-space: nowrap !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 168px !important;
        height: 168px !important;
        max-width: none !important;
        max-height: none !important;
        display: block !important;
        margin: 5px auto 0 !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-caption {
        font-size: 9px !important;
        line-height: 1 !important;
        margin-top: 3px !important;
    }

    /* Counter kekal kemas dan berada dalam baris yang sama. */
    .old-comments-panel > .stats > .stat {
        justify-content: center !important;
        padding-top: 0 !important;
    }

    .old-comments-panel > .stats > .stat .stat-label {
        font-size: clamp(10px, .78vw, 14px) !important;
        line-height: 1.05 !important;
        letter-spacing: 1px !important;
    }

    .old-comments-panel > .stats > .stat .stat-value.flip-counter {
        margin-top: .55vh !important;
        font-size: clamp(34px, 3.2vw, 58px) !important;
    }

    /* =========================================================
       4 — HEADER LEBIH BESAR
       ========================================================= */

    .header {
        height: 38vh !important;
        min-height: 0 !important;
        margin: 0 auto !important;
    }

    .header-split {
        height: 38vh !important;
        min-height: 0 !important;
    }

    .header-left {
        height: 29vh !important;
        min-height: 0 !important;
        flex: 0 0 29vh !important;
        padding: 0 !important;
        overflow: hidden !important;
        border-radius: 0 0 24px 24px !important;
    }

    .guestbook-header-logo {
        width: 100% !important;
        height: 28.5vh !important;
        max-width: none !important;
        max-height: none !important;
        margin: 0 !important;
        object-fit: contain !important;
        object-position: center center !important;
        border-radius: 20px !important;

        /* Fade semua edge supaya putih header blend dengan background. */
        -webkit-mask-image: radial-gradient(
            ellipse 82% 88% at 50% 50%,
            #000 62%,
            rgba(0,0,0,.96) 72%,
            rgba(0,0,0,.62) 86%,
            transparent 100%
        ) !important;
        mask-image: radial-gradient(
            ellipse 82% 88% at 50% 50%,
            #000 62%,
            rgba(0,0,0,.96) 72%,
            rgba(0,0,0,.62) 86%,
            transparent 100%
        ) !important;

        filter: drop-shadow(0 7px 12px rgba(35,12,8,.24)) !important;
        background: transparent !important;
    }

    /* Jangan tambah lapisan gelap pada header. */
    .header-left::after {
        background: transparent !important;
    }

    /* Ruang event/location lebih kemas selepas header dibesarkan. */
    .header-right {
        height: 9vh !important;
        min-height: 9vh !important;
        flex: 0 0 9vh !important;
        margin: 0 !important;
        padding: .15vh 3vw !important;
        gap: .45vh !important;
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    /* =========================================================
       5 — EVENT + LOCATION = FONT PREMIUM
       ========================================================= */

    .header-right .event,
    .header-right .location {
        font-family:
            "Baskerville",
            "Palatino Linotype",
            "Book Antiqua",
            "Times New Roman",
            Georgia,
            serif !important;

        font-style: normal !important;
        font-weight: 700 !important;
        text-align: center !important;
        text-transform: uppercase !important;

        color: #FFF8E7 !important;
        -webkit-text-fill-color: #FFF8E7 !important;

        -webkit-text-stroke: .35px rgba(92,24,25,.82) !important;

        text-shadow:
            0 2px 2px rgba(76,15,18,.82),
            0 4px 9px rgba(30,5,8,.35) !important;
    }

    .header-right .event {
        width: 100% !important;
        max-width: 96% !important;
        margin: 0 !important;
        font-size: clamp(21px, 2.35vw, 39px) !important;
        line-height: 1.03 !important;
        letter-spacing: 1.25px !important;
    }

    .header-right .location {
        width: 100% !important;
        max-width: 96% !important;
        margin: 0 !important;
        font-size: clamp(13px, 1.28vw, 22px) !important;
        line-height: 1.05 !important;
        letter-spacing: 1.15px !important;
    }

    /* Header B background kekal sangat lembut supaya event premium menonjol. */
    .header-right-bg-slide {
        filter: saturate(.65) brightness(.78) !important;
    }

    .header-right-bg-slide.is-active {
        opacity: .18 !important;
    }

    .header-right-bg-overlay {
        background: linear-gradient(
            180deg,
            rgba(70,12,18,.18),
            rgba(70,12,18,.28)
        ) !important;
    }
}

/* ============================================================
   TV BESAR
   ============================================================ */
@media (min-width: 1600px) {

    .header {
        height: 38vh !important;
    }

    .header-split {
        height: 38vh !important;
    }

    .header-left {
        height: 29vh !important;
        flex-basis: 29vh !important;
    }

    .guestbook-header-logo {
        height: 28.5vh !important;
    }

    .header-right {
        height: 9vh !important;
        flex-basis: 9vh !important;
    }

    .guestbook {
        top: 38vh !important;
    }

    .old-comments-panel > .stats {
        height: 17vh !important;
        grid-template-rows: 17vh !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 168px !important;
        height: 168px !important;
    }
}

/* ============================================================
   TABLET LANDSCAPE
   ============================================================ */
@media (min-width: 761px) and (max-width: 1100px) {

    .header {
        height: 35vh !important;
    }

    .header-split {
        height: 35vh !important;
    }

    .header-left {
        height: 23vh !important;
        flex-basis: 23vh !important;
    }

    .guestbook-header-logo {
        height: 22.5vh !important;
    }

    .header-right {
        height: 12vh !important;
        flex-basis: 12vh !important;
    }

    .guestbook {
        top: 35vh !important;
    }

    .latest-comments-panel {
        top: 0 !important;
        height: 100% !important;
    }

    .old-comments-panel > .stats {
        height: 15vh !important;
        grid-template-rows: 15vh !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 150px !important;
        height: 150px !important;
    }
}

/* ============================================================
   MOBILE — kekalkan susunan responsive, cuma buang offset V81.
   ============================================================ */
@media (max-width: 760px) {

    .latest-comments-panel {
        top: auto !important;
        height: 100% !important;
    }

    .guestbook-title {
        display: none !important;
    }

    .guestbook-heading-row {
        height: auto !important;
        min-height: 28px !important;
    }

    .guestbook-header-logo {
        -webkit-mask-image: none !important;
        mask-image: none !important;
    }
}
</style>



    <style id="fie-v92-yellow-dialog-force">
        /* ============================================================
         * V92 — PAKSA SEMUA KOMEN TERDAHULU = KUNING
         *
         * Hanya warna dialog + ekor + teks.
         * Animasi / kedudukan / timing / JS / Reverb KEKAL.
         * Selector sengaja dibuat lebih spesifik supaya mengatasi
         * CSS V72-V90 yang telah ditambah sebelum ini.
         * ============================================================ */

        .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog,
        .old-comments-panel > .cloud-stage .cloud.cloud-shape-round,
        .old-comments-panel > .cloud-stage .cloud {
            background: #FFD700 !important;
            background-image: none !important;
            border-color: #B8860B !important;
            color: #3D2B00 !important;
        }

        .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog::before,
        .old-comments-panel > .cloud-stage .cloud.cloud-shape-round::before,
        .old-comments-panel > .cloud-stage .cloud::before {
            background: #FFD700 !important;
            background-image: none !important;
            border-right-color: #B8860B !important;
            border-bottom-color: #B8860B !important;
        }

        .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog .cloud-name,
        .old-comments-panel > .cloud-stage .cloud.cloud-shape-round .cloud-name,
        .old-comments-panel > .cloud-stage .cloud .cloud-name,
        .old-comments-panel > .cloud-stage .cloud.cloud-shape-dialog .cloud-message,
        .old-comments-panel > .cloud-stage .cloud.cloud-shape-round .cloud-message,
        .old-comments-panel > .cloud-stage .cloud .cloud-message {
            color: #3D2B00 !important;
        }
    </style>


<style id="fie-fasa3-event-image-fill-frame">
/*
 * FASA 3 — GAMBAR EVENT PENUHI FRAME
 *
 * Hanya ubah kawasan Display Gambar Event.
 * Komen Terkini, Komen Terdahulu, QR, counter,
 * Reverb dan fungsi lain tidak disentuh.
 */

.event-image-frame {
    width: 100% !important;
    height: 390px !important;
    min-height: 390px !important;
    padding: 0 !important;
    overflow: hidden !important;
    border-radius: 18px !important;
}

#event-display-image {
    display: block !important;
    width: 100% !important;
    height: 100% !important;
    max-width: none !important;
    max-height: none !important;
    object-fit: cover !important;
    object-position: center center !important;
}

@media (max-width: 760px) {

    .event-image-frame {
        height: 250px !important;
        min-height: 250px !important;
        padding: 0 !important;
    }

    #event-display-image {
        width: 100% !important;
        height: 100% !important;
        max-width: none !important;
        max-height: none !important;
        object-fit: cover !important;
        object-position: center center !important;
    }
}
</style>

</head>


@php
    $displayComments = collect(
        $allComments ?? $comments ?? []
    )->map(function ($comment) {
        return [
            'id' => (int) ($comment->id ?? 0),
            'name' => (string) ($comment->name ?? 'Pengunjung'),
            'organization' => $comment->organization
                ? (string) $comment->organization
                : null,
            'comment' => (string) ($comment->comment ?? ''),
            'rating' => $comment->rating !== null
                ? (int) $comment->rating
                : null,
        ];
    })->values();
@endphp


<body class="guestbook-theme theme-{{ $event->theme ?? 'melaka-classic' }}">

<div class="page">


    {{-- ============================================================
         HEADER
    ============================================================= --}}

    <div class="header">

        <div class="header-split">

            {{-- A: Background kapal layar + header MELAKA DIGITAL GUESTBOOK --}}
            <div class="header-left">

                <img
                    src="{{ asset($selectedHeader['image']) }}"
                    alt="MELAKA DIGITAL GUESTBOOK"
                    class="guestbook-header-logo"
                >

            </div>

            {{-- B: Event + Location dengan background animasi Melaka --}}
            <div class="header-right">

                <div class="header-right-bg" aria-hidden="true">
                    <img class="header-right-bg-slide is-active" src="{{ asset('images/istana.png') }}" alt="">
                    <img class="header-right-bg-slide" src="{{ asset('images/jonker.png') }}" alt="">
                    <img class="header-right-bg-slide" src="{{ asset('images/mix.png') }}" alt="">
                    <div class="header-right-bg-overlay"></div>
                </div>

                <div class="event">
                    {{ $event->name }}
                </div>

                @if ($event->location)
                    <div class="location">
                        {{ $event->location }}
                    </div>
                @endif

                {{-- Tarikh + hari DIPINDAHKAN ke panel Komen Terdahulu --}}
            </div>

        </div>

    </div>


    {{-- ============================================================
         REALTIME STATUS
    ============================================================= --}}

    <div class="realtime-status">

        <span
            id="realtime-dot"
            class="status-dot">
        </span>

        <span id="realtime-status-text">
            Menyambung realtime...
        </span>

    </div>


    {{-- ============================================================
         GUESTBOOK
    ============================================================= --}}

    <div class="guestbook">

        <div class="guestbook-bg-slideshow" id="guestbook-bg-slideshow" aria-hidden="true">
            <img class="guestbook-bg-slide is-active" src="{{ asset('images/afamosa.png') }}" alt="">
            <img class="guestbook-bg-slide" src="{{ asset('images/istana.png') }}" alt="">
            <img class="guestbook-bg-slide" src="{{ asset('images/jonker.png') }}" alt="">
            <img class="guestbook-bg-slide" src="{{ asset('images/menara.png') }}" alt="">
            <img class="guestbook-bg-slide" src="{{ asset('images/mix.png') }}" alt="">
            <img class="guestbook-bg-slide" src="{{ asset('images/sungai.png') }}" alt="">
            <img class="guestbook-bg-slide" src="{{ asset('images/zoo.png') }}" alt="">
            <div class="guestbook-bg-shade"></div>
        </div>

        <div class="guestbook-heading-row">

            <div>
                <div class="guestbook-kicker">KOMEN TERKINI</div>
                <div class="guestbook-title">Kenangan &amp; Rekod Tetamu</div>
            </div>

        </div>


        <div class="guestbook-columns">

            {{-- ====================================================
                 5 KOMEN TERBARU
            ===================================================== --}}

            <section
                class="latest-comments-panel"
                aria-labelledby="latest-comments-heading">

                <div
                    id="latest-comments-heading"
                    class="latest-comments-heading">

                    <span>💬</span>

                    <span>
                        5 Komen Terbaru
                    </span>

                </div>


                <div
                    id="latest-comments-container"
                    aria-live="polite">
                </div>

            </section>


            {{-- ====================================================
                 KOMEN LAMA - AWAN
            ===================================================== --}}

            <section
                id="old-comments-panel"
                class="old-comments-panel"
                aria-labelledby="old-comments-heading">

                {{-- ====================================================
                     3 MAKLUMAT KANAN — DIPINDAHKAN KE ATAS RUANG C
                     QR / JUMLAH PENGUNJUNG / KOMEN
                ===================================================== --}}

                    {{-- ============================================================
                         STATISTICS
                    ============================================================= --}}
                
                    <div class="stats">
                
                    {{-- ============================================================
                         EVENT REGISTRATION QR
                    ============================================================= --}}
                
                    {{-- QR dipindahkan ke header-left.
                         Slot tersembunyi dikekalkan supaya struktur
                         nth-child statistik sedia ada tidak berubah. --}}
                <div
                    class="event-qr-card"
                    aria-label="QR pendaftaran event"
                >

                    <div class="event-qr-title">
                        📱 QR PENDAFTARAN
                    </div>

                    <div class="event-qr-subtitle">
                        SCAN UNTUK PENDAFTARAN
                    </div>

                    <canvas
                        id="display-qr-code"
                        class="event-qr-canvas"
                        aria-label="Kod QR pendaftaran event"
                    ></canvas>

                    <div
    id="display-qr-url"
    data-url="{{ request()->getSchemeAndHttpHost() . route('guestbook.register', ['event' => $event->id], false) }}"
    style="display: none;"
></div>
                    <div class="event-qr-caption">
                        Imbas menggunakan telefon anda
                    </div>

                    <div
                        id="display-qr-error"
                        class="event-qr-error"
                    ></div>

                </div>


                        {{-- Visitor --}}
                        <div class="stat">
                
                            <div class="stat-label">
                                JUMLAH PENGUNJUNG
                            </div>
                
                            <div
                                id="visitor-count"
                                class="stat-value">
                
                                {{ $visitorCount }}
                
                            </div>
                
                        </div>
                
                
                        {{-- Comment --}}
                        <div class="stat">
                
                            <div class="stat-label">
                                KOMEN
                            </div>
                
                            <div
                                id="comment-count"
                                class="stat-value">
                
                                {{ $commentCount }}
                
                            </div>
                
                        </div>
                
                    </div>

                <div
                    id="old-comments-heading"
                    class="old-comments-heading">

                    <span>☁️</span>

                    <span>
                        Komen Terdahulu
                    </span>

                </div>

                <div class="old-comments-caption">
                    Komen lama bergerak secara automatik dan
                    sentiasa berulang mengikut keseluruhan rekod event.
                </div>


                <div
                    id="cloud-stage"
                    class="cloud-stage"
                    aria-live="off">

                    <div class="cloud-empty">
                        Belum ada komen terdahulu untuk dipaparkan.
                    </div>

                </div>

                {{-- ====================================================
                     FASA 3 — DISPLAY GAMBAR EVENT
                     Kandungan dikawal melalui Laravel Reverb.
                ===================================================== --}}
                <div
                    id="event-images-display"
                    class="event-images-display"
                    aria-live="polite"
                    aria-hidden="true"
                >
                    <div class="event-image-frame">
                        <img
                            id="event-display-image"
                            src=""
                            alt="Gambar event"
                        >
                    </div>

                    <div
                        id="event-display-caption"
                        class="event-display-caption"
                    ></div>
                </div>

                {{-- ====================================================
                     DISPLAY TO MAIN — SIGNATURE + UCAPAN 20 SAAT
                ===================================================== --}}

                <div
                    id="main-signature-display"
                    class="main-signature-display"
                    aria-live="polite"
                    aria-hidden="true"
                >

                    <div class="main-signature-panel">

                        <div class="main-signature-image-wrap">

                            <div class="main-signature-label">
                                TANDATANGAN
                            </div>

                            <div class="main-signature-image-frame">

                                <img
                                    id="main-signature-image"
                                    src=""
                                    alt="Tandatangan digital"
                                >

                            </div>

                        </div>


                        <div class="main-signature-message">

                            <div
                                id="main-signature-welcome"
                                class="main-signature-welcome"
                            >
                                Selamat Datang
                            </div>

                            <div
                                id="main-signature-name"
                                class="main-signature-name"
                            >
                            </div>

                            <div
                                id="main-signature-position"
                                class="main-signature-position"
                            >
                            </div>

                            <div class="main-signature-thanks">
                                Terima Kasih
                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </div>



</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        
        /*
        |--------------------------------------------------------------------------
        | Event Registration QR
        |--------------------------------------------------------------------------
        */

        initializeDisplayQr();

        // Initialize clock, date and flip counters inside the same scope
        // as the Display functions so the functions are available.
        initializeFlipCounters();


/*
        |--------------------------------------------------------------------------
        | Pastikan Echo wujud
        |--------------------------------------------------------------------------
        */

        if (!window.Echo) {

            console.error(
                'Laravel Echo tidak tersedia.'
            );

            updateRealtimeStatus(
                false,
                'Echo tidak tersedia'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Event ID
        |--------------------------------------------------------------------------
        */

        const eventId =
            {{ $event->id }};


        /*
        |--------------------------------------------------------------------------
        | Channel
        |--------------------------------------------------------------------------
        */

        const channelName =
            `guestbook.event.${eventId}`;


        console.log(
            'Guestbook realtime channel:',
            channelName
        );


        /*
        |--------------------------------------------------------------------------
        | Reverb Connection
        |--------------------------------------------------------------------------
        */

        const pusher =
            window.Echo.connector?.pusher;


        if (!pusher) {

            console.error(
                'Reverb Pusher connection tidak tersedia.'
            );

            updateRealtimeStatus(
                false,
                'Sambungan realtime tidak tersedia'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Semak status connection semasa
        |--------------------------------------------------------------------------
        |
        | Ini penting supaya kita tidak bergantung kepada event
        | "connected" sahaja.
        |
        */

        if (
            pusher.connection.state === 'connected'
        ) {

            console.log(
                'Reverb sudah connected'
            );

            updateRealtimeStatus(
                true,
                'Realtime aktif'
            );

        } else {

            console.log(
                'Reverb current state:',
                pusher.connection.state
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Bila Connected
        |--------------------------------------------------------------------------
        */

        pusher.connection.bind(
            'connected',
            function () {

                console.log(
                    'Reverb connected'
                );

                updateRealtimeStatus(
                    true,
                    'Realtime aktif'
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Bila Disconnected
        |--------------------------------------------------------------------------
        */

        pusher.connection.bind(
            'disconnected',
            function () {

                console.log(
                    'Reverb disconnected'
                );

                updateRealtimeStatus(
                    false,
                    'Realtime terputus'
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Connection Error
        |--------------------------------------------------------------------------
        */

        pusher.connection.bind(
            'error',
            function (error) {

                console.error(
                    'Reverb connection error:',
                    error
                );

                updateRealtimeStatus(
                    false,
                    'Ralat sambungan realtime'
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Subscribe Channel
        |--------------------------------------------------------------------------
        */

        const channel =
            window.Echo.channel(
                channelName
            );


        console.log(
            'Subscribed to:',
            channelName
        );


        /*
        |--------------------------------------------------------------------------
        | Display Signature To Main
        |--------------------------------------------------------------------------
        |
        | Event ini hanya diterima untuk Event ID yang sama kerana:
        | 1. Main Display subscribe guestbook.event.{eventId}
        | 2. Kita tetap semak event_id sebagai lapisan keselamatan tambahan.
        |
        | Komen Terkini kekal berjalan.
        | Hanya panel Komen Terdahulu bertukar sementara.
        |--------------------------------------------------------------------------
        */

        let mainSignatureTimer = null;

        function stopCloudRotationForMainSignature() {

            if (cloudRotationTimer) {
                clearInterval(cloudRotationTimer);
                cloudRotationTimer = null;
            }

        }


        function restoreOlderCommentsAfterMainSignature() {

            const oldCommentsPanel =
                document.getElementById(
                    'old-comments-panel'
                );

            const mainSignatureDisplay =
                document.getElementById(
                    'main-signature-display'
                );

            if (mainSignatureTimer) {
                clearTimeout(mainSignatureTimer);
                mainSignatureTimer = null;
            }

            if (oldCommentsPanel) {
                oldCommentsPanel.classList.remove(
                    'main-signature-mode'
                );
            }

            if (mainSignatureDisplay) {
                mainSignatureDisplay.classList.remove(
                    'show'
                );

                mainSignatureDisplay.setAttribute(
                    'aria-hidden',
                    'true'
                );
            }

            renderClouds();
            startCloudRotation();

        }


        function displaySignatureOnMain(data) {

            if (!data) {
                return;
            }

            if (
                Number(data.event_id) !==
                Number(eventId)
            ) {
                console.warn(
                    'Display signature diabaikan: Event ID tidak sepadan.',
                    data
                );

                return;
            }

            const signatureUrl =
                data.signature_url ||
                '';

            const signer =
                data.signer ||
                {};

            const signerName =
                signer.name ||
                data.signer_name ||
                '';


            const signerPosition =
                signer.position ||
                data.signer_position ||
                '';


            const oldCommentsPanel =
                document.getElementById(
                    'old-comments-panel'
                );

            const mainSignatureDisplay =
                document.getElementById(
                    'main-signature-display'
                );

            const signatureImage =
                document.getElementById(
                    'main-signature-image'
                );

            const signatureName =
                document.getElementById(
                    'main-signature-name'
                );

            const signaturePosition =
                document.getElementById(
                    'main-signature-position'
                );


            if (
                !oldCommentsPanel ||
                !mainSignatureDisplay ||
                !signatureImage
            ) {
                return;
            }


            if (mainSignatureTimer) {
                clearTimeout(
                    mainSignatureTimer
                );

                mainSignatureTimer =
                    null;
            }


            /*
            |--------------------------------------------------------------------------
            | Hentikan awan kanan sementara
            |--------------------------------------------------------------------------
            */

            stopCloudRotationForMainSignature();


            /*
            |--------------------------------------------------------------------------
            | Isi data signer + signature terkini
            |--------------------------------------------------------------------------
            */

            signatureImage.src =
                signatureUrl;

            if (signatureName) {
                signatureName.textContent =
                    signerName;
            }

            if (signaturePosition) {
                signaturePosition.textContent =
                    signerPosition;
            }


            /*
            |--------------------------------------------------------------------------
            | Paparkan panel signature
            |--------------------------------------------------------------------------
            */

            oldCommentsPanel.classList.add(
                'main-signature-mode'
            );

            mainSignatureDisplay.setAttribute(
                'aria-hidden',
                'false'
            );


            /*
            |--------------------------------------------------------------------------
            | Reset animasi supaya bila Admin tekan lagi,
            | paparan akan masuk semula dengan animasi baharu.
            |--------------------------------------------------------------------------
            */

            mainSignatureDisplay.classList.remove(
                'show'
            );

            requestAnimationFrame(
                function () {

                    requestAnimationFrame(
                        function () {

                            mainSignatureDisplay.classList.add(
                                'show'
                            );

                        }
                    );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Tempoh standard = 20 saat
            |--------------------------------------------------------------------------
            */

            const duration =
                Math.max(
                    1,
                    Number(
                        data.duration ?? 20
                    )
                );


            mainSignatureTimer =
                setTimeout(
                    function () {

                        restoreOlderCommentsAfterMainSignature();

                    },
                    duration * 1000
                );

        }


        channel.listen(
            '.signature.displayed.on.main',
            function (data) {

                console.log(
                    'Signature dihantar ke Main Display:',
                    data
                );

                displaySignatureOnMain(
                    data
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Visitor Registered
        |--------------------------------------------------------------------------
        */

        channel.listen(
            '.visitor.registered',
            function (data) {

                console.log(
                    'Visitor baru diterima:',
                    data
                );

                incrementVisitorCount();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Comment Published
        |--------------------------------------------------------------------------
        */

        channel.listen(
            '.comment.published',
            function (data) {

                console.log(
                    'Komen baru diterima:',
                    data
                );

                addComment(data);

                // Jika event Reverb tidak membawa rating, refresh automatik
                // supaya rating + emoji yang baru disimpan di DB terus dipaparkan.
                // Tiada lagi refresh manual diperlukan pada skrin Display.
                if (
                    data.rating === null ||
                    data.rating === undefined
                ) {
                    window.setTimeout(function () {
                        window.location.reload();
                    }, 150);
                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | State Komen
        |--------------------------------------------------------------------------
        |
        | allComments menyimpan semua komen yang diketahui oleh paparan.
        | 7 terbaru berada di panel kiri.
        | Komen lebih lama dipaparkan dalam bentuk awan di sebelah kanan
        | dan akan berulang secara automatik.
        |
        */

        const allComments = @json($displayComments);

        let cloudOffset = 0;
        let cloudRotationTimer = null;
        let latestCommentsRotationTimer = null;

        /* ========================================================
           FASA 3 — STATE PAPARAN GAMBAR EVENT
           ======================================================== */
        let eventImages = [];
        let eventImageIndex = 0;
        let eventImagesCycleTimer = null;
        let eventImagesActive = false;


        /*
        |--------------------------------------------------------------------------
        | Render Semua Komen
        |--------------------------------------------------------------------------
        */

        renderCommentPanels();
        startCloudRotation();
        startLatestCommentsLoop();


        /*
        |--------------------------------------------------------------------------
        | Tambah Komen Baharu
        |--------------------------------------------------------------------------
        */

        function addComment(data) {

            if (!data) {
                return;
            }

            const newComment = {
                id:
                    Number(data.id ?? 0),

                name:
                    data.name ??
                    'Pengunjung',

                organization:
                    data.organization ??
                    null,

                comment:
                    data.comment ??
                    '',

                rating:
                    data.rating !== null &&
                    data.rating !== undefined
                        ? Number(data.rating)
                        : null,
            };


            /*
            |--------------------------------------------------------------------------
            | Elak rekod duplicate
            |--------------------------------------------------------------------------
            */

            if (
                newComment.id &&
                allComments.some(
                    item =>
                        Number(item.id) ===
                        newComment.id
                )
            ) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Komen baharu masuk ke hadapan
            |--------------------------------------------------------------------------
            */

            allComments.unshift(
                newComment
            );


            renderCommentPanels();
            startLatestCommentsLoop();

            incrementCommentCount();

        }


        /*
        |--------------------------------------------------------------------------
        | Render 5 Komen Terbaru + Komen Lama
        |--------------------------------------------------------------------------
        */

        function renderCommentPanels() {

            const latestContainer =
                document.getElementById(
                    'latest-comments-container'
                );

            const cloudStage =
                document.getElementById(
                    'cloud-stage'
                );


            if (!latestContainer || !cloudStage) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | 7 TERBARU
            |--------------------------------------------------------------------------
            */

            latestContainer.innerHTML = '';


            const latestComments =
                allComments.slice(
                    0,
                    7
                );


            if (
                latestComments.length === 0
            ) {

                latestContainer.innerHTML =
                    '<div class="empty">' +
                    'Belum ada komen untuk event ini.' +
                    '</div>';

            } else {

                latestComments.forEach(
                    function (comment) {

                        latestContainer.appendChild(
                            createLatestCommentElement(
                                comment
                            )
                        );

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | KOMEN LAMA
            |--------------------------------------------------------------------------
            */

            renderClouds();

        }


        /*
        |--------------------------------------------------------------------------
        | Create Latest Comment Element
        |--------------------------------------------------------------------------
        */

        function createLatestCommentElement(
            data
        ) {

            const comment =
                document.createElement(
                    'div'
                );

            comment.className =
                'comment';


            const name =
                document.createElement(
                    'div'
                );

            name.className =
                'comment-name';

            name.textContent =
                data.name ??
                'Pengunjung';

            const topLine =
                document.createElement(
                    'div'
                );

            topLine.className =
                'comment-topline';

            topLine.appendChild(
                name
            );


            if (
                data.rating
            ) {

                const rating =
                    document.createElement(
                        'div'
                    );

                rating.className =
                    'comment-rating';

                const ratingValue =
                    Math.max(
                        1,
                        Math.min(
                            5,
                            Number(data.rating)
                        )
                    );

                rating.textContent =
                    '★'.repeat(ratingValue) +
                    '☆'.repeat(5 - ratingValue);

                topLine.appendChild(
                    rating
                );

                // Rating 3-5: 👍 BAGUS | Rating 1-2: 👏 TERIMA KASIH
                if (ratingValue >= 1) {

                    const feedback =
                        document.createElement('span');

                    feedback.className =
                        'rating-feedback';

                    const feedbackEmoji =
                        document.createElement('span');

                    feedbackEmoji.className =
                        'rating-feedback-emoji';

                    const feedbackText =
                        document.createElement('span');

                    if (ratingValue >= 3) {
                        feedbackEmoji.textContent = '👍';
                        feedbackText.textContent = 'BAGUS';
                    } else {
                        feedbackEmoji.textContent = '👏';
                        feedbackText.textContent = 'TERIMA KASIH';
                    }

                    feedback.appendChild(feedbackEmoji);
                    feedback.appendChild(feedbackText);
                    topLine.appendChild(feedback);
                }

            }

            comment.appendChild(
                topLine
            );


            if (
                data.organization
            ) {

                const organization =
                    document.createElement(
                        'div'
                    );

                organization.className =
                    'comment-org';

                organization.textContent =
                    data.organization;

                comment.appendChild(
                    organization
                );

            }


            const commentText =
                document.createElement(
                    'div'
                );

            commentText.className =
                'comment-text';

            commentText.textContent =
                `“${data.comment ?? ''}”`;

            comment.appendChild(
                commentText
            );


            return comment;

        }


        /*
        |--------------------------------------------------------------------------
        | Render Awan Komen Lama
        |--------------------------------------------------------------------------
        */

        function renderClouds() {

            const cloudStage =
                document.getElementById(
                    'cloud-stage'
                );


            if (!cloudStage) {
                return;
            }


            const oldComments =
                allComments.slice(
                    7
                );


            cloudStage.innerHTML = '';


            if (
                oldComments.length === 0
            ) {

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | PAPARAN 10 KOMEN TERDAHULU
            | Maksimum 10 komen serentak.
            |--------------------------------------------------------------------------
            */

            const displayCount =
                Math.min(
                    10,
                    oldComments.length
                );


            /*
            |--------------------------------------------------------------------------
            | 10 KEDUDUKAN
            | Setiap render position akan di-random.
            |--------------------------------------------------------------------------
            */

            const positions = [
                'cloud-pos-1',
                'cloud-pos-2',
                'cloud-pos-3',
                'cloud-pos-4',
                'cloud-pos-5',
                'cloud-pos-6',
                'cloud-pos-7',
                'cloud-pos-8',
                'cloud-pos-9',
                'cloud-pos-10',
            ];


            const shuffledPositions =
                [...positions].sort(
                    () => Math.random() - 0.5
                );

            /*
            |--------------------------------------------------------------------------
            | RANDOM 10 KOMEN
            | Setiap looping pilih maksimum 10 komen terdahulu
            | secara rawak tanpa duplicate.
            |--------------------------------------------------------------------------
            */

            const shuffledOldComments =
                [...oldComments].sort(
                    () => Math.random() - 0.5
                ).slice(
                    0,
                    displayCount
                );


            /*
            |--------------------------------------------------------------------------
            | RANDOM SHAPE
            | dialog / bulat sahaja
            |--------------------------------------------------------------------------
            */

            const shapes = [
                'cloud-shape-dialog',
            ];


            for (
                let i = 0;
                i < displayCount;
                i++
            ) {

                const data =
                    shuffledOldComments[i];


                const shapeClass =
                    shapes[
                        Math.floor(
                            Math.random() *
                            shapes.length
                        )
                    ];


                const positionClass =
                    shuffledPositions[i];


                cloudStage.appendChild(
                    createCloudElement(
                        data,
                        positionClass,
                        shapeClass
                    )
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Create Cloud Element
        |--------------------------------------------------------------------------
        */

        function createCloudElement(
            data,
            positionClass,
            shapeClass = 'cloud-shape-dialog'
        ) {

            const cloud =
                document.createElement(
                    'div'
                );


            cloud.className =
                `cloud ${positionClass} ${shapeClass}`;


            const wrapper =
                document.createElement(
                    'div'
                );


            const name =
                document.createElement(
                    'div'
                );


            name.className =
                'cloud-name';


            name.textContent =
                data.organization
                    ? `${data.name} • ${data.organization}`
                    : data.name;


            if (
                data.rating
            ) {

                const rating =
                    document.createElement(
                        'div'
                    );


                rating.className =
                    'comment-rating';


                const ratingValue =
                    Math.max(
                        1,
                        Math.min(
                            5,
                            Number(data.rating)
                        )
                    );


                rating.textContent =
                    '★'.repeat(ratingValue) +
                    '☆'.repeat(5 - ratingValue);


                wrapper.appendChild(
                    rating
                );

            }


            const message =
                document.createElement(
                    'div'
                );


            message.className =
                'cloud-message';


            message.textContent =
                `“${data.comment ?? ''}”`;


            const emojis = [
                '🙏',
                '👍',
                '❤️',
                '👏',
                '✨',
                '🌟',
                '💖',
                '🤝',
            ];


            const emoji =
                document.createElement(
                    'div'
                );


            emoji.className =
                'cloud-emoji';


            emoji.textContent =
                emojis[
                    Math.floor(
                        Math.random() *
                        emojis.length
                    )
                ];


            wrapper.appendChild(
                emoji
            );


            wrapper.appendChild(
                name
            );


            wrapper.appendChild(
                message
            );


            cloud.appendChild(
                wrapper
            );


            /*
            |--------------------------------------------------------------------------
            | Trigger fade-in selepas element masuk
            |--------------------------------------------------------------------------
            */

            requestAnimationFrame(
                function () {

                    cloud.classList.add(
                        'active'
                    );

                }
            );


            return cloud;

        }


        /*
        |--------------------------------------------------------------------------
        | Kitaran Awan
        |--------------------------------------------------------------------------
        */

        function startLatestCommentsLoop() {

            if (latestCommentsRotationTimer) {
                clearInterval(latestCommentsRotationTimer);
                latestCommentsRotationTimer = null;
            }

            if (allComments.length <= 1) {
                return;
            }

            latestCommentsRotationTimer = setInterval(function () {

                const latestContainer = document.getElementById('latest-comments-container');

                if (!latestContainer || latestContainer.children.length <= 1) {
                    return;
                }

                const first = latestContainer.firstElementChild;

                if (!first || first.classList.contains('empty')) {
                    return;
                }

                first.style.transition = 'transform 0.8s ease, opacity 0.8s ease';
                first.style.transform = 'translateY(-18px)';
                first.style.opacity = '0';

                setTimeout(function () {
                    if (first.parentNode === latestContainer) {
                        latestContainer.appendChild(first);
                        first.style.transition = 'none';
                        first.style.transform = 'translateY(18px)';
                        first.style.opacity = '0';

                        requestAnimationFrame(function () {
                            first.style.transition = 'transform 0.8s ease, opacity 0.8s ease';
                            first.style.transform = 'translateY(0)';
                            first.style.opacity = '1';
                        });
                    }
                }, 800);

            }, 4000);
        }


        /*
        |--------------------------------------------------------------------------
        | Kitaran Awan
        |--------------------------------------------------------------------------
        */

        function startCloudRotation() {

            if (
                cloudRotationTimer
            ) {

                clearInterval(
                    cloudRotationTimer
                );

                cloudRotationTimer =
                    null;

            }


            const oldComments =
                allComments.slice(
                    7
                );


            if (
                oldComments.length === 0
            ) {

                return;

            }


            cloudRotationTimer =
                setInterval(
                    function () {

                        const currentOldComments =
                            allComments.slice(
                                7
                            );


                        if (
                            currentOldComments.length === 0
                        ) {

                            return;

                        }


                        cloudOffset =
                            (
                                cloudOffset + 1
                            ) %
                            currentOldComments.length;


                        renderClouds();

                    },
                    3200
                );

        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan Timer Awan Refresh Bila Komen Baharu Masuk
        |--------------------------------------------------------------------------
        */

        function refreshCloudRotation() {

            startCloudRotation();

        }


        /*
        |--------------------------------------------------------------------------
        | FASA 3 — Display Gambar Event
        |--------------------------------------------------------------------------
        */

        function stopEventImagesCycle() {

            if (eventImagesCycleTimer) {
                clearInterval(eventImagesCycleTimer);
                eventImagesCycleTimer = null;
            }

        }


        function hideEventImageDisplay() {

            const oldCommentsPanel =
                document.getElementById(
                    'old-comments-panel'
                );

            const eventImagesDisplay =
                document.getElementById(
                    'event-images-display'
                );

            if (oldCommentsPanel) {
                oldCommentsPanel.classList.remove(
                    'event-images-mode'
                );
            }

            if (eventImagesDisplay) {
                eventImagesDisplay.classList.remove(
                    'show'
                );

                eventImagesDisplay.setAttribute(
                    'aria-hidden',
                    'true'
                );
            }

        }


        function showOlderCommentsForEventImages() {

            const eventImagesDisplay =
                document.getElementById(
                    'event-images-display'
                );

            hideEventImageDisplay();

            renderClouds();

            if (eventImagesDisplay) {
                eventImagesDisplay.setAttribute(
                    'aria-hidden',
                    'true'
                );
            }

        }


        function showEventImage(image) {

            const oldCommentsPanel =
                document.getElementById(
                    'old-comments-panel'
                );

            const eventImagesDisplay =
                document.getElementById(
                    'event-images-display'
                );

            const eventDisplayImage =
                document.getElementById(
                    'event-display-image'
                );

            const eventDisplayCaption =
                document.getElementById(
                    'event-display-caption'
                );

            if (
                !oldCommentsPanel ||
                !eventImagesDisplay ||
                !eventDisplayImage
            ) {
                return;
            }

            if (!image || !image.url) {
                return;
            }

            oldCommentsPanel.classList.add(
                'event-images-mode'
            );

            eventImagesDisplay.setAttribute(
                'aria-hidden',
                'false'
            );

            eventImagesDisplay.classList.remove(
                'show'
            );

            eventDisplayImage.src =
                image.url;

            eventDisplayImage.alt =
                image.caption
                    ? image.caption
                    : 'Gambar event';

            if (eventDisplayCaption) {
                eventDisplayCaption.textContent =
                    image.caption || '';
            }

            requestAnimationFrame(
                function () {

                    requestAnimationFrame(
                        function () {

                            eventImagesDisplay.classList.add(
                                'show'
                            );

                        }
                    );

                }
            );

        }


        function startEventImagesDisplay(images) {

            if (!Array.isArray(images) || images.length === 0) {
                console.warn(
                    'Display gambar event diabaikan: tiada gambar.'
                );

                return;
            }

            stopEventImagesCycle();

            eventImages =
                images.filter(function (image) {
                    return image && image.url;
                });

            if (eventImages.length === 0) {
                return;
            }

            eventImagesActive = true;
            eventImageIndex = 0;

            /*
            | Jika signature Main masih sedang dipaparkan,
            | hentikan paparan signature dahulu supaya dua mode
            | tidak bertindih.
            */
            restoreOlderCommentsAfterMainSignature();

            /*
            | Paparan pertama = Komen Terdahulu.
            */
            showOlderCommentsForEventImages();
            startCloudRotation();

            /*
            | Selepas 5 saat, tukar ke gambar pertama.
            | Selepas itu: Komen Lama ↔ Gambar secara bergilir.
            */
            let showImageNext = true;

            eventImagesCycleTimer =
                setInterval(
                    function () {

                        if (!eventImagesActive) {
                            return;
                        }

                        if (showImageNext) {

                            stopCloudRotationForMainSignature();

                            showEventImage(
                                eventImages[
                                    eventImageIndex
                                ]
                            );

                        } else {

                            showOlderCommentsForEventImages();
                            startCloudRotation();

                            eventImageIndex =
                                (
                                    eventImageIndex + 1
                                ) %
                                eventImages.length;

                        }

                        showImageNext = !showImageNext;

                    },
                    5000
                );

        }


        function stopEventImagesDisplay() {

            eventImagesActive = false;

            stopEventImagesCycle();

            eventImages = [];
            eventImageIndex = 0;

            hideEventImageDisplay();

            renderClouds();
            startCloudRotation();

            console.log(
                'Display gambar event dihentikan.'
            );

        }


        channel.listen(
            '.event.images.display.control',
            function (data) {

                console.log(
                    'Arahan Display Gambar Event diterima:',
                    data
                );

                if (!data) {
                    return;
                }

                if (
                    Number(data.event_id) !==
                    Number(eventId)
                ) {
                    console.warn(
                        'Arahan gambar event diabaikan: Event ID tidak sepadan.',
                        data
                    );

                    return;
                }

                const action =
                    String(data.action || '')
                        .toLowerCase();

                if (action === 'start') {

                    startEventImagesDisplay(
                        data.images || []
                    );

                    return;
                }

                if (action === 'stop') {

                    stopEventImagesDisplay();

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Flip Number Counter
        |--------------------------------------------------------------------------
        */

        function prepareFlipCounter(counter) {

            if (!counter || counter.dataset.flipReady === '1') {
                return;
            }

            const value = String(
                Math.max(0, parseInt(counter.textContent.replace(/[^0-9]/g, ''), 10) || 0)
            );

            counter.textContent = '';
            counter.classList.add('flip-counter');
            counter.dataset.flipReady = '1';
            counter.dataset.flipValue = value;

            [...value].forEach((digit) => {

                const wrapper = document.createElement('span');
                wrapper.className = 'flip-digit';
                wrapper.dataset.value = digit;

                const current = document.createElement('span');
                current.className = 'digit-current';
                current.textContent = digit;

                const next = document.createElement('span');
                next.className = 'digit-next';
                next.textContent = digit;

                wrapper.appendChild(current);
                wrapper.appendChild(next);
                counter.appendChild(wrapper);

            });
        }


        function setFlipCounterValue(counter, value, animate = true) {

            if (!counter) {
                return;
            }

            prepareFlipCounter(counter);

            const parsedValue = parseInt(value, 10);
            const newValue = String(
                Math.max(0, Number.isFinite(parsedValue) ? parsedValue : 0)
            );

            const oldValue =
                counter.dataset.flipValue
                ||
                [...counter.querySelectorAll('.flip-digit')]
                    .map((digit) => digit.dataset.value)
                    .join('')
                || '0';

            // Simpan nilai sasaran SEBELUM animasi bermula.
            // Ini mengelakkan event realtime berturut-turut membaca
            // textContent yang mengandungi digit-current + digit-next.
            counter.dataset.flipValue = newValue;

            if (oldValue === newValue) {
                return;
            }

            const oldDigits = [...oldValue];
            const newDigits = [...newValue];

            if (oldDigits.length !== newDigits.length) {

                counter.textContent = '';

                newDigits.forEach((digit) => {

                    const wrapper = document.createElement('span');
                    wrapper.className = 'flip-digit';
                    wrapper.dataset.value = digit;

                    const current = document.createElement('span');
                    current.className = 'digit-current';
                    current.textContent = oldValue.length === newValue.length
                        ? digit
                        : '0';

                    const next = document.createElement('span');
                    next.className = 'digit-next';
                    next.textContent = digit;

                    wrapper.appendChild(current);
                    wrapper.appendChild(next);
                    counter.appendChild(wrapper);

                    if (animate) {
                        requestAnimationFrame(() => {
                            wrapper.classList.add('is-flipping');

                            setTimeout(() => {
                                current.textContent = digit;
                                next.textContent = digit;
                                wrapper.dataset.value = digit;
                                wrapper.classList.remove('is-flipping');
                            }, 540);
                        });
                    } else {
                        current.textContent = digit;
                        next.textContent = digit;
                        wrapper.dataset.value = digit;
                    }
                });

                return;
            }

            newDigits.forEach((digit, index) => {

                const wrapper = counter.querySelectorAll('.flip-digit')[index];

                if (!wrapper || wrapper.dataset.value === digit) {
                    return;
                }

                const current = wrapper.querySelector('.digit-current');
                const next = wrapper.querySelector('.digit-next');

                next.textContent = digit;

                if (!animate) {
                    current.textContent = digit;
                    wrapper.dataset.value = digit;
                    return;
                }

                wrapper.classList.remove('is-flipping');
                void wrapper.offsetWidth;
                wrapper.classList.add('is-flipping');

                setTimeout(() => {
                    current.textContent = digit;
                    next.textContent = digit;
                    wrapper.dataset.value = digit;
                    wrapper.classList.remove('is-flipping');
                }, 540);
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Tarikh Flip
        |--------------------------------------------------------------------------
        */

        function buildDateTimeFlip(element, value) {
            if (!element) return;

            element.innerHTML = '';

            const text = String(value);
            const isDate = element.id === 'current-date';

            [...text].forEach((character, index) => {

                if (/\d/.test(character)) {
                    const digit = document.createElement('span');
                    digit.className = 'clock-digit';

                    if (isDate) {
                        digit.classList.add('date-digit');
                    }

                    digit.dataset.value = character;
                    digit.dataset.tokenIndex = index;

                    const current = document.createElement('span');
                    current.className = 'digit-current';
                    current.textContent = character;

                    const next = document.createElement('span');
                    next.className = 'digit-next';
                    next.textContent = character;

                    digit.append(current, next);
                    element.appendChild(digit);
                } else if (isDate && character === '-') {
                    const separator = document.createElement('span');
                    separator.className = 'date-separator';
                    separator.textContent = '-';
                    element.appendChild(separator);
                }
            });

            element.dataset.value = text;
        }

        function setDateTimeFlip(element, value, animate = true) {
            if (!element) return;

            const newValue = String(value);
            const oldValue = element.dataset.value || '';

            if (!oldValue) {
                buildDateTimeFlip(element, newValue);
                return;
            }

            const newDigits = [...newValue].filter(character => /\d/.test(character));
            const digitElements = [...element.querySelectorAll('.date-digit')];

            if (digitElements.length !== newDigits.length) {
                buildDateTimeFlip(element, newValue);
                return;
            }

            digitElements.forEach((digit, index) => {
                updateFlipDigit(digit, newDigits[index], animate);
            });

            element.dataset.value = newValue;
        }

        function updateFlipDigit(digit, character, animate = true) {
            if (!digit || digit.dataset.value === character) {
                return;
            }

            const current = digit.querySelector('.digit-current');
            const next = digit.querySelector('.digit-next');

            next.textContent = character;

            if (!animate) {
                current.textContent = character;
                digit.dataset.value = character;
                return;
            }

            digit.classList.remove('is-flipping');
            void digit.offsetWidth;
            digit.classList.add('is-flipping');

            window.setTimeout(() => {
                current.textContent = character;
                next.textContent = character;
                digit.dataset.value = character;
                digit.classList.remove('is-flipping');
            }, 620);
        }


        function initializeCurrentDateTime() {
            updateCurrentDateTime(false);

            const tick = () => {
                updateCurrentDateTime(true);
                window.setTimeout(tick, 1000);
            };

            const now = new Date();
            const delay = 1000 - now.getMilliseconds();

            window.setTimeout(tick, delay);
        }


        function formatCurrentDate() {
            const now = new Date();
            const months = [
                'Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun',
                'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember'
            ];

            const day = String(now.getDate()).padStart(2, '0');
            const month = months[now.getMonth()];
            const year = String(now.getFullYear());

            return `${day}-${String(now.getMonth() + 1).padStart(2, '0')}-${year}`;
        }


        function initializeCurrentDateOnly() {
            const dateElement = document.getElementById('current-date');

            if (!dateElement) return;

            // Gunakan tarikh pada laptop/PC/browser yang membuka Live Display.
            setDateTimeFlip(dateElement, formatCurrentDate(), false);

            let lastDate = formatCurrentDate();

            const tick = () => {
                const currentDate = formatCurrentDate();

                if (currentDate !== lastDate) {
                    setDateTimeFlip(dateElement, currentDate, true);
                    lastDate = currentDate;
                }

                window.setTimeout(tick, 1000);
            };

            window.setTimeout(tick, 1000);
        }


        /* ==========================================================
         * HARI FLIP
         * ========================================================== */

        function buildDayFlip(element, value) {

            if (!element) return;

            element.innerHTML = '';

            const text =
                String(value)
                    .toUpperCase()
                    .replace(/[^A-Z]/g, '');

            [...text].forEach((character) => {

                const wrapper =
                    document.createElement('span');

                wrapper.className =
                    'day-flip-letter';

                wrapper.dataset.value =
                    character;

                const current =
                    document.createElement('span');

                current.className =
                    'day-current';

                current.textContent =
                    character;

                const next =
                    document.createElement('span');

                next.className =
                    'day-next';

                next.textContent =
                    character;

                wrapper.append(
                    current,
                    next
                );

                element.appendChild(
                    wrapper
                );

            });

            element.dataset.value =
                text;
        }


        function setDayFlip(
            element,
            value,
            animate = true
        ) {

            if (!element) return;

            const newValue =
                String(value)
                    .toUpperCase()
                    .replace(/[^A-Z]/g, '');

            const oldValue =
                element.dataset.value ||
                '';

            if (!oldValue) {

                buildDayFlip(
                    element,
                    newValue
                );

                return;
            }

            if (
                oldValue.length !==
                newValue.length
            ) {

                buildDayFlip(
                    element,
                    newValue
                );

                return;
            }

            const letters =
                [...element.querySelectorAll(
                    '.day-flip-letter'
                )];

            [...newValue].forEach(
                (character, index) => {

                    const letter =
                        letters[index];

                    if (!letter) {
                        return;
                    }

                    if (
                        letter.dataset.value ===
                        character
                    ) {
                        return;
                    }

                    const current =
                        letter.querySelector(
                            '.day-current'
                        );

                    const next =
                        letter.querySelector(
                            '.day-next'
                        );

                    next.textContent =
                        character;

                    if (!animate) {

                        current.textContent =
                            character;

                        next.textContent =
                            character;

                        letter.dataset.value =
                            character;

                        return;
                    }

                    letter.classList.remove(
                        'is-flipping'
                    );

                    void letter.offsetWidth;

                    letter.classList.add(
                        'is-flipping'
                    );

                    window.setTimeout(
                        () => {

                            current.textContent =
                                character;

                            next.textContent =
                                character;

                            letter.dataset.value =
                                character;

                            letter.classList.remove(
                                'is-flipping'
                            );

                        },
                        540
                    );

                }
            );

            element.dataset.value =
                newValue;
        }


        function formatCurrentDay() {

            const days = [
                'AHAD',
                'ISNIN',
                'SELASA',
                'RABU',
                'KHAMIS',
                'JUMAAT',
                'SABTU'
            ];

            return days[
                new Date().getDay()
            ];
        }


        function initializeCurrentDayOnly() {

            const dayElement =
                document.getElementById(
                    'current-day'
                );

            if (!dayElement) {
                return;
            }

            let lastDay =
                formatCurrentDay();

            setDayFlip(
                dayElement,
                lastDay,
                false
            );

            const tick =
                () => {

                    const currentDay =
                        formatCurrentDay();

                    if (
                        currentDay !==
                        lastDay
                    ) {

                        setDayFlip(
                            dayElement,
                            currentDay,
                            true
                        );

                        lastDay =
                            currentDay;

                    }

                    window.setTimeout(
                        tick,
                        1000
                    );

                };

            window.setTimeout(
                tick,
                1000
            );

        }


        function initializeFlipCounters() {

            prepareFlipCounter(
                document.getElementById('visitor-count')
            );

            prepareFlipCounter(
                document.getElementById('comment-count')
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Visitor Count +1
        |--------------------------------------------------------------------------
        */

        function incrementVisitorCount() {

            const counter =
                document.getElementById(
                    'visitor-count'
                );


            if (!counter) {
                return;
            }


            prepareFlipCounter(counter);

            const current =
                parseInt(
                    counter.dataset.flipValue,
                    10
                ) || 0;


            setFlipCounterValue(
                counter,
                current + 1,
                true
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Comment Count +1
        |--------------------------------------------------------------------------
        */

        function incrementCommentCount() {

            const counter =
                document.getElementById(
                    'comment-count'
                );


            if (!counter) {
                return;
            }


            prepareFlipCounter(counter);

            const current =
                parseInt(
                    counter.dataset.flipValue,
                    10
                ) || 0;


            setFlipCounterValue(
                counter,
                current + 1,
                true
            );


            refreshCloudRotation();

        }


        /*
        |--------------------------------------------------------------------------
        | Realtime Status UI
        |--------------------------------------------------------------------------
        */

        function initializeDisplayQr() {

            const canvas =
                document.getElementById(
                    'display-qr-code'
                );

            const urlElement =
                document.getElementById(
                    'display-qr-url'
                );

            const errorBox =
                document.getElementById(
                    'display-qr-error'
                );

            if (!canvas || !urlElement) {
                return;
            }

            const registerUrl =
                urlElement.dataset.url;

            if (!registerUrl) {

                console.error(
                    'URL QR pendaftaran kosong.'
                );

                if (errorBox) {
                    errorBox.textContent =
                        'URL pendaftaran tidak tersedia.';
                    errorBox.style.display = 'block';
                }

                return;
            }

            if (
                !window.QRCode ||
                typeof window.QRCode.toCanvas !== 'function'
            ) {

                console.error(
                    'QRCode library tidak tersedia.'
                );

                if (errorBox) {
                    errorBox.textContent =
                        'QR Code tidak dapat dijana.';
                    errorBox.style.display = 'block';
                }

                return;
            }

            window.QRCode.toCanvas(
                canvas,
                registerUrl,
                {
                    width: 122,
                    margin: 4,
                    errorCorrectionLevel: 'H',
                    color: {
                        dark: '#000000',
                        light: '#ffffff'
                    }
                },
                function (error) {

                    if (error) {

                        console.error(
                            'QR generation error:',
                            error
                        );

                        if (errorBox) {
                            errorBox.textContent =
                                'Gagal menjana QR Code.';
                            errorBox.style.display = 'block';
                        }

                        return;
                    }

                    console.log(
                        'QR pendaftaran berjaya dijana:',
                        registerUrl
                    );

                }
            );

        }


        function updateRealtimeStatus(
            connected,
            message
        ) {

            const dot =
                document.getElementById(
                    'realtime-dot'
                );


            const text =
                document.getElementById(
                    'realtime-status-text'
                );


            if (dot) {

                dot.classList.toggle(
                    'connected',
                    connected
                );


                dot.classList.toggle(
                    'disconnected',
                    !connected
                );

            }


            if (text) {

                text.textContent =
                    message;

            }

        }


    }
);




        // GUESTBOOK BACKGROUND SLIDESHOW — tukar setiap 4 saat, looping.
        (function initGuestbookBackgroundSlideshow() {
            const slides = Array.from(document.querySelectorAll('#guestbook-bg-slideshow .guestbook-bg-slide'));
            if (!slides.length) return;

            let current = 0;

            slides.forEach((slide, index) => {
                slide.classList.toggle('is-active', index === 0);
                slide.addEventListener('error', () => {
                    console.warn('Guestbook background gagal dimuat:', slide.src);
                });
            });

            window.setInterval(() => {
                slides[current].classList.remove('is-active');
                current = (current + 1) % slides.length;
                slides[current].classList.add('is-active');
            }, 4000);
        })();
</script>



<script>
(function () {
    const bgSlides = Array.from(document.querySelectorAll('.header-right-bg-slide'));

    if (bgSlides.length > 1 && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        let current = 0;
        setInterval(() => {
            bgSlides[current].classList.remove('is-active');
            current = (current + 1) % bgSlides.length;
            bgSlides[current].classList.add('is-active');
        }, 4000);
    }

    // V44: layout TV dikawal oleh CSS viewport (vh/dvh), jadi satu skrin tanpa scroll.
    document.documentElement.style.setProperty('--tv-top-space', '0px');
    document.documentElement.style.setProperty('--tv-guestbook-top', '36vh');
})();
</script>



<script id="fie-counter-copy-exact-date-day-style">
/* ============================================================
 * FIE FINAL BETUL-BETUL — COUNTER COPY STYLE TARIKH / HARI
 *
 * Jangan teka saiz lagi.
 * JS akan ambil STYLE SEBENAR yang sedang digunakan oleh
 * digit TARIKH / HARI di browser dan COPY TERUS kepada:
 *   1. JUMLAH PENGUNJUNG
 *   2. nombor flip PENGUNJUNG
 *   3. KOMEN
 *   4. nombor flip KOMEN
 *
 * Hasilnya font-family, font-size, weight, line-height,
 * letter-spacing, warna, stroke dan shadow adalah sama.
 * Background / kotak flip kekal transparent.
 * ============================================================ */

(function () {

    function copyImportant(target, source, property) {
        if (!target || !source) return;

        const value = getComputedStyle(source).getPropertyValue(property);
        if (value) {
            target.style.setProperty(property, value.trim(), 'important');
        }
    }

    function applyCounterStyle(counterElement, referenceElement) {
        if (!counterElement || !referenceElement) return;

        const source = getComputedStyle(referenceElement);

        const textProperties = [
            'font-family',
            'font-size',
            'font-weight',
            'font-style',
            'font-variant',
            'font-stretch',
            'line-height',
            'letter-spacing',
            'text-transform',
            'color',
            '-webkit-text-fill-color',
            '-webkit-text-stroke-width',
            '-webkit-text-stroke-color',
            'text-shadow'
        ];

        textProperties.forEach(function (property) {
            copyImportant(counterElement, referenceElement, property);
        });

        /* Counter luar tidak boleh ada background / kotak. */
        const transparentProperties = [
            'background',
            'background-color',
            'background-image',
            'border',
            'border-radius',
            'box-shadow',
            'outline'
        ];

        transparentProperties.forEach(function (property) {
            if (property === 'background') {
                counterElement.style.setProperty('background', 'transparent', 'important');
            } else if (property === 'background-color') {
                counterElement.style.setProperty('background-color', 'transparent', 'important');
            } else if (property === 'background-image') {
                counterElement.style.setProperty('background-image', 'none', 'important');
            } else if (property === 'border') {
                counterElement.style.setProperty('border', '0', 'important');
            } else if (property === 'border-radius') {
                counterElement.style.setProperty('border-radius', '0', 'important');
            } else if (property === 'box-shadow') {
                counterElement.style.setProperty('box-shadow', 'none', 'important');
            } else if (property === 'outline') {
                counterElement.style.setProperty('outline', 'none', 'important');
            }
        });
    }

    function syncCountersExactly() {

        const reference =
            document.querySelector(
                '.old-comments-panel > .header-b-meta .header-b-date .date-digit > span'
            ) ||
            document.querySelector(
                '.old-comments-panel > .header-b-meta .day-flip-letter > span'
            );

        if (!reference) return;

        const statLabels = document.querySelectorAll(
            '.old-comments-panel > .stats > .stat:nth-child(2) .stat-label,' +
            '.old-comments-panel > .stats > .stat:nth-child(3) .stat-label'
        );

        const counters = document.querySelectorAll(
            '.old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,' +
            '.old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter'
        );

        const digits = document.querySelectorAll(
            '.old-comments-panel > .stats > .stat:nth-child(2) .flip-digit > span,' +
            '.old-comments-panel > .stats > .stat:nth-child(3) .flip-digit > span'
        );

        statLabels.forEach(function (element) {
            applyCounterStyle(element, reference);
        });

        counters.forEach(function (element) {
            applyCounterStyle(element, reference);
        });

        digits.forEach(function (element) {
            applyCounterStyle(element, reference);
        });
    }

    function startExactSync() {
        /* Initial selepas semua counter flip telah dibina. */
        syncCountersExactly();

        /* Pantau perubahan DOM kerana counter flip boleh dibina semula. */
        const observer = new MutationObserver(function () {
            syncCountersExactly();
        });

        const panel = document.querySelector('.old-comments-panel');
        if (panel) {
            observer.observe(panel, {
                childList: true,
                subtree: true,
                characterData: true
            });
        }

        /* Satu lagi sync selepas browser selesai paint. */
        window.setTimeout(syncCountersExactly, 100);
        window.setTimeout(syncCountersExactly, 500);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', startExactSync);
    } else {
        startExactSync();
    }
})();
</script>


<style id="fie-header-shrink-5pct-left-right">
/* ============================================================
 * FIE — HEADER DISPLAY DIKECILKAN 5% KIRI + 5% KANAN
 * Hanya kotak HEADER. Kandungan Guestbook di bawah tidak disentuh.
 * Responsive mobile kekal menggunakan layout asal.
 * ============================================================ */
@media (min-width: 901px) {
    .header {
        margin-left: 5% !important;
        margin-right: 5% !important;
    }
}
</style>


<style id="fie-fasa1-display-to-main">
/* ============================================================
   FASA 1 — DISPLAY TO MAIN
   Panel kanan sahaja berubah selama 20 saat.
   Komen Terkini di kiri tidak disentuh.
   ============================================================ */

.old-comments-panel {
    position: relative !important;
}

.main-signature-display {
    display: none;
    width: 100%;
    min-height: 430px;
    opacity: 0;
    transform: translateY(18px) scale(.985);
    transition:
        opacity .55s ease,
        transform .65s cubic-bezier(.22,.8,.24,1);
}

.main-signature-display.show {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.old-comments-panel.main-signature-mode #cloud-stage {
    display: none !important;
}

.old-comments-panel.main-signature-mode .old-comments-caption {
    display: none !important;
}

.old-comments-panel.main-signature-mode .main-signature-display {
    display: block;
}

.main-signature-panel {
    width: 100%;
    min-height: 430px;
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    border-radius: 18px;
    overflow: hidden;
    background:
        linear-gradient(
            135deg,
            rgba(5,5,5,.96) 0%,
            rgba(20,20,20,.96) 100%
        );
    border: 1px solid rgba(212,175,55,.38);
    box-shadow:
        0 16px 35px rgba(0,0,0,.24),
        inset 0 1px 0 rgba(255,255,255,.08);
}

.main-signature-image-wrap {
    min-width: 0;
    min-height: 430px;
    padding: 26px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 16px;
    border-right: 1px solid rgba(212,175,55,.25);
}

.main-signature-label {
    color: #FFD700;
    font-size: 15px;
    font-weight: 900;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-align: center;
}

.main-signature-image-frame {
    width: 100%;
    min-height: 285px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 18px;
    border-radius: 16px;
    background: rgba(255,255,255,.98);
    box-shadow:
        0 12px 30px rgba(0,0,0,.28),
        inset 0 1px 0 rgba(255,255,255,.95);
}

.main-signature-image-frame img {
    display: block;
    width: 100%;
    max-width: 100%;
    max-height: 255px;
    object-fit: contain;
}

.main-signature-message {
    min-width: 0;
    min-height: 430px;
    padding: 30px 26px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    background:
        linear-gradient(
            180deg,
            rgba(11,11,11,.35),
            rgba(0,0,0,.60)
        );
}

.main-signature-welcome {
    color: #FFD700;
    font-family: Georgia, "Times New Roman", serif;
    font-size: clamp(22px, 2.2vw, 34px);
    font-weight: 900;
    line-height: 1.15;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-shadow: 0 2px 7px rgba(0,0,0,.65);
}

.main-signature-name {
    margin-top: 24px;
    color: #ffffff;
    font-size: clamp(22px, 2.15vw, 34px);
    font-weight: 950;
    line-height: 1.18;
    text-shadow: 0 2px 7px rgba(0,0,0,.65);
}

.main-signature-position {
    margin-top: 10px;
    color: #F8E7A8;
    font-size: clamp(15px, 1.45vw, 23px);
    font-weight: 800;
    line-height: 1.35;
    max-width: 95%;
    text-shadow: 0 2px 6px rgba(0,0,0,.65);
}

.main-signature-thanks {
    margin-top: 28px;
    color: #ffffff;
    font-size: clamp(18px, 1.75vw, 28px);
    font-weight: 900;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-shadow: 0 2px 7px rgba(0,0,0,.65);
}

@media (max-width: 760px) {

    .main-signature-panel {
        grid-template-columns: 1fr;
        min-height: 430px;
    }

    .main-signature-image-wrap {
        min-height: 210px;
        padding: 18px;
        border-right: 0;
        border-bottom: 1px solid rgba(212,175,55,.25);
    }

    .main-signature-message {
        min-height: 220px;
        padding: 22px 18px;
    }

    .main-signature-image-frame {
        min-height: 150px;
    }

    .main-signature-image-frame img {
        max-height: 130px;
    }
}

@media (prefers-reduced-motion: reduce) {

    .main-signature-display {
        transition: none !important;
        transform: none !important;
    }
}

/* ============================================================
 * FASA 3 — DISPLAY GAMBAR EVENT
 * Hanya menggantikan panel Komen Terdahulu secara sementara.
 * Komen Terkini di kiri tidak disentuh.
 * ============================================================ */

.event-images-display {
    display: none;
    width: 100%;
    min-height: 430px;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 14px;
    opacity: 0;
    transform: translateY(16px) scale(.985);
    transition:
        opacity .55s ease,
        transform .65s cubic-bezier(.22,.8,.24,1);
}

.event-images-display.show {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.old-comments-panel.event-images-mode #cloud-stage {
    display: none !important;
}

.old-comments-panel.event-images-mode .old-comments-caption {
    display: none !important;
}

.old-comments-panel.event-images-mode .event-images-display {
    display: flex;
}

.event-image-frame {
    width: 100%;
    min-height: 360px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    border-radius: 18px;
    background:
        linear-gradient(
            135deg,
            rgba(255,255,255,.98),
            rgba(248,242,232,.98)
        );
    border: 1px solid rgba(212,175,55,.40);
    box-shadow:
        0 14px 32px rgba(0,0,0,.18),
        inset 0 1px 0 rgba(255,255,255,.95);
    overflow: hidden;
}

#event-display-image {
    display: block;
    width: 100%;
    height: 100%;
    max-width: 100%;
    max-height: 330px;
    object-fit: contain;
    object-position: center center;
}

.event-display-caption {
    min-height: 22px;
    max-width: 92%;
    color: #F8E7A8;
    font-size: clamp(13px, 1.05vw, 18px);
    font-weight: 800;
    line-height: 1.3;
    text-align: center;
    text-shadow: 0 2px 6px rgba(0,0,0,.60);
}

@media (max-width: 760px) {
    .event-images-display {
        min-height: 360px;
    }

    .event-image-frame {
        min-height: 250px;
    }

    #event-display-image {
        max-height: 230px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .event-images-display {
        transition: none !important;
        transform: none !important;
    }
}
</style>


</body>



<!-- FIE V91 — SCREEN DISPLAY STABILITY FIX -->
<style id="fie-v91-screen-stability-fix">
/*
 * FIX GETAR / BERGETAR PADA PAPARAN TV
 *
 * Punca yang paling ketara:
 * .guestbook-bg-slide dan .header-right-bg-slide menggunakan
 * transform scale(...) secara berterusan semasa slideshow.
 *
 * Slideshow kini kekal statik pada skala asal dan hanya menggunakan
 * fade opacity. Layout, JS, Reverb, counter dan komen tidak diubah.
 */

/* Main Guestbook background slideshow — FADE SAHAJA */
.guestbook-bg-slide {
    transform: none !important;
    transition: opacity 1.15s ease-in-out !important;
    will-change: opacity;
}

.guestbook-bg-slide.is-active {
    transform: none !important;
}

/* Header B background slideshow — FADE SAHAJA */
.header-right-bg-slide {
    transform: none !important;
    transition: opacity 1.15s ease-in-out !important;
    will-change: opacity;
}

.header-right-bg-slide.is-active {
    transform: none !important;
}

/* Pastikan pembungkus utama tidak menghasilkan gerakan visual tambahan. */
.guestbook-bg-slideshow,
.header-right-bg {
    transform: none !important;
}
</style>

</html>

<style id="fie-v79-header-qr-clean">
/* ============================================================
 * FIE V79 — HEADER PENDEK + GUESTBOOK NAMPAK + QR CLEAN
 *
 * BASE: 100% kod V78 Fie.
 * UBAH SAHAJA:
 * 1. Header dikecilkan tinggi supaya tidak terlalu ke atas.
 * 2. Artwork header guna contain supaya MELAKA + GUESTBOOK
 *    tidak dipotong.
 * 3. Jarak bawah header dikurangkan supaya Event + Location
 *    lebih cepat masuk dan jelas.
 * 4. TARIKH + HARI dibuang dari paparan.
 * 5. QR dipastikan ada label QR PENDAFTARAN +
 *    SCAN UNTUK PENDAFTARAN, tanpa kotak keliling.
 * ============================================================ */

@media (min-width: 1101px) {

    /* =========================================================
       HEADER — LEBIH RENDAH / PENDEK
       ========================================================= */
    .header {
        height: 35vh !important;
        min-height: 0 !important;
        margin: 0 auto !important;
        overflow: visible !important;
    }

    .header-split {
        height: 35vh !important;
        min-height: 0 !important;
    }

    /* Artwork A: pendek sedikit tetapi penuh.
       contain = gambar ori tidak dipotong. */
    .header-left {
        height: 22vh !important;
        min-height: 0 !important;
        flex: 0 0 22vh !important;
        padding: 0 !important;
        align-items: center !important;
        justify-content: center !important;
        overflow: hidden !important;
    }

    .guestbook-header-logo {
        width: 100% !important;
        height: 21.5vh !important;
        max-width: none !important;
        max-height: none !important;
        margin: 0 !important;
        object-fit: contain !important;
        object-position: center center !important;
        border-radius: 16px !important;
    }

    /* Ruang B masuk terus selepas artwork. */
    .header-right {
        height: 13vh !important;
        min-height: 13vh !important;
        flex: 0 0 13vh !important;
        margin: 0 !important;
        padding: 0.4vh 3vw 0.25vh !important;
        justify-content: center !important;
        gap: .25vh !important;
    }

    .header-right .event {
        font-size: clamp(20px, 2.20vw, 37px) !important;
        line-height: 1.03 !important;
        max-width: 97% !important;
    }

    .header-right .location {
        font-size: clamp(14px, 1.25vw, 21px) !important;
        line-height: 1.04 !important;
        max-width: 97% !important;
    }

    /* Guestbook turun tepat selepas header baru. */
    .guestbook,
    .stats {
        top: 35vh !important;
    }

    /* =========================================================
       QR — LABEL WAJIB + TIADA KOTAK
       ========================================================= */
    .old-comments-panel > .stats > .event-qr-card {
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        outline: none !important;
        padding: 0 !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        display: block !important;
        margin: 0 !important;
        color: #861b24 !important;
        -webkit-text-fill-color: #861b24 !important;
        font-size: 15px !important;
        line-height: 1.05 !important;
        font-weight: 950 !important;
        letter-spacing: .8px !important;
        text-align: center !important;
        text-shadow: 0 1px 2px rgba(255,255,255,.96) !important;
        white-space: nowrap !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
        display: block !important;
        margin: 2px 0 0 !important;
        color: #861b24 !important;
        -webkit-text-fill-color: #861b24 !important;
        font-size: 10px !important;
        line-height: 1 !important;
        font-weight: 950 !important;
        letter-spacing: .45px !important;
        text-align: center !important;
        text-shadow: 0 1px 2px rgba(255,255,255,.96) !important;
        white-space: nowrap !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 126px !important;
        height: 126px !important;
        max-width: none !important;
        max-height: none !important;
        display: block !important;
        margin: 5px auto 0 !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-caption {
        color: #861b24 !important;
        font-size: 8px !important;
        font-weight: 800 !important;
        text-align: center !important;
        text-shadow: 0 1px 2px rgba(255,255,255,.96) !important;
    }

    /* Tarikh/hari memang sudah dibuang dari HTML; selector berikut
       hanya sebagai perlindungan jika markup lama ter-cache. */
    .header-b-meta {
        display: none !important;
    }
}

@media (max-width: 1100px) and (min-width: 761px) {
    .header {
        height: 34vh !important;
        min-height: 0 !important;
    }

    .header-split {
        height: 34vh !important;
    }

    .header-left {
        height: 21vh !important;
        flex-basis: 21vh !important;
        padding: 0 !important;
    }

    .guestbook-header-logo {
        width: 100% !important;
        height: 20.5vh !important;
        object-fit: contain !important;
        object-position: center center !important;
    }

    .header-right {
        height: 13vh !important;
        flex-basis: 13vh !important;
        margin: 0 !important;
    }

    .guestbook,
    .stats {
        top: 34vh !important;
    }

    .old-comments-panel > .stats > .event-qr-card {
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
        padding: 0 !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        display: block !important;
        color: #861b24 !important;
        -webkit-text-fill-color: #861b24 !important;
        font-size: 13px !important;
        font-weight: 950 !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
        display: block !important;
        color: #861b24 !important;
        -webkit-text-fill-color: #861b24 !important;
        font-size: 9px !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 126px !important;
        height: 126px !important;
    }

    .header-b-meta {
        display: none !important;
    }
}

@media (max-width: 760px) {
    .header-b-meta {
        display: none !important;
    }

    .old-comments-panel > .stats > .event-qr-card {
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        display: block !important;
        color: #861b24 !important;
        -webkit-text-fill-color: #861b24 !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
        display: block !important;
        color: #861b24 !important;
        -webkit-text-fill-color: #861b24 !important;
    }
}
</style>


<style id="fie-v80-header-stats-naik">
/* ============================================================
 * FIE V80 — HEADER BESAR + QR / COUNTER / KOMEN TERDAHULU NAIK
 *
 * BASE:
 * 100% kod asal Fie yang dikongsi.
 *
 * HANYA:
 * 1. Header A dibesarkan semula supaya lebih memenuhi kotak.
 * 2. Gambar header kekal contain supaya MELAKA + GUESTBOOK nampak.
 * 3. Ruang B Event + Location kekal jelas.
 * 4. QR + JUMLAH PENGUNJUNG + KOMEN dinaikkan ke bahagian atas
 *    ruang kanan.
 * 5. Komen Terdahulu turut naik mengikut susunan baharu.
 * 6. QR kekal tanpa kotak.
 * 7. Realtime / JS / Controller / database tidak disentuh.
 * ============================================================ */

@media (min-width: 1101px) {

    /* =========================================================
       1 — HEADER
       A BESAR SEMULA, B KEKAL DALAM HEADER YANG SAMA
       ========================================================= */

    .header {
        height: 35vh !important;
        min-height: 0 !important;
        margin: 0 auto !important;
        overflow: visible !important;
    }

    .header-split {
        height: 35vh !important;
        min-height: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 0 !important;
        overflow: visible !important;
    }

    /* Kotak header A dibesarkan */
    .header-left {
        width: 100% !important;
        height: 25vh !important;
        min-height: 0 !important;
        flex: 0 0 25vh !important;
        margin: 0 !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        overflow: hidden !important;
        background: transparent !important;
    }

    /* Gambar ori header diperbesarkan.
       contain = perkataan MELAKA + GUESTBOOK tidak dicrop. */
    .guestbook-header-logo {
        position: relative !important;
        left: auto !important;
        top: auto !important;
        right: auto !important;
        bottom: auto !important;

        width: 100% !important;
        height: 24.5vh !important;
        max-width: none !important;
        max-height: none !important;

        margin: 0 !important;
        padding: 0 !important;

        object-fit: contain !important;
        object-position: center center !important;

        border-radius: 16px !important;

        background: #ffffff !important;
    }

    /* B: tinggal cukup ruang untuk EVENT + LOCATION */
    .header-right {
        width: 100% !important;
        height: 10vh !important;
        min-height: 10vh !important;
        flex: 0 0 10vh !important;

        margin: 0 !important;
        padding: .25vh 3vw .2vh !important;

        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;

        gap: .25vh !important;
        overflow: visible !important;

        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    .header-right .event {
        width: 100% !important;
        max-width: 97% !important;
        margin: 0 !important;

        font-size: clamp(20px, 2.18vw, 36px) !important;
        line-height: 1.02 !important;
        letter-spacing: .7px !important;
        white-space: normal !important;

        text-align: center !important;
    }

    .header-right .location {
        width: 100% !important;
        max-width: 97% !important;
        margin: 0 !important;

        font-size: clamp(14px, 1.22vw, 21px) !important;
        line-height: 1.02 !important;
        letter-spacing: .3px !important;
        white-space: normal !important;

        text-align: center !important;
    }

    /* Jangan ubah kedudukan overall page.
       Guestbook kekal bermula pada bawah header. */
    .guestbook {
        top: 35vh !important;
    }

    /* =========================================================
       2 — QR + COUNTER
       NAIK KE ATAS DALAM RUANG MERAH
       ========================================================= */

    .old-comments-panel {
        padding-top: 0.8vh !important;
    }

    .old-comments-panel > .stats {
        position: relative !important;
        top: auto !important;
        left: auto !important;
        right: auto !important;

        width: 100% !important;
        height: 12vh !important;
        min-height: 0 !important;

        margin: 0 !important;
        padding: 0 !important;

        transform: translateY(-0.4vh) !important;

        display: grid !important;
        grid-template-columns: 1.10fr .95fr .95fr !important;
        grid-template-rows: 12vh !important;
        gap: .65vw !important;

        background: transparent !important;
        overflow: visible !important;
        z-index: 40 !important;
    }

    .old-comments-panel > .stats > .event-qr-card,
    .old-comments-panel > .stats > .stat {
        height: 12vh !important;
        min-height: 0 !important;
        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        overflow: visible !important;
    }

    /* QR — kekal tiada kotak */
    .old-comments-panel > .stats > .event-qr-card {
        padding: 0 !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        display: block !important;
        visibility: visible !important;

        color: #861b24 !important;
        -webkit-text-fill-color: #861b24 !important;

        font-size: clamp(9px,.65vw,12px) !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        text-align: center !important;
        white-space: nowrap !important;

        text-shadow: 0 1px 3px rgba(255,255,255,.95) !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
        display: block !important;
        visibility: visible !important;

        color: #861b24 !important;
        -webkit-text-fill-color: #861b24 !important;

        font-size: clamp(6px,.48vw,9px) !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        text-align: center !important;
        white-space: nowrap !important;

        text-shadow: 0 1px 3px rgba(255,255,255,.95) !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 126px !important;
        height: 126px !important;
        max-width: none !important;
        max-height: none !important;

        display: block !important;
        margin: .3vh auto 0 !important;
    }

    /* Counter: naik bersama QR */
    .old-comments-panel > .stats > .stat {
        justify-content: flex-start !important;
        padding-top: 1.2vh !important;
    }

    .old-comments-panel > .stats > .stat .stat-label {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        font-size: clamp(9px,.68vw,12px) !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        text-align: center !important;

        text-shadow:
            0 2px 5px rgba(45,5,10,.88),
            0 0 5px rgba(255,255,255,.22) !important;
    }

    .old-comments-panel > .stats > .stat .stat-value.flip-counter {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        margin-top: .35vh !important;

        text-shadow:
            0 2px 6px rgba(45,5,10,.90),
            0 0 6px rgba(255,255,255,.25) !important;
    }

    .old-comments-panel > .stats > .stat .flip-digit > span {
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;

        text-shadow:
            0 2px 6px rgba(45,5,10,.90),
            0 0 6px rgba(255,255,255,.25) !important;
    }

    /* =========================================================
       3 — KOMEN TERDAHULU TURUT NAIK
       ========================================================= */

    .old-comments-panel > .cloud-stage {
        position: relative !important;

        height: calc(100% - 12vh) !important;
        min-height: 0 !important;

        margin: .15vh 0 0 !important;
        padding-top: 0 !important;

        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    /* =========================================================
       4 — BACKGROUND ANIMASI KEKAL TERANG + PEKAT
       ========================================================= */

    .guestbook-bg-slide {
        filter:
            saturate(1.34)
            brightness(1.08)
            contrast(1.14) !important;

        transition:
            opacity 1.15s ease-in-out,
            transform 5s ease-in-out !important;
    }

    .guestbook-bg-slide.is-active {
        opacity: .68 !important;
    }
}

/* ============================================================
   TV 1600px+
   ============================================================ */
@media (min-width: 1600px) {

    .header {
        height: 35vh !important;
    }

    .header-split {
        height: 35vh !important;
    }

    .header-left {
        height: 25vh !important;
        flex-basis: 25vh !important;
    }

    .guestbook-header-logo {
        height: 24.5vh !important;
        object-fit: contain !important;
        object-position: center center !important;
    }

    .header-right {
        height: 10vh !important;
        min-height: 10vh !important;
        flex-basis: 10vh !important;
    }

    .guestbook {
        top: 35vh !important;
    }

    .old-comments-panel {
        padding-top: .8vh !important;
    }

    .old-comments-panel > .stats {
        height: 12vh !important;
        grid-template-rows: 12vh !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 126px !important;
        height: 126px !important;
    }
}

/* ============================================================
   Tablet
   ============================================================ */
@media (min-width: 761px) and (max-width: 1100px) {

    .header-left {
        height: 245px !important;
        flex-basis: 245px !important;
    }

    .guestbook-header-logo {
        height: 228px !important;
        object-fit: contain !important;
        object-position: center center !important;
    }

    .header-right {
        height: 170px !important;
        min-height: 170px !important;
        flex-basis: 170px !important;
    }

    .old-comments-panel {
        padding-top: 8px !important;
    }

    .old-comments-panel > .stats {
        height: 116px !important;
        grid-template-rows: 116px !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 126px !important;
        height: 126px !important;
    }
}
</style>

<style id="fie-v81-comment-c-down-qr-title-130">
/* ============================================================
 * FIE V81 — RUANG C TURUN 40% + QR PENDAFTARAN +30%
 *
 * BASE: V80 / kod asal Fie.
 * HANYA 2 PERUBAHAN:
 * 1. Ruang / kotak KOMEN TERKINI (C) diturunkan 40% daripada
 *    kedudukan semasa untuk beri lebih ruang visual kepada
 *    EVENT + LOCATION di atas.
 * 2. Perkataan "QR PENDAFTARAN" dibesarkan 130% daripada
 *    saiz V80 semasa.
 *
 * Reverb / Echo / JS / QR function / counter / slideshow
 * TIDAK disentuh.
 * ============================================================ */

@media (min-width: 901px) {

    /* =========================================================
       1 — RUANG C / KOMEN TERKINI TURUN 40%
       
       Hanya panel kiri yang digerakkan ke bawah.
       Ruang header EVENT + LOCATION tidak disentuh.
       ========================================================= */
    .latest-comments-panel {
        position: relative !important;
        top: 40% !important;
        height: 60% !important;
        min-height: 0 !important;
        overflow: hidden !important;
    }

    #latest-comments-container {
        height: 100% !important;
        max-height: none !important;
        overflow: hidden !important;
    }

    /* =========================================================
       2 — "QR PENDAFTARAN" BESAR 130%
       V80 asal: clamp(9px,.65vw,12px)
       V81: 130% daripada nilai tersebut.
       ========================================================= */
    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        font-size: clamp(11.7px, .845vw, 15.6px) !important;
        line-height: 1 !important;
        letter-spacing: .8px !important;
        font-weight: 950 !important;
        white-space: nowrap !important;
    }
}

/* ============================================================
   TV BESAR
   ============================================================ */
@media (min-width: 1600px) {

    .latest-comments-panel {
        top: 40% !important;
        height: 60% !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        font-size: 15.6px !important;
    }
}

/* ============================================================
   TABLET LANDSCAPE
   ============================================================ */
@media (min-width: 761px) and (max-width: 900px) {

    .latest-comments-panel {
        top: 40% !important;
        height: 60% !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        font-size: 11.7px !important;
    }
}

/* MOBILE — jangan ubah kedudukan responsive asal. */
@media (max-width: 760px) {
    .latest-comments-panel {
        top: auto !important;
        height: 100% !important;
    }
}
</style>


<style id="fie-v83-latest-comments-naik">
/* ============================================================
 * FIE V83 — KOMEN TERKINI NAIK KE ATAS
 *
 * HANYA ubah kedudukan panel KOMEN TERKINI.
 * QR, EVENT, LOCATION, KOMEN TERDAHULU, slideshow,
 * Reverb, Echo dan fungsi JavaScript lain tidak disentuh.
 * ============================================================ */

@media (min-width: 901px) {
    .latest-comments-panel {
        position: relative !important;
        top: 0 !important;
        height: 100% !important;
        min-height: 0 !important;
        margin-top: 0 !important;
        padding-top: 0 !important;
        overflow: hidden !important;
    }

    #latest-comments-container {
        height: 100% !important;
        max-height: none !important;
        overflow: hidden !important;
    }
}

@media (max-width: 900px) {
    .latest-comments-panel {
        top: auto !important;
        height: 100% !important;
    }
}
</style>


<style id="fie-v84-kotak-c-ikut-merah">
/* ============================================================
 * FIE V84 — RUANG BAWAH / KOTAK C IKUT LAKARAN MERAH FIE
 *
 * HANYA ubah saiz + kedudukan KOTAK GUESTBOOK utama.
 * Objektif:
 *   - satu kotak 4 segi penuh untuk seluruh ruang bawah
 *   - kiri / kanan ikut margin lakaran
 *   - mula tepat di bawah header EVENT + LOCATION
 *   - memanjang sampai hampir ke bahagian bawah skrin
 *
 * Isi dalam kotak (Komen Terkini, Komen Terdahulu, QR,
 * counter, slideshow, Reverb/Echo dan JS) tidak diubah.
 * ============================================================ */

@media (min-width: 901px) {
    .guestbook {
        position: absolute !important;

        /* IKUT KOTAK MERAH */
        left: 2.3vw !important;
        right: 2.3vw !important;

        /* mula tepat selepas bahagian header */
        top: 35vh !important;

        /* turun sampai hampir hujung skrin */
        bottom: 1.35vh !important;

        width: auto !important;
        height: auto !important;
        min-height: 0 !important;

        margin: 0 !important;

        /* ruang dalam kotak dikekalkan kemas */
        padding: 1.15vh 1.35vw .9vh !important;

        border-radius: 16px !important;
        overflow: hidden !important;
        box-sizing: border-box !important;
    }

    /* Pastikan kandungan memenuhi keseluruhan kotak C */
    .guestbook-columns {
        width: 100% !important;
        height: calc(100% - 3.8vh) !important;
        min-height: 0 !important;
    }

    .latest-comments-panel,
    .old-comments-panel {
        min-height: 0 !important;
        height: 100% !important;
        overflow: hidden !important;
    }
}

/* TV besar — margin kotak kekal seperti lakaran Fie */
@media (min-width: 1600px) {
    .guestbook {
        left: 2.3vw !important;
        right: 2.3vw !important;
        top: 35vh !important;
        bottom: 1.35vh !important;
    }
}

/* Tablet landscape */
@media (min-width: 761px) and (max-width: 900px) {
    .guestbook {
        position: absolute !important;
        left: 2.3vw !important;
        right: 2.3vw !important;
        top: 35vh !important;
        bottom: 1.35vh !important;
        width: auto !important;
        height: auto !important;
    }
}
</style>


<style id="fie-v85-7-comments-qr-final">
/* ============================================================
 * FIE V85 — 7 KOMEN TERKINI + QR TRANSPARENT + SCAN +50%
 *
 * HANYA:
 * 1. Papar 7 komen terkini serentak.
 * 2. Komen terdahulu bermula selepas 7 komen terkini.
 * 3. Buang BG putih pada QR.
 * 4. SCAN UNTUK PENDAFTARAN = +50% dan putih.
 * ============================================================ */

/* 7 komen terkini — ruang menyesuaikan isi */
#latest-comments-container {
    overflow: hidden !important;
}

/* QR panel sudah transparent; paksa sekali lagi */
.header-left > .event-qr-card {
    background: transparent !important;
    background-color: transparent !important;
    border: 0 !important;
    box-shadow: none !important;
}

/* QR canvas — TIADA kotak putih belakang */
.header-left > .event-qr-card .event-qr-canvas {
    background: transparent !important;
    background-color: transparent !important;
    box-shadow: none !important;
    filter:
        drop-shadow(0 2px 4px rgba(255,255,255,.78))
        drop-shadow(0 3px 7px rgba(0,0,0,.78)) !important;
}

/* SCAN UNTUK PENDAFTARAN — desktop +50% daripada 18px = 27px */
@media (min-width: 901px) {
    .header-left > .event-qr-card .event-qr-subtitle {
        font-size: 27px !important;
        line-height: 1 !important;
        font-weight: 950 !important;
        letter-spacing: .8px !important;
        white-space: nowrap !important;
        background: transparent !important;
        background-color: transparent !important;
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .25px rgba(0,0,0,.55) !important;
        text-shadow:
            0 3px 6px rgba(0,0,0,.98),
            0 0 8px rgba(0,0,0,.72) !important;
        border: 0 !important;
        border-radius: 0 !important;
        padding: 0 !important;
    }
}

/* TV besar kekal jelas */
@media (min-width: 1600px) {
    .header-left > .event-qr-card .event-qr-subtitle {
        font-size: 27px !important;
    }
}

/* Tablet landscape: 12px -> 18px */
@media (min-width: 761px) and (max-width: 900px) {
    .header-left > .event-qr-card .event-qr-subtitle {
        font-size: 18px !important;
        line-height: 1 !important;
        background: transparent !important;
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        padding: 0 !important;
        border: 0 !important;
        box-shadow: none !important;
    }
}

/* Mobile: 8px -> 12px */
@media (max-width: 760px) {
    .header-left > .event-qr-card .event-qr-subtitle {
        font-size: 12px !important;
        background: transparent !important;
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        padding: 0 !important;
        border: 0 !important;
        box-shadow: none !important;
    }
}
</style>



<style id="fie-v86-qr-clear-down-final">
/* ============================================================
 * FIE V86 — QR JELAS + LABEL PAPAR + TURUN SEDIKIT
 *
 * GUNA TERUS KOD FIE YANG DIKONGSI.
 *
 * HANYA:
 * 1. QR tidak transparent — background putih sebenar pada canvas.
 * 2. "QR PENDAFTARAN" dipaksa visible.
 * 3. "SCAN UNTUK PENDAFTARAN" dipaksa visible.
 * 4. Seluruh blok QR digerakkan sedikit ke bawah.
 * 5. TIADA kotak/card luar QR.
 * 6. Reverb / Echo / JS / counter / komen / slideshow tidak diubah.
 * ============================================================ */

/* Desktop / TV */
@media (min-width: 901px) {

    /* QR block: turun sedikit supaya label tidak tersorok */
    .old-comments-panel > .stats > .event-qr-card {
        position: relative !important;
        transform: translateY(22px) !important;

        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        padding: 0 !important;
        overflow: visible !important;

        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: flex-start !important;

        z-index: 120 !important;
    }

    /* QR PENDAFTARAN — mesti nampak */
    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;

        margin: 0 0 3px !important;
        padding: 0 !important;

        width: max-content !important;
        max-width: none !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .45px #3b1f0b !important;

        font-family: Arial, Helvetica, sans-serif !important;
        font-size: clamp(15px, 1.15vw, 22px) !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        letter-spacing: .8px !important;
        white-space: nowrap !important;
        text-align: center !important;

        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;

        text-shadow:
            0 2px 4px rgba(0,0,0,.96),
            0 0 8px rgba(0,0,0,.72) !important;
    }

    /* SCAN UNTUK PENDAFTARAN — jelas + putih */
    .old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;

        margin: 0 0 4px !important;
        padding: 0 !important;

        width: max-content !important;
        max-width: none !important;

        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        -webkit-text-stroke: .35px #3b1f0b !important;

        font-family: Arial, Helvetica, sans-serif !important;
        font-size: clamp(13px, .92vw, 18px) !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        letter-spacing: .6px !important;
        white-space: nowrap !important;
        text-align: center !important;

        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;

        text-shadow:
            0 2px 4px rgba(0,0,0,.96),
            0 0 7px rgba(0,0,0,.70) !important;
    }

    /* QR sebenar — PUTIH, tajam, tidak transparent */
    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        display: block !important;

        width: 126px !important;
        height: 126px !important;

        max-width: none !important;
        max-height: none !important;

        margin: 2px auto 0 !important;

        background: #FFFFFF !important;
        background-color: #FFFFFF !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow:
            0 2px 7px rgba(0,0,0,.42) !important;

        opacity: 1 !important;
        visibility: visible !important;

        /* Jangan ubah warna QR — kekalkan hitam/putih asal */
        filter: none !important;
    }

    /* Caption kekal kecil supaya tidak ganggu */
    .old-comments-panel > .stats > .event-qr-card .event-qr-caption {
        display: none !important;
    }
}

/* TV besar — sedikit lebih besar untuk tajuk, QR kekal 126px */
@media (min-width: 1600px) {

    .old-comments-panel > .stats > .event-qr-card {
        transform: translateY(26px) !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        font-size: 22px !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
        font-size: 18px !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 126px !important;
        height: 126px !important;
    }
}

/* Tablet landscape */
@media (min-width: 761px) and (max-width: 900px) {

    .old-comments-panel > .stats > .event-qr-card {
        transform: translateY(14px) !important;

        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
        overflow: visible !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        display: block !important;
        visibility: visible !important;
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        font-size: 14px !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        white-space: nowrap !important;
        text-shadow: 0 2px 4px rgba(0,0,0,.96) !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
        display: block !important;
        visibility: visible !important;
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        font-size: 11px !important;
        font-weight: 950 !important;
        line-height: 1 !important;
        white-space: nowrap !important;
        text-shadow: 0 2px 4px rgba(0,0,0,.96) !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 126px !important;
        height: 126px !important;
        background: #FFFFFF !important;
        background-color: #FFFFFF !important;
        filter: none !important;
    }
}

/* Mobile */
@media (max-width: 760px) {

    .old-comments-panel > .stats > .event-qr-card {
        transform: translateY(8px) !important;
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
        overflow: visible !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title {
        display: block !important;
        visibility: visible !important;
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        font-size: 13px !important;
        font-weight: 950 !important;
        white-space: nowrap !important;
        text-shadow: 0 2px 4px rgba(0,0,0,.96) !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
        display: block !important;
        visibility: visible !important;
        color: #FFFFFF !important;
        -webkit-text-fill-color: #FFFFFF !important;
        font-size: 10px !important;
        font-weight: 950 !important;
        white-space: nowrap !important;
        text-shadow: 0 2px 4px rgba(0,0,0,.96) !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        width: 126px !important;
        height: 126px !important;
        background: #FFFFFF !important;
        background-color: #FFFFFF !important;
        filter: none !important;
    }
}
</style>

<style id="fie-v89-header-soft-qr-counter-15">
/* ============================================================
 * FIE V89 — HEADER SOFT EDGE + QR SEBARIS + COUNTER +15%
 *
 * BASE:
 * Guna terus kod Fie yang diberikan.
 *
 * HANYA:
 * 1. Header artwork diberi feather / soft fade di semua tepi
 *    supaya tidak nampak seperti kotak keras.
 * 2. QR disamakan kedudukan menegak dengan label JUMLAH
 *    PENGUNJUNG dan KOMEN — satu baris/grid, tiada translate turun.
 * 3. JUMLAH PENGUNJUNG + KOMEN + nombor flip dibesarkan 15%.
 *
 * Reverb / Echo / JavaScript / QR generation / slideshow / komen
 * tidak diubah.
 * ============================================================ */

@media (min-width: 901px) {

    /* =========================================================
       1 — HEADER EDGE: SOFT / FEATHER / BLENDED
       ========================================================= */

    .header-left {
        position: relative !important;
        overflow: hidden !important;

        /* Tiada kotak keras */
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        background:
            linear-gradient(
                180deg,
                rgba(134,27,36,.98) 0%,
                rgba(134,27,36,.96) 100%
            ) !important;

        /*
         * Feather sebenar pada artwork:
         * tengah kekal 100%, tepi perlahan-lahan blend
         * dengan background luar.
         */
        -webkit-mask-image:
            radial-gradient(
                ellipse 92% 92% at center,
                rgba(0,0,0,1) 0%,
                rgba(0,0,0,1) 64%,
                rgba(0,0,0,.96) 74%,
                rgba(0,0,0,.78) 84%,
                rgba(0,0,0,.38) 93%,
                rgba(0,0,0,0) 100%
            ) !important;

        mask-image:
            radial-gradient(
                ellipse 92% 92% at center,
                rgba(0,0,0,1) 0%,
                rgba(0,0,0,1) 64%,
                rgba(0,0,0,.96) 74%,
                rgba(0,0,0,.78) 84%,
                rgba(0,0,0,.38) 93%,
                rgba(0,0,0,0) 100%
            ) !important;
    }

    .guestbook-header-logo {
        position: relative !important;
        z-index: 2 !important;

        /*
         * Artwork penuh seperti sedia ada.
         * Jangan ubah nisbah / crop daripada kod Fie.
         */
        width: 100% !important;
        height: 100% !important;
        max-width: none !important;
        max-height: none !important;

        object-fit: cover !important;
        object-position: center center !important;

        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;

        /*
         * Jangan guna transform/zoom — ini penting supaya
         * tepi tidak "bergetar" dan artwork kekal stabil.
         */
        transform: none !important;
    }

    /*
     * Soft overlay sangat halus di perimeter:
     * membantu transisi artwork -> background tanpa
     * menghasilkan garis sempadan keras.
     */
    .header-left::after {
        display: block !important;
        content: "" !important;
        position: absolute !important;
        inset: 0 !important;
        z-index: 4 !important;
        pointer-events: none !important;

        background:
            radial-gradient(
                ellipse 94% 94% at center,
                rgba(134,27,36,0) 0%,
                rgba(134,27,36,0) 67%,
                rgba(134,27,36,.08) 77%,
                rgba(134,27,36,.26) 88%,
                rgba(134,27,36,.62) 96%,
                rgba(134,27,36,.92) 100%
            ) !important;

        box-shadow:
            inset 0 0 42px 14px rgba(134,27,36,.34) !important;
    }


    /* =========================================================
       2 — QR + JUMLAH + KOMEN = SATU BARIS / SATU KEDUDUKAN
       ========================================================= */

    .old-comments-panel > .stats {
        display: grid !important;
        align-items: center !important;
        align-content: start !important;
    }

    /*
     * QR sebelum ini ditolak ke bawah 22px.
     * Kembalikan ke kedudukan tengah yang sama dengan dua counter.
     */
    .old-comments-panel > .stats > .event-qr-card {
        position: relative !important;

        top: auto !important;
        left: auto !important;
        right: auto !important;

        transform: none !important;

        align-self: center !important;

        margin: 0 !important;
    }

    /*
     * Kedua-dua counter juga berada pada center yang sama.
     */
    .old-comments-panel > .stats > .stat:nth-child(2),
    .old-comments-panel > .stats > .stat:nth-child(3) {
        position: relative !important;

        top: auto !important;
        right: auto !important;

        align-self: center !important;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }


    /* =========================================================
       3 — JUMLAH PENGUNJUNG + KOMEN = +15%
       ========================================================= */

    /*
     * Guna scale supaya JS "copy exact style" pada flip counter
     * tidak mengembalikan font-size asal.
     *
     * Font fizikal tidak ditulis semula; visual dibesarkan 15%.
     */

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        transform: scale(1.15) !important;
        transform-origin: center center !important;
        display: block !important;
        white-space: nowrap !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        transform: scale(1.15) !important;
        transform-origin: center center !important;
    }

    /*
     * Setiap digit tidak diskalakan sekali lagi.
     * Animasi FLIP dalaman kekal.
     */
    .old-comments-panel > .stats > .stat:nth-child(2) .flip-digit,
    .old-comments-panel > .stats > .stat:nth-child(3) .flip-digit {
        transform-origin: center center !important;
    }
}


/* ============================================================
 * TV BESAR
 * ============================================================ */
@media (min-width: 1600px) {

    .header-left {
        -webkit-mask-image:
            radial-gradient(
                ellipse 92% 92% at center,
                rgba(0,0,0,1) 0%,
                rgba(0,0,0,1) 64%,
                rgba(0,0,0,.96) 74%,
                rgba(0,0,0,.78) 84%,
                rgba(0,0,0,.38) 93%,
                rgba(0,0,0,0) 100%
            ) !important;

        mask-image:
            radial-gradient(
                ellipse 92% 92% at center,
                rgba(0,0,0,1) 0%,
                rgba(0,0,0,1) 64%,
                rgba(0,0,0,.96) 74%,
                rgba(0,0,0,.78) 84%,
                rgba(0,0,0,.38) 93%,
                rgba(0,0,0,0) 100%
            ) !important;
    }

    .old-comments-panel > .stats > .event-qr-card {
        transform: none !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        transform: scale(1.15) !important;
        transform-origin: center center !important;
    }
}


/* ============================================================
 * TABLET LANDSCAPE
 * ============================================================ */
@media (min-width: 761px) and (max-width: 1100px) {

    .header-left {
        border: 0 !important;
        border-radius: 0 !important;

        -webkit-mask-image:
            radial-gradient(
                ellipse 94% 94% at center,
                rgba(0,0,0,1) 0%,
                rgba(0,0,0,1) 64%,
                rgba(0,0,0,.94) 80%,
                rgba(0,0,0,.55) 92%,
                rgba(0,0,0,0) 100%
            ) !important;

        mask-image:
            radial-gradient(
                ellipse 94% 94% at center,
                rgba(0,0,0,1) 0%,
                rgba(0,0,0,1) 64%,
                rgba(0,0,0,.94) 80%,
                rgba(0,0,0,.55) 92%,
                rgba(0,0,0,0) 100%
            ) !important;
    }

    .old-comments-panel > .stats > .event-qr-card {
        transform: none !important;
        align-self: center !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2),
    .old-comments-panel > .stats > .stat:nth-child(3) {
        align-self: center !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        transform: scale(1.15) !important;
        transform-origin: center center !important;
    }
}


/* ============================================================
 * MOBILE — kekalkan responsive
 * ============================================================ */
@media (max-width: 760px) {

    .header-left {
        border: 0 !important;
        border-radius: 0 !important;

        -webkit-mask-image:
            radial-gradient(
                ellipse 96% 96% at center,
                rgba(0,0,0,1) 0%,
                rgba(0,0,0,1) 68%,
                rgba(0,0,0,.90) 84%,
                rgba(0,0,0,.48) 94%,
                rgba(0,0,0,0) 100%
            ) !important;

        mask-image:
            radial-gradient(
                ellipse 96% 96% at center,
                rgba(0,0,0,1) 0%,
                rgba(0,0,0,1) 68%,
                rgba(0,0,0,.90) 84%,
                rgba(0,0,0,.48) 94%,
                rgba(0,0,0,0) 100%
            ) !important;
    }

    .old-comments-panel > .stats > .event-qr-card {
        transform: none !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        transform: scale(1.15) !important;
        transform-origin: center center !important;
    }
}


    /* ============================================================
     * V90 — ROUND HEADER + EVENT/LOCATION + GREY DIALOG BOXES
     * Hanya ubah visual yang diminta Fie.
     * ============================================================ */

    /* Header kiri: rounded pada semua hujung */
    .header-left {
        border-radius: 28px !important;
        overflow: hidden !important;
    }

    /* Kotak EVENT + LOKASI: rounded pada semua hujung */
    .header-right {
        border-radius: 28px !important;
        overflow: hidden !important;
    }

    /*
     * Semua dialog / bubble KOMEN TERDAHULU:
     * satu warna kelabu sahaja.
     * Animasi, posisi dan timing KEKAL.
     */
    .cloud,
    .cloud:nth-child(1),
    .cloud:nth-child(2),
    .cloud:nth-child(3),
    .cloud:nth-child(4),
    .cloud:nth-child(5),
    .cloud:nth-child(6) {
        background: #6b7280 !important;
        border-color: #9ca3af !important;
        color: #ffffff !important;
    }

    .cloud::before,
    .cloud:nth-child(1)::before,
    .cloud:nth-child(2)::before,
    .cloud:nth-child(3)::before,
    .cloud:nth-child(4)::before,
    .cloud:nth-child(5)::before,
    .cloud:nth-child(6)::before {
        background: #6b7280 !important;
        border-right-color: #9ca3af !important;
        border-bottom-color: #9ca3af !important;
    }

    .cloud-name,
    .cloud-message {
        color: #ffffff !important;
    }

</style>

<style id="fie-final-middle-separator-left-10">
/* ============================================================
 * FIE FINAL — GARIS PEMISAH TENGAH GERAK KE KIRI 10%
 *
 * HANYA:
 * - Garisan antara KOMEN TERKINI dan KOMEN TERDAHULU
 *   digerakkan 10% ke kiri.
 * - Kandungan kedua-dua panel TIDAK digerakkan.
 * - QR / SCAN / counter / bubble / animasi / JS / Reverb kekal.
 *
 * Garisan asal ialah border-left pada .old-comments-panel.
 * Border tersebut dibuang dan diganti dengan pseudo-element
 * supaya HANYA garisan bergerak ke kiri.
 * ============================================================ */

@media (min-width: 901px) {

    .old-comments-panel {
        position: relative !important;

        /* Buang garisan asal di kedudukan lama. */
        border-left: 0 !important;

        /* Benarkan garisan baharu berada 10% ke sebelah kiri. */
        overflow: visible !important;
    }

    .old-comments-panel::before {
        content: "" !important;

        position: absolute !important;
        top: 0 !important;
        bottom: 0 !important;

        /* Gerak tepat 10% ke kiri daripada lebar panel kanan. */
        left: -10% !important;

        width: 1px !important;

        background: rgba(120,88,40,.30) !important;
        box-shadow: none !important;

        pointer-events: none !important;
        z-index: 10 !important;
    }
}

/* Tablet landscape — garis bergerak sama 10%. */
@media (min-width: 761px) and (max-width: 900px) {

    .old-comments-panel {
        position: relative !important;
        border-left: 0 !important;
    }

    .old-comments-panel::before {
        content: "" !important;
        position: absolute !important;
        top: 0 !important;
        bottom: 0 !important;
        left: -10% !important;
        width: 1px !important;
        background: rgba(120,88,40,.30) !important;
        pointer-events: none !important;
        z-index: 10 !important;
    }
}
</style>



<style id="fie-final-middle-separator-transparent">
/* ============================================================
 * FIE FINAL — GARIS PEMISAH TENGAH TRANSPARENT
 * Hanya jadikan garisan pemisah antara Komen Terkini /
 * Komen Terdahulu tidak kelihatan.
 * Kandungan lain tidak diubah.
 * ============================================================ */

.old-comments-panel {
    border-left: 0 !important;
}

.old-comments-panel::before {
    background: transparent !important;
    box-shadow: none !important;
}
</style>


<style id="fie-final-counter-labels-same-row-qr">
/* ============================================================
 * FIE FINAL — LABEL JUMLAH PENGUNJUNG + KOMEN
 *             SAMA BARIS DENGAN QR PENDAFTARAN
 *
 * Hanya perkataan label dialihkan ke atas.
 * Nombor flip, QR, komen, JS, Reverb dan layout lain dikekalkan.
 * ============================================================ */

@media (min-width: 901px) {

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        position: relative !important;
        top: -42px !important;
    }
}

@media (min-width: 1600px) {

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        top: -42px !important;
    }
}

@media (min-width: 761px) and (max-width: 900px) {

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-label,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-label {
        position: relative !important;
        top: -32px !important;
    }
}
</style>


<style id="fie-final-qr-counter-aligned-flip20">
/* ============================================================
 * FIE FINAL — QR + COUNTER DISEJAJARKAN
 *
 * HANYA:
 * 1. QR PENDAFTARAN dinaikkan supaya sebaris dengan
 *    JUMLAH PENGUNJUNG + KOMEN.
 * 2. SCAN UNTUK PENDAFTARAN dinaikkan bersama QR.
 * 3. QR kod sebenar dinaikkan bersama QR.
 * 4. Angka FLIP JUMLAH PENGUNJUNG + KOMEN dibesarkan 20%
 *    daripada saiz semasa.
 *
 * Label JUMLAH PENGUNJUNG + KOMEN yang sudah dinaikkan
 * kekal pada kedudukan sedia ada.
 *
 * JS / Reverb / QR generation / komen / bubble / slideshow
 * tidak diubah.
 * ============================================================ */

@media (min-width: 901px) {

    /* =========================================================
       QR PENDAFTARAN + SCAN + QR KOD
       Naik tepat ke paras label counter.
       ========================================================= */

    .old-comments-panel > .stats > .event-qr-card {
        transform: translateY(-42px) !important;
    }

    .old-comments-panel > .stats > .event-qr-card .event-qr-title,
    .old-comments-panel > .stats > .event-qr-card .event-qr-subtitle,
    .old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
        position: relative !important;
        top: 0 !important;
    }


    /* =========================================================
       ANGKA FLIP — BESAR 20% DARIPADA SAIZ SEMASA
       V89 semasa = scale(1.15)
       1.15 x 1.20 = 1.38
       ========================================================= */

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        transform: scale(1.38) !important;
        transform-origin: center center !important;
    }
}


/* ============================================================
   TV BESAR
   ============================================================ */
@media (min-width: 1600px) {

    .old-comments-panel > .stats > .event-qr-card {
        transform: translateY(-42px) !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        transform: scale(1.38) !important;
        transform-origin: center center !important;
    }
}


/* ============================================================
   TABLET LANDSCAPE
   ============================================================ */
@media (min-width: 761px) and (max-width: 900px) {

    .old-comments-panel > .stats > .event-qr-card {
        transform: translateY(-32px) !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        transform: scale(1.38) !important;
        transform-origin: center center !important;
    }
}


/* ============================================================
   MOBILE
   ============================================================ */
@media (max-width: 760px) {

    .old-comments-panel > .stats > .event-qr-card {
        transform: translateY(-20px) !important;
    }

    .old-comments-panel > .stats > .stat:nth-child(2) .stat-value.flip-counter,
    .old-comments-panel > .stats > .stat:nth-child(3) .stat-value.flip-counter {
        transform: scale(1.38) !important;
        transform-origin: center center !important;
    }
}
</style>


<style id="fie-final-guestbook-static-blue-gradient">
/* ============================================================
 * FIE FINAL — KOTAK KOMEN TERKINI + KOMEN TERDAHULU
 *
 * HANYA PERUBAHAN:
 * 1. Buang visual animasi/slideshow background dalam kotak Guestbook.
 * 2. Tukar background kotak kepada biru gradient statik.
 *
 * Semua kandungan komen, QR, counter, bubble, JS, Reverb dan
 * fungsi sistem lain dikekalkan.
 * ============================================================ */

.guestbook {
    background:
        linear-gradient(
            135deg,
            #083b78 0%,
            #0b5ea8 45%,
            #0b78b5 72%,
            #164f9b 100%
        ) !important;

    background-color: #0b5ea8 !important;
}

/* Hilangkan slideshow background sepenuhnya */
.guestbook-bg-slideshow {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    animation: none !important;
    transition: none !important;
}

/* Tiada lagi shade di atas background */
.guestbook-bg-shade {
    display: none !important;
    opacity: 0 !important;
    animation: none !important;
    transition: none !important;
}

/* Elakkan sebarang animasi transform pada background */
.guestbook-bg-slide,
.guestbook-bg-slide.is-active {
    display: none !important;
    transform: none !important;
    transition: none !important;
    animation: none !important;
}
</style>


<style id="fie-final-guestbook-light-maroon-gradient">
/* ============================================================
 * FIE FINAL — KOTAK KOMEN
 * BACKGROUND = LIGHT MAROON GRADIENT
 *
 * Hanya warna background ditukar.
 * Animasi background kekal dibuang.
 * Kandungan komen, QR, counter, bubble, JS dan Reverb dikekalkan.
 * ============================================================ */

.guestbook {
    background:
        linear-gradient(
            135deg,
            #6f1d2b 0%,
            #8f2f3f 42%,
            #a94757 72%,
            #7e2636 100%
        ) !important;

    background-color: #8f2f3f !important;
}
</style>


<style id="fie-final-header-full-artwork-visible">
/* ============================================================
 * FIE FINAL — HEADER SAHAJA
 *
 * Pastikan artwork header baharu memaparkan keseluruhan:
 * - Jata Melaka
 * - MELAKA
 * - DIGITAL
 * - GUESTBOOK
 *
 * Saiz/kedudukan kotak header dikekalkan.
 * Hanya cara gambar memenuhi kawasan header diubah supaya
 * bahagian atas/bawah artwork tidak lagi dipotong.
 *
 * QR, counter, komen, bubble, slideshow, JS, Reverb dan
 * bahagian lain TIDAK diubah.
 * ============================================================ */

@media (min-width: 761px) {

    .header-left {
        overflow: hidden !important;
    }

    .guestbook-header-logo {
        width: 100% !important;
        height: 100% !important;
        max-width: none !important;
        max-height: none !important;

        /* Paparkan keseluruhan artwork — jangan crop */
        object-fit: fill !important;
        object-position: center center !important;

        /* Kekalkan imej stabil */
        transform: none !important;
    }
}


/* TV besar */
@media (min-width: 1600px) {

    .guestbook-header-logo {
        width: 100% !important;
        height: 100% !important;
        max-width: none !important;
        max-height: none !important;
        object-fit: fill !important;
        object-position: center center !important;
        transform: none !important;
    }
}


/* Tablet landscape */
@media (min-width: 761px) and (max-width: 1100px) {

    .guestbook-header-logo {
        width: 100% !important;
        height: 100% !important;
        max-width: none !important;
        max-height: none !important;
        object-fit: fill !important;
        object-position: center center !important;
        transform: none !important;
    }
}
</style>


<style id="fie-final-comments-black-gradient">
/* ============================================================
 * FIE FINAL — BACKGROUND KOMEN TERKINI + KOMEN TERDAHULU
 *
 * HANYA tukar background kawasan Guestbook kepada HITAM GRADIENT.
 * Komen putih/kuning, bubble, QR, counter, header, JS, Reverb
 * dan fungsi lain tidak disentuh.
 * ============================================================ */

.guestbook {
    background:
        linear-gradient(
            135deg,
            #050505 0%,
            #111111 38%,
            #202020 68%,
            #080808 100%
        ) !important;

    background-color: #111111 !important;
}

/* Pastikan gradient Guestbook menjadi BG kedua-dua ruang komen,
   tanpa lapisan warna lama menutupnya. */
.guestbook-columns,
.latest-comments-panel,
#latest-comments-container,
.old-comments-panel,
.old-comments-panel > .cloud-stage {
    background: transparent !important;
    background-color: transparent !important;
    background-image: none !important;
}

/* Slideshow background kekal OFF — gradient hitam adalah statik. */
.guestbook-bg-slideshow,
.guestbook-bg-shade,
.guestbook-bg-slide,
.guestbook-bg-slide.is-active {
    display: none !important;
    opacity: 0 !important;
    background: transparent !important;
    animation: none !important;
    transition: none !important;
}

</style>

<style id="fie-final-government-blue-qr-clean">
/* ============================================================
 * FIE FINAL — GOVERNMENT BLUE QR CLEAN
 *
 * QR PENDAFTARAN / SCAN UNTUK PENDAFTARAN:
 * - tiada background putih
 * - tulisan putih
 *
 * QR CANVAS:
 * - putih dikekalkan untuk kebolehbacaan QR
 * ============================================================ */

body.guestbook-theme.theme-government-blue
.header-left > .event-qr-card {
    background: transparent !important;
    background-color: transparent !important;
    background-image: none !important;
    border: 0 !important;
    box-shadow: none !important;
}

body.guestbook-theme.theme-government-blue
.header-left > .event-qr-card .event-qr-title,
body.guestbook-theme.theme-government-blue
.header-left > .event-qr-card .event-qr-subtitle {
    background: transparent !important;
    background-color: transparent !important;
    background-image: none !important;
    color: #FFFFFF !important;
    -webkit-text-fill-color: #FFFFFF !important;
    -webkit-text-stroke: .35px rgba(0,0,0,.60) !important;
    border: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    padding: 0 !important;
    text-shadow:
        0 2px 5px rgba(0,0,0,.95),
        0 0 8px rgba(0,0,0,.65) !important;
}

body.guestbook-theme.theme-government-blue
.header-left > .event-qr-card .event-qr-canvas {
    background: #FFFFFF !important;
    background-color: #FFFFFF !important;
}
</style>
<style id="fie-final-government-blue-qr-clean-v2">
/* ============================================================
 * FIE FINAL V2 � GOVERNMENT BLUE QR CLEAN
 * Selector sebenar QR: .old-comments-panel > .stats > .event-qr-card
 * ============================================================ */

body.guestbook-theme.theme-government-blue
.old-comments-panel > .stats > .event-qr-card {
    background: transparent !important;
    background-color: transparent !important;
    background-image: none !important;
    border: 0 !important;
    box-shadow: none !important;
}

body.guestbook-theme.theme-government-blue
.old-comments-panel > .stats > .event-qr-card .event-qr-title,
body.guestbook-theme.theme-government-blue
.old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
    background: transparent !important;
    background-color: transparent !important;
    background-image: none !important;
    color: #FFFFFF !important;
    -webkit-text-fill-color: #FFFFFF !important;
    -webkit-text-stroke: .35px rgba(0,0,0,.60) !important;
    border: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    padding: 0 !important;
    text-shadow:
        0 2px 5px rgba(0,0,0,.95),
        0 0 8px rgba(0,0,0,.65) !important;
}

body.guestbook-theme.theme-government-blue
.old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
    background: #FFFFFF !important;
    background-color: #FFFFFF !important;
}
</style>
<style id="fie-final-modern-melaka-qr-clean">
/* ============================================================
 * FIE FINAL � MODERN MELAKA QR CLEAN
 * Label transparent, QR canvas kekal putih.
 * ============================================================ */

body.guestbook-theme.theme-modern-melaka
.old-comments-panel > .stats > .event-qr-card {
    background: transparent !important;
    background-color: transparent !important;
    background-image: none !important;
    border: 0 !important;
    box-shadow: none !important;
}

body.guestbook-theme.theme-modern-melaka
.old-comments-panel > .stats > .event-qr-card .event-qr-title,
body.guestbook-theme.theme-modern-melaka
.old-comments-panel > .stats > .event-qr-card .event-qr-subtitle {
    background: transparent !important;
    background-color: transparent !important;
    background-image: none !important;
    color: #FFFFFF !important;
    -webkit-text-fill-color: #FFFFFF !important;
    -webkit-text-stroke: .35px rgba(0,0,0,.60) !important;
    border: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    padding: 0 !important;
    text-shadow:
        0 2px 5px rgba(0,0,0,.95),
        0 0 8px rgba(0,0,0,.65) !important;
}

body.guestbook-theme.theme-modern-melaka
.old-comments-panel > .stats > .event-qr-card .event-qr-canvas {
    background: #FFFFFF !important;
    background-color: #FFFFFF !important;
}
</style>
