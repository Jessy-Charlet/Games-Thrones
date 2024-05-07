<?php
if(isset($_SESSION)){
    $id = $_SESSION['user'];
}

$user = new CrudUser();

if($user->checkRole($id) === false){
    header('Location: /');
}else{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <section id="section">
            <form method="post" id="form">
                <label for="email">Adresse mail :</label><br>
                <input type="email" id="email" name="email" required autocomplete="off"><br>
                <label for="password">Mot de passe :</label><br>
                <input type="password" id="password" name="password" required autocomplete="off"><br>
                <input type="submit" value="Se connecter" id="submit">
                <p id="error">
                    <?php
                        if(isset($_GET['error'])){
                            if($_GET['error'] == 'mailNotFound'){
                                echo 'Adresse mail non trouvée';
                            }elseif($_GET['error'] == 'wrongPassword'){
                                echo 'Mot de passe incorrect';
                            }elseif($_GET['error'] == 'unexpectedError'){
                                echo 'Une erreur inattendue est survenue';
                            }elseif($_GET['error'] == 'notAdmin'){
                                echo 'Vous n\'avez pas les droits pour accéder à cette page';
                            }
                        }
                    ?>
                </p>
            </form>
        </section>
    <script src="./controller/js/backOfficeConnController.js"></script>
    </body>
    </html>
    <?php
}
?>