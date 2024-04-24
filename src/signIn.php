<?php
if(isset($_SESSION['user'])){
    header('Location: '.$router->generate('profil'));
    exit();
}else{
if(isset($_GET['mail'])){
    $mail = $_GET['mail'];
}else{
    $mail = '';
}

if(isset($_GET['error']) && $_GET['error'] == 'error'){
    $error = "Erreur: Mot de passe ou adresse mail invalide.";
}
?>
<section class="corp">
    <div class="signInFormContainer">
        <h1 class="signInFormTitle">Se connecter</h1>
        <form id="myForm" method="post" class="signInForm">
            <label for="emailId" class="signInFormLabel">Email</label><br>
                <input type="email" value="<?= $mail ?>" name="email" id="emailId" class="signInFormInput" autocomplete="off" ><br><br>
            <label for="password" class="signUpFormLabel">Mot de passe</label><br>
                <input type="password" name="password" id="password" class="signUpFormInput" autocomplete="off" ><br><br>
                <input type="submit" id="signInButton">
            <p class="signInFormText">Vous n'avez pas de compte ? <a href="<?= $router->generate('inscription') ?>" class="signInFormLink">Inscrivez-vous</a></p>
            <p id="errorMessage">
                <?php 
                    if(isset($error)){
                        echo $error;
                    }
                ?>
             </p>
        </form>
    </div>
</section>
<script src="./controller/js/signInController.js?t=<?= time() ?>"></script>
<?php
}
?>