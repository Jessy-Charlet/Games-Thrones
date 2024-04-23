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
var form = document.getElementById('personalInfoForm');

var initialnameId = nameId.value || 'defaultName';
var initialFirstname = firstname.value;
var initialEmail = email.value;
var initialPhone = phone.value;
var initialAdresse = adresse.value;
var initialPostalCode = postalCode.value;
var initialCity = city.value;
var initialPassword = password.value;

nameId.disabled = true;
firstname.disabled = true;
email.disabled = true;
phone.disabled = true;
adresse.disabled = true;
postalCode.disabled = true;
city.disabled = true;
password.disabled = true;


personalInfoModif.addEventListener('click', function(event) {
   event.preventDefault();
   nameId.disabled = false;
   firstname.disabled = false;
   email.disabled = false;
   phone.disabled = false;
   adresse.disabled = false;
   postalCode.disabled = false;
   city.disabled = false;
   password.disabled = false;
   personalInfoModif.value = 'enregistrer';
   
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
           var passwordFormat = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[&()!\/.,?;:_+=}{é~"#'-|è`\\ç^à@£$¤*µù%§<>°]).{6,255}$/;
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
       function isChangeValueChanged(initialValue, newValue){
           if(initialValue != newValue){
               return newValue;
           }else{
               return initialValue;
           }
       }
       var initialValues = {
           nameId: 'defaultName',
           firstname: '',
           email: '',
           phone: '',
           adresse: '',
           postalCode: '',
           city: '',
           password: ''
       };
       
       var newValues = {
           nameId: document.getElementById('nameId').value,
           firstname: document.getElementById('firstname').value,
           email: document.getElementById('email').value,
           phone: document.getElementById('telephone').value,
           adresse: document.getElementById('adresse').value,
           postalCode: document.getElementById('code_postal').value,
           city: document.getElementById('ville').value,
           password: document.getElementById('password').value
       };
       var changedValues = {};
       for (var key in initialValues) {
           if (initialValues.hasOwnProperty(key)) {
               changedValues[key] = isChangeValueChanged(initialValues[key], newValues[key]);
           }
       }
       var queryString = '';
       for (var key in changedValues) {
           if (changedValues.hasOwnProperty(key)) {
               queryString += '&' + key + '=' + encodeURIComponent(changedValues[key]);
           }
       }
       const formdata = new FormData();
       formdata.append('name', nameId);
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
           .then(response => response.text())
           .then(() => {
               window.location.href = '/';
           })
           .catch(error => 
               self.location = 'inscription?error=error'
           );
       nameId.disabled = true;
       firstname.disabled = true;
       email.disabled = true;
       phone.disabled = true;
       adresse.disabled = true;
       postalCode.disabled = true;
       city.disabled = true;
       password.disabled = true;
       
       const cancelButtonContainer = document.getElementById('cancelButtonContainer');
       var cancelButton = document.createElement('input');
       if(!cancelButtonContainer.hasChildNodes()){
           cancelButtonContainer.appendChild(cancelButton);
       }
       cancelButton.type = 'button';
       cancelButton.id = 'cancelButton';
       cancelButton.className = 'buttonCancel';
       cancelButton.value = 'annuler';
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
           nameId.value = initialName;
           firstname.value = initialFirstname;
           email.value = initialEmail;
           phone.value = initialPhone;
           adresse.value = initialAddress;
           postalCode.value = initialPostalCode;
           city.value = initialCity;
           password.value = initialPassword;
           // Changer le texte du bouton
           personalInfoModif.value = 'modifier';
           // Supprimer le bouton "annuler"
           errorMessages.innerHTML = '';
           cancelButtonContainer.removeChild(cancelButton);
       });
   }
});