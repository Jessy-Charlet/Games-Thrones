<?php
class Database
{
    private static $servername = 'localhost';
    private static $username = 'root';
    private static $password = '';
    private static $BDD = 'boutique';
    private static $conn = null;

    public function __construct()
    {
        die('Init function is not allowed');
    }
    public static function connect()
    { //fonction de connexion à la BDD
        if (null == self::$conn) { //si la connexion est nulle
            try { //on essaie de se connecter
                self::$conn = new PDO("mysql:host=" . self::$servername . ";" . "dbname=" . self::$BDD, self::$username, self::$password); //on se connecte à la BDD
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$conn;
    }
    public static function disconnect()
    {
        self::$conn = null;
    }

    // Récupération de toutes les images d'un produit 
    public static function getImagesByProductId($id)
    {
        try {
            // Connection à la BDD
            $conn = Database::connect();

            // Préparation de la requête SQL pour récupérer l'ensemble des images
            $stmt = $conn->prepare("SELECT url, main FROM image
            INNER JOIN image_product
            WHERE image.id = image_product.image_id AND image_product.product_id = :id");
            $stmt->bindParam(':id', $id);

            // Execution de la requête SQL
            $stmt->execute();
            $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Création de la valeur de retour
            $productImages = [
                "main" => null,
                "secondary" => [],
                "all" => []
            ];

            // Tri et remplissage de la valeur de retour
            foreach ($images as $image) {
                if ($image["main"] == 1) {
                    $productImages["main"] = $image["url"];
                } else {
                    array_push($productImages["secondary"], $image["url"]);
                }
                array_push($productImages["all"], $image["url"]);
            }

            // return["main"] pour la photo principale
            // return["secondary"] pour les photos secondaires
            // return["all"] pour toutes les photos
            return $productImages;
        } catch (PDOException $e) {
            return $e;
        }
    }

     // Récupération de tous les produits
    public static function getAllProduct()
    {
        try {
            // Connection à la BDD
            $conn = Database::connect();

            // Préparation de la requête SQL pour récupérer l'ensemble produits
            $stmt = $conn->prepare("SELECT * FROM product");
            $stmt->execute();

            // Execution de la requête SQL
            $product = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // return["id"] pour l'ID du produit
            // return["name"] pour le nom du produit
            // return["rate"] pour la note du produit
            // return["price"] pour le prix du produit
            // return["quantity"] pour la quantitée du produit    
            // return["description"] pour la déscription complète du produit
            // return["color"] pour la couleur du produit 
            // return["material"] pour la matière du produit 
            // return["brand"] pour la marque du produit   
            // return["category_id"] pour la catégorie du produit   
            return $product;
        } catch (PDOException $e) {
            return $e;
        }
    }
}
$conn = Database::connect();
