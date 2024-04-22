<?php
include '../templates/banner.php';
?>
<h2>Les nouveautés<h2>
<section class="productsGrid">
<?php
$conn = Database::connect();
$sql = $conn->prepare("SELECT * FROM product");
$sql->execute();
$result = $sql->fetch(PDO::FETCH_ASSOC);
foreach ($result as $res[]){
    var_dump($res);
    echo "<a class='product' href='urlProduit'>
    <div class='productName'>".$res[1]."</div>
    <div>
    <span class='productPrice'>".$res[7]."</span>
    <span class='productRate'>".$res[9]."</span>
    </div>
    </a>";
}
?>
</section>
<h2>Les promotions</h2>
