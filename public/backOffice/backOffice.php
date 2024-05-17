<link rel="stylesheet" href="../assets/css/backOffice.css">
<?php
if ($_SESSION['admin'] === true) {
    // PAGE ADMIN
    $product = new CrudProduct();
    $products = $product->getAllProducts();
    $productId = $products[0]['id'];
    $category = $product->getCategoryByProductId($productId);
?>
    <button id="bo_button_addProduct" class="bo_addProduct_button">Ajouter un produit</button>
    <div id="bo_formAddProduct" class="bo_formAddProduct_class">
        <form class="bo_formAddProducts_class" id="bo_formAddProducts">
            <input type="text" name="name" id="name" placeholder="Name" autocomplete="off">
            <input type="text" name="rate" id="rate" placeholder="Rate">
            <input type="text" name="price" id="price" placeholder="Price">
            <input type="text" name="quantity" id="quantity" placeholder="Quantity">
            <input type="text" name="description" id="description" placeholder="Description">
            <input type="text" name="color" id="color" placeholder="Color">
            <input type="text" name="material" id="material" placeholder="Material">
            <input type="text" name="brand" id="brand" placeholder="Brand">
            <input type="text" name="category" id="category" placeholder="Category">
            <input type="text" name="images" id="images" placeholder="images name">
            <input type="text" name="secondaryImages" id="secondaryImages" placeholder="secondary images">
            <input type="submit" value="Add Product" id="submitProduct">
        </form>
    </div>
    <div>
        <form method="post" id="bo_formUpdateProductPreFill">
            <input type="text" name="name" id="updateName" placeholder="Name" autocomplete="off">
            <input type="text" name="rate" id="updateRate" placeholder="Rate">
            <input type="text" name="price" id="updatePrice" placeholder="Price">
            <input type="text" name="quantity" id="updateQuantity" placeholder="Quantity">
            <textarea id="updateDescription" placeholder="Description"></textarea>
            <input type="text" name="color" id="updateColor" placeholder="Color">
            <input type="text" name="material" id="updateMaterial" placeholder="Material">
            <input type="text" name="brand" id="updateBrand" placeholder="Brand">
            <input type="text" name="category" id="updateCategory" placeholder="Category">
            <input type="text" name="imagesId" id="updateImagesId" placeholder="images id">
            <input type="text" name="images" id="updateImages" placeholder="images name">
            <input type="text" name="secondaryImagesId" id="updateSecondaryImagesId" placeholder="secondary images id">
            <input type="text" name="secondaryImages" id="updateSecondaryImages" placeholder="secondary images">
            <input type="button" id="buttonAddImages" value="Ajouter une image">
            <div id="divAddNewImages"></div>
            <input type="submit" value="Enregistrer">
        </form>
    </div>
    <?php
    echo "
            <section class='bo_section'>
                <table class='bo_table' id='table_bo'>
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
    foreach ($products as $product) {
        $images = Database::getImagesByProductId($product['id']);
        $mainImagePath = $images['everything'][0];
        $mainImageId = $images['everything'][1];

        echo "<tr class='bo_tbody_tr'>";
        echo "<td class='bo_tbody_tr_td' id='td_product_id'>" . (isset($product['id']) ? $product['id'] : '') . "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_product_name'>" . (isset($product['name']) ? $product['name'] : '') . "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_product_rate'>" . (isset($product['rate']) ? $product['rate'] : '') . "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_product_price'>" . (isset($product['price']) ? $product['price'] : '') . "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_product_quantity'>" . (isset($product['quantity']) ? $product['quantity'] : '') . "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_product_description'>" . (isset($product['description']) ? $product['description'] : '') . "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_product_color'>" . (isset($product['color']) ? $product['color'] : '') . "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_product_material'>" . (isset($product['material']) ? $product['material'] : '') . "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_product_brand'>" . (isset($product['brand']) ? $product['brand'] : '') . "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_category_name'>" . (isset($category['name']) ? $category['name'] : '') . "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_images_id'>" . (isset($mainImageId) ? $mainImageId : '') . "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_images_path'>" . (isset($mainImagePath) ? $mainImagePath : '') . "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_secondary_images_id'>";
        foreach ($images['secondary'] as $image) {
            if (is_int($image)) {
                echo $image . ", ";
            }
        }
        echo "</td>";
        echo "<td class='bo_tbody_tr_td' id='td_secondary_images_path'>";
        foreach ($images['secondary'] as $image) {
            if (is_string($image)) {
                echo $image . ", ";
            }
        }
        echo "</td>";

        // delete button
        echo "<td class='bo_tbody_tr_td'><button id='bo_button_deleteProduct' class='bo_deleteProduct_button'>Supprimer le produit</button></td>";

        // update button
        echo "<td class='bo_tbody_tr_td'><button id='bo_button_updateProduct' class='bo_updateProduct_button'>Modifier le produit</button></td>";
        echo "</tr>";
    }
    echo "  </tbody>
            </table>";

    ?>
    </section>
    <script src="../controller/js/backOffice/backOfficeController.js"></script>
    <?php
} else {
    if ($_SESSION['user']) {
        $id = $_SESSION['user'];

        $user = new CrudUser();

        if ($user->checkRole($id) === false) {
    ?>
            <script>
                window.location.href = "/404"
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            window.location.href = "/404"
        </script>
<?php
    }
}
