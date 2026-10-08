import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

window.Pusher = Pusher;

try {

    window.Echo = new Echo({
        broadcaster: 'reverb',
        key: import.meta.env.VITE_REVERB_APP_KEY,
        wsHost: import.meta.env.VITE_REVERB_HOST,
        wsPort: Number(import.meta.env.VITE_REVERB_PORT ?? 80),
        wssPort: Number(import.meta.env.VITE_REVERB_PORT ?? 443),
        forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
        enabledTransports: ['ws', 'wss'],
    });

    console.log('ECHO INIT OK', {
        host: import.meta.env.VITE_REVERB_HOST,
        port: import.meta.env.VITE_REVERB_PORT,
        scheme: import.meta.env.VITE_REVERB_SCHEME,
        echo: !!window.Echo,
    });

} catch (error) {

    console.error('ECHO INIT FAILED:', error);

    window.Echo = null;

    const showError = () => {

        const element =
            document.getElementById('realtime-status');

        if (!element) {
            return;
        }

        element.textContent =
            'Echo Error: ' +
            (error?.message ?? String(error));

    };

    if (document.readyState === 'loading') {
        document.addEventListener(
            'DOMContentLoaded',
            showError,
            { once: true }
        );
    } else {
        showError();
    }

}