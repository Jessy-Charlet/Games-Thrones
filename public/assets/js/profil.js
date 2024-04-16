document.addEventListener('DOMContentLoaded', function() {
    var buttons = document.querySelectorAll('.buttonAcordeon');
    var buttonsIn = document.querySelectorAll('.buttonAcordeonIn');
    var contents = document.querySelectorAll('.acordeonContent');
    var contentsIn = document.querySelectorAll('.acordeonContentIn');

    buttons.forEach(function(button, index) {
        button.addEventListener('click', function() {
            var content = contents[index];
            content.style.display = (content.style.display === 'none' || content.style.display === '') ? 'grid' : 'none';
            adjustButtonArrow(button.querySelector('.buttonAcrodeonRightContent'), content.style.display);
            if(content.style.display === 'grid') {
                content.style.width = '100%';
                content.style.GridTemplateColumns = '10fr 1fr';
                content.style.alignItems = 'center';
                content.style.justifyItems = 'center';
                content.style.alignContents = 'center';
                content.style.gap = '10px';
            }
        });
    });

    buttonsIn.forEach(function(buttonIn, index) { // Change buttonsIn to buttonIn
        buttonIn.addEventListener('click', function() {
            var contentIn = contentsIn[index]; // Change contentsIn to contentIn
            contentIn.style.display = (contentIn.style.display === 'none' || contentIn.style.display === '') ? 'grid' : 'none';
            adjustButtonArrow(buttonIn.querySelector('.buttonAcrodeonRightContent'), contentIn.style.display); // Change .buttonAcrodeonRightContentIn to span
        });
    });

    function adjustButtonArrow(arrowElement, displayValue) {
        if (displayValue === 'grid') {
            arrowElement.innerHTML = '▼';
        } else {
            arrowElement.innerHTML = '►';
        }
    }

    var form = document.getElementById('personalInfoForm');
    var personalInfoModif = document.getElementById('personnalInfoModif');
    var name = document.getElementById('nom');
    var firstname = document.getElementById('prenom');
    var email = document.getElementById('email');
    var phone = document.getElementById('telephone');
    var address = document.getElementById('adresse');
    var postalCode = document.getElementById('code_postal');
    var city = document.getElementById('ville');
    var password = document.getElementById('password');

    name.disabled = true;
    firstname.disabled = true;
    email.disabled = true;
    phone.disabled = true;
    address.disabled = true;
    postalCode.disabled = true;
    city.disabled = true;
    password.disabled = true;

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        var errorMessages = document.getElementById('errorMessage');

        // Stocker les valeurs initiales
        var initialName = name.value;
        var initialFirstname = firstname.value;
        var initialEmail = email.value;
        var initialPhone = phone.value;
        var initialAddress = address.value;
        var initialPostalCode = postalCode.value;
        var initialCity = city.value;
        var initialPassword = password.value;

    
        // Activer les champs d'entrée
        name.disabled = false;
        firstname.disabled = false;
        email.disabled = false;
        phone.disabled = false;
        address.disabled = false;
        postalCode.disabled = false;
        city.disabled = false;
        password.disabled = false;
    
        // Changer le texte du bouton
        personalInfoModif.value = 'enregistrer';
    
        // Vérifier si un bouton "annuler" existe déjà
        var cancelButton = document.getElementById('cancelButton');
        if (!cancelButton) {
            // Créer un nouveau bouton "annuler"
            cancelButton = document.createElement('input');
            cancelButton.type = 'button';
            cancelButton.value = 'annuler';
            cancelButton.id = 'cancelButton'; // Ajouter un ID au bouton "annuler"
    
            // Ajouter un écouteur d'événements 'click' au bouton "annuler"
            cancelButton.addEventListener('click', function() {
                // Désactiver les champs d'entrée
                name.disabled = true;
                firstname.disabled = true;
                email.disabled = true;
                phone.disabled = true;
                address.disabled = true;
                postalCode.disabled = true;
                city.disabled = true;
                password.disabled = true;
    
                // Rétablir les valeurs initiales
                name.value = initialName;
                firstname.value = initialFirstname;
                email.value = initialEmail;
                phone.value = initialPhone;
                address.value = initialAddress;
                postalCode.value = initialPostalCode;
                city.value = initialCity;
                password.value = initialPassword;
    
                // Changer le texte du bouton
                personalInfoModif.value = 'modifier';
    
                // Supprimer le bouton "annuler"
                errorMessages.innerHTML = '';
                form.removeChild(cancelButton);
            });
    
            // Ajouter le bouton "annuler" au formulaire 
            form.appendChild(cancelButton);
        }
        personalInfoModif.addEventListener('click', function() {
            if (personalInfoModif.value === 'enregistrer') {
                // Les valeurs des champs d'entrée à ce stade sont les valeurs que l'utilisateur a entrées
        
                // Ici, vous pouvez ajouter le code pour mettre à jour la base de données
                // ...
        
                // Après la mise à jour de la base de données, vous pouvez désactiver les champs d'entrée et changer le texte du bouton
                if (name.value.trim() === '' || password.value.trim() === '' || confirmPassword.value.trim() === '' || email.value.trim() === '' || phone.value.trim() === '' || adress.value.trim() === '' || firstname.value.trim() === '' || postalCode.value.trim() === '' || city.value.trim() === '') {
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
                name.disabled = true;
                firstname.disabled = true;
                email.disabled = true;
                phone.disabled = true;
                address.disabled = true;
                postalCode.disabled = true;
                city.disabled = true;
                password.disabled = true;
                personalInfoModif.value = 'modifier';
        
                // Supprimer le bouton "annuler"
                var cancelButton = document.getElementById('cancelButton');
                if (cancelButton) {
                    form.removeChild(cancelButton);
                    errorMessage.innerHTML = '';
                }
            }
        });

    });
});