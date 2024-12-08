// Function to handle flight search
function handleFlightSearch(event) {
    event.preventDefault();

    const destination = document.querySelector('input[name="destination"]').value;
    const departureDate = document.querySelector('input[name="departure-date"]').value;
    const returnDate = document.querySelector('input[name="return-date"]').value;

    if (!destination || !departureDate) {
        alert('Please fill in all required fields.');
        return;
    }

    // Create a query string and redirect to the search results page
    const query = `?destination=${encodeURIComponent(destination)}&departureDate=${encodeURIComponent(departureDate)}&returnDate=${encodeURIComponent(returnDate)}`;
    window.location.href = `search-results.html${query}`;
}

// Add event listener for the search form submission
const searchForm = document.querySelector('.search form');
if (searchForm) {
    searchForm.addEventListener('submit', handleFlightSearch);
}
