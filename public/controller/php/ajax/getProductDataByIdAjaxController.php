<?php

/*
## Get products data
Usage example: localhost:8080/addProductToBasketAjaxController?id=1&quantity=3
*/

require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/php/classes/Database.class.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/php/classes/crudProduct.class.php";

$conn = Database::connect();

$product = new crudProduct();
$product->readProduct($conn, $_GET["id"]);
echo json_encode($product->getProductData());