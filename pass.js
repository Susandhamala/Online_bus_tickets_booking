function isPasswordStrong(password) {
    const specialCharacters = /[!@#$%^&*(),.?":{}|<>]/;

    let message = "";

    if (password.length < 6) {
        message = "Password is too short. It must be at least 6 characters long.";
    } else if (!specialCharacters.test(password)) {
        message = "Password must contain at least one special character.";
    } else {
        message = "Password is strong enough.";
    }

    document.getElementById("message").innerText = message;
}

function checkPassword() {
    const password = document.getElementById("password").value;
    isPasswordStrong(password);
}

function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    const showPasswordCheckbox = document.getElementById("showPassword");

    if (showPasswordCheckbox.checked) {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}
