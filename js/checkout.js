// Function to handle checkout process
function handleCheckout(event) {
    event.preventDefault();

    const cardNumber = document.querySelector('#card-number').value;
    const cardExpiry = document.querySelector('#card-expiry').value;
    const cardCVC = document.querySelector('#card-cvc').value;
    const billingAddress = document.querySelector('#billing-address').value;
    
    // Validate the payment form
    if (!cardNumber || !cardExpiry || !cardCVC || !billingAddress) {
        alert('Please fill in all required fields.');
        return;
    }

    // Simulate payment process (for demonstration purposes)
    const paymentDetails = {
        cardNumber: cardNumber,
        cardExpiry: cardExpiry,
        cardCVC: cardCVC,
        billingAddress: billingAddress
    };

    // Save payment details in localStorage (or send to server for processing)
    localStorage.setItem('paymentDetails', JSON.stringify(paymentDetails));

    // Redirect to confirmation page
    window.location.href = 'checkout-confirmation.html';
}

// Add event listener for the checkout form submission
const checkoutForm = document.querySelector('#checkout-form');
if (checkoutForm) {
    checkoutForm.addEventListener('submit', handleCheckout);
}
