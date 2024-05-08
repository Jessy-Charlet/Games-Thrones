<?php

class crudProduct
{
    private $id;
    private $name;
    private $rate;
    private $price;
    private $quantity;
    private $description;
    private $color;
    private $material;
    private $brand;
    private $category_id;

    private $images;

    public function setId($newId)
    {
        $this->id = $newId;
    }

    public function setName($newName)
    {
        $this->name = $newName;
    }

    public function setRate($newRate)
    {
        $this->rate = $newRate;
    }

    public function setPrice($newPrice)
    {
        $this->price = $newPrice;
    }

    public function setQuantity($newQuantity)
    {
        $this->stock = $newQuantity;
    }

    public function setDescription($newDescription)
    {
        $this->description = $newDescription;
    }

    public function setColor($newColor)
    {
        $this->color = $newColor;
    }

    public function setMaterial($newMaterial)
    {
        $this->material = $newMaterial;
    }

    public function setCategoryId($newCategoryId)
    {
        $this->category_id = $newCategoryId;
    }

    public function setBrand($newBrand)
    {
        $this->brand = $newBrand;
    }

    public function setImages($newImages)
    {
        $this->images = Database::getImagesByProductId($this->id);
    }

    public function getAllProducts()
    {
        $conn = Database::connect();

        $sql = $conn->prepare("SELECT * FROM product");
        $sql->execute();
        $product = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $product;
    }

    public function getCategoryByProductId($id)
    {
        $conn = Database::connect();

        $sql = $conn->prepare("SELECT name FROM category WHERE id = :id");
        $sql->execute(
            array(
                ':id' => $id
            )
        );
        $category = $sql->fetch(PDO::FETCH_ASSOC);

        return $category;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getMaterial()
    {
        return $this->material;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function getImages()
    {
        return $this->images;
    }
    public function createProduct(
        $conn,
        $name,
        $rate,
        $price,
        $quantity,
        $description,
        $color,
        $material,
        $brand,
        $category_id,
        //$images
    ) {
        $sql = $conn->prepare("INSERT INTO product (name, rate, price, quantity, description, color, material, stock ,brand, category_id) VALUES (:name, :rate, :price, :quantity, :description, :color, :material, :stock, :brand, :category_id)");
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
                ':category_id' => $category_id,
                /*':images' => $images,*/
            )
        );
    }

    public function readProduct($conn, $id)
    {
        $sql = $conn->prepare("SELECT * FROM product WHERE id = :id");
        $sql->execute(array(':id' => $id));
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            // Set product properties from fetched data
            $this->setId($result['id']);
            $this->setName($result['name']);
            $this->setRate($result['rate']);
            $this->setPrice($result['price']);
            $this->setQuantity($result['quantity']);
            $this->setBrand($result['brand']);
            $this->setMaterial($result['material']);
            $this->setDescription($result['description']);
            $this->setColor($result['color']);
            $this->setCategoryId($result['category_id']);
            $this->setImages($result['id']);

            //$this->setImages($result['images']);
            return true;
        } else {
            return false;
        }
    }

    public function updateProduct($conn, $id, $name, $rate, $price, $quantity, $description, $color, $material, $brand, $category_id)
    {
        $sql = $conn->prepare("UPDATE product SET name = :name, rate = :rate, price = :price, quantity = :quantity, description = :description, color = :color, 
                               material = :material, brand =:brand,  WHERE id = :id");
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
                ':category_id' => $category_id,
            )
        );
    }

    public function deleteProduct($conn, $id)
    {
        $sql = $conn->prepare("DELETE FROM product WHERE id = :id");
        $sql->execute(array(':id' => $id));
    }

    public function getProductData()
    {
        $data = array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'rate' => $this->getRate(),
            'price' => $this->getPrice(),
            'quantity' => $this->getQuantity(),
            'description' => $this->getDescription(),
            'color' => $this->getColor(),
            'material' => $this->getMaterial(),
            'brand' => $this->getBrand(),
            'category_id' => $this->getCategoryId(),
            'images' => $this->getImages(),
        );
        return $data;
    }

    public function getProductsByCartJson($conn, $jsonData)
    {
        $productIds = array();
        $productQuantities = array(); // Map product ID to its quantity
        $totalProducts = 0;
        $data = json_decode($jsonData, true);

        // Extract product IDs, quantities and calculate total products
        if (isset($data['cart'])) {
            foreach ($data['cart'] as $productId => $details) {
                $productIds[] = $productId;
                $productQuantities[$productId] = $details['quantity']; // Store quantity with ID
                $totalProducts += $details['quantity'];
            }
        }

        // If there are product IDs, fetch their data
        if (count($productIds) > 0) {
            $productList = array();
            $placeholders = implode(',', array_fill(0, count($productIds), '?'));
            $sql = $conn->prepare("SELECT * FROM product WHERE id IN ($placeholders)");
            $sql->execute($productIds);

            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $product = new crudProduct(); // Create a new product object
                $product->readProduct($conn, $row['id']); // Populate data using existing method
                $productData = $product->getProductData();
                $productData['quantity'] = $productQuantities[$product->getId()]; // Add quantity from map
                $productList[] = $productData;
            }
            return array('products' => $productList, 'totalProducts' => $totalProducts);
        } else {
            return array('products' => array(), 'totalProducts' => 0); // Return empty array with 0 total products
        }
    }
}