<?php
namespace App\Repositories;
require_once __DIR__ . '/../models/artist.php';
use PDO;

class DanceArtistAdminRepository{
    private $db;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("$type:server=$servername;Database=$dbname", $username, $password);
    }
    public function getAllArtists()
    {
        $stmt = $this->db->query("SELECT * FROM artists");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
