// Function to track page visits
function trackPageVisit(pageName) {
    console.log(`Page visited: ${pageName}`);
    // You can send the data to an analytics service here (like Google Analytics)
}

// Function to track button clicks
function trackButtonClick(buttonId) {
    console.log(`Button clicked: ${buttonId}`);
    // Send the button click event to your analytics service
}

// Event listener for tracking page visit
document.addEventListener('DOMContentLoaded', function () {
    trackPageVisit(window.location.pathname);
});

// Event listeners for tracking button clicks
const buttons = document.querySelectorAll('button');
buttons.forEach(button => {
    button.addEventListener('click', function () {
        trackButtonClick(button.id);
    });
});
