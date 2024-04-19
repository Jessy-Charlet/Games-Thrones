<?php
$id = $_SESSION['user'];

$user = new CrudUser();
$userAlldata = $user->getAll($id);
$userData = $userAlldata['userData'];
$adressData = $userAlldata['adressData'];


if(isset($_GET['update'])){
    $updateResult = $_GET['update'];

    // Vérifiez s'il y a plusieurs paramètres 'update' dans l'URL
    if(substr_count($_SERVER['QUERY_STRING'], 'update') > 1){

        // Supprimez tous les paramètres 'update' sauf un
        $params = $_GET;
        unset($params['update']);
        $url = strtok($_SERVER["REQUEST_URI"], '?');
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        $url .= '&update=' . $updateResult;

        // Redirigez vers l'URL sans les paramètres 'update' en double
        header("Location: " . $url);
        exit();
    }
    if (!isset($_SESSION['first_load'])){
        $_SESSION['first_load'] = true;
    }else{
        if ($_SESSION['first_load'] == true){
        // La page a été rechargée
        $pageActuelle = strtok($_SERVER['REQUEST_URI'], '?');
        header("Location: $pageActuelle");

        // Réinitialisez la variable de session pour le prochain chargement de la page
        $_SESSION['first_load'] = false;
        }else{
        // La page est chargée pour la première fois
        $_SESSION['first_load'] = true;
        
        }
    }
}
?>
<link rel="stylesheet" href="./assets/css/profil.css?t=<?= time(); ?>">
    <button class="buttonAcordeon" id="btn1"><span class="buttonAcrodeonLeftContent">Mon compte</span><span class="buttonAcrodeonRightContent">►</span></button>
    <div class="acordeonContent" id="content1">
        <button class="buttonAcordeonIn"><span class="buttonAcrodeonLeftContent">Informations personnelles</span><span class="buttonAcrodeonRightContent">►</span></button>
        <div class="acordeonContentIn">
            <form method="post" class="formPersonnalInfos" id="personalInfoForm">
            <div class="formRow1">
                <div>
                    <label for="nameId" class="labelForm">Nom</label>
                    <br>
                    <input type="text" name="name" id="nameId" value="<?= $userData['customer_last-name'] ?>" class="inputForm inputFormSmall">
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
                <p id="errorMessage">
                    <?php
                    if(isset($updateResult)){
                        if($updateResult == 'success'){
                            ?><p class="updateResult">Vos informations ont bien été modifiées.</p><?php
                        }else{
                            ?><p class="updateResult">Une erreur est survenue lors de la modification de vos informations.</p><?php
                        }
                    }
                    ?>
                </p>
            </form>
            <a href="<?= $router->generate('deconnexion');  ?>" class="deconnexionButton">Se déconnecter</a>
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
            <div id="commandeContainer">
                
            </div>
        </div>
        <button class="buttonAcordeonIn"><span class="buttonAcrodeonLeftContent">Historique de commandes</span><span class="buttonAcrodeonRightContent">►</span></button>
        <div class="acordeonContentIn">
        </div>
    </div>
    <button class="buttonAcordeon" id="btn3"><span class="buttonAcrodeonLeftContent">Mes commentaires</span><span class="buttonAcrodeonRightContent">►</span></button>
    <div class="acordeonContent" id="content3">
    </div>
<script src="./assets/js/profil.js?t=<?= time(); ?>"></script>
<script src="./controller/js/profilController.js?t=<?= time(); ?>"></script>