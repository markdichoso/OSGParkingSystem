<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator Dashboard</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
        rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
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

        .pulse-dot {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 100;
            animation: fadeIn 0.2s ease-in-out;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-content {
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .toast {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 200;
            display: none;
            animation: slideDown 0.3s ease-out;
        }

        .toast.active {
            display: flex;
        }

        @keyframes slideDown {
            from {
                transform: translate(-50%, -20px);
                opacity: 0;
            }

            to {
                transform: translate(-50%, 0);
                opacity: 1;
            }
        }

        input[type="range"] {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 6px;
            background: #e5e7eb;
            border-radius: 5px;
            outline: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            background: #2563EB;
            cursor: pointer;
            border-radius: 50%;
        }

        input[type="range"]::-moz-range-thumb {
            width: 20px;
            height: 20px;
            background: #2563EB;
            cursor: pointer;
            border-radius: 50%;
            border: none;
        }

        .slot-item {
            transition: all 0.2s ease;
        }

        .slot-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>


</head>

<?php
// Sample data for parking rates    


?>

<body class="bg-gray-50">
    <div
        class="w-full max-w-[1080px] mx-auto bg-gray-50 min-h-screen relative pb-6">



        <!-- HEADER - LOGO AND MENU -->
        <?php require __DIR__ . '/../template/header.php'; ?>




        <main class="pt-20 px-5">
            <div class="gap-3 rounded-xl shadow-sm p-2 mb-2" style="text-align: center; border: 1px solid #8f723b;">
                <h1 class="text-lg font-bold text-gray-900" style="color: #8f723b; ">Parking Rates</h1>
            </div>


            <!-- PARKING PRICING SETTINGS -->
            <div class="bg-white rounded-2xl shadow-md p-5 mb-6">
                <h3 class="text-base font-semibold text-gray-900 mb-4">
                    Parking Pricing Settings
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700 mb-2 block">First 2 Hours Rate</label>
                        <div class="relative">
                            <span
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-600 font-medium">Php </span>
                            <input
                                type="number"
                                value="<?= $parkingRates->pr_first ?? '' ?>"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-12 pr-4 py-3 text-base font-medium text-gray-900"
                                id="first-rate" disabled="disabled" />
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700 mb-2 block">Additional Hour Rate</label>
                        <div class="relative">
                            <span
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-600 font-medium">Php </span>
                            <input
                                type="number"
                                inputmode="decimal"
                                value="<?= $parkingRates->pr_after ?? '' ?>"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-12 pr-4 py-3 text-base font-medium text-gray-900"
                                id="additional-rate" disabled="disabled" />
                        </div>
                    </div>
                    <div class="bg-blue-50 rounded-xl p-4">
                        <p class="text-xs text-gray-600 mb-2">Current Rates</p>
                        <p class="text-sm font-semibold text-gray-900">
                            Php <?= $parkingRates->pr_first ?? '' ?> for first 2 hours, <br>then Php <?= $parkingRates->pr_after ?? '' ?>/hour
                        </p>
                    </div>
                    <button
                        class="w-full bg-primary text-white py-3 rounded-button font-medium cursor-pointer !rounded-button"
                        id="update-pricing">
                        Update Rates
                    </button>
                    <button
                        class="w-full bg-primary text-white py-3 rounded-button font-medium cursor-pointer !rounded-button"
                        id="save-pricing" hidden>
                        Save Rates
                    </button>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-xs font-medium text-gray-600 mb-3">Recent Changes</p>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600">Sep 15, 2026</span>
                            <span class="text-gray-900 font-medium">Php 5.00 / Php 2.50</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600">Aug 01, 2026</span>
                            <span class="text-gray-900 font-medium">Php 4.50 / Php 2.00</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600">Jun 10, 2026</span>
                            <span class="text-gray-900 font-medium">Php 4.00 / Php 2.00</span>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>





    <div id="pricing-modal" class="modal">
        <div
            class="modal-content bg-white rounded-2xl shadow-2xl w-11/12 max-w-[340px] p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Update Pricing</h3>
                <button
                    class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-lg cursor-pointer"
                    id="close-pricing-modal">
                    <i class="ri-close-line text-xl text-gray-600"></i>
                </button>
            </div>
            <div class="bg-orange-50 rounded-xl p-4 mb-4 flex items-start gap-3">
                <i
                    class="ri-error-warning-line text-xl text-orange-600 flex-shrink-0 mt-0.5"></i>
                <p class="text-sm text-gray-700">
                    Changing pricing will affect all new parking sessions immediately.
                </p>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-700 mb-2 block">First 2 Hours Rate</label>
                    <div class="relative">
                        <span
                            class="absolute left-6 top-1/2 transform -translate-y-1/2 text-gray-600 font-medium">Php</span>
                        <input
                            type="number"
                            value="5.00"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-base font-medium text-gray-900"
                            id="modal-first-rate" />
                    </div>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700 mb-2 block">Additional Hour Rate</label>
                    <div class="relative">
                        <span
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-600 font-medium">Php</span>
                        <input
                            type="number"
                            value="2.50"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-base font-medium text-gray-900"
                            id="modal-additional-rate" />
                    </div>
                </div>
                <button
                    class="w-full bg-primary text-white py-3 rounded-button font-medium cursor-pointer !rounded-button"
                    id="confirm-pricing">
                    Confirm Update
                </button>
            </div>
        </div>
    </div>

    <div id="toast" class="toast">
        <div class="flex items-center gap-3">
            <div
                class="w-8 h-8 flex items-center justify-center bg-green-100 rounded-lg">
                <i class="ri-check-line text-lg text-secondary"></i>
            </div>
            <span class="text-sm font-medium text-gray-900" id="toast-message">Action completed successfully</span>
        </div>
    </div>

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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Your JavaScript code here
            const updatePricingButton = document.getElementById("update-pricing");
            const firstRateInput = document.getElementById("first-rate");
            const additionalRateInput = document.getElementById("additional-rate");

            updatePricingButton.addEventListener("click", function() {
                firstRateInput.removeAttribute("disabled");
                additionalRateInput.removeAttribute("disabled");
                updatePricingButton.setAttribute("hidden", "hidden");
                document.getElementById("save-pricing").removeAttribute("hidden");
            })


            // SAVE NEW PARKING RATES --------------------------------------------------
            const savePricingButton = document.getElementById("save-pricing");
            savePricingButton.addEventListener("click", function() {
                const firstRate = firstRateInput.value;
                const additionalRate = additionalRateInput.value;

                // Call a Controller function to save the new rates
                fetch('<?= base_url('dashboard/saveParkingRates') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        firstRate: firstRate,
                        additionalRate: additionalRate
                    }),
                })

            });
        });
    </script>

</body>

</html>