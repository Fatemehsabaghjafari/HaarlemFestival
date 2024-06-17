<?php
namespace App\Repositories;
require_once __DIR__ . '/../models/venue.php';
use PDO;

class DanceVenueAdminRepository {
    private $db;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    }
    
    public function getAllVenues()
    {
        $stmt = $this->db->query("SELECT * FROM venues");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateVenue($venueId, $venueName, $venueAddress)
    {
        try {
            $stmt = $this->db->prepare("UPDATE venues SET venueName = :venueName, venueAddress = :venueAddress WHERE venueId = :venueId");
            $stmt->bindParam(':venueName', $venueName);
            $stmt->bindParam(':venueAddress', $venueAddress);
            $stmt->bindParam(':venueId', $venueId, PDO::PARAM_INT);
            $stmt->execute();
            return true; // Success
        } catch (PDOException $e) {
            return false; // Error
        }
    }
    public function deleteVenueById($venueId)
    {
        $stmt = $this->db->prepare("DELETE FROM venues WHERE venueId = :venueId");
        $stmt->bindParam(':venueId', $venueId, PDO::PARAM_INT);
        $stmt->execute();
        // Optionally, you can return true or false based on the success of the deletion
        return $stmt->rowCount() > 0; // Returns true if at least one row was affected
    }
    public function addVenue($venueName, $venueAddress)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO venues (venueName, venueAddress) VALUES (:venueName, :venueAddress)");
            $stmt->bindParam(':venueName', $venueName);
            $stmt->bindParam(':venueAddress', $venueAddress);
            $stmt->execute();
            return true; // Success
        } catch (PDOException $e) {
            return false; // Error
        }
    }


}
?>
