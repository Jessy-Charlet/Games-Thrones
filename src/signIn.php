<?php
if(isset($_GET['mail'])){
    $mailSave = $_GET['mail'];
}
if(isset($_GET['password'])){
    $passwordSave = $_GET['password'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>