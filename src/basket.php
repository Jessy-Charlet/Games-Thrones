<main>
    <div class="container">
        <h1 class="panierTitle">Votre panier</h1>
        <section>
            <div class="panierContainer">
                <div class="panierLeft">

                    <?php
                    $cartTotal = 0;
                    foreach ($_SESSION['cart'] as $product) {
                        $image = Database::getImagesByProductId($product['id']);
                        $productDetail = Database::getProductById($product['id']);
                        $productPriceTotal = $product['quantity'] * $productDetail['price'];
                        $cartTotal = $cartTotal + $productPriceTotal;
                        echo '<div class="panierItem">
                        <div class="panierImg">
                            <img src="./assets/img/products/' . $image["main"] . '" alt="Product">
                        </div>
                        <div class="panierContent">
                            <div class="panierContentLeft">
                                <h2 class="panierItemTitle">' . $productDetail['name'] . '</h2>
                                <p>' . $productDetail['color'] . '</p>
                                <p>' . $productDetail['price'] . ' €</p>
                            </div>
                            <div class="panierContentRight">
                                <div class="panierItemQuantity">                                
                                <form action="" method="get">
                                <input name="reduce" type="hidden" value="' . $product['id'] . '" />
                                <button class="reduce_basket_quantity" type="submit" value="submit">-</button>
                                </form>
                                    <input class="basket_quantity" type="text" readonly type="number" value="' . $product['quantity'] . '">
                                    <form action="" method="get">
                                    <input name="add" type="hidden" value="' . $product['id'] . '" />
                                    <button class="add_basket_quantity" type="submit" value="submit">+</button>
                                    </form>
                                </div>
                                <div class="panierItemSubtotal">
                                    <p class="panierItemPrix">' . $productPriceTotal . ' €</p>
                                    <span class="panierItemRemove">
                                        <form action="" method="get">
                                            <input name="remove" type="hidden" value="' . $product['id'] . '" />
                                            <button type="submit" value="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor"
                                                     class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                            </button>
                                        </form>
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
                            <div id="basket_total"><span id="basket_total_number"><?= $cartTotal ?></span><span>€</span></div>
                        </div>
                    </div>
                    <a id="makeOrder" class="panierBtn" href="/checkout">Passer la commande</a>
                </div>
        </section>
    </div>
    </div>
</main>