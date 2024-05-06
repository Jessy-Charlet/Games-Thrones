<?php
require('./classes/Database.class.php');

$conn = Database::connect();
$selec = [];

function getImg($products)
{
    global $selec;
    global $conn;
    foreach ($products as $product) {
        try {
            $sql = $conn->prepare("SELECT url FROM image
            INNER JOIN image_product
            WHERE image.id = image_product.image_id AND image_product.product_id = " . $product['id'] . " and image.main = 1");
            $sql->execute();
            $img = $sql->fetch(PDO::FETCH_ASSOC);
            $product["img"] = $img["url"];
            array_push($selec, $product);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["msg" => "Erreur de connexion à la base de données: " . $e->getMessage()]);
            exit();
        }
    }
}

if (isset($_GET["color"])) {
    try {
        switch ($_GET["color"]) {
            case "all":
                $stmt = $conn->prepare("SELECT * FROM product WHERE price >= :mini AND price <= :maxi");
                break;
            default:
                $stmt = $conn->prepare("SELECT * FROM product WHERE price >= :mini AND price <= :maxi AND color= :color");
                $stmt->bindParam(':color', $_GET['color']);
                break;
        }
        $stmt->bindParam(':mini', $_GET['mini']);
        $stmt->bindParam(':maxi', $_GET['maxi']);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        getImg($products);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["msg" => "Erreur de connexion à la base de données: " . $e->getMessage()]);
        exit();
    }
} else {

    try {
        $stmt = $conn->prepare("SELECT * FROM product");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        getImg($products);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["msg" => "Erreur de connexion à la base de données: " . $e->getMessage()]);
        exit();
    }
}

$conn = null;
header('Content-Type: application/json');
echo json_encode($selec);
