<!DOCTYPE html>
<html lang="en">

<?php

$session = session();


if ($session->get('user_role') === 0) {
    $session->setFlashdata('success', 'Welcome Admin! You have successfully logged in.');
    echo "<script>
            window.location.href = './attendant';
          </script>";
} elseif ($session->get('user_role') === 1) {
    $session->setFlashdata('success', 'Welcome! You have successfully logged in.');
    echo "<script>
            window.location.href = './attendant';
          </script>";
}
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ODG Car Parking Management System - Dashboard</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>

    <script type="text/javascript" src="public/js/jquery.min.js"></script>
    <script type="text/javascript" src="public/js/qrcode.js"></script>

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

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }

        .tab-content.active {
            display: block;
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

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
                        class="w-full px-4 py-3 flex items-center gap-3 hover:bg-gray-50 transition-colors cursor-pointer" onclick="window.location.href = '<?php echo base_url('update-profile'); ?>';">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-blue-50 rounded-lg">
                            <i class="ri-user-line text-lg text-primary"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Account</span>
                    </button>
                    <div class="border-t border-gray-100"></div>
                    <button
                        class="w-full px-4 py-3 flex items-center gap-3 hover:bg-red-50 transition-colors cursor-pointer" onclick="window.location.href = '<?php echo base_url('signout'); ?>';">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-red-50 rounded-lg">
                            <i class="ri-logout-box-r-line text-lg text-red-600"></i>
                        </div>
                        <span class="text-sm font-medium text-red-600">Log Out</span>
                    </button>
                </div>
            </div>







            <!-- <div class="flex items-center gap-4">
                    <div
                        class="w-10 h-10 flex items-center justify-center cursor-pointer">
                        <i class="ri-notification-3-line text-2xl text-gray-700"></i>
                    </div>
                    <div
                        class="w-10 h-10 flex items-center justify-center cursor-pointer">
                        <i class="ri-menu-line text-2xl text-gray-700"></i>
                    </div>
                </div> -->

            <div class="px-5 pb-3">
                <div class="bg-gray-100 rounded-full p-1 flex gap-1">
                    <button
                        class="tab-btn flex-1 px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 cursor-pointer active"
                        data-tab="status">
                        Car Park
                    </button>
                    <button
                        class="tab-btn flex-1 px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 cursor-pointer"
                        data-tab="profile">
                        Profile
                    </button>
                    <button
                        class="tab-btn flex-1 px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 cursor-pointer"
                        data-tab="history">
                        History
                    </button>
                </div>
            </div>
        </header>




        <main class="pt-32 pb-8 px-5">

            <!-- CAR PARK TAB  -->
            <div id="status-tab" class="tab-content active">
                <?php
                $currentLog = $currentParking['log'] ?? null;
                $isActive = ($currentParking['status'] ?? 'Inactive') === 'Active' && $currentLog !== null;
                $currentStatus = $isActive ? 'Active' : 'Inactive';
                $statusPanelClass = $isActive
                    ? 'bg-gradient-to-br from-green-50 to-emerald-50'
                    : 'bg-gradient-to-br from-gray-100 to-gray-200';
                $statusBadgeClass = $isActive ? 'bg-secondary' : 'bg-gray-500';
                $statusIconClass = $isActive ? 'bg-secondary text-secondary' : 'bg-gray-500 text-gray-500';
                $durationSeconds = (int) ($currentParking['durationSeconds'] ?? 0);
                $durationHours = intdiv($durationSeconds, 3600);
                $durationMinutes = intdiv($durationSeconds % 3600, 60);
                ?>
                <div
                    class="flex flex-wrap items-center gap-4 mb-4 pb-4 border-b border-gray-100">
                    <img
                        id="employee-photo"
                        src="http://localhost/osgparkingsystem/public/img/photo/<?php echo $session->get('user_id'); ?>.jpg"
                        alt="Employee"
                        class="w-20 h-20 rounded-full object-cover ring-2 ring-primary ring-opacity-20" />
                    <div class="min-w-0 flex-1">
                        <h3
                            id="employee-name"
                            class="text-base font-bold text-gray-900 mb-1">
                            <?php echo $session->get('user_fullname'); ?>
                        </h3>
                        <p id="employee-department" class="text-sm text-gray-600 mb-1">
                            Case Management Service
                        </p>
                        <p
                            id="employee-id"
                            class="max-w-full break-all text-xs font-mono text-gray-500 bg-gray-50 px-1 py-1 rounded inline-block">
                            <?php echo $session->get('user_id'); ?>
                        </p>
                    </div>
                </div>

                <div
                    class="<?= $statusPanelClass ?> rounded-2xl shadow-md p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">
                            Current Status
                        </h2>
                        <div
                            class="flex items-center gap-2 <?= $statusBadgeClass ?> px-4 py-2 rounded-full">
                            <span class="w-2 h-2 bg-white rounded-full <?= $isActive ? 'pulse-dot' : '' ?>"></span>
                            <span class="text-sm font-semibold text-white"><?= esc(strtoupper($currentStatus)) ?></span>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-center gap-2 bg-white bg-opacity-60 rounded-xl p-4">
                        <div
                            class="w-10 h-10 flex items-center justify-center <?= $statusIconClass ?> bg-opacity-20 rounded-full">
                            <i class="ri-time-line text-xl <?= $isActive ? 'text-secondary' : 'text-gray-500' ?>"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Parking Duration</p>
                            <p
                                class="text-2xl font-bold text-gray-900"
                                id="duration-display"
                                data-has-parking="<?= $currentLog ? '1' : '0' ?>"
                                data-duration-seconds="<?= $durationSeconds ?>">
                                <?= $currentLog ? esc($durationHours . 'h ' . $durationMinutes . 'm') : 'Not parked' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <?php if ($isActive && $currentLog): ?>
                    <div
                        class="bg-gradient-to-br from-primary to-blue-600 rounded-2xl shadow-md p-6 text-white">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-sm text-blue-100 mb-1">Your Parking Spot</p>
                                <p class="text-4xl font-bold"><?= esc($currentLog['p_slotno'] ?? 'N/A') ?></p>
                            </div>
                            <div
                                class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full">
                                <i class="ri-map-pin-fill text-2xl"></i>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="<?= (string) $currentLog['pl_category'] === '1' ? 'bg-orange-500' : 'bg-secondary' ?> px-3 py-1 rounded-full">
                                <span class="text-xs font-medium"><?= (string) $currentLog['pl_category'] === '1' ? 'Pay Parking' : 'Free Parking' ?></span>
                            </div>
                            <div class="flex items-center gap-1 text-sm text-blue-100">
                                <i class="ri-building-line text-base"></i>
                                <span>Level <?= esc($currentLog['p_level'] ?? 'N/A') ?></span>
                            </div>
                        </div>
                        <p class="mt-3 text-sm text-blue-100">
                            <?= esc(($currentLog['v_make'] ?? '') . ' ' . ($currentLog['v_model'] ?? '') . ' - ' . ($currentLog['v_plateno'] ?? '')) ?>
                        </p>
                    </div>
                <?php endif; ?>


                <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                    <h3 class="text-base font-semibold text-gray-900 mb-4">
                        Parking Availability
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-5">
                            <div
                                class="w-12 h-12 flex items-center justify-center bg-white rounded-full mb-3">
                                <i class="ri-parking-line text-2xl text-primary"></i>
                            </div>
                            <p class="text-4xl font-bold text-gray-900 mb-1">
                                <?= esc((string) ($availableFreeParkingCount ?? 0)) ?>
                            </p>
                            <p class="text-sm text-gray-600">Free Parking Slots Available</p>
                        </div>
                        <div
                            class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-5">
                            <div
                                class="w-12 h-12 flex items-center justify-center bg-white rounded-full mb-3">
                                <i class="ri-bank-card-line text-2xl text-orange-600"></i>
                            </div>
                            <p class="text-4xl font-bold text-gray-900 mb-1">
                                <?= esc((string) ($availablePaidParkingCount ?? 0)) ?>
                            </p>
                            <p class="text-sm text-gray-600">Pay Parking Slots Available</p>
                        </div>
                    </div>
                </div>
            </div>




            <!-- PROFILE TAB  -->
            <div id="profile-tab" class="tab-content">
                <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                    <div class="flex flex-col items-center">
                        <div class="relative mb-4">
                            <img
                                src="http://localhost/osgparkingsystem/public/img/photo/<?php echo $session->get('user_id'); ?>.jpg"
                                alt="Profile"
                                class="w-32 h-32 rounded-full object-cover ring-4 ring-primary ring-opacity-20" />
                            <div
                                class="absolute bottom-0 right-0 w-8 h-8 bg-secondary rounded-full border-4 border-white flex items-center justify-center">
                                <i class="ri-check-line text-white text-sm"></i>
                            </div>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-1">
                            <p style="text-align: center;"><?php echo $session->get('user_fullname'); ?></p>
                        </h1>
                        <p class="text-base text-gray-600 mb-2"><?php echo $session->get('user_division'); ?></p>
                        <div class="items-center">
                            <input id="text" type="text" value="<?php echo $session->get('user_id'); ?>" style="width:80%" hidden />
                            <div id="qrcode" style="width:200px; height:200px; margin-top:15px; margin-bottom:15px;"></div>
                            <!-- <img
                                src="https://docs.lightburnsoftware.com/legacy/img/QRCode/ExampleCode.png"
                                alt="QR Code"
                                class="w-48 h-48 object-contain" /> -->
                        </div>
                        <div class="bg-gray-100 px-4 py-2 rounded-full">
                            <p class="text-sm font-mono text-gray-700">Employee No. <?php echo $session->get('user_id'); ?></p>
                        </div>
                    </div>
                </div>
                <!-- <div class="bg-white rounded-2xl shadow-md p-6">
                    <h3 class="text-sm font-medium text-gray-600 text-center mb-4">
                        Employee QR Code
                    </h3>
                    <div class="bg-gray-50 rounded-xl p-6 flex flex-col items-center">
                        <img
                            src="https://readdy.ai/api/search-image?query=clean%20modern%20QR%20code%20design%2C%20black%20and%20white%20pattern%2C%20square%20format%2C%20minimalist%20style%2C%20centered%20composition%2C%20high%20contrast%2C%20scannable%20barcode%2C%20digital%20identification%2C%20simple%20geometric%20pattern&width=400&height=400&seq=qrcode001&orientation=squarish"
                            alt="QR Code"
                            class="w-48 h-48 object-contain" />
                        <p class="text-xs text-gray-500 mt-4">Tap to enlarge</p>
                    </div>
                </div> -->

                <!-- <div class="mt-6 grid grid-cols-2 gap-4">
                    <div
                        class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 cursor-pointer">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-white rounded-lg mb-3">
                            <i class="ri-car-line text-xl text-primary"></i>
                        </div>
                        <p class="text-xs text-gray-600 mb-1">Total Visits</p>
                        <p class="text-2xl font-bold text-gray-900">5</p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 cursor-pointer">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-white rounded-lg mb-3">
                            <i class="ri-time-line text-xl text-secondary"></i>
                        </div>
                        <p class="text-xs text-gray-600 mb-1">Total Hours (with Pay) for the Month</p>
                        <p class="text-2xl font-bold text-gray-900">37 h</p>
                    </div>
                </div> -->
            </div>




            <!-- 
                <div class="mt-6 grid grid-cols-3 gap-3">
                    <div
                        class="bg-white rounded-xl p-4 shadow-sm text-center cursor-pointer">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-blue-50 rounded-lg mx-auto mb-2">
                            <i class="ri-navigation-line text-xl text-primary"></i>
                        </div>
                        <p class="text-xs text-gray-600">Navigate</p>
                    </div>
                    <div
                        class="bg-white rounded-xl p-4 shadow-sm text-center cursor-pointer">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-orange-50 rounded-lg mx-auto mb-2">
                            <i class="ri-timer-line text-xl text-orange-600"></i>
                        </div>
                        <p class="text-xs text-gray-600">Extend</p>
                    </div>
                    <div
                        class="bg-white rounded-xl p-4 shadow-sm text-center cursor-pointer">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-red-50 rounded-lg mx-auto mb-2">
                            <i class="ri-logout-box-r-line text-xl text-red-600"></i>
                        </div>
                        <p class="text-xs text-gray-600">Check Out</p>
                    </div>
                </div>
            </div>
            -->


            <!-- HISTORY TAB  -->
            <div id="history-tab" class="tab-content">
                <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Parking Statistics
                    </h2>
                    <div class="grid grid-cols-3 gap-3 mb-6">
                        <!-- <div class="text-center">
                            <p class="text-2xl font-bold text-gray-900">5</p>
                            <p class="text-xs text-gray-600 mt-1">Total Visits</p>
                        </div> -->
                        <div class="text-center border-l border-r border-gray-200">
                            <p class="text-2xl font-bold text-gray-900">37 h</p>
                            <p class="text-xs text-gray-600 mt-1">Total Hours</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-900">Php 0.00</p>
                            <p class="text-xs text-gray-600 mt-1">Total Spent</p>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-r from-primary to-blue-600 rounded-xl p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-blue-100 mb-1">This Month</p>
                                <p class="text-3xl font-bold">32</p>
                                <p class="text-xs text-blue-100 mt-1">parking sessions</p>
                            </div>
                            <div
                                class="w-16 h-16 flex items-center justify-center bg-white bg-opacity-20 rounded-full">
                                <i class="ri-calendar-check-fill text-3xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-base font-semibold text-gray-900">
                        Recent History
                    </h3>
                    <button class="text-sm text-primary font-medium cursor-pointer">
                        View All
                    </button>
                </div>
                <div class="space-y-3">
                    <?php if (empty($parkingHistory)): ?>
                        <div class="bg-white rounded-xl shadow-sm p-4 text-sm text-gray-500">
                            No parking history for this month.
                        </div>
                    <?php else: ?>
                        <?php foreach ($parkingHistory as $historyItem): ?>
                            <?php
                            $isPaidHistory = (string) $historyItem['pl_category'] === '1';
                            $duration = $historyItem['pl_duration'] === null || $historyItem['pl_duration'] === ''
                                ? 'In progress'
                                : ((int) $historyItem['pl_duration']) . 'h 00m';
                            $dueAmount = number_format((float) ($historyItem['pl_due'] ?? 0), 2);
                            ?>
                            <div class="bg-white rounded-xl shadow-sm p-4">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 flex items-center justify-center <?= $isPaidHistory ? 'bg-orange-50' : 'bg-green-50' ?> rounded-lg">
                                            <i class="ri-parking-fill text-xl <?= $isPaidHistory ? 'text-orange-600' : 'text-secondary' ?>"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900"> <?= esc($historyItem['p_slotno'] ?? 'N/A') ?></p>
                                            <p class="text-xs text-gray-600">Level <?= esc($historyItem['p_level'] ?? 'N/A') ?> | <?= esc(($historyItem['v_make'] ?? '') . ' ' . ($historyItem['v_model'] ?? '')) ?> - <?= esc($historyItem['v_plateno'] ?? 'N/A') ?></p>
                                        </div>
                                    </div>
                                    <div class="<?= $isPaidHistory ? 'bg-orange-50' : 'bg-green-50' ?> px-2 py-1 rounded">
                                        <span class="text-xs font-medium <?= $isPaidHistory ? 'text-orange-600' : 'text-secondary' ?>"><?= $isPaidHistory ? 'Pay' : 'Free' ?></span>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center justify-between text-xs text-gray-600">
                                    <div class="flex items-center gap-1">
                                        <i class="ri-calendar-line"></i>
                                        <span><?= esc(date('M d, Y', strtotime($historyItem['pl_checkin']))) ?></span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <i class="ri-time-line"></i>
                                        <span><?= esc($duration) ?></span>
                                        <span class="font-medium text-gray-700"> - Php <?= esc($dueAmount) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>



    <script type="text/javascript">
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            // var qrcode = new QRCode("2008-11092", {
            // width: 100 % ,
            // height: 100 %
        });

        function makeCode() {
            var elText = document.getElementById("text");

            if (!elText.value) {
                alert("Input a text");
                elText.focus();
                return;
            }

            qrcode.makeCode(elText.value);
        }

        makeCode();

        $("#text").
        on("blur", function() {
            makeCode();
        }).
        on("keydown", function(e) {
            if (e.keyCode == 13) {
                makeCode();
            }
        });
    </script>

    <script id="tab-navigation">
        document.addEventListener("DOMContentLoaded", function() {
            const tabButtons = document.querySelectorAll(".tab-btn");
            const tabContents = document.querySelectorAll(".tab-content");
            tabButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const targetTab = this.getAttribute("data-tab");
                    tabButtons.forEach((btn) => {
                        btn.classList.remove(
                            "active",
                            "bg-white",
                            "text-gray-900",
                            "shadow-sm",
                        );
                        btn.classList.add("text-gray-600");
                    });
                    this.classList.add("active", "bg-white", "text-gray-900", "shadow-sm");
                    this.classList.remove("text-gray-600");
                    tabContents.forEach((content) => {
                        content.classList.remove("active");
                    });
                    document.getElementById(targetTab + "-tab").classList.add("active");
                });
            });
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




    <script id="duration-counter">
        document.addEventListener("DOMContentLoaded", function() {
            const durationDisplay = document.getElementById("duration-display");
            if (!durationDisplay || durationDisplay.dataset.hasParking !== "1") {
                return;
            }

            let durationSeconds = Number(durationDisplay.dataset.durationSeconds);

            function renderDuration() {
                const hours = Math.floor(durationSeconds / 3600);
                const minutes = Math.floor((durationSeconds % 3600) / 60);
                durationDisplay.textContent = hours + "h " + minutes + "m";
            }

            renderDuration();
            setInterval(function() {
                durationSeconds++;
                renderDuration();
            }, 60000);
        });
    </script>
</body>

</html>