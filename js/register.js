class RegisterFormValidator {
    constructor(formId) {
        this.form = document.getElementById(formId);
        this.errorMessage = document.getElementById('register-error-message');
        this.successMessage = document.getElementById('register-success-message');

        if (this.form) {
            this.form.addEventListener('submit', (event) => this.validateForm(event));
        }
    }

    validateForm(event) {
        event.preventDefault();

        const email = this.form.querySelector('#reg-email').value.trim();
        const password = this.form.querySelector('#reg-password').value.trim();
        const confirmPassword = this.form.querySelector('#reg-confirm-password').value.trim();
        let valid = true;

        if (!email || !this.isValidEmail(email)) {
            valid = false;
            this.showError('Please enter a valid email.');
        }

        if (password.length < 6) {
            valid = false;
            this.showError('Password must be at least 6 characters long.');
        }

        if (password !== confirmPassword) {
            valid = false;
            this.showError('Passwords do not match.');
        }

        if (valid) {
            this.showSuccess('Registration successful! Redirecting to login...');
            setTimeout(() => {
                this.form.submit();
            }, 2000);
        }
    }

    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    showError(message) {
        if (this.errorMessage) {
            this.errorMessage.textContent = message;
            this.errorMessage.style.color = 'red';
        } else {
            console.error('Error element not found in DOM.');
        }
    }

    showSuccess(message) {
        if (this.successMessage) {
            this.successMessage.textContent = message;
            this.successMessage.style.color = 'green';
        } else {
            console.error('Success element not found in DOM.');
        }
    }
}

// Inicimi i validimit
new RegisterFormValidator('registerForm');
