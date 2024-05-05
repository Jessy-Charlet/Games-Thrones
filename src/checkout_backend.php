<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "../../vendor/autoload.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '../../secrets.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/php/classes/Database.class.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/php/classes/crudProduct.class.php";

\Stripe\Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:8080';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the cart contents from the session
$cartContents = $_SESSION['cart'];

$cartJson = json_encode(['cart' => $cartContents]);

$conn = Database::connect();

$product = new crudProduct();
$cartContent = $product->getProductsByCartJson($conn, $cartJson);


/*var_dump($_SESSION);
die();*/
$cartId = uniqid();
$_SESSION['cart_id'] = $cartId;
$stripeArray = [
    'line_items' => [
        [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => "Product name",
                ],
                'unit_amount' => "70 * 100",
            ],
            'quantity' => 1,
        ],
        [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => "Product name",
                ],
                'unit_amount' => "70 * 100",
            ],
            'quantity' => 1,
        ]
    ],
    'mode' => 'payment',
    'success_url' => 'http://localhost:8080/success?cart_id=' . $cartId,
    'cancel_url' => 'http://localhost:8080/cancel',
    'billing_address_collection' => 'required',
    'shipping_address_collection' => [
        'allowed_countries' => ['FR']
    ],
    'metadata' => [
        'cart_id' => $cartId
    ]
];
/*echo "### CART ###\n";
var_dump($cartContent);
*/

foreach ($cartContent['products'] as $key => $value) {
    $stripeArray["line_items"][$key] = [
        'price_data' => [
            'currency' => 'eur',
            'product_data' => [
                'name' => $cartContent['products'][$key]["name"],
            ],
            'unit_amount' => $cartContent['products'][$key]["price"] * 100,
        ],
        'quantity' => $cartContent['products'][$key]["quantity"],
    ];

}
/*
echo "### STRIPE ###\n";
var_dump($stripeArray);
exit();
*/
$checkout_session = \Stripe\Checkout\Session::create($stripeArray);

/*
var_dump($checkout_session->__toString());
exit();
*/
header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);