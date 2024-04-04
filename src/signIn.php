<?php
if(isset($_GET['mail'])){
    $mailSave = $_GET['mail'];
}
if(isset($_GET['password'])){
    $passwordSave = $_GET['password'];
}
?>
<?php
require_once(__DIR__."/../templates/header.php");
?>
<main>
    <div class="signInFormContainer">
        <h1 class="signInFormTitle">Se connecter</h1>
        <form id="myForm" method="post" action="../controller/php/signInController.php" class="signInForm">
            <label for="emailId" class="signInFormLabel">Email</label><br>
                <input type="email" value="<?php if(isset($mailSave)){echo $mailSave;}?>" name="email" id="emailId" class="signInFormInput" autocomplete="off" ><br><br>
            <label for="passwordConfirmId" class="signUpFormLabel">Confirmer le mot de passe</label><br>
                <input type="password" name="passwordConfirm" id="passwordConfirmId" class="signUpFormInput" autocomplete="off" ><br><br>
                <input type="submit">
        </form>
    </div>
</main>
    <?php
require_once(__DIR__."/../templates/footer.php");
?>
</html>