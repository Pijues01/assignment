<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assignments</title>
    <link rel="stylesheet" href="asset/login.css">
    <style>
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: -10px;
            display: block;
        }
    </style>
</head>

<body>
    <div style="text-align:center">
        <h1><u>Assignments</u></h1>
        <h3><u>Admin Login/Signup</u></h3>
    </div>
    <div class="form-modal">

        <div class="form-toggle">
            <button id="login-toggle" onclick="toggleLogin()">log in</button>
            <button id="signup-toggle" onclick="toggleSignup()">sign up</button>
        </div>

        <div id="login-form">
            <form id="loginForm" action="{{ route('loginuser') }}" method="post">
                @csrf
                <input type="text" id="login-username" placeholder="Enter email or username" name="email"  />
                <span class="error-message" id="login-username-error"></span>

                <input type="password" id="login-password" placeholder="Enter password" name="password"  minlength="6" />
                <span class="error-message" id="login-password-error"></span>

                <button type="submit" class="btn login">Login</button>
                <hr />
            </form>
        </div>

        <div id="signup-form">
            <form id="signupForm" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="image-upload-container">
                    <label for="profile-picture" class="file-upload-btn">
                        Choose Profile Picture
                        <input type="file" id="profile-picture" name="profileimg" accept="image/*">
                    </label>
                    <div class="image-preview">
                        <img id="preview-image" src="" alt="Profile Picture">
                    </div>
                </div>

                <input type="text" id="signup-username" placeholder="Choose username" name="username"  minlength="4" maxlength="20">
                <span class="error-message" id="signup-username-error"></span>

                <input type="email" id="signup-email" placeholder="Enter your email" name="email" >
                <span class="error-message" id="signup-email-error"></span>

                <input type="tel" id="signup-phone" name="phone" class="form-control" pattern="[6-9]\d{9}" maxlength="10" minlength="10"
                    placeholder="Mobile no." >
                <span class="error-message" id="signup-phone-error"></span>

                <input type="password" id="signup-password" placeholder="Create password" name="password"  minlength="6">
                <span class="error-message" id="signup-password-error"></span>

                <input type="password" id="signup-confirm-password" placeholder="Confirm password" name="password_confirmation" >
                <span class="error-message" id="signup-confirm-password-error"></span>

                <button type="submit" class="btn signup">Create Account</button>
            </form>
        </div>

    </div>
    <script src="asset/login.js"></script>

    <script>
        document.getElementById("profile-picture").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById("preview-image");
                    img.src = e.target.result;
                    img.style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>
