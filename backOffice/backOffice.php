<?php
session_start();

require '../public/controller/php/classes/database.class.php';
require '../public/controller/php/classes/crudProduct.class.php';
?>
<link rel="stylesheet" href="assets/css/backOffice.css">
<?php
if(isset($_SESSION['admin'])){
    // PAGE ADMIN
    $product = new CrudProduct();
    $products = $product->getAllProducts();

        echo "
            <section class='bo_section'>
                <table class='bo_table'>
                    <thead class='bo_thead'>
                        <tr class='bo_thead_tr'>
                            <th class='bo_thead_tr_th'>Product ID</th>
                            <th class='bo_thead_tr_th'>Name</th>
                            <th class='bo_thead_tr_th'>Rate</th>
                            <th class='bo_thead_tr_th'>Price</th>
                            <th class='bo_thead_tr_th'>Quantity</th>
                            <th class='bo_thead_tr_th'>Description</th>
                            <th class='bo_thead_tr_th'>Color</th>
                            <th class='bo_thead_tr_th'>Material</th>
                            <th class='bo_thead_tr_th'>Brand</th>
                            <th class='bo_thead_tr_th'>Category</th>
                        </tr>
                    </thead>
                    <tbody class='bo_tbody'>";
                    foreach($products as $product){
                        foreach($product as $value){
                            echo "<tr class='bo_tbody_tr'>";
                            echo "<td class='bo_tbody_tr_td'>".(isset($value['id']) ? $value['id'] : '')."</td>";
                            echo "<td class='bo_tbody_tr_td'>".(isset($value['name']) ? $value['name'] : '')."</td>";
                            echo "<td class='bo_tbody_tr_td'>".(isset($value['rate']) ? $value['rate'] : '')."</td>";
                            echo "<td class='bo_tbody_tr_td'>".(isset($value['price']) ? $value['price'] : '')."</td>";
                            echo "<td class='bo_tbody_tr_td'>".(isset($value['quantity']) ? $value['quantity'] : '')."</td>";
                            echo "<td class='bo_tbody_tr_td'>".(isset($value['description']) ? $value['description'] : '')."</td>";
                            echo "<td class='bo_tbody_tr_td'>".(isset($value['color']) ? $value['color'] : '')."</td>";
                            echo "<td class='bo_tbody_tr_td'>".(isset($value['material']) ? $value['material'] : '')."</td>";
                            echo "<td class='bo_tbody_tr_td'>".(isset($value['brand']) ? $value['brand'] : '')."</td>";
                            echo "<td class='bo_tbody_tr_td'>".(isset($value['name']) ? $value['name'] : '')."</td>";
                            echo "</tr>";
                        }
                    }

        echo "  </tbody>
            </table>
        </section>";





}elseif(isset($_SESSION['user'])){
    $id = $_SESSION['user'];

    $current_url = $_SERVER['REQUEST_URI'];

    $user = new CrudUser();

    if($user->checkRole($id) === false){
        header('Location: /');
    }else{
        header('Location: backOfficeConnexion.php');
    }
}else{
    header('Location: http://localhost:8080/connexion');
}
