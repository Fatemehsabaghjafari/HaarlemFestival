<?php
namespace App\Repositories;
//require_once __DIR__ . '/../models/user.php';
use PDO;

class DanceRepository {
    private $db;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("$type:server=$servername;Database=$dbname", $username, $password);
    }
    public function insertToCart($products_quantity, $products_name, $products_price)
    {
        $stmt = $this->db->prepare("INSERT INTO cart (quantity, name, price) VALUES (:quantity, :name, :price)");
        $stmt->bindParam(':quantity', $products_quantity);
        $stmt->bindParam(':name', $products_name);
        $stmt->bindParam(':price', $products_price);
        $stmt->execute();
    }
    public function isProductInCart($productName)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM cart WHERE name = :name");
        $stmt->bindParam(':name', $productName);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }
    
}
?>
