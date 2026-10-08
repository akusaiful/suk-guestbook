<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Melaka Digital Guestbook - Special Display</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg: #f5efe2;
            --bg-deep: #eee3ce;
            --text: #2f241c;
            --muted: #74685b;
            --gold: #b88a1b;
            --gold-soft: rgba(184,138,27,.20);
            --cream-card: rgba(255,252,245,.94);
            --cream-inner: #fffdf8;
            --line: rgba(126,95,35,.24);
            --shadow: 0 24px 70px rgba(87,67,35,.16);
        }

        * { box-sizing: border-box; }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            overflow: hidden;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
        }

        .special-display {
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            background:
                radial-gradient(circle at 50% 10%, rgba(255,255,255,.88), transparent 34%),
                radial-gradient(circle at 50% 78%, rgba(201,163,72,.12), transparent 42%),
                linear-gradient(180deg, #fffaf0 0%, #f7f0e3 52%, #eee3d0 100%);
        }

        .special-display::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            opacity: .45;
            background: repeating-linear-gradient(
                135deg,
                rgba(120,92,45,.032) 0,
                rgba(120,92,45,.032) 1px,
                transparent 1px,
                transparent 24px
            );
        }

        /* ============================================================
           HEADER IMAGE — MELAKA DIGITAL GUESTBOOK
        ============================================================ */
        .special-header {
            position: relative;
            z-index: 2;
            width: min(90vw, 1560px);
            height: 20vh;
            min-height: 145px;
            max-height: 235px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 2vh;
        }

        .special-header-image {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            filter: drop-shadow(0 10px 22px rgba(88,64,30,.18));
        }

        .header-divider {
            position: relative;
            z-index: 2;
            width: min(150px, 16vw);
            height: 2px;
            margin-top: -1.2vh;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            box-shadow: 0 0 16px var(--gold-soft);
            flex: 0 0 auto;
        }

        /* ============================================================
           CONTENT
        ============================================================ */
        .display-content {
            position: absolute;
            z-index: 2;
            left: 0;
            right: 0;
            top: 26vh;
            width: 100vw;
            height: 69vh;
            min-height: 0;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .welcome-state,
        .signature-state {
            width: 100%;
        }

        .welcome-state {
            width: min(76vw, 1060px);
            margin: 0 auto;
            padding: 5vh 4vw;
            border: 1px solid var(--line);
            border-radius: 30px;
            background: var(--cream-card);
            box-shadow: var(--shadow);
            backdrop-filter: blur(4px);
            transition: opacity .35s ease, transform .35s ease;
        }

        .welcome-state.hidden {
            opacity: 0;
            transform: translateY(12px);
            pointer-events: none;
        }

        .idle-title {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(28px, 3vw, 54px);
            font-weight: 500;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .idle-subtitle {
            margin-top: 1.5vh;
            color: #7a6a57;
            font-size: clamp(12px, 1vw, 17px);
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .signature-state {
            display: none;
            width: min(78vw, 1120px);
            max-width: calc(100vw - 80px);
            margin: 0 auto;
            align-self: flex-start;
            padding: 2.6vh 3.2vw 3.2vh;
            border: 1px solid var(--line);
            border-radius: 30px;
            background: linear-gradient(180deg, rgba(255,252,245,.98), rgba(249,241,224,.96));
            box-shadow: var(--shadow);
            opacity: 0;
            transform: translateY(12px) scale(.985);
        }

        .signature-state.show {
            display: block;
            animation: specialEnter .65s cubic-bezier(.2,.8,.2,1) forwards;
        }

        .display-label {
            margin: 0 0 1.5vh;
            color: #7a6a57;
            font-size: clamp(10px, .82vw, 14px);
            letter-spacing: .30em;
            text-transform: uppercase;
        }

        .signature-panel {
            width: min(68vw, 880px);
            max-width: calc(100% - 20px);
            height: min(27vh, 290px);
            margin: 0 auto;
            padding: 1.8vh 2.4vw;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(126,95,35,.22);
            border-radius: 24px;
            background: var(--cream-inner);
            box-shadow:
                0 14px 34px rgba(87,67,35,.12),
                inset 0 1px 0 rgba(255,255,255,.95);
        }

        .signature-image {
            display: block;
            width: auto;
            max-width: 92%;
            max-height: 24vh;
            object-fit: contain;
            filter: drop-shadow(0 10px 18px rgba(66,48,23,.18));
        }

        /* ============================================================
           WELCOME / NAME / POSITION — GAYA UTAMA DISPLAY
        ============================================================ */
        .greeting {
            margin-top: 2.1vh;
            font-family: Georgia, "Times New Roman", serif;
            text-align: center;
        }

        .greeting-main {
            margin: 0;
            font-size: clamp(34px, 3.6vw, 64px);
            line-height: 1.02;
            font-weight: 600;
            letter-spacing: .075em;
            color: #31271f;
            text-transform: uppercase;
        }

        .signer-name {
            margin: 1.1vh 0 0;
            font-size: clamp(22px, 2.2vw, 38px);
            line-height: 1.18;
            font-weight: 800;
            letter-spacing: .045em;
            color: #31271f;
            text-transform: uppercase;
        }

        .signer-position {
            margin: .65vh 0 0;
            color: #756655;
            font-size: clamp(15px, 1.35vw, 25px);
            line-height: 1.22;
            letter-spacing: .10em;
            text-transform: uppercase;
        }

        .welcome-divider {
            width: min(150px, 14vw);
            height: 2px;
            margin: 1.3vh auto 0;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .thank-you {
            margin-top: 1.1vh;
            font-size: clamp(13px, 1.05vw, 19px);
            color: #756655;
            letter-spacing: .24em;
            text-transform: uppercase;
            font-family: Georgia, "Times New Roman", serif;
        }

        .duration-bar {
            position: fixed;
            left: 18vw;
            right: 18vw;
            bottom: 3.2vh;
            height: 2px;
            border-radius: 999px;
            overflow: hidden;
            background: rgba(126,95,35,.12);
            z-index: 8;
            display: none;
        }

        .duration-bar.show { display: block; }

        .duration-progress {
            width: 100%;
            height: 100%;
            transform-origin: left center;
            transform: scaleX(1);
            background: var(--gold);
            box-shadow: 0 0 10px var(--gold-soft);
        }

        .realtime-status {
            position: fixed;
            right: 1.8vw;
            bottom: 1.4vh;
            z-index: 9;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(91,72,49,.52);
            font-size: 8px;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .realtime-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #4c9f72;
            box-shadow: 0 0 9px rgba(76,159,114,.36);
        }

        .realtime-status.offline .realtime-dot {
            background: #c85b52;
            box-shadow: 0 0 9px rgba(200,91,82,.34);
        }

        @keyframes specialEnter {
            0% { opacity: 0; transform: translateY(14px) scale(.985); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        @media (max-width: 900px) {
            .special-header {
                width: 96vw;
                height: 19vh;
                min-height: 120px;
            }

            .display-content {
                left: 0;
                right: 0;
                width: 100vw;
                top: 23vh;
                height: 73vh;
            }

            .welcome-state,
            .signature-state {
                width: 92vw;
            }

            .signature-panel {
                width: 82vw;
                height: 28vh;
            }

            .signature-image {
                max-height: 24vh;
            }
        }

        @media (max-width: 600px) {
            .special-header {
                height: 17vh;
                min-height: 100px;
            }

            .display-content {
                left: 0;
                right: 0;
                top: 21vh;
                width: 100vw;
            }

            .welcome-state,
            .signature-state {
                width: 94vw;
                border-radius: 22px;
            }

            .signature-panel {
                width: 88vw;
                height: 25vh;
                border-radius: 18px;
            }

            .signature-image {
                max-width: 96%;
                max-height: 22vh;
            }

            .display-label {
                letter-spacing: .18em;
            }
        }

        /* ============================================================
           V48 — ABSOLUTE CENTER FIX
           Semua elemen utama dipusatkan berdasarkan viewport sebenar.
           Tidak bergantung pada margin/auto dari parent.
        ============================================================ */

        html,
        body {
            width: 100%;
            max-width: 100%;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
        }

        .special-display {
            position: fixed !important;
            inset: 0 !important;
            width: 100% !important;
            height: 100% !important;
            min-width: 0 !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
        }

        .special-header {
            position: absolute !important;
            top: 1.2vh !important;
            left: 50% !important;
            width: min(76vw, 1050px) !important;
            height: 18vh !important;
            min-height: 0 !important;
            max-height: 220px !important;
            margin: 0 !important;
            transform: translateX(-50%) !important;
        }

        .special-header-image {
            width: 100% !important;
            height: 100% !important;
            margin: 0 !important;
            object-fit: contain !important;
            object-position: center center !important;
        }

        .header-divider {
            position: absolute !important;
            top: 18.9vh !important;
            left: 50% !important;
            width: 170px !important;
            height: 2px !important;
            margin: 0 !important;
            transform: translateX(-50%) !important;
        }

        .display-content {
            position: absolute !important;
            inset: 0 !important;
            width: 100% !important;
            height: 100% !important;
            min-width: 0 !important;
            min-height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            display: block !important;
        }

        .welcome-state {
            position: absolute !important;
            top: 29vh !important;
            left: 50% !important;
            width: min(68vw, 980px) !important;
            max-width: calc(100% - 48px) !important;
            margin: 0 !important;
            transform: translateX(-50%) !important;
        }

        .signature-state {
            position: absolute !important;
            top: 22vh !important;
            left: 50% !important;
            width: min(72vw, 1050px) !important;
            max-width: calc(100% - 48px) !important;
            margin: 0 !important;
            align-self: auto !important;
            transform: translateX(-50%) translateY(12px) scale(.985) !important;
        }

        .signature-state.show {
            display: block !important;
            animation: specialEnterCentered .65s cubic-bezier(.2,.8,.2,1) forwards !important;
        }

        .signature-panel {
            width: min(66vw, 860px) !important;
            max-width: calc(100% - 10px) !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .signature-image {
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .greeting {
            width: 100% !important;
            margin-left: auto !important;
            margin-right: auto !important;
            text-align: center !important;
        }

        .greeting-main,
        .signer-name,
        .signer-position,
        .thank-you {
            width: 100% !important;
            margin-left: auto !important;
            margin-right: auto !important;
            text-align: center !important;
        }

        @keyframes specialEnterCentered {
            0% {
                opacity: 0;
                transform: translateX(-50%) translateY(14px) scale(.985);
            }
            100% {
                opacity: 1;
                transform: translateX(-50%) translateY(0) scale(1);
            }
        }

        @media (max-width: 900px) {
            .special-header {
                top: 1vh !important;
                width: 88vw !important;
                height: 17vh !important;
            }

            .header-divider {
                top: 18vh !important;
            }

            .signature-state {
                top: 22vh !important;
                width: min(90vw, 760px) !important;
                max-width: calc(100% - 28px) !important;
            }

            .welcome-state {
                top: 28vh !important;
                width: 90vw !important;
                max-width: calc(100% - 28px) !important;
            }

            .signature-panel {
                width: 86vw !important;
                max-width: calc(100% - 6px) !important;
            }
        }

        @media (max-width: 600px) {
            .special-header {
                top: .6vh !important;
                width: 92vw !important;
                height: 15vh !important;
            }

            .header-divider {
                top: 16vh !important;
            }

            .signature-state {
                top: 19vh !important;
                width: 94vw !important;
                max-width: calc(100% - 18px) !important;
            }

            .signature-panel {
                width: 90vw !important;
            }
        }


        /* ============================================================
           V49 — HEADER BESAR IKUT KAWASAN KOTAK MERAH
           Header dibesarkan secara mendatar supaya memenuhi kawasan
           atas seperti lakaran Fie, tetapi kekal tepat di tengah.
        ============================================================ */

        .special-header {
            top: 1vh !important;
            left: 50% !important;
            width: min(76vw, 1050px) !important;
            height: 18vh !important;
            max-width: 1050px !important;
            max-height: 220px !important;
            margin: 0 !important;
            transform: translateX(-50%) !important;
            overflow: visible !important;
        }

        .special-header-image {
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            width: 100% !important;
            height: 100% !important;
            margin: 0 !important;
            max-width: none !important;
            max-height: none !important;
            object-fit: contain !important;
            object-position: center center !important;
            transform: translate(-50%, -50%) scaleX(2.0) scaleY(1.25) !important;
            transform-origin: center center !important;
            filter: drop-shadow(0 10px 18px rgba(90, 67, 24, .18)) !important;
        }

        .header-divider {
            top: 19.2vh !important;
        }

        @media (max-width: 900px) {
            .special-header {
                width: 86vw !important;
                height: 17vh !important;
            }

            .special-header-image {
                transform: translate(-50%, -50%) scaleX(1.7) scaleY(1.18) !important;
            }

            .header-divider {
                top: 18.2vh !important;
            }
        }

        @media (max-width: 600px) {
            .special-header {
                width: 90vw !important;
                height: 15vh !important;
            }

            .special-header-image {
                transform: translate(-50%, -50%) scaleX(1.45) scaleY(1.12) !important;
            }

            .header-divider {
                top: 16.1vh !important;
            }
        }

    </style>
</head>
<body>
    <main
        class="special-display"
        id="special-display"
        data-event-id="{{ $event->id }}"
    >

        <header class="special-header">
            <img
                class="special-header-image"
                src="{{ asset('images/bg-special-display-header.png') }}"
                alt="Melaka Digital Guestbook"
            >
        </header>

        <div class="header-divider"></div>

        <section class="display-content">

            <div class="welcome-state" id="welcome-state">
                <div class="idle-title">SELAMAT DATANG</div>
                <div class="idle-subtitle">Menunggu tandatangan tetamu kehormat</div>
            </div>

            <div
                class="signature-state"
                id="signature-state"
                aria-live="polite"
                aria-hidden="true"
            >
                <div class="display-label">Tandatangan Tetamu Kehormat</div>

                <div class="signature-panel">
                    <img
                        id="signature-image"
                        class="signature-image"
                        src=""
                        alt="Tandatangan tetamu kehormat"
                    >
                </div>

                <div class="greeting">
                    <p class="greeting-main">Selamat Datang</p>
                    <p id="signer-name" class="signer-name"></p>
                    <p id="signer-position" class="signer-position"></p>
                    <div class="welcome-divider"></div>
                    <p class="thank-you">Terima Kasih</p>
                </div>
            </div>

        </section>

        <div class="duration-bar" id="duration-bar" aria-hidden="true">
            <div class="duration-progress" id="duration-progress"></div>
        </div>

        <div class="realtime-status" id="realtime-status">
            <span class="realtime-dot"></span>
            <span>Realtime</span>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const root = document.getElementById('special-display');
            const eventId = Number(root?.dataset.eventId || 0);
            const welcomeState = document.getElementById('welcome-state');
            const signatureState = document.getElementById('signature-state');
            const signatureImage = document.getElementById('signature-image');
            const signerName = document.getElementById('signer-name');
            const signerPosition = document.getElementById('signer-position');
            const durationBar = document.getElementById('duration-bar');
            const durationProgress = document.getElementById('duration-progress');
            const realtimeStatus = document.getElementById('realtime-status');

            let displayTimer = null;

            if (!eventId) {
                console.error('Special Display: Event ID tidak sah.');
                return;
            }

            const setRealtimeStatus = (online) => {
                realtimeStatus?.classList.toggle('offline', !online);
            };

            const resetToIdle = () => {
                if (displayTimer) {
                    clearTimeout(displayTimer);
                    displayTimer = null;
                }

                durationBar?.classList.remove('show');

                if (durationProgress) {
                    durationProgress.style.transition = 'none';
                    durationProgress.style.transform = 'scaleX(1)';
                }

                signatureState?.classList.remove('show');
                signatureState?.setAttribute('aria-hidden', 'true');

                setTimeout(() => {
                    welcomeState?.classList.remove('hidden');
                }, 220);
            };

            const showSignature = (payload) => {
                if (!payload || Number(payload.event_id) !== eventId) return;

                const signatureUrl = payload.signature_url || '';
                const signer = payload.signer || {};
                const duration = Math.max(1, Number(payload.duration || 20));

                if (!signatureUrl) {
                    console.warn('Special Display: signature_url tidak diterima.', payload);
                    return;
                }

                if (displayTimer) {
                    clearTimeout(displayTimer);
                    displayTimer = null;
                }

                welcomeState?.classList.add('hidden');

                if (signatureImage) {
                    signatureImage.src = `${signatureUrl}${signatureUrl.includes('?') ? '&' : '?'}display=${Date.now()}`;
                }

                if (signerName) {
                    signerName.textContent = signer.name || '';
                }

                if (signerPosition) {
                    signerPosition.textContent = signer.position || '';
                }

                signatureState?.classList.remove('show');
                void signatureState?.offsetWidth;
                signatureState?.classList.add('show');
                signatureState?.setAttribute('aria-hidden', 'false');

                if (durationBar && durationProgress) {
                    durationBar.classList.add('show');
                    durationProgress.style.transition = 'none';
                    durationProgress.style.transform = 'scaleX(1)';
                    void durationProgress.offsetWidth;
                    durationProgress.style.transition = `transform ${duration}s linear`;
                    durationProgress.style.transform = 'scaleX(0)';
                }

                displayTimer = setTimeout(resetToIdle, duration * 1000);
            };

            if (!window.Echo) {
                console.error('Special Display: Laravel Echo tidak tersedia.');
                setRealtimeStatus(false);
                return;
            }

            try {
                const channelName = `guestbook.special.event.${eventId}`;
                const channel = window.Echo.channel(channelName);

                channel.listen('.signature.displayed.on.special', (payload) => {
                    console.log('Special Display received:', payload);
                    showSignature(payload);
                });

                const pusher = window.Echo.connector?.pusher;

                if (pusher?.connection) {
                    setRealtimeStatus(pusher.connection.state === 'connected');

                    pusher.connection.bind('connected', () => setRealtimeStatus(true));
                    pusher.connection.bind('disconnected', () => setRealtimeStatus(false));
                    pusher.connection.bind('error', () => setRealtimeStatus(false));
                } else {
                    setRealtimeStatus(false);
                }

                console.log(`Special Display listening on ${channelName}`);
            } catch (error) {
                console.error('Special Display Realtime error:', error);
                setRealtimeStatus(false);
            }
        });
    </script>
</body>
</html>
