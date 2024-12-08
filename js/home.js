// Adjusts the video background size to match the screen size
function resizeVideoBackground() {
    const video = document.querySelector('#homeVideo'); // Select the video element
    if (video) {
        video.style.height = `${window.innerHeight}px`; // Set the height to match the viewport
    }
}

// Listens for window resize events to adjust the video size dynamically
window.addEventListener('resize', resizeVideoBackground);

// Ensures the video background is correctly sized when the page loads
document.addEventListener('DOMContentLoaded', resizeVideoBackground);

// Adds a hover animation to the "Explore Destinations" button
const exploreButton = document.querySelector('.cta-btn'); // Select the button
if (exploreButton) {
    exploreButton.addEventListener('mouseenter', () => {
        exploreButton.style.transform = 'scale(1.1)'; // Slightly enlarge the button on hover
    });
    exploreButton.addEventListener('mouseleave', () => {
        exploreButton.style.transform = 'scale(1)'; // Reset the button size on hover out
    });
}
