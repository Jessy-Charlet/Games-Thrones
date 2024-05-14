<?php
require "../classes/Database.class.php";


if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['request'])){
        if($_POST['request'] == "addProduct"){
            $name = $_POST['name'];
            $rate = $_POST['rate'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $description = $_POST['description'];
            $color = $_POST['color'];
            $material = $_POST['material'];
            $brand = $_POST['brand'];
            $category = $_POST['category'];
            $image = $_POST['images'];
            $secondaryImages = $_POST['secondaryImages'];

            $testInsert = Database::testInsertProduct($name, $brand, $category);

            

            if($testInsert == "Product already exists"){
                var_dump("test");
                echo json_encode(
                    array(
                        "status" => "error",
                        "message" => "Product already exists"
                    )
                );
            }elseif($testInsert == "success"){
                Database::addProduct($name, $rate, $price, $quantity, $description, $color, $material, $brand, $category, $image, $secondaryImages);
                echo json_encode(
                    array(
                        "status" => "success",
                        "message" => "Product added"
                    )
                );
            }
            
        }

        if($_POST['request'] == "deleteProduct"){
            $productId = $_POST['productId'];
            $imageId = $_POST['imageId'];
            $secondaryImageId = $_POST['secondaryImageId'];
            
            $imageIds = preg_split('/,/', $secondaryImageId);
            $imageIds = array_filter($imageIds, 'is_numeric');

            $result = Database::deleteProduct($productId, $imageId, $imageIds);

            if($result) {
                echo json_encode(
                    array(
                        'status' => 'success',
                        'message' => 'Product deleted'
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'status' => 'error',
                        'message' => 'Product not deleted'
                    )
                );
            }
        }
    }
}