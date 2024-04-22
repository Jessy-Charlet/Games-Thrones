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
foreach ($result as $res){
    echo '<p><pre>' . print_r($res) .'</pre></p>';

}
?>
</section>
<h2>Les promotions</h2>
