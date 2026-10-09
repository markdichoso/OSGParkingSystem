<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Password Reset Successful</title>
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

        .fade-in {
            animation: fadeIn 0.5s ease;
        }

        @keyframes checkmark {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        .checkmark-animation {
            animation: checkmark 0.6s ease;
        }

        .masked-email {
            user-select: all;
            cursor: text;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="w-full max-w-[375px] mx-auto bg-white min-h-screen relative">
        <header class="fixed top-0 w-full max-w-[375px] bg-white z-50 shadow-sm">
            <div class="flex items-center justify-between px-5 py-4 h-16">
                <div class="font-['Pacifico'] text-2xl text-primary">logo</div>
            </div>
        </header>
        <main class="pt-20 pb-8 px-5">
            <div class="flex flex-col items-center justify-center py-8 fade-in">
                <div
                    class="w-32 h-32 flex items-center justify-center bg-gradient-to-br from-secondary to-green-600 rounded-full mb-8 shadow-lg checkmark-animation">
                    <i class="ri-checkbox-circle-fill text-6xl text-white"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-3 text-center">
                    Password Reset Successful!
                </h1>
                <p class="text-base text-gray-600 text-center mb-6 px-4">
                    Your password has been changed successfully. A verification email
                    has been sent to confirm this action.
                </p>
                <div
                    class="w-full bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start gap-3 mb-3">
                        <div
                            class="w-5 h-5 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="ri-mail-line text-lg text-primary"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900 mb-1">
                                Verification Email Sent
                            </p>
                            <p class="text-xs text-gray-700 leading-relaxed mb-2">
                                We've sent a confirmation email to:
                            </p>
                            <div
                                class="bg-white border border-blue-200 rounded-lg px-3 py-2 flex items-center gap-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-mail-check-line text-sm text-primary"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900 masked-email">j***@example.com</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="w-full bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-5 h-5 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="ri-checkbox-circle-fill text-lg text-secondary"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900 mb-1">
                                Verification Email Sent
                            </p>
                            <p class="text-xs text-gray-700 leading-relaxed mb-2">
                                A verification email has been sent to your email address.
                                Please check your inbox to complete the password reset
                                process.
                            </p>
                            <p class="text-xs text-gray-600">
                                The email should arrive within a few minutes. If you don't see
                                it, please check your spam folder.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full mb-6">
                    <p class="text-sm text-gray-600 text-center">
                        Didn't receive the email?
                        <button
                            type="button"
                            id="resend-email"
                            class="text-primary font-semibold hover:text-blue-700 transition-colors cursor-pointer inline-flex items-center gap-1">
                            Resend verification email
                            <i class="ri-refresh-line text-base"></i>
                        </button>
                    </p>
                </div>
                <p class="text-sm text-gray-600 mb-8 text-center">
                    Redirecting to login in
                    <span id="redirect-timer" class="font-semibold text-primary">5</span>
                    seconds...
                </p>
                <button
                    type="button"
                    id="go-to-login"
                    class="w-full h-12 bg-primary text-white font-semibold text-sm !rounded-button shadow-lg hover:bg-blue-700 transition-all cursor-pointer flex items-center justify-center gap-2">
                    <i class="ri-login-box-line text-lg"></i>
                    <span>Return to Login</span>
                </button>
            </div>
        </main>
        <div
            id="toast-notification"
            class="fixed bottom-20 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white px-4 py-3 rounded-lg shadow-lg hidden transition-all z-50 max-w-[335px] w-full mx-5">
            <div class="flex items-center gap-3">
                <div class="w-5 h-5 flex items-center justify-center">
                    <i class="ri-mail-send-line text-lg"></i>
                </div>
                <p class="text-sm font-medium flex-1">
                    Verification email sent successfully!
                </p>
            </div>
        </div>
    </div>
    <script id="redirect-timer-script">
        document.addEventListener("DOMContentLoaded", function() {
            let timeLeft = 5;
            const redirectTimerElement = document.getElementById("redirect-timer");
            const goToLoginBtn = document.getElementById("go-to-login");
            const interval = setInterval(function() {
                timeLeft--;
                redirectTimerElement.textContent = timeLeft;
                if (timeLeft <= 0) {
                    clearInterval(interval);
                    window.location.href = "login.html";
                }
            }, 1000);
            goToLoginBtn.addEventListener("click", function() {
                clearInterval(interval);
                window.location.href = "login.html";
            });
        });
    </script>
    <script id="resend-email-script">
        document.addEventListener("DOMContentLoaded", function() {
            const resendEmailBtn = document.getElementById("resend-email");
            const toastNotification = document.getElementById("toast-notification");
            let isResending = false;
            resendEmailBtn.addEventListener("click", function() {
                if (isResending) return;
                isResending = true;
                const originalHTML = this.innerHTML;
                this.innerHTML =
                    '<i class="ri-loader-4-line text-base animate-spin"></i> Sending...';
                this.disabled = true;
                this.classList.add("opacity-50", "cursor-not-allowed");
                setTimeout(function() {
                    toastNotification.classList.remove("hidden");
                    toastNotification.classList.add("fade-in");
                    setTimeout(function() {
                        toastNotification.classList.add("hidden");
                        toastNotification.classList.remove("fade-in");
                    }, 3000);
                    resendEmailBtn.innerHTML = originalHTML;
                    resendEmailBtn.disabled = false;
                    resendEmailBtn.classList.remove("opacity-50", "cursor-not-allowed");
                    isResending = false;
                }, 1500);
            });
        });
    </script>
</body>

</html>