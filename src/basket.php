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
    exit;
}

// Get the cart contents from the session
$cartContents = $_SESSION['cart'];

$cartJson = json_encode(['cart' => $cartContents]);

$conn = Database::connect();

$product = new crudProduct();
$cartContent = $product->getProductsByCartJson($conn, $cartJson);

?>
<main>
    <div class="container">
        <h1 class="panierTitle">Votre panier</h1>
        <section>
            <div class="panierContainer">
                <div class="panierLeft">

                    <?php

                    foreach ($cartContent['products'] as $key => $cartProduct) {

                        echo '<div class="panierItem">
                        <div class="panierImg">
                            <img src="./assets/img/products/product_' . $cartProduct['id'] . '_main_image.jpg" alt="">
                        </div>
                        <div class="panierContent">
                            <div class="panierContentLeft">
                                <h2 class="panierItemTitle">' . $cartProduct['name'] . '</h2>
                                <p>' . $cartProduct['color'] . '</p>
                            </div>
                            <div class="panierContentRight">
                                <div class="panierItemQuantity">
                                    <span class="reduce_basket_quantity">-</span>
                                    <input class="basket_quantity" type="text" type="number" value="' . $cartProduct['quantity'] . '">
                                    <span class="add_basket_quantity">+</span>
                                </div>
                                <div class="panierItemSubtotal">
                                    <p class="panierItemPrix">' . $cartProduct['price'] . '</p>
                                    <span class="panierItemRemove">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>';

                    }

                    ?>
                </div>
                <div class="panierRight">
                    <div class="panierTotal">
                        <div class="panierTotalTop">
                            <p>Total</p>
                            <div id="basket_total"><span id="basket_total_number">300.99</span><span>€</span></div>
                        </div>
                    </div>
                    <a id="makeOrder" class="panierBtn" href="/checkout">Passer la comande</a>
                </div>
        </section>
    </div>
    </div>
</main>
<script src="./assets/js/basket.js?t=<?= time(); ?>"></script>