<?php

class Product
{
    private $product_id;
    private $name;
    private $brand;
    private $color;
    private $material;
    private $price;
    private $stock;
    private $average_rating;
    private $description;
    private $image;

    public function __construct($product_id, $name, $brand, $color, $material, $price, $stock, $average_rating, $description, $image)
    {
        $this->product_id = $product_id;
        $this->name = $name;
        $this->brand = $brand;
        $this->color = $color;
        $this->material = $material;
        $this->price = $price;
        $this->stock = $stock;
        $this->average_rating = $average_rating;
        $this->description = $description;
        $this->image = $image;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function get_random_product_id()
    {
        return rand(1, 10);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getMaterial()
    {
        return $this->material;
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

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    // Mutateurs (setters)
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    // Méthodes supplémentaires
    public function isAvailable()
    {
        return $this->stock > 0;
    }

    public function displayDetails()
    {
        echo "productId: {$this->product_id}\n";
        echo "Product: {$this->name}\n";
        echo "Brand: {$this->brand}\n";
        echo "Color: {$this->color}\n";
        echo "Material: {$this->material}\n";
        echo "Price: \${$this->price}\n";
        echo "Stock: {$this->stock}\n";
        echo "Rating: {$this->average_rating}\n";
        echo "Description: {$this->description}\n";
        echo "Image: {$this->image}\n";
    }
}

