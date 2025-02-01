class FlightBooking {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector);
        if (this.form) {
            this.form.addEventListener("submit", (event) => this.handleBooking(event));
        }
        this.checkRedirectAfterLogin();
    }

    checkRedirectAfterLogin() {
        document.addEventListener("DOMContentLoaded", () => {
            const redirectUrl = sessionStorage.getItem("redirectAfterLogin");
            if (redirectUrl) {
                sessionStorage.removeItem("redirectAfterLogin");
                window.location.href = redirectUrl;
            }
        });
    }

    async handleBooking(event) {
        event.preventDefault();

        const loggedIn = await this.isUserLoggedIn();
        if (!loggedIn) {
            sessionStorage.setItem("redirectAfterLogin", window.location.href);
            alert("Ju lutem kyçuni për të bërë rezervimin e biletës.");
            window.location.href = "../login.php";
            return;
        }

        const bookingDetails = this.getBookingDetails();
        if (!bookingDetails) {
            alert('Please fill in all required fields.');
            return;
        }

        localStorage.setItem('bookingDetails', JSON.stringify(bookingDetails));
        alert(`✅ Reservation successful for ${bookingDetails.firstName} ${bookingDetails.lastName} to ${bookingDetails.destination} from ${bookingDetails.departureDate} to ${bookingDetails.returnDate || "one-way"} in ${bookingDetails.travelClass} class.`);
    }

    async isUserLoggedIn() {
        try {
            const response = await fetch("../check_login_status.php");
            const data = await response.json();
            return data.loggedIn;
        } catch (error) {
            console.error("Gabim gjatë kontrollit të sesionit:", error);
            return false;
        }
    }

    getBookingDetails() {
        const destinationName = document.title.split(" - ")[0].trim();
        const firstName = document.querySelector('#first-name')?.value;
        const lastName = document.querySelector('#last-name')?.value;
        const email = document.querySelector('#email')?.value;
        const phoneNumber = document.querySelector('#phone')?.value;
        const departureDate = document.querySelector('#departure-date')?.value;
        const returnDate = document.querySelector('#return-date')?.value || null;
        const travelClass = document.querySelector('input[name="travel_class"]:checked')?.value;

        if (!firstName || !lastName || !email || !phoneNumber || !departureDate || !travelClass) {
            return null;
        }

        return {
            firstName,
            lastName,
            email,
            phoneNumber,
            departureDate,
            returnDate,
            travelClass,
            destination: destinationName
        };
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new FlightBooking("form");
});
