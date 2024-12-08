function handleResponsiveDesign() {
    const windowWidth = window.innerWidth;

    // Kontroll për header
    const header = document.querySelector('header');
    if (header) {
        if (windowWidth < 768) {
            header.classList.add('mobile');
        } else {
            header.classList.remove('mobile');
        }
    }

    // Kontroll për some-element
    const someElement = document.querySelector('.some-element');
    if (someElement) {
        someElement.style.display = windowWidth < 500 ? 'none' : 'block';
    }
}

// Përdor debounce për performancë më të mirë gjatë resize
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(handleResponsiveDesign, 150);
});

// Ekzekuto funksionin në ngarkim të faqes
document.addEventListener('DOMContentLoaded', handleResponsiveDesign);