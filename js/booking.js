// Function to handle flight booking
function handleBooking(event) {
    event.preventDefault();

    const passengerName = document.querySelector('#passenger-name').value;
    const flightClass = document.querySelector('input[name="class"]:checked').value;
    const contactInfo = document.querySelector('#contact-info').value;
    
    if (!passengerName || !flightClass || !contactInfo) {
        alert('Please fill in all required fields.');
        return;
    }

    // Simulate booking process (for demonstration purposes)
    const bookingDetails = {
        passengerName: passengerName,
        flightClass: flightClass,
        contactInfo: contactInfo
    };

    // Save booking details in localStorage (or send to server)
    localStorage.setItem('bookingDetails', JSON.stringify(bookingDetails));

    // Redirect to booking confirmation page
    window.location.href = 'booking-confirmation.html';
}

// Add event listener for the booking form submission
const bookingForm = document.querySelector('#booking-form');
if (bookingForm) {
    bookingForm.addEventListener('submit', handleBooking);
}
