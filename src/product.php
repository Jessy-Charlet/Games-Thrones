<?php
require('../public/controller/php/displayProduct.php');
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

<section class="section">
<?php
$def = "index";
$dPath = $_SERVER['REQUEST_URI'];
$dChunks = explode("/", $dPath);

echo('<a class="dynNav" href="/">Accueil</a><span class="dynNav"> > </span>');
for($i=1; $i<count($dChunks); $i++ ){
    echo('<a class="dynNav" href="/');
    for($j=1; $j<=$i; $j++ ){
        echo($dChunks[$j]);
        if($j!=count($dChunks)-1){ echo("/");}
    }

    if($i==count($dChunks)-1){
        $prChunks = explode(".", $dChunks[$i]);
        if ($prChunks[0] == $def) $prChunks[0] = "";
        $prChunks[0] = $prChunks[0] . '</a>';
    }
    else $prChunks[0]=$dChunks[$i] . '</a><span class="dynNav"> > </span>';
    echo('">');
    if ($i == count($dChunks) - 1 && isset($product)) {
        echo(str_replace("_" , " " , $product["name"]));
    } else {
        echo(str_replace("_" , " " , $prChunks[0]));
    }
}
?>

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
                            <img class="imageMain" src="./assets/img/products/<?= $images['main'] ?>" alt="Chaise gaming">
                        </div>
                        <div class="sliderDots"></div>
                    </div>
                    <div class="productBenefits">
                        <div class="benefitsItem">
                            <img class="benefitsItemImg" src="./assets/img/product/guarantee.png" alt="Guarantee">
                            <p class="benefitsItemText">GARANTIE</p>
                        </div>
                        <div class="benefitsItem">
                            <img class="benefitsItemImg" src="./assets/img/product/shipped.png" alt="Car with free shipping">
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
                                    <input id="product_quantity" type="number" class="quantity" name="quantity" min="1" max="<?= $product["quantity"] ?>" value="1">
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