<!DOCTYPE html>
<html lang="en">

<?php
$registrationDetails = $registrationDetails ?? null;
$registrationDate = !empty($registrationDetails['registration_date'])
    ? date('F j, Y', strtotime($registrationDetails['registration_date'])) . '<br>' . date('g:i A', strtotime($registrationDetails['registration_date']))
    : 'Unavailable';
$referenceNumber = $registrationDetails['reference_number'] ?? 'Unavailable';
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Successful - Car Park Management</title>
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
                        primary: "#3b82f6",
                        secondary: "#8b5cf6",
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
            content: "\f3c2"
        }

        @keyframes checkmark-scale {
            0% {
                transform: scale(0) rotate(0deg);
                opacity: 0
            }

            50% {
                transform: scale(1.1) rotate(5deg)
            }

            100% {
                transform: scale(1) rotate(0deg);
                opacity: 1
            }
        }

        @keyframes success-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(34, 197, 94, 0.3)
            }

            50% {
                box-shadow: 0 0 40px rgba(34, 197, 94, 0.5)
            }
        }

        .success-icon {
            animation: checkmark-scale 0.6s ease-out forwards, success-glow 2s ease-in-out infinite 0.6s
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards
        }

        .delay-100 {
            animation-delay: 0.1s
        }

        .delay-200 {
            animation-delay: 0.2s
        }

        .delay-300 {
            animation-delay: 0.3s
        }

        .delay-400 {
            animation-delay: 0.4s
        }

        .delay-500 {
            animation-delay: 0.5s
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="w-full bg-white shadow-sm">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-center">
            <div class="font-['Pacifico'] text-2xl text-primary">
                <img src="http://localhost/osgparkingsystem/public/img/logo/OSG CAR PARK.png" style="height: 60px;">
            </div>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 py-12">
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center w-24 h-24 bg-green-100 rounded-full mb-6 success-icon">
                <div class="w-16 h-16 flex items-center justify-center">
                    <i class="ri-checkbox-circle-fill text-6xl text-green-500"></i>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-3 fade-in-up delay-100">
                Registration Submitted Successfully!
            </h1>
            <p class="text-base text-gray-600 fade-in-up delay-200">
                Your registration request has been received and is being processed.
            </p>
        </div>

        <div
            class="bg-blue-50 border-l-4 border-primary rounded-lg p-6 mb-8 fade-in-up delay-300">
            <div class="flex items-start gap-4">
                <div
                    class="w-6 h-6 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="ri-information-line text-xl text-primary"></i>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-900 mb-2">
                        Important Notification
                    </h3>
                    <?php if ($notificationSent ?? false): ?>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            The System Administrator has been notified by email. Please check your OSG Mail for updates.
                        </p>
                    <?php else: ?>
                        <p class="text-sm text-amber-800 leading-relaxed">
                            Your request was saved, but the administrator email could not be sent. Microsoft 365 SMTP configuration is required.
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-8 mb-8 fade-in-up delay-400">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Submission Details</h2>
            <div class="space-y-4">
                <div
                    class="flex justify-between items-start py-3 border-b border-gray-100">
                    <span class="text-sm text-gray-600">Submission Date & Time</span>
                    <span class="text-sm font-semibold text-gray-900 text-right"><?= $registrationDetails ? $registrationDate : 'Unavailable' ?></span>
                </div>
                <div
                    class="flex justify-between items-start py-3 border-b border-gray-100">
                    <span class="text-sm text-gray-600">Reference Number</span>
                    <span
                        class="text-sm font-mono font-semibold text-gray-900 bg-gray-100 px-3 py-1 rounded"><?= esc($referenceNumber) ?></span>
                </div>
                <div
                    class="flex justify-between items-start py-3 border-b border-gray-100">
                    <span class="text-sm text-gray-600">Employee Number</span>
                    <span class="text-sm font-mono font-semibold text-gray-900"><?= esc($registrationDetails['employee_number'] ?? 'Unavailable') ?></span>
                </div>
                <div
                    class="flex justify-between items-start py-3 border-b border-gray-100">
                    <span class="text-sm text-gray-600">Email Address (OSG Mail)</span>
                    <span
                        class="text-sm font-semibold text-gray-900 text-right break-all"><?= esc($registrationDetails['email'] ?? 'Unavailable') ?></span>
                </div>
                <div class="flex justify-between items-start py-3">
                    <span class="text-sm text-gray-600">Request Type</span>
                    <span class="text-sm font-semibold text-gray-900">New Registration</span>
                </div>
            </div>
        </div>

        <div class="bg-gray-100 rounded-lg p-8 mb-8 fade-in-up delay-500">
            <h2 class="text-xl font-bold text-gray-900 mb-6">What Happens Next?</h2>
            <div class="space-y-6">
                <div class="flex items-start gap-4">
                    <div
                        class="w-10 h-10 flex items-center justify-center bg-primary text-white rounded-full font-bold text-lg flex-shrink-0">
                        1
                    </div>
                    <div class="pt-1">
                        <h3 class="text-base font-semibold text-gray-900 mb-1">
                            Registration Review
                        </h3>
                        <p class="text-sm text-gray-600">
                            Your registration request is being reviewed by our
                            administrative team.
                        </p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div
                        class="w-10 h-10 flex items-center justify-center bg-primary text-white rounded-full font-bold text-lg flex-shrink-0">
                        2
                    </div>
                    <div class="pt-1">
                        <h3 class="text-base font-semibold text-gray-900 mb-1">
                            Email Confirmation
                        </h3>
                        <p class="text-sm text-gray-600">
                            You will receive a confirmation email to your OSG Mail with
                            further instructions.
                        </p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div
                        class="w-10 h-10 flex items-center justify-center bg-primary text-white rounded-full font-bold text-lg flex-shrink-0">
                        3
                    </div>
                    <div class="pt-1">
                        <h3 class="text-base font-semibold text-gray-900 mb-1">
                            Approval Process
                        </h3>
                        <p class="text-sm text-gray-600">
                            The approval process typically takes 2-3 business days to
                            complete.
                        </p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div
                        class="w-10 h-10 flex items-center justify-center bg-primary text-white rounded-full font-bold text-lg flex-shrink-0">
                        4
                    </div>
                    <div class="pt-1">
                        <h3 class="text-base font-semibold text-gray-900 mb-1">
                            Access Granted
                        </h3>
                        <p class="text-sm text-gray-600">
                            Once approved, you can access your parking privileges and start
                            using the system.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4 mb-8">
            <a href="<?= base_url() ?>"
                class="w-full px-6 py-4 bg-primary hover:bg-primary/90 text-white font-semibold rounded-button whitespace-nowrap flex items-center justify-center gap-3 cursor-pointer !rounded-button">
                <div class="w-6 h-6 flex items-center justify-center">
                    <i class="ri-dashboard-line text-xl"></i>
                </div>
                <span>Return to Sign In</span>
            </a>
            <a href="<?= base_url('account-registration') ?>"
                class="w-full px-6 py-4 bg-white hover:bg-gray-50 text-primary border-2 border-primary font-semibold rounded-button whitespace-nowrap flex items-center justify-center gap-3 cursor-pointer !rounded-button">
                <div class="w-6 h-6 flex items-center justify-center">
                    <i class="ri-file-list-line text-xl"></i>
                </div>
                <span>Start Another Registration</span>
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 text-center">
            <div class="flex items-center justify-center gap-2 mb-3">
                <div class="w-5 h-5 flex items-center justify-center">
                    <i class="ri-question-line text-lg text-gray-600"></i>
                </div>
                <h3 class="text-base font-semibold text-gray-900">Need Help?</h3>
            </div>
            <p class="text-sm text-gray-600 mb-4">
                If you have any questions or concerns about your registration, please
                contact our support team.
            </p>
            <div
                class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a
                    href="#"
                    class="flex items-center gap-2 text-sm font-medium text-primary hover:text-primary/80 cursor-pointer">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-mail-line text-lg"></i>
                    </div>
                    <span>Contact OSG Support</span>
                </a>
                <span class="hidden sm:inline text-gray-300">|</span>
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-file-text-line text-lg"></i>
                    </div>
                    <span>Reference:
                        <span class="font-mono font-semibold"><?= esc($referenceNumber) ?></span></span>
                </div>
            </div>
        </div>
    </div>

    <script id="animation-trigger">
        document.addEventListener("DOMContentLoaded", function() {
            const elements = document.querySelectorAll(".fade-in-up");
            elements.forEach((element, index) => {
                element.style.opacity = "0";
                setTimeout(() => {
                    element.style.opacity = "1";
                }, index * 100);
            });
        });
    </script>
</body>

</html>