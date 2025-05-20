document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('nav ul');

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
        });
    }

    // Existing togglePassword function
    function togglePassword() {
        var passwordField = document.getElementById('password');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    }

    // Existing validateForm function
    function validateForm() {
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone_number').value;
        var password = document.getElementById('password').value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var phoneRegex = /^\d{10,15}$/;

        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }
        if (!phoneRegex.test(phone)) {
            alert('Please enter a valid phone number (10-15 digits).');
            return false;
        }
        if (password.length < 8) {
            alert('Password must be at least 8 characters long.');
            return false;
        }
        return true;
    }

    // Existing payment method logic
    var paymentMethod = document.getElementById('payment_method');
    var paymentFields = document.getElementById('payment_fields');

    if (paymentMethod) {
        paymentMethod.addEventListener('change', function() {
            paymentFields.innerHTML = '';
            if (this.value === 'bank') {
                paymentFields.innerHTML = `
                    <label for="bank_account">Bank Account Number:</label>
                    <input type="text" id="bank_account" name="bank_account" required>
                `;
            } else if (this.value === 'paypal') {
                paymentFields.innerHTML = `
                    <label for="paypal_email">PayPal Email:</label>
                    <input type="email" id="paypal_email" name="paypal_email" required>
                `;
            } else if (this.value === 'mobile') {
                paymentFields.innerHTML = `
                    <label for="mobile_number">Mobile Number:</label>
                    <input type="tel" id="mobile_number" name="mobile_number" required>
                `;
            }
        });
    }
});