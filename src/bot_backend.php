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
                <div id="blockID" class="blockBack">
                    <div class="blockHead">
                        <p>Nom</p>
                        <p>Prix</p>
                        <p>Qte</p>
                        <div>
                            <button>Modifier</button>
                            <button>X</button>
                        </div>
                    </div>
                    <div class="blockBody">
                        <form action="" method="get" class="formBack">
                            <div>
                                <label for="name">Nom</label>
                                <input type="text" name="name" id="name" value="Super chaise Licorne" required />
                            </div>
                            <div>
                                <label for="price">Prix</label>
                                <input type="text" name="price" id="price" value="500" required />
                            </div>
                            <div>
                                <label for="quantity">Quantité</label>
                                <input type="text" name="quantity" id="quantity" value="20" required />
                            </div>
                            <div>
                                <label for="color">Couleur</label>
                                <input type="text" name="color" id="color" value="Arc-en-ciel" required />
                            </div>
                            <div>
                                <label for="material">Matière</label>
                                <input type="text" name="material" id="material" value="Cuir de Licorne" required />
                            </div>
                            <div>
                                <label for="brand">Marque</label>
                                <input type="text" name="brand" id="brand" value="Pro Gamer" required />
                            </div>
                            <div>
                                <label for="category">Catégorie</label>
                                <input type="text" name="category" id="category" value="Chaise gaming" required />
                            </div>
                            <div class="textarea">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="8">La chaise gaming est dotée d\'un support lombaire amovible, qui peut protéger efficacement la colonne vertébrale et le cou. L\'oreiller lombaire avec fonction de massage produit plus de 20000 vibrations par heure pour soulager efficacement la fatigue pendant un travail ou un gaming. L\'oreiller lombaire a un câble USB pour se connecter à la prise de courant. L\'interrupteur sur le cordon vous permet d\'activer et de désactiver la fonction de massagePOSTURE CONFORTABLE - Il s\'agit d\'une véritable chaise gamer pour les passionnés de gamers! Ce chaise gaming massante offre un soutien total de la tête aux pieds. L\'angle du dossier peut être facilement ajusté de 90° à 135°. Le repose-pieds, l\'appui-tête et l\'oreiller lombaire vous permettent de vous allonger en attendant que votre fête soit enfin en ligne. Le dossier et les accoudoirs sont entièrement rembourrés de éponge pour fournir un soutien adéquat pour la colonne vertébrale et les coudes REMBOURRÉ - Le dossier et les accoudoirs sont en éponge entièrement élastique et ne se déforment pas, vous pouvez donc profiter longtemps de cette siège gaming. La selle est en éponge de 8 cm d\'épaisseur qui offre une densité d\'assise constante pour les longues sessions. Le cuir PU perforé avec un aspect fibre de carbone assure la respirabilité pour les joueurs à long terme. Nos chaise gaming massage avec motif en V de l\'appui-tête au soutien lombaire, symbolisant la victoire
                        </textarea>
                            </div>
                            <div>
                                <input type="submit" value="Annuler" />
                            </div>
                            <div>
                                <input type="submit" value="Valider" />
                            </div>
                        </form>
                    </div>
                </div>
            </template>
        </section>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./controller/js/backOffice/bot.js"></script>
</body>