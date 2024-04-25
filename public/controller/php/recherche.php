<?php
require('./classes/Database.class.php');

$conn = Database::connect();

if (isset($_GET["filter"])) {

    switch ($_GET["filter"]) {
        case "color":
            try {
              $stmt = $conn->prepare("SELECT * FROM product WHERE color='" . $_GET['value1'] . "'");
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                http_response_code(500);
                echo "Erreur de connexion à la base de données: " . $e->getMessage();
            }
            break;
        case "price":
            try {
                $stmt = $conn->prepare("SELECT * FROM product WHERE price >= '" . $_GET['value1'] . "' AND price <= '" . $_GET['value2'] . "'");
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                http_response_code(500);
                echo "Erreur de connexion à la base de données: " . $e->getMessage();
            }
            break;
    }
} else {

    try {
        $stmt = $conn->prepare("SELECT * FROM product");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
    }
}

$conn = null;

header('Content-Type: application/json');
echo json_encode($products);
