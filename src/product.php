<?php
$stock = 10;
?>
<main>
    <section id="description">
        <div class="container">
            <div class="cartForm">
                <div class="leftSide">
                    <div class="productPhotos">
                        <div class="slider">
                            <ul>
                                <li id="Photo1">
                                    <img class="sliderPhoto" src="./assets/img/products/chaise_licorne.jpg" alt="Chaise gaming">
                                </li>
                                <li id="Photo2">
                                    <img class="sliderPhoto" src="./assets/img/products/chaise_licorne.jpg" alt="Chaise gaming">
                                </li>
                                <li id="Photo3">
                                    <img class="sliderPhoto" src="./assets/img/products/chaise_licorne.jpg" alt="Chaise gaming">
                                </li>
                                <li id="Photo4">
                                    <img class="sliderPhoto" src="./assets/img/products/chaise_licorne.jpg" alt="Chaise gaming">
                                </li>
                            </ul>
                        </div>
                        <div class="imageActuelle">
                            <img class="imageMain" src="./assets/img/products/chaise_licorne.jpg" alt="Chaise gaming">
                        </div>
                        <div class="sliderDots"></div>
                    </div>
                    <div class="productBenefits">
                        <div class="benefitsItem">
                            <img class="benefitsItemImg" src="./assets/img/product/guarantee.png" alt="Guarantee">
                            <p class="benefitsItemText">GARANTIE</p>
                        </div>
                        <div class="benefitsItem">
                            <img class="benefitsItemImg" src="./assets/img/product/shipped.png" alt="Car with free shipping">
                            <p class="benefitsItemText">LIVRAISON GRATUITE</p>
                        </div>
                        <div class="benefitsItem">
                            <img class="benefitsItemImg" src="./assets/img/product/return-box.png" alt="">
                            <p class="benefitsItemText">RETOUR SOUS 14 JOURS</p>
                        </div>
                    </div>
                </div>
                <div class="rightSide">
                    <div class="descriptionTop">
                        <h1 class="productTitle">Nom du produit</h1>
                        <p>123456</p>
                        <div class="productInfo">
                            <div class="productInfoLeft">
                                <div class="rating-result">
                                    <span class="active"></span>
                                    <span class="active"></span>
                                    <span class="active"></span>
                                    <span class="active"></span>
                                    <span class="active"></span>
                                </div>
                                <p class="prisInfo"><span>436</span>€</p>
                                <div class="attributesInfo">
                                    <div>
                                        <p>Marque:</p>
                                    </div>
                                    <div>
                                        <p>GTPLAYER</p>
                                    </div>
                                    <div>
                                        <p>Couleur:</p>
                                    </div>
                                    <div>
                                        <p>Blanc</p>
                                    </div>
                                    <div>
                                        <p>Materiaux:</p>
                                    </div>
                                    <div>
                                        <p>Cuir</p>
                                    </div>
                                </div>
                            </div>
                            <div class="productAdd">    
                             <!--<p class="availability">
                                    <label for="Stock">Stock</label><br>
                                    <input type="int" class="stock" name="stock" value="<?php echo $stock; ?>" readonly />
                                </p>-->

                                <p class="quantity">
                                    <label for="quantity">Quantité</label><br>
                                    <input type="number" class="quantity" name="quantity" min="0" max="<?php echo $stock; ?>" value="<?php echo $quantity; ?>">
                                </p>

                                <button class="basketButton" type="submit">
                                    <span>Ajouter au panier</span> <img src="./images/icon_panier.png" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="descriptBotton">
                        <h3 class="descriptTitle">A propos de cet article</h3>
                        <div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt
                                ut labore et dolore magna
                                aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis
                                aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                nulla
                                pariatur. Excepteur sint
                                occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
                                est
                                laborum.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt
                                ut labore et dolore magna
                                aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis
                                aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                nulla
                                pariatur. Excepteur sint
                                occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
                                est
                                laborum.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt
                                ut labore et dolore magna
                                aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis
                                aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                nulla
                                pariatur. Excepteur sint
                                occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
                                est
                                laborum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="similarProducts">
        <div class="container">
            <h3 class="similarProductsTitle">Produits liés à cet article</h3>
            <div class="similarProductscontent">
                <div class="card">
                    <div class="cardTop">
                        <a href="#">
                            <img class="cardImg" src="./assets/img/products/chaise_licorne.jpg" alt="">
                        </a>
                    </div>
                    <div class="cardBottom">
                        <a href="#" class="cardTitle">Nom du produit</a>
                        <div class="priceRating">
                            <div class="cardPrice cardPrice--common">436 <span>€</span></div>
                            <div class="rating-mini">
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="cardTop">
                        <a href="#">
                            <img class="cardImg" src="./assets/img/products/chaise_licorne.jpg" alt="">
                        </a>
                    </div>
                    <div class="cardBottom">
                        <a href="#" class="cardTitle">Nom du produit</a>
                        <div class="priceRating">
                            <div class="cardPrice cardPrice--common">436 <span>€</span></div>
                            <div class="rating-mini">
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="cardTop">
                        <a href="#">
                            <img class="cardImg" src="./assets/img/products/chaise_licorne.jpg" alt="">
                        </a>
                    </div>
                    <div class="cardBottom">
                        <a href="#" class="cardTitle">Nom du produit</a>
                        <div class="priceRating">
                            <div class="cardPrice cardPrice--common">436 <span>€</span></div>
                            <div class="rating-mini">
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="cardTop">
                        <a href="#">
                            <img class="cardImg" src="./assets/img/products/chaise_licorne.jpg" alt="">
                        </a>
                    </div>
                    <div class="cardBottom">
                        <a href="#" class="cardTitle">Nom du produit</a>
                        <div class="priceRating">
                            <div class="cardPrice cardPrice--common">436 <span>€</span></div>
                            <div class="rating-mini">
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="cardTop">
                        <a href="#">
                            <img class="cardImg" src="./assets/img/products/chaise_licorne.jpg" alt="">
                        </a>
                    </div>
                    <div class="cardBottom">
                        <a href="#" class="cardTitle">Nom du produit</a>
                        <div class="priceRating">
                            <div class="cardPrice cardPrice--common">436 <span>€</span></div>
                            <div class="rating-mini">
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="cardTop">
                        <a href="#">
                            <img class="cardImg" src="./assets/img/products/chaise_licorne.jpg" alt="">
                        </a>
                    </div>
                    <div class="cardBottom">
                        <a href="#" class="cardTitle">Nom du produit</a>
                        <div class="priceRating">
                            <div class="cardPrice cardPrice--common">436 <span>€</span></div>
                            <div class="rating-mini">
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="Commentaires">
        <div class="container">
            <h3 class="reviewTitle">Commentaires</h3>
            <form class="reviewForm" method="post" action="">
                <button class="reviewFormBtn" type="submit">Écrire un commentaire</button>
                <div class="ratingContent">
                    <div class="ratingContentTop">
                        <span>Votre avis</span>
                        <div class="rating-area">
                            <input type="radio" id="star-5" name="rating" value="5">
                            <label for="star-5" title="Evaluation «5»"></label>
                            <input type="radio" id="star-4" name="rating" value="4">
                            <label for="star-4" title="Evaluation «4»"></label>
                            <input type="radio" id="star-3" name="rating" value="3">
                            <label for="star-3" title="Evaluation «3»"></label>
                            <input type="radio" id="star-2" name="rating" value="2">
                            <label for="star-2" title="Evaluation «2»"></label>
                            <input type="radio" id="star-1" name="rating" value="1">
                            <label for="star-1" title="Evaluation «1»"></label>
                        </div>
                    </div>
                    <textarea name="text"></textarea>
                </div>
            </form>
            <div class="reviews">
                <div class="reviewsItem">
                    <div class="reviewsItemName">
                        <span>Sandrine</span>
                        <span>CLEMENT</span>
                    </div>
                    <div class="rating-mini">
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                    </div>
                    <p>Commenté en France <span>le 3 mars 2024</span></p>
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        ut
                        labore et dolore magna
                        aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis
                        aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                        laborum.
                    </span>
                </div>
                <div class="reviewsItem">
                    <div class="reviewsItemName">
                        <span>Sandrine</span>
                        <span>CLEMENT</span>
                    </div>
                    <div class="rating-mini">
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                    </div>
                    <p>Commenté en France <span>le 3 mars 2024</span></p>
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        ut
                        labore et dolore magna
                        aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis
                        aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                        laborum.
                    </span>
                </div>
                <div class="toggleContButton">
                    <button id="toggleButton">Voir plus</button>
                    <span class="toggleIcon">
                        <svg id="svg1" width="16" height="16">
                            <polyline points="0,10 5,0 10,10" stroke="#482664" stroke-width="2" fill="none" />
                        </svg>
                    </span>
                    <span class="toggleIcon">
                        <svg id="svg2" width="16" height="16" style="display: none;">
                            <polyline points="0,0 5,10 10,0" stroke="#482664" stroke-width="2" fill="none" />
                        </svg>
                    </span>
                </div>

                <div class="toggleReviewsItem hideElement">
                    <div class="reviewsItemName">
                        <span>Sandrine</span>
                        <span>CLEMENT</span>
                    </div>
                    <div class="rating-mini">
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                    </div>
                    <p>Commenté en France <span>le 3 mars 2024</span></p>
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                        esse cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                        culpa qui officia
                        deserunt mollit anim id est laborum.</span>
                </div>
                <div class="toggleReviewsItem hideElement">
                    <div class="reviewsItemName">
                        <span>Sandrine</span>
                        <span>CLEMENT</span>
                    </div>
                    <div class="rating-mini">
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                    </div>
                    <p>Commenté en France <span>le 3 mars 2024</span></p>
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                        esse cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                        culpa qui officia
                        deserunt mollit anim id est laborum.</span>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="./assets/js/product.js?t=<?= time(); ?>"></script>