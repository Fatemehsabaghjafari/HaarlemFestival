<?php
namespace App\Repositories;
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../models/role.php';
require_once __DIR__ . '/../models/artist.php';
require_once __DIR__ . '/../models/venue.php';
require_once __DIR__ . '/../models/participatingArtist.php';
require_once __DIR__ . '/../models/musicTickets.php';
require_once __DIR__ . '/../controllers/logincontroller.php';

use PDO;
use \App\Models\MusicTickets;


class DanceRepository {

    private $db;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    }

    public function getAllTicketsOfPersonalProgram() {
        $stmt = $this->db->query("SELECT * FROM musicTickets");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllArtists() {
        $stmt = $this->db->query("SELECT * FROM artists");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllVenues() {
        $stmt = $this->db->query("SELECT * FROM venues");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTickets() {
        $stmt = $this->db->query("SELECT * FROM musicEvents");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getAllTicketsForArtist($artistId) {
        $stmt = $this->db->prepare("
            SELECT m.*, v.venueName 
            FROM musicEvents m 
            INNER JOIN venues v ON m.venueId = v.venueId 
            WHERE m.eventId IN (
                SELECT ticketId FROM participatingArtists WHERE artistId = :artistId
            )
        ");
        $stmt->bindParam(':artistId', $artistId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTicketsForDateAndVenue($date, $venueId) {
        $stmt = $this->db->prepare("
            SELECT m.eventId, m.date, m.time, m.price, m.venueId, v.venueName, STRING_AGG(a.artistName, ', ') AS artistNames
            FROM musicEvents m 
            INNER JOIN venues v ON m.venueId = v.venueId 
            LEFT JOIN participatingArtists pa ON m.eventId = pa.ticketId
            LEFT JOIN artists a ON pa.artistId = a.artistId
            WHERE m.date = :date AND m.venueId = :venueId
            GROUP BY m.eventId, m.date, m.time, m.price, m.venueId, v.venueName
        ");
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':venueId', $venueId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTicketsByArtist($artistId) {
        $stmt = $this->db->prepare("SELECT musicEvents.*, venues.venueName 
                                    FROM musicEvents
                                    JOIN participatingArtists ON musicEvents.eventId = participatingArtists.ticketId 
                                    JOIN venues ON musicEvents.venueId = venues.venueId
                                    WHERE participatingArtists.artistId = ?");

        $stmt->execute([$artistId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function buyTicket($eventId) {
        
        $stmt = $this->db->prepare("SELECT * FROM musicEvents WHERE eventId = ?");
        $stmt->execute([$eventId]);
        $ticket = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$ticket || $ticket['ticketsAvailable'] <= 0) {
            return false; 
        }
    
        $stmt = $this->db->prepare("UPDATE musicEvents SET ticketsAvailable = ticketsAvailable - 1 WHERE eventId = ?");
        $stmt->execute([$eventId]);
    
        return true; 
    }
    public function addNewTicketForLoggedInUser($eventId, $quantity) {

        $userId = \LoginController::getUserId();
        

        if ($userId === null) {
            return false;
        }
    

        $isPurchased = false;
    

        $oneDayAccessTicketQuantity = 0;
        $allDaysAccessTicketQuantity = 0;
    
        $stmt = $this->db->prepare("
            INSERT INTO musicTickets 
            (userId, eventId, oneDayAccessTicketQuantity, allDaysAccessTicketQuantity, isPurchased, quantity, isActive) 
            VALUES 
            (:userId, :eventId, :oneDayAccessTicketQuantity, :allDaysAccessTicketQuantity, :isPurchased, :quantity, 1)
        ");
    
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->bindParam(':oneDayAccessTicketQuantity', $oneDayAccessTicketQuantity, PDO::PARAM_INT);
        $stmt->bindParam(':allDaysAccessTicketQuantity', $allDaysAccessTicketQuantity, PDO::PARAM_INT);
        $stmt->bindParam(':isPurchased', $isPurchased, PDO::PARAM_INT); // Bind as integer (0 for false, 1 for true)
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    
        $stmt->execute();
    
        return true;
    }

    
    public function addNewOneDayTicketForLoggedInUser($eventId) {

        $userId = \LoginController::getUserId();
        

        if ($userId === null) {
            return false;
        }
    

        $isPurchased = false;
        $oneDayAccessTicketQuantity = 1;
        $allDaysAccessTicketQuantity = 0;
        $quantity=0;
    
        $stmt = $this->db->prepare("
            INSERT INTO musicTickets 
            (userId, eventId, oneDayAccessTicketQuantity, allDaysAccessTicketQuantity, isPurchased, quantity) 
            VALUES 
            (:userId, :eventId, :oneDayAccessTicketQuantity, :allDaysAccessTicketQuantity, :isPurchased, :quantity)
        ");
    
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->bindParam(':oneDayAccessTicketQuantity', $oneDayAccessTicketQuantity, PDO::PARAM_INT);
        $stmt->bindParam(':allDaysAccessTicketQuantity', $allDaysAccessTicketQuantity, PDO::PARAM_INT);
        $stmt->bindParam(':isPurchased', $isPurchased, PDO::PARAM_INT); // Bind as integer (0 for false, 1 for true)
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    
        $stmt->execute();
    
        return true;
    }
    


    public function addNewAllDaysTicketForLoggedInUser($eventId) {

        $userId = \LoginController::getUserId();
        

        if ($userId === null) {
            return false;
        }
    
        $isPurchased = false;
        $oneDayAccessTicketQuantity = 0;
        $allDaysAccessTicketQuantity = 1;
        $quantity=0;
    
        $stmt = $this->db->prepare("
            INSERT INTO musicTickets 
            (userId, eventId, oneDayAccessTicketQuantity, allDaysAccessTicketQuantity, isPurchased, quantity) 
            VALUES 
            (:userId, :eventId, :oneDayAccessTicketQuantity, :allDaysAccessTicketQuantity, :isPurchased, :quantity)
        ");
    
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->bindParam(':oneDayAccessTicketQuantity', $oneDayAccessTicketQuantity, PDO::PARAM_INT);
        $stmt->bindParam(':allDaysAccessTicketQuantity', $allDaysAccessTicketQuantity, PDO::PARAM_INT);
        $stmt->bindParam(':isPurchased', $isPurchased, PDO::PARAM_INT); // Bind as integer (0 for false, 1 for true)
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    
        $stmt->execute();
    
        return true;
    }
    
    


    
}
?>
