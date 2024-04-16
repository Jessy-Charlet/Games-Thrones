<?php
require '../public/controller/php/connBDD.php';

$id = $_SESSION['user'];

$sql = $conn->prepare('SELECT * FROM customer WHERE customer_id = :id');
$sql->execute(
    array(
        'id' => $id
    )
);
$userData = $sql->fetch(PDO::FETCH_ASSOC);
$sql->closeCursor();


$sql = $conn->prepare('SELECT * FROM adress WHERE customer_id = :id');
$sql->execute(
    array(
        'id' => $id
    )
);
$adressData = $sql->fetch(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="./assets/css/profil.css?t=<?= time(); ?>">
<script src="./assets/js/profil.js?t=<?= time(); ?>"></script>
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
                </div>
            </div> 
                <p id="errorMessage"></p>
            </form>
            <form method="post" action="<?= $router->generate('deconnexion') ?>">
                <input type="submit" value="Se déconnecter">
            </form>
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
