class ResponsiveHandler {
    constructor(config = {}) {
        this.elements = {
            header: document.querySelector('header'),
            someElement: document.querySelector('.some-element'),
            ...config
        };
        this.resizeTimeout = null;

        this.init();
    }

    init() {
        // Bind resize event me debounce
        window.addEventListener('resize', () => {
            clearTimeout(this.resizeTimeout);
            this.resizeTimeout = setTimeout(() => this.handleResponsiveDesign(), 150);
        });

        // Ekzekuto në ngarkim të faqes
        document.addEventListener('DOMContentLoaded', () => this.handleResponsiveDesign());

        // Shto CSS dinamike
        this.injectStyles();
    }

    handleResponsiveDesign() {
        const windowWidth = window.innerWidth;

        // Ndrysho klasat bazuar në gjerësinë e dritares
        if (this.elements.header) {
            this.elements.header.classList.toggle('mobile', windowWidth < 768);
        }
        if (this.elements.someElement) {
            this.elements.someElement.classList.toggle('hidden', windowWidth < 500);
        }
    }

    injectStyles() {
        const style = document.createElement('style');
        style.innerHTML = `
            header.mobile {
                background-color: #f8f9fa;
                padding: 10px;
            }
            .hidden {
                display: none !important;
            }
        `;
        document.head.appendChild(style);
    }
}

// Inicializimi i klasës për menaxhimin e dizajnit responsive në secilën faqe me elementë të ndryshëm
new ResponsiveHandler({
    someElement: document.querySelector('.custom-element')
});
