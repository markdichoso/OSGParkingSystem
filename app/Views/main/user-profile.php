<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profile - Car Park Dashboard</title>
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

        .modal-overlay {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            animation: slideUp 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        .toast {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            animation: slideDown 0.3s ease-out;
            display: none;
        }

        .toast.active {
            display: block;
        }

        @keyframes slideDown {
            from {
                transform: translate(-50%, -100%);
                opacity: 0;
            }

            to {
                transform: translate(-50%, 0);
                opacity: 1;
            }
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .color-option {
            cursor: pointer;
            transition: all 0.2s;
        }

        .color-option.selected {
            ring: 3px;
            ring-color: #2563EB;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div
        class="w-full max-w-[1080px] mx-auto bg-white min-h-screen relative pb-24">
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



            <!-- <div class="flex items-center justify-between px-5 py-4 h-16">
                <div class="flex items-center gap-3">
                    <button
                        id="back-button"
                        class="w-10 h-10 flex items-center justify-center cursor-pointer">
                        <i class="ri-arrow-left-line text-2xl text-gray-700"></i>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-900">Edit Profile</h1>
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
            </div> -->
        </header>


        <main class="pt-20 px-5">


            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">

                <div class="flex items-start justify-between mb-1">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <img
                                src="http://localhost/osgparkingsystem/public/img/photo/2003-03002.jpg"
                                class="w-20 h-20 rounded-full object-cover ring-4 ring-primary ring-opacity-20" />
                            <div
                                class="absolute bottom-0 right-0 w-6 h-6 bg-secondary rounded-full border-3 border-white flex items-center justify-center">
                                <i class="ri-check-line text-white text-xs"></i>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">
                                Jayvie Neil Malick S. Malicdem
                            </h2>
                            <p class="text-sm text-gray-600">Case Management Service</p>
                            <div
                                class="bg-gray-100 px-3 py-1 rounded-full mt-2 inline-block">
                                <p class="text-xs font-mono text-gray-700">2003-03002</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-1 mb-6">
                <div class="flex gap-2">
                    <button
                        id="tab-personal"
                        class="tab-button flex-1 px-1 py-1 text-md font-medium rounded-full transition-all bg-primary text-white">
                        Personal Details
                    </button>
                    <button
                        id="tab-vehicles"
                        class="tab-button flex-1 px-1 py-1 text-md font-medium rounded-full transition-all text-gray-600">
                        Vehicles
                    </button>
                </div>
            </div>

            <script id="tab-switching">
                document.addEventListener("DOMContentLoaded", function() {
                    const tabPersonal = document.getElementById("tab-personal");
                    const tabVehicles = document.getElementById("tab-vehicles");
                    const personalContent = document.getElementById("personal-content");
                    const vehiclesContent = document.getElementById("vehicles-content");

                    tabPersonal.addEventListener("click", function() {
                        tabPersonal.classList.add("bg-primary", "text-white");
                        tabPersonal.classList.remove("text-gray-600");
                        tabVehicles.classList.remove("bg-primary", "text-white");
                        tabVehicles.classList.add("text-gray-600");
                        personalContent.classList.remove("hidden");
                        vehiclesContent.classList.add("hidden");
                    });

                    tabVehicles.addEventListener("click", function() {
                        tabVehicles.classList.add("bg-primary", "text-white");
                        tabVehicles.classList.remove("text-gray-600");
                        tabPersonal.classList.remove("bg-primary", "text-white");
                        tabPersonal.classList.add("text-gray-600");
                        vehiclesContent.classList.remove("hidden");
                        personalContent.classList.add("hidden");
                    });
                });
            </script>
            <div id="personal-content" class="tab-content">
                <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                    <h3 class="text-base font-semibold text-gray-900 mb-4">
                        Personal Details
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input
                                type="email"
                                id="email-input"
                                value="jayviemalicdem@osg.gov.ph"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input
                                type="tel"
                                id="phone-input"
                                value="+63 917 234 5678"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                            <input
                                type="text"
                                id="department-input"
                                value="Engineering Division"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" />
                        </div>
                        <!-- <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Employee ID</label>
                            <input
                                type="text"
                                value="2008-11092"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm bg-gray-50 text-gray-600 font-mono"
                                readonly />
                        </div> -->
                    </div>
                </div>
            </div>
            <div id="vehicles-content" class="tab-content hidden">
                <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-base font-semibold text-gray-900">
                                Registered Vehicles
                            </h3>
                            <p class="text-xs text-gray-600 mt-1">
                                You can register up to 3 vehicles
                            </p>
                        </div>
                        <div class="bg-gray-100 px-3 py-1 rounded-full">
                            <span
                                class="text-sm font-semibold text-gray-900"
                                id="vehicle-count">2/3</span>
                        </div>
                    </div>
                    <div id="vehicles-container" class="space-y-3 mb-4">
                        <div
                            class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 flex items-center justify-center bg-white rounded-full">
                                        <i class="ri-car-fill text-2xl text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">
                                            Toyota Camry 2020
                                        </p>
                                        <p class="text-xs text-gray-600">Toyota (Black)</p>
                                    </div>
                                </div>
                                <!-- <div class="flex gap-2">
                                    <button
                                        class="edit-vehicle-btn w-8 h-8 flex items-center justify-center bg-white rounded-lg cursor-pointer"
                                        data-vehicle-id="1">
                                        <i class="ri-pencil-line text-base text-primary"></i>
                                    </button>
                                    <button
                                        class="delete-vehicle-btn w-8 h-8 flex items-center justify-center bg-white rounded-lg cursor-pointer"
                                        data-vehicle-id="1">
                                        <i class="ri-delete-bin-line text-base text-red-600"></i>
                                    </button>
                                </div> -->
                            </div>
                            <div class="flex items-center gap-4">
                                <!-- <div class="flex items-center gap-2">
                                    <div
                                        class="w-4 h-4 rounded-full bg-gray-800 border-2 border-white"></div>
                                    <span class="text-xs text-gray-700">Black</span>
                                </div> -->
                                <div class="flex items-center gap-2">
                                    <i class="ri-bank-card-line text-sm text-gray-600"></i>
                                    <span class="text-xs text-gray-700">ABC-1234</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 flex items-center justify-center bg-white rounded-full">
                                        <i class="ri-car-fill text-2xl text-secondary"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">
                                            Tesla Model Y 2026
                                        </p>
                                        <p class="text-xs text-gray-600">Tesla (White)</p>
                                    </div>
                                </div>
                                <!-- <div class="flex gap-2">
                                    <button
                                        class="edit-vehicle-btn w-8 h-8 flex items-center justify-center bg-white rounded-lg cursor-pointer"
                                        data-vehicle-id="2">
                                        <i class="ri-pencil-line text-base text-secondary"></i>
                                    </button>
                                    <button
                                        class="delete-vehicle-btn w-8 h-8 flex items-center justify-center bg-white rounded-lg cursor-pointer"
                                        data-vehicle-id="2">
                                        <i class="ri-delete-bin-line text-base text-red-600"></i>
                                    </button>
                                </div> -->
                            </div>
                            <div class="flex items-center gap-4">
                                <!-- <div class="flex items-center gap-2">
                                    <div
                                        class="w-4 h-4 rounded-full bg-white border-2 border-gray-300"></div>
                                    <span class="text-xs text-gray-700">White</span>
                                </div> -->
                                <div class="flex items-center gap-2">
                                    <i class="ri-bank-card-line text-sm text-gray-600"></i>
                                    <span class="text-xs text-gray-700">XYZ-5678</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <button
                        id="add-vehicle-btn"
                        class="w-full border-2 border-dashed border-gray-300 rounded-xl p-4 flex items-center justify-center gap-2 cursor-pointer hover:border-primary hover:bg-blue-50 transition-all">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-primary bg-opacity-10 rounded-full">
                            <i class="ri-add-line text-xl text-primary"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Add New Vehicle</span>
                    </button> -->
                </div>
            </div>


            <div class="flex items-center gap-3">
                <button
                    id="edit-button"
                    class="flex-1 px-6 py-3 bg-primary text-white font-medium rounded-button cursor-pointer hover:bg-blue-700 transition-colors !rounded-button">
                    <!-- <i class="ri-arrow-left-line text-2xl text-gray-700"></i> -->
                    <h1 class="text-xl font-semibold text-white">Update Profile</h1>
                </button>
            </div>

        </main>
        <!-- <div
            class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-5 max-w-[375px] mx-auto z-40">
            <div class="flex gap-3">
                <button
                    id="cancel-btn"
                    class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-button cursor-pointer hover:bg-gray-50 transition-colors !rounded-button">
                    Cancel
                </button>
                <button
                    id="save-btn"
                    class="flex-1 px-6 py-3 bg-primary text-white font-medium rounded-button cursor-pointer hover:bg-blue-700 transition-colors !rounded-button">
                    Save Changes
                </button>
            </div>
        </div> -->
    </div>
    <div
        id="vehicle-modal"
        class="modal-overlay fixed inset-0 bg-black bg-opacity-50 z-50 items-end justify-center">
        <div
            class="modal-content bg-white rounded-t-3xl w-full max-w-[375px] p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900" id="modal-title">
                    Add New Vehicle
                </h3>
                <button
                    id="close-modal-btn"
                    class="w-8 h-8 flex items-center justify-center cursor-pointer">
                    <i class="ri-close-line text-2xl text-gray-700"></i>
                </button>
            </div>
            <form id="vehicle-form" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Car Make/Brand <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        id="car-brand"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="e.g. Toyota, Honda, Ford, Tesla" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Car Model <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        id="car-model"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="e.g. Camry 2020, Civic 2019, Model Y 2026" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Color <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-4 gap-3">
                        <div
                            class="color-option flex flex-col items-center gap-2 p-3 border-2 border-gray-200 rounded-lg cursor-pointer"
                            data-color="Black">
                            <div
                                class="w-8 h-8 rounded-full bg-gray-900 border-2 border-white shadow-sm"></div>
                            <span class="text-xs text-gray-700">Black</span>
                        </div>
                        <div
                            class="color-option flex flex-col items-center gap-2 p-3 border-2 border-gray-200 rounded-lg cursor-pointer"
                            data-color="White">
                            <div
                                class="w-8 h-8 rounded-full bg-white border-2 border-gray-300 shadow-sm"></div>
                            <span class="text-xs text-gray-700">White</span>
                        </div>
                        <div
                            class="color-option flex flex-col items-center gap-2 p-3 border-2 border-gray-200 rounded-lg cursor-pointer"
                            data-color="Silver">
                            <div
                                class="w-8 h-8 rounded-full bg-gray-400 border-2 border-white shadow-sm"></div>
                            <span class="text-xs text-gray-700">Silver</span>
                        </div>
                        <div
                            class="color-option flex flex-col items-center gap-2 p-3 border-2 border-gray-200 rounded-lg cursor-pointer"
                            data-color="Gray">
                            <div
                                class="w-8 h-8 rounded-full bg-gray-600 border-2 border-white shadow-sm"></div>
                            <span class="text-xs text-gray-700">Gray</span>
                        </div>
                        <div
                            class="color-option flex flex-col items-center gap-2 p-3 border-2 border-gray-200 rounded-lg cursor-pointer"
                            data-color="Red">
                            <div
                                class="w-8 h-8 rounded-full bg-red-600 border-2 border-white shadow-sm"></div>
                            <span class="text-xs text-gray-700">Red</span>
                        </div>
                        <div
                            class="color-option flex flex-col items-center gap-2 p-3 border-2 border-gray-200 rounded-lg cursor-pointer"
                            data-color="Blue">
                            <div
                                class="w-8 h-8 rounded-full bg-blue-600 border-2 border-white shadow-sm"></div>
                            <span class="text-xs text-gray-700">Blue</span>
                        </div>
                        <div
                            class="color-option flex flex-col items-center gap-2 p-3 border-2 border-gray-200 rounded-lg cursor-pointer"
                            data-color="Green">
                            <div
                                class="w-8 h-8 rounded-full bg-green-600 border-2 border-white shadow-sm"></div>
                            <span class="text-xs text-gray-700">Green</span>
                        </div>
                        <div
                            class="color-option flex flex-col items-center gap-2 p-3 border-2 border-gray-200 rounded-lg cursor-pointer"
                            data-color="Yellow">
                            <div
                                class="w-8 h-8 rounded-full bg-yellow-400 border-2 border-white shadow-sm"></div>
                            <span class="text-xs text-gray-700">Yellow</span>
                        </div>
                    </div>
                    <input type="hidden" id="car-color" required />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Plate Number/Conduction Sticker
                        <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        id="car-plate"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent uppercase"
                        placeholder="e.g. ABC-1234" />
                </div>
                <div class="flex gap-3 pt-4">
                    <button
                        type="button"
                        id="modal-cancel-btn"
                        class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-button cursor-pointer !rounded-button">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="flex-1 px-6 py-3 bg-primary text-white font-medium rounded-button cursor-pointer !rounded-button">
                        Save Vehicle
                    </button>
                </div>
            </form>
        </div>
    </div>



    <div
        id="delete-modal"
        class="modal-overlay fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
        <div class="bg-white rounded-2xl w-11/12 max-w-[320px] p-6">
            <div
                class="w-16 h-16 flex items-center justify-center bg-red-50 rounded-full mx-auto mb-4">
                <i class="ri-delete-bin-line text-3xl text-red-600"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">
                Delete Vehicle
            </h3>
            <p class="text-sm text-gray-600 text-center mb-6">
                Are you sure you want to delete this vehicle? This action cannot be
                undone.
            </p>
            <div class="flex gap-3">
                <button
                    id="delete-cancel-btn"
                    class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-button cursor-pointer !rounded-button">
                    Cancel
                </button>
                <button
                    id="delete-confirm-btn"
                    class="flex-1 px-6 py-3 bg-red-600 text-white font-medium rounded-button cursor-pointer !rounded-button">
                    Delete
                </button>
            </div>
        </div>
    </div>
    <div id="toast" class="toast">
        <div
            class="bg-white rounded-xl shadow-lg px-6 py-4 flex items-center gap-3 max-w-[335px]">
            <div
                class="w-10 h-10 flex items-center justify-center bg-green-50 rounded-full">
                <i class="ri-check-line text-xl text-secondary"></i>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-900">Changes Saved</p>
                <p class="text-xs text-gray-600">
                    Your profile has been updated successfully
                </p>
            </div>
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
    <script id="back-navigation">
        document.addEventListener("DOMContentLoaded", function() {
            const backButton = document.getElementById("back-button");
            backButton.addEventListener("click", function() {
                window.history.back();
            });
        });
    </script>
    <script id="vehicle-modal-control">
        document.addEventListener("DOMContentLoaded", function() {
            const addVehicleBtn = document.getElementById("add-vehicle-btn");
            const vehicleModal = document.getElementById("vehicle-modal");
            const closeModalBtn = document.getElementById("close-modal-btn");
            const modalCancelBtn = document.getElementById("modal-cancel-btn");
            const vehicleForm = document.getElementById("vehicle-form");
            const modalTitle = document.getElementById("modal-title");
            let editMode = false;
            let editVehicleId = null;
            let vehicleCount = 2;

            function updateVehicleCount() {
                document.getElementById("vehicle-count").textContent = vehicleCount + "/3";
                if (vehicleCount >= 3) {
                    addVehicleBtn.style.display = "none";
                } else {
                    addVehicleBtn.style.display = "flex";
                }
            }
            addVehicleBtn.addEventListener("click", function() {
                editMode = false;
                modalTitle.textContent = "Add New Vehicle";
                vehicleForm.reset();
                document.getElementById("car-color").value = "";
                document.querySelectorAll(".color-option").forEach((opt) => {
                    opt.classList.remove("selected", "border-primary");
                    opt.classList.add("border-gray-200");
                });
                vehicleModal.classList.add("active");
            });
            closeModalBtn.addEventListener("click", function() {
                vehicleModal.classList.remove("active");
            });
            modalCancelBtn.addEventListener("click", function() {
                vehicleModal.classList.remove("active");
            });
            vehicleModal.addEventListener("click", function(e) {
                if (e.target === vehicleModal) {
                    vehicleModal.classList.remove("active");
                }
            });
            const colorOptions = document.querySelectorAll(".color-option");
            colorOptions.forEach((option) => {
                option.addEventListener("click", function() {
                    colorOptions.forEach((opt) => {
                        opt.classList.remove("selected", "border-primary");
                        opt.classList.add("border-gray-200");
                    });
                    this.classList.add("selected", "border-primary");
                    this.classList.remove("border-gray-200");
                    document.getElementById("car-color").value =
                        this.getAttribute("data-color");
                });
            });
            vehicleForm.addEventListener("submit", function(e) {
                e.preventDefault();
                const brand = document.getElementById("car-brand").value;
                const model = document.getElementById("car-model").value;
                const color = document.getElementById("car-color").value;
                const plate = document.getElementById("car-plate").value.toUpperCase();
                if (!color) {
                    return;
                }
                if (editMode) {
                    showToast(
                        "Vehicle Updated",
                        "Vehicle information has been updated successfully",
                    );
                } else {
                    vehicleCount++;
                    updateVehicleCount();
                    showToast("Vehicle Added", "New vehicle has been added successfully");
                }
                vehicleModal.classList.remove("active");
                vehicleForm.reset();
            });
            const editButtons = document.querySelectorAll(".edit-vehicle-btn");
            editButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    editMode = true;
                    editVehicleId = this.getAttribute("data-vehicle-id");
                    modalTitle.textContent = "Edit Vehicle";
                    if (editVehicleId === "1") {
                        document.getElementById("car-brand").value = "Toyota";
                        document.getElementById("car-model").value = "Camry 2020";
                        document.getElementById("car-plate").value = "ABC-1234";
                        document.getElementById("car-color").value = "Black";
                        colorOptions.forEach((opt) => {
                            if (opt.getAttribute("data-color") === "Black") {
                                opt.classList.add("selected", "border-primary");
                                opt.classList.remove("border-gray-200");
                            }
                        });
                    } else if (editVehicleId === "2") {
                        document.getElementById("car-brand").value = "Tesla";
                        document.getElementById("car-model").value = "Model Y 2026";
                        document.getElementById("car-plate").value = "XYZ-5678";
                        document.getElementById("car-color").value = "White";
                        colorOptions.forEach((opt) => {
                            if (opt.getAttribute("data-color") === "White") {
                                opt.classList.add("selected", "border-primary");
                                opt.classList.remove("border-gray-200");
                            }
                        });
                    }
                    vehicleModal.classList.add("active");
                });
            });
        });
    </script>
    <script id="delete-vehicle-control">
        document.addEventListener("DOMContentLoaded", function() {
            const deleteModal = document.getElementById("delete-modal");
            const deleteCancelBtn = document.getElementById("delete-cancel-btn");
            const deleteConfirmBtn = document.getElementById("delete-confirm-btn");
            let deleteVehicleId = null;
            let vehicleCount = 2;

            function updateVehicleCount() {
                document.getElementById("vehicle-count").textContent = vehicleCount + "/3";
                const addVehicleBtn = document.getElementById("add-vehicle-btn");
                if (vehicleCount >= 3) {
                    addVehicleBtn.style.display = "none";
                } else {
                    addVehicleBtn.style.display = "flex";
                }
            }
            const deleteButtons = document.querySelectorAll(".delete-vehicle-btn");
            deleteButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    deleteVehicleId = this.getAttribute("data-vehicle-id");
                    deleteModal.classList.add("active");
                });
            });
            deleteCancelBtn.addEventListener("click", function() {
                deleteModal.classList.remove("active");
            });
            deleteModal.addEventListener("click", function(e) {
                if (e.target === deleteModal) {
                    deleteModal.classList.remove("active");
                }
            });
            deleteConfirmBtn.addEventListener("click", function() {
                vehicleCount--;
                updateVehicleCount();
                deleteModal.classList.remove("active");
                showToast("Vehicle Deleted", "Vehicle has been removed from your profile");
            });
        });
    </script>
    <script id="save-profile">
        document.addEventListener("DOMContentLoaded", function() {
            const saveBtn = document.getElementById("save-btn");
            const cancelBtn = document.getElementById("cancel-btn");
            saveBtn.addEventListener("click", function() {
                showToast("Changes Saved", "Your profile has been updated successfully");
                setTimeout(function() {
                    window.history.back();
                }, 1500);
            });
            cancelBtn.addEventListener("click", function() {
                window.history.back();
            });
        });
    </script>
    <script id="toast-notification">
        function showToast(title, message) {
            const toast = document.getElementById("toast");
            const toastTitle = toast.querySelector(".text-sm.font-semibold");
            const toastMessage = toast.querySelector(".text-xs");
            toastTitle.textContent = title;
            toastMessage.textContent = message;
            toast.classList.add("active");
            setTimeout(function() {
                toast.classList.remove("active");
            }, 3000);
        }
    </script>
</body>

</html>