<?php

// Définition d'un tableau d'IDs valides
$valid_product_ids = range(1, 10); // Crée un tableau [1, 2, ..., 10]

// Fonction pour obtenir un ID par défaut aléatoire
function get_random_product_id($valid_ids)
{
    return $valid_ids[array_rand($valid_ids)];
}

if (isset($_GET["id"])) {
    $product_id = intval($_GET["id"]); // Convertit en entier
    if (!in_array($product_id, $valid_product_ids)) { // Vérifie si l'ID est dans le tableau
        // Si l'ID n'est pas valide, choisir un ID aléatoire
        $product_id = get_random_product_id($valid_product_ids);
    }
} else {
    // Si aucun ID n'est passé, choisir un ID par défaut aléatoire
    $product_id = get_random_product_id($valid_product_ids);
}

$conn = Database::connect();

if (empty($product_id)) {
    echo "Erreur : L'ID du produit est vide.";
} else {
    try {
        $stmt = $conn->prepare("SELECT * FROM product WHERE product_id = ?");
        $stmt->execute([$product_id]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($products)) {
            echo "Aucun produit trouvé avec l'ID spécifié.";
        } else {
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
    }


    $productObjects = [];
    foreach ($products as $productInfo) {
        $product = new Product(
            $productInfo['product_id'],
            $productInfo['name'],
            $productInfo['brand'],
            $productInfo['color'],
            $productInfo['material'],
            $productInfo['price'],
            $productInfo['stock'],
            $productInfo['average_rating'],
            $productInfo['description'],
            $productInfo['images']
        );
        $productObjects[] = $product;
    }

    $productId = $product->get_random_product_id();

    // Récupère le produit principal avec son ID
    if (isset($product)) {
        $mainProductColor = $product->getColor();
    } else {
        echo "Erreur : Produit principal non défini.";
        return;
    }

    // Récupère tous les produits (pas forcément similaires)
    $stmt = $conn->prepare("SELECT * FROM product");
    $stmt->execute();
    $allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Utilisation d'un array pour stocker les produits similaires
    $productObjectsSimilar = [];

    $index = 0;
    $totalProducts = count($allProducts);

    // Boucle pour trouver des produits avec des couleurs similaires
    while ($index < $totalProducts) {
        $currentProductInfo = $allProducts[$index];
        $currentProduct = new Product(
            $currentProductInfo['product_id'],
            $currentProductInfo['name'],
            $currentProductInfo['brand'],
            $currentProductInfo['color'],
            $currentProductInfo['material'],
            $currentProductInfo['price'],
            $currentProductInfo['stock'],
            $currentProductInfo['average_rating'],
            $currentProductInfo['description'],
            $currentProductInfo['images']
        );

        // Ajoute le produit si la couleur est similaire mais exclut le produit principal
        if (
            strtolower($currentProduct->getColor()) === strtolower($mainProductColor) &&
            $currentProduct->getProductId() !== $product->getProductId()
        ) {
            $productObjectsSimilar[] = $currentProduct;
        }

        $index++;
    }

    $stmt = $conn->prepare("SELECT * FROM product");
    $stmt->execute();
    $productsSimilar = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$productObjectsSimilar = [];
foreach ($productsSimilar as $productInfoOs) {
    $productSimilar = new Product(
        $productInfoOs['product_id'],
        $productInfoOs['name'],
        $productInfoOs['brand'],
        $productInfoOs['color'],
        $productInfoOs['material'],
        $productInfoOs['price'],
        $productInfoOs['stock'],
        $productInfoOs['average_rating'],
        $productInfoOs['description'],
        $productInfoOs['images']
    );
    $productObjectsSimilar[] = $productSimilar;
}

$productId = $product->getProductId();

$productIdSimilar = $productSimilar->get_random_product_id();

$productObjects = array_filter($productObjects, function ($productSimilar) use ($productId) {
    return $productSimilar->get_random_product_id() !== $productId; // Exclure le produit principal
});

$conn = null;
?>
<main>
    <div class="container">
        <h1 class="panierTitle">Votre panier</h1>
        <section>
            <div class="panierContainer">
                <div class="panierLeft">
                    <div class="panierItem">
                        <div class="panierImg">
                            <img src="./assets/img/products/product_<?= $productId ?>_main_image.jpg" alt="">
                        </div>
                        <div class="panierContent">
                            <div class="panierContentLeft">
                                <h2 class="panierItemTitle"><?php echo  "{$product->getName()}</li>"; ?></h2>
                                <p><?php echo "{$product->getColor()}" ?></p>
                            </div>
                            <div class="panierContentRight">
                                <div class="panierItemQuantity">
                                    <span class="reduce_basket_quantity">-</span>
                                    <input class="basket_quantity" type="text" type="number" value="2">
                                    <span class="add_basket_quantity">+</span>
                                </div>
                                <div class="panierItemSubtotal">
                                    <p class="panierItemPrix"><?php echo "{$product->getPrice()}$</>"; ?></p>
                                    <span class="panierItemRemove">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
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
                            <div id="basket_total"><span id="basket_total_number">300.99</span><span>€</span></div>
                        </div>
                    </div>
                    <button class="panierBtn" type="submit">Passer la comande</button>
                </div>
        </section>
        <section id="similarProductsPan">
            <div>
                <h2 class="similarTitle">Vous pourriez aussi aimer</h2>
                <div class="similarProductscontent">
                    <?php
                    $counter = 0;
                    foreach ($productObjectsSimilar as $productSimilar) :
                        if ($counter < 5) :
                    ?>
                            <div class="card">
                                <div class="cardTop">
                                    <a href="#">
                                        <img class="cardImg" src="./assets/img/products/product_<?php echo $productSimilar->getProductId(); ?>_main_image.jpg" alt="<?php echo $productSimilar->getName(); ?>">
                                    </a>
                                </div>
                                <div class="cardBottom">
                                    <a href="#productDetails" class="productLink" data-product-id="<?php echo $productSimilar->getProductId(); ?>">
                                        <?php echo $productSimilar->getName(); ?>
                                    </a>
                                    <div class="priceRating">
                                        <div class="cardPrice cardPrice--common"><?php echo "{$productSimilar->getPrice()}$"; ?></div>
                                        <div class="rating-mini">
                                            <?php echo "{$productSimilar->getAverageRating()}"; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                            $counter++;
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>
        </section>
    </div>
</main>
<script src="./assets/js/basket.js?t=<?= time(); ?>"></script>