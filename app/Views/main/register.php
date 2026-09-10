<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OSG Employee Registration</title>
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
    </style>
</head>

<body class="bg-gray-50">
    <div class="w-full max-w-[1080px] mx-auto bg-white min-h-screen relative">
        <header class="fixed top-0 w-full max-w-[1080px] bg-white z-50 shadow-sm">
            <div class="flex items-center justify-between px-5 py-4 h-16">
                <div class="font-['Pacifico'] text-2xl text-primary">
                    <img src="http://localhost/osgparkingsystem/public/img/logo/OSG CAR PARK.png" style="height: 60px;">
                </div>
                <!-- <div class="flex items-center gap-4">
                    <div
                        class="w-10 h-10 flex items-center justify-center cursor-pointer">
                        <i class="ri-notification-3-line text-2xl text-gray-700"></i>
                    </div>
                    <div
                        class="w-10 h-10 flex items-center justify-center cursor-pointer"
                        id="menu-button">
                        <i class="ri-menu-line text-2xl text-gray-700"></i>
                    </div>
                </div> -->
            </div>
            <!-- <div
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
        <main class="pt-20 pb-8 px-5">
            <div class="mb-8">
                <div
                    class="w-20 h-20 flex items-center justify-center bg-gradient-to-br from-primary to-blue-600 rounded-2xl mx-auto mb-6 shadow-lg">
                    <i class="ri-user-add-line text-4xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 text-center mb-2">
                    Account Registration
                </h1>
                <p class="text-base text-gray-600 text-center">
                    Enter your OSG Employee details
                </p>
            </div>
            <form id="registration-form" class="space-y-5">
                <div>
                    <label
                        for="osg-email"
                        class="block text-sm font-semibold text-gray-900 mb-2">OSG Email Address</label>
                    <div class="input-wrapper">
                        <div class="input-icon w-5 h-5 flex items-center justify-center">
                            <i class="ri-mail-line text-lg text-gray-500"></i>
                        </div>
                        <input
                            type="email"
                            id="osg-email"
                            class="input-with-icon w-full h-12 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                            placeholder="employee@osg.gov.ph" />
                    </div>
                    <div id="email-validation" class="validation-message hidden"></div>
                </div>
                <div>
                    <label
                        for="employee-number"
                        class="block text-sm font-semibold text-gray-900 mb-2">Employee Number</label>
                    <div class="input-wrapper">
                        <div class="input-icon w-5 h-5 flex items-center justify-center">
                            <i class="ri-hashtag text-lg text-gray-500"></i>
                        </div>
                        <input
                            type="text"
                            id="employee-number"
                            class="input-with-icon w-full h-12 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                            placeholder="2026-01001" />
                    </div>
                    <div id="empnum-validation" class="validation-message hidden"></div>
                </div>
                <!-- <div>
                    <label
                        for="username"
                        class="block text-sm font-semibold text-gray-900 mb-2">Username</label>
                    <div class="input-wrapper">
                        <div class="input-icon w-5 h-5 flex items-center justify-center">
                            <i class="ri-user-line text-lg text-gray-500"></i>
                        </div>
                        <input
                            type="text"
                            id="username"
                            class="input-with-icon w-full h-12 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                            placeholder="michaelanderson" />
                    </div>
                    <div
                        id="username-validation"
                        class="validation-message hidden"></div>
                </div> -->
                <div>
                    <label
                        for="password"
                        class="block text-sm font-semibold text-gray-900 mb-2">Password</label>
                    <div class="input-wrapper">
                        <div class="input-icon w-5 h-5 flex items-center justify-center">
                            <i class="ri-lock-line text-lg text-gray-500"></i>
                        </div>
                        <input
                            type="password"
                            id="password"
                            class="input-with-icon w-full h-12 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all pr-12"
                            placeholder="Enter your password" />
                        <div
                            class="input-action-icon w-5 h-5 flex items-center justify-center password-toggle cursor-pointer"
                            id="toggle-password">
                            <i class="ri-eye-off-line text-lg text-gray-500"></i>
                        </div>
                    </div>
                    <div
                        id="password-validation"
                        class="validation-message hidden"></div>
                </div>
                <div>
                    <label
                        for="confirm-password"
                        class="block text-sm font-semibold text-gray-900 mb-2">Confirm Password</label>
                    <div class="input-wrapper">
                        <div class="input-icon w-5 h-5 flex items-center justify-center">
                            <i class="ri-lock-line text-lg text-gray-500"></i>
                        </div>
                        <input
                            type="password"
                            id="confirm-password"
                            class="input-with-icon w-full h-12 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all pr-12"
                            placeholder="Re-enter your password" />
                        <div
                            class="input-action-icon w-5 h-5 flex items-center justify-center password-toggle cursor-pointer"
                            id="toggle-confirm-password">
                            <i class="ri-eye-off-line text-lg text-gray-500"></i>
                        </div>
                    </div>
                    <div
                        id="confirm-password-validation"
                        class="validation-message hidden"></div>
                </div>
                <div
                    class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-start gap-3">
                    <div
                        class="w-5 h-5 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="ri-information-line text-lg text-primary"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-700 leading-relaxed">
                            Password must be at least 8 characters long and contain
                            uppercase, lowercase, numbers, and special characters.
                        </p>
                    </div>
                </div>
                <div class="pt-2">
                    <button
                        type="submit"
                        id="submit-btn"
                        class="w-full h-12 bg-primary text-white font-semibold text-sm !rounded-button shadow-lg hover:bg-blue-700 transition-all cursor-pointer flex items-center justify-center gap-2">
                        <span>Create Account</span>
                        <i class="ri-arrow-right-line text-lg"></i>
                    </button>
                    <button
                        type="button"
                        id="cancel-btn"
                        class="w-full h-12 bg-white border-2 border-gray-200 text-gray-700 font-semibold text-sm !rounded-button hover:bg-gray-50 transition-all cursor-pointer mt-3">
                        Cancel
                    </button>
                </div>
                <div class="pt-4 text-center">
                    <p class="text-xs text-gray-600">
                        By creating an account, you agree to our
                    </p>
                    <a
                        href="#"
                        class="text-xs text-primary font-medium hover:underline cursor-pointer">Privacy Policy and Terms of Service</a>
                </div>
            </form>
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-center text-sm text-gray-600 mb-4">
                    Already have an account?
                </p>
                <button
                    class="w-full h-12 bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 text-gray-900 font-semibold text-sm !rounded-button hover:from-gray-100 hover:to-gray-200 transition-all cursor-pointer flex items-center justify-center gap-2">
                    <i class="ri-login-box-line text-lg"></i>
                    <span>Sign In</span>
                </button>
            </div>
        </main>
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
    <script id="password-toggle">
        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.getElementById("toggle-password");
            const passwordInput = document.getElementById("password");
            const toggleConfirmPassword = document.getElementById(
                "toggle-confirm-password",
            );
            const confirmPasswordInput = document.getElementById("confirm-password");
            togglePassword.addEventListener("click", function() {
                const type =
                    passwordInput.getAttribute("type") === "password" ? "text" : "password";
                passwordInput.setAttribute("type", type);
                const icon = this.querySelector("i");
                if (type === "text") {
                    icon.classList.remove("ri-eye-off-line");
                    icon.classList.add("ri-eye-line");
                } else {
                    icon.classList.remove("ri-eye-line");
                    icon.classList.add("ri-eye-off-line");
                }
            });
            toggleConfirmPassword.addEventListener("click", function() {
                const type =
                    confirmPasswordInput.getAttribute("type") === "password" ?
                    "text" :
                    "password";
                confirmPasswordInput.setAttribute("type", type);
                const icon = this.querySelector("i");
                if (type === "text") {
                    icon.classList.remove("ri-eye-off-line");
                    icon.classList.add("ri-eye-line");
                } else {
                    icon.classList.remove("ri-eye-line");
                    icon.classList.add("ri-eye-off-line");
                }
            });
        });
    </script>
    <script id="form-validation">
        document.addEventListener("DOMContentLoaded", function() {
            const emailInput = document.getElementById("osg-email");
            const empNumInput = document.getElementById("employee-number");
            const usernameInput = document.getElementById("username");
            const passwordInput = document.getElementById("password");
            const confirmPasswordInput = document.getElementById("confirm-password");
            const emailValidation = document.getElementById("email-validation");
            const empNumValidation = document.getElementById("empnum-validation");
            const usernameValidation = document.getElementById("username-validation");
            const passwordValidation = document.getElementById("password-validation");
            const confirmPasswordValidation = document.getElementById(
                "confirm-password-validation",
            );

            function showValidation(element, message, isError) {
                element.classList.remove("hidden");
                element.classList.remove("error", "success");
                element.classList.add(isError ? "error" : "success");
                element.innerHTML = `<i class="ri-${isError ? "error-warning" : "checkbox-circle"}-fill"></i><span>${message}</span>`;
            }

            function hideValidation(element) {
                element.classList.add("hidden");
            }

            function validateEmail(email) {
                const osgPattern = /^[a-zA-Z0-9._%+-]+@osg\.gov\.ph$/;
                return osgPattern.test(email);
            }

            function validateEmployeeNumber(empNum) {
                const pattern = /^\d{4}-\d{5}$/;
                return pattern.test(empNum);
            }

            function validateUsername(username) {
                return (
                    username.length >= 4 &&
                    username.length <= 20 &&
                    /^[a-zA-Z0-9_]+$/.test(username)
                );
            }

            function validatePassword(password) {
                const minLength = password.length >= 8;
                const hasUpperCase = /[A-Z]/.test(password);
                const hasLowerCase = /[a-z]/.test(password);
                const hasNumber = /[0-9]/.test(password);
                const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
                return (
                    minLength && hasUpperCase && hasLowerCase && hasNumber && hasSpecialChar
                );
            }
            emailInput.addEventListener("blur", function() {
                const value = this.value.trim();
                if (value === "") {
                    hideValidation(emailValidation);
                } else if (!validateEmail(value)) {
                    showValidation(
                        emailValidation,
                        "Please enter a valid OSG email address (@osg.gov.ph)",
                        true,
                    );
                } else {
                    showValidation(emailValidation, "Valid OSG email address", false);
                }
            });
            emailInput.addEventListener("input", function() {
                if (this.value.trim() === "") {
                    hideValidation(emailValidation);
                }
            });
            empNumInput.addEventListener("blur", function() {
                const value = this.value.trim();
                if (value === "") {
                    hideValidation(empNumValidation);
                } else if (!validateEmployeeNumber(value)) {
                    showValidation(
                        empNumValidation,
                        "Format must be YYYY-NNNNN (e.g., 2008-11092)",
                        true,
                    );
                } else {
                    showValidation(empNumValidation, "Valid employee number", false);
                }
            });
            empNumInput.addEventListener("input", function() {
                if (this.value.trim() === "") {
                    hideValidation(empNumValidation);
                }
            });
            usernameInput.addEventListener("blur", function() {
                const value = this.value.trim();
                if (value === "") {
                    hideValidation(usernameValidation);
                } else if (!validateUsername(value)) {
                    showValidation(
                        usernameValidation,
                        "Username must be 4-20 characters (letters, numbers, underscore)",
                        true,
                    );
                } else {
                    showValidation(usernameValidation, "Username is available", false);
                }
            });
            usernameInput.addEventListener("input", function() {
                if (this.value.trim() === "") {
                    hideValidation(usernameValidation);
                }
            });
            passwordInput.addEventListener("blur", function() {
                const value = this.value;
                if (value === "") {
                    hideValidation(passwordValidation);
                } else if (!validatePassword(value)) {
                    showValidation(
                        passwordValidation,
                        "Password does not meet requirements",
                        true,
                    );
                } else {
                    showValidation(passwordValidation, "Strong password", false);
                }
                if (confirmPasswordInput.value !== "") {
                    validateConfirmPassword();
                }
            });
            passwordInput.addEventListener("input", function() {
                if (this.value === "") {
                    hideValidation(passwordValidation);
                }
                if (confirmPasswordInput.value !== "") {
                    validateConfirmPassword();
                }
            });

            function validateConfirmPassword() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                if (confirmPassword === "") {
                    hideValidation(confirmPasswordValidation);
                } else if (password !== confirmPassword) {
                    showValidation(confirmPasswordValidation, "Passwords do not match", true);
                } else {
                    showValidation(confirmPasswordValidation, "Passwords match", false);
                }
            }
            confirmPasswordInput.addEventListener("blur", validateConfirmPassword);
            confirmPasswordInput.addEventListener("input", function() {
                if (this.value === "") {
                    hideValidation(confirmPasswordValidation);
                } else {
                    validateConfirmPassword();
                }
            });
        });
    </script>
    <script id="form-submission">
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("registration-form");
            const cancelBtn = document.getElementById("cancel-btn");
            form.addEventListener("submit", function(e) {
                e.preventDefault();
                const emailInput = document.getElementById("osg-email");
                const empNumInput = document.getElementById("employee-number");
                const usernameInput = document.getElementById("username");
                const passwordInput = document.getElementById("password");
                const confirmPasswordInput = document.getElementById("confirm-password");
                let isValid = true;
                const emailValue = emailInput.value.trim();
                const empNumValue = empNumInput.value.trim();
                const usernameValue = usernameInput.value.trim();
                const passwordValue = passwordInput.value;
                const confirmPasswordValue = confirmPasswordInput.value;
                if (
                    emailValue === "" ||
                    empNumValue === "" ||
                    usernameValue === "" ||
                    passwordValue === "" ||
                    confirmPasswordValue === ""
                ) {
                    isValid = false;
                }
                const osgPattern = /^[a-zA-Z0-9._%+-]+@osg\.gov\.ph$/;
                if (!osgPattern.test(emailValue)) {
                    isValid = false;
                }
                const empPattern = /^\d{4}-\d{5}$/;
                if (!empPattern.test(empNumValue)) {
                    isValid = false;
                }
                if (
                    usernameValue.length < 4 ||
                    usernameValue.length > 20 ||
                    !/^[a-zA-Z0-9_]+$/.test(usernameValue)
                ) {
                    isValid = false;
                }
                const minLength = passwordValue.length >= 8;
                const hasUpperCase = /[A-Z]/.test(passwordValue);
                const hasLowerCase = /[a-z]/.test(passwordValue);
                const hasNumber = /[0-9]/.test(passwordValue);
                const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(passwordValue);
                if (
                    !(
                        minLength &&
                        hasUpperCase &&
                        hasLowerCase &&
                        hasNumber &&
                        hasSpecialChar
                    )
                ) {
                    isValid = false;
                }
                if (passwordValue !== confirmPasswordValue) {
                    isValid = false;
                }
                if (isValid) {
                    const submitBtn = document.getElementById("submit-btn");
                    submitBtn.innerHTML =
                        '<i class="ri-loader-4-line text-lg animate-spin"></i><span>Creating Account...</span>';
                    submitBtn.disabled = true;
                    setTimeout(function() {
                        window.location.href = "dashboard.html";
                    }, 2000);
                }
            });
            cancelBtn.addEventListener("click", function() {
                window.history.back();
            });
        });
    </script>
</body>

</html>