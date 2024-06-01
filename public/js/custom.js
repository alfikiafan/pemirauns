document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 3000);
    }
});
