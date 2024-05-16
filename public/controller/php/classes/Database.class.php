<?php
class Database{
    private static $servername = 'localhost';
    private static $username = 'root';
    private static $password = '';
    private static $BDD ='boutique';
    private static $conn = null;

    public function __construct(){
        die('Init function is not allowed');
    }
    public static function connect(){ //fonction de connexion à la BDD
        if (null == self::$conn){ //si la connexion est nulle
            try{ //on essaie de se connecter
                self::$conn = new PDO("mysql:host=".self::$servername.";"."dbname=".self::$BDD,self::$username,self::$password); //on se connecte à la BDD
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        return self::$conn;
    }
    public static function disconnect(){
        self::$conn = null;
    }

    // Récupération de toutes les images d'un produit 
    public static function getImagesByProductId($id)
    {
        try {
            // Connection à la BDD
            $conn = Database::connect();

            // Préparation de la requête SQL pour récupérer l'ensemble des images
            $stmt = $conn->prepare("SELECT * FROM image
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
                "all" => [],
                "everything" => []
            ];

            // Tri et remplissage de la valeur de retour
            foreach ($images as $image) {
                if ($image["main"] == 1) {
                    $productImages["main"] = $image["url"];
                } else {
                    array_push($productImages["secondary"], $image["url"], $image["id"]);
                }
                array_push($productImages["all"], $image["url"]);
                array_push($productImages["everything"], $image['url'], $image['id']);
            }

            // Fermeture de la connection
            $conn = null;

            // return["main"] pour la photo principale
            // return["secondary"] pour les photos secondaires
            // return["all"] pour toutes les photos
            return $productImages;
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Récupération de TOUS les produits
    public static function getAllProduct()
    {
        try {
            // Connection à la BDD
            $conn = Database::connect();

            // Préparation de la requête SQL pour récupérer l'ensemble produits
            $stmt = $conn->prepare("SELECT * FROM product");
            $stmt->execute();

            // Execution de la requête SQL
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fermeture de la connection
            $conn = null;

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
            return $products;
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Récupération des produits par ID
    public static function getProductById($id)
    {
        try {
            // Connection à la BDD
            $conn = Database::connect();

            // Préparation de la requête SQL pour récupérer l'ensemble produits
            $stmt = $conn->prepare("SELECT * FROM product WHERE id=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Execution de la requête SQL
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            // Fermeture de la connection
            $conn = null;

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

    // Récupération des produits par Color
    public static function getProductByColor($color, $id)
    {
        try {
            // Connection à la BDD
            $conn = Database::connect();

            // Préparation de la requête SQL pour récupérer l'ensemble produits
            $stmt = $conn->prepare("SELECT * FROM product WHERE color=:color AND id!=:id");
            $stmt->bindParam(':color', $color);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Execution de la requête SQL
            $product = $stmt->fetchall(PDO::FETCH_ASSOC);

            // Fermeture de la connection
            $conn = null;

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

       // Récupération de tous les clients
       public static function getAllCustomer()
       {
           try {
               // Connection à la BDD
               $conn = Database::connect();
   
               // Préparation de la requête SQL pour récupérer l'ensemble produits
               $stmt = $conn->prepare("SELECT * FROM customer");
               $stmt->execute();
   
               // Execution de la requête SQL
               $customer = $stmt->fetchall(PDO::FETCH_ASSOC);
   
               // Fermeture de la connection
               $conn = null;
   
               // return["id"] pour l'ID du client
               // return["first_name"] pour le prénom du client
               // return["last_name"] pour le nom de famille du client
               // return["mail"] pour le mail du client
               // return["adresse"] pour l'adresse du client
               // return["postal_code"] pour le code postal
               // return["city"] pour la ville du client
               // return["phone"] pour la téléphone du cleint
               return $customer;
           } catch (PDOException $e) {
               return $e;
           }
       }
    

    public static function addProduct($name, $rate, $price, $quantity, $description, $color, $material, $brand, $category, $image){
        $conn = Database::connect();

        try{
            $conn->beginTransaction();
        
            $sql = $conn->prepare("INSERT INTO product (name, rate, price, quantity, description, color, material, brand, category_id) VALUES (:name, :rate, :price, :quantity, :description, :color, :material, :brand, :category)");
            $sql->execute(
                array(
                    ':name' => $name,
                    ':rate' => $rate,
                    ':price' => $price,
                    ':quantity' => $quantity,
                    ':description' => $description,
                    ':color' => $color,
                    ':material' => $material,
                    ':brand' => $brand,
                    ':category' => $category
                )
            );
            $sql->closeCursor();
            $productId = $conn->lastInsertId();

            $sql = $conn->prepare("INSERT INTO image (url, main) VALUES (:url, :main)");
            $sql->execute(
                array(
                    ':url' => $image,
                    ':main' => 0
                )
            );
            $sql->closeCursor();
            if($secondaryImages !== "none"){
                $sql = $conn->prepare("INSERT INTO image (url, main) VALUES (:url, :main)");
                $sql->execute(
                    array(
                        ':url' => $secondaryImages,
                        ':main' => 1
                    )
                );
                $sql->closeCursor();
            }

            $imageId = $conn->lastInsertId();
            $sql = $conn->prepare("INSERT INTO image_product (image_id, product_id) VALUES (:image_id, :product_id)");
            $sql->execute(
                array(
                    ':image_id' => $imageId,
                    ':product_id' => $productId
                )
            );
            $conn->commit();
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            $conn->rollback();
        }
    }

    public static function testInsertProduct($name, $brand, $category){
        $conn = Database::connect();
        $result = "success";

        $sql = $conn->prepare("SELECT * FROM product WHERE name = :name AND brand = :brand AND category_id = :category");
        $sql->execute(
            array(
                ':name' => $name,
                ':brand' => $brand,
                ':category' => $category
            )
        );
        if($sql->rowCount() > 0){
            $result = "Product already exists";
        }
        return $result;
    }

    public static function deleteProduct($id, $imageId, $secondaryImagesId){
        $conn = Database::connect();
        
        try{
            $conn->beginTransaction();

            $sql = $conn->prepare("DELETE FROM review WHERE product_id = :id");
            $sql->execute(
                array(
                    ':id' => $id
                )
            );
            $sql->closeCursor();
        
            //delete from product_image table first
            $sql = $conn->prepare("DELETE FROM image_product WHERE product_id = :id OR image_id = :id");
            $sql->execute(
                array(
                    ':id' => $id
                )
            );
            $sql->closeCursor();
        
            //delete main image
            $sql = $conn->prepare("DELETE FROM image WHERE id = :id");
            $sql->execute(
                array(
                    ':id' => $imageId
                )
            );
            $sql->closeCursor();
        
            //delete secondary images
            foreach($secondaryImagesId as $secondId){
                $sql = $conn->prepare("DELETE FROM image WHERE id = :id");
                $sql->execute(
                    array(
                        ':id' => $secondId
                    )
                );
                $sql->closeCursor();
            }
        
            //delete product
            $sql = $conn->prepare("DELETE FROM product WHERE id = :id");
            $sql->execute(
                array(
                    ':id' => $id
                )
            );
            $sql->closeCursor();
        
            $conn->commit();
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            $conn->rollback();
            return false;
        }

    }

    //public static function updateProduct($id, $name, $rate, $price, $quantity, $description, $color, $material, $brand, $category, $image, $secondaryImages){
    public static function updateProduct($id, $name, $brand, $color, $material, $price, $quantity, $rate, $description, $category_name, $imageId, $imagePath, $secondaryImageId, $secondaryImages){
        $conn = Database::connect();
        $return = "success";
        $secondaryId = $secondaryImageId;
        $secondaryImage = $secondaryImages;

        try{
            $conn->beginTransaction();
            $sql = $conn->prepare('SELECT name, brand, category_id FROM product WHERE id = :id');
            $sql->execute(
                array(
                    'id' => $id
                )
            );
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            $sql = $conn->prepare('SELECT name FROM category WHERE id = :id');
            $sql->execute(
                array(
                    'id' => $result['category_id']
                )
            );
            $result2 = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            $sql = $conn->prepare('SELECT url FROM image WHERE url = :url');
            $sql->execute(
                array(
                    'url' => $imagePath
                )
            );
            $result3 = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            foreach($secondaryImage as $image){
                $sql = $conn->prepare('SELECT url FROM image WHERE url = :url');
                $sql->execute(
                    array(
                        'url' => $image
                    )
                );
                $result4 = $sql->fetch(PDO::FETCH_ASSOC);
                $sql->closeCursor();
                if($result4['url'] == $image){
                    $return = "ImageAlreadyExist";
                    return $return;
                }
            }

            if($result['name'] == $name && $result['brand'] == $brand && $result2['name'] == $category){
                $return = "ProductAlreadyExist";
                return $return;
            }
            if($result['name'] == $name){
                $return = "NameAlreadyExist";
                return $return;
            }
            if($result3['url'] == $imagePath){
                $return = "ImageAlreadyExist";
                return $return;
            }

            /*$sql = $conn->prepare('UPDATE product SET `name` = :name, `rate` = :rate, `price` = :price, `quantity` = :quantity, `description` = :description, `color` = :color, `material` = :material, `brand` = :brand, `category` = :category WHERE id = :id');
            $sql->execute(
                array(
                    ":name" => $name,
                    ":rate" => $rate,
                    ":price" => $price,
                    ":quantity" => $quantity,
                    ":description" => $description'
                    ":color" => $color,
                    ":material" => $material,
                    ":brand" => $brand,
                    ":category" => $category,
                    ":id" => $id
                )
            );
            $sql->closeCursor();

            $sql = $conn->prepare('UPDATE image SET `url` = :url WHERE id = :id');
            $sql->execute(
                array(
                    ":url" => $imagePath,
                    ":id" => $imageId
                )
            );
            $sql->closeCursor();
            */

            $conn->commit();
            return $return;
        }
        catch(PDOException $e){
            $return = "UnexpectedError";
            echo "Error: " . $e->getMessage();
            $conn->rollback();
            return $return;
        }
    }
}
$conn = Database::connect();
?>