<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/php/classes/Database.class.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/php/classes/crudReview.class.php";

$conn = Database::connect();

$limit = 3;

$product_id = intval(@$_GET["product_id"]);

$page = intval(@$_GET["page"]);

if (empty($page)) {
    $page = 1;
}

$offset = ($page - 1) * $limit;

$review = new crudReview();
$getReviewData = $review->getReviewsByProductId($conn, $product_id, $limit, $offset);

foreach ($getReviewData as $reviewData) {
    $customer = new CrudUser;
    $customerData = $customer->getAll($reviewData["customer_id"]);

    echo '
        <div class="reviewsItem">
            <div class="reviewsItemName">
                <span>' . $customerData["first_name"] . ' ' . $customerData["last_name"] . '</span>
            </div>
            <div class="rating-mini">
                <span>' . $reviewData["rating"] . '</span>
            </div>
            <p>Commenté en France <span>le ' . date('d/m/Y', strtotime($reviewData["date"])) . '</span></p>
            <span class="reviewsText">' . $reviewData["text"] . '</span>     
        </div>';

}

