<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/php/classes/Database.class.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/php/classes/crudProduct.class.php";

// Start a session if it hasn't already been started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if cart exists in session
if (!isset($_SESSION['cart'])) {
    echo json_encode(['cart' => []]);
    exit();
}

// Get the cart contents from the session
$cartContents = $_SESSION['cart'];

$cartJson = json_encode(['cart' => $cartContents]);

echo $cartJson;