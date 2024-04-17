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
    var name = document.getElementById('name');
    var firstname = document.getElementById('firstname');
    var email = document.getElementById('email');
    var phone = document.getElementById('telephone');
    var address = document.getElementById('adresse');
    var postalCode = document.getElementById('code_postal');
    var city = document.getElementById('ville');
    var password = document.getElementById('password');
    var personalInfoModif = document.getElementById('personnalInfoModif');

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
            cancelButtonContainer.removeChild(cancelButton);
        });


    });
});