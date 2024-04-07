<?php
require_once __DIR__ . '/../services/danceservice.php';

class DanceapiController {
    private $danceService;

    public function __construct() {
        $this->danceService = new \App\Services\DanceService();
    }

    public function index() {

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $danceitems = $this->danceService->getAllTickets();
            $myJSON = json_encode($danceitems);
            echo $myJSON;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           // $this->handlePostRequest();           
        }    

         
    }

    private function handlePostRequest() {
        $postData = json_decode(file_get_contents("php://input"), true);
    
        if (!$postData || !isset($postData['action'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid request data']);
            exit;
        }
    
        switch ($postData['action']) {
    
            case 'add_to_cart':
                if (!isset($postData['ticketId'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Ticket ID not provided']);
                    exit;
                }
    
                $ticketId = $postData['ticketId']; 
    
                $result = $this->danceService->buyTicket($ticketId);
    
                if ($result) {
                    $display_message = "Ticket bought successfully!";
                    echo json_encode(['status' => 'success', 'message' => $display_message]);
                } else {
                    $display_message = "Failed to buy ticket.";
                    echo json_encode(['status' => 'error', 'message' => $display_message]);
                }
                exit;
    
            default:
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
                exit;
        }
    }
    
   
}
?>
