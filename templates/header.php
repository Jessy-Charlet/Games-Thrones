<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games Thrones</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/github/Games-Thrones/assets/css/global.css?t=<?= time(); ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/github/Games-Thrones/assets/css/header.css?t=<?= time(); ?>">
</head>

<body>
    <header id="navContainer">
        <nav class="navLeft">
            <button id="shop">Shop <span>></span></button>
            <button id="infos">Infos <span>></span></button>
        </nav>
        <a href="./index.php" id="logo"><img src="./assets/img/logo_Games_Thrones_nav.png" alt="Logo Games Thrones" /></a>
        <div id="searchBarContainer">
            <input type="text" name="searchBar" id="searchBar" placeholder="Chercher un Throne...">
            <button id="searchBarClose">❌</button>
        </div>
        <button id="searchBarOpen"><img src="./assets/img/icon_search.png" alt="rechercher" /></button>
        <a href="<!--PAGE DU PANIER-->"><img src="./assets/img/icon_panier.png" alt="Mon panier" /><span>2</span></a>
        <a href="./src/signIn.php"><img src="./assets/img/icon_user.png" alt="Mon compte" /></a>

    </header>
    <header id="navContainerMobile">
        <a href="./index.php"><img id="logoMobile" src="./assets/img/logo_Games_Thrones_nav_mobile.png" alt="Logo Games Thrones" /></a>
        <div id="menuBurger">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <a href="<!--PAGE DU PANIER-->"><img src="./assets/img/icon_panier.png" alt="Mon panier" /><span>2</span></a>
        <a href="./src/signIn.php"><img src="./assets/img/icon_user.png" alt="Mon compte" /></a>
    </header>