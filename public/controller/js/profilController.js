var errorMessages = document.getElementById('errorMessage');

const nameId = document.getElementById('nameId');
const firstname = document.getElementById('firstname');
const email = document.getElementById('email');
const phone = document.getElementById('telephone');
const adresse = document.getElementById('adresse');
const postalCode = document.getElementById('code_postal');
const city = document.getElementById('ville');
const password = document.getElementById('password');
const personalInfoModif = document.getElementById('personnalInfoModif');
const form = document.getElementById('personalInfoForm');


nameId.disabled = true;
firstname.disabled = true;
email.disabled = true;
phone.disabled = true;
adresse.disabled = true;
postalCode.disabled = true;
city.disabled = true;
password.disabled = true;

var initialnameId = nameId.value || 'defaultName';
var initialFirstname = firstname.value;
var initialEmail = email.value;
var initialPhone = phone.value;
var initialAdresse = adresse.value;
var initialPostalCode = postalCode.value;
var initialCity = city.value;
var initialPassword = password.value;
    
personalInfoModif.addEventListener('click', function(event) {
    event.preventDefault();

    const phoneInput = document.getElementById('telephone');

    phoneInput.addEventListener('keyup', function(event) {
        // Supprime le dernier caractère avant d'ajouter un espace
        if(phoneInput.value.length === 2 || phoneInput.value.length === 5 || phoneInput.value.length === 8 || phoneInput.value.length === 11) {
            phoneInput.value += ' ';
        }
        phoneInput.value = phoneInput.value.replace(/[^\d ]/g, '');
    });

    nameId.disabled = false;
    firstname.disabled = false;
    email.disabled = false;
    phone.disabled = false;
    adresse.disabled = false;
    postalCode.disabled = false;
    city.disabled = false;
    password.disabled = false;

    const cancelButtonContainer = document.getElementById('cancelButtonContainer');
    var cancelButton = document.createElement('input');
    if(!cancelButtonContainer.hasChildNodes()){     
        cancelButton.type = 'button';
        cancelButton.id = 'cancelButton';
        cancelButton.className = 'buttonCancel';
        cancelButton.value = 'annuler';
        cancelButton.style.cursor = 'pointer';
        cancelButtonContainer.appendChild(cancelButton);
    }

    if(personalInfoModif.value === 'enregistrer') {
            if (nameId.value === '' || password.value === '' || email.value === '' || phone.value === '' || adresse.value === '' || firstname.value === '' || postalCode.value === '' || city.value === '') {
               var errorMessage = 'Please fill in all fields.';
               errorMessages.innerHTML = errorMessage;
               return;
            }

            if(phone.value !== ''){
                var phoneFormat = /^(\d{2} ){4}\d{2}$/;
                if (!phoneFormat.test(phone.value)) {
                    var errorMessage = 'Phone number format is incorrect. It should be like "00 00 00 00 00".';
                    errorMessages.innerHTML = errorMessage;
                    return;
                }
            }
   
            if(email.value !== ''){
                var emailFormat = /\S+@\S+\.\S+/;
                if (!emailFormat.test(email.value)) {
                    var errorMessage = 'Email format is incorrect.';
                    errorMessages.innerHTML = errorMessage;
                    return;
                }
           }

            if(password.value !== ''){
                var passwordFormat = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[&()!\/.,?;:_+=}{é~"#'-|è`\\ç^à@£$¤*µù%§<>°]).{6,255}$/;
                if (!passwordFormat.test(password.value)) {
                    var errorMessage = 'Password must contain at least one number and one uppercase and lowercase letter, a special character, and at least 6 or more characters.';
                    errorMessages.innerHTML = errorMessage;
                    return;
                }
            }

            if(postalCode.value !== ''){
                var postalCodeFormat = /^\d{5}$/;
                if (!postalCodeFormat.test(postalCode.value)) {
                    var errorMessage = 'Postal code format is incorrect. It should be 5 digits.';
                    errorMessages.innerHTML = errorMessage;
                    return;
                }
            }
            function isChangeValueChanged(initialValue, newValue){
                if(initialValue != newValue){
                    return newValue;
                }else{
                    return initialValue;
                }
            }
            const initialValues = {
                nameId: 'defaultName',
                firstname: '',
                email: '',
                phone: '',
                adresse: '',
                postalCode: '',
                city: '',
                password: ''
            };

            const newValues = {
                nameId: document.getElementById('nameId').value,
                firstname: document.getElementById('firstname').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('telephone').value,
                adresse: document.getElementById('adresse').value,
                postalCode: document.getElementById('code_postal').value,
                city: document.getElementById('ville').value,
                password: document.getElementById('password').value
            };

            let changedValues = {};
            for (var key in initialValues) {
                if (initialValues.hasOwnProperty(key)) {
                    changedValues[key] = isChangeValueChanged(initialValues[key], newValues[key]);
                }
            }

            const customer_id = document.getElementById('customer_id').value;
            
            const formdata = new FormData();
            formdata.append('name', nameId);
            formdata.append('firstname', firstname);
            formdata.append('email', email);
            formdata.append('phone', phone);
            formdata.append('adress', adresse);
            formdata.append('postalCode', postalCode);
            formdata.append('city', city);
            formdata.append('password', password);
            formdata.append('id', customer_id);
    
            const requestOptions = {
                method: "POST",
                Header: "Content-Type: multipart/form-data",
                body: formdata
            };
    
            fetch("http://localhost:8080/controller/php/profilController.php", requestOptions)
                .then(response => response.json())
                .then(data => {
                    if(data.status == 'error') {
                        if (data.error === 'mailAlreadyUsed') {
                            self.location = '/profil?error=mailAlreadyUsed';
                        } else if (data.error === 'phoneAlreadyUsed') {
                            self.location = '/profil?error=phoneAlreadyUsed';
                        }
                    }else if(data.status == 'success') {
                        self.location = '/';
                    }
                })
                .catch(error => 
                    console.log(error)
                    //self.location = '/profil?error=UnexpectedError'
                );

                nameId.disabled = true;
                firstname.disabled = true;
                email.disabled = true;
                phone.disabled = true;
                adresse.disabled = true;
                postalCode.disabled = true;
                city.disabled = true;
                password.disabled = true;
    }
    
    personalInfoModif.value = 'enregistrer';

    cancelButton.addEventListener('click', function() {
        // Désactiver les champs d'entrée
        nameId.disabled = true;
        firstname.disabled = true;
        email.disabled = true;
        phone.disabled = true;
        adresse.disabled = true;
        postalCode.disabled = true;
        city.disabled = true;
        password.disabled = true;
        // Rétablir les valeurs initiales
        nameId.value = initialnameId;
        firstname.value = initialFirstname;
        email.value = initialEmail;
        phone.value = initialPhone;
        adresse.value = initialAdresse;
        postalCode.value = initialPostalCode;
        city.value = initialCity;
        password.value = initialPassword;
        // Changer le texte du bouton
        personalInfoModif.value = 'modifier';
        // Supprimer le bouton "annuler"
        errorMessages.innerHTML = '';
        cancelButtonContainer.removeChild(cancelButton);
    });
});