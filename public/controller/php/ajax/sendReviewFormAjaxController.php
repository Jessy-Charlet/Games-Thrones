<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/php/classes/Database.class.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/php/classes/crudReview.class.php";

session_start();
$customerId = $_SESSION['user'];

$conn = Database::connect();

$response = [
    'success' => false,
    'error' => 'Une erreur est survenue.' 
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $rating = htmlspecialchars(filter_input(INPUT_POST, 'rating', FILTER_UNSAFE_RAW));
    $text = htmlspecialchars(filter_input(INPUT_POST, 'text', FILTER_UNSAFE_RAW));
    $productId = htmlspecialchars(filter_input(INPUT_POST, 'product_id', FILTER_UNSAFE_RAW));

    if ($rating !== false && $text !== false && $productId !== false) {
       

        /**** Insert into the DB ***/

        $review = new crudReview();

        if ($review->readReview($conn, $productId, $customerId) !== false) {
            $response['success'] = false;
            $response['error'] = 'Comment exist already';
        } else {
            $review->createReview($conn, $productId, $customerId, $text, $rating, date('Y-m-d H:i:s'));
            
        /***************************/
            $response['success'] = true;
            $response['error'] = '';
        }
    } else {
        $response['error'] = 'Données invalides.';
    }
} else {
    $response['error'] = 'Méthode de requête non autorisée.';
}

header('Content-Type: application/json');
echo json_encode($response);

