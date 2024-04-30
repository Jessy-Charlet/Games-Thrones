<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "../vendor/autoload.php";
require_once $_SERVER['DOCUMENT_ROOT'] . 'secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:8080';

$checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => [
        [
            'price' => 'price_1PB91IImVxiDsWzEyndydG2p',
            'quantity' => 1,
        ]
    ],
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/success.php',
    'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);

?>


<!DOCTYPE html>
<html>

<head>
    <title>Buy cool new product</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <section>
        <div class="product">
            <img src="https://i.imgur.com/EHyR2nP.png" alt="The cover of Stubborn Attachments" />
            <div class="description">
                <h3>Chair PROMO</h3>
                <h5>249.99</h5>
            </div>
        </div>
        <form action="/checkout.php" method="POST">
            <button type="submit" id="checkout-button">Checkout</button>
        </form>
    </section>
</body>

</html>