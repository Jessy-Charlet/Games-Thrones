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

    public static function addProduct($name, $rate, $price, $quantity, $description, $color, $material, $brand, $category){
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
}
$conn = Database::connect();
?>