class Navigation {
    constructor(menuSelector, menuButtonSelector, anchorLinksSelector) {
        this.nav = document.querySelector(menuSelector);
        this.menuButton = document.querySelector(menuButtonSelector);
        this.anchorLinks = document.querySelectorAll(anchorLinksSelector);

        this.init();
    }

    init() {
        if (this.menuButton) {
            this.menuButton.addEventListener('click', () => this.toggleMenu());
        }

        this.anchorLinks.forEach(anchor => {
            anchor.addEventListener('click', (e) => this.smoothScroll(e, anchor));
        });
    }

    toggleMenu() {
        if (this.nav) {
            this.nav.classList.toggle('open');
        }
    }

    smoothScroll(event, anchor) {
        event.preventDefault();
        const target = document.querySelector(anchor.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }
}

// Inicializimi i klasës me selektorët e duhur
new Navigation('nav', '.menu-btn', 'a[href^="#"]');
