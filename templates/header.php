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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./assets/css/global.css?t=<?= time(); ?>">
    <link rel="stylesheet" href="./assets/css/header.css?t=<?= time(); ?>">
</head>

<body>
    <!-- Menu PC -->
    <header id="navContainer">
        <nav class="navLeft">
            <button id="shop">Shop </button>
            <button id="infos">Infos </button>
        </nav>
        <a href="<?= $router->generate( 'accueil') ?>" id="logo"><img src="./assets/img/logo_Games_Thrones_nav.png" alt="Logo Games Thrones" /></a>
        <div id="searchBarContainer">
            <input type="text" name="searchBar" id="searchBar" placeholder="Chercher un Throne...">
            <button id="searchBarClose">❌</button>
        </div>
        <!-- -->
        <button id="searchBarOpen"><img src="./assets/img/icon_search.png" alt="rechercher" /></button>
        <a href="<!--PAGE DU PANIER-->"><img src="./assets/img/icon_panier.png" alt="Mon panier" /><span>2</span></a>
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
    <!-- Menu slide shop -->
    <nav id="navShop">
        <div class="navContainer">
            <a class="promotions" href="">Promotions</a>
            <a href="">Dossier inclinable</a>
            <a href="">A roulettes</a>
            <a href="">Sans accoudoires</a>
            <a href="">Découvrir tous nos produit</a>
        </div>
        <div class="navContainer">
            <a href="">Dossier inclinable</a>
            <a href="">A roulettes</a>
            <a href="">Sans accoudoires</a>
            <a href="">Découvrir tous nos produit</a>
        </div>


    </nav>

    <!-- Menu slide infos -->
    <nav id="navInfos">
        <div class="navContainer">
        <div class="navH1">Service client</div>
        <a href="">Contactez-nous</a>
        <a href="">Foire aux questions</a>
        <a href="">Expédition et livraison</a>
        <a href="">Garantie</a>
    </nav>



    <!-- Menu Mobile -->
    <header id="navContainerMobile">
        <a href="<?= $router->generate( 'accueil') ?>"><img id="logoMobile" src="./assets/img/logo_Games_Thrones_nav_mobile.png" alt="Logo Games Thrones" /></a>
        <div id="menuBurger">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <a href="<!--PAGE DU PANIER-->"><img src="./assets/img/icon_panier.png" alt="Mon panier" /><span>2</span></a>
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