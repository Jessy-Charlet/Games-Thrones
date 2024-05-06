<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<!-- Meta -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games Thrones</title>

    <link rel="icon" type="image/png" href="./assets/img/favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="./assets/css/global.css?t=<?= time(); ?>">
    <link rel="stylesheet" href="./assets/css/header.css?t=<?= time(); ?>">
    <link rel="stylesheet" href="./assets/css/footer.css?t=<?= time(); ?>">
    <link rel="stylesheet" href="./assets/css/banner.css?t=<?= time(); ?>">
    <link rel="stylesheet" href="./assets/css/product.css?t=<?= time(); ?>">
    <link rel="stylesheet" href="./assets/css/products.css?t=<?= time(); ?>">
    <link rel="stylesheet" href="./assets/css/basket.css?t=<?= time(); ?>">

</head>

<body>
    <div id="upToTop"></div>
    <!-- Menu PC -->
    <header id="navContainer">
        <nav class="navLeft">
            <a href="/filtre">Shop</a>
            <button id="infos">Infos </button>
        </nav>
        <a href="<?= $router->generate('accueil') ?>" id="logo"><img src="./assets/img/logo_Games_Thrones_nav.png" alt="Logo Games Thrones" /></a>
        <div id="searchBarContainer">
            <input type="text" name="searchBar" id="searchBar" placeholder="Chercher un Throne...">
            <button id="searchBarClose">❌</button>
        </div>
        <!-- -->
        <button id="searchBarOpen"><img src="./assets/img/icon_search.png" alt="rechercher" /></button>
        <a href="<?= $router->generate('panier') ?>"><img src="./assets/img/icon_panier.png" alt="Mon panier" />
            <?php
            if (isset($_SESSION['basketQuantity'])) {
                echo "<span id='header_totalProductsQuantity'>" . $_SESSION['basketQuantity'] . "</span>";
            }
            ?>
        </a>
        <?php
        if (isset($_SESSION['user'])) {
        ?>
            <a href="<?= $router->generate('profil') ?>"><img src="./assets/img/icon_user.png" alt="Mon compte" />
                <div><?= $_SESSION['userFirstName'] ?></div>
            </a>
        <?php
        } elseif (!isset($_SESSION['user'])) {
        ?>
            <a href="<?= $router->generate('connexion') ?>"><img src="./assets/img/icon_user.png" alt="Me connecter" /></a>
        <?php
        }
        ?>
    </header>
    <!-- Menu slide shop -->
    <nav id="navShop">
    </nav>

    <!-- Menu slide infos -->
    <nav id="navInfos">
        <div>
            <div class="navContainer">
                <div class="navH1">L'actu</div>
                <a class="promotions" href="">Promotions</a>
            </div>
            <div class="navContainer">
                <div class="navH1">Service client</div>
                <a href="<?= $router->generate('contact') ?>">Contactez-nous</a>
                <a href="">Foire aux questions</a>
                <a href="">Expédition et livraison</a>
                <a href="">Garantie</a>
            </div>
            <div class="navContainer">
                <div class="navH1">Mentions légales</div>
                <a href="<?= $router->generate('rgpd') ?>">RGPD</a>
                <a href="<?= $router->generate('cgv') ?>">CGV</a>
            </div>
        </div>
    </nav>


    <!-- Menu slide recherche -->
    <nav id="navSearch">
        <div class="navContainer">
            <p>Aucun résultat...</p>
            <a href="#upToTop" id="fleche">▲ ▲ ▲</a>
        </div>
    </nav>


    <!-- Menu Mobile -->
    <header id="navContainerMobile">
        <a href="<?= $router->generate('accueil') ?>"><img id="logoMobile" src="./assets/img/logo_Games_Thrones_nav_mobile.png" alt="Logo Games Thrones" /></a>
        <div id="menuBurger">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <a href="<?= $router->generate('panier') ?>"><img src="./assets/img/icon_panier.png" alt="Mon panier" />
            <span id="header_totalProductsQuantityBottom">2</span>
        </a>
        <?php
        if (isset($_SESSION['user'])) {
        ?>
            <a href="<?= $router->generate('profil') ?>"><img src="./assets/img/icon_user.png" alt="Mon compte" /></a>
        <?php
        } else {
        ?>
            <a href="<?= $router->generate('connexion') ?>"><img src="./assets/img/icon_user.png" alt="Me connecter" /></a>
        <?php
        }
        ?>
    </header>
    <main>