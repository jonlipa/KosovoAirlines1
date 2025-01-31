class LoginFormValidator {
    constructor(formId) {
        this.form = document.getElementById(formId);
        this.usernameField = this.form.querySelector('#username');
        this.passwordField = this.form.querySelector('#password');
        this.errorMessage = this.form.querySelector('#error-message');

        this.init();
    }

    init() {
        if (this.form) {
            this.form.addEventListener('submit', (event) => this.validateForm(event));
        }
    }

    validateForm(event) {
        event.preventDefault(); // Ndalo dërgimin e formës për validim në front-end

        const username = this.usernameField.value.trim();
        const password = this.passwordField.value.trim();

        if (!username || !password) {
            this.showError('All fields are required.');
        } else if (password.length < 4) {
            this.showError('Password must be at least 4 characters long.');
        } else {
            this.clearError();
            this.form.submit(); // Nëse gjithçka është në rregull, dërgo formën në back-end
        }
    }

    showError(message) {
        if (this.errorMessage) {
            this.errorMessage.textContent = message;
            this.errorMessage.style.display = 'block'; // Bëje të dukshëm
        } else {
            console.error("Error: Elementi #error-message nuk u gjet!");
        }
    }

    clearError() {
        if (this.errorMessage) {
            this.errorMessage.textContent = '';
            this.errorMessage.style.display = 'none'; // Fshih kur nuk ka gabim
        }
    }
}

// Inicializimi i klasës për validimin e formës së login-it
document.addEventListener('DOMContentLoaded', () => {
    new LoginFormValidator('loginForm');
});
