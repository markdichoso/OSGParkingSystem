<!DOCTYPE html>
<html lang="en">

<?php
$session = session();
?>


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Parking Confirmation</title>
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

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-up {
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pulse-success {
            animation: pulseSuccess 1.5s ease-in-out;
        }

        @keyframes pulseSuccess {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-ring {
            animation: successRing 1.5s ease-out;
        }

        @keyframes successRing {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            50% {
                opacity: 0.3;
            }

            100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="w-full max-w-[375px] mx-auto bg-white min-h-screen relative">
        <header class="fixed top-0 w-full max-w-[375px] bg-white z-50 shadow-sm">
            <div class="flex items-center justify-between px-5 py-4 h-16">
                <div class="font-['Pacifico'] text-2xl text-primary">logo</div>
                <div class="flex items-center gap-4">
                    <div
                        class="w-10 h-10 flex items-center justify-center cursor-pointer relative">
                        <i class="ri-notification-3-line text-2xl text-gray-700"></i>
                        <span
                            class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
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
        <main class="pt-20 pb-8 px-5 fade-in">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-1">
                    Parking Confirmation
                </h1>
                <p class="text-sm text-gray-600">Review assigned parking details</p>
            </div>
            <div class="flex flex-col items-center justify-center mb-8 slide-up">
                <div class="relative mb-4">
                    <div
                        class="w-24 h-24 bg-secondary rounded-full flex items-center justify-center pulse-success">
                        <i class="ri-check-line text-5xl text-white"></i>
                    </div>
                    <div
                        class="absolute inset-0 w-24 h-24 bg-secondary rounded-full success-ring"></div>
                </div>
                <h2 class="text-xl font-bold text-gray-900 mb-1">
                    Assignment Successful
                </h2>
                <p class="text-sm text-gray-600">Parking spot has been assigned</p>
            </div>
            <div
                class="bg-white rounded-2xl shadow-md p-6 mb-6 slide-up"
                style="animation-delay: 0.1s;">
                <div class="flex flex-col items-center mb-4">
                    <div class="relative mb-4">
                        <img
                            src="https://readdy.ai/api/search-image?query=professional%20business%20portrait%20of%20confident%20male%20employee%20in%20corporate%20attire%2C%20studio%20lighting%2C%20clean%20white%20background%2C%20high%20quality%20headshot%20photography%2C%20friendly%20smile%2C%20business%20casual%2C%20modern%20professional%20look&width=200&height=200&seq=conf001&orientation=squarish"
                            alt="Employee"
                            class="w-20 h-20 rounded-full object-cover ring-4 ring-primary ring-opacity-20" />
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">
                        <?= esc($fullname ?? '') ?>
                    </h3>
                    <p class="text-sm text-gray-600 mb-2">Engineering Division</p>
                    <div class="bg-gray-100 px-3 py-1 rounded-full">
                        <p class="text-xs font-mono text-gray-700">2008-15847</p>
                    </div>
                </div>
            </div>
            <div
                class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-5 mb-6 slide-up"
                style="animation-delay: 0.2s;">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-car-fill text-base text-gray-600"></i>
                    </div>
                    <span class="text-xs font-medium text-gray-600">Vehicle Information</span>
                </div>
                <div class="bg-white rounded-xl p-4">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm text-gray-600">Car Model</span>
                        <span class="text-sm font-bold text-gray-900">Honda Accord</span>
                    </div>
                    <div class="border-t border-gray-100 my-3"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">License Plate</span>
                        <div class="bg-gray-900 px-3 py-1 rounded">
                            <span class="text-sm font-bold text-white tracking-wider">XYZ 5678</span>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="bg-gradient-to-br from-primary to-blue-600 rounded-2xl p-6 mb-6 text-white slide-up"
                style="animation-delay: 0.3s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-parking-box-fill text-base text-blue-200"></i>
                            </div>
                            <span class="text-xs font-medium text-blue-200">Assigned Parking Slot</span>
                        </div>
                        <p class="text-5xl font-bold mb-2">A-12</p>
                        <div class="flex items-center gap-4 text-sm text-blue-100">
                            <div class="flex items-center gap-1">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-building-2-line text-xs"></i>
                                </div>
                                <span>Level 2</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-layout-grid-line text-xs"></i>
                                </div>
                                <span>Block A</span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-16 h-16 flex items-center justify-center bg-white bg-opacity-20 rounded-2xl">
                        <i class="ri-map-pin-fill text-3xl"></i>
                    </div>
                </div>
                <div
                    class="bg-secondary bg-opacity-20 rounded-xl px-4 py-2 inline-block">
                    <span class="text-sm font-semibold text-white">Free Parking</span>
                </div>
            </div>
            <div
                class="bg-white rounded-2xl shadow-md p-5 mb-6 slide-up"
                style="animation-delay: 0.4s;">
                <div class="flex items-center gap-3 mb-4">
                    <div
                        class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-lg">
                        <i class="ri-time-line text-xl text-gray-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600">Entry Timestamp</p>
                        <p class="text-sm font-semibold text-gray-900">
                            Dec 28, 2026 09:15 AM
                        </p>
                    </div>
                </div>
            </div>
            <div
                class="bg-white rounded-2xl shadow-md p-5 mb-6 slide-up"
                style="animation-delay: 0.5s;">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">
                        Additional Details
                    </h3>
                    <button
                        id="toggle-details"
                        class="w-8 h-8 flex items-center justify-center cursor-pointer">
                        <i
                            class="ri-arrow-down-s-line text-xl text-gray-600 transition-transform duration-300"
                            id="toggle-icon"></i>
                    </button>
                </div>
                <div id="additional-details" class="hidden space-y-3">
                    <div
                        class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Reference Number</span>
                        <span class="text-sm font-mono font-medium text-gray-900">#PKG-2026-0847</span>
                    </div>
                    <div
                        class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Parking Type</span>
                        <div class="bg-secondary bg-opacity-10 px-3 py-1 rounded-full">
                            <span class="text-xs font-medium text-secondary">Employee Free Parking</span>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Expected Duration</span>
                        <span class="text-sm font-medium text-gray-900">8 hours</span>
                    </div>
                    <div class="bg-blue-50 rounded-xl p-3 mt-3">
                        <div class="flex items-start gap-2">
                            <div class="w-5 h-5 flex items-center justify-center mt-0.5">
                                <i class="ri-information-line text-base text-primary"></i>
                            </div>
                            <p class="text-xs text-gray-700 leading-relaxed">
                                Please ensure your vehicle is parked within the marked
                                boundaries. Contact parking assistance at ext. 2345 for any
                                issues.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-3 mb-6">
                <button
                    id="done-button"
                    class="w-full bg-primary text-white py-3.5 rounded-button font-semibold flex items-center justify-center gap-2 cursor-pointer whitespace-nowrap shadow-lg shadow-primary/30">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-check-double-line text-lg"></i>
                    </div>
                    <span>Complete</span>
                </button>
                <button
                    id="print-button"
                    class="w-full bg-white border-2 border-gray-200 text-gray-700 py-3.5 rounded-button font-medium flex items-center justify-center gap-2 cursor-pointer whitespace-nowrap">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-printer-line text-lg"></i>
                    </div>
                    <span>Print Receipt</span>
                </button>
            </div>
            <div
                class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-5 slide-up"
                style="animation-delay: 0.6s;">
                <h3 class="text-sm font-semibold text-gray-900 mb-4">Quick Access</h3>
                <div
                    class="bg-white rounded-xl p-4 mb-3 flex items-center justify-center">
                    <div class="text-center">
                        <div
                            class="w-32 h-32 bg-gray-900 rounded-xl mx-auto mb-3 flex items-center justify-center">
                            <div
                                class="w-28 h-28 bg-white rounded-lg flex items-center justify-center">
                                <div class="grid grid-cols-3 gap-1">
                                    <div class="w-2 h-2 bg-gray-900 rounded-sm"></div>
                                    <div class="w-2 h-2 bg-white"></div>
                                    <div class="w-2 h-2 bg-gray-900 rounded-sm"></div>
                                    <div class="w-2 h-2 bg-white"></div>
                                    <div class="w-2 h-2 bg-gray-900 rounded-sm"></div>
                                    <div class="w-2 h-2 bg-white"></div>
                                    <div class="w-2 h-2 bg-gray-900 rounded-sm"></div>
                                    <div class="w-2 h-2 bg-white"></div>
                                    <div class="w-2 h-2 bg-gray-900 rounded-sm"></div>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600">
                            Scan for quick exit verification
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white rounded-xl p-3 text-center cursor-pointer">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-blue-50 rounded-lg mx-auto mb-2">
                            <i class="ri-share-line text-lg text-primary"></i>
                        </div>
                        <p class="text-xs font-medium text-gray-900">Share</p>
                    </div>
                    <div class="bg-white rounded-xl p-3 text-center cursor-pointer">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-orange-50 rounded-lg mx-auto mb-2">
                            <i
                                class="ri-customer-service-2-line text-lg text-orange-600"></i>
                        </div>
                        <p class="text-xs font-medium text-gray-900">Support</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div
        id="toast-container"
        class="fixed top-20 left-1/2 -translate-x-1/2 z-50"></div>
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
    <script id="details-toggle">
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButton = document.getElementById("toggle-details");
            const additionalDetails = document.getElementById("additional-details");
            const toggleIcon = document.getElementById("toggle-icon");
            toggleButton.addEventListener("click", function() {
                additionalDetails.classList.toggle("hidden");
                if (additionalDetails.classList.contains("hidden")) {
                    toggleIcon.style.transform = "rotate(0deg)";
                } else {
                    toggleIcon.style.transform = "rotate(180deg)";
                }
            });
        });
    </script>
    <script id="button-actions">
        document.addEventListener("DOMContentLoaded", function() {
            const doneButton = document.getElementById("done-button");
            const printButton = document.getElementById("print-button");

            function showToast(message, type) {
                const toastContainer = document.getElementById("toast-container");
                const toast = document.createElement("div");
                toast.className = `px-6 py-3 rounded-xl shadow-lg ${type === "success" ? "bg-secondary" : "bg-primary"} text-white fade-in`;
                toast.innerHTML = `
      <div class="flex items-center gap-2">
      <i class="ri-${type === "success" ? "check" : "information"}-circle-fill text-xl"></i>
      <span class="font-medium">${message}</span>
      </div>
      `;
                toastContainer.appendChild(toast);
                setTimeout(() => {
                    toast.remove();
                }, 3000);
            }
            doneButton.addEventListener("click", function() {
                const originalContent = this.innerHTML;
                this.innerHTML =
                    '<div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div><span>Processing...</span>';
                this.disabled = true;
                setTimeout(() => {
                    showToast("Transaction completed successfully", "success");
                    this.innerHTML = originalContent;
                    this.disabled = false;
                    setTimeout(() => {
                        window.location.href = "parking-attendant-portal.html";
                    }, 1500);
                }, 1500);
            });
            printButton.addEventListener("click", function() {
                const originalContent = this.innerHTML;
                this.innerHTML =
                    '<div class="w-5 h-5 border-2 border-gray-400 border-t-transparent rounded-full animate-spin"></div><span>Preparing...</span>';
                this.disabled = true;
                setTimeout(() => {
                    showToast("Receipt prepared for printing", "info");
                    this.innerHTML = originalContent;
                    this.disabled = false;
                    window.print();
                }, 1000);
            });
        });
    </script>
</body>

</html>