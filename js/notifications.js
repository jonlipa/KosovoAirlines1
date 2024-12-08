// Function to show notification message
function showNotification(message, type = 'info') {
    const notificationContainer = document.createElement('div');
    notificationContainer.classList.add('notification', type);
    notificationContainer.textContent = message;

    // Append the notification to the body
    document.body.appendChild(notificationContainer);

    // Automatically remove the notification after 5 seconds
    setTimeout(() => {
        notificationContainer.remove();
    }, 5000);
}

// Example of how to show different types of notifications
function showSuccessMessage(message) {
    showNotification(message, 'success');
}

function showErrorMessage(message) {
    showNotification(message, 'error');
}

function showInfoMessage(message) {
    showNotification(message, 'info');
}

// Usage example
document.addEventListener('DOMContentLoaded', () => {
    showSuccessMessage('Welcome to Kosova Airlines!');
    showErrorMessage('There was an error processing your request.');
});