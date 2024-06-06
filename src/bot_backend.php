<!DOCTYPE html>
<html lang="fr">

<!-- Meta -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office</title>

    <link rel="icon" type="image/png" href="./assets/img/favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="./assets/css/global.css?t=<?= time(); ?>">
    <link rel="stylesheet" href="./assets/css/bot.css?t=<?= time(); ?>">

</head>

<body>

    <header class="headerBack">
        <a href="/">⮉</a>
        <h1>Back Office</h1>
        <p>Games Thrones</p>
    </header>
    <section class="bodyBack">
        <nav>
            <input type="text" id="rechercheBack" placeholder="Recherche">
            <button id="bProduct">Produits</button>
            <button id="bCategory">Catégories</button>
            <button id="bOrder">Commandes</button>
            <button id="bCustomer">Clients</button>
            <button id="bReview">Commentaires</button>
            <button id="bRate">Notes</button>
        </nav>
        <section id="contentBack">
            <template id= templateProduct>
            </template>
        </section>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./controller/js/backOffice/bot.js"></script>
</body>