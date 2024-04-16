<?php
require '../public/controller/php/connBDD.php';

$id = $_SESSION['user'];

$user = new Crud();
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
                    <label for="nom" class="labelForm">Nom</label>
                    <br>
                    <input type="text" name="nom" id="nom" value="<?= $userData['customer_last-name'] ?>" class="inputForm inputFormSmall">
                </div>
                <div>
                    <label for="prenom" class="labelForm">Prénom</label>
                    <br>
                    <input type="text" name="prenom" id="prenom" value="<?= $userData['customer_first-name'] ?>" class="inputForm inputFormSmall">
                </div>
            </div>
            <div class="formRow2">
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
            <div class="formRow4">
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
            <div class="formRow5">
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
            <form method="post">
                <label for="numero">Numéro de carte</label>
                <input type="text" name="numero" id="numero" value="">
                <label for="date">Date d'expiration</label>
                <input type="text" name="date" id="date" value="">
                <label for="crypto">Cryptogramme</label>
                <input type="text" name="crypto" id="crypto" value="">
                <input type="submit" value="Enregistrer">
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

    var name = document.getElementById('nom');
    var firstname = document.getElementById('prenom');
    var email = document.getElementById('email');
    var phone = document.getElementById('telephone');
    var addresse = document.getElementById('adresse'); // Corrected variable name
    var postalCode = document.getElementById('code_postal');
    var city = document.getElementById('ville');
    var password = document.getElementById('password');
    var personalInfoModif = document.getElementById('personnalInfoModif');
    
    personalInfoModif.addEventListener('click', function() {
        if (personalInfoModif.value === 'enregistrer') {
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
                    var errorMessage = 'Phone number format is incorrect. It should be like \"00 00 00 00 00\".';
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

            window.location.href = '".$router->generate('updateController')."';
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
        }
    });
</script>
";
?>