<?php
/*
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
            $productInfo['id'],
            $productInfo['name'],
            $productInfo['brand'],
            $productInfo['color'],
            $productInfo['material'],
            $productInfo['price'],
            $productInfo['stock'],
            $productInfo['rate'],
            $productInfo['description']
        );
        $productObjects[] = $product;
    }

    $productId = $product->getProductId();
    $quantity = 1;


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
}

$conn = null;

*/
$images = Database::getImagesByProductId($_GET["id"]);
$product = Database::getProductById($_GET["id"]);

function sliderPhotos($images){
    $i = 1;
    foreach($images["all"] as $image){
        echo "<li id='Photo".$i."'><img class='sliderPhoto'src='./assets/img/products/".$image."' alt='Chaise gaming'></li>";
        $i++;
    }
}
?>

<section class="section">
    <section id="description">
        <div class="container">
            <div class="cartForm">
                <div class="leftSide">
                    <div class="productPhotos">
                        <div class="slider">
                            <ul>
                                <?php
                                    sliderPhotos($images)
                                ?>
                            </ul>
                        </div>
                        <div class="imageActuelle">
                            <img class="imageMain" src="./assets/img/products/<?=$images['main']?>" alt="Chaise gaming">
                        </div>
                        <div class="sliderDots"></div>
                    </div>
                    <div class="productBenefits">
                        <div class="benefitsItem">
                            <img class="benefitsItemImg" src="./assets/img/product/guarantee.png" alt="Guarantee">
                            <p class="benefitsItemText">GARANTIE</p>
                        </div>
                        <div class="benefitsItem">
                            <img class="benefitsItemImg" src="./assets/img/product/shipped.png"
                                alt="Car with free shipping">
                            <p class="benefitsItemText">LIVRAISON GRATUITE</p>
                        </div>
                        <div class="benefitsItem">
                            <img class="benefitsItemImg" src="./assets/img/product/return-box.png" alt="">
                            <p class="benefitsItemText">RETOUR SOUS 14 JOURS</p>
                        </div>
                    </div>
                </div>
                <div class="rightSide">
                    <div class="descriptionTop">
                        <h1 class="productTitle"><?= $product["name"]?></h1>
                        <div class="productInfo">
                            <div class="productInfoLeft">
                                <div class="rating-result">
                                    <h2 id='deco'><?= $product["rate"]?></h2>
                                </div>
                                <p class="prisInfo"><span><?= $product["price"] ?></span></p>
                                <div class="attributesInfo">
                                    <div>
                                        <p>Marque:</p>
                                    </div>
                                    <div>
                                        <p><?= $product["brand"]?></p>
                                    </div>
                                    <div>
                                        <p>Couleur:</p>
                                    </div>
                                    <div>
                                    <p><?= $product["color"]?></p>
                                    </div>
                                    <div>
                                        <p>Materiaux:</p>
                                    </div>
                                    <div>
                                    <p><?= $product["material"]?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="productAdd">
                                <p class="quantity">
                                    <label for="quantity">Quantité</label><br>
                                    <input id="product_quantity" type="number" class="quantity" name="quantity" min="1"
                                        max="<?= $product["quantity"]?>" value="1">
                                </p>
                                <button id="product_basketButton" class="basketButton" type="submit">
                                    <span>Ajouter au panier</span> <img src="./assets/img/icon_panier.png" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="descriptBotton">
                        <h3 class="descriptTitle">A propos de cet article</h3>
                        <div>
                          <p><?= $product["description"]?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="similarProducts">
        <div class="container">
            <h3 class="similarProductsTitle">Produits liés à cet article</h3>
            <div class="similarProductscontent">
            </div>
        </div>


    </section>
    <section id="Commentaires">
        <div class="container">
            <h3 class="reviewTitle">Commentaires</h3>
            <form class="reviewForm" method="post" action="">
                <button class="reviewFormBtn" type="submit">Écrire un commentaire</button>
                <div class="ratingContent">
                    <div class="ratingContentTop">
                        <span>Votre avis</span>
                        <div class="rating-area">
                            <input type="radio" id="star-5" name="rating" value="5">
                            <label for="star-5" title="Evaluation «5»"></label>
                            <input type="radio" id="star-4" name="rating" value="4">
                            <label for="star-4" title="Evaluation «4»"></label>
                            <input type="radio" id="star-3" name="rating" value="3">
                            <label for="star-3" title="Evaluation «3»"></label>
                            <input type="radio" id="star-2" name="rating" value="2">hh
                            <input type="radio" id="star-1" name="rating" value="1">
                            <label for="star-1" title="Evaluation «1»"></label>
                        </div>
                    </div>
                    <textarea name="text"></textarea>
                </div>
            </form>
            <div class="reviews">
                <div class="reviewsItem">
                    <div class="reviewsItemName">
                        <span>Sandrine</span>
                        <span>CLEMENT</span>
                    </div>
                    <div class="rating-mini">
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                    </div>
                    <p>Commenté en France <span>le 3 mars 2024</span></p>
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        ut
                        labore et dolore magna
                        aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis
                        aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                        laborum.
                    </span>
                </div>
                <div class="reviewsItem">
                    <div class="reviewsItemName">
                        <span>Sandrine</span>
                        <span>CLEMENT</span>
                    </div>
                    <div class="rating-mini">
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                    </div>
                    <p>Commenté en France <span>le 3 mars 2024</span></p>
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        ut
                        labore et dolore magna
                        aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis
                        aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                        laborum.
                    </span>
                </div>
                <div class="toggleContButton">
                    <button id="toggleButton">Voir plus</button>
                    <span class="toggleIcon">
                        <svg id="svg1" width="16" height="16">
                            <polyline points="0,10 5,0 10,10" stroke="#482664" stroke-width="2" fill="none" />
                        </svg>
                    </span>
                    <span class="toggleIcon">
                        <svg id="svg2" width="16" height="16" style="display: none;">
                            <polyline points="0,0 5,10 10,0" stroke="#482664" stroke-width="2" fill="none" />
                        </svg>
                    </span>
                </div>

                <div class="toggleReviewsItem hideElement">
                    <div class="reviewsItemName">
                        <span>Sandrine</span>
                        <span>CLEMENT</span>
                    </div>
                    <div class="rating-mini">
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                    </div>
                    <p>Commenté en France <span>le 3 mars 2024</span></p>
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                        esse cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                        culpa qui officia
                        deserunt mollit anim id est laborum.</span>
                </div>
                <div class="toggleReviewsItem hideElement">
                    <div class="reviewsItemName">
                        <span>Sandrine</span>
                        <span>CLEMENT</span>
                    </div>
                    <div class="rating-mini">
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                    </div>
                    <p>Commenté en France <span>le 3 mars 2024</span></p>
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                        esse cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                        culpa qui officia
                        deserunt mollit anim id est laborum.</span>
                </div>
            </div>
        </div>
    </section>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="./assets/js/product.js?t=<?= time(); ?>"></script>