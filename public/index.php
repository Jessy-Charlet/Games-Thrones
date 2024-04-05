<?php
require '../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();

$router->map('GET', '/acceuil', '/home', 'acceuil');
$router->map('GET', '/connexion', '/signIn', 'connexion');
$router->map('GET', '/inscription', '/signUp', 'inscription');
$router->map('POST', '/signUpControllerphp', '../public/controller/php/signUpController', 'signUpControllerphp');
$router->map('POST', '/signInControllerphp', '../public/controller/php/signInController', 'signInControllerphp');
$router->map('GET', '/profil', '/profil', 'profil');
$router->map('POST', '/deconnexion', '../public/controller/php/deconnexion', 'deconnexion');

$match = $router->match();

if(is_array($match)){
    require '../templates/header.php';
    ?> 
    <main> 
        <?php
        if(is_callable($match['target'])){
            call_user_func_array($match['target'], $match['params']);
        }else{
            $params = $match['params'];
            require "../src/{$match['target']}.php";
        }
        ?>
    </main>
    <?php
    require '../templates/footer.php';
}else{
    echo '404';
}
?>
</html>