// Function to initialize the image carousel
function initCarousel() {
    const carouselItems = document.querySelectorAll('.carousel-item');
    let currentIndex = 0;

    // Function to show the next item in the carousel
    function showNextItem() {
        carouselItems[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % carouselItems.length;
        carouselItems[currentIndex].classList.add('active');
    }

    // Function to show the previous item in the carousel
    function showPrevItem() {
        carouselItems[currentIndex].classList.remove('active');
        currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
        carouselItems[currentIndex].classList.add('active');
    }

    // Set an interval to automatically change items every 3 seconds
    setInterval(showNextItem, 3000);

    // Add event listeners for next and previous buttons
    const nextButton = document.querySelector('.carousel-next');
    const prevButton = document.querySelector('.carousel-prev');
    if (nextButton) nextButton.addEventListener('click', showNextItem);
    if (prevButton) prevButton.addEventListener('click', showPrevItem);
}

// Initialize the carousel when the DOM is ready
document.addEventListener('DOMContentLoaded', initCarousel);
