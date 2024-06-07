<?php

require('./classes/Database.class.php');
if(isset($_POST['searching'])){
    $selec = [];
    if($_POST['searching'] == "customer"){
        $selec = Database::getAllCustomer();
        $conn = null;
        header('Content-Type: application/json');
        echo json_encode($selec);
    }
    if($_POST['searching'] == "products"){

        // TABLEAU DE TABLEAU DES DONNÉES DE CHAQUE PRODUIT
        $products = Database::getAllProduct();
        

        foreach($products as $product){
            $productImages = Database::getImagesByProductId($product['id']);
            $productImage = $productImages['everything'];
            array_push($product, $productImage);

            $category_id = $product['category_id'];
            $category = Database::getCategoryName($category_id);
            $product['category_id'] = $category['name'];
            array_push($selec, $product);
        }


        $conn = null;
        header('Content-Type: application/json');
        echo json_encode($selec);
    }
    if($_POST['searching'] == "category"){
        $category = Database::getAllCategory();

        foreach($category as $item){
            for($i = 0; $i < count($item); $i++){
                $categoryParentName = Database::getCategoryNameByParentId($item['parent_id']);
            }
            array_push($item, $categoryParentName);
            array_push($selec, $item);
        }

        header('Content-Type: application/json');
        echo json_encode($selec);
    }
}