<?php
namespace App\Repositories;
require_once __DIR__ . '/../models/MusicTicket.php';
require_once __DIR__ . '/../models/YummyTicket.php';
require_once __DIR__ . '/../models/HistoryTicket.php';
use PDO;

class PersonalProgramRepository {
    private $db;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("$type:server=$servername;Database=$dbname", $username, $password);
    }

    function getMusicTickets($userId) {
        $stmt = $this->db->prepare("
            SELECT musicTickets.ticketId, 
                musicTickets.oneDayAccessTicketQuantity, 
                musicEvents.oneDayAccessPrice,
                musicTickets.allDaysAccessTicketQuantity,
                musicEvents.allDaysAccessPrice,
                musicTickets.isPurchased, 
                musicTickets.isActive, 
                musicTickets.quantity, 
                musicEvents.price,
                musicEvents.dateTime,
                musicEvents.duration,
                artists.artistName,
                venues.venueName,
                musicEvents.image
            FROM musicTickets
            INNER JOIN musicEvents ON musicTickets.eventId = musicEvents.eventId
            INNER JOIN venues ON venues.venueId = musicEvents.venueId
            LEFT JOIN participatingArtists ON musicTickets.ticketId = participatingArtists.ticketId
            LEFT JOIN artists ON participatingArtists.artistId = artists.artistId
            WHERE musicTickets.userId = :userId
        ");
        $stmt->execute([':userId' => $userId]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\Models\\MusicTicket');
        $tickets = $stmt->fetchAll();
    
        return $tickets;
    }

    function getYummyTickets($userId) {
        $stmt = $this->db->prepare("
            SELECT
                yummyTickets.ticketId,
                yummyTickets.kidsQuantity,
                yummyTickets.adultsQuantity, 
                yummyTickets.isPurchased, 
                yummyTickets.isActive,
                yummyTickets.notes,
                yummyTickets.dateTime,
                yummyRestaurants.name,
                yummyRestaurants.kidPrice,
                yummyRestaurants.adultPrice,
                yummyRestaurants.duration,
                yummyRestaurants.image
            FROM yummyTickets
            INNER JOIN yummyRestaurants ON yummyTickets.ticketId = yummyRestaurants.restaurantId
            WHERE yummyTickets.userId = :userId
        ");
        $stmt->execute([':userId' => $userId]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\Models\\YummyTicket');
        $tickets = $stmt->fetchAll();
    
        return $tickets;
    }

    function getHistoryTickets($userId) {
        $stmt = $this->db->prepare("
            SELECT
                historyTickets.ticketId,
                historyTours.dateTime,
                historyTickets.singleTicketQuantity,
                historyTickets.familyTicketQuantity,
                historyTickets.isPurchased,
                historyTickets.isActive,
                historyTours.startLocation,
                historyTours.singlePrice,
                historyTours.familyPrice,
                historyTours.image
            FROM historyTickets
            INNER JOIN historyTours ON historyTickets.ticketId = historyTours.tourId
            WHERE historyTickets.userId = :userId
        ");
        $stmt->execute([':userId' => $userId]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\Models\\HistoryTicket');
        $tickets = $stmt->fetchAll();
    
        return $tickets;
    }

    function updateTicketQuantity($userId, $ticketId, $eventType, $ticketType, $quantity) {
        $tableName = $eventType . 'Tickets';
        $stmt = $this->db->prepare("
            UPDATE $tableName
            SET $ticketType = :quantity
            WHERE userId = :userId AND ticketId = :ticketId
        ");
        return $stmt->execute([
            ':quantity' => $quantity,
            ':userId' => $userId,
            ':ticketId' => $ticketId
        ]);
    }

    function deleteTicket($userId, $ticketId, $eventType) {
        $tableName = $eventType . 'Tickets';
        $stmt = $this->db->prepare("
            DELETE FROM $tableName
            WHERE userId = :userId AND ticketId = :ticketId
        ");
        return $stmt->execute([
            ':userId' => $userId,
            ':ticketId' => $ticketId
        ]);
    }

    function setActiveStatus($userId, $ticketId, $eventType, $status) {
        $tableName = $eventType . 'Tickets';
        $stmt = $this->db->prepare("
            UPDATE $tableName
            SET isActive = :status
            WHERE userId = :userId AND ticketId = :ticketId
        ");
        return $stmt->execute([
            ':status' => $status,
            ':userId' => $userId,
            ':ticketId' => $ticketId
        ]);
    }
}
?>
