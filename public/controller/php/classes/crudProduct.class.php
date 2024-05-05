<?php

class crudProduct
{
    private $product_id;
    private $name;
    private $category_id;
    private $brand;
    private $description;
    private $material;
    private $color;
    private $price;
    private $stock;
    private $average_rating;
    private $number_of_ratings;
    private $vendor_code;
    private $images;

    public function setProductId($newId)
    {
        $this->product_id = $newId;
    }

    public function setName($newName)
    {
        $this->name = $newName;
    }

    public function setCategoryId($newCategoryId)
    {
        $this->category_id = $newCategoryId;
    }

    public function setBrand($newBrand)
    {
        $this->brand = $newBrand;
    }

    public function setDescription($newDescription)
    {
        $this->description = $newDescription;
    }

    public function setMaterial($newMaterial)
    {
        $this->material = $newMaterial;
    }

    public function setColor($newColor)
    {
        $this->color = $newColor;
    }

    public function setPrice($newPrice)
    {
        $this->price = $newPrice;
    }

    public function setStock($newStock)
    {
        $this->stock = $newStock;
    }

    public function setAverageRating($newAverageRating)
    {
        $this->average_rating = $newAverageRating;
    }

    public function setNumberOfRatings($newNumberOfRatings)
    {
        $this->number_of_ratings = $newNumberOfRatings;
    }

    public function setVendorCode($newVendorCode)
    {
        $this->vendor_code = $newVendorCode;
    }

    public function setImages($newImages)
    {
        $this->images = $newImages;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getMaterial()
    {
        return $this->material;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getAverageRating()
    {
        return $this->average_rating;
    }

    public function getNumberOfRatings()
    {
        return $this->number_of_ratings;
    }

    public function getVendorCode()
    {
        return $this->vendor_code;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function createProduct(
        $conn,
        $name,
        $category_id,
        $brand,
        $description,
        $material,
        $color,
        $price,
        $stock,
        $average_rating,
        $number_of_ratings,
        $vendor_code,
        $images
    ) {
        $sql = $conn->prepare("INSERT INTO product (name, category_id, brand, description, material, color, price, stock,
average_rating, number_of_ratings, vendor_code, images) VALUES (:name, :category_id, :brand, :description, :material,
:color, :price, :stock, :average_rating, :number_of_ratings, :vendor_code, :images)");
        $sql->execute(
            array(
                ':name' => $name,
                ':category_id' => $category_id,
                ':brand' => $brand,
                ':description' => $description,
                ':material' => $material,
                ':color' => $color,
                ':price' => $price,
                ':stock' => $stock,
                ':average_rating' => $average_rating,
                ':number_of_ratings' => $number_of_ratings,
                ':vendor_code' => $vendor_code,
                ':images' => $images
            )
        );
    }

    public function readProduct($conn, $id)
    {
        $sql = $conn->prepare("SELECT * FROM product WHERE product_id = :id");
        $sql->execute(array(':id' => $id));
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            // Set product properties from fetched data
            $this->setProductId($result['product_id']);
            $this->setName($result['name']);
            $this->setCategoryId($result['category_id']);
            $this->setBrand($result['brand']);
            $this->setDescription($result['description']);
            $this->setMaterial($result['material']);
            $this->setColor($result['color']);
            $this->setPrice($result['price']);
            $this->setStock($result['stock']);
            $this->setAverageRating($result['average_rating']);
            $this->setNumberOfRatings($result['number_of_ratings']);
            $this->setVendorCode($result['vendor_code']);
            $this->setImages($result['images']);
            return true;
        } else {
            return false;
        }
    }

    public function updateProduct($conn, $id, $name, $category_id, $brand, $description, $material, $color, $price, $stock)
    {
        $sql = $conn->prepare("UPDATE product SET name = :name, category_id = :category_id, brand = :brand, description =
:description, material = :material, color = :color, price = :price, stock = :stock WHERE product_id = :id");
        $sql->execute(
            array(
                ':name' => $name,
                ':category_id' => $category_id,
                ':brand' => $brand,
                ':description' => $description,
                ':material' => $material,
                ':color' => $color,
                ':price' => $price,
                ':stock' => $stock,
                ':id' => $id
            )
        );
    }

    public function deleteProduct($conn, $id)
    {
        $sql = $conn->prepare("DELETE FROM product WHERE product_id = :id");
        $sql->execute(array(':id' => $id));
    }

    public function getProductData()
    {
        $data = array(
            'product_id' => $this->getProductId(),
            'name' => $this->getName(),
            'category_id' => $this->getCategoryId(),
            'brand' => $this->getBrand(),
            'description' => $this->getDescription(),
            'material' => $this->getMaterial(),
            'color' => $this->getColor(),
            'price' => $this->getPrice(),
            'stock' => $this->getStock(),
            'average_rating' => $this->getAverageRating(),
            'number_of_ratings' => $this->getNumberOfRatings(),
            'vendor_code' => $this->getVendorCode(),
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
            $sql = $conn->prepare("SELECT * FROM product WHERE product_id IN ($placeholders)");
            $sql->execute($productIds);

            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $product = new crudProduct(); // Create a new product object
                $product->readProduct($conn, $row['product_id']); // Populate data using existing method
                $productData = $product->getProductData();
                $productData['quantity'] = $productQuantities[$product->getProductId()]; // Add quantity from map
                $productList[] = $productData;
            }
            return array('products' => $productList, 'totalProducts' => $totalProducts);
        } else {
            return array('products' => array(), 'totalProducts' => 0); // Return empty array with 0 total products
        }
    }

    public function getProductsByCartJsonForStripe($conn, $product, $jsonData)
    {
        $cartContent = $product->getProductsByCartJson($conn, $jsonData);
    }

}