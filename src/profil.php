<?php

$id = $_SESSION['user'];

$user = new CrudUser();
$userAlldata = $user->getAll($id);
$userData = $userAlldata['userData'];
$adressData = $userAlldata['adressData'];
?>
<link rel="stylesheet" href="./assets/css/profil.css?t=<?= time(); ?>">
    <button class="buttonAcordeon" id="btn1"><span class="buttonAcrodeonLeftContent">Mon compte</span><span class="buttonAcrodeonRightContent">►</span></button>
    <div class="acordeonContent" id="content1">
        <button class="buttonAcordeonIn"><span class="buttonAcrodeonLeftContent">Informations personnelles</span><span class="buttonAcrodeonRightContent">►</span></button>
        <div class="acordeonContentIn">
            <!--<div class="sideBar"></div>-->
            <form method="post" class="formPersonnalInfos" id="personalInfoForm">
            <div class="formRow1">
                <div>
                    <label for="name" class="labelForm">Nom</label>
                    <br>
                    <input type="text" name="name" id="name" value="<?= $userData['customer_last-name'] ?>" class="inputForm inputFormSmall">
                </div>
                <div>
                    <label for="firstname" class="labelForm">Prénom</label>
                    <br>
                    <input type="text" name="firstname" id="firstname" value="<?= $userData['customer_first-name'] ?>" class="inputForm inputFormSmall">
                </div>
            </div>
            <div class="formRow1">
                <div>
                    <label for="email" class="labelForm">Email</label>
                    <br>
                    <input type="email" name="email" id="email" value="<?= $userData['email'] ?>" class="inputForm inputFormSmall">
                </div>
                <div>
                    <label for="telephone" class="labelForm">Téléphone</label>
                    <br>
                    <input type="tel" name="telephone" id="telephone" value="<?= $userData['phone'] ?>" class="inputForm inputFormSmall">
                </div>
            </div>
            <div class="formRow3">
                <div>
                    <label for="adresse" class="labelForm">Adresse</label>
                    <br>
                    <input type="text" name="adresse" id="adresse" value="<?= $adressData['adress'] ?>" class="inputForm inputFormLarge">
                </div>
            </div>
            <div class="formRow1">
                <div>
                    <label for="code_postal" class="labelForm">Code postal</label>
                    <br>
                    <input type="text" name="code_postal" id="code_postal" value="<?= $adressData['postal_code'] ?>" class="inputForm inputFormSmall">
                </div>
                <div>
                    <label for="ville" class="labelForm">Ville</label>
                    <br>
                    <input type="text" name="ville" id="ville" value="<?= $adressData['city'] ?>" class="inputForm inputFormSmall">
                </div>
            </div>
            <div class="formRow1">
                <div>
                    <label for="password" class="labelForm">Mot de passe</label>
                    <br>
                    <input type="password" name="password" id="password" class="inputForm inputFormSmall">
                </div>
                <div class="formDiv">
                    <input type="submit" value="modifier" id="personnalInfoModif" class="inputSubmit">
                    <div class="containeurCancelButton" id="cancelButtonContainer"></div>
                </div>
            </div> 
                <p id="errorMessage"></p>
            </form>
            <button id="deconnexion" class="deconnexionButton">Se déconnecter</button>
        </div>
        <button class="buttonAcordeonIn"><span class="buttonAcrodeonLeftContent">Carte bancaires enregistrées</span><span class="buttonAcrodeonRightContent">►</span></button>
        <div class="acordeonContentIn">
            <form method="post" class="formPersonnalInfos">
                <div class="formRow3">
                    <div>
                        <label for="numero" class="labelForm">Numéro de carte</label>
                        <input type="text" name="numero" id="numero" value="" class="inputForm inputFormLarge">
                    </div>
                </div>
                <div class="formRow6">
                    <div>
                        <label for="date" class="labelForm">Date d'expiration</label>
                        <br>
                        <input type="text" name="date" id="date" value="" class="inputForm inputFormSmall">
                    </div>
                    <div>
                        <label for="crypto" class="labelForm">Cryptogramme</label>
                        <br>
                        <input type="text" name="crypto" id="crypto" value="" class="inputForm inputFormSmall">
                    </div>
                </div>
                <div class="inputCBDiv">
                    <input type="submit" value="Modifier" class="inputSubmit">
                </div>
            </form>
        </div>
    </div>
    <button class="buttonAcordeon" id="btn2"><span class="buttonAcrodeonLeftContent">Mes commandes</span><span class="buttonAcrodeonRightContent">►</span></button>
    <div class="acordeonContent" id="content2">
        <button class="buttonAcordeonIn"><span class="buttonAcrodeonLeftContent">Commandes en cours</span><span class="buttonAcrodeonRightContent">►</span></button>
        <div class="acordeonContentIn">
        </div>
        <button class="buttonAcordeonIn"><span class="buttonAcrodeonLeftContent">Historique de commandes</span><span class="buttonAcrodeonRightContent">►</span></button>
        <div class="acordeonContentIn">
        </div>
    </div>
    <button class="buttonAcordeon" id="btn3"><span class="buttonAcrodeonLeftContent">Mes commentaires</span><span class="buttonAcrodeonRightContent">►</span></button>
    <div class="acordeonContent" id="content3">
    </div>
<script src="./assets/js/profil.js?t=<?= time(); ?>"></script>
<?php
echo "
<script>
    document.getElementById('deconnexion').addEventListener('click', (event) => {
        event.preventDefault();
        window.location.href = '".$router->generate('deconnexion')."';
    });

    var errorMessages = document.getElementById('errorMessage');

    var name = document.getElementById('name');
    var firstname = document.getElementById('firstname');
    var email = document.getElementById('email');
    var phone = document.getElementById('telephone');
    var adresse = document.getElementById('adresse'); // Corrected variable name
    var postalCode = document.getElementById('code_postal');
    var city = document.getElementById('ville');
    var password = document.getElementById('password');
    var personalInfoModif = document.getElementById('personnalInfoModif');

    var initialName = name.value;
    var initialFirstname = firstname.value;
    var initialEmail = email.value;
    var initialPhone = phone.value;
    var initialAdresse = adresse.value;
    var initialPostalCode = postalCode.value;
    var initialCity = city.value;
    var initialPassword = password.value;
    
    personalInfoModif.addEventListener('click', function() {
        if (personalInfoModif.value === 'enregistrer') {
            if (name.value === '' || password.value === '' || email.value === '' || phone.value === '' || adresse.value === '' || firstname.value === '' || postalCode.value === '' || city.value === '') {
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

            if(initialName != name.value){
                nameChanged = name.value;
            }else{
                nameChanged = initialName;
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


            window.location.href = '".$router->generate('updateController')."?changeEmail='+emailChanged+'&changePhone='+phoneChanged+'&changePassword='+passwordChanged+'&changeName='+nameChanged+'&changeFirstname='+firstnameChanged+'&changeAdresse='+adresseChanged+'&changePostalCode='+postalCodeChanged+'&changeCity='+cityChanged;


            name.disabled = true;
            firstname.disabled = true;
            email.disabled = true;
            phone.disabled = true;
            address.disabled = true;
            postalCode.disabled = true;
            city.disabled = true;
            password.disabled = true;
            personalInfoModif.value = 'modifier';            
        }
    });
</script>
";
?>