<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Parking Attendant Dashboard</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
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
                        class="w-full px-4 py-3 flex items-center gap-3 hover:bg-red-50 transition-colors cursor-pointer">
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
                    Confirm Entry
                </h1>
                <p class="text-sm text-gray-600">
                    Confirm the employee's entry and assign a parking spot.
                </p>
            </div>
            <!-- <div
                class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-4 mb-6">
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white rounded-xl p-3 text-center">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-secondary bg-opacity-10 rounded-lg mx-auto mb-2">
                            <i class="ri-car-line text-xl text-secondary"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">24</p>
                        <p class="text-xs text-gray-600 mt-1">Parked Now</p>
                    </div>
                    <div class="bg-white rounded-xl p-3 text-center">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-primary bg-opacity-10 rounded-lg mx-auto mb-2">
                            <i class="ri-parking-line text-xl text-primary"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">30</p>
                        <p class="text-xs text-gray-600 mt-1">Available</p>
                    </div>
                    <div class="bg-white rounded-xl p-3 text-center">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-orange-500 bg-opacity-10 rounded-lg mx-auto mb-2">
                            <i class="ri-arrow-left-right-line text-xl text-orange-600"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">47</p>
                        <p class="text-xs text-gray-600 mt-1">Today</p>
                    </div>
                </div>
            </div>
            <div
                id="scanner-section"
                class="bg-white rounded-2xl shadow-md p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">QR Code Scanner</h2>
                    <div
                        id="scanner-status"
                        class="flex items-center gap-2 bg-blue-50 px-3 py-1 rounded-full">
                        <span class="w-2 h-2 bg-primary rounded-full pulse-ring"></span>
                        <span class="text-xs font-medium text-primary">Ready to Scan</span>
                    </div>
                </div>
                <div
                    class="scanner-frame bg-gray-900 rounded-xl overflow-hidden mb-4 relative"
                    style="height: 280px;">
                    <video
                        id="camera-preview"
                        autoplay
                        playsinline
                        class="absolute inset-0 w-full h-full object-cover"></video>
                    <canvas id="scanner-canvas" class="hidden"></canvas>
                    <div
                        class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="w-48 h-48 border-2 border-white rounded-xl relative">
                            <div
                                class="absolute top-0 left-0 w-6 h-6 border-t-4 border-l-4 border-white rounded-tl-lg"></div>
                            <div
                                class="absolute top-0 right-0 w-6 h-6 border-t-4 border-r-4 border-white rounded-tr-lg"></div>
                            <div
                                class="absolute bottom-0 left-0 w-6 h-6 border-b-4 border-l-4 border-white rounded-bl-lg"></div>
                            <div
                                class="absolute bottom-0 right-0 w-6 h-6 border-b-4 border-r-4 border-white rounded-br-lg"></div>
                            <div
                                id="scanner-animation"
                                class="scanner-line"
                                style="animation-play-state: paused;"></div>
                        </div>
                    </div>
                    <div class="absolute bottom-4 left-0 right-0 text-center">
                        <p id="scanner-instruction" class="text-white text-sm">
                            Position QR code within frame
                        </p>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="text-xs font-medium text-gray-700 mb-2 block">Or enter Employee ID manually</label>
                    <div class="relative">
                        <input
                            type="text"
                            id="manual-id-input"
                            placeholder="Enter Employee ID"
                            class="w-full px-4 py-3 pr-12 bg-gray-50 border-none rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary" />
                        <div
                            class="absolute right-3 top-1/2 -translate-y-1/2 w-6 h-6 flex items-center justify-center">
                            <i class="ri-user-search-line text-lg text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <button
                    id="scan-button"
                    class="w-full bg-primary text-white py-3 rounded-button font-medium flex items-center justify-center gap-2 cursor-pointer whitespace-nowrap">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-qr-scan-2-line text-lg"></i>
                    </div>
                    <span>Start Scanning</span>
                </button>
            </div> -->
            <div
                id="employee-info-section"
                class="bg-white rounded-2xl shadow-md p-6 mb-6 fade-in">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Employee Information
                    </h2>
                    <div
                        class="w-8 h-8 flex items-center justify-center bg-secondary rounded-full">
                        <i class="ri-check-line text-white text-lg"></i>
                    </div>
                </div>
                <div
                    class="flex items-center gap-4 mb-4 pb-4 border-b border-gray-100">
                    <img
                        id="employee-photo"
                        src="http://localhost/osgparkingsystem/public/img/photo/2003-03002.jpg"
                        alt="Employee"
                        class="w-16 h-16 rounded-full object-cover ring-2 ring-primary ring-opacity-20" />
                    <div class="flex-1">
                        <h3
                            id="employee-name"
                            class="text-base font-bold text-gray-900 mb-1">
                            Jayvie Neil Malick S. Malicdem
                        </h3>
                        <p id="employee-department" class="text-sm text-gray-600 mb-1">
                            Case Management Service
                        </p>
                        <p
                            id="employee-id"
                            class="text-xs font-mono text-gray-500 bg-gray-50 px-2 py-1 rounded inline-block">
                            2003-03002
                        </p>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-gray-600">Vehicle Information</span>
                    </div>
                    <p id="vehicle-info" class="text-sm font-medium text-gray-900">
                        Kia Sonnet [NAA 2310]
                    </p>
                </div>
            </div>
            <!-- <div id="transaction-type-section" class="mb-6 fade-in">
                <div class="bg-gray-100 rounded-full p-1 flex gap-1">
                    <button
                        id="entry-btn"
                        class="flex-1 px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 cursor-pointer bg-white text-gray-900 shadow-sm">
                        Entry
                    </button>
                    <button
                        id="exit-btn"
                        class="flex-1 px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 cursor-pointer text-gray-600">
                        Exit
                    </button>
                </div>
            </div> -->
            <div
                id="parking-assignment-section"
                class="bg-white rounded-2xl shadow-md p-6 mb-6 slide-up">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    Assign Parking Spot
                </h2>
                <div class="bg-gray-100 rounded-full p-1 flex gap-1 mb-4">
                    <button
                        class="filter-btn flex-1 px-3 py-2 rounded-full text-xs font-medium transition-all duration-200 cursor-pointer bg-white text-gray-900 shadow-sm"
                        data-filter="all">
                        All
                    </button>
                    <button
                        class="filter-btn flex-1 px-3 py-2 rounded-full text-xs font-medium transition-all duration-200 cursor-pointer text-gray-600"
                        data-filter="free">
                        Free
                    </button>
                    <button
                        class="filter-btn flex-1 px-3 py-2 rounded-full text-xs font-medium transition-all duration-200 cursor-pointer text-gray-600"
                        data-filter="pay">
                        Pay
                    </button>
                </div>
                <div class="grid grid-cols-3 gap-3 mb-4" id="parking-spots-grid">
                    <div
                        class="parking-spot bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-3 cursor-pointer"
                        data-spot="A-12"
                        data-type="free"
                        data-level="2"
                        data-block="A">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-bold text-gray-900">A-12</span>
                            <div
                                class="w-6 h-6 flex items-center justify-center bg-secondary rounded-full">
                                <i class="ri-check-line text-white text-xs"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600">Level 2</p>
                        <div
                            class="mt-2 bg-secondary bg-opacity-20 px-2 py-1 rounded text-xs font-medium text-secondary">
                            Free
                        </div>
                    </div>
                    <div
                        class="parking-spot bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-3 cursor-pointer"
                        data-spot="A-15"
                        data-type="free"
                        data-level="2"
                        data-block="A">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-bold text-gray-900">A-15</span>
                            <div
                                class="w-6 h-6 flex items-center justify-center bg-secondary rounded-full">
                                <i class="ri-check-line text-white text-xs"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600">Level 2</p>
                        <div
                            class="mt-2 bg-secondary bg-opacity-20 px-2 py-1 rounded text-xs font-medium text-secondary">
                            Free
                        </div>
                    </div>
                    <div
                        class="parking-spot bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-3 cursor-pointer"
                        data-spot="B-08"
                        data-type="pay"
                        data-level="1"
                        data-block="B">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-bold text-gray-900">B-08</span>
                            <div
                                class="w-6 h-6 flex items-center justify-center bg-orange-600 rounded-full">
                                <i class="ri-check-line text-white text-xs"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600">Level 1</p>
                        <div
                            class="mt-2 bg-orange-600 bg-opacity-20 px-2 py-1 rounded text-xs font-medium text-orange-600">
                            Pay
                        </div>
                    </div>
                    <div
                        class="parking-spot bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-3 cursor-pointer"
                        data-spot="A-18"
                        data-type="free"
                        data-level="2"
                        data-block="A">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-bold text-gray-900">A-18</span>
                            <div
                                class="w-6 h-6 flex items-center justify-center bg-secondary rounded-full">
                                <i class="ri-check-line text-white text-xs"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600">Level 2</p>
                        <div
                            class="mt-2 bg-secondary bg-opacity-20 px-2 py-1 rounded text-xs font-medium text-secondary">
                            Free
                        </div>
                    </div>
                    <div
                        class="parking-spot bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-3 cursor-pointer"
                        data-spot="C-05"
                        data-type="pay"
                        data-level="3"
                        data-block="C">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-bold text-gray-900">C-05</span>
                            <div
                                class="w-6 h-6 flex items-center justify-center bg-orange-600 rounded-full">
                                <i class="ri-check-line text-white text-xs"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600">Level 3</p>
                        <div
                            class="mt-2 bg-orange-600 bg-opacity-20 px-2 py-1 rounded text-xs font-medium text-orange-600">
                            Pay
                        </div>
                    </div>
                    <div
                        class="parking-spot bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-3 cursor-pointer"
                        data-spot="B-22"
                        data-type="free"
                        data-level="1"
                        data-block="B">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-bold text-gray-900">B-22</span>
                            <div
                                class="w-6 h-6 flex items-center justify-center bg-secondary rounded-full">
                                <i class="ri-check-line text-white text-xs"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600">Level 1</p>
                        <div
                            class="mt-2 bg-secondary bg-opacity-20 px-2 py-1 rounded text-xs font-medium text-secondary">
                            Free
                        </div>
                    </div>
                    <div
                        class="parking-spot bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-3 cursor-pointer"
                        data-spot="C-12"
                        data-type="pay"
                        data-level="3"
                        data-block="C">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-bold text-gray-900">C-12</span>
                            <div
                                class="w-6 h-6 flex items-center justify-center bg-orange-600 rounded-full">
                                <i class="ri-check-line text-white text-xs"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600">Level 3</p>
                        <div
                            class="mt-2 bg-orange-600 bg-opacity-20 px-2 py-1 rounded text-xs font-medium text-orange-600">
                            Pay
                        </div>
                    </div>
                    <div
                        class="parking-spot bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-3 cursor-pointer"
                        data-spot="A-25"
                        data-type="free"
                        data-level="2"
                        data-block="A">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-bold text-gray-900">A-25</span>
                            <div
                                class="w-6 h-6 flex items-center justify-center bg-secondary rounded-full">
                                <i class="ri-check-line text-white text-xs"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600">Level 2</p>
                        <div
                            class="mt-2 bg-secondary bg-opacity-20 px-2 py-1 rounded text-xs font-medium text-secondary">
                            Free
                        </div>
                    </div>
                    <div
                        class="parking-spot bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-3 cursor-pointer"
                        data-spot="B-14"
                        data-type="pay"
                        data-level="1"
                        data-block="B">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-bold text-gray-900">B-14</span>
                            <div
                                class="w-6 h-6 flex items-center justify-center bg-orange-600 rounded-full">
                                <i class="ri-check-line text-white text-xs"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600">Level 1</p>
                        <div
                            class="mt-2 bg-orange-600 bg-opacity-20 px-2 py-1 rounded text-xs font-medium text-orange-600">
                            Pay
                        </div>
                    </div>
                </div>
                <div
                    id="selected-spot-info"
                    class="hidden bg-gradient-to-br from-primary to-blue-600 rounded-xl p-4 text-white mb-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-100 mb-1">Selected Spot</p>
                            <p id="selected-spot-number" class="text-3xl font-bold">A-12</p>
                            <p
                                id="selected-spot-details"
                                class="text-sm text-blue-100 mt-1">
                                Level 2, Block A - Free Parking
                            </p>
                        </div>
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full">
                            <i class="ri-map-pin-fill text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div
                id="exit-summary-section"
                class="hidden bg-white rounded-2xl shadow-md p-6 mb-6 slide-up">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Exit Summary</h2>
                <div
                    class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 mb-4">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm text-gray-600">Parking Spot</span>
                        <span
                            id="exit-spot-number"
                            class="text-xl font-bold text-gray-900">A-23</span>
                    </div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm text-gray-600">Duration</span>
                        <span id="exit-duration" class="text-xl font-bold text-gray-900">7h 45m</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Parking Type</span>
                        <div class="bg-secondary px-3 py-1 rounded-full">
                            <span
                                id="exit-parking-type"
                                class="text-xs font-medium text-white">Free Parking</span>
                        </div>
                    </div>
                </div>
                <div id="fee-section" class="hidden bg-orange-50 rounded-xl p-4 mb-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">Parking Fee</span>
                        <span id="parking-fee" class="text-2xl font-bold text-orange-600">$15.00</span>
                    </div>
                </div>
            </div> -->
            <!-- <div
                id="transaction-summary-section"
                class="hidden bg-white rounded-2xl shadow-md p-6 mb-6 slide-up">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Transaction Summary
                    </h2>
                    <div class="bg-blue-50 px-3 py-1 rounded-full">
                        <span
                            id="transaction-type-badge"
                            class="text-xs font-medium text-primary">Entry</span>
                    </div>
                </div>
                <div class="space-y-3 mb-4">
                    <div
                        class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Employee</span>
                        <span
                            id="summary-employee-name"
                            class="text-sm font-medium text-gray-900">Sarah Johnson</span>
                    </div>
                    <div
                        class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Employee ID</span>
                        <span
                            id="summary-employee-id"
                            class="text-sm font-mono text-gray-900">2008-15847</span>
                    </div>
                    <div
                        class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Timestamp</span>
                        <span
                            id="summary-timestamp"
                            class="text-sm font-medium text-gray-900">Dec 28, 2026 09:15 AM</span>
                    </div>
                    <div
                        id="summary-spot-row"
                        class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Parking Spot</span>
                        <span id="summary-spot" class="text-sm font-bold text-primary">A-12</span>
                    </div>
                    <div
                        id="summary-duration-row"
                        class="hidden flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Duration</span>
                        <span
                            id="summary-duration"
                            class="text-sm font-medium text-gray-900">7h 45m</span>
                    </div>
                </div>
            </div> -->
            <div id="action-buttons-section" class=" space-y-3 mb-6">
                <button
                    id="confirm-button"
                    class="w-full bg-primary text-white py-3 rounded-button font-medium flex items-center justify-center gap-2 cursor-pointer whitespace-nowrap">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-check-line text-lg"></i>
                    </div>
                    <span id="confirm-button-text">Confirm Entry</span>
                </button>
                <button
                    id="cancel-button"
                    class="w-full bg-white border-2 border-gray-200 text-gray-700 py-3 rounded-button font-medium flex items-center justify-center gap-2 cursor-pointer whitespace-nowrap">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-close-line text-lg"></i>
                    </div>
                    <span>Cancel</span>
                </button>
            </div>
            <!-- <div
                id="recent-transactions-section"
                class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-semibold text-gray-900">
                        Recent Transactions
                    </h2>
                    <button class="text-sm text-primary font-medium cursor-pointer">
                        View All
                    </button>
                </div>
                <div class="space-y-3" id="recent-transactions-list">
                    <div class="bg-gray-50 rounded-xl p-3 cursor-pointer">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 flex items-center justify-center bg-secondary bg-opacity-10 rounded-lg">
                                    <i class="ri-login-box-line text-lg text-secondary"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        Michael Chen
                                    </p>
                                    <p class="text-xs text-gray-600">Spot B-15</p>
                                </div>
                            </div>
                            <div class="bg-secondary px-2 py-1 rounded">
                                <span class="text-xs font-medium text-white">Entry</span>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-between text-xs text-gray-600 pl-13">
                            <span>08:45 AM</span>
                            <span>Free Parking</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 cursor-pointer">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 flex items-center justify-center bg-orange-600 bg-opacity-10 rounded-lg">
                                    <i class="ri-logout-box-line text-lg text-orange-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        Emily Rodriguez
                                    </p>
                                    <p class="text-xs text-gray-600">Spot C-08 - 6h 20m</p>
                                </div>
                            </div>
                            <div class="bg-orange-600 px-2 py-1 rounded">
                                <span class="text-xs font-medium text-white">Exit</span>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-between text-xs text-gray-600 pl-13">
                            <span>08:30 AM</span>
                            <span>Pay Parking</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 cursor-pointer">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 flex items-center justify-center bg-secondary bg-opacity-10 rounded-lg">
                                    <i class="ri-login-box-line text-lg text-secondary"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        David Thompson
                                    </p>
                                    <p class="text-xs text-gray-600">Spot A-18</p>
                                </div>
                            </div>
                            <div class="bg-secondary px-2 py-1 rounded">
                                <span class="text-xs font-medium text-white">Entry</span>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-between text-xs text-gray-600 pl-13">
                            <span>08:15 AM</span>
                            <span>Free Parking</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 cursor-pointer">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 flex items-center justify-center bg-orange-600 bg-opacity-10 rounded-lg">
                                    <i class="ri-logout-box-line text-lg text-orange-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        Jessica Wang
                                    </p>
                                    <p class="text-xs text-gray-600">Spot B-22 - 8h 15m</p>
                                </div>
                            </div>
                            <div class="bg-orange-600 px-2 py-1 rounded">
                                <span class="text-xs font-medium text-white">Exit</span>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-between text-xs text-gray-600 pl-13">
                            <span>08:00 AM</span>
                            <span>Free Parking</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 cursor-pointer">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 flex items-center justify-center bg-secondary bg-opacity-10 rounded-lg">
                                    <i class="ri-login-box-line text-lg text-secondary"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        Robert Martinez
                                    </p>
                                    <p class="text-xs text-gray-600">Spot C-12</p>
                                </div>
                            </div>
                            <div class="bg-secondary px-2 py-1 rounded">
                                <span class="text-xs font-medium text-white">Entry</span>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-between text-xs text-gray-600 pl-13">
                            <span>07:45 AM</span>
                            <span>Pay Parking</span>
                        </div>
                    </div>
                </div>
            </div> -->
        </main>
    </div>
    <div id="toast-container"></div>
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
    <script id="scanner-functionality">
        document.addEventListener("DOMContentLoaded", function() {
            const scanButton = document.getElementById("scan-button");
            const scannerStatus = document.getElementById("scanner-status");
            const employeeInfoSection = document.getElementById("employee-info-section");
            const transactionTypeSection = document.getElementById(
                "transaction-type-section",
            );
            const manualIdInput = document.getElementById("manual-id-input");
            const cameraPreview = document.getElementById("camera-preview");
            const scannerCanvas = document.getElementById("scanner-canvas");
            const scannerInstruction = document.getElementById("scanner-instruction");
            const scannerAnimation = document.getElementById("scanner-animation");
            let stream = null;
            let isScanning = false;

            function showToast(message, type) {
                const toastContainer = document.getElementById("toast-container");
                const toast = document.createElement("div");
                toast.className = `toast px-6 py-3 rounded-xl shadow-lg ${type === "success" ? "bg-secondary" : "bg-red-500"} text-white`;
                toast.innerHTML = `
      <div class="flex items-center gap-2">
      <i class="ri-${type === "success" ? "check" : "close"}-circle-fill text-xl"></i>
      <span class="font-medium">${message}</span>
      </div>
      `;
                toastContainer.appendChild(toast);
                setTimeout(() => {
                    toast.remove();
                }, 3000);
            }

            function showCameraPermissionModal() {
                const modal = document.createElement("div");
                modal.id = "camera-permission-modal";
                modal.className =
                    "fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-5";
                modal.innerHTML = `
      <div class="bg-white rounded-2xl max-w-sm w-full p-6 fade-in">
      <div class="w-16 h-16 flex items-center justify-center bg-orange-100 rounded-full mx-auto mb-4">
      <i class="ri-camera-off-line text-3xl text-orange-600"></i>
      </div>
      <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Camera Access Required</h3>
      <p class="text-sm text-gray-600 text-center mb-6">
      We need camera access to scan QR codes for employee verification. Please allow camera permissions to continue.
      </p>
      <div class="space-y-3">
      <button id="retry-camera-btn" class="w-full bg-primary text-white py-3 rounded-button font-medium flex items-center justify-center gap-2 cursor-pointer whitespace-nowrap">
      <div class="w-5 h-5 flex items-center justify-center">
      <i class="ri-refresh-line text-lg"></i>
      </div>
      <span>Retry Camera Access</span>
      </button>
      <button id="manual-entry-btn" class="w-full bg-secondary text-white py-3 rounded-button font-medium flex items-center justify-center gap-2 cursor-pointer whitespace-nowrap">
      <div class="w-5 h-5 flex items-center justify-center">
      <i class="ri-keyboard-line text-lg"></i>
      </div>
      <span>Enter ID Manually</span>
      </button>
      <button id="settings-help-btn" class="w-full bg-gray-100 text-gray-700 py-3 rounded-button font-medium flex items-center justify-center gap-2 cursor-pointer whitespace-nowrap">
      <div class="w-5 h-5 flex items-center justify-center">
      <i class="ri-settings-3-line text-lg"></i>
      </div>
      <span>Check Device Settings</span>
      </button>
      </div>
      <button id="close-modal-btn" class="mt-4 w-full text-sm text-gray-500 py-2 cursor-pointer">Cancel</button>
      </div>
      `;
                document.body.appendChild(modal);

                document
                    .getElementById("retry-camera-btn")
                    .addEventListener("click", async function() {
                        document.body.removeChild(modal);
                        const cameraStarted = await startCamera();
                        if (cameraStarted) {
                            isScanning = true;
                            scanButton.innerHTML =
                                '<div class="w-5 h-5 flex items-center justify-center"><i class="ri-stop-circle-line text-lg"></i></div><span>Stop Camera</span>';
                            scannerStatus.innerHTML =
                                '<span class="w-2 h-2 bg-secondary rounded-full pulse-ring"></span><span class="text-xs font-medium text-secondary">Camera Active</span>';
                            scannerStatus.className =
                                "flex items-center gap-2 bg-green-50 px-3 py-1 rounded-full";
                            setTimeout(() => {
                                if (isScanning) {
                                    simulateScan();
                                }
                            }, 1500);
                        }
                    });

                document
                    .getElementById("manual-entry-btn")
                    .addEventListener("click", function() {
                        document.body.removeChild(modal);
                        manualIdInput.focus();
                        showToast("Please enter Employee ID manually", "success");
                    });

                document
                    .getElementById("settings-help-btn")
                    .addEventListener("click", function() {
                        document.body.removeChild(modal);
                        const helpModal = document.createElement("div");
                        helpModal.className =
                            "fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-5";
                        helpModal.innerHTML = `
      <div class="bg-white rounded-2xl max-w-sm w-full p-6 fade-in">
      <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-bold text-gray-900">Camera Settings Help</h3>
      <button id="close-help-modal" class="w-8 h-8 flex items-center justify-center cursor-pointer">
      <i class="ri-close-line text-xl text-gray-500"></i>
      </button>
      </div>
      <div class="space-y-4 text-sm text-gray-700">
      <div>
      <p class="font-semibold mb-2">For Chrome/Safari:</p>
      <p>1. Click the lock icon in the address bar</p>
      <p>2. Find "Camera" permissions</p>
      <p>3. Select "Allow" and reload the page</p>
      </div>
      <div>
      <p class="font-semibold mb-2">For Mobile Devices:</p>
      <p>1. Go to device Settings</p>
      <p>2. Find this app/browser</p>
      <p>3. Enable Camera permissions</p>
      </div>
      </div>
      <button id="got-it-btn" class="w-full bg-primary text-white py-3 rounded-button font-medium mt-6 cursor-pointer whitespace-nowrap">Got it</button>
      </div>
      `;
                        document.body.appendChild(helpModal);

                        document
                            .getElementById("close-help-modal")
                            .addEventListener("click", function() {
                                document.body.removeChild(helpModal);
                            });

                        document
                            .getElementById("got-it-btn")
                            .addEventListener("click", function() {
                                document.body.removeChild(helpModal);
                            });
                    });

                document
                    .getElementById("close-modal-btn")
                    .addEventListener("click", function() {
                        document.body.removeChild(modal);
                    });
            }

            async function startCamera() {
                try {
                    stream = await navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode: "environment"
                        },
                    });
                    cameraPreview.srcObject = stream;
                    scannerInstruction.textContent = "Camera active - Position QR code";
                    return true;
                } catch (error) {
                    showCameraPermissionModal();
                    scannerInstruction.textContent = "Camera access required";
                    return false;
                }
            }

            function stopCamera() {
                if (stream) {
                    stream.getTracks().forEach((track) => track.stop());
                    cameraPreview.srcObject = null;
                    stream = null;
                }
            }

            function simulateScan() {
                scannerStatus.innerHTML =
                    '<span class="w-2 h-2 bg-orange-500 rounded-full pulse-ring"></span><span class="text-xs font-medium text-orange-600">Scanning...</span>';
                scannerStatus.className =
                    "flex items-center gap-2 bg-orange-50 px-3 py-1 rounded-full";
                scanButton.disabled = true;
                scanButton.classList.add("opacity-50");
                scannerAnimation.style.animationPlayState = "running";
                setTimeout(() => {
                    scannerStatus.innerHTML =
                        '<span class="w-2 h-2 bg-secondary rounded-full pulse-ring"></span><span class="text-xs font-medium text-secondary">Scan Successful</span>';
                    scannerStatus.className =
                        "flex items-center gap-2 bg-green-50 px-3 py-1 rounded-full";
                    scannerAnimation.style.animationPlayState = "paused";
                    setTimeout(() => {
                        employeeInfoSection.classList.remove("hidden");
                        transactionTypeSection.classList.remove("hidden");
                        showToast("Employee verified successfully", "success");
                        stopCamera();
                        isScanning = false;
                        scanButton.innerHTML =
                            '<div class="w-5 h-5 flex items-center justify-center"><i class="ri-qr-scan-2-line text-lg"></i></div><span>Start Scanning</span>';
                        scanButton.disabled = false;
                        scanButton.classList.remove("opacity-50");
                        scannerStatus.innerHTML =
                            '<span class="w-2 h-2 bg-primary rounded-full pulse-ring"></span><span class="text-xs font-medium text-primary">Ready to Scan</span>';
                        scannerStatus.className =
                            "flex items-center gap-2 bg-blue-50 px-3 py-1 rounded-full";
                        scannerInstruction.textContent = "Position QR code within frame";
                    }, 1000);
                }, 2000);
            }
            scanButton.addEventListener("click", async function() {
                if (!isScanning) {
                    const cameraStarted = await startCamera();
                    if (cameraStarted) {
                        isScanning = true;
                        scanButton.innerHTML =
                            '<div class="w-5 h-5 flex items-center justify-center"><i class="ri-stop-circle-line text-lg"></i></div><span>Stop Camera</span>';
                        scannerStatus.innerHTML =
                            '<span class="w-2 h-2 bg-secondary rounded-full pulse-ring"></span><span class="text-xs font-medium text-secondary">Camera Active</span>';
                        scannerStatus.className =
                            "flex items-center gap-2 bg-green-50 px-3 py-1 rounded-full";
                        setTimeout(() => {
                            if (isScanning) {
                                simulateScan();
                            }
                        }, 1500);
                    }
                } else {
                    stopCamera();
                    isScanning = false;
                    scanButton.innerHTML =
                        '<div class="w-5 h-5 flex items-center justify-center"><i class="ri-qr-scan-2-line text-lg"></i></div><span>Start Scanning</span>';
                    scannerStatus.innerHTML =
                        '<span class="w-2 h-2 bg-primary rounded-full pulse-ring"></span><span class="text-xs font-medium text-primary">Ready to Scan</span>';
                    scannerStatus.className =
                        "flex items-center gap-2 bg-blue-50 px-3 py-1 rounded-full";
                    scannerInstruction.textContent = "Position QR code within frame";
                }
            });
            manualIdInput.addEventListener("keypress", function(e) {
                if (e.key === "Enter" && this.value.trim() !== "") {
                    if (isScanning) {
                        stopCamera();
                        isScanning = false;
                        scanButton.innerHTML =
                            '<div class="w-5 h-5 flex items-center justify-center"><i class="ri-qr-scan-2-line text-lg"></i></div><span>Start Scanning</span>';
                    }
                    simulateScan();
                }
            });
        });
    </script>
    <script id="transaction-type-toggle">
        document.addEventListener("DOMContentLoaded", function() {
            const entryBtn = document.getElementById("entry-btn");
            const exitBtn = document.getElementById("exit-btn");
            const parkingAssignmentSection = document.getElementById(
                "parking-assignment-section",
            );
            const exitSummarySection = document.getElementById("exit-summary-section");
            const transactionSummarySection = document.getElementById(
                "transaction-summary-section",
            );
            const actionButtonsSection = document.getElementById(
                "action-buttons-section",
            );
            const confirmButtonText = document.getElementById("confirm-button-text");
            const transactionTypeBadge = document.getElementById(
                "transaction-type-badge",
            );
            const summarySpotRow = document.getElementById("summary-spot-row");
            const summaryDurationRow = document.getElementById("summary-duration-row");
            entryBtn.addEventListener("click", function() {
                entryBtn.classList.add("bg-white", "text-gray-900", "shadow-sm");
                entryBtn.classList.remove("text-gray-600");
                exitBtn.classList.remove("bg-white", "text-gray-900", "shadow-sm");
                exitBtn.classList.add("text-gray-600");
                parkingAssignmentSection.classList.remove("hidden");
                exitSummarySection.classList.add("hidden");
                confirmButtonText.textContent = "Confirm Entry";
                transactionTypeBadge.textContent = "Entry";
                transactionTypeBadge.className = "text-xs font-medium text-primary";
                summarySpotRow.classList.remove("hidden");
                summaryDurationRow.classList.add("hidden");
            });
            exitBtn.addEventListener("click", function() {
                exitBtn.classList.add("bg-white", "text-gray-900", "shadow-sm");
                exitBtn.classList.remove("text-gray-600");
                entryBtn.classList.remove("bg-white", "text-gray-900", "shadow-sm");
                entryBtn.classList.add("text-gray-600");
                parkingAssignmentSection.classList.add("hidden");
                exitSummarySection.classList.remove("hidden");
                transactionSummarySection.classList.remove("hidden");
                actionButtonsSection.classList.remove("hidden");
                confirmButtonText.textContent = "Confirm Exit";
                transactionTypeBadge.textContent = "Exit";
                transactionTypeBadge.className = "text-xs font-medium text-orange-600";
                summarySpotRow.classList.add("hidden");
                summaryDurationRow.classList.remove("hidden");
            });
        });
    </script>
    <script id="parking-spot-selection">
        document.addEventListener("DOMContentLoaded", function() {
            const parkingSpots = document.querySelectorAll(".parking-spot");
            const selectedSpotInfo = document.getElementById("selected-spot-info");
            const selectedSpotNumber = document.getElementById("selected-spot-number");
            const selectedSpotDetails = document.getElementById("selected-spot-details");
            const transactionSummarySection = document.getElementById(
                "transaction-summary-section",
            );
            const actionButtonsSection = document.getElementById(
                "action-buttons-section",
            );
            const summarySpot = document.getElementById("summary-spot");
            const filterBtns = document.querySelectorAll(".filter-btn");
            let selectedSpot = null;
            filterBtns.forEach((btn) => {
                btn.addEventListener("click", function() {
                    filterBtns.forEach((b) => {
                        b.classList.remove("bg-white", "text-gray-900", "shadow-sm");
                        b.classList.add("text-gray-600");
                    });
                    this.classList.add("bg-white", "text-gray-900", "shadow-sm");
                    this.classList.remove("text-gray-600");
                    const filter = this.getAttribute("data-filter");
                    parkingSpots.forEach((spot) => {
                        if (filter === "all") {
                            spot.style.display = "block";
                        } else {
                            const spotType = spot.getAttribute("data-type");
                            spot.style.display = spotType === filter ? "block" : "none";
                        }
                    });
                });
            });
            parkingSpots.forEach((spot) => {
                spot.addEventListener("click", function() {
                    parkingSpots.forEach((s) => {
                        s.classList.remove("selected", "ring-4", "ring-primary");
                    });
                    this.classList.add("selected", "ring-4", "ring-primary");
                    selectedSpot = {
                        number: this.getAttribute("data-spot"),
                        level: this.getAttribute("data-level"),
                        block: this.getAttribute("data-block"),
                        type: this.getAttribute("data-type"),
                    };
                    selectedSpotNumber.textContent = selectedSpot.number;
                    const typeText =
                        selectedSpot.type === "free" ? "Free Parking" : "Pay Parking";
                    selectedSpotDetails.textContent = `Level ${selectedSpot.level}, Block ${selectedSpot.block} - ${typeText}`;
                    summarySpot.textContent = selectedSpot.number;
                    selectedSpotInfo.classList.remove("hidden");
                    transactionSummarySection.classList.remove("hidden");
                    actionButtonsSection.classList.remove("hidden");
                });
            });
        });
    </script>
    <script id="transaction-confirmation">
        document.addEventListener("DOMContentLoaded", function() {
            const confirmButton = document.getElementById("confirm-button");
            const cancelButton = document.getElementById("cancel-button");
            const employeeInfoSection = document.getElementById("employee-info-section");
            const transactionTypeSection = document.getElementById(
                "transaction-type-section",
            );
            const parkingAssignmentSection = document.getElementById(
                "parking-assignment-section",
            );
            const exitSummarySection = document.getElementById("exit-summary-section");
            const transactionSummarySection = document.getElementById(
                "transaction-summary-section",
            );
            const actionButtonsSection = document.getElementById(
                "action-buttons-section",
            );
            const selectedSpotInfo = document.getElementById("selected-spot-info");

            function showToast(message, type) {
                const toastContainer = document.getElementById("toast-container");
                const toast = document.createElement("div");
                toast.className = `toast px-6 py-3 rounded-xl shadow-lg ${type === "success" ? "bg-secondary" : "bg-red-500"} text-white`;
                toast.innerHTML = `
      <div class="flex items-center gap-2">
      <i class="ri-${type === "success" ? "check" : "close"}-circle-fill text-xl"></i>
      <span class="font-medium">${message}</span>
      </div>
      `;
                toastContainer.appendChild(toast);
                setTimeout(() => {
                    toast.remove();
                }, 3000);
            }

            function resetForm() {
                employeeInfoSection.classList.add("hidden");
                transactionTypeSection.classList.add("hidden");
                parkingAssignmentSection.classList.add("hidden");
                exitSummarySection.classList.add("hidden");
                transactionSummarySection.classList.add("hidden");
                actionButtonsSection.classList.add("hidden");
                selectedSpotInfo.classList.add("hidden");
                document.querySelectorAll(".parking-spot").forEach((spot) => {
                    spot.classList.remove("selected", "ring-4", "ring-primary");
                });
                document
                    .getElementById("entry-btn")
                    .classList.add("bg-white", "text-gray-900", "shadow-sm");
                document.getElementById("entry-btn").classList.remove("text-gray-600");
                document
                    .getElementById("exit-btn")
                    .classList.remove("bg-white", "text-gray-900", "shadow-sm");
                document.getElementById("exit-btn").classList.add("text-gray-600");
                document.getElementById("manual-id-input").value = "";
            }
            confirmButton.addEventListener("click", function() {
                const buttonText = document.getElementById(
                    "confirm-button-text",
                ).textContent;
                confirmButton.innerHTML =
                    '<div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div><span>Processing...</span>';
                confirmButton.disabled = true;
                setTimeout(() => {
                    if (buttonText.includes("Entry")) {
                        showToast("Entry transaction confirmed successfully", "success");
                    } else {
                        showToast("Exit transaction confirmed successfully", "success");
                    }
                    confirmButton.innerHTML =
                        '<div class="w-5 h-5 flex items-center justify-center"><i class="ri-check-line text-lg"></i></div><span>' +
                        buttonText +
                        "</span>";
                    confirmButton.disabled = false;
                    setTimeout(() => {
                        resetForm();
                    }, 1000);
                }, 2000);
            });
            cancelButton.addEventListener("click", function() {
                resetForm();
                showToast("Transaction cancelled", "error");
            });
        });
    </script>
    <script id="timestamp-update">
        document.addEventListener("DOMContentLoaded", function() {
            function updateTimestamp() {
                const now = new Date();
                const options = {
                    year: "numeric",
                    month: "short",
                    day: "numeric",
                    hour: "2-digit",
                    minute: "2-digit",
                };
                const timestamp = now.toLocaleDateString("en-US", options);
                document.getElementById("summary-timestamp").textContent = timestamp;
            }
            updateTimestamp();
            setInterval(updateTimestamp, 60000);
        });
    </script>
</body>

</html>