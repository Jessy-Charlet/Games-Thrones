<?php
include '../templates/banner.php';
include '../public/controller/php/connBDD.php';
?>
<h2>Les nouveautés<h2>
<section class="productsGrid">
<?php
$sql = $conn->prepare("SELECT image_url FROM product_image");
$sql->execute();
$result = $sql->fetch(PDO::FETCH_ASSOC);
foreach ($result as $url){
    echo "<a class='product' href='urlProduit'>
    <img src='../assets/img/products/".$url."' alt='Nom du produit'/>
    <div class='productName'>Nom du produit</div>
    <div>
    <span class='productPrice'>Prix du produit</span>
    <span class='productRate'>4.5*</span>
    </div>
    </a>";
}
?>
</section>
<h2>Les promotions</h2>
