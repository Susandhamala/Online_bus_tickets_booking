document.addEventListener('DOMContentLoaded', function() {
    // Form validation for login
    const loginForm = document.querySelector('form[action="login.php"]');

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (email === '' || password === '') {
                alert('Please fill in both email and password.');
                event.preventDefault();
            } else {
                // Additional validation can be added here
                console.log('Form is valid.');
            }
        });
    }

});
