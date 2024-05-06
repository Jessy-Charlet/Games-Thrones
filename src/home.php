<?php
include '../templates/banner.php';
function showProducts($result, $number)
{
    foreach ($result as $prod) {
        if ($number > 0) {
            $conn = Database::connect();
            $sql = $conn->prepare("SELECT url FROM image
            INNER JOIN image_product WHERE image.id = image_product.image_id AND image_product.product_id = ".$prod['id']." and image.main = 1");
            $sql->execute();
            $img = $sql->fetch(PDO::FETCH_ASSOC);
            echo "<div class='product'>
            <a href='/produit?id=" . $prod['id'] . "'>
            <img src='./assets/img/products/" . $img['url'] . "' alt='" . $prod['name'] . "'/>
            <div class='productName'>" . $prod['name'] . "</div>
            <div class='productDiv'>
            <div class='productPrice'>" . $prod['price'] . " €</div>
            <div class='productRate'>" . $prod['rate'] . "<img src='./assets/img/star.png'/></div>
            </div>
            </a>
            </div>";
            $number--;
        }
    }
}
?>
<section class="section">
    <h2>Nos derniers Thrones</h2>
    <div class="productsGrid">
        <?php
        $conn = Database::connect();
        $sql = $conn->prepare("SELECT * FROM product ORDER BY id DESC");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        showProducts($result, 8);
        ?>
    </div>
</section>
<section class="section">
    <h2>Les promotions</h2>
</section>
