<link rel="stylesheet" href="../assets/css/backOffice.css">
<?php
if($_SESSION['admin'] === true){
    // PAGE ADMIN
    $product = new CrudProduct();
    $products = $product->getAllProducts();
    $productId = $products[0]['id'];    
    $category = $product->getCategoryByProductId($productId);

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
                            <th class='bo_thead_tr_th'>Main Image id</th>
                            <th class='bo_thead_tr_th'>Main Image path</th>
                            <th class='bo_thead_tr_th'>Secondary Image Id</th>
                            <th class='bo_thead_tr_th'>Secondary Image path</th>
                        </tr>
                    </thead>
                    <tbody class='bo_tbody'>";
                    foreach($products as $product){
                        $images = Database::getImagesByProductId($productId);
                        $lastImage = end($images['all']);
                        if(isset($images['secondary'])){
                            $idSecondary = end($images['secondary']);
                        }
                        echo "<tr class='bo_tbody_tr'>";
                        echo "<td class='bo_tbody_tr_td' id='td_product_id'>".(isset($product['id']) ? $product['id'] : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>".(isset($product['name']) ? $product['name'] : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>".(isset($product['rate']) ? $product['rate'] : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>".(isset($product['price']) ? $product['price'] : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>".(isset($product['quantity']) ? $product['quantity'] : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>".(isset($product['description']) ? $product['description'] : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>".(isset($product['color']) ? $product['color'] : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>".(isset($product['material']) ? $product['material'] : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>".(isset($product['brand']) ? $product['brand'] : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>".(isset($category['name']) ? $category['name'] : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>".(isset($lastImage) ? $lastImage : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>".(isset($images['main']) ? $images['main'] : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>".(isset($idSecondary) ? $idSecondary : '')."</td>";
                        echo "<td class='bo_tbody_tr_td'>";
                        foreach($images['secondary'] as $image){
                            echo $image.", ";
                        }
                        echo "</td>";
                        echo "<td class='bo_tbody_tr_td'><button id='bo_button_deleteProduct' class='bo_deleteProduct_button'>Supprimer le produit</button></td>";
                        echo "</tr>";
                    }
        echo "  </tbody>
            </table>";

        ?>
            <button id="bo_button_addProduct" class="bo_addProduct_button">Ajouter un produit</button>
            <div id="bo_formAddProduct" class="bo_formAddProduct_class">
                <form class="bo_formAddProducts_class" id="bo_formAddProducts">
                    <input type="text" name="name" id="name" placeholder="Name">
                    <input type="text" name="rate" id="rate" placeholder="Rate">
                    <input type="text" name="price" id="price" placeholder="Price">
                    <input type="text" name="quantity" id="quantity" placeholder="Quantity">
                    <input type="text" name="description" id="description" placeholder="Description">
                    <input type="text" name="color" id="color" placeholder="Color">
                    <input type="text" name="material" id="material" placeholder="Material">
                    <input type="text" name="brand" id="brand" placeholder="Brand">
                    <input type="text" name="category" id="category" placeholder="Category">
                    <input type="text" name="images" id="images" placeholder="images name">
                    <input type="submit" value="Add Product" id="submitProduct">
                </form>
            </div>
        </section>
        <script src="../controller/js/backOffice/backOfficeController.js"></script>
        <?php
}else{
    if($_SESSION['user']){
        $id = $_SESSION['user'];

        $user = new CrudUser();

        if($user->checkRole($id) === false){
            ?>
                <script>window.location.href = "/404"</script>
            <?php
        }
    }else{
        ?>
            <script>window.location.href = "/404"</script>
        <?php
    }
}