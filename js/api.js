// api.js

// Example function to initialize Google Maps API
function initializeGoogleMap() {
    const mapOptions = {
        center: { lat: 42.6629, lng: 21.1655 }, // Example coordinates (Kosovo)
        zoom: 10,
    };
    const map = new google.maps.Map(document.getElementById("map"), mapOptions);
    console.log("Google Map Initialized");
}

// Example function to fetch flight data from an API
async function fetchFlightData(apiUrl) {
    try {
        const response = await fetch(apiUrl);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        console.log("Flight Data:", data);
        return data;
    } catch (error) {
        console.error("Error fetching flight data:", error);
    }
}

export { initializeGoogleMap, fetchFlightData };
