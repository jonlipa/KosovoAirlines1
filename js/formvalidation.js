class FormValidator {
    constructor(formId) {
        this.form = document.querySelector(`#${formId}`);

        if (this.form) {
            this.form.addEventListener('submit', (event) => this.validateForm(event));
        }

        // Kontrollon nëse përdoruesi është logout dhe parandalon kthimin mbrapa
        this.preventBackAfterLogout();
    }

    validateForm(event) {
        if (this.form.id === 'login-form') {
            this.validateLogin(event);
        } else if (this.form.id === 'registerForm') { // Korrigjuar ID
            this.validateRegister(event);
        }
    }

    validateLogin(event) {
        const username = this.form.querySelector('#username').value.trim();
        const password = this.form.querySelector('#password').value.trim();
        let valid = true;

        if (!username || !password) {
            valid = false;
            this.showAlert('Please fill in both fields.');
        }

        if (!valid) {
            event.preventDefault();
        }
    }

    validateRegister(event) {
        const email = this.form.querySelector('#reg-email').value.trim(); // Korrigjuar ID
        const password = this.form.querySelector('#reg-password').value.trim(); // Korrigjuar ID
        const confirmPassword = this.form.querySelector('#reg-confirm-password').value.trim(); // Korrigjuar ID
        let valid = true;

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email || !emailRegex.test(email)) {
            valid = false;
            this.showAlert('Please enter a valid email.');
        }

        if (password.length < 6) {
            valid = false;
            this.showAlert('Password must be at least 6 characters long.');
        }

        if (password !== confirmPassword) {
            valid = false;
            this.showAlert('Passwords do not match.');
        }

        if (!valid) {
            event.preventDefault();
        }
    }

    showAlert(message) {
        alert(message);
    }

    preventBackAfterLogout() {
        if (sessionStorage.getItem('loggedOut') === 'true') {
            sessionStorage.removeItem('loggedOut'); 
            window.location.href = "login.php";
        }

        window.onload = function() {
            history.replaceState(null, "", window.location.href);
            window.onpopstate = function() {
                history.go(1);
            };
        };
    }
}

// Inicimi i validimit për format
new FormValidator('login-form');
new FormValidator('registerForm'); // Përputh ID-në me atë në register.php
