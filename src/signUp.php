<?php
if(isset($_SESSION['user'])){
    ?>
        <script>
            window.location.href = '/';
        </script>
   <?php 
    exit();
}else{
    if(isset($_GET['error'])){
        if($_GET['error'] == 'mailAlreadyUsed'){
            echo '<p class="signUpFormError">L\'adresse mail est déjà utilisée</p>';
        }elseif($_GET['error'] == 'phoneAlreadyUsed'){
            echo '<p class="signUpFormError">Le numéro de téléphone est déjà utilisé</p>';
        }elseif($_GET['error'] == "UnexpectedError"){
            echo '<p class="signUpFormError">Une erreur inattendue est survenue</p>';
        }
        if(isset($_GET['name'])){
            $nameSave = $_GET['name'];
        }
        if(isset($_GET['firstname'])){
            $firstnameSave = $_GET['firstname'];
        }
        if(isset($_GET['mail'])){
            $mailSave = $_GET['mail'];
        }
        if(isset($_GET['phone'])){
            $phoneSave = $_GET['phone'];
        }
        if(isset($_GET['adress'])){
            $adressSave = $_GET['adress'];
        }
        if(isset($_GET['postalCode'])){
            $postalCodeSave = $_GET['postalCode'];
        }
        if(isset($_GET['city'])){
            $citySave = $_GET['city'];
        }

    }

?>
<section class="corp">
    <div class="signUpFormContainer">
        <h1 class="signUpFormTitle">S'inscrire</h1>
        <form id="myForm" method="post" action="<?= $router->generate('signUpControllerphp') ?>" class="signUpForm">
            <label for="nameId" class="signUpFormLabel">Nom</label><br>
                <input type="text" value="<?php if(isset($nameSave)){echo $nameSave;}?>" name="name" id="nameId" class="signUpFormInput" autocomplete="off" ><br><br>
            <label for="firstnameId" class="signUpFormLabel">Prénom</label><br>
                <input type="text" value="<?php if(isset($firstnameSave)){echo $firstnameSave;}?>" name="firstname" id="firstnameId" class="signUpFormInput" autocomplete="off" ><br><br>
            <label for="emailId" class="signUpFormLabel">Email</label><br>
                <input type="email" value="<?php if(isset($mailSave)){echo $mailSave;}?>" name="email" id="emailId" class="signUpFormInput" autocomplete="off" ><br><br>
            <label for="phoneId" class="signUpFormLabel">Téléphone</label><br>
                <input type="tel" value="<?php if(isset($phoneSave)){echo $phoneSave;}?>" name="phone" id="phoneId" class="signUpFormInput" autocomplete="off" maxlength="14" pattern="\d*"><br><br>
            <label for="adressId" class="signUpFormLabel">Adresse</label><br>
                <input type="text" value="<?php if(isset($adressSave)){echo $adressSave;}?>" name="adress" id="adressId" class="signUpFormInput" autocomplete="off" ><br><br>
            <label for="postalCodeId" class="signUpFormLabel">Code postal</label><br>
                <input type="text" value="<?php if(isset($postalCodeSave)){echo $postalCodeSave;}?>" name="postalCode" id="postalCodeId" class="signUpForm" autocomplete="off" ><br><br>
            <label for="cityId" class="signUpFormLabel">Ville</label><br>
                <input type="text" value="<?php if(isset($citySave)){echo $citySave;}?>" name="city" id="cityId" class="signUpFormInput" autocomplete="off" ><br><br>
            <label for="passwordId" class="signUpFormLabel">Mot de passe</label><br>
                <input type="password" name="password" id="passwordId" class="signUpFormInput" autocomplete="off" ><br><br>
            <label for="passwordConfirmId" class="signUpFormLabel">Confirmer le mot de passe</label><br>
                <input type="password" name="passwordConfirm" id="passwordConfirmId" class="signUpFormInput" autocomplete="off" ><br><br>
            <input type="submit" class="signUpFormSubmit" id="submitBtn" value="S'inscrire"><br>
        </form>
        <p class="signUpFormLink">Vous avez déjà un compte ? <a href="<?= $router->generate('connexion') ?>" class="signUpFormLink">Connectez-vous</a></p>
        <p id="errorMessage" class="signUpFormError"></p>
    </div>
</section>
<script src="controller/js/signUpController.js"></script>
<?php
}
?>  