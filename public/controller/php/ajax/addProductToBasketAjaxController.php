<?php

/*
## Add products to basket
Usage example: localhost:8080/addProductToBasketAjaxController?id=1&quantity=3
*/

// Start a session if it hasn't already been started
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Get product ID and quantity from the request parameters
$productId = isset($_GET['id']) ? intval($_GET['id']) : null;
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;

// Validate product ID and quantity
if (empty($productId) || $quantity < 1) {
  echo json_encode(['error' => 'Invalid product ID or quantity']);
  exit;
}

// Initialize the cart if it doesn't exist in the session
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Check if the product already exists in the cart
$productInCart = array_key_exists($productId, $_SESSION['cart']);

// If the product exists, update the quantity
if ($productInCart) {
  $_SESSION['cart'][$productId]['quantity'] += $quantity;
  // Otherwise, add the product to the cart
} else {
  $_SESSION['cart'][$productId] = [
    'id' => $productId,
    'quantity' => $quantity
  ];
}

// Return success message
echo json_encode(['success' => 'Product added to cart', 'cart' => $_SESSION['cart']]);
exit;