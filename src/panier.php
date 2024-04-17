<?php
session_start(); // Démarrage de la session

// Vérifier si le panier est vide ou non
if(!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    echo "Votre panier est vide.";
} else {
    // Afficher les produits dans le panier
    foreach($_SESSION['panier'] as $produit) {
        echo "Nom du fauteuil: " . $produit['nom'] . "<br>";
        echo "Prix: " . $produit['prix'] . " euros<br>";
        // Vous pouvez ajouter d'autres détails du produit ici
        echo "<hr>";
    }

    // Bouton pour vider le panier
    echo "<a href='vider_panier.php'>Vider le panier</a>";

    // Autres fonctionnalités comme la validation de la commande, etc.
}
?>
