import QRCode from 'qrcode';

document.addEventListener('DOMContentLoaded', () => {

    const canvas = document.getElementById('qr-code');
    const urlElement = document.getElementById('qr-url');
    const errorBox = document.getElementById('qr-error');

    console.log('QR JS loaded');

    if (!canvas) {
        console.error('Element #qr-code tidak dijumpai.');
        return;
    }

    if (!urlElement) {
        console.error('Element #qr-url tidak dijumpai.');
        return;
    }

    const registerUrl = urlElement.dataset.url;

    console.log('QR URL:', registerUrl);

    if (!registerUrl) {

        console.error('QR URL kosong.');

        if (errorBox) {
            errorBox.textContent = 'URL QR tidak tersedia.';
            errorBox.style.display = 'block';
        }

        return;
    }

    QRCode.toCanvas(
        canvas,
        registerUrl,
        {
            width: 320,
            margin: 2,
            errorCorrectionLevel: 'H'
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

                    errorBox.style.display =
                        'block';
                }

                return;
            }

            console.log(
                'QR berjaya dijana:',
                registerUrl
            );

        }
    );

});