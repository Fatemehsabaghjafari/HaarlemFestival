<?php
namespace App\Repositories;

require_once __DIR__ . '/../models/artist.php';
require_once __DIR__ . '/../models/venue.php';
use PDO;

class AdminRepository
{
    private $db;

    public function __construct()
    {
        include (__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("$type:server=$servername;Database=$dbname", $username, $password);
    }
    public function getAllArtists()
    {
        $stmt = $this->db->query("SELECT * FROM artists");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public function updateArtist($artistId, $artistName, $style, $imagePath)
    {
        try {
            $stmt = $this->db->prepare("UPDATE artists SET artistName = :artistName, style = :style, img = :img WHERE artistId = :artistId");
            $stmt->bindParam(':artistName', $artistName);
            $stmt->bindParam(':style', $style);
            $stmt->bindParam(':img', $imagePath);
            $stmt->bindParam(':artistId', $artistId, PDO::PARAM_INT);
            $stmt->execute();
            return true; // Success
        } catch (PDOException $e) {
            return false; // Error
        }
    }

    public function addArtist($artistName, $style, $imagePath)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO artists (artistName, style, img) VALUES (:artistName, :style, :img)");
            $stmt->bindParam(':artistName', $artistName);
            $stmt->bindParam(':style', $style);
            $stmt->bindParam(':img', $imagePath);
            $stmt->execute();
            return true; // Success
        } catch (PDOException $e) {
            return false; // Error
        }
    }
    public function deleteArtistById($artistId)
    {
        $stmt = $this->db->prepare("DELETE FROM artists WHERE artistId = :artistId");
        $stmt->bindParam(':artistId', $artistId, PDO::PARAM_INT);
        $stmt->execute();
        // Optionally, you can return true or false based on the success of the deletion
        return $stmt->rowCount() > 0; // Returns true if at least one row was affected
    }


}
?>