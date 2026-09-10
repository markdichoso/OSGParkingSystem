<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scan QR Code</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">
    <main class="mx-auto flex min-h-screen w-full max-w-lg flex-col px-5 py-8">
        <header class="mb-6 flex items-center gap-4">
            <a href="<?= rtrim(config('App')->baseURL, '/') ?>/main" aria-label="Back to dashboard"
                class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-xl shadow-sm">&larr;</a>
            <div>
                <p class="text-sm font-medium uppercase tracking-widest text-blue-600">Car Park</p>
                <h1 class="text-2xl font-bold">Scan QR code</h1>
            </div>
        </header>

        <section class="rounded-2xl bg-white p-4 shadow-sm">
            <div id="reader" class="overflow-hidden rounded-xl bg-slate-900"></div>
            <p id="scan-status" role="status" class="mt-4 text-center text-sm text-slate-600">
                Camera is ready to start.
            </p>
            <button id="start-scan" type="button"
                class="mt-4 w-full rounded-lg bg-blue-600 px-4 py-3 font-semibold text-white transition hover:bg-blue-700">
                Start camera
            </button>
            <button id="stop-scan" type="button"
                class="mt-3 hidden w-full rounded-lg border border-slate-300 px-4 py-3 font-semibold text-slate-700 transition hover:bg-slate-50">
                Stop camera
            </button>
        </section>

        <form id="scan-result-form" class="mt-5 rounded-2xl bg-white p-5 shadow-sm" action="" method="post">
            <label for="qr-result" class="block text-sm font-semibold text-slate-700">Detected value</label>
            <input id="qr-result" name="qr_code" type="text" readonly
                class="mt-2 w-full rounded-lg border border-slate-300 bg-slate-50 px-3 py-3 text-sm text-slate-900"
                placeholder="The detected QR value will appear here">
            <button id="continue-button" type="button" disabled
                class="mt-4 w-full rounded-lg bg-emerald-600 px-4 py-3 font-semibold text-white transition enabled:hover:bg-emerald-700 disabled:cursor-not-allowed disabled:opacity-50">
                Continue
            </button>
        </form>

        <p class="mt-5 text-center text-xs leading-5 text-slate-500">
            Allow camera access when prompted. Use this page over HTTPS or localhost for camera access.
        </p>
    </main>

    <script>
        const reader = new Html5Qrcode('reader');
        const startButton = document.getElementById('start-scan');
        const stopButton = document.getElementById('stop-scan');
        const resultInput = document.getElementById('qr-result');
        const continueButton = document.getElementById('continue-button');
        const status = document.getElementById('scan-status');
        let scanning = false;
        let hasDetectedCode = false;

        function showError(message) {
            status.textContent = message;
            status.className = 'mt-4 text-center text-sm text-red-600';
        }

        function handleScanSuccess(decodedText) {
            if (hasDetectedCode) {
                return;
            }

            hasDetectedCode = true;
            resultInput.value = decodedText;
            continueButton.disabled = false;
            status.textContent = 'QR code detected.';
            status.className = 'mt-4 text-center text-sm text-emerald-600';
            stopCamera();
        }

        async function startCamera() {
            if (scanning) {
                return;
            }

            hasDetectedCode = false;
            resultInput.value = '';
            continueButton.disabled = true;
            status.textContent = 'Requesting camera access...';
            status.className = 'mt-4 text-center text-sm text-slate-600';

            try {
                await reader.start({
                        facingMode: 'environment'
                    }, {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    },
                    handleScanSuccess,
                    () => {}
                );
                scanning = true;
                startButton.classList.add('hidden');
                stopButton.classList.remove('hidden');
                status.textContent = 'Point your camera at a QR code.';
            } catch (error) {
                showError('Camera could not start. Check browser permission and use HTTPS or localhost.');
            }
        }

        async function stopCamera() {
            if (!scanning) {
                return;
            }

            await reader.stop();
            scanning = false;
            startButton.classList.remove('hidden');
            stopButton.classList.add('hidden');
        }

        startButton.addEventListener('click', startCamera);
        stopButton.addEventListener('click', stopCamera);
        continueButton.addEventListener('click', () => {
            status.textContent = 'Code ready: ' + resultInput.value;
            status.className = 'mt-4 text-center text-sm text-emerald-600';
        });
        window.addEventListener('pagehide', () => {
            if (scanning) {
                reader.stop();
            }
        });
    </script>
</body>

</html>