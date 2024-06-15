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
    
    function createOrder($userId) {
        $orderId = uniqid('', true);
        $musicTickets = $this->personalProgramRepository->getMusicTickets($userId, true, true);
        $yummyTickets = $this->personalProgramRepository->getYummyTickets($userId, true, true);
        $historyTickets = $this->personalProgramRepository->getHistoryTickets($userId, true, true);

        $tickets = array_merge($musicTickets, $yummyTickets, $historyTickets);
        $totalPrice = 0;

        foreach ($tickets as $ticket) {
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
}
?>
