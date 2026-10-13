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

<body class="bg-gray-50">
    <div
        class="w-full max-w-[1080px] mx-auto bg-gray-50 min-h-screen relative pb-6">

        <?php require __DIR__ . '/../template/header.php'; ?>


        <main class="pt-20 px-5">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-1">
                    Administrator Dashboard
                </h1>
                <p class="text-sm text-gray-600">
                    Welcome back, manage your parking system
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div
                    class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 text-white shadow-md">
                    <div
                        class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full mb-3">
                        <i class="ri-user-line text-2xl"></i>
                    </div>
                    <p class="text-3xl font-bold mb-1">1,247</p>
                    <p class="text-sm text-blue-100">Total Users</p>
                </div>
                <div
                    class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-5 text-white shadow-md">
                    <div
                        class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full mb-3">
                        <i class="ri-car-line text-2xl"></i>
                    </div>
                    <p class="text-3xl font-bold mb-1">89</p>
                    <p class="text-sm text-green-100">Active Sessions</p>
                </div>
                <div
                    class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-5 text-white shadow-md">
                    <div
                        class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full mb-3">
                        <i class="ri-parking-line text-2xl"></i>
                    </div>
                    <p class="text-3xl font-bold mb-1">156</p>
                    <p class="text-sm text-orange-100">Available Slots</p>
                </div>
                <div
                    class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-5 text-white shadow-md">
                    <div
                        class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full mb-3">
                        <i class="ri-money-dollar-circle-line text-2xl"></i>
                    </div>
                    <p class="text-3xl font-bold mb-1">$2,845</p>
                    <p class="text-sm text-purple-100">Revenue Today</p>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    Quick Actions
                </h2>
                <div class="grid grid-cols-4 gap-3">
                    <div
                        class="bg-white rounded-xl p-4 shadow-sm text-center cursor-pointer"
                        id="add-slot-btn">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-blue-50 rounded-lg mx-auto mb-2">
                            <i class="ri-add-circle-line text-2xl text-primary"></i>
                        </div>
                        <p class="text-xs text-gray-700 font-medium">Add Slot</p>
                    </div>
                    <div
                        class="bg-white rounded-xl p-4 shadow-sm text-center cursor-pointer"
                        id="reserve-slot-btn">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-purple-50 rounded-lg mx-auto mb-2">
                            <i class="ri-bookmark-line text-2xl text-purple-600"></i>
                        </div>
                        <p class="text-xs text-gray-700 font-medium">Reserve</p>
                    </div>
                    <div
                        class="bg-white rounded-xl p-4 shadow-sm text-center cursor-pointer"
                        id="pricing-btn">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-orange-50 rounded-lg mx-auto mb-2">
                            <i class="ri-price-tag-3-line text-2xl text-orange-600"></i>
                        </div>
                        <p class="text-xs text-gray-700 font-medium">Pricing</p>
                    </div>
                    <div
                        class="bg-white rounded-xl p-4 shadow-sm text-center cursor-pointer"
                        id="reports-btn">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-green-50 rounded-lg mx-auto mb-2">
                            <i class="ri-file-chart-line text-2xl text-secondary"></i>
                        </div>
                        <p class="text-xs text-gray-700 font-medium">Reports</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-5 mb-6">
                <h3 class="text-base font-semibold text-gray-900 mb-4">
                    Parking Availability Overview
                </h3>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div
                        class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div
                                class="w-10 h-10 flex items-center justify-center bg-white rounded-lg">
                                <i class="ri-parking-fill text-xl text-secondary"></i>
                            </div>
                            <span
                                class="bg-secondary text-white text-xs font-semibold px-2 py-1 rounded-full">Free</span>
                        </div>
                        <p class="text-2xl font-bold text-gray-900 mb-1">120 / 180</p>
                        <p class="text-xs text-gray-600">Available / Total</p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div
                                class="w-10 h-10 flex items-center justify-center bg-white rounded-lg">
                                <i class="ri-bank-card-fill text-xl text-orange-600"></i>
                            </div>
                            <span
                                class="bg-orange-600 text-white text-xs font-semibold px-2 py-1 rounded-full">Pay</span>
                        </div>
                        <p class="text-2xl font-bold text-gray-900 mb-1">36 / 65</p>
                        <p class="text-xs text-gray-600">Available / Total</p>
                    </div>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-secondary rounded-full"></span>
                        <span class="text-gray-600">Occupied: 60</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-orange-600 rounded-full"></span>
                        <span class="text-gray-600">Occupied: 29</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-5 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">
                        Manage Parking Slots
                    </h3>
                    <button
                        class="text-sm text-primary font-medium cursor-pointer"
                        id="view-all-slots">
                        View All
                    </button>
                </div>
                <button
                    class="w-full bg-primary text-white py-3 rounded-button font-medium mb-4 cursor-pointer flex items-center justify-center gap-2 !rounded-button"
                    id="add-new-slot">
                    <i class="ri-add-line text-xl"></i>
                    <span>Add New Slot</span>
                </button>
                <div class="space-y-3" id="slots-container">
                    <div class="slot-item bg-gray-50 rounded-xl p-4 cursor-pointer">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 flex items-center justify-center bg-green-100 rounded-lg">
                                    <i class="ri-parking-fill text-xl text-secondary"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Slot A-23</p>
                                    <p class="text-xs text-gray-600">Level 2, Block A</p>
                                </div>
                            </div>
                            <span
                                class="bg-green-100 text-secondary text-xs font-semibold px-3 py-1 rounded-full">Available</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="bg-white text-gray-700 text-xs px-2 py-1 rounded border border-gray-200">Free Parking</span>
                            <div class="flex-1"></div>
                            <button
                                class="w-8 h-8 flex items-center justify-center bg-blue-50 rounded-lg cursor-pointer">
                                <i class="ri-edit-line text-base text-primary"></i>
                            </button>
                            <button
                                class="w-8 h-8 flex items-center justify-center bg-purple-50 rounded-lg cursor-pointer">
                                <i class="ri-bookmark-line text-base text-purple-600"></i>
                            </button>
                            <button
                                class="w-8 h-8 flex items-center justify-center bg-red-50 rounded-lg cursor-pointer">
                                <i class="ri-delete-bin-line text-base text-red-600"></i>
                            </button>
                        </div>
                    </div>
                    <div class="slot-item bg-gray-50 rounded-xl p-4 cursor-pointer">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 flex items-center justify-center bg-orange-100 rounded-lg">
                                    <i class="ri-parking-fill text-xl text-orange-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Slot B-15</p>
                                    <p class="text-xs text-gray-600">Level 1, Block B</p>
                                </div>
                            </div>
                            <span
                                class="bg-red-100 text-red-600 text-xs font-semibold px-3 py-1 rounded-full">Occupied</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="bg-white text-gray-700 text-xs px-2 py-1 rounded border border-gray-200">Pay Park</span>
                            <div class="flex-1"></div>
                            <button
                                class="w-8 h-8 flex items-center justify-center bg-blue-50 rounded-lg cursor-pointer">
                                <i class="ri-edit-line text-base text-primary"></i>
                            </button>
                            <button
                                class="w-8 h-8 flex items-center justify-center bg-purple-50 rounded-lg cursor-pointer">
                                <i class="ri-bookmark-line text-base text-purple-600"></i>
                            </button>
                            <button
                                class="w-8 h-8 flex items-center justify-center bg-red-50 rounded-lg cursor-pointer">
                                <i class="ri-delete-bin-line text-base text-red-600"></i>
                            </button>
                        </div>
                    </div>
                    <div class="slot-item bg-gray-50 rounded-xl p-4 cursor-pointer">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 flex items-center justify-center bg-purple-100 rounded-lg">
                                    <i class="ri-parking-fill text-xl text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Slot C-08</p>
                                    <p class="text-xs text-gray-600">Level 3, Block C</p>
                                </div>
                            </div>
                            <span
                                class="bg-purple-100 text-purple-600 text-xs font-semibold px-3 py-1 rounded-full">Reserved</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="bg-white text-gray-700 text-xs px-2 py-1 rounded border border-gray-200">Free Parking</span>
                            <div class="flex-1"></div>
                            <button
                                class="w-8 h-8 flex items-center justify-center bg-blue-50 rounded-lg cursor-pointer">
                                <i class="ri-edit-line text-base text-primary"></i>
                            </button>
                            <button
                                class="w-8 h-8 flex items-center justify-center bg-purple-50 rounded-lg cursor-pointer">
                                <i class="ri-bookmark-line text-base text-purple-600"></i>
                            </button>
                            <button
                                class="w-8 h-8 flex items-center justify-center bg-red-50 rounded-lg cursor-pointer">
                                <i class="ri-delete-bin-line text-base text-red-600"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-5 mb-6">
                <h3 class="text-base font-semibold text-gray-900 mb-4">
                    Parking Pricing Settings
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700 mb-2 block">First 2 Hours Rate</label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-600 font-medium">$</span>
                            <input
                                type="number"
                                value="5.00"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-base font-medium text-gray-900"
                                id="first-rate" />
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700 mb-2 block">Additional Hour Rate</label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-600 font-medium">$</span>
                            <input
                                type="number"
                                value="2.50"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-base font-medium text-gray-900"
                                id="additional-rate" />
                        </div>
                    </div>
                    <div class="bg-blue-50 rounded-xl p-4">
                        <p class="text-xs text-gray-600 mb-2">Current Pricing</p>
                        <p class="text-sm font-semibold text-gray-900">
                            $5.00 for first 2 hours, then $2.50/hour
                        </p>
                    </div>
                    <button
                        class="w-full bg-primary text-white py-3 rounded-button font-medium cursor-pointer !rounded-button"
                        id="update-pricing">
                        Update Pricing
                    </button>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-xs font-medium text-gray-600 mb-3">Recent Changes</p>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600">Sep 15, 2026</span>
                            <span class="text-gray-900 font-medium">$5.00 / $2.50</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600">Aug 01, 2026</span>
                            <span class="text-gray-900 font-medium">$4.50 / $2.00</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600">Jun 10, 2026</span>
                            <span class="text-gray-900 font-medium">$4.00 / $2.00</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-5 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">
                        User Management
                    </h3>
                    <button class="text-sm text-primary font-medium cursor-pointer">
                        View All
                    </button>
                </div>
                <div class="relative mb-4">
                    <i
                        class="ri-search-line absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                    <input
                        type="text"
                        placeholder="Search users..."
                        class="w-full bg-gray-50 border-none rounded-xl pl-12 pr-4 py-3 text-sm" />
                </div>
                <div class="space-y-3">
                    <div class="bg-gray-50 rounded-xl p-4 cursor-pointer">
                        <div class="flex items-center gap-3 mb-3">
                            <img
                                src="https://readdy.ai/api/search-image?query=professional%20headshot%20of%20confident%20female%20business%20executive%20in%20corporate%20attire%2C%20studio%20lighting%2C%20clean%20white%20background%2C%20high%20quality%20portrait%20photography%2C%20friendly%20professional%20expression&width=120&height=120&seq=user001&orientation=squarish"
                                alt="User"
                                class="w-12 h-12 rounded-full object-cover" />
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">
                                    Sarah Mitchell
                                </p>
                                <p class="text-xs text-gray-600">ID: 2008-10234</p>
                            </div>
                            <span
                                class="bg-green-100 text-secondary text-xs font-semibold px-2 py-1 rounded-full">Active</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-600">Engineering Division</span>
                            <div class="flex-1"></div>
                            <button class="text-xs text-primary font-medium cursor-pointer">
                                Details
                            </button>
                            <button class="text-xs text-red-600 font-medium cursor-pointer">
                                Suspend
                            </button>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 cursor-pointer">
                        <div class="flex items-center gap-3 mb-3">
                            <img
                                src="https://readdy.ai/api/search-image?query=professional%20business%20portrait%20of%20male%20manager%20in%20suit%20and%20tie%2C%20studio%20lighting%2C%20clean%20white%20background%2C%20high%20quality%20corporate%20headshot%2C%20confident%20smile&width=120&height=120&seq=user002&orientation=squarish"
                                alt="User"
                                class="w-12 h-12 rounded-full object-cover" />
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">David Chen</p>
                                <p class="text-xs text-gray-600">ID: 2008-09876</p>
                            </div>
                            <span
                                class="bg-green-100 text-secondary text-xs font-semibold px-2 py-1 rounded-full">Active</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-600">Marketing Department</span>
                            <div class="flex-1"></div>
                            <button class="text-xs text-primary font-medium cursor-pointer">
                                Details
                            </button>
                            <button class="text-xs text-red-600 font-medium cursor-pointer">
                                Suspend
                            </button>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 cursor-pointer">
                        <div class="flex items-center gap-3 mb-3">
                            <img
                                src="https://readdy.ai/api/search-image?query=professional%20headshot%20of%20young%20female%20professional%20in%20business%20casual%2C%20studio%20lighting%2C%20clean%20white%20background%2C%20high%20quality%20portrait%2C%20warm%20friendly%20smile&width=120&height=120&seq=user003&orientation=squarish"
                                alt="User"
                                class="w-12 h-12 rounded-full object-cover" />
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">
                                    Emma Rodriguez
                                </p>
                                <p class="text-xs text-gray-600">ID: 2008-11567</p>
                            </div>
                            <span
                                class="bg-gray-200 text-gray-600 text-xs font-semibold px-2 py-1 rounded-full">Inactive</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-600">Finance Department</span>
                            <div class="flex-1"></div>
                            <button class="text-xs text-primary font-medium cursor-pointer">
                                Details
                            </button>
                            <button class="text-xs text-red-600 font-medium cursor-pointer">
                                Suspend
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-5 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-900">
                        Real-time Monitoring
                    </h3>
                    <button
                        class="w-8 h-8 flex items-center justify-center bg-gray-50 rounded-lg cursor-pointer">
                        <i class="ri-refresh-line text-lg text-gray-600"></i>
                    </button>
                </div>
                <div
                    class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-700">Live Occupancy</span>
                        <span class="text-2xl font-bold text-gray-900">64%</span>
                    </div>
                    <div class="w-full bg-white bg-opacity-60 rounded-full h-2">
                        <div class="bg-primary h-2 rounded-full" style="width: 64%"></div>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-secondary rounded-full pulse-dot"></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-medium">Recent Check-in</p>
                            <p class="text-xs text-gray-600">Slot A-45 - 2 mins ago</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-orange-600 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-medium">
                                Recent Check-out
                            </p>
                            <p class="text-xs text-gray-600">Slot B-12 - 5 mins ago</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-medium">Peak Hours</p>
                            <p class="text-xs text-gray-600">8:00 AM - 10:00 AM</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-5 mb-6">
                <h3 class="text-base font-semibold text-gray-900 mb-4">
                    Analytics Summary
                </h3>
                <div class="bg-gray-50 rounded-xl p-1 flex gap-1 mb-4">
                    <button
                        class="analytics-tab flex-1 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 cursor-pointer bg-white text-gray-900 shadow-sm"
                        data-period="today">
                        Today
                    </button>
                    <button
                        class="analytics-tab flex-1 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 cursor-pointer text-gray-600"
                        data-period="week">
                        Week
                    </button>
                    <button
                        class="analytics-tab flex-1 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 cursor-pointer text-gray-600"
                        data-period="month">
                        Month
                    </button>
                </div>
                <div id="usage-chart" class="w-full h-48 mb-4"></div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-gray-900">342</p>
                        <p class="text-xs text-gray-600 mt-1">Sessions</p>
                    </div>
                    <div class="text-center border-l border-r border-gray-200">
                        <p class="text-2xl font-bold text-gray-900">5.2h</p>
                        <p class="text-xs text-gray-600 mt-1">Avg Duration</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-gray-900">9 AM</p>
                        <p class="text-xs text-gray-600 mt-1">Peak Time</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-5 mb-6">
                <h3 class="text-base font-semibold text-gray-900 mb-4">
                    Revenue Reports
                </h3>
                <div
                    class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-5 text-white mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-green-100">Total Revenue</span>
                        <div class="flex items-center gap-1">
                            <i class="ri-arrow-up-line text-lg"></i>
                            <span class="text-sm font-medium">+12.5%</span>
                        </div>
                    </div>
                    <p class="text-3xl font-bold mb-1">$28,450</p>
                    <p class="text-xs text-green-100">This month</p>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div class="bg-green-50 rounded-xl p-4">
                        <p class="text-xs text-gray-600 mb-1">Free Parking</p>
                        <p class="text-xl font-bold text-gray-900">$0</p>
                    </div>
                    <div class="bg-orange-50 rounded-xl p-4">
                        <p class="text-xs text-gray-600 mb-1">Pay Parking</p>
                        <p class="text-xl font-bold text-gray-900">$28,450</p>
                    </div>
                </div>
                <button
                    class="w-full bg-gray-100 text-gray-700 py-3 rounded-button font-medium cursor-pointer flex items-center justify-center gap-2 !rounded-button">
                    <i class="ri-download-line text-lg"></i>
                    <span>Export Report</span>
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-5 mb-6">
                <h3 class="text-base font-semibold text-gray-900 mb-4">
                    Recent Activity Feed
                </h3>
                <div class="space-y-3 max-h-80 overflow-y-auto">
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-blue-50 rounded-lg flex-shrink-0">
                            <i class="ri-user-add-line text-base text-primary"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-medium">
                                New user registered
                            </p>
                            <p class="text-xs text-gray-600">
                                Jennifer Williams joined the system
                            </p>
                            <p class="text-xs text-gray-500 mt-1">5 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-green-50 rounded-lg flex-shrink-0">
                            <i class="ri-parking-line text-base text-secondary"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-medium">
                                Parking session started
                            </p>
                            <p class="text-xs text-gray-600">
                                Robert Taylor checked in at Slot C-15
                            </p>
                            <p class="text-xs text-gray-500 mt-1">12 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-orange-50 rounded-lg flex-shrink-0">
                            <i class="ri-price-tag-3-line text-base text-orange-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-medium">Pricing updated</p>
                            <p class="text-xs text-gray-600">
                                Admin changed hourly rate to $2.50
                            </p>
                            <p class="text-xs text-gray-500 mt-1">1 hour ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-purple-50 rounded-lg flex-shrink-0">
                            <i class="ri-bookmark-line text-base text-purple-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-medium">Slot reserved</p>
                            <p class="text-xs text-gray-600">
                                Slot A-10 reserved for maintenance
                            </p>
                            <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-red-50 rounded-lg flex-shrink-0">
                            <i class="ri-logout-box-r-line text-base text-red-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-medium">
                                Parking session ended
                            </p>
                            <p class="text-xs text-gray-600">
                                Lisa Anderson checked out from Slot B-22
                            </p>
                            <p class="text-xs text-gray-500 mt-1">3 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pb-3">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-green-50 rounded-lg flex-shrink-0">
                            <i class="ri-database-2-line text-base text-secondary"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-medium">
                                System backup completed
                            </p>
                            <p class="text-xs text-gray-600">
                                Daily backup successfully created
                            </p>
                            <p class="text-xs text-gray-500 mt-1">5 hours ago</p>
                        </div>
                    </div>
                </div>
                <button
                    class="w-full mt-4 text-sm text-primary font-medium cursor-pointer">
                    Load More
                </button>
            </div>

            <div class="grid grid-cols-3 gap-3 mb-6">
                <button
                    class="bg-white rounded-xl p-4 shadow-sm text-center cursor-pointer">
                    <div
                        class="w-12 h-12 flex items-center justify-center bg-blue-50 rounded-lg mx-auto mb-2">
                        <i class="ri-file-chart-line text-2xl text-primary"></i>
                    </div>
                    <p class="text-xs text-gray-700 font-medium">Generate Report</p>
                </button>
                <button
                    class="bg-white rounded-xl p-4 shadow-sm text-center cursor-pointer">
                    <div
                        class="w-12 h-12 flex items-center justify-center bg-green-50 rounded-lg mx-auto mb-2">
                        <i class="ri-database-2-line text-2xl text-secondary"></i>
                    </div>
                    <p class="text-xs text-gray-700 font-medium">System Backup</p>
                </button>
                <button
                    class="bg-white rounded-xl p-4 shadow-sm text-center cursor-pointer">
                    <div
                        class="w-12 h-12 flex items-center justify-center bg-orange-50 rounded-lg mx-auto mb-2">
                        <i class="ri-notification-3-line text-2xl text-orange-600"></i>
                    </div>
                    <p class="text-xs text-gray-700 font-medium">Send Notifications</p>
                </button>
            </div>
        </main>
    </div>

    <div id="add-slot-modal" class="modal">
        <div
            class="modal-content bg-white rounded-2xl shadow-2xl w-11/12 max-w-[340px] p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">
                    Add New Parking Slot
                </h3>
                <button
                    class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-lg cursor-pointer"
                    id="close-add-modal">
                    <i class="ri-close-line text-xl text-gray-600"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-700 mb-2 block">Slot ID</label>
                    <input
                        type="text"
                        placeholder="e.g., A-24"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm" />
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700 mb-2 block">Location</label>
                    <input
                        type="text"
                        placeholder="e.g., Level 2, Block A"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm" />
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700 mb-2 block">Slot Type</label>
                    <div class="grid grid-cols-2 gap-3">
                        <button
                            class="slot-type-btn bg-green-50 border-2 border-secondary text-secondary py-3 rounded-xl font-medium cursor-pointer text-sm active">
                            Free Parking
                        </button>
                        <button
                            class="slot-type-btn bg-gray-50 border-2 border-gray-200 text-gray-600 py-3 rounded-xl font-medium cursor-pointer text-sm">
                            Pay Park
                        </button>
                    </div>
                </div>
                <button
                    class="w-full bg-primary text-white py-3 rounded-button font-medium cursor-pointer !rounded-button"
                    id="confirm-add-slot">
                    Add Slot
                </button>
            </div>
        </div>
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
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-600 font-medium">$</span>
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
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-600 font-medium">$</span>
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

    <script id="modal-management">
        document.addEventListener("DOMContentLoaded", function() {
            const addSlotBtn = document.getElementById("add-slot-btn");
            const addNewSlotBtn = document.getElementById("add-new-slot");
            const addSlotModal = document.getElementById("add-slot-modal");
            const closeAddModal = document.getElementById("close-add-modal");
            const confirmAddSlot = document.getElementById("confirm-add-slot");
            const pricingBtn = document.getElementById("pricing-btn");
            const pricingModal = document.getElementById("pricing-modal");
            const closePricingModal = document.getElementById("close-pricing-modal");
            const confirmPricing = document.getElementById("confirm-pricing");
            const updatePricingBtn = document.getElementById("update-pricing");
            const toast = document.getElementById("toast");
            const toastMessage = document.getElementById("toast-message");

            function showToast(message) {
                toastMessage.textContent = message;
                toast.classList.add("active");
                setTimeout(() => {
                    toast.classList.remove("active");
                }, 3000);
            }

            addSlotBtn.addEventListener("click", function() {
                addSlotModal.classList.add("active");
            });

            addNewSlotBtn.addEventListener("click", function() {
                addSlotModal.classList.add("active");
            });

            closeAddModal.addEventListener("click", function() {
                addSlotModal.classList.remove("active");
            });

            addSlotModal.addEventListener("click", function(e) {
                if (e.target === addSlotModal) {
                    addSlotModal.classList.remove("active");
                }
            });

            confirmAddSlot.addEventListener("click", function() {
                addSlotModal.classList.remove("active");
                showToast("New parking slot added successfully");
            });

            pricingBtn.addEventListener("click", function() {
                pricingModal.classList.add("active");
            });

            updatePricingBtn.addEventListener("click", function() {
                pricingModal.classList.add("active");
            });

            closePricingModal.addEventListener("click", function() {
                pricingModal.classList.remove("active");
            });

            pricingModal.addEventListener("click", function(e) {
                if (e.target === pricingModal) {
                    pricingModal.classList.remove("active");
                }
            });

            confirmPricing.addEventListener("click", function() {
                pricingModal.classList.remove("active");
                showToast("Pricing updated successfully");
            });

            const slotTypeBtns = document.querySelectorAll(".slot-type-btn");
            slotTypeBtns.forEach((btn) => {
                btn.addEventListener("click", function() {
                    slotTypeBtns.forEach((b) => {
                        b.classList.remove(
                            "active",
                            "bg-green-50",
                            "border-secondary",
                            "text-secondary",
                            "bg-orange-50",
                            "border-orange-600",
                            "text-orange-600",
                        );
                        b.classList.add("bg-gray-50", "border-gray-200", "text-gray-600");
                    });
                    if (this.textContent.trim() === "Free Parking") {
                        this.classList.add(
                            "active",
                            "bg-green-50",
                            "border-secondary",
                            "text-secondary",
                        );
                        this.classList.remove("bg-gray-50", "border-gray-200", "text-gray-600");
                    } else {
                        this.classList.add(
                            "active",
                            "bg-orange-50",
                            "border-orange-600",
                            "text-orange-600",
                        );
                        this.classList.remove("bg-gray-50", "border-gray-200", "text-gray-600");
                    }
                });
            });
        });
    </script>

    <script id="analytics-chart">
        document.addEventListener("DOMContentLoaded", function() {
            const chartDom = document.getElementById("usage-chart");
            const myChart = echarts.init(chartDom);
            const option = {
                grid: {
                    left: "10%",
                    right: "5%",
                    top: "10%",
                    bottom: "15%",
                },
                xAxis: {
                    type: "category",
                    data: ["6AM", "9AM", "12PM", "3PM", "6PM", "9PM"],
                    axisLine: {
                        lineStyle: {
                            color: "#E5E7EB",
                        },
                    },
                    axisLabel: {
                        color: "#6B7280",
                        fontSize: 10,
                    },
                },
                yAxis: {
                    type: "value",
                    axisLine: {
                        show: false,
                    },
                    axisTick: {
                        show: false,
                    },
                    splitLine: {
                        lineStyle: {
                            color: "#F3F4F6",
                        },
                    },
                    axisLabel: {
                        color: "#6B7280",
                        fontSize: 10,
                    },
                },
                series: [{
                    data: [45, 89, 76, 92, 68, 34],
                    type: "bar",
                    itemStyle: {
                        color: "#2563EB",
                        borderRadius: [8, 8, 0, 0],
                    },
                    barWidth: "40%",
                }, ],
            };
            myChart.setOption(option);

            const analyticsTabs = document.querySelectorAll(".analytics-tab");
            analyticsTabs.forEach((tab) => {
                tab.addEventListener("click", function() {
                    analyticsTabs.forEach((t) => {
                        t.classList.remove("bg-white", "text-gray-900", "shadow-sm");
                        t.classList.add("text-gray-600");
                    });
                    this.classList.add("bg-white", "text-gray-900", "shadow-sm");
                    this.classList.remove("text-gray-600");
                    const period = this.getAttribute("data-period");
                    let newData;
                    if (period === "today") {
                        newData = [45, 89, 76, 92, 68, 34];
                    } else if (period === "week") {
                        newData = [320, 410, 380, 450, 390, 280];
                    } else {
                        newData = [1200, 1450, 1380, 1520, 1410, 1180];
                    }
                    myChart.setOption({
                        series: [{
                            data: newData,
                        }, ],
                    });
                });
            });
        });
    </script>

    <script id="quick-actions">
        document.addEventListener("DOMContentLoaded", function() {
            const reserveSlotBtn = document.getElementById("reserve-slot-btn");
            const reportsBtn = document.getElementById("reports-btn");
            const toast = document.getElementById("toast");
            const toastMessage = document.getElementById("toast-message");

            function showToast(message) {
                toastMessage.textContent = message;
                toast.classList.add("active");
                setTimeout(() => {
                    toast.classList.remove("active");
                }, 3000);
            }

            reserveSlotBtn.addEventListener("click", function() {
                showToast("Opening slot reservation panel");
            });

            reportsBtn.addEventListener("click", function() {
                showToast("Generating comprehensive report");
            });
        });
    </script>
</body>

</html>