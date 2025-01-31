class ContactForm {
    constructor(formId, messageId) {
        this.form = document.getElementById(formId);
        this.successMessage = document.getElementById(messageId);
        this.initEventListeners();
    }

    initEventListeners() {
        if (this.form) {
            this.form.addEventListener("submit", (event) => this.handleSubmit(event));
        }
    }

    handleSubmit(event) {
        event.preventDefault();
        
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const message = document.getElementById("message").value.trim();

        if (this.validateInputs(name, email, message)) {
            this.showSuccessMessage();
            setTimeout(() => {
                this.form.reset();
            }, 500);
        }
    }

    validateInputs(name, email, message) {
        if (name === "" || email === "" || message === "") {
            alert("Please fill in all fields before submitting.");
            return false;
        }
        return true;
    }

    showSuccessMessage() {
        if (this.successMessage) {
            this.successMessage.classList.remove("hidden");
            this.successMessage.style.display = "block";
            setTimeout(() => {
                this.successMessage.classList.add("hidden");
                this.successMessage.style.display = "none";
            }, 3000);
        }
    }
}

// Initialize the ContactForm class when the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    new ContactForm("contactForm", "successMessage");
});
