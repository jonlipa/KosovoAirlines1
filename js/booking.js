// Function to handle flight booking
function handleBooking(event) {
    event.preventDefault();

    // Kontrollo nëse përdoruesi është i kyçur (nga sessionStorage)
    const isLoggedIn = sessionStorage.getItem("loggedInUser");

    if (!isLoggedIn) {
        sessionStorage.setItem("redirectAfterLogin", window.location.href);
        alert("Ju lutem kyçuni për të bërë rezervimin e biletës.");
        window.location.href = "../login.php";
        return;
    }

    // Marrim emrin e destinacionit nga titulli i faqes
    const destinationName = document.title.split(" - ")[0].trim(); 

    const firstName = document.querySelector('#first-name').value;
    const lastName = document.querySelector('#last-name').value;
    const email = document.querySelector('#email').value;
    const phoneNumber = document.querySelector('#phone').value;
    const departureDate = document.querySelector('#departure-date').value;
    const returnDate = document.querySelector('#return-date').value;
    const travelClass = document.querySelector('input[name="travel_class"]:checked').value;

    if (!firstName || !lastName || !email || !phoneNumber || !departureDate || !travelClass) {
        alert('Please fill in all required fields.');
        return;
    }

    const bookingDetails = {
        firstName,
        lastName,
        email,
        phoneNumber,
        departureDate,
        returnDate,
        travelClass,
        destination: destinationName
    };

    localStorage.setItem('bookingDetails', JSON.stringify(bookingDetails));
    alert(`✅ Reservation successful for ${firstName} ${lastName} to ${destinationName} from ${departureDate} to ${returnDate} in ${travelClass} class.`);
}

// Kontrollo pas login nëse ka një faqe për ridrejtim
document.addEventListener("DOMContentLoaded", function () {
    const redirectUrl = sessionStorage.getItem("redirectAfterLogin");
    if (redirectUrl) {
        sessionStorage.removeItem("redirectAfterLogin");
        window.location.href = redirectUrl;
    }
});

// Add event listener
const bookingForm = document.querySelector('form');
if (bookingForm) {
    bookingForm.addEventListener('submit', handleBooking);
}

