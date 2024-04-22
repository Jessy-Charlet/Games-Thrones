<?php
$conn = Database::connect();

try {
    $stmt = $conn->prepare("SELECT * FROM product");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}

$conn = null;

header('Content-Type: application/json');
echo json_encode($products);
?>