<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - OSG Car Parking Management System</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
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

        .error-message {
            display: none;
            animation: slideDown 0.3s ease-out;
        }

        .error-message.show {
            display: flex;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .input-error {
            border-color: #EF4444 !important;
        }

        .fade-in {
            animation: fadeIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px white inset !important;
            -webkit-text-fill-color: #111827 !important;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-green-50">
    <div class="w-full max-w-[420px] mx-auto min-h-screen flex flex-col">
        <header class="pt-12 pb-8 px-6">
            <div class="font-['Pacifico'] text-3xl text-primary text-center drop-shadow-sm">
                <div class="flex flex-1 items-center justify-center">
                    <img src=" http://localhost/osgparkingsystem/public/img/logo/OSG CAR PARK.png" style="height: 100px;">
                </div>
            </div>
        </header>
        <main class="flex-1 flex items-center justify-center px-6 pb-10">
            <div class="w-full fade-in">
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl shadow-primary/5 p-8 mb-6 border border-gray-100">
                    <div class="text-center mb-8">
                        <!-- <div class="w-16 h-16 bg-gradient-to-br from-primary to-blue-600 rounded-2xl mx-auto mb-4 flex items-center justify-center shadow-lg shadow-primary/30">
                            <i class="ri-shield-user-line text-white text-3xl"></i>
                        </div> -->
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent mb-2">Welcome Back</h1>
                        <p class="text-sm text-gray-500">Sign in to continue to your dashboard</p>
                    </div>
                    <div id="general-error" class="error-message items-center gap-3 bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-xl mb-5 <?= session()->getFlashdata('error') ? 'show' : '' ?>">
                        <div class="w-6 h-6 flex items-center justify-center bg-red-100 rounded-full flex-shrink-0">
                            <i class="ri-error-warning-line text-base"></i>
                        </div>
                        <p class="text-sm flex-1 font-medium"><?= session()->getFlashdata('error') ?? '' ?></p>
                    </div>




                    <!-- LOGIN FORM -->
                    <form id="login-form" class="space-y-5">
                        <div>
                            <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username or Email</label>
                            <div class="relative group">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 flex items-center justify-center text-gray-400 group-focus-within:text-primary transition-colors">
                                    <i class="ri-user-line text-lg"></i>
                                </div>
                                <input type="text" id="username" name="username" placeholder="Enter your username or email" class="w-full h-14 pl-12 pr-4 bg-gray-50 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-0 focus:bg-white focus:border-primary transition-all placeholder:text-gray-400">
                            </div>
                            <p id="username-error" class="error-message text-xs text-red-600 mt-2 gap-1.5 items-center">
                                <i class="ri-error-warning-fill"></i>
                                <span></span>
                            </p>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <div class="relative group">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 flex items-center justify-center text-gray-400 group-focus-within:text-primary transition-colors">
                                    <i class="ri-lock-line text-lg"></i>
                                </div>
                                <input type="password" id="password" name="password" placeholder="Enter your password" class="w-full h-14 pl-12 pr-14 bg-gray-50 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-0 focus:bg-white focus:border-primary transition-all placeholder:text-gray-400">
                                <button type="button" id="toggle-password" class="absolute right-4 top-1/2 transform -translate-y-1/2 w-8 h-8 flex items-center justify-center text-gray-400 hover:text-primary hover:bg-gray-100 rounded-lg transition-all cursor-pointer">
                                    <i class="ri-eye-line text-lg"></i>
                                </button>
                            </div>
                            <p id="password-error" class="error-message text-xs text-red-600 mt-2 gap-1.5 items-center">
                                <i class="ri-error-warning-fill"></i>
                                <span></span>
                            </p>
                        </div>
                        <div class="flex items-center justify-between pt-1">
                            <label class="flex items-center gap-2.5 cursor-pointer group">
                                <div class="relative">
                                    <input type="checkbox" id="remember-me" class="sr-only peer">
                                    <div class="w-5 h-5 border-2 border-gray-300 rounded-md peer-checked:bg-primary peer-checked:border-primary transition-all flex items-center justify-center group-hover:border-primary">
                                        <i class="ri-check-line text-white text-sm font-bold opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-600 font-medium group-hover:text-gray-900 transition-colors">Remember me</span>
                            </label>
                            <a href="#" class="text-sm font-semibold text-primary hover:text-blue-700 hover:underline transition-all">Forgot Password?</a>
                        </div>
                        <button type="submit" id="submit-btn" class="w-full h-14 bg-gradient-to-r from-primary to-blue-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-primary/30 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2 whitespace-nowrap !rounded-xl mt-6">
                            <span>Sign In</span>
                            <i class="ri-arrow-right-line text-lg"></i>
                        </button>
                    </form>
                    <!-- <div class="mt-6 flex items-center">
                        <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                        <span class="px-4 text-xs font-medium text-gray-400">OR</span>
                        <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <button type="button" class="h-12 border-2 border-gray-200 rounded-xl hover:border-gray-300 hover:bg-gray-50 transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                            <i class="ri-google-fill text-xl text-red-500"></i>
                            <span class="text-sm font-medium text-gray-700">Google</span>
                        </button>
                        <button type="button" class="h-12 border-2 border-gray-200 rounded-xl hover:border-gray-300 hover:bg-gray-50 transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                            <i class="ri-apple-fill text-xl text-gray-900"></i>
                            <span class="text-sm font-medium text-gray-700">Apple</span>
                        </button>
                    </div> -->
                </div>
                <!-- <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">Don't have an account? <a href="#" class="font-semibold text-primary hover:text-blue-700 hover:underline transition-all">Sign Up</a></p>
                </div> -->
            </div>
        </main>
        <footer class="py-8 px-6">
            <div class="flex flex-wrap items-center justify-center gap-5 text-xs text-gray-500 mb-3 font-medium">
                <a href="#" class="hover:text-primary transition-colors">Terms of Service</a>
                <span class="text-gray-300">•</span>
                <a href="#" class="hover:text-primary transition-colors">Privacy Policy</a>
                <span class="text-gray-300">•</span>
                <a href="#" class="hover:text-primary transition-colors">Help & Support</a>
            </div>
            <p class="text-xs text-gray-400 text-center font-medium">© 2026 Car Park Management System. All rights reserved.</p>
        </footer>
    </div>
    <script id="form-validation">
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("login-form");
            const usernameInput = document.getElementById("username");
            const passwordInput = document.getElementById("password");
            const usernameError = document.getElementById("username-error");
            const passwordError = document.getElementById("password-error");
            const generalError = document.getElementById("general-error");
            const submitBtn = document.getElementById("submit-btn");

            // alert("Login form script loaded successfully!");
            // SetTimeout(() => {
            //     alert("Login form script executed successfully!");
            // }, 1000);

            function showError(element, message) {
                const errorSpan = element.querySelector("span");
                if (errorSpan) {
                    errorSpan.textContent = message;
                }
                element.classList.add("show");
            }

            function hideError(element) {
                element.classList.remove("show");
            }

            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            function validateUsername(username) {
                return username.length >= 3;
            }

            function validatePassword(password) {
                return password.length >= 6;
            }
            usernameInput.addEventListener("input", function() {
                if (this.value.trim()) {
                    this.classList.remove("input-error");
                    hideError(usernameError);
                }
            });
            passwordInput.addEventListener("input", function() {
                if (this.value.trim()) {
                    this.classList.remove("input-error");
                    hideError(passwordError);
                }
            });
            form.addEventListener("submit", function(e) {
                e.preventDefault();
                hideError(generalError);
                hideError(usernameError);
                hideError(passwordError);
                usernameInput.classList.remove("input-error");
                passwordInput.classList.remove("input-error");
                let isValid = true;
                const username = usernameInput.value.trim();
                const password = passwordInput.value.trim();
                if (!username) {
                    usernameInput.classList.add("input-error");
                    showError(usernameError, "Username or email is required");
                    isValid = false;
                } else if (!validateEmail(username) && !validateUsername(username)) {
                    usernameInput.classList.add("input-error");
                    showError(
                        usernameError,
                        "Please enter a valid email or username (min 3 characters)",
                    );
                    isValid = false;
                }
                if (!password) {
                    passwordInput.classList.add("input-error");
                    showError(passwordError, "Password is required");
                    isValid = false;
                } else if (!validatePassword(password)) {
                    passwordInput.classList.add("input-error");
                    showError(passwordError, "Password must be at least 6 characters");
                    isValid = false;
                }




                // IF THE LOGIN INFO / CREDENTIALS ARE VALID --------------------------------------------------------------
                if (isValid) {
                    submitBtn.innerHTML = '<i class="ri-loader-4-line text-xl animate-spin"></i><span>Signing In...</span>';
                    submitBtn.disabled = true;

                    // Submit the form natively to your CI4 backend Controller
                    form.method = 'POST';
                    form.action = '<?= base_url("authenticate") ?>'; // Update with your actual CI4 Route
                    form.submit();
                }
                // --------------------------------------------------------------------------------------------------------



            });
        });
    </script>
    <script id="password-toggle">
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById("toggle-password");
            const passwordInput = document.getElementById("password");
            toggleBtn.addEventListener("click", function() {
                const type = passwordInput.getAttribute("type");
                if (type === "password") {
                    passwordInput.setAttribute("type", "text");
                    this.innerHTML = '<i class="ri-eye-off-line text-lg"></i>';
                } else {
                    passwordInput.setAttribute("type", "password");
                    this.innerHTML = '<i class="ri-eye-line text-lg"></i>';
                }
            });
        });
    </script>
    <script id="checkbox-interaction">
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("remember-me");
            const checkboxContainer = checkbox.parentElement.querySelector("div");
            checkbox.addEventListener("change", function() {
                if (this.checked) {
                    checkboxContainer.classList.add("bg-primary", "border-primary");
                    checkboxContainer.classList.remove("border-gray-300");
                    checkboxContainer.querySelector("i").classList.remove("opacity-0");
                    checkboxContainer.querySelector("i").classList.add("opacity-100");
                } else {
                    checkboxContainer.classList.remove("bg-primary", "border-primary");
                    checkboxContainer.classList.add("border-gray-300");
                    checkboxContainer.querySelector("i").classList.add("opacity-0");
                    checkboxContainer.querySelector("i").classList.remove("opacity-100");
                }
            });
        });
    </script>
</body>

</html>