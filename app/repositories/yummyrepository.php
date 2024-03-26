<?php
namespace App\Repositories;

require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../models/restaurant.php';
use PDO;

class YummyRepository
{
    private $db;

    public function __construct()
    {
        include (__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("$type:server=$servername;Database=$dbname", $username, $password);
    }

    public function getAllRestaurantsItems()
    {
        $stmt = $this->db->prepare("SELECT * FROM yummyRestaurants");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getRestaurantById($restaurantId)
    {
        $stmt = $this->db->prepare("SELECT * FROM yummyRestaurants WHERE restaurantId = :restaurantId");
        $stmt->bindParam(':restaurantId', $restaurantId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function AddReservation($userId, $restaurantId, $adultsQuantity, $kidsQuantity, $date, $time, $notes){
        $stmt = $this->db->prepare("INSERT INTO yummyTickets (userId, restaurantId, adultsQuantity, kidsQuantity, date, time, notes) VALUES (:userId, :restaurantId, :adultsQuantity, :kidsQuantity, :date, :time, :notes)");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':restaurantId', $restaurantId, PDO::PARAM_INT);
        $stmt->bindParam(':adultsQuantity', $adultsQuantity, PDO::PARAM_INT);
        $stmt->bindParam(':kidsQuantity', $kidsQuantity, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':notes', $notes);
        
        return $stmt->execute();
    }
    
    
}

