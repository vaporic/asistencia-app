<x-layouts.app :title="__('Scan QR')">
    <div class="p-4 flex flex-col items-center gap-4">
        <flux:heading>{{ __('Scan QR Code') }}</flux:heading>
        <div id="qr-reader" class="w-64 h-64" wire:ignore></div>
        <div id="qr-result" class="mt-4 font-semibold text-center"></div>
    </div>

    <script src="https://unpkg.com/html5-qrcode@2.3.10/html5-qrcode.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const resultElem = document.getElementById('qr-result');
            const html5QrCode = new Html5Qrcode('qr-reader');

            async function requestCameraPermission() {
                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    resultElem.textContent = 'Camera API not supported.';
                    return false;
                }

                try {
                    const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                    stream.getTracks().forEach(track => track.stop());
                    return true;
                } catch (err) {
                    resultElem.textContent = 'Camera permission denied.';
                    return false;
                }
            }

            if (await requestCameraPermission()) {
                try {
                    const cameras = await Html5Qrcode.getCameras();
                    if (cameras && cameras.length) {
                        await html5QrCode.start(
                            { facingMode: 'environment' },
                            { fps: 10, qrbox: { width: 200, height: 200 } },
                            decodedText => { resultElem.textContent = decodedText; }
                        );
                    } else {
                        resultElem.textContent = 'No camera found.';
                    }
                } catch (err) {
                    resultElem.textContent = 'Error: ' + err;
                }
            }
        });
    </script>
</x-layouts.app>
