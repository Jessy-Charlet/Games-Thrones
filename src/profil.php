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
    <button class="buttonAcordeon">Mon compte <span>►</span></button>
    <div class="acordeonContent">
        <button>Informations personnelles <span>►</span></button>
            <div>
                <form method="post">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?= $userData['customer_last-name'] ?>">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" id="prenom" value="<?= $userData['customer_first-name'] ?>">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?= $userData['email'] ?>">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" name="telephone" id="telephone" value="<?= $userData['phone'] ?>">
                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" id="adresse" value="<?= $adressData['adress'] ?>">
                    <label for="code_postal">Code postal</label>
                    <input type="text" name="code_postal" id="code_postal" value="<?= $adressData['postal_code'] ?>">
                    <label for="ville">Ville</label>
                    <input type="text" name="ville" id="ville" value="<?= $adressData['city'] ?>">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password">
                    <input type="submit" value="modifier">
                </form>
                <form method="post" action="<?= $router->generate('deconnexion') ?>">
                    <input type="submit" value="Se déconnecter">
                </form>
            </div>
        <button>Cartes bancaires enregisrtées <span>►</span></button>
            <div>
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
    <button class="buttonAcordeon">Mes commandes <span>►</span></button>
    <div class="acordeonContent">
        <button>Commandes en cours <span>►</span></button>
            <div>
            </div>
        <button>Historique des commandes <span>►</span></button>
    </div>
    <button class="buttonAcordeon">Mes commantaires <span>►</span></button>
        <div class="acordeonContent">
        </div>