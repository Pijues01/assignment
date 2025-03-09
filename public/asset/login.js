function toggleSignup() {
    document.getElementById("login-toggle").style.backgroundColor = "#fff";
    document.getElementById("login-toggle").style.color = "#222";
    document.getElementById("signup-toggle").style.backgroundColor = "#3c91e6";
    document.getElementById("signup-toggle").style.color = "#fff";
    document.getElementById("login-form").style.display = "none";
    document.getElementById("signup-form").style.display = "block";
}

function toggleLogin() {
    document.getElementById("login-toggle").style.backgroundColor = "#3c91e6";
    document.getElementById("login-toggle").style.color = "#fff";
    document.getElementById("signup-toggle").style.backgroundColor = "#fff";
    document.getElementById("signup-toggle").style.color = "#222";
    document.getElementById("signup-form").style.display = "none";
    document.getElementById("login-form").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");

    // Login Form Validation
    loginForm.addEventListener("submit", function (event) {

        let valid = true;

        const loginUsername = document.getElementById("login-username");
        const loginPassword = document.getElementById("login-password");

        document.getElementById("login-username-error").innerText = "";
        document.getElementById("login-password-error").innerText = "";

        if (loginUsername.value.trim() === "") {
            document.getElementById("login-username-error").innerText =
                "Email is required.";
            valid = false;
        }

        if (loginPassword.value.length < 6) {
            document.getElementById("login-password-error").innerText =
                "Password must be at least 6 characters.";
            valid = false;
        }

        if (!valid) event.preventDefault();
    });

    // Signup Form Validation
    signupForm.addEventListener("submit", function (event) {
        let valid = true;

        const username = document.getElementById("signup-username");
        const email = document.getElementById("signup-email");
        const phone = document.getElementById("signup-phone");
        const password = document.getElementById("signup-password");
        const confirmPassword = document.getElementById(
            "signup-confirm-password"
        );

        document.getElementById("signup-username-error").innerText = "";
        document.getElementById("signup-email-error").innerText = "";
        document.getElementById("signup-phone-error").innerText = "";
        document.getElementById("signup-password-error").innerText = "";
        document.getElementById("signup-confirm-password-error").innerText = "";

        if (
            username.value.trim().length < 4 ||
            username.value.trim().length > 20
        ) {
            document.getElementById("signup-username-error").innerText =
                "Username must be 4-20 characters.";
            valid = false;
        }

        if (
            !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(
                email.value
            )
        ) {
            document.getElementById("signup-email-error").innerText =
                "Enter a valid email.";
            valid = false;
        }

        if (!/^[6-9]\d{9}$/.test(phone.value)) {
            document.getElementById("signup-phone-error").innerText =
                "Enter a valid 10-digit mobile number.";
            valid = false;
        }

        if (password.value.length < 6) {
            document.getElementById("signup-password-error").innerText =
                "Password must be at least 6 characters.";
            valid = false;
        }

        if (password.value !== confirmPassword.value) {
            document.getElementById("signup-confirm-password-error").innerText =
                "Passwords do not match.";
            valid = false;
        }

        if (!valid) event.preventDefault();
    });

    // Image Preview for Profile Picture
    document
        .getElementById("profile-picture")
        .addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById("preview-image").src =
                        e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
});
