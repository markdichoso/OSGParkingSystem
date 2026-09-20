<!DOCTYPE html>
<html lang="en">


<?php
$session = session();
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Parking Attendant Dashboard</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#2563EB",
                        secondary: "#10B981",
                    },
                    borderRadius: {
                        none: "0px",
                        sm: "4px",
                        DEFAULT: "8px",
                        md: "12px",
                        lg: "16px",
                        xl: "20px",
                        "2xl": "24px",
                        "3xl": "32px",
                        full: "9999px",
                        button: "8px",
                    },
                },
            },
        };
    </script>


    <style>
        :where([class^="ri-"])::before {
            content: "\f3c2";
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .scanner-frame {
            position: relative;
            overflow: hidden;
        }

        .scanner-line {
            position: absolute;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #2563EB, transparent);
            animation: scan 2s linear infinite;
        }

        @keyframes scan {
            0% {
                top: 0;
            }

            100% {
                top: 100%;
            }
        }

        .pulse-ring {
            animation: pulseRing 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulseRing {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.1);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-up {
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .parking-spot {
            transition: all 0.2s ease;
        }

        .parking-spot:hover {
            transform: translateY(-2px);
        }

        .parking-spot.selected {
            transform: scale(1.05);
        }

        .toast {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            animation: toastSlide 0.3s ease-out;
        }

        @keyframes toastSlide {
            from {
                opacity: 0;
                transform: translate(-50%, -20px);
            }

            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="w-full max-w-[1080px] mx-auto bg-white min-h-screen relative">
        <header class="fixed top-0 w-full max-w-[1080px] bg-white z-50 shadow-sm">
            <div class="flex items-center justify-between px-5 py-4 h-16">
                <div class="font-['Pacifico'] text-2xl text-primary">
                    <img src="http://localhost/osgparkingsystem/public/img/logo/OSG CAR PARK.png" style="height: 60px;">
                </div>


                <div class="flex items-center gap-4">
                    <div
                        class="w-10 h-10 flex items-center justify-center cursor-pointer">
                        <i class="ri-notification-3-line text-2xl text-gray-700"></i>
                    </div>
                    <div
                        class="w-10 h-10 flex items-center justify-center cursor-pointer"
                        id="menu-button">
                        <i class="ri-menu-line text-2xl text-gray-700"></i>
                    </div>
                </div>
            </div>
            <div
                id="menu-dropdown"
                class="absolute right-5 top-16 bg-white rounded-xl shadow-lg w-48 hidden overflow-hidden z-50">
                <div class="py-2">
                    <button
                        class="w-full px-4 py-3 flex items-center gap-3 hover:bg-gray-50 transition-colors cursor-pointer">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-blue-50 rounded-lg">
                            <i class="ri-user-line text-lg text-primary"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Account</span>
                    </button>
                    <div class="border-t border-gray-100"></div>
                    <button
                        class="w-full px-4 py-3 flex items-center gap-3 hover:bg-red-50 transition-colors cursor-pointer" onclick="window.location.href = '<?php echo base_url('osgparkingsystem/signout'); ?>';">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-red-50 rounded-lg">
                            <i class="ri-logout-box-r-line text-lg text-red-600"></i>
                        </div>
                        <span class="text-sm font-medium text-red-600">Log Out</span>
                    </button>
                </div>
            </div>




        </header>
        <main class="pt-20 pb-8 px-5">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-1">
                    Parking Attendant
                </h1>
                <p class="text-sm text-gray-600">
                    Manage vehicle entry and exit operations
                </p>
            </div>


            <div
                class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-4 mb-6">
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white rounded-xl p-3 text-center">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-secondary bg-opacity-10 rounded-lg mx-auto mb-2">
                            <i class="ri-car-line text-xl text-secondary"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-900"><?= \App\Controllers\Dashboard::getParkedCarCount(); ?></p>
                        <p class="text-xs text-gray-600 mt-1">Currently Parked Car/s</p>
                    </div>
                    <div class="bg-white rounded-xl p-3 text-center">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-primary bg-opacity-10 rounded-lg mx-auto mb-2">
                            <i class="ri-parking-line text-xl text-primary"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-900"><?= \App\Controllers\Dashboard::getAvailableFreeParkingCount(); ?></p>
                        <p class="text-xs text-gray-600 mt-1">Parking Slot Available (Free)</p>
                    </div>
                    <div class="bg-white rounded-xl p-3 text-center">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-orange-500 bg-opacity-10 rounded-lg mx-auto mb-2">
                            <i class="ri-arrow-left-right-line text-xl text-orange-600"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-900"><?= \App\Controllers\Dashboard::getAvailablePaidParkingCount(); ?></p>
                        <p class="text-xs text-gray-600 mt-1">Parking Slot Available (Paid)</p>
                    </div>
                </div>
            </div>


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

            <form id="scan-result-form" class="mt-5 rounded-2xl bg-white p-5 shadow-sm"
                action="<?= esc(base_url('osgparkingsystem/assign-parking')) ?>" method="post">
                <label for="qr-result" class="block text-sm font-semibold text-slate-700">Detected value</label>
                <input id="qr-result" name="qr_code" type="text" readonly
                    class="mt-2 w-full rounded-lg border border-slate-300 bg-slate-50 px-3 py-3 text-sm text-slate-900"
                    placeholder="The detected QR value will appear here">
                <input id="client-empno" name="client_empno" type="hidden">
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
            const scanResultForm = document.getElementById('scan-result-form');
            const clientEmpNoInput = document.getElementById('client-empno');
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
                clientEmpNoInput.value = resultInput.value;
                stopCamera();
                scanResultForm.submit();
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


        <script id="menu-toggle">
            document.addEventListener("DOMContentLoaded", function() {
                const menuButton = document.getElementById("menu-button");
                const menuDropdown = document.getElementById("menu-dropdown");
                menuButton.addEventListener("click", function(e) {
                    e.stopPropagation();
                    menuDropdown.classList.toggle("hidden");
                });
                document.addEventListener("click", function(e) {
                    if (!menuDropdown.contains(e.target) && !menuButton.contains(e.target)) {
                        menuDropdown.classList.add("hidden");
                    }
                });
                const menuOptions = menuDropdown.querySelectorAll("button");
                menuOptions.forEach((option) => {
                    option.addEventListener("click", function() {
                        menuDropdown.classList.add("hidden");
                    });
                });
            });
        </script>


</body>

</html>