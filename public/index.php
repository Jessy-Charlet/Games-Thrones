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

// Fonction d'autoload
function my_autoloader($class)
{
    $class_file = __DIR__ . '/controller/php/classes/' . $class . '.class.php';
    if (file_exists($class_file)) {
        include $class_file;
    } else {
        throw new Exception("Class not found: $class");
    }
}

spl_autoload_register('my_autoloader');

// Trouver la route correspondante
$match = $router->match();

// Fonction pour générer le fil d'Ariane
function generateBreadcrumbs($uri, $router)
{
    $breadcrumbs = [];
    $base_url = $router->generate('accueil');

    // Ajouter l'Accueil au fil d'Ariane
    $breadcrumbs[] = ['name' => 'Accueil', 'url' => $base_url];

    // Décomposer l'URL et générer les autres éléments du fil d'Ariane
    $segments = explode('/', trim($uri, '/'));
    $cumulative_url = $base_url;
    var_dump($segments); echo "<br>";
  

    foreach ($segments as $segment) {
        if ($segment) {
            $cumulative_url .= '/' . $segment;
            //$route_title = ucwords(str_replace('-', ' ', $segment));

            // Exemple de logique pour obtenir le nom de la page et du produit
            $page_name = end($segments); // Obtenez le nom de la page à partir de l'URL
            $productName = end($segments); // Obtenez le nom du produit à partir de l'URL



            $breadcrumbs[] = [
                'name' => $page_name,
                'url' => $cumulative_url
            ];

            $productName = $segments;

               // Si c'est une page produit, ajoutez également le nom du produit
               if (isset($productName) && $productName === 'produit') {
                $breadcrumbs[] = [
                    'name' => $productName,
                    'url' => $cumulative_url  // Peut-être que vous voulez un lien spécifique vers le produit ici
                ];
            }

        }
    }

    return $breadcrumbs;
}


// Obtenir le fil d'Ariane
$breadcrumbs = generateBreadcrumbs($uri, $router);

// Vérifier si une route a été trouvée
if ($match !== false) {
    require '../templates/header.php';
//*****************************************************//
    // Affichage du fil d'Ariane
    echo '<nav aria-label="breadcrumb">';
    echo '<ol class="breadcrumb">';
    foreach ($breadcrumbs as $key => $breadcrumb) {
        $is_last = ($key === count($breadcrumbs) - 1);
        if ($is_last) {
            echo '<li class="breadcrumb-item active" aria-current="page">' . htmlspecialchars($breadcrumb['name']) . '</li>';
        } else {
            echo '<li class="breadcrumb-item"><a href="' . htmlspecialchars($breadcrumb['url']) . '">' . htmlspecialchars($breadcrumb['name']) . '</a></li>';
        }
    }
    echo '</ol>';
    echo '</nav>';
//********************************************************//

    // Exécution du contenu de la page
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        require "../src/{$match['target']}.php";
    }

    // Afficher le pied de page et fermer le document
    require '../templates/footer.php';
    echo "</html>";
} else {
    // Redirection vers la page 404 si la route n'est pas trouvée
    header("Location: " . $router->generate('404'));
    exit(); // Assurez-vous que l'exécution s'arrête après la redirection
}