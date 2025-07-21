<x-layouts.app :title="__('Scan QR')">
    <div class="p-4 flex flex-col items-center gap-4">
        <flux:heading>{{ __('Scan QR Code') }}</flux:heading>
        <div id="qr-reader" class="w-64 h-64" wire:ignore></div>
        <div id="qr-result" class="mt-4 font-semibold text-center"></div>
    </div>

    <script src="https://unpkg.com/html5-qrcode@2.3.10/html5-qrcode.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const resultElem = document.getElementById('qr-result');
            const html5QrCode = new Html5Qrcode('qr-reader');
            Html5Qrcode.getCameras().then(cameras => {
                if (cameras && cameras.length) {
                    html5QrCode.start({ facingMode: 'environment' }, { fps: 10, qrbox: { width: 200, height: 200 } }, decodedText => {
                        resultElem.textContent = decodedText;
                    });
                } else {
                    resultElem.textContent = 'No camera found.';
                }
            }).catch(err => {
                resultElem.textContent = 'Error: ' + err;
            });
        });
    </script>
</x-layouts.app>
