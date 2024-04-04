<?php
if(isset($_GET['mail'])){
    $mail = $_GET['mail'];
}else{
    $mail = '';
}
?>
<main>
    <div class="signInFormContainer">
        <h1 class="signInFormTitle">Se connecter</h1>
        <form id="myForm" method="post" action="<?= $router->generate('signInControllerphp') ?>" class="signInForm">
            <label for="emailId" class="signInFormLabel">Email</label><br>
                <input type="email" value="<?= $mail ?>" name="email" id="emailId" class="signInFormInput" autocomplete="off" ><br><br>
            <label for="passwordConfirmId" class="signUpFormLabel">Mot de passe</label><br>
                <input type="password" name="passwordConfirm" id="passwordConfirmId" class="signUpFormInput" autocomplete="off" ><br><br>
                <input type="submit">
            <p class="signInFormText">Vous n'avez pas de compte ? <a href="<?= $router->generate('inscription') ?>" class="signInFormLink">Inscrivez-vous</a></p>
        </form>
    </div>
</main>