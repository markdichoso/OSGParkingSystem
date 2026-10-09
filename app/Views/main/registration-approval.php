<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Approvals - OSG</title>
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

        .toast {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        .modal-overlay {
            animation: fadeIn 0.2s ease-out;
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
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <div
        class="w-full max-w-[375px] mx-auto bg-white min-h-screen relative pb-24">
        <header class="fixed top-0 w-full max-w-[375px] bg-white z-50 shadow-sm">
            <div class="flex items-center justify-between px-5 py-4 h-16">
                <div class="font-['Pacifico'] text-2xl text-primary">logo</div>
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

        <main class="pt-20 px-5">
            <div class="mb-6">
                <div
                    class="w-20 h-20 flex items-center justify-center bg-gradient-to-br from-primary to-blue-600 rounded-2xl mx-auto mb-4 shadow-lg">
                    <i class="ri-user-follow-line text-4xl text-white"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 text-center mb-2">
                    Registration Approvals
                </h1>
                <p class="text-sm text-gray-600 text-center">
                    Review and process employee registration requests
                </p>
            </div>

            <div class="mb-4">
                <div class="relative">
                    <div
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 flex items-center justify-center">
                        <i class="ri-search-line text-lg text-gray-500"></i>
                    </div>
                    <input
                        type="text"
                        id="search-input"
                        class="w-full h-12 pl-12 pr-12 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        placeholder="Search by name, email, or employee number" />
                    <button
                        id="filter-button"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 w-8 h-8 flex items-center justify-center bg-primary rounded-lg cursor-pointer hover:bg-blue-700 transition-colors">
                        <i class="ri-filter-3-line text-lg text-white"></i>
                    </button>
                </div>
            </div>

            <div id="active-filters" class="mb-4 flex flex-wrap gap-2 hidden"></div>

            <div
                id="bulk-actions-bar"
                class="fixed top-16 left-0 w-full max-w-[375px] bg-blue-50 border-b-2 border-primary shadow-md z-40 px-5 py-3 hidden">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span
                            id="selected-count"
                            class="text-sm font-semibold text-gray-900">0 selected</span>
                        <button
                            id="clear-selection"
                            class="text-xs text-gray-600 hover:text-gray-900 cursor-pointer">
                            Clear
                        </button>
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            id="bulk-approve"
                            class="px-4 py-2 bg-secondary text-white text-xs font-semibold !rounded-button cursor-pointer hover:bg-green-600 transition-colors flex items-center gap-1">
                            <i class="ri-checkbox-circle-line text-sm"></i>
                            <span>Approve</span>
                        </button>
                        <button
                            id="bulk-deny"
                            class="px-4 py-2 bg-red-600 text-white text-xs font-semibold !rounded-button cursor-pointer hover:bg-red-700 transition-colors flex items-center gap-1">
                            <i class="ri-close-circle-line text-sm"></i>
                            <span>Deny</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mb-4">
                <p id="results-count" class="text-sm text-gray-600">
                    24 requests found
                </p>
                <div class="relative">
                    <button
                        id="sort-button"
                        class="flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs font-medium text-gray-700 cursor-pointer hover:bg-gray-50 transition-colors">
                        <i class="ri-sort-desc text-sm"></i>
                        <span id="sort-label">Newest first</span>
                        <i class="ri-arrow-down-s-line text-sm"></i>
                    </button>
                    <div
                        id="sort-dropdown"
                        class="absolute right-0 top-12 bg-white rounded-lg shadow-lg w-40 hidden overflow-hidden z-30">
                        <button
                            data-sort="newest"
                            class="w-full px-4 py-2.5 text-left text-xs text-gray-700 hover:bg-gray-50 cursor-pointer">
                            Newest first
                        </button>
                        <button
                            data-sort="oldest"
                            class="w-full px-4 py-2.5 text-left text-xs text-gray-700 hover:bg-gray-50 cursor-pointer">
                            Oldest first
                        </button>
                        <button
                            data-sort="name-asc"
                            class="w-full px-4 py-2.5 text-left text-xs text-gray-700 hover:bg-gray-50 cursor-pointer">
                            Name (A-Z)
                        </button>
                        <button
                            data-sort="name-desc"
                            class="w-full px-4 py-2.5 text-left text-xs text-gray-700 hover:bg-gray-50 cursor-pointer">
                            Name (Z-A)
                        </button>
                    </div>
                </div>
            </div>

            <div id="loading-state" class="space-y-4 hidden">
                <div class="bg-white rounded-xl border border-gray-200 p-4">
                    <div class="flex items-start gap-3">
                        <div class="w-5 h-5 skeleton rounded"></div>
                        <div class="w-12 h-12 skeleton rounded-full"></div>
                        <div class="flex-1">
                            <div class="h-4 skeleton rounded w-3/4 mb-2"></div>
                            <div class="h-3 skeleton rounded w-1/2 mb-3"></div>
                            <div class="h-3 skeleton rounded w-full mb-2"></div>
                            <div class="h-3 skeleton rounded w-full mb-2"></div>
                            <div class="h-3 skeleton rounded w-2/3"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4">
                    <div class="flex items-start gap-3">
                        <div class="w-5 h-5 skeleton rounded"></div>
                        <div class="w-12 h-12 skeleton rounded-full"></div>
                        <div class="flex-1">
                            <div class="h-4 skeleton rounded w-3/4 mb-2"></div>
                            <div class="h-3 skeleton rounded w-1/2 mb-3"></div>
                            <div class="h-3 skeleton rounded w-full mb-2"></div>
                            <div class="h-3 skeleton rounded w-full mb-2"></div>
                            <div class="h-3 skeleton rounded w-2/3"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4">
                    <div class="flex items-start gap-3">
                        <div class="w-5 h-5 skeleton rounded"></div>
                        <div class="w-12 h-12 skeleton rounded-full"></div>
                        <div class="flex-1">
                            <div class="h-4 skeleton rounded w-3/4 mb-2"></div>
                            <div class="h-3 skeleton rounded w-1/2 mb-3"></div>
                            <div class="h-3 skeleton rounded w-full mb-2"></div>
                            <div class="h-3 skeleton rounded w-full mb-2"></div>
                            <div class="h-3 skeleton rounded w-2/3"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="requests-list" class="space-y-4"></div>

            <div
                id="empty-state"
                class="flex flex-col items-center justify-center py-16 hidden">
                <div
                    class="w-24 h-24 flex items-center justify-center bg-gray-100 rounded-full mb-4">
                    <i class="ri-inbox-line text-5xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    No requests found
                </h3>
                <p class="text-sm text-gray-600 text-center mb-6">
                    Try adjusting your filters or search criteria
                </p>
                <button
                    id="reset-filters-btn"
                    class="px-6 py-2.5 bg-primary text-white text-sm font-semibold !rounded-button cursor-pointer hover:bg-blue-700 transition-colors">
                    Reset Filters
                </button>
            </div>
        </main>
    </div>

    <div
        id="filter-modal"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden modal-overlay">
        <div
            class="absolute bottom-0 left-0 right-0 bg-white rounded-t-3xl max-w-[375px] mx-auto modal-content">
            <div class="px-5 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Filters</h3>
                    <button
                        id="close-filter-modal"
                        class="w-8 h-8 flex items-center justify-center cursor-pointer">
                        <i class="ri-close-line text-2xl text-gray-600"></i>
                    </button>
                </div>
            </div>
            <div class="px-5 py-6 max-h-[500px] overflow-y-auto">
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Status</label>
                    <div class="flex flex-wrap gap-2">
                        <button
                            data-status="all"
                            class="status-filter px-4 py-2 bg-primary text-white text-sm font-medium !rounded-button cursor-pointer">
                            All
                        </button>
                        <button
                            data-status="pending"
                            class="status-filter px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium !rounded-button cursor-pointer">
                            Pending
                        </button>
                        <button
                            data-status="approved"
                            class="status-filter px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium !rounded-button cursor-pointer">
                            Approved
                        </button>
                        <button
                            data-status="denied"
                            class="status-filter px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium !rounded-button cursor-pointer">
                            Denied
                        </button>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Date Range</label>
                    <div class="flex flex-wrap gap-2">
                        <button
                            data-date="all"
                            class="date-filter px-4 py-2 bg-primary text-white text-sm font-medium !rounded-button cursor-pointer">
                            All Time
                        </button>
                        <button
                            data-date="today"
                            class="date-filter px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium !rounded-button cursor-pointer">
                            Today
                        </button>
                        <button
                            data-date="7days"
                            class="date-filter px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium !rounded-button cursor-pointer">
                            Last 7 days
                        </button>
                        <button
                            data-date="30days"
                            class="date-filter px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium !rounded-button cursor-pointer">
                            Last 30 days
                        </button>
                    </div>
                </div>
            </div>
            <div class="px-5 py-4 border-t border-gray-200 flex gap-3">
                <button
                    id="reset-filters"
                    class="flex-1 h-12 bg-white border-2 border-gray-200 text-gray-700 font-semibold text-sm !rounded-button cursor-pointer hover:bg-gray-50 transition-colors">
                    Reset
                </button>
                <button
                    id="apply-filters"
                    class="flex-1 h-12 bg-primary text-white font-semibold text-sm !rounded-button cursor-pointer hover:bg-blue-700 transition-colors">
                    Apply Filters
                </button>
            </div>
        </div>
    </div>

    <div
        id="detail-modal"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden modal-overlay">
        <div
            class="absolute bottom-0 left-0 right-0 bg-white rounded-t-3xl max-w-[375px] mx-auto modal-content">
            <div class="px-5 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Request Details</h3>
                    <button
                        id="close-detail-modal"
                        class="w-8 h-8 flex items-center justify-center cursor-pointer">
                        <i class="ri-close-line text-2xl text-gray-600"></i>
                    </button>
                </div>
            </div>
            <div class="px-5 py-6 max-h-[500px] overflow-y-auto">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        id="detail-avatar"
                        class="w-16 h-16 flex items-center justify-center bg-gradient-to-br from-primary to-blue-600 rounded-full text-white text-2xl font-bold"></div>
                    <div class="flex-1">
                        <h4
                            id="detail-name"
                            class="text-lg font-bold text-gray-900 mb-1"></h4>
                        <span
                            id="detail-status-badge"
                            class="inline-block px-3 py-1 text-xs font-semibold rounded-full"></span>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-lg flex-shrink-0">
                            <i class="ri-mail-line text-lg text-gray-700"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-600 mb-1">OSG Email</p>
                            <p
                                id="detail-email"
                                class="text-sm font-medium text-gray-900"></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-lg flex-shrink-0">
                            <i class="ri-hashtag text-lg text-gray-700"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-600 mb-1">Employee Number</p>
                            <p
                                id="detail-empnum"
                                class="text-sm font-medium text-gray-900"></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-lg flex-shrink-0">
                            <i class="ri-user-line text-lg text-gray-700"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-600 mb-1">Username</p>
                            <p
                                id="detail-username"
                                class="text-sm font-medium text-gray-900"></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-lg flex-shrink-0">
                            <i class="ri-time-line text-lg text-gray-700"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-600 mb-1">Submitted</p>
                            <p
                                id="detail-date"
                                class="text-sm font-medium text-gray-900"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-5 py-4 border-t border-gray-200 flex gap-3">
                <button
                    id="detail-deny-btn"
                    class="flex-1 h-12 bg-red-600 text-white font-semibold text-sm !rounded-button cursor-pointer hover:bg-red-700 transition-colors flex items-center justify-center gap-2">
                    <i class="ri-close-circle-line text-lg"></i>
                    <span>Deny</span>
                </button>
                <button
                    id="detail-approve-btn"
                    class="flex-1 h-12 bg-secondary text-white font-semibold text-sm !rounded-button cursor-pointer hover:bg-green-600 transition-colors flex items-center justify-center gap-2">
                    <i class="ri-checkbox-circle-line text-lg"></i>
                    <span>Approve</span>
                </button>
            </div>
        </div>
    </div>

    <div
        id="confirm-modal"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden modal-overlay">
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-2xl w-[335px] modal-content">
            <div class="px-6 py-5">
                <div
                    class="w-16 h-16 flex items-center justify-center bg-blue-50 rounded-full mx-auto mb-4">
                    <i id="confirm-icon" class="text-3xl"></i>
                </div>
                <h3
                    id="confirm-title"
                    class="text-lg font-bold text-gray-900 text-center mb-2"></h3>
                <p
                    id="confirm-message"
                    class="text-sm text-gray-600 text-center mb-4"></p>
                <div id="deny-reason-container" class="mb-4 hidden">
                    <label class="block text-xs font-semibold text-gray-900 mb-2">Reason for denial (optional)</label>
                    <textarea
                        id="deny-reason"
                        class="w-full h-24 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent resize-none"
                        placeholder="Enter reason..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button
                        id="confirm-cancel"
                        class="flex-1 h-11 bg-white border-2 border-gray-200 text-gray-700 font-semibold text-sm !rounded-button cursor-pointer hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button
                        id="confirm-action"
                        class="flex-1 h-11 font-semibold text-sm !rounded-button cursor-pointer transition-colors">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script id="data-management">
        const registrationRequests = [{
                id: 1,
                name: "Michael Anderson",
                email: "michael.anderson@osg.gov.ph",
                empNum: "2024-10234",
                username: "michaelanderson",
                status: "pending",
                date: "2026-10-08T09:30:00",
                avatar: "M",
            },
            {
                id: 2,
                name: "Sarah Martinez",
                email: "sarah.martinez@osg.gov.ph",
                empNum: "2024-10156",
                username: "sarahmartinez",
                status: "pending",
                date: "2026-10-08T08:15:00",
                avatar: "S",
            },
            {
                id: 3,
                name: "David Thompson",
                email: "david.thompson@osg.gov.ph",
                empNum: "2024-10098",
                username: "davidthompson",
                status: "pending",
                date: "2026-10-07T16:45:00",
                avatar: "D",
            },
            {
                id: 4,
                name: "Emily Rodriguez",
                email: "emily.rodriguez@osg.gov.ph",
                empNum: "2024-10187",
                username: "emilyrodriguez",
                status: "pending",
                date: "2026-10-07T14:20:00",
                avatar: "E",
            },
            {
                id: 5,
                name: "James Wilson",
                email: "james.wilson@osg.gov.ph",
                empNum: "2024-10145",
                username: "jameswilson",
                status: "approved",
                date: "2026-10-06T11:30:00",
                avatar: "J",
            },
            {
                id: 6,
                name: "Jennifer Garcia",
                email: "jennifer.garcia@osg.gov.ph",
                empNum: "2024-10203",
                username: "jennifergarcia",
                status: "pending",
                date: "2026-10-06T10:15:00",
                avatar: "J",
            },
            {
                id: 7,
                name: "Robert Brown",
                email: "robert.brown@osg.gov.ph",
                empNum: "2024-10167",
                username: "robertbrown",
                status: "pending",
                date: "2026-10-05T15:40:00",
                avatar: "R",
            },
            {
                id: 8,
                name: "Lisa Johnson",
                email: "lisa.johnson@osg.gov.ph",
                empNum: "2024-10189",
                username: "lisajohnson",
                status: "approved",
                date: "2026-10-05T13:25:00",
                avatar: "L",
            },
            {
                id: 9,
                name: "Christopher Lee",
                email: "christopher.lee@osg.gov.ph",
                empNum: "2024-10134",
                username: "christopherlee",
                status: "pending",
                date: "2026-10-04T16:10:00",
                avatar: "C",
            },
            {
                id: 10,
                name: "Amanda White",
                email: "amanda.white@osg.gov.ph",
                empNum: "2024-10212",
                username: "amandawhite",
                status: "pending",
                date: "2026-10-04T09:50:00",
                avatar: "A",
            },
            {
                id: 11,
                name: "Daniel Harris",
                email: "daniel.harris@osg.gov.ph",
                empNum: "2024-10178",
                username: "danielharris",
                status: "denied",
                date: "2026-10-03T14:35:00",
                avatar: "D",
            },
            {
                id: 12,
                name: "Michelle Clark",
                email: "michelle.clark@osg.gov.ph",
                empNum: "2024-10195",
                username: "michelleclark",
                status: "pending",
                date: "2026-10-03T11:20:00",
                avatar: "M",
            },
            {
                id: 13,
                name: "Matthew Lewis",
                email: "matthew.lewis@osg.gov.ph",
                empNum: "2024-10156",
                username: "matthewlewis",
                status: "pending",
                date: "2026-10-02T15:45:00",
                avatar: "M",
            },
            {
                id: 14,
                name: "Jessica Walker",
                email: "jessica.walker@osg.gov.ph",
                empNum: "2024-10221",
                username: "jessicawalker",
                status: "approved",
                date: "2026-10-02T10:30:00",
                avatar: "J",
            },
            {
                id: 15,
                name: "Andrew Hall",
                email: "andrew.hall@osg.gov.ph",
                empNum: "2024-10143",
                username: "andrewhall",
                status: "pending",
                date: "2026-10-01T16:15:00",
                avatar: "A",
            },
            {
                id: 16,
                name: "Nicole Allen",
                email: "nicole.allen@osg.gov.ph",
                empNum: "2024-10198",
                username: "nicoleallen",
                status: "pending",
                date: "2026-10-01T13:40:00",
                avatar: "N",
            },
            {
                id: 17,
                name: "Joshua Young",
                email: "joshua.young@osg.gov.ph",
                empNum: "2024-10167",
                username: "joshuayoung",
                status: "pending",
                date: "2026-09-30T14:20:00",
                avatar: "J",
            },
            {
                id: 18,
                name: "Stephanie King",
                email: "stephanie.king@osg.gov.ph",
                empNum: "2024-10209",
                username: "stephanieking",
                status: "approved",
                date: "2026-09-30T09:55:00",
                avatar: "S",
            },
            {
                id: 19,
                name: "Kevin Wright",
                email: "kevin.wright@osg.gov.ph",
                empNum: "2024-10154",
                username: "kevinwright",
                status: "pending",
                date: "2026-09-29T15:30:00",
                avatar: "K",
            },
            {
                id: 20,
                name: "Rachel Scott",
                email: "rachel.scott@osg.gov.ph",
                empNum: "2024-10187",
                username: "rachelscott",
                status: "pending",
                date: "2026-09-29T11:45:00",
                avatar: "R",
            },
            {
                id: 21,
                name: "Brian Green",
                email: "brian.green@osg.gov.ph",
                empNum: "2024-10176",
                username: "briangreen",
                status: "denied",
                date: "2026-09-28T16:20:00",
                avatar: "B",
            },
            {
                id: 22,
                name: "Lauren Adams",
                email: "lauren.adams@osg.gov.ph",
                empNum: "2024-10214",
                username: "laurenadams",
                status: "pending",
                date: "2026-09-28T10:10:00",
                avatar: "L",
            },
            {
                id: 23,
                name: "Ryan Baker",
                email: "ryan.baker@osg.gov.ph",
                empNum: "2024-10165",
                username: "ryanbaker",
                status: "pending",
                date: "2026-09-27T14:50:00",
                avatar: "R",
            },
            {
                id: 24,
                name: "Megan Nelson",
                email: "megan.nelson@osg.gov.ph",
                empNum: "2024-10192",
                username: "megannelson",
                status: "approved",
                date: "2026-09-27T09:30:00",
                avatar: "M",
            },
        ];

        let selectedRequests = new Set();
        let currentFilters = {
            status: "all",
            dateRange: "all",
            searchQuery: "",
            sortBy: "newest",
        };

        function formatDate(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffTime = Math.abs(now - date);
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
            const diffHours = Math.floor(diffTime / (1000 * 60 * 60));
            const diffMinutes = Math.floor(diffTime / (1000 * 60));

            if (diffMinutes < 60) {
                return `${diffMinutes} minutes ago`;
            } else if (diffHours < 24) {
                return `${diffHours} hours ago`;
            } else if (diffDays === 0) {
                return "Today";
            } else if (diffDays === 1) {
                return "Yesterday";
            } else if (diffDays < 7) {
                return `${diffDays} days ago`;
            } else {
                return date.toLocaleDateString("en-US", {
                    month: "short",
                    day: "numeric",
                    year: "numeric",
                });
            }
        }

        function getStatusBadgeClass(status) {
            switch (status) {
                case "pending":
                    return "bg-orange-100 text-orange-700";
                case "approved":
                    return "bg-green-100 text-green-700";
                case "denied":
                    return "bg-red-100 text-red-700";
                default:
                    return "bg-gray-100 text-gray-700";
            }
        }

        function filterRequests() {
            let filtered = [...registrationRequests];

            if (currentFilters.status !== "all") {
                filtered = filtered.filter((req) => req.status === currentFilters.status);
            }

            if (currentFilters.dateRange !== "all") {
                const now = new Date();
                filtered = filtered.filter((req) => {
                    const reqDate = new Date(req.date);
                    const diffDays = Math.floor((now - reqDate) / (1000 * 60 * 60 * 24));
                    switch (currentFilters.dateRange) {
                        case "today":
                            return diffDays === 0;
                        case "7days":
                            return diffDays <= 7;
                        case "30days":
                            return diffDays <= 30;
                        default:
                            return true;
                    }
                });
            }

            if (currentFilters.searchQuery) {
                const query = currentFilters.searchQuery.toLowerCase();
                filtered = filtered.filter(
                    (req) =>
                    req.name.toLowerCase().includes(query) ||
                    req.email.toLowerCase().includes(query) ||
                    req.empNum.toLowerCase().includes(query) ||
                    req.username.toLowerCase().includes(query),
                );
            }

            switch (currentFilters.sortBy) {
                case "newest":
                    filtered.sort((a, b) => new Date(b.date) - new Date(a.date));
                    break;
                case "oldest":
                    filtered.sort((a, b) => new Date(a.date) - new Date(b.date));
                    break;
                case "name-asc":
                    filtered.sort((a, b) => a.name.localeCompare(b.name));
                    break;
                case "name-desc":
                    filtered.sort((a, b) => b.name.localeCompare(a.name));
                    break;
            }

            return filtered;
        }

        function renderRequests() {
            const requestsList = document.getElementById("requests-list");
            const emptyState = document.getElementById("empty-state");
            const resultsCount = document.getElementById("results-count");
            const filtered = filterRequests();

            resultsCount.textContent = `${filtered.length} request${filtered.length !== 1 ? "s" : ""} found`;

            if (filtered.length === 0) {
                requestsList.innerHTML = "";
                emptyState.classList.remove("hidden");
                return;
            }

            emptyState.classList.add("hidden");
            requestsList.innerHTML = filtered
                .map(
                    (request) => `
      <div class="bg-white rounded-xl border border-gray-200 p-4 hover:shadow-md transition-shadow" data-request-id="${request.id}">
      <div class="flex items-start gap-3 mb-4">
      <input type="checkbox" class="request-checkbox w-5 h-5 mt-1 cursor-pointer accent-primary" data-request-id="${request.id}" ${selectedRequests.has(request.id) ? "checked" : ""}>
      <div class="w-12 h-12 flex items-center justify-center bg-gradient-to-br from-primary to-blue-600 rounded-full text-white text-lg font-bold flex-shrink-0">
      ${request.avatar}
      </div>
      <div class="flex-1 min-w-0">
      <div class="flex items-start justify-between gap-2 mb-1">
      <h4 class="text-base font-bold text-gray-900 truncate">${request.name}</h4>
      <span class="px-2.5 py-1 text-xs font-semibold rounded-full ${getStatusBadgeClass(request.status)} whitespace-nowrap">${request.status.charAt(0).toUpperCase() + request.status.slice(1)}</span>
      </div>
      <div class="space-y-2 mt-3">
      <div class="flex items-center gap-2">
      <div class="w-5 h-5 flex items-center justify-center flex-shrink-0">
      <i class="ri-mail-line text-sm text-gray-600"></i>
      </div>
      <p class="text-xs text-gray-700 truncate">${request.email}</p>
      </div>
      <div class="flex items-center gap-2">
      <div class="w-5 h-5 flex items-center justify-center flex-shrink-0">
      <i class="ri-hashtag text-sm text-gray-600"></i>
      </div>
      <p class="text-xs text-gray-700">${request.empNum}</p>
      </div>
      <div class="flex items-center gap-2">
      <div class="w-5 h-5 flex items-center justify-center flex-shrink-0">
      <i class="ri-user-line text-sm text-gray-600"></i>
      </div>
      <p class="text-xs text-gray-700">${request.username}</p>
      </div>
      <div class="flex items-center gap-2">
      <div class="w-5 h-5 flex items-center justify-center flex-shrink-0">
      <i class="ri-time-line text-sm text-gray-600"></i>
      </div>
      <p class="text-xs text-gray-500">${formatDate(request.date)}</p>
      </div>
      </div>
      </div>
      </div>
      <div class="flex gap-2 mt-4">
      <button class="deny-btn flex-1 h-10 bg-red-600 text-white font-semibold text-sm !rounded-button cursor-pointer hover:bg-red-700 transition-colors flex items-center justify-center gap-1.5" data-request-id="${request.id}">
      <i class="ri-close-circle-line text-base"></i>
      <span>Deny</span>
      </button>
      <button class="approve-btn flex-1 h-10 bg-secondary text-white font-semibold text-sm !rounded-button cursor-pointer hover:bg-green-600 transition-colors flex items-center justify-center gap-1.5" data-request-id="${request.id}">
      <i class="ri-checkbox-circle-line text-base"></i>
      <span>Approve</span>
      </button>
      <button class="view-details-btn h-10 px-4 bg-gray-100 text-gray-700 font-semibold text-sm !rounded-button cursor-pointer hover:bg-gray-200 transition-colors flex items-center justify-center" data-request-id="${request.id}">
      <i class="ri-eye-line text-base"></i>
      </button>
      </div>
      </div>
      `,
                )
                .join("");

            updateBulkActionsBar();
        }

        function updateBulkActionsBar() {
            const bulkActionsBar = document.getElementById("bulk-actions-bar");
            const selectedCount = document.getElementById("selected-count");
            const main = document.querySelector("main");

            if (selectedRequests.size > 0) {
                bulkActionsBar.classList.remove("hidden");
                main.style.paddingTop = "136px";
                selectedCount.textContent = `${selectedRequests.size} selected`;
            } else {
                bulkActionsBar.classList.add("hidden");
                main.style.paddingTop = "80px";
            }
        }

        function updateActiveFilters() {
            const activeFiltersContainer = document.getElementById("active-filters");
            const filters = [];

            if (currentFilters.status !== "all") {
                filters.push({
                    type: "status",
                    label: currentFilters.status.charAt(0).toUpperCase() +
                        currentFilters.status.slice(1),
                });
            }

            if (currentFilters.dateRange !== "all") {
                let label = "";
                switch (currentFilters.dateRange) {
                    case "today":
                        label = "Today";
                        break;
                    case "7days":
                        label = "Last 7 days";
                        break;
                    case "30days":
                        label = "Last 30 days";
                        break;
                }
                filters.push({
                    type: "date",
                    label: label,
                });
            }

            if (filters.length > 0) {
                activeFiltersContainer.classList.remove("hidden");
                activeFiltersContainer.innerHTML = filters
                    .map(
                        (filter) => `
      <div class="flex items-center gap-2 px-3 py-1.5 bg-blue-50 border border-blue-200 rounded-full">
      <span class="text-xs font-medium text-primary">${filter.label}</span>
      <button class="remove-filter w-4 h-4 flex items-center justify-center cursor-pointer" data-filter-type="${filter.type}">
      <i class="ri-close-line text-sm text-primary"></i>
      </button>
      </div>
      `,
                    )
                    .join("");
            } else {
                activeFiltersContainer.classList.add("hidden");
            }
        }

        function showToast(message, type) {
            const toast = document.createElement("div");
            toast.className = `toast w-[335px] px-4 py-3 rounded-lg shadow-lg flex items-center gap-3 ${type === "success" ? "bg-secondary" : "bg-red-600"}`;
            toast.innerHTML = `
      <div class="w-6 h-6 flex items-center justify-center">
      <i class="ri-${type === "success" ? "checkbox-circle" : "error-warning"}-fill text-xl text-white"></i>
      </div>
      <p class="text-sm font-medium text-white flex-1">${message}</p>
      `;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        window.registrationData = {
            requests: registrationRequests,
            selected: selectedRequests,
            filters: currentFilters,
            render: renderRequests,
            updateFilters: updateActiveFilters,
            showToast: showToast,
        };
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

    <script id="search-functionality">
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("search-input");
            let searchTimeout;

            searchInput.addEventListener("input", function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    window.registrationData.filters.searchQuery = this.value.trim();
                    window.registrationData.render();
                }, 300);
            });
        });
    </script>

    <script id="filter-modal-control">
        document.addEventListener("DOMContentLoaded", function() {
            const filterButton = document.getElementById("filter-button");
            const filterModal = document.getElementById("filter-modal");
            const closeFilterModal = document.getElementById("close-filter-modal");
            const applyFilters = document.getElementById("apply-filters");
            const resetFilters = document.getElementById("reset-filters");
            const statusFilters = document.querySelectorAll(".status-filter");
            const dateFilters = document.querySelectorAll(".date-filter");

            let tempFilters = {
                status: "all",
                dateRange: "all",
            };

            filterButton.addEventListener("click", function() {
                tempFilters = {
                    status: window.registrationData.filters.status,
                    dateRange: window.registrationData.filters.dateRange,
                };
                updateFilterButtons();
                filterModal.classList.remove("hidden");
            });

            closeFilterModal.addEventListener("click", function() {
                filterModal.classList.add("hidden");
            });

            filterModal.addEventListener("click", function(e) {
                if (e.target === filterModal) {
                    filterModal.classList.add("hidden");
                }
            });

            statusFilters.forEach((btn) => {
                btn.addEventListener("click", function() {
                    tempFilters.status = this.dataset.status;
                    updateFilterButtons();
                });
            });

            dateFilters.forEach((btn) => {
                btn.addEventListener("click", function() {
                    tempFilters.dateRange = this.dataset.date;
                    updateFilterButtons();
                });
            });

            function updateFilterButtons() {
                statusFilters.forEach((btn) => {
                    if (btn.dataset.status === tempFilters.status) {
                        btn.classList.remove("bg-gray-100", "text-gray-700");
                        btn.classList.add("bg-primary", "text-white");
                    } else {
                        btn.classList.remove("bg-primary", "text-white");
                        btn.classList.add("bg-gray-100", "text-gray-700");
                    }
                });

                dateFilters.forEach((btn) => {
                    if (btn.dataset.date === tempFilters.dateRange) {
                        btn.classList.remove("bg-gray-100", "text-gray-700");
                        btn.classList.add("bg-primary", "text-white");
                    } else {
                        btn.classList.remove("bg-primary", "text-white");
                        btn.classList.add("bg-gray-100", "text-gray-700");
                    }
                });
            }

            applyFilters.addEventListener("click", function() {
                window.registrationData.filters.status = tempFilters.status;
                window.registrationData.filters.dateRange = tempFilters.dateRange;
                window.registrationData.render();
                window.registrationData.updateFilters();
                filterModal.classList.add("hidden");
            });

            resetFilters.addEventListener("click", function() {
                tempFilters = {
                    status: "all",
                    dateRange: "all",
                };
                updateFilterButtons();
            });

            document
                .getElementById("reset-filters-btn")
                .addEventListener("click", function() {
                    window.registrationData.filters.status = "all";
                    window.registrationData.filters.dateRange = "all";
                    window.registrationData.filters.searchQuery = "";
                    document.getElementById("search-input").value = "";
                    window.registrationData.render();
                    window.registrationData.updateFilters();
                });
        });
    </script>

    <script id="active-filters-control">
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener("click", function(e) {
                if (e.target.closest(".remove-filter")) {
                    const filterType = e.target.closest(".remove-filter").dataset.filterType;
                    if (filterType === "status") {
                        window.registrationData.filters.status = "all";
                    } else if (filterType === "date") {
                        window.registrationData.filters.dateRange = "all";
                    }
                    window.registrationData.render();
                    window.registrationData.updateFilters();
                }
            });
        });
    </script>

    <script id="sort-functionality">
        document.addEventListener("DOMContentLoaded", function() {
            const sortButton = document.getElementById("sort-button");
            const sortDropdown = document.getElementById("sort-dropdown");
            const sortLabel = document.getElementById("sort-label");
            const sortOptions = sortDropdown.querySelectorAll("button[data-sort]");

            sortButton.addEventListener("click", function(e) {
                e.stopPropagation();
                sortDropdown.classList.toggle("hidden");
            });

            document.addEventListener("click", function(e) {
                if (!sortDropdown.contains(e.target) && !sortButton.contains(e.target)) {
                    sortDropdown.classList.add("hidden");
                }
            });

            sortOptions.forEach((option) => {
                option.addEventListener("click", function() {
                    const sortValue = this.dataset.sort;
                    window.registrationData.filters.sortBy = sortValue;
                    sortLabel.textContent = this.textContent;
                    sortDropdown.classList.add("hidden");
                    window.registrationData.render();
                });
            });
        });
    </script>

    <script id="checkbox-selection">
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener("change", function(e) {
                if (e.target.classList.contains("request-checkbox")) {
                    const requestId = parseInt(e.target.dataset.requestId);
                    if (e.target.checked) {
                        window.registrationData.selected.add(requestId);
                    } else {
                        window.registrationData.selected.delete(requestId);
                    }
                    window.registrationData.render();
                }
            });

            document
                .getElementById("clear-selection")
                .addEventListener("click", function() {
                    window.registrationData.selected.clear();
                    window.registrationData.render();
                });
        });
    </script>

    <script id="detail-modal-control">
        document.addEventListener("DOMContentLoaded", function() {
            const detailModal = document.getElementById("detail-modal");
            const closeDetailModal = document.getElementById("close-detail-modal");
            let currentDetailRequest = null;

            document.addEventListener("click", function(e) {
                if (e.target.closest(".view-details-btn")) {
                    const requestId = parseInt(
                        e.target.closest(".view-details-btn").dataset.requestId,
                    );
                    const request = window.registrationData.requests.find(
                        (r) => r.id === requestId,
                    );
                    if (request) {
                        currentDetailRequest = request;
                        document.getElementById("detail-avatar").textContent = request.avatar;
                        document.getElementById("detail-name").textContent = request.name;
                        document.getElementById("detail-email").textContent = request.email;
                        document.getElementById("detail-empnum").textContent = request.empNum;
                        document.getElementById("detail-username").textContent =
                            request.username;
                        document.getElementById("detail-date").textContent = formatDate(
                            request.date,
                        );
                        const statusBadge = document.getElementById("detail-status-badge");
                        statusBadge.textContent =
                            request.status.charAt(0).toUpperCase() + request.status.slice(1);
                        statusBadge.className = `inline-block px-3 py-1 text-xs font-semibold rounded-full ${getStatusBadgeClass(request.status)}`;
                        detailModal.classList.remove("hidden");
                    }
                }
            });

            closeDetailModal.addEventListener("click", function() {
                detailModal.classList.add("hidden");
            });

            detailModal.addEventListener("click", function(e) {
                if (e.target === detailModal) {
                    detailModal.classList.add("hidden");
                }
            });

            document
                .getElementById("detail-approve-btn")
                .addEventListener("click", function() {
                    if (currentDetailRequest) {
                        showConfirmModal("approve", [currentDetailRequest.id]);
                        detailModal.classList.add("hidden");
                    }
                });

            document
                .getElementById("detail-deny-btn")
                .addEventListener("click", function() {
                    if (currentDetailRequest) {
                        showConfirmModal("deny", [currentDetailRequest.id]);
                        detailModal.classList.add("hidden");
                    }
                });
        });
    </script>

    <script id="action-buttons">
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener("click", function(e) {
                if (e.target.closest(".approve-btn")) {
                    const requestId = parseInt(
                        e.target.closest(".approve-btn").dataset.requestId,
                    );
                    showConfirmModal("approve", [requestId]);
                }
                if (e.target.closest(".deny-btn")) {
                    const requestId = parseInt(
                        e.target.closest(".deny-btn").dataset.requestId,
                    );
                    showConfirmModal("deny", [requestId]);
                }
            });

            document
                .getElementById("bulk-approve")
                .addEventListener("click", function() {
                    if (window.registrationData.selected.size > 0) {
                        showConfirmModal(
                            "approve",
                            Array.from(window.registrationData.selected),
                        );
                    }
                });

            document.getElementById("bulk-deny").addEventListener("click", function() {
                if (window.registrationData.selected.size > 0) {
                    showConfirmModal("deny", Array.from(window.registrationData.selected));
                }
            });
        });
    </script>

    <script id="confirm-modal-control">
        let currentAction = null;
        let currentRequestIds = [];

        function showConfirmModal(action, requestIds) {
            currentAction = action;
            currentRequestIds = requestIds;
            const confirmModal = document.getElementById("confirm-modal");
            const confirmIcon = document.getElementById("confirm-icon");
            const confirmTitle = document.getElementById("confirm-title");
            const confirmMessage = document.getElementById("confirm-message");
            const confirmActionBtn = document.getElementById("confirm-action");
            const denyReasonContainer = document.getElementById("deny-reason-container");

            if (action === "approve") {
                confirmIcon.className = "ri-checkbox-circle-fill text-3xl text-secondary";
                confirmTitle.textContent = "Approve Registration";
                confirmMessage.textContent = `Are you sure you want to approve ${requestIds.length} registration request${requestIds.length > 1 ? "s" : ""}?`;
                confirmActionBtn.className =
                    "flex-1 h-11 bg-secondary text-white font-semibold text-sm !rounded-button cursor-pointer hover:bg-green-600 transition-colors";
                confirmActionBtn.textContent = "Approve";
                denyReasonContainer.classList.add("hidden");
            } else {
                confirmIcon.className = "ri-close-circle-fill text-3xl text-red-600";
                confirmTitle.textContent = "Deny Registration";
                confirmMessage.textContent = `Are you sure you want to deny ${requestIds.length} registration request${requestIds.length > 1 ? "s" : ""}?`;
                confirmActionBtn.className =
                    "flex-1 h-11 bg-red-600 text-white font-semibold text-sm !rounded-button cursor-pointer hover:bg-red-700 transition-colors";
                confirmActionBtn.textContent = "Deny";
                denyReasonContainer.classList.remove("hidden");
                document.getElementById("deny-reason").value = "";
            }

            confirmModal.classList.remove("hidden");
        }

        document.addEventListener("DOMContentLoaded", function() {
            const confirmModal = document.getElementById("confirm-modal");
            const confirmCancel = document.getElementById("confirm-cancel");
            const confirmActionBtn = document.getElementById("confirm-action");

            confirmCancel.addEventListener("click", function() {
                confirmModal.classList.add("hidden");
            });

            confirmModal.addEventListener("click", function(e) {
                if (e.target === confirmModal) {
                    confirmModal.classList.add("hidden");
                }
            });

            confirmActionBtn.addEventListener("click", function() {
                const newStatus = currentAction === "approve" ? "approved" : "denied";
                currentRequestIds.forEach((id) => {
                    const request = window.registrationData.requests.find((r) => r.id === id);
                    if (request) {
                        request.status = newStatus;
                    }
                    window.registrationData.selected.delete(id);
                });

                confirmModal.classList.add("hidden");
                window.registrationData.render();

                const message =
                    currentAction === "approve" ?
                    `Successfully approved ${currentRequestIds.length} request${currentRequestIds.length > 1 ? "s" : ""}` :
                    `Successfully denied ${currentRequestIds.length} request${currentRequestIds.length > 1 ? "s" : ""}`;
                window.registrationData.showToast(message, "success");
            });
        });
    </script>

    <script id="initial-render">
        document.addEventListener("DOMContentLoaded", function() {
            const loadingState = document.getElementById("loading-state");
            loadingState.classList.remove("hidden");

            setTimeout(() => {
                loadingState.classList.add("hidden");
                window.registrationData.render();
                window.registrationData.updateFilters();
            }, 1000);
        });
    </script>
</body>

</html>