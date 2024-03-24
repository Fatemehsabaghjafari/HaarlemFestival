<?php

require_once __DIR__ . '/../../services/personalProgramservice.php';
require_once __DIR__ . '/../../controllers/controller.php';

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

            $result = $this->personalProgramService->updateTicketQuantity("1", $ticketId, $eventType, $ticketType, $quantity);

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

            $result = $this->personalProgramService->deleteTicket("1", $ticketId, $eventType);

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

            $result = $this->personalProgramService->setActiveStatus("1", $ticketId, $eventType, $status);

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
