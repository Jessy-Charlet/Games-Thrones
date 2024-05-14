<?php
function displayProducts($products, $number)
    {
            if ($number > 0) {
                $image = Database::getImagesByProductId($products["id"]);
                echo "<div class='product'>
                <a href='/produit?id=" . $products['id'] . "'>
                <img src='./assets/img/products/" . $image['main'] . "' alt='" . $products['name'] . "'/>
                <div class='productName'>" . $products['name'] . "</div>
                <div class='productDiv'>
                <div class='productPrice'>" . $products['price'] . " €</div>
                <div class='productRate'>" . $products['rate'] . "<img src='./assets/img/star.png'/></div>
                </div>
                </a>
                </div>";
                $number--;
            }
        }
    ?>