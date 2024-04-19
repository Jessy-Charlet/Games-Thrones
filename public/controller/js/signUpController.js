// Wait for the page to load
document.addEventListener('DOMContentLoaded', function() {
    // Get the submit button element
    var submitBtn = document.getElementById('submitBtn');

    // Add click event listener to the submit button
    submitBtn.addEventListener('click', function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get the input values
        var name = document.getElementById('nameId').value;
        var firstname = document.getElementById('firstnameId').value;
        var email = document.getElementById('emailId').value;
        var phone = document.getElementById('phoneId').value;
        var adress = document.getElementById('adressId').value;
        var postalCode = document.getElementById('postalCodeId').value;
        var city = document.getElementById('cityId').value;
        var password = document.getElementById('passwordId').value;
        var confirmPassword = document.getElementById('passwordConfirmId').value;

        var errorMessages = document.getElementById('errorMessage');
        errorMessages.innerHTML = '';

        // Check if any of the input fields are empty
        if (name.trim() === '' || password.trim() === '' || confirmPassword.trim() === '' || email.trim() === '' || phone.trim() === '' || adress.trim() === '' || firstname.trim() === '' || postalCode.trim() === '' || city.trim() === '') {
            var errorMessage = 'Please fill in all fields.';
            errorMessages.innerHTML = errorMessage;
            return;
        }

        if (password !== confirmPassword) {
            var errorMessage = 'Passwords do not match.';
            errorMessages.innerHTML = errorMessage;
            return;
        }

        if(phone !== ''){
            var phoneFormat = /^(\d{2} ){4}\d{2}$/;
            if (!phoneFormat.test(phone)) {
                var errorMessage = 'Phone number format is incorrect. It should be like "00 00 00 00 00".';
                errorMessages.innerHTML = errorMessage;
                return;
            }
        }

        if(email !== ''){
            var emailFormat = /\S+@\S+\.\S+/;
            if (!emailFormat.test(email)) {
                var errorMessage = 'Email format is incorrect.';
                errorMessages.innerHTML = errorMessage;
                return;
            }
        }

        if(password !== ''){
            var passwordFormat = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[&()!\/.,?;:_]).{6,255}$/;
            if (!passwordFormat.test(password)) {
                var errorMessage = 'Password must contain at least one number and one uppercase and lowercase letter, a special character, and at least 6 or more characters.';
                errorMessages.innerHTML = errorMessage;
                return;
            }
        }

        if(postalCode !== ''){
            var postalCodeFormat = /^\d{5}$/;
            if (!postalCodeFormat.test(postalCode)) {
                var errorMessage = 'Postal code format is incorrect. It should be 5 digits.';
                errorMessages.innerHTML = errorMessage;
                return;
            }
        }


        window.location.href = '/signUpControllerphp';
    });
});