<?php

require_once __DIR__ . '/../services/danceVenueAdminservice.php';
require_once __DIR__ . '/controller.php';

class AdminDanceVenueApiController extends Controller
{
    private $adminService;

    public function __construct()
    {
        $this->adminService = new \App\Services\DanceVenueAdminService();
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->handleGetRequest();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest();
        }
    }

    private function handleGetRequest()
    {
        $venues = $this->adminService->getAllVenues();
        $this->sendResponse($venues);
    }

    private function handlePostRequest()
    {
        //$postData = json_decode(file_get_contents("php://input"), true);

        if (!isset ($_POST['action'])) {
            $this->sendErrorResponse('Invalid request data', 400);
        }

        switch ($_POST['action']) {
            case 'add-venue':
                $this->addVenue();
                break;
            case 'delete-venue':
                $this->deleteVenue();
                break;
            case 'edit-venue':
                $this->editVenue();
                break;
            default:
                $this->sendErrorResponse('Invalid action', 400);
                break;
        }
    }

    private function addVenue()
    {
        $venueName = $_POST['venueName'];
        $venueAddress = $_POST['venueAddress'];

        $result = $this->adminService->addVenue($venueName, $venueAddress);

        $message = $result ? 'Venue added successfully' : 'Failed to add venue';
        $this->sendResponse(['status' => $result ? 'success' : 'error', 'message' => $message]);
    }

    private function deleteVenue()
    {
        if (!isset ($_POST['venueId'])) {
            $this->sendErrorResponse('Venue ID not provided', 400);
        }

        $venueId = $_POST['venueId'];

        $result = $this->adminService->deleteVenueById($venueId);

        $message = $result ? 'Venue deleted successfully' : 'Failed to delete venue';
        $this->sendResponse(['status' => $result ? 'success' : 'error', 'message' => $message]);
    }

    private function editVenue()
    {
        if (!isset ($_POST['venueId'], $_POST['venueName'], $_POST['venueAddress'])) {
            $this->sendErrorResponse('Missing required parameters', 400);
        }

        $venueId = $_POST['venueId'];
        $venueName = $_POST['venueName'];
        $venueAddress = $_POST['venueAddress'];

        $result = $this->adminService->updateVenue($venueId, $venueName, $venueAddress);

        $message = $result ? 'Venue updated successfully' : 'Failed to update venue';
        $this->sendResponse(['status' => $result ? 'success' : 'error', 'message' => $message]);
    }

    private function sendResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    private function sendErrorResponse($message, $statusCode)
    {
        http_response_code($statusCode);
        echo json_encode(['status' => 'error', 'message' => $message]);
        exit;
    }
}
