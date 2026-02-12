<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $description;
    public $price;
    public $category;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all products
    public function read() {
        $query = "SELECT id, name, description, price, category, created_at 
                  FROM " . $this->table_name . " 
                  ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    // Read single product
    public function readOne() {
        $query = "SELECT id, name, description, price, category, created_at 
                  FROM " . $this->table_name . " 
                  WHERE id = ? 
                  LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->price = $row['price'];
            $this->category = $row['category'];
            $this->created_at = $row['created_at'];
            return true;
        }
        
        return false;
    }

    // Create product
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET name=:name, description=:description, price=:price, category=:category";
        
        $stmt = $this->conn->prepare($query);
        
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category = htmlspecialchars(strip_tags($this->category));
        
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category", $this->category);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    // Update product
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET name = :name,
                      description = :description,
                      price = :price,
                      category = :category
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    // Delete product
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(1, $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
?>
