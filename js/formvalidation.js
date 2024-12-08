// Function to validate the login form
function validateLoginForm(event) {
    const username = document.querySelector('#username').value;
    const password = document.querySelector('#password').value;
    let valid = true;

    // Check if username and password are not empty
    if (!username || !password) {
        valid = false;
        alert('Please fill in both fields.');
    }

    // Prevent form submission if not valid
    if (!valid) {
        event.preventDefault();
    }
}

// Function to validate the registration form
function validateRegisterForm(event) {
    const email = document.querySelector('#email').value;
    const password = document.querySelector('#password').value;
    const confirmPassword = document.querySelector('#confirm-password').value;
    let valid = true;

    // Check if email is valid
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email || !emailRegex.test(email)) {
        valid = false;
        alert('Please enter a valid email.');
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        valid = false;
        alert('Passwords do not match.');
    }

    // Prevent form submission if not valid
    if (!valid) {
        event.preventDefault();
    }
}

// Add event listeners for form submissions
const loginForm = document.querySelector('#login-form');
if (loginForm) {
    loginForm.addEventListener('submit', validateLoginForm);
}

const registerForm = document.querySelector('#register-form');
if (registerForm) {
    registerForm.addEventListener('submit', validateRegisterForm);
}
