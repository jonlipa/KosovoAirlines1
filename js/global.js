// Function to toggle the mobile menu visibility
function toggleMenu() {
    const nav = document.querySelector('nav');
    nav.classList.toggle('open');
}

// Event listener for menu toggle button
const menuButton = document.querySelector('.menu-btn');
if (menuButton) {
    menuButton.addEventListener('click', toggleMenu);
}

// Smooth scrolling to anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
