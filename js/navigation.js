class NavigationMenu {
    constructor(menuSelector, toggleButtonSelector) {
        this.navMenu = document.querySelector(menuSelector);
        this.navToggleBtn = document.querySelector(toggleButtonSelector);

        if (this.navToggleBtn && this.navMenu) {
            this.init();
        }
    }

    init() {
        this.navToggleBtn.addEventListener('click', () => this.toggleMenu());
        document.addEventListener('click', (event) => this.closeMenuOnClickOutside(event));
    }

    toggleMenu() {
        this.navMenu.classList.toggle('active');
    }

    closeMenuOnClickOutside(event) {
        if (!this.navMenu.contains(event.target) && !this.navToggleBtn.contains(event.target)) {
            this.navMenu.classList.remove('active');
        }
    }
}

// Inicializimi i klasës për navigimin
new NavigationMenu('.nav-menu', '.nav-toggle-btn');