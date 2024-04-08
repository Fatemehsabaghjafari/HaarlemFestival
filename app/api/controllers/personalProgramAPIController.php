<?php

require_once __DIR__ . '/../../services/personalProgramservice.php';
require_once __DIR__ . '/../../controllers/controller.php';
require_once __DIR__ . '/../../models/user.php';

class PersonalProgramAPIController extends Controller
{
    private $personalProgramService;

    public function __construct()
    {
        $this->personalProgramService = new \App\Services\PersonalProgramService();

    }

    public function index()
    {      
       
    }

    public function updateTicketQuantity()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ticketId = $_POST['ticketId'];
            $eventType = $_POST['eventType'];
            $ticketType = $_POST['ticketType'];
            $quantity = $_POST['quantity'];

            if (!isset($ticketId) || !isset($eventType) || !isset($ticketType) || !isset($quantity)) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid request']);
                return;
            }

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $userId = $_SESSION['user']->getId();
            $result = $this->personalProgramService->updateTicketQuantity($userId, $ticketId, $eventType, $ticketType, $quantity);

            if ($result) {
                http_response_code(200);
                echo json_encode(['status' => 'success']);
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'failed']);
            }
        }
    }

    public function deleteTicket()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ticketId = $_POST['ticketId'];
            $eventType = $_POST['eventType'];

            if (!isset($ticketId) || !isset($eventType)) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid request']);
                return;
            }

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $userId = $_SESSION['user']->getId();
            $result = $this->personalProgramService->deleteTicket($userId, $ticketId, $eventType);

            if ($result) {
                http_response_code(200);
                echo json_encode(['status' => 'success']);
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'failed']);
            }
        }
    }

    public function setActiveStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ticketId = $_POST['ticketId'];
            $eventType = $_POST['eventType'];
            $status = $_POST['status'];

            if (!isset($ticketId) || !isset($eventType) || !isset($status)) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid request']);
                return;
            }

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $userId = $_SESSION['user']->getId();
            $result = $this->personalProgramService->setActiveStatus($userId, $ticketId, $eventType, $status);

            if ($result) {
                http_response_code(200);
                echo json_encode(['status' => 'success']);
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'failed']);
            }
        }
    }
}
