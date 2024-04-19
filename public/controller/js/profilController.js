var errorMessages = document.getElementById('errorMessage');

var nameId = document.getElementById('nameId');
var firstname = document.getElementById('firstname');
var email = document.getElementById('email');
var phone = document.getElementById('telephone');
var adresse = document.getElementById('adresse');
var postalCode = document.getElementById('code_postal');
var city = document.getElementById('ville');
var password = document.getElementById('password');
var personalInfoModif = document.getElementById('personnalInfoModif');

var initialnameId = nameId.value || 'defaultName';
var initialFirstname = firstname.value;
var initialEmail = email.value;
var initialPhone = phone.value;
var initialAdresse = adresse.value;
var initialPostalCode = postalCode.value;
var initialCity = city.value;
var initialPassword = password.value;
    
personalInfoModif.addEventListener('click', function() {
    if (personalInfoModif.value === 'enregistrer') {
        if (nameId.value === '' || password.value === '' || email.value === '' || phone.value === '' || adresse.value === '' || firstname.value === '' || postalCode.value === '' || city.value === '') {
            var errorMessage = 'Please fill in all fields.';
            errorMessages.innerHTML = errorMessage;
            return;
        }

        if(phone !== ''){
            var phoneFormat = /^(\d{2} ){4}\d{2}$/;
            if (!phoneFormat.test(phone.value)) {
                var errorMessage = 'Phone number format is incorrect. It should be like \"00 00 00 00 00\".';
                errorMessages.innerHTML = errorMessage;
                    return;
                }
            }
    
        if(email !== ''){
            var emailFormat = /\S+@\S+\.\S+/;
            if (!emailFormat.test(email.value)) {
                var errorMessage = 'Email format is incorrect.';
                errorMessages.innerHTML = errorMessage;
                return;
            }
        }

        if(password !== ''){
            var passwordFormat = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[&()!\/.,?;:_]).{6,255}$/;
            if (!passwordFormat.test(password.value)) {
                var errorMessage = 'Password must contain at least one number and one uppercase and lowercase letter, a special character, and at least 6 or more characters.';
                errorMessages.innerHTML = errorMessage;
                return;
            }
        }

        if(postalCode !== ''){
            var postalCodeFormat = /^\d{5}$/;
            if (!postalCodeFormat.test(postalCode.value)) {
                var errorMessage = 'Postal code format is incorrect. It should be 5 digits.';
                errorMessages.innerHTML = errorMessage;
                return;
            }
        }

        if(initialnameId != nameId.value){
            nameChanged = nameId.value;
        }else{
            nameChanged = initialnameId;
        }

        if(initialFirstname != firstname.value){
            firstnameChanged = firstname.value;
        }else{
            firstnameChanged = initialFirstname;
        }

        if(initialEmail != email.value){
            emailChanged = email.value;
        }else{
            emailChanged = initialEmail;
        }

        if(initialPhone != phone.value){
            phoneChanged = phone.value;
        }else{
            phoneChanged = initialPhone;
        }

        if(initialAdresse != adresse.value){
            adresseChanged = adresse.value;
        }else{
            adresseChanged = initialAdresse;
        }

        if(initialPostalCode != postalCode.value){
            postalCodeChanged = postalCode.value;
        }else{
            postalCodeChanged = initialPostalCode;
        }

        if(initialCity != city.value){
            cityChanged = city.value;
        }else{
            cityChanged = initialCity;
        }

        if(initialPassword != password.value){
            passwordChanged = password.value;
        }else{
            passwordChanged = initialPassword;
        }


        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../controller/profilController.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('changeEmail=' + emailChanged + '&changePhone=' + phoneChanged + '&changePassword=' + passwordChanged + '&changeAdresse=' + adresseChanged + '&changeName=' + nameChanged + '&changeFirstname=' + firstnameChanged + '&changePostalCode=' + postalCodeChanged + '&changeCity=' + cityChanged);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                console.log('Success!', xhr.responseText);
            } else {
                console.log('The request failed!');
            }
        };
        
        xhr.onerror = function() {
            console.log('There was an error!');
        };

        nameId.disabled = true;
        firstname.disabled = true;
        email.disabled = true;
        phone.disabled = true;
        adresse.disabled = true;
        postalCode.disabled = true;
        city.disabled = true;
        password.disabled = true;
        personalInfoModif.value = 'modifier';            
    }
});