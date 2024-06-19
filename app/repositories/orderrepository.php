<?php
namespace App\Repositories;

require_once __DIR__ . '/personalProgramrepository.php';
use PDO;

class OrderRepository {
    private $db;
    private $personalProgramRepository;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
        $this->personalProgramRepository = new \App\Repositories\PersonalProgramRepository();
    }

    // Function to check ticket availability
    private function checkTicketAvailability($ticket) {
        $eventId = $ticket->getEventId();
        $eventType = $ticket->getEventType();
        $quantity = $ticket->getQuantity();

        switch ($eventType) {
            case 'music':
                $stmt = $this->db->prepare("
                    SELECT ticketsAvailable 
                    FROM musicEvents 
                    WHERE eventId = :eventId
                ");
                break;
            case 'yummy':
                $stmt = $this->db->prepare("
                    SELECT seats 
                    FROM yummyRestaurants 
                    WHERE restaurantId = :eventId
                ");
                break;
            case 'history':
                $stmt = $this->db->prepare("
                    SELECT seatsPerTour 
                    FROM HistoryTours 
                    WHERE tourId = :eventId
                ");
                break;
            default:
                return false;
        }

        $stmt->execute([':eventId' => $eventId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return false;
        }

        $availableTickets = $result['ticketsAvailable'] ?? $result['seats'] ?? $result['seatsPerTour'];

        // Calculate the 90% threshold for single tickets
        $maxSingleTickets = floor($availableTickets * 0.9);

        // Check if the requested quantity exceeds the available tickets or the 90% threshold
        if ($quantity > $maxSingleTickets) {
            return false;
        }

        return true;
    }

    function createOrder($userId) {
        $orderId = uniqid('', true);
        $musicTickets = $this->personalProgramRepository->getMusicTickets($userId, true, true);
        $yummyTickets = $this->personalProgramRepository->getYummyTickets($userId, true, true);
        $historyTickets = $this->personalProgramRepository->getHistoryTickets($userId, true, true);

        $tickets = array_merge($musicTickets, $yummyTickets, $historyTickets);
        $totalPrice = 0;

        foreach ($tickets as $ticket) {
            if (!$this->checkTicketAvailability($ticket)) {
                return json_encode([
                    'error' => 'Ticket availability exceeded for ' . $ticket->getEventType() . ' event.'
                ]);
            }

            $totalPrice += $ticket->getTotalPrice();

            $stmt = $this->db->prepare("
                INSERT INTO orders (orderId, eventType, ticketId, userId)
                VALUES (:orderId, :eventType, :ticketId, :userId)
            ");
            $stmt->execute([
                ':orderId' => $orderId,
                ':eventType' => $ticket->getEventType(),
                ':ticketId' => $ticket->getTicketId(),
                ':userId' => $userId
            ]);
        }

        return json_encode([
            'orderId' => $orderId,
            'totalPrice' => $totalPrice
        ]);
    }

    function setPaymentId($orderId, $paymentId) {
        $stmt = $this->db->prepare("
            UPDATE orders
            SET paymentId = :paymentId
            WHERE orderId = :orderId
        ");
        $stmt->execute([
            ':paymentId' => $paymentId,
            ':orderId' => $orderId
        ]);
    }

    function getOrderItems($orderId) {
        $stmt = $this->db->prepare("
            SELECT * FROM orders
            WHERE orderId = :orderId
        ");
        $stmt->execute([':orderId' => $orderId]);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $order = $stmt->fetchAll();

        return $order;
    }

    function getOrderItem($orderId, $ticketId) {
        $stmt = $this->db->prepare("
            SELECT * FROM orders
            WHERE orderId = :orderId AND ticketId = :ticketId
        ");
        $stmt->execute([
            ':orderId' => $orderId,
            ':ticketId' => $ticketId
        ]);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $order = $stmt->fetch();

        return $order;
    }

    function setQRCodeHash($id, $hash) {
        $stmt = $this->db->prepare("
            UPDATE orders
            SET qrCode = :hash
            WHERE id = :id
        ");
        $stmt->execute([
            ':hash' => $hash,
            ':id' => $id
        ]);
    }

    public function getAllOrders() {
        $stmt = $this->db->prepare("
            SELECT orders.*, users.username 
            FROM orders 
            JOIN users ON orders.userId = users.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
