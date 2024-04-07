<?php
require_once __DIR__ . '/../services/danceservice.php';

class DancePersonalProgramApiController
{
    private $danceService;

    public function __construct()
    {
        $this->danceService = new \App\Services\DanceService();
    }

    public function index()
    {
        $postData = json_decode(file_get_contents("php://input"), true);

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $danceitems = $this->danceService->getAllTicketsOfPersonalProgram();
            $myJSON = json_encode($danceitems);
            echo $myJSON;
        }

        // Additional logic for handling adding new tickets for logged-in users
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset ($postData['action']) && $postData['action'] === 'add_new_ticket') {
            try {
                // Check if required parameters are provided
                if (!isset ($postData['eventId']) || !isset ($postData['quantity'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
                    exit;
                }

                // Retrieve additional parameters if provided
                $oneDayAccessTicketQuantity = $postData['oneDayAccessTicketQuantity'] ?? null;
                $allDaysAccessTicketQuantity = $postData['allDaysAccessTicketQuantity'] ?? null;
                $isPurchased = $postData['isPurchased'] ?? null;

                // Add new ticket for logged-in user
                $result = $this->danceService->addNewTicketForLoggedInUser(
                    $postData['eventId'],
                    $postData['quantity'],
                );

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Ticket added successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to add ticket']);
                }
                exit;
            } catch (Exception $e) {
                // Handle the exception
                http_response_code(500); // Internal Server Error
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                exit;
            }

        }






        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset ($postData['action']) && $postData['action'] === 'add_new_oneDayTicket') {
            try {
                // Check if required parameters are provided
                if (!isset ($postData['eventId'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
                    exit;
                }

                // Retrieve additional parameters if provided
                $oneDayAccessTicketQuantity = $postData['oneDayAccessTicketQuantity'] ?? null;
                $allDaysAccessTicketQuantity = $postData['allDaysAccessTicketQuantity'] ?? null;
                $isPurchased = $postData['isPurchased'] ?? null;

                // Add new ticket for logged-in user
                $result = $this->danceService->addNewOneDayTicketForLoggedInUser(
                    $postData['eventId'],
                );

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Ticket added successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to add ticket']);
                }
                exit;
            } catch (Exception $e) {
                // Handle the exception
                http_response_code(500); // Internal Server Error
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                exit;
            }

        }







        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset ($postData['action']) && $postData['action'] === 'add_new_allDaysTicket') {
            try {
                // Check if required parameters are provided
                if (!isset ($postData['eventId'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
                    exit;
                }

                // Retrieve additional parameters if provided
                $oneDayAccessTicketQuantity = $postData['oneDayAccessTicketQuantity'] ?? null;
                $allDaysAccessTicketQuantity = $postData['allDaysAccessTicketQuantity'] ?? null;
                $isPurchased = $postData['isPurchased'] ?? null;

                // Add new ticket for logged-in user
                $result = $this->danceService->addNewAllDaysTicketForLoggedInUser(
                    $postData['eventId'],
                );

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Ticket added successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to add ticket']);
                }
                exit;
            } catch (Exception $e) {
                // Handle the exception
                http_response_code(500); // Internal Server Error
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                exit;
            }

        }
    }


}
?>