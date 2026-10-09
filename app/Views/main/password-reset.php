<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OSG Car Parking System - Password Reset</title>
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

        .password-toggle {
            cursor: pointer;
            user-select: none;
        }

        .validation-message {
            font-size: 0.75rem;
            margin-top: 0.375rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .validation-message.error {
            color: #DC2626;
        }

        .validation-message.success {
            color: #10B981;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .input-with-icon {
            padding-left: 2.75rem;
        }

        .input-action-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }

        .code-input {
            width: 48px;
            height: 56px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .step-circle.active {
            background: #2563EB;
            color: white;
        }

        .step-circle.completed {
            background: #10B981;
            color: white;
        }

        .step-circle.inactive {
            background: #E5E7EB;
            color: #9CA3AF;
        }

        .step-line {
            width: 40px;
            height: 2px;
            background: #E5E7EB;
            transition: all 0.3s ease;
        }

        .step-line.active {
            background: #2563EB;
        }

        .step-line.completed {
            background: #10B981;
        }

        .password-strength-bar {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }

        .password-strength-bar.weak {
            width: 33.33%;
            background: #DC2626;
        }

        .password-strength-bar.medium {
            width: 66.66%;
            background: #F59E0B;
        }

        .password-strength-bar.strong {
            width: 100%;
            background: #10B981;
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
            <div class="mb-8">
                <div
                    class="w-20 h-20 flex items-center justify-center bg-gradient-to-br from-primary to-blue-600 rounded-2xl mx-auto mb-6 shadow-lg">
                    <i class="ri-lock-password-line text-4xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 text-center mb-2">
                    Reset Password
                </h1>
                <p class="text-base text-gray-600 text-center">
                    Follow the steps to reset your password securely
                </p>
            </div>
            <div class="mb-8">
                <div class="step-indicator">
                    <div class="step-circle active" id="step-circle-1">
                        <i class="ri-mail-line text-lg"></i>
                    </div>
                    <div class="step-line" id="step-line-1"></div>
                    <div class="step-circle inactive" id="step-circle-2">
                        <i class="ri-lock-line text-lg"></i>
                    </div>
                    <div class="step-line" id="step-line-2"></div>
                    <div class="step-circle inactive" id="step-circle-3">
                        <i class="ri-checkbox-circle-line text-lg"></i>
                    </div>
                </div>
                <div class="flex justify-between mt-3 px-2">
                    <span class="text-xs font-medium text-primary" id="step-text-1">Verify Email</span>
                    <span class="text-xs font-medium text-gray-400" id="step-text-2">New Password</span>
                    <span class="text-xs font-medium text-gray-400" id="step-text-3">Complete</span>
                </div>
            </div>
            <div
                id="step-1-email"
                class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6 fade-in">
                <h2 class="text-lg font-bold text-gray-900 mb-4">
                    Verify Your Email
                </h2>
                <form id="email-form">
                    <div class="mb-4">
                        <label
                            for="reset-email"
                            class="block text-sm font-semibold text-gray-900 mb-2">Email Address</label>
                        <div class="input-wrapper">
                            <div
                                class="input-icon w-5 h-5 flex items-center justify-center">
                                <i class="ri-mail-line text-lg text-gray-500"></i>
                            </div>
                            <input
                                type="email"
                                id="reset-email"
                                class="input-with-icon w-full h-12 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                placeholder="employee@osg.gov.ph" />
                        </div>
                        <p class="text-xs text-gray-600 mt-2">
                            Enter your registered OSG email
                        </p>
                        <div
                            id="email-error"
                            class="validation-message error hidden"></div>
                    </div>
                    <div
                        class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-start gap-3 mb-6">
                        <div
                            class="w-5 h-5 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="ri-information-line text-lg text-primary"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-700 leading-relaxed">
                                We'll send a 6-digit verification code to this email address.
                                Please check your inbox and spam folder.
                            </p>
                        </div>
                    </div>
                    <button
                        type="submit"
                        id="send-code-btn"
                        class="w-full h-12 bg-primary text-white font-semibold text-sm !rounded-button shadow-lg hover:bg-blue-700 transition-all cursor-pointer flex items-center justify-center gap-2">
                        <span>Send Verification Code</span>
                        <i class="ri-arrow-right-line text-lg"></i>
                    </button>
                    <button
                        type="button"
                        id="back-to-login-1"
                        class="w-full h-12 bg-white border-2 border-gray-200 text-gray-700 font-semibold text-sm !rounded-button hover:bg-gray-50 transition-all cursor-pointer mt-3">
                        Back to Login
                    </button>
                </form>
            </div>
            <div
                id="step-1-code"
                class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6 hidden">
                <h2 class="text-lg font-bold text-gray-900 mb-4">
                    Enter Verification Code
                </h2>
                <p class="text-sm text-gray-600 mb-6">
                    We've sent a 6-digit code to
                    <span id="masked-email" class="font-semibold text-gray-900"></span>
                </p>
                <div class="flex justify-between gap-2 mb-4">
                    <input
                        type="text"
                        maxlength="1"
                        class="code-input bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        id="code-1" />
                    <input
                        type="text"
                        maxlength="1"
                        class="code-input bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        id="code-2" />
                    <input
                        type="text"
                        maxlength="1"
                        class="code-input bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        id="code-3" />
                    <input
                        type="text"
                        maxlength="1"
                        class="code-input bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        id="code-4" />
                    <input
                        type="text"
                        maxlength="1"
                        class="code-input bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        id="code-5" />
                    <input
                        type="text"
                        maxlength="1"
                        class="code-input bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        id="code-6" />
                </div>
                <div
                    id="code-error"
                    class="validation-message error hidden mb-4"></div>
                <div class="flex items-center justify-between mb-6">
                    <span class="text-sm text-gray-600">Code expires in
                        <span id="timer" class="font-semibold text-gray-900">2:00</span></span>
                    <button
                        type="button"
                        id="resend-code-btn"
                        class="text-sm font-semibold text-gray-400 cursor-not-allowed"
                        disabled>
                        Resend Code
                    </button>
                </div>
                <button
                    type="button"
                    id="verify-code-btn"
                    class="w-full h-12 bg-primary text-white font-semibold text-sm !rounded-button shadow-lg hover:bg-blue-700 transition-all cursor-pointer flex items-center justify-center gap-2">
                    <span>Verify Code</span>
                    <i class="ri-arrow-right-line text-lg"></i>
                </button>
                <button
                    type="button"
                    id="back-to-email"
                    class="w-full h-12 bg-white border-2 border-gray-200 text-gray-700 font-semibold text-sm !rounded-button hover:bg-gray-50 transition-all cursor-pointer mt-3">
                    Change Email
                </button>
            </div>
            <div
                id="step-2-password"
                class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6 hidden">
                <h2 class="text-lg font-bold text-gray-900 mb-4">
                    Create New Password
                </h2>
                <form id="password-form">
                    <div class="mb-4">
                        <label
                            for="employee-email"
                            class="block text-sm font-semibold text-gray-900 mb-2">Employee Email</label>
                        <div class="input-wrapper">
                            <div
                                class="input-icon w-5 h-5 flex items-center justify-center">
                                <i class="ri-lock-line text-lg text-gray-500"></i>
                            </div>
                            <input
                                type="email"
                                id="employee-email"
                                class="input-with-icon w-full h-12 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all pr-12"
                                placeholder="Enter your employee email" />
                            <div
                                class="input-action-icon w-5 h-5 flex items-center justify-center password-toggle cursor-pointer"
                                id="toggle-new-password">
                                <i class="ri-eye-off-line text-lg text-gray-500"></i>
                            </div>
                        </div>

                        <label
                            for="new-password"
                            class="block text-sm font-semibold text-gray-900 mb-2">New Password</label>
                        <div class="input-wrapper">
                            <div
                                class="input-icon w-5 h-5 flex items-center justify-center">
                                <i class="ri-lock-line text-lg text-gray-500"></i>
                            </div>
                            <input
                                type="password"
                                id="new-password"
                                class="input-with-icon w-full h-12 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all pr-12"
                                placeholder="Enter your new password" />
                            <div
                                class="input-action-icon w-5 h-5 flex items-center justify-center password-toggle cursor-pointer"
                                id="toggle-new-password">
                                <i class="ri-eye-off-line text-lg text-gray-500"></i>
                            </div>
                        </div>
                        <div id="password-strength-container" class="hidden">
                            <div class="flex items-center justify-between mt-2">
                                <span
                                    class="text-xs font-medium"
                                    id="password-strength-text"></span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1 mt-1">
                                <div
                                    class="password-strength-bar"
                                    id="password-strength-bar"></div>
                            </div>
                        </div>
                        <div
                            id="new-password-error"
                            class="validation-message error hidden"></div>
                    </div>
                    <div class="mb-4">
                        <label
                            for="confirm-new-password"
                            class="block text-sm font-semibold text-gray-900 mb-2">Confirm New Password</label>
                        <div class="input-wrapper">
                            <div
                                class="input-icon w-5 h-5 flex items-center justify-center">
                                <i class="ri-lock-line text-lg text-gray-500"></i>
                            </div>
                            <input
                                type="password"
                                id="confirm-new-password"
                                class="input-with-icon w-full h-12 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all pr-12"
                                placeholder="Re-enter your new password" />
                            <div
                                class="input-action-icon w-5 h-5 flex items-center justify-center password-toggle cursor-pointer"
                                id="toggle-confirm-new-password">
                                <i class="ri-eye-off-line text-lg text-gray-500"></i>
                            </div>
                        </div>
                        <div
                            id="confirm-new-password-error"
                            class="validation-message error hidden"></div>
                        <div
                            id="confirm-new-password-success"
                            class="validation-message success hidden"></div>
                    </div>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start gap-3 mb-3">
                            <div
                                class="w-5 h-5 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="ri-information-line text-lg text-primary"></i>
                            </div>
                            <p class="text-xs font-semibold text-gray-900">
                                Password Requirements:
                            </p>
                        </div>
                        <ul class="space-y-2 ml-8">
                            <li class="flex items-center gap-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i
                                        class="ri-checkbox-blank-circle-line text-xs text-gray-400"
                                        id="req-length"></i>
                                </div>
                                <span class="text-xs text-gray-700">At least 8 characters</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i
                                        class="ri-checkbox-blank-circle-line text-xs text-gray-400"
                                        id="req-uppercase"></i>
                                </div>
                                <span class="text-xs text-gray-700">One uppercase letter</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i
                                        class="ri-checkbox-blank-circle-line text-xs text-gray-400"
                                        id="req-lowercase"></i>
                                </div>
                                <span class="text-xs text-gray-700">One lowercase letter</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i
                                        class="ri-checkbox-blank-circle-line text-xs text-gray-400"
                                        id="req-number"></i>
                                </div>
                                <span class="text-xs text-gray-700">One number</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i
                                        class="ri-checkbox-blank-circle-line text-xs text-gray-400"
                                        id="req-special"></i>
                                </div>
                                <span class="text-xs text-gray-700">One special character</span>
                            </li>
                        </ul>
                    </div>
                    <button
                        type="submit"
                        id="reset-password-btn"
                        class="w-full h-12 bg-primary text-white font-semibold text-sm !rounded-button shadow-lg hover:bg-blue-700 transition-all cursor-pointer flex items-center justify-center gap-2">
                        <span>Reset Password</span>
                        <i class="ri-arrow-right-line text-lg"></i>
                    </button>
                    <button
                        type="button"
                        id="cancel-reset"
                        class="w-full h-12 bg-white border-2 border-gray-200 text-gray-700 font-semibold text-sm !rounded-button hover:bg-gray-50 transition-all cursor-pointer mt-3">
                        Cancel
                    </button>
                </form>
            </div>
            <div id="step-3-success" class="hidden">
                <div class="flex flex-col items-center justify-center py-12 fade-in">
                    <div
                        class="w-32 h-32 flex items-center justify-center bg-gradient-to-br from-secondary to-green-600 rounded-full mb-8 shadow-lg checkmark-animation">
                        <i class="ri-checkbox-circle-fill text-6xl text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3 text-center">
                        Password Reset Successful!
                    </h2>
                    <p class="text-base text-gray-600 text-center mb-6">
                        Your password has been reset successfully
                    </p>
                    <div
                        class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-start gap-3 w-full mb-6">
                        <div
                            class="w-5 h-5 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="ri-checkbox-circle-fill text-lg text-secondary"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 mb-1">All Set!</p>
                            <p class="text-xs text-gray-700 leading-relaxed">
                                You can now log in with your new password. Please keep it
                                secure and don't share it with anyone.
                            </p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-8">
                        Redirecting to login in
                        <span id="redirect-timer" class="font-semibold text-primary">5</span>
                        seconds...
                    </p>
                    <button
                        type="button"
                        id="go-to-login"
                        class="w-full h-12 bg-primary text-white font-semibold text-sm !rounded-button shadow-lg hover:bg-blue-700 transition-all cursor-pointer flex items-center justify-center gap-2">
                        <i class="ri-login-box-line text-lg"></i>
                        <span>Go to Login</span>
                    </button>
                </div>
            </div>
        </main>
    </div>
    <script id="email-verification">
        document.addEventListener("DOMContentLoaded", function() {
            const emailForm = document.getElementById("email-form");
            const emailInput = document.getElementById("reset-email");
            const emailError = document.getElementById("email-error");
            const sendCodeBtn = document.getElementById("send-code-btn");
            const step1Email = document.getElementById("step-1-email");
            const step1Code = document.getElementById("step-1-code");
            const maskedEmail = document.getElementById("masked-email");
            const backToLogin1 = document.getElementById("back-to-login-1");

            function validateEmail(email) {
                const osgPattern = /^[a-zA-Z0-9._%+-]+@osg\.gov\.ph$/;
                return osgPattern.test(email);
            }

            function maskEmail(email) {
                const parts = email.split("@");
                const username = parts[0];
                const domain = parts[1];
                const maskedUsername =
                    username.substring(0, 2) +
                    "***" +
                    username.substring(username.length - 1);
                return maskedUsername + "@" + domain;
            }
            emailForm.addEventListener("submit", function(e) {
                e.preventDefault();
                const email = emailInput.value.trim();
                if (!email) {
                    emailError.classList.remove("hidden");
                    emailError.innerHTML =
                        '<i class="ri-error-warning-fill"></i><span>Please enter your email address</span>';
                    emailInput.classList.add("border-red-500");
                    return;
                }
                if (!validateEmail(email)) {
                    emailError.classList.remove("hidden");
                    emailError.innerHTML =
                        '<i class="ri-error-warning-fill"></i><span>Please enter a valid OSG email address (@osg.gov.ph)</span>';
                    emailInput.classList.add("border-red-500");
                    return;
                }
                emailError.classList.add("hidden");
                emailInput.classList.remove("border-red-500");
                sendCodeBtn.innerHTML =
                    '<i class="ri-loader-4-line text-lg animate-spin"></i><span>Sending Code...</span>';
                sendCodeBtn.disabled = true;
                setTimeout(function() {
                    maskedEmail.textContent = maskEmail(email);
                    step1Email.classList.add("hidden");
                    step1Code.classList.remove("hidden");
                    step1Code.classList.add("fade-in");
                    startTimer();
                }, 1500);
            });
            emailInput.addEventListener("input", function() {
                emailError.classList.add("hidden");
                emailInput.classList.remove("border-red-500");
            });
            backToLogin1.addEventListener("click", function() {
                window.location.href = "login.html";
            });
        });
    </script>
    <script id="code-verification">
        document.addEventListener("DOMContentLoaded", function() {
            const codeInputs = [
                document.getElementById("code-1"),
                document.getElementById("code-2"),
                document.getElementById("code-3"),
                document.getElementById("code-4"),
                document.getElementById("code-5"),
                document.getElementById("code-6"),
            ];
            const verifyCodeBtn = document.getElementById("verify-code-btn");
            const resendCodeBtn = document.getElementById("resend-code-btn");
            const codeError = document.getElementById("code-error");
            const backToEmail = document.getElementById("back-to-email");
            const step1Code = document.getElementById("step-1-code");
            const step1Email = document.getElementById("step-1-email");
            const step2Password = document.getElementById("step-2-password");
            const stepCircle1 = document.getElementById("step-circle-1");
            const stepCircle2 = document.getElementById("step-circle-2");
            const stepLine1 = document.getElementById("step-line-1");
            const stepText1 = document.getElementById("step-text-1");
            const stepText2 = document.getElementById("step-text-2");
            codeInputs.forEach((input, index) => {
                input.addEventListener("input", function(e) {
                    const value = e.target.value;
                    if (value.length === 1 && index < 5) {
                        codeInputs[index + 1].focus();
                    }
                    if (value && !/^\d$/.test(value)) {
                        e.target.value = "";
                    }
                    codeError.classList.add("hidden");
                    input.classList.remove("border-red-500");
                });
                input.addEventListener("keydown", function(e) {
                    if (e.key === "Backspace" && !e.target.value && index > 0) {
                        codeInputs[index - 1].focus();
                    }
                });
                input.addEventListener("paste", function(e) {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData("text").trim();
                    if (/^\d{6}$/.test(pastedData)) {
                        pastedData.split("").forEach((char, i) => {
                            if (i < 6) {
                                codeInputs[i].value = char;
                            }
                        });
                        codeInputs[5].focus();
                    }
                });
            });
            verifyCodeBtn.addEventListener("click", function() {
                const code = codeInputs.map((input) => input.value).join("");
                if (code.length !== 6) {
                    codeError.classList.remove("hidden");
                    codeError.innerHTML =
                        '<i class="ri-error-warning-fill"></i><span>Please enter the complete 6-digit code</span>';
                    codeInputs.forEach((input) => input.classList.add("border-red-500"));
                    return;
                }
                if (code !== "123456") {
                    codeError.classList.remove("hidden");
                    codeError.innerHTML =
                        '<i class="ri-error-warning-fill"></i><span>Invalid verification code. Please try again.</span>';
                    codeInputs.forEach((input) => {
                        input.classList.add("border-red-500");
                        input.value = "";
                    });
                    codeInputs[0].focus();
                    return;
                }
                codeError.classList.add("hidden");
                codeInputs.forEach((input) => input.classList.remove("border-red-500"));
                verifyCodeBtn.innerHTML =
                    '<i class="ri-loader-4-line text-lg animate-spin"></i><span>Verifying...</span>';
                verifyCodeBtn.disabled = true;
                setTimeout(function() {
                    stepCircle1.classList.remove("active");
                    stepCircle1.classList.add("completed");
                    stepCircle1.innerHTML = '<i class="ri-check-line text-lg"></i>';
                    stepLine1.classList.add("completed");
                    stepCircle2.classList.remove("inactive");
                    stepCircle2.classList.add("active");
                    stepText1.classList.remove("text-primary");
                    stepText1.classList.add("text-secondary");
                    stepText2.classList.remove("text-gray-400");
                    stepText2.classList.add("text-primary");
                    step1Code.classList.add("hidden");
                    step2Password.classList.remove("hidden");
                    step2Password.classList.add("fade-in");
                }, 1000);
            });
            backToEmail.addEventListener("click", function() {
                step1Code.classList.add("hidden");
                step1Email.classList.remove("hidden");
                codeInputs.forEach((input) => {
                    input.value = "";
                    input.classList.remove("border-red-500");
                });
                codeError.classList.add("hidden");
            });
            resendCodeBtn.addEventListener("click", function() {
                if (!resendCodeBtn.disabled) {
                    resendCodeBtn.disabled = true;
                    resendCodeBtn.classList.add("cursor-not-allowed", "text-gray-400");
                    resendCodeBtn.classList.remove("text-primary", "cursor-pointer");
                    resendCodeBtn.textContent = "Code Sent!";
                    codeInputs.forEach((input) => {
                        input.value = "";
                        input.classList.remove("border-red-500");
                    });
                    codeInputs[0].focus();
                    codeError.classList.add("hidden");
                    startTimer();
                }
            });
        });

        function startTimer() {
            let timeLeft = 120;
            const timerElement = document.getElementById("timer");
            const resendBtn = document.getElementById("resend-code-btn");
            const interval = setInterval(function() {
                timeLeft--;
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, "0")}`;
                if (timeLeft <= 0) {
                    clearInterval(interval);
                    timerElement.textContent = "0:00";
                    resendBtn.disabled = false;
                    resendBtn.classList.remove("cursor-not-allowed", "text-gray-400");
                    resendBtn.classList.add("text-primary", "cursor-pointer");
                    resendBtn.textContent = "Resend Code";
                }
            }, 1000);
        }
    </script>
    <script id="password-reset">
        document.addEventListener("DOMContentLoaded", function() {
            const passwordForm = document.getElementById("password-form");
            const newPasswordInput = document.getElementById("new-password");
            const confirmNewPasswordInput = document.getElementById(
                "confirm-new-password",
            );
            const toggleNewPassword = document.getElementById("toggle-new-password");
            const toggleConfirmNewPassword = document.getElementById(
                "toggle-confirm-new-password",
            );
            const newPasswordError = document.getElementById("new-password-error");
            const confirmNewPasswordError = document.getElementById(
                "confirm-new-password-error",
            );
            const confirmNewPasswordSuccess = document.getElementById(
                "confirm-new-password-success",
            );
            const resetPasswordBtn = document.getElementById("reset-password-btn");
            const cancelReset = document.getElementById("cancel-reset");
            const step2Password = document.getElementById("step-2-password");
            const step3Success = document.getElementById("step-3-success");
            const stepCircle2 = document.getElementById("step-circle-2");
            const stepCircle3 = document.getElementById("step-circle-3");
            const stepLine2 = document.getElementById("step-line-2");
            const stepText2 = document.getElementById("step-text-2");
            const stepText3 = document.getElementById("step-text-3");
            const passwordStrengthContainer = document.getElementById(
                "password-strength-container",
            );
            const passwordStrengthBar = document.getElementById("password-strength-bar");
            const passwordStrengthText = document.getElementById(
                "password-strength-text",
            );
            const reqLength = document.getElementById("req-length");
            const reqUppercase = document.getElementById("req-uppercase");
            const reqLowercase = document.getElementById("req-lowercase");
            const reqNumber = document.getElementById("req-number");
            const reqSpecial = document.getElementById("req-special");
            toggleNewPassword.addEventListener("click", function() {
                const type =
                    newPasswordInput.getAttribute("type") === "password" ?
                    "text" :
                    "password";
                newPasswordInput.setAttribute("type", type);
                const icon = this.querySelector("i");
                if (type === "text") {
                    icon.classList.remove("ri-eye-off-line");
                    icon.classList.add("ri-eye-line");
                } else {
                    icon.classList.remove("ri-eye-line");
                    icon.classList.add("ri-eye-off-line");
                }
            });
            toggleConfirmNewPassword.addEventListener("click", function() {
                const type =
                    confirmNewPasswordInput.getAttribute("type") === "password" ?
                    "text" :
                    "password";
                confirmNewPasswordInput.setAttribute("type", type);
                const icon = this.querySelector("i");
                if (type === "text") {
                    icon.classList.remove("ri-eye-off-line");
                    icon.classList.add("ri-eye-line");
                } else {
                    icon.classList.remove("ri-eye-line");
                    icon.classList.add("ri-eye-off-line");
                }
            });

            function checkPasswordRequirements(password) {
                const requirements = {
                    length: password.length >= 8,
                    uppercase: /[A-Z]/.test(password),
                    lowercase: /[a-z]/.test(password),
                    number: /[0-9]/.test(password),
                    special: /[!@#$%^&*(),.?":{}|<>]/.test(password),
                };
                if (requirements.length) {
                    reqLength.classList.remove(
                        "ri-checkbox-blank-circle-line",
                        "text-gray-400",
                    );
                    reqLength.classList.add("ri-checkbox-circle-fill", "text-secondary");
                } else {
                    reqLength.classList.remove("ri-checkbox-circle-fill", "text-secondary");
                    reqLength.classList.add("ri-checkbox-blank-circle-line", "text-gray-400");
                }
                if (requirements.uppercase) {
                    reqUppercase.classList.remove(
                        "ri-checkbox-blank-circle-line",
                        "text-gray-400",
                    );
                    reqUppercase.classList.add("ri-checkbox-circle-fill", "text-secondary");
                } else {
                    reqUppercase.classList.remove(
                        "ri-checkbox-circle-fill",
                        "text-secondary",
                    );
                    reqUppercase.classList.add(
                        "ri-checkbox-blank-circle-line",
                        "text-gray-400",
                    );
                }
                if (requirements.lowercase) {
                    reqLowercase.classList.remove(
                        "ri-checkbox-blank-circle-line",
                        "text-gray-400",
                    );
                    reqLowercase.classList.add("ri-checkbox-circle-fill", "text-secondary");
                } else {
                    reqLowercase.classList.remove(
                        "ri-checkbox-circle-fill",
                        "text-secondary",
                    );
                    reqLowercase.classList.add(
                        "ri-checkbox-blank-circle-line",
                        "text-gray-400",
                    );
                }
                if (requirements.number) {
                    reqNumber.classList.remove(
                        "ri-checkbox-blank-circle-line",
                        "text-gray-400",
                    );
                    reqNumber.classList.add("ri-checkbox-circle-fill", "text-secondary");
                } else {
                    reqNumber.classList.remove("ri-checkbox-circle-fill", "text-secondary");
                    reqNumber.classList.add("ri-checkbox-blank-circle-line", "text-gray-400");
                }
                if (requirements.special) {
                    reqSpecial.classList.remove(
                        "ri-checkbox-blank-circle-line",
                        "text-gray-400",
                    );
                    reqSpecial.classList.add("ri-checkbox-circle-fill", "text-secondary");
                } else {
                    reqSpecial.classList.remove("ri-checkbox-circle-fill", "text-secondary");
                    reqSpecial.classList.add(
                        "ri-checkbox-blank-circle-line",
                        "text-gray-400",
                    );
                }
                return requirements;
            }

            function calculatePasswordStrength(password) {
                const requirements = checkPasswordRequirements(password);
                const metRequirements = Object.values(requirements).filter(Boolean).length;
                if (metRequirements <= 2) {
                    return "weak";
                } else if (metRequirements <= 4) {
                    return "medium";
                } else {
                    return "strong";
                }
            }

            function validatePassword(password) {
                const requirements = checkPasswordRequirements(password);
                return Object.values(requirements).every(Boolean);
            }
            newPasswordInput.addEventListener("input", function() {
                const password = this.value;
                if (password) {
                    passwordStrengthContainer.classList.remove("hidden");
                    const strength = calculatePasswordStrength(password);
                    passwordStrengthBar.className = "password-strength-bar " + strength;
                    if (strength === "weak") {
                        passwordStrengthText.textContent = "Weak";
                        passwordStrengthText.className = "text-xs font-medium text-red-600";
                    } else if (strength === "medium") {
                        passwordStrengthText.textContent = "Medium";
                        passwordStrengthText.className = "text-xs font-medium text-yellow-600";
                    } else {
                        passwordStrengthText.textContent = "Strong";
                        passwordStrengthText.className = "text-xs font-medium text-green-600";
                    }
                } else {
                    passwordStrengthContainer.classList.add("hidden");
                }
                newPasswordError.classList.add("hidden");
                this.classList.remove("border-red-500");
                if (confirmNewPasswordInput.value) {
                    validateConfirmPassword();
                }
            });

            function validateConfirmPassword() {
                const password = newPasswordInput.value;
                const confirmPassword = confirmNewPasswordInput.value;
                if (!confirmPassword) {
                    confirmNewPasswordError.classList.add("hidden");
                    confirmNewPasswordSuccess.classList.add("hidden");
                    confirmNewPasswordInput.classList.remove(
                        "border-red-500",
                        "border-green-500",
                    );
                    return;
                }
                if (password !== confirmPassword) {
                    confirmNewPasswordError.classList.remove("hidden");
                    confirmNewPasswordSuccess.classList.add("hidden");
                    confirmNewPasswordError.innerHTML =
                        '<i class="ri-error-warning-fill"></i><span>Passwords do not match</span>';
                    confirmNewPasswordInput.classList.add("border-red-500");
                    confirmNewPasswordInput.classList.remove("border-green-500");
                } else {
                    confirmNewPasswordError.classList.add("hidden");
                    confirmNewPasswordSuccess.classList.remove("hidden");
                    confirmNewPasswordSuccess.innerHTML =
                        '<i class="ri-checkbox-circle-fill"></i><span>Passwords match</span>';
                    confirmNewPasswordInput.classList.remove("border-red-500");
                    confirmNewPasswordInput.classList.add("border-green-500");
                }
            }
            confirmNewPasswordInput.addEventListener("input", validateConfirmPassword);
            passwordForm.addEventListener("submit", function(e) {
                e.preventDefault();
                const password = newPasswordInput.value;
                const confirmPassword = confirmNewPasswordInput.value;
                let isValid = true;
                if (!password) {
                    newPasswordError.classList.remove("hidden");
                    newPasswordError.innerHTML =
                        '<i class="ri-error-warning-fill"></i><span>Please enter a new password</span>';
                    newPasswordInput.classList.add("border-red-500");
                    isValid = false;
                } else if (!validatePassword(password)) {
                    newPasswordError.classList.remove("hidden");
                    newPasswordError.innerHTML =
                        '<i class="ri-error-warning-fill"></i><span>Password does not meet all requirements</span>';
                    newPasswordInput.classList.add("border-red-500");
                    isValid = false;
                }
                if (!confirmPassword) {
                    confirmNewPasswordError.classList.remove("hidden");
                    confirmNewPasswordSuccess.classList.add("hidden");
                    confirmNewPasswordError.innerHTML =
                        '<i class="ri-error-warning-fill"></i><span>Please confirm your password</span>';
                    confirmNewPasswordInput.classList.add("border-red-500");
                    isValid = false;
                } else if (password !== confirmPassword) {
                    confirmNewPasswordError.classList.remove("hidden");
                    confirmNewPasswordSuccess.classList.add("hidden");
                    confirmNewPasswordError.innerHTML =
                        '<i class="ri-error-warning-fill"></i><span>Passwords do not match</span>';
                    confirmNewPasswordInput.classList.add("border-red-500");
                    isValid = false;
                }
                if (isValid) {
                    resetPasswordBtn.innerHTML =
                        '<i class="ri-loader-4-line text-lg animate-spin"></i><span>Resetting Password...</span>';
                    resetPasswordBtn.disabled = true;
                    setTimeout(function() {
                        stepCircle2.classList.remove("active");
                        stepCircle2.classList.add("completed");
                        stepCircle2.innerHTML = '<i class="ri-check-line text-lg"></i>';
                        stepLine2.classList.add("completed");
                        stepCircle3.classList.remove("inactive");
                        stepCircle3.classList.add("completed");
                        stepText2.classList.remove("text-primary");
                        stepText2.classList.add("text-secondary");
                        stepText3.classList.remove("text-gray-400");
                        stepText3.classList.add("text-secondary");
                        step2Password.classList.add("hidden");
                        step3Success.classList.remove("hidden");
                        startRedirectTimer();
                    }, 1500);
                }
            });
            cancelReset.addEventListener("click", function() {
                window.location.href = "login.html";
            });
        });

        function startRedirectTimer() {
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
        }
    </script>
</body>

</html>