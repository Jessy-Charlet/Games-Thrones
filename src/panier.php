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
