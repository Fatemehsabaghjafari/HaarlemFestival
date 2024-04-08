<?php
namespace App\Repositories;

require_once __DIR__ . '/../models/MusicTicket.php';

use PDO;

class DanceEventsAdminRepository
{
    private $db;

    public function __construct()
    {
        include (__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("$type:server=$servername;Database=$dbname", $username, $password);
    }

    public function getAllEvents()
    {
        $stmt = $this->db->query("SELECT * FROM musicEvents");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateMusicEvent($eventId, $dateTime, $venueId, $session, $duration, $ticketsAvailable, $price, $accessPrice, $oneDayAccessPrice, $date, $time, $image)
    {
        try {
            $stmt = $this->db->prepare("UPDATE dbo.musicEvents SET dateTime = :dateTime, venueId = :venueId, session = :session, duration = :duration, ticketsAvailable = :ticketsAvailable, price = :price, allDaysAccessPrice = :allDaysAccessPrice, oneDayAccessPrice = :oneDayAccessPrice, date = :date, time = :time, image = :image WHERE eventId = :eventId");
            $stmt->bindParam(':dateTime', $dateTime);
            $stmt->bindParam(':venueId', $venueId);
            $stmt->bindParam(':session', $session);
            $stmt->bindParam(':duration', $duration);
            $stmt->bindParam(':ticketsAvailable', $ticketsAvailable);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':allDaysAccessPrice', $accessPrice);
            $stmt->bindParam(':oneDayAccessPrice', $oneDayAccessPrice);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
            $stmt->execute();
            return true; // Success
        } catch (PDOException $e) {
            return false; // Error
        }
    }
    

    public function addMusicEvent($dateTime, $venueId, $session, $duration, $ticketsAvailable, $price, $oneDayAccessPrice, $allDaysAccessPrice, $date, $time, $image)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO dbo.musicEvents (dateTime, venueId, session, duration, ticketsAvailable, price, oneDayAccessPrice, allDaysAccessPrice, date, time, image) VALUES (:dateTime, :venueId, :session, :duration, :ticketsAvailable, :price, :oneDayAccessPrice, :allDaysAccessPrice, :date, :time, :image)");
            $stmt->bindParam(':dateTime', $dateTime);
            $stmt->bindParam(':venueId', $venueId);
            $stmt->bindParam(':session', $session);
            $stmt->bindParam(':duration', $duration);
            $stmt->bindParam(':ticketsAvailable', $ticketsAvailable);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':oneDayAccessPrice', $oneDayAccessPrice);
            $stmt->bindParam(':allDaysAccessPrice', $allDaysAccessPrice);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
            return true; // Success
        } catch (PDOException $e) {
            return false; // Error
        }
    }
    

    public function deleteMusicEventById($eventId)
    {
        $stmt = $this->db->prepare("DELETE FROM dbo.musicEvents WHERE eventId = :eventId");
        $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        // Optionally, you can return true or false based on the success of the deletion
        return $stmt->rowCount() > 0; // Returns true if at least one row was affected
    }

}
?>