<?php
require ('../public/controller/php/displayProduct.php');
$images = Database::getImagesByProductId($_GET["id"]);
$product = Database::getProductById($_GET["id"]);
function sliderPhotos($images, $product)
{
    $i = 1;
    foreach ($images["all"] as $image) {
        echo "<li id='Photo" . $i . "'><img class='sliderPhoto'src='./assets/img/products/" . $image . "' alt='" . $product['name'] . "'></li>";
        $i++;
    }
}
?>

<?php
$def = "index";
$dPath = $_SERVER['REQUEST_URI'];
$dChunks = explode("/", $dPath);

echo ('<a class="dynNav" href="/">Accueil</a><span class="dynNav"> > </span>');
for ($i = 1; $i < count($dChunks); $i++) {
    if ($i == count($dChunks) - 1 && isset($product)) {
        echo ('<a class="dynNav" href="/');
        for ($j = 1; $j <= $i; $j++) {
            echo ($dChunks[$j]);
            if ($j != count($dChunks) - 1) {
                echo ("/");
            }
        }
        echo ('">');
        echo (str_replace("_", " ", $product["name"]));
        echo ('</a>');
    } else {
        echo ('<a class="dynNav" href="/');
        for ($j = 1; $j <= $i; $j++) {
            echo ($dChunks[$j]);
            if ($j != count($dChunks) - 1) {
                echo ("/");
            }
        }
        echo ('">');
        $prChunks = explode(".", $dChunks[$i]);
        if ($prChunks[0] == $def)
            $prChunks[0] = "";
        echo (str_replace("_", " ", $prChunks[0]));
        echo ('</a><span class="dynNav"> > </span>');
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
                                sliderPhotos($images, $product)
                                    ?>
                            </ul>
                        </div>
                        <div class="imageActuelle">
                            <img class="imageMain" src="./assets/img/products/<?= $images['main'] ?>"
                                alt="Chaise gaming">
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
                        <h1 class="productTitle"><?= $product["name"] ?></h1>
                        <div class="productInfo">
                            <div class="productInfoLeft">
                                <p class="prisInfo"><span><?= $product["price"] ?> €</span></p>
                                <div class="rating-result">
                                    <span id='deco'><?= $product["rate"] ?></span>
                                </div>
                                <div class="attributesInfo">
                                    <div>
                                        <p>Marque:</p>
                                    </div>
                                    <div>
                                        <p><?= $product["brand"] ?></p>
                                    </div>
                                    <div>
                                        <p>Couleur:</p>
                                    </div>
                                    <div>
                                        <p><?= $product["color"] ?></p>
                                    </div>
                                    <div>
                                        <p>Materiaux:</p>
                                    </div>
                                    <div>
                                        <p><?= $product["material"] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="productAdd">
                                <div class="quantity">
                                    <label for="quantity">Quantité</label><br>
                                    <input id="product_quantity" type="number" class="quantity" name="quantity" min="1"
                                        max="<?= $product["quantity"] ?>" value="1">
                                </div>
                                <button id="product_basketButton" class="basketButton" type="submit">
                                    <span>Ajouter au panier</span> <img src="./assets/img/icon_panier.png" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="descriptBotton">
                        <h3 class="descriptTitle">En savoir plus :</h3>
                        <div>
                            <p><?= $product["description"] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $productSililaire = Database::getProductByColor($product["color"], $product["id"]);
    echo '<section>
            <h3 class="similarProductsTitle">Dans le même style :</h3>
            <div class="productsGrid">';
    if ($productSililaire != null) {
        displayProducts($productSililaire, 4);
    }
    echo '</div></section>';
    ?>

</section>

<?php
$productId = $_GET["id"];
$javascript = "<script> 
        const productId = $productId;
        </script>";
echo $javascript
    ?>

<section id="Commentaires">
    <div class="container">
        <h3 class="reviewTitle">Commentaires</h3>
        <form class="reviewForm" method="POST" action="">
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
                        <input type="radio" id="star-2" name="rating" value="2">
                        <label for="star-3" title="Evaluation «2»"></label>
                        <input type="radio" id="star-1" name="rating" value="1">
                        <label for="star-1" title="Evaluation «1»"></label>
                    </div>
                </div>

                <textarea name="text"></textarea>
                <button class="reviewFormBtn" type="submit">Écrire un commentaire</button>


            </div>
        </form>

        <?php

        require ('../public/controller/php/classes/crudReview.class.php');
        require ('../public/controller/php/ajax/getReviewAjaxController.php');


        $productId = $_GET["id"];

        $conn = Database::connect();
        $reviews = (new crudReview)->readReviewsByProductId($conn, $productId);

        if (empty($reviews)) {
            echo
                "<div id='noReviews'>
                    <p>Il n'y pas encore de commentaire pour ce produit.</p>
                    </div>";
        } else {

            echo
                '<div class="reviews">';
        }

        $displayedReviews = 0;
        foreach ($reviews as $review) {
            $displayedReviews++;
            $customer = new CrudUser;
            $customerData = $customer->getAll($review->getCustomerId());

            echo '
                    <div class="reviewsItem">
                        <div class="reviewsItemName">
                            <span>' . $customerData["first_name"] . ' ' . $customerData["last_name"] . '</span>
                        </div>
                        <div class="rating-mini">
                            <span>' . $review->getRating() . '</span>
                        </div>
                        <p>Commenté en France <span>le ' . date('d/m/Y', strtotime($review->getDate())) . '</span></p>
                        <span class="reviewsText">' . $review->getText() . '</span>     
                    </div>';

        }
        ;

        ?>





    </div>
    <div class="toggleContButton">
        <button id="toggleButton">Voir plus</button>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./assets/js/product.js?t=<?= time(); ?>"></script>