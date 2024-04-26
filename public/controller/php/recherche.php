<?php
require('./classes/Database.class.php');

$conn = Database::connect();

if (isset($_GET["color"])) {
if ($_GET["color"] != "all");

    switch ($_GET["color"]) {
        case "all":
            try {
                $stmt = $conn->prepare("SELECT * FROM product WHERE price >= '" . $_GET['mini'] . "' AND price <= '" . $_GET['maxi'] . "'");
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(["msg"=>"Erreur de connexion à la base de données: " . $e->getMessage()]);
                exit();
            }
            break;
        default :
            try {
                $stmt = $conn->prepare("SELECT * FROM product WHERE price >= '" . $_GET['mini'] . "' AND price <= '" . $_GET['maxi'] . "' AND color='". $_GET['color'] ."'");
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(["msg"=>"Erreur de connexion à la base de données: " . $e->getMessage()]);
                exit();
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
        echo json_encode(["msg"=>"Erreur de connexion à la base de données: " . $e->getMessage()]);
        exit();
    }
}

$conn = null;

header('Content-Type: application/json');
echo json_encode($products);
