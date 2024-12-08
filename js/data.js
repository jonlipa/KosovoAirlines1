// data.js

// Example flight data
const flights = [
    {
        flightNumber: "KA101",
        departure: "Pristina",
        arrival: "London",
        departureTime: "2024-12-10 08:00",
        arrivalTime: "2024-12-10 10:30",
        status: "On Time",
    },
    {
        flightNumber: "KA202",
        departure: "Pristina",
        arrival: "Istanbul",
        departureTime: "2024-12-10 12:00",
        arrivalTime: "2024-12-10 14:30",
        status: "Delayed",
    },
];

// Example destinations data
const destinations = [
    {
        city: "London",
        country: "United Kingdom",
        airport: "Heathrow Airport (LHR)",
        image: "images/london.jpg",
    },
    {
        city: "Istanbul",
        country: "Turkey",
        airport: "Istanbul Airport (IST)",
        image: "images/istanbul.jpg",
    },
];

export { flights, destinations };
