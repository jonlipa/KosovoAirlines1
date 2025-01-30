document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const username = document.getElementById('reg-username').value.trim();
    const email = document.getElementById('reg-email').value.trim();
    const password = document.getElementById('reg-password').value.trim();
    const confirmPassword = document.getElementById('reg-confirm-password').value.trim();
    const errorMessage = document.getElementById('register-error-message');
    const successMessage = document.getElementById('register-success-message');

    if (!username || !email || !password || !confirmPassword) {
        errorMessage.textContent = 'All fields are required.';
        successMessage.textContent = '';
    } else if (password !== confirmPassword) {
        errorMessage.textContent = 'Passwords do not match.';
        successMessage.textContent = '';
    } else if (password.length < 6) {
        errorMessage.textContent = 'Password must be at least 6 characters long.';
        successMessage.textContent = '';
    } else {
        errorMessage.textContent = '';
        successMessage.innerHTML = 'Registration successful! <a href="login.html">Go to Login</a>';
    }
});
