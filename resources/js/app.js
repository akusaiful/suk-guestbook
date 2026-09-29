/**
 * Laravel Echo
 */
import './echo';

/**
 * QR Code Generator
 */
import QRCode from 'qrcode';

window.QRCode = QRCode;

/**
 * Signature Pad
 */
import SignaturePad from 'signature_pad';

window.SignaturePad = SignaturePad;

console.log('QRCode loaded:', {
    available: !!window.QRCode,
    toCanvas: typeof window.QRCode?.toCanvas === 'function',
});

console.log('SignaturePad loaded:', {
    available: !!window.SignaturePad,
});