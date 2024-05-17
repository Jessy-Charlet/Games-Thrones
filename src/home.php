<?php
include '../templates/banner.php';
function showProducts($result, $number)
{
    foreach ($result as $prod) {
        if ($number > 0) {
            $image = Database::getImagesByProductId($prod["id"]);
            echo "<div class='product'>
            <a href='/produit?id=" . $prod['id'] . "'>
            <img src='./assets/img/products/" . $image['main'] . "' alt='" . $prod['name'] . "'/>
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