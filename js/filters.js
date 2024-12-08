// Filter functionality for destinations
document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = document.querySelectorAll('.filters button');
    const destinations = document.querySelectorAll('.destination-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.dataset.filter;

            destinations.forEach(destination => {
                if (filter === 'all' || destination.dataset.category === filter) {
                    destination.style.display = 'block';
                } else {
                    destination.style.display = 'none';
                }
            });
        });
    });
});