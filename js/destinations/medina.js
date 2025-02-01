// Gallery Modal Functionality 
function initializeGallery() {
    const images = document.querySelectorAll('.gallery-item');
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const closeModalBtn = document.querySelector('.close');

    images.forEach(image => {
        image.addEventListener('click', () => {
            modal.style.display = 'flex';
            modalImage.src = image.src;
            modalImage.style.maxWidth = '90%';
            modalImage.style.maxHeight = '90%';
        });
    });

    // Mbyll modal-in kur klikohet butoni i mbylljes
    closeModalBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Mbyll modal-in kur klikohet jashtë imazhit
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}

// Form Validation and Booking Submission
function handleFormSubmission() {
    const form = document.getElementById('booking-form');
    if (!form) return; // Kontrollon nëse forma ekziston

    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Parandalojmë dërgimin e formës për validim

        const inputs = form.querySelectorAll('input');
        let valid = true;

        // Kontrollo validimin e inputeve
        inputs.forEach(input => {
            if (!input.checkValidity()) {
                valid = false;
                input.style.border = '2px solid red';
            } else {
                input.style.border = '';
            }
        });

        if (valid) {
            form.submit(); // Nëse të dhënat janë valide, dërgo formën te backend
        } else {
            alert('Please fill out all required fields correctly.');
        }
    });
}

// Initialize all functionality
window.onload = () => {
    initializeGallery();
    handleFormSubmission();
};
