<?php
class Product {
    private $name;
    private $price;
    private $stock;

    public function __construct($name, $price, $stock) {
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function calculateDiscount($percentage) {
        return $this->price - ($this->price * ($percentage / 100));
    }

    public function updateStock($quantity) {
        if ($quantity > $this->stock) {
            return "Not enough stock available.";
        }
        $this->stock -= $quantity;
        return "Stock updated! Remaining: " . $this->stock;
    }

    public function displayInfo() {
        return "Product: $this->name, Price: $this->price, Stock: $this->stock";
    }
}

// Example usage
$product = new Product("Laptop", 50000, 10);
echo $product->displayInfo();
echo "\nDiscounted Price (10%): " . $product->calculateDiscount(10);
echo "\n" . $product->updateStock(2);
