<?php
if(isset($_GET["id"])){
    $product_id = $_GET["id"]; 
} else {
    $product_id = 2; 
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
}

$conn = null;

class Product
{
    private $product_id;
    private $name;
    private $brand;
    private $color;
    private $material;
    private $price;
    private $stock;
    private $average_rating;
    private $description;
    private $image;

    public function __construct($product_id, $name, $brand, $color, $material, $price, $stock, $average_rating, $description, $image)
    {
        $this->product_id = $product_id;
        $this->name = $name;
        $this->brand = $brand;
        $this->color = $color;
        $this->material = $material;
        $this->price = $price;
        $this->stock = $stock;
        $this->average_rating = $average_rating;
        $this->description = $description;
        $this->image = $image;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getMaterial()
    {
        return $this->material;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getAverageRating()
    {
        return $this->average_rating;
    }

    public function getDescription()
    {
        return $this->description;
    }
    
    public function getImage()
    {
        return $this->image;
    }

    // Mutateurs (setters)
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    // Méthodes supplémentaires
    public function isAvailable()
    {
        return $this->stock > 0;
    }

    public function displayDetails()
    {
        echo "productId: {$this->product_id}\n";
        echo "Product: {$this->name}\n";
        echo "Brand: {$this->brand}\n";
        echo "Color: {$this->color}\n";
        echo "Material: {$this->material}\n";
        echo "Price: \${$this->price}\n";
        echo "Stock: {$this->stock}\n";
        echo "Rating: {$this->average_rating}\n";
        echo "Description: {$this->description}\n";
        echo "Image: {$this->image}\n";
    }
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

$productId = $product->getProductId();
$quantity = 1;

?>


<main>
    <section id="description">
        <div class="container">
            <div class="cartForm">
                <div class="leftSide">
                    <div class="productPhotos">
                        <div class="slider">
                            <ul>
                                <li id="Photo1">
                                    <img class="sliderPhoto" src="./assets/img/products/product_<?=$productId?>_image_1.jpg" alt="Chaise gaming">
                                </li>
                                <li id="Photo2">
                                    <img class="sliderPhoto" src="./assets/img/products/product_<?=$productId?>_image_2.jpg" alt="Chaise gaming">
                                </li>
                                <li id="Photo3">
                                    <img class="sliderPhoto" src="./assets/img/products/product_<?=$productId?>_image_3.jpg" alt="Chaise gaming">
                                </li>
                            </ul>
                        </div>
                        <div class="imageActuelle">
                            <img class="imageMain" src="./assets/img/products/product_<?=$productId?>_main_image.jpg" alt="Chaise gaming">
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
                        <h1 class="productTitle"><?php echo  "{$product->getName()}</li>"; ?></h1>
                        <?php echo  "<p id='deco'>Réf: {$product->getProductId()}</p>"; ?>
                        <div class="productInfo">
                            <div class="productInfoLeft">
                                <div class="rating-result">
                                    <?php echo  "<h2 id='deco'>{$product->getAverageRating()}</h2>"; ?>
                                </div>
                                <p class="prisInfo"><span><?php echo "{$product->getPrice()}$</>"; ?></span></p>
                                <div class="attributesInfo">
                                    <div>
                                        <p>Marque:</p>
                                    </div>
                                    <div>
                                        <?php echo "<p>{$product->getBrand()}</p>" ?>
                                    </div>
                                    <div>
                                        <p>Couleur:</p>
                                    </div>
                                    <div>
                                        <?php echo "<p>{$product->getColor()}</p>" ?>
                                    </div>
                                    <div>
                                        <p>Materiaux:</p>
                                    </div>
                                    <div>
                                        <?php echo "<p>{$product->getMaterial()}</p>" ?>
                                    </div>
                                </div>
                            </div>
                            <div class="productAdd">
                                <p class="quantity">
                                    <label for="quantity">Quantité</label><br>
                                    <input type="number" class="quantity" name="quantity" min="1" max="<?php echo $product->getStock(); ?>" value="<?php echo $quantity; ?>">
                                </p>
                                <button class="basketButton" type="submit">
                                    <span>Ajouter au panier</span> <img src="./images/icon_panier.png" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="descriptBotton">
                        <h3 class="descriptTitle">A propos de cet article</h3>
                        <div>
                            <?php echo "<p>{$product->getDescription()}</p>" ?>
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
                <?php foreach ($productObjects as $product) : ?>
                    <div class="card">
                        <div class="cardTop">
                            <a href="#">
                                <img class="cardImg" src="./assets/img/products/product_<?php echo $product->getProductId(); ?>_main_image.jpg" alt="<?php echo $product->getName(); ?>">
                            </a>
                        </div>
                        <div class="cardBottom">
                            <a href="#productDetails" class="productLink" data-product-id="<?php echo $product->getProductId(); ?>">
                                <?php echo $product->getName(); ?>
                            </a>
                            <div class="priceRating">
                                <div class="cardPrice cardPrice--common"><?php echo "{$product->getPrice()}$"; ?></div>
                                <div class="rating-mini">
                                    <?php echo "{$product->getAverageRating()}"; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
                            <input type="radio" id="star-2" name="rating" value="2">
                            <label for="star-2" title="Evaluation «2»"></label>
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
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="./assets/js/product.js?t=<?= time(); ?>"></script>
