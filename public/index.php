<?php
require '../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();

// Création des routes
// route de page affichée
$router->map('GET', '/', '/home', 'accueil');
$router->map('GET', '/connexion', '/signIn', 'connexion');
$router->map('GET', '/inscription', '/signUp', 'inscription');
$router->map('GET', '/profil', '/profil', 'profil');
$router->map('GET', '/cgv', '/cgv', 'cgv');
$router->map('GET', '/rgpd', '/rgpd', 'rgpd');
$router->map('GET', '/mention', '/mention', 'mention');
$router->map('GET', '/contact', '/contact', 'contact');
$router->map('GET', '/produit', '/product', 'produit');


function my_autoloader($class)
{
    include 'controller/php/classes/' . $class . '.class.php';
}

// Enregistrement de la fonction d'autoload
spl_autoload_register('my_autoloader');

$match = $router->match();

if (is_array($match)) {
    require '../templates/header.php';
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        $params = $match['params'];
        require "../src/{$match['target']}.php";
    }
    require '../templates/footer.php';
} else {
    header("location:".$router->generate('404')."");
}
?>

</html>