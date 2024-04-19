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

    // Bouton pour vider le panier
    echo "<a href='vider_panier.php'>Vider le panier</a><br>";

    // Afficher le total du panier
    echo "Total du panier: " . calculerTotalPanier() . " euros<br>";

    // Autres fonctionnalités comme la validation de la commande, etc.
}
?>
