<?php
// Fonction pour calculer le total du panier
function calculerTotalPanier() {
    $total = 0;
    if(isset($_SESSION['panier'])) {
        foreach($_SESSION['panier'] as $produit) {
            $total += $produit['prix'] * $produit['quantite'];
        }
    }
    return $total;
}

// Fonction de récupération des produits recommandés (exemple)
function getProduitsRecommandes() {
    // Ici, vous pouvez implémenter la logique pour récupérer les produits recommandés
    // Cela peut être basé sur les catégories des produits dans le panier, les produits les plus vendus, etc.
    // Pour cet exemple, je vais simplement simuler des produits recommandés statiques
    $produits = array(
        array(
            'nom' => 'Tapis de souris gamer',
            'prix' => 15.99
        ),
        array(
            'nom' => 'Casque gaming sans fil',
            'prix' => 99.99
        ),
        array(
            'nom' => 'Clavier mécanique RGB',
            'prix' => 79.99
        )
    );
    return $produits;
}


// Vérifier si le panier est vide ou non
if(!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    echo "Votre panier est vide.";
} else {
    // Afficher les produits dans le panier avec les quantités
    foreach($_SESSION['panier'] as $key => $produit) {
        echo "Nom du fauteuil: " . $produit['nom'] . "<br>";
        echo "Prix unitaire: " . $produit['prix'] . " euros<br>";
        echo "Quantité: <input type='number' name='quantite[$key]' value='".$produit['quantite']."' min='1'><br>";
        // Vous pouvez ajouter d'autres détails du produit ici
        echo "<hr>";
    }

    // Afficher des produits recommandés (cross-selling)
    echo "<h2>Produits recommandés</h2>";
    $produits_recommandes = getProduitsRecommandes();
    foreach($produits_recommandes as $produit) {
        echo "Nom du produit: " . $produit['nom'] . "<br>";
        echo "Prix: " . $produit['prix'] . " euros<br>";
        // Vous pouvez ajouter d'autres détails du produit ici
        echo "<hr>";
    }

    // Bouton pour vider le panier
    echo "<a href='vider_panier.php'>Vider le panier</a><br>";

    // Afficher le total du panier
    echo "Total du panier: " . calculerTotalPanier() . " euros<br>";

    // Autres fonctionnalités comme la validation de la commande, etc.
}
?>

<main>
        <div class="container">
            <h1 class="panierTitle">Votre panier</h1>
            <section>
                <div class="panierContainer">
                    <div class="panierLeft">
                        <div class="panierItem">
                            <div class="panierImg">
                                <img src="./1/product_1_main-mage.jpg" alt="">
                            </div>
                            <div class="panierContent">
                                <div class="panierContentLeft">
                                    <h2 class="panierItemTitle">Nom du produit</h2>
                                    <p>coleur</p>
                                </div>
                                <div class="panierContentRight">
                                    <div class="panierItemQuantity">
                                        <span>-</span>
                                        <input type="text" type="namber" value="2">
                                        <span>+</span>
                                    </div>
                                    <div class="panierItemSubtotal">
                                        <p class="panierItemPrix">299.00 <span>€</span></p>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panierItem">
                            <div class="panierImg">
                                <img src="./1/product_1_main-mage.jpg" alt="">
                            </div>
                            <div class="panierContent">
                                <div class="panierContentLeft">
                                    <h2 class="panierItemTitle">Nom du produit</h2>
                                    <p>coleur</p>
                                </div>
                                <div class="panierContentRight">
                                    <div class="panierItemQuantity">
                                        <span>-</span>
                                        <input type="text" type="namber" value="2">
                                        <span>+</span>
                                    </div>
                                    <div class="panierItemSubtotal">
                                        <p class="panierItemPrix">299.00 <span>€</span></p>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panierRight">
                        <div class="panierTotal">
                            <div class="panierTotalTop">
                                <p>Total</p>
                                <div>300.99<span>€</span></div>
                            </div>
                        </div>
                        <button class="panierBtn" type="submit">Passer la comande</button>
                    </div>
            </section>
            <section id="similarProducts">
                <div>
                    <h2 class="similarProductsTitle">Vous pourriez aussi aimer</h2>
                    <div class="similarProductscontent">
                        <div class="card">
                            <div class="cardTop">
                                <a href="#">
                                    <img class="cardImg" src="./1/product_1_main-mage.jpg" alt="">
                                </a>
                            </div>
                            <div class="cardBottom">
                                <a href="#" class="cardTitle">Nom du produit</a>
                                <div class="priceRating">
                                    <div class="cardPrice cardPrice--common">436 <span>€</span></div>
                                    <div class="rating-mini">
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                            <div class="cardTop">
                                <a href="#">
                                    <img class="cardImg" src="./1/product_1_main-mage.jpg" alt="">
                                </a>
                            </div>
                            <div class="cardBottom">
                                <a href="#" class="cardTitle">Nom du produit</a>
                                <div class="priceRating">
                                    <div class="cardPrice cardPrice--common">436 <span>€</span></div>
                                    <div class="rating-mini">
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                            <div class="cardTop">
                                <a href="#">
                                    <img class="cardImg" src="./1/product_1_main-mage.jpg" alt="">
                                </a>
                            </div>
                            <div class="cardBottom">
                                <a href="#" class="cardTitle">Nom du produit</a>
                                <div class="priceRating">
                                    <div class="cardPrice cardPrice--common">436 <span>€</span></div>
                                    <div class="rating-mini">
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                            <div class="cardTop">
                                <a href="#">
                                    <img class="cardImg" src="./1/product_1_main-mage.jpg" alt="">
                                </a>
                            </div>
                            <div class="cardBottom">
                                <a href="#" class="cardTitle">Nom du produit</a>
                                <div class="priceRating">
                                    <div class="cardPrice cardPrice--common">436 <span>€</span></div>
                                    <div class="rating-mini">
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                            <div class="cardTop">
                                <a href="#">
                                    <img class="cardImg" src="./1/product_1_main-mage.jpg" alt="">
                                </a>
                            </div>
                            <div class="cardBottom">
                                <a href="#" class="cardTitle">Nom du produit</a>
                                <div class="priceRating">
                                    <div class="cardPrice cardPrice--common">436 <span>€</span></div>
                                    <div class="rating-mini">
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                            <div class="cardTop">
                                <a href="#">
                                    <img class="cardImg" src="./1/product_1_main-mage.jpg" alt="">
                                </a>
                            </div>
                            <div class="cardBottom">
                                <a href="#" class="cardTitle">Nom du produit</a>
                                <div class="priceRating">
                                    <div class="cardPrice cardPrice--common">436 <span>€</span></div>
                                    <div class="rating-mini">
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                        <span class="active"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
            </section>
        </div>
        </div>
    </main>
