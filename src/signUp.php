<?php
include '../templates/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
</head>
<body>
    <div class="signUpFormContainer">
        <h1 class="signUpFormTitle">S'inscrire</h1>
        <form action="#" method="post" class="signUpForm">
            <label for="name" class="signUpFormLabel">Nom</label>
            <input type="text" name="name" id="name" class="signUpFormInput" required>
            <label for="firstname" class="signUpFormLabel">Prénom</label>
            <input type="text" name="firstname" id="firstname" class="signUpFormInput" required>
            <label for="email" class="signUpFormLabel">Email</label>
            <input type="email" name="email" id="email" class="signUpFormInput" required>
            <label for="phone" class="signUpFormLabel">Téléphone</label>
            <input type="tel" name="phone" id="phone" class="signUpFormInput" required>
            <label for="address" class="signUpFormLabel">Adresse</label>
            <input type="text" name="address" id="address" class="signUpFormInput" required>
            <label for="password" class="signUpFormLabel">Mot de passe</label>
            <input type="password" name="password" id="password" class="signUpFormInput" required>
            <label for="passwordConfirm" class="signUpFormLabel">Confirmer le mot de passe</label>
            <input type="password" name="passwordConfirm" id="passwordConfirm" class="signUpFormInput" required>
            <input type="submit" value="S'inscrire" class="signUpFormSubmit">
        </form>
    </div>
</body>
</html>