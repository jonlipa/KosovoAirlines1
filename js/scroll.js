// Function to handle smooth scrolling
function smoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');

    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// Function to reveal elements when they come into view while scrolling
function revealOnScroll() {
    const elements = document.querySelectorAll('.reveal-on-scroll');

    elements.forEach(element => {
        const elementPosition = element.getBoundingClientRect().top;
        const viewportHeight = window.innerHeight;

        if (elementPosition < viewportHeight) {
            element.classList.add('visible');
        }
    });
}

// Event listener for scroll
window.addEventListener('scroll', revealOnScroll);

// Initialize smooth scroll and reveal on scroll
document.addEventListener('DOMContentLoaded', () => {
    smoothScroll();
    revealOnScroll();
});
