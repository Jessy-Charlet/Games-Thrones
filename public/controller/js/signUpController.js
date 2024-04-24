// Wait for the page to load
document.addEventListener('DOMContentLoaded', (event) => {
    // Get the submit button element
    var submitBtn = document.getElementById('submitBtn');
    var phoneInput = document.getElementById('phoneId');

    phoneInput.addEventListener('keyup', function(event) {
        // Supprime le dernier caractère avant d'ajouter un espace
        if(phoneInput.value.length === 2 || phoneInput.value.length === 5 || phoneInput.value.length === 8 || phoneInput.value.length === 11) {
            phoneInput.value += ' ';
        }
        phoneInput.value = phoneInput.value.replace(/[^\d ]/g, '');
    });

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
            var passwordFormat = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[&()!\/.,?;:_+=}{é~"#'-|è`\\ç^à@£$¤*µù%§<>°]).{6,255}$/;
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



        const formdata = new FormData();
        formdata.append('name', name);
        formdata.append('firstname', firstname);
        formdata.append('email', email);
        formdata.append('phone', phone);
        formdata.append('adress', adress);
        formdata.append('postalCode', postalCode);
        formdata.append('city', city);
        formdata.append('password', password);

        const requestOptions = {
            method: "POST",
            header: "Content-Type: application/form-data",
            body: formdata
        };

        fetch("http://localhost:8080/controller/php/signUpController.php", requestOptions)
            .then(response => response.json())
            .then(data => {
                if(data.status == 'error') {
                    if (data.error === 'mailAlreadyUsed') {
                        self.location = 'inscription?error=mailAlreadyUsed';
                    } else if (data.error === 'phoneAlreadyUsed') {
                        self.location = 'inscription?error=phoneAlreadyUsed';
                    }
                }else if(data.status == 'success') {
                    self.location = '/';
                }
            })
            .catch(error => 
                self.location = 'inscription?error=UnexpectedError'
            );
    });
});
// 
// 
// 
//  finir de faire les verifications 
// 
// 
// 
// 
// 
