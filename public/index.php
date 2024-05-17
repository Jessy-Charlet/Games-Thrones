<?php
require '../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();

// Création des routes
// route de page affichée
// $router->map('METHOD', '/url/to/page', '/path/to/file_name', 'name_route');
$router->map('GET', '/', '/home', 'accueil');
$router->map('GET', '/connexion', '/signIn', 'connexion');
$router->map('GET', '/inscription', '/signUp', 'inscription');
$router->map('GET', '/profil', '/profil', 'profil');
$router->map('GET', '/cgv', '/cgv', 'cgv');
$router->map('GET', '/rgpd', '/rgpd', 'rgpd');
$router->map('GET', '/mention', '/mention', 'mention');
$router->map('GET', '/contact', '/contact', 'contact');
$router->map('GET', '/produit', '/product', 'produit');
$router->map('GET', '/404', '/404', '404');
$router->map('GET', '/panier', '/basket', 'panier');
$router->map('GET', '/filtre', '/filters', 'filtre');
$router->map('GET', '/checkout', '/checkout_backend', 'checkout_backend');
$router->map('GET', '/success', '/success', 'success');
$router->map('GET', '/cancel', '/cancel', 'cancel');

// route de page de traitement
$router->map('POST', '/signUpControllerphp', '../public/controller/php/signUpController', 'signUpControllerphp');
$router->map('POST', '/signInControllerphp', '../public/controller/php/signInController', 'signInControllerphp');
$router->map('GET', '/deconnexion', '../public/controller/php/deconnexion', 'deconnexion');
$router->map('POST', '/profilControllerphp', '../public/controller/php/profilController', 'profilControllerphp');
$router->map('POST', '/backOfficeControllerphp', '../public/controller/php/backOffice/backOfficeController', 'backOfficeControllerphp');

// Routes to AJAX files
$router->map('GET', '/api/panier', '/basket_json', '/Ajax/panier');
$router->map('GET', '/addProductToBasketAjaxController', '../public/controller/php/ajax/addProductToBasketAjaxController', 'addProductToBasketAjaxController');
$router->map('GET', '/getProductDataByIdAjaxController', '../public/controller/php/ajax/getProductDataByIdAjaxController', 'getProductDataByIdAjaxController');
$router->map('GET', '/getCartContentsAjaxController', '../public/controller/php/ajax/getCartContentsAjaxController', 'getCartContentsAjaxController');

// Routes Back Office
$router->map('GET', '/gt-admin', '../public/backOffice/backOffice', 'backOffice');

function my_autoloader($class)
{
    include 'controller/php/classes/' . $class . '.class.php';
}

// Enregistrement de la fonction d'autoload
spl_autoload_register('my_autoloader');

$match = $router->match();

if (is_array($match)) {
    // Handle routes that send JSON
    if (str_contains($match["name"], "Ajax")) {
        if (is_callable($match['target'])) {
            call_user_func_array($match['target'], $match['params']);
        } else {
            $params = $match['params'];
            require "../src/{$match['target']}.php";
        }
    } else if (str_contains($match["name"], "_backend")) {
        if (is_callable($match['target'])) {
            call_user_func_array($match['target'], $match['params']);
        } else {
            $params = $match['params'];
            require "../src/{$match['target']}.php";
        }
    } else {
        // Handle routes that send HTML
        require '../templates/header.php';
        if (is_callable($match['target'])) {
            call_user_func_array($match['target'], $match['params']);
        } else {
            $params = $match['params'];
            require "../src/{$match['target']}.php";
        }
        require '../templates/footer.php';
        echo "</html>";
    }
} else {
    // 404 error 
    header("location:" . $router->generate('404') . "");
}
