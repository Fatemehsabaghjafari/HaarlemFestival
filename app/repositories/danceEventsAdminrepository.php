<?php
namespace App\Repositories;

require_once __DIR__ . '/../models/MusicTicket.php';

use PDO;
use PDOException;

class DanceEventsAdminRepository
{
    private $db;

    public function __construct()
    {
        include (__DIR__ . '/../config/dbconfig.php');
        try {
            $this->db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle the exception as needed
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getAllEvents()
    {
        try {
            $stmt = $this->db->query("SELECT musicEvents.*, venues.venueName FROM musicEvents INNER JOIN venues ON musicEvents.venueId = venues.venueId");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception as needed
            return [];
        }
    }

    public function getVenueNames()
    {
        try {
            $stmt = $this->db->query("SELECT venueName FROM venues");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception as needed
            return [];
        }
    }

    public function addMusicEvent($dateTime, $venueName, $session, $duration, $ticketsAvailable, $price, $oneDayAccessPrice, $allDaysAccessPrice, $date, $time, $image, &$errorMessage = null)
    {
        // Validate inputs
        $validationResult = $this->validateMusicEventInputs($dateTime, $venueName, $session, $duration, $ticketsAvailable, $price, $allDaysAccessPrice, $oneDayAccessPrice, $date, $time, $image);
        if ($validationResult !== true) {
            $errorMessage = $validationResult;
            return false;
        }
    
        try {
            $stmt = $this->db->prepare("INSERT INTO musicEvents 
                                        (dateTime, venueId, session, duration, ticketsAvailable, price, oneDayAccessPrice, allDaysAccessPrice, date, time, image) 
                                        SELECT 
                                            :dateTime, 
                                            (SELECT venueId FROM venues WHERE venueName = :venueName), 
                                            :session, 
                                            :duration, 
                                            :ticketsAvailable, 
                                            :price, 
                                            :oneDayAccessPrice, 
                                            :allDaysAccessPrice, 
                                            :date, 
                                            :time, 
                                            :image");
            $stmt->bindParam(':dateTime', $dateTime);
            $stmt->bindParam(':venueName', $venueName);
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
            // Log the error (optional)
            error_log($e->getMessage());
            $errorMessage = "Database error: " . $e->getMessage();
            return false; // Error
        }
    }



    public function updateMusicEvent($eventId, $dateTime, $venueName, $session, $duration, $ticketsAvailable, $price, $allDaysAccessPrice, $oneDayAccessPrice, $date, $time, $image, &$errorMessage = null)
    {
        // Validate inputs
        $validationResult = $this->validateMusicEventInputs($dateTime, $venueName, $session, $duration, $ticketsAvailable, $price, $allDaysAccessPrice, $oneDayAccessPrice, $date, $time, $image);
        if ($validationResult !== true) {
            $errorMessage = $validationResult;
            return false;
        }

        try {
            $stmt = $this->db->prepare("UPDATE musicEvents 
                                    SET dateTime = :dateTime, 
                                        venueId = (SELECT venueId FROM venues WHERE venueName = :venueName), 
                                        session = :session, 
                                        duration = :duration, 
                                        ticketsAvailable = :ticketsAvailable, 
                                        price = :price, 
                                        allDaysAccessPrice = :allDaysAccessPrice, 
                                        oneDayAccessPrice = :oneDayAccessPrice, 
                                        date = :date, 
                                        time = :time, 
                                        image = :image 
                                    WHERE eventId = :eventId");
            $stmt->bindParam(':dateTime', $dateTime);
            $stmt->bindParam(':venueName', $venueName);
            $stmt->bindParam(':session', $session);
            $stmt->bindParam(':duration', $duration);
            $stmt->bindParam(':ticketsAvailable', $ticketsAvailable);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':allDaysAccessPrice', $allDaysAccessPrice);
            $stmt->bindParam(':oneDayAccessPrice', $oneDayAccessPrice);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
            $stmt->execute();
            return true; // Success
        } catch (PDOException $e) {
            // Log the error (optional)
            error_log($e->getMessage());
            $errorMessage = "Database error: " . $e->getMessage();
            return false; // Error
        }
    }

    private function validateMusicEventInputs($dateTime, $venueName, $session, $duration, $ticketsAvailable, $price, $allDaysAccessPrice, $oneDayAccessPrice, $date, $time, $image)
    {
        if ($price <= 0) {
            return "Price must be greater than zero.";
        }
        if ($allDaysAccessPrice <= 0) {
            return "All Days Access Price must be greater than zero.";
        }
        if ($oneDayAccessPrice <= 0) {
            return "One Day Access Price must be greater than zero.";
        }
        if ($duration <= 0) {
            return "Duration must be greater than zero.";
        }
        if ($ticketsAvailable <= 0) {
            return "Tickets Available must be greater than zero.";
        }

        // $dateTimeValid = \DateTime::createFromFormat('Y-m-d\TH:i', $dateTime) !== false;
        // $dateValid = \DateTime::createFromFormat('Y-m-d', $date) !== false;
        // $timeValid = \DateTime::createFromFormat('H:i', $time) !== false;

        // if (!$dateTimeValid) {
        //     return "Invalid DateTime format.";
        // }
        // if (!$dateValid) {
        //     return "Invalid Date format.";
        // }
        // if (!$timeValid) {
        //     return "Invalid Time format.";
        // }

        // $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        // $imageType = mime_content_type($image);

        // if (!in_array($imageType, $allowedImageTypes)) {
        //     return "Invalid image type. Allowed types are JPEG, PNG, GIF.";
        // }

        return true;
    }

    public function deleteMusicEventById($eventId)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM musicEvents WHERE eventId = :eventId");
            $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0; // Returns true if at least one row was affected
        } catch (PDOException $e) {
            // Handle the exception as needed
            return false;
        }
    }
}

?>