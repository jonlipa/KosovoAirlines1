document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Ndalo dërgimin e formës për validim në front-end

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const errorMessage = document.getElementById('error-message');

    // Kontrollo boshllëqet dhe validimin e password-it
    if (!username || !password) {
        errorMessage.textContent = 'All fields are required.';
    } else if (password.length < 6) {
        errorMessage.textContent = 'Password must be at least 4 characters long.';
    } else {
        errorMessage.textContent = ''; // Pastrimi i mesazheve të gabimit
        e.target.submit(); // Dërgo formën në back-end
    }
});
