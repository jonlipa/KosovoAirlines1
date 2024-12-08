// Function to toggle the mobile navigation menu
function toggleNavigation() {
    const navMenu = document.querySelector('.nav-menu');
    navMenu.classList.toggle('active');
}

// Adding event listener to the navigation toggle button
const navToggleBtn = document.querySelector('.nav-toggle-btn');
if (navToggleBtn) {
    navToggleBtn.addEventListener('click', toggleNavigation);
}
