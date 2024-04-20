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
            $venues = $this->adminService->getAllVenues();
            $myJSON = json_encode($venues);
            echo $myJSON;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest();
        }
    }
    private function handlePostRequest()
    {
        //$postData = json_decode(file_get_contents("php://input"), true);

        if (!isset ($_POST['action'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid request data']);
            exit;
        }

        switch ($_POST['action']) {

            case 'add-venue':

                $venueName = $_POST['venueName'];
                $venueAddress = $_POST['venueAddress'];

                $result = $this->adminService->addVenue($venueName, $venueAddress);

                if ($result) {
                    // Success response
                    echo json_encode(['status' => 'success', 'message' => 'Venue added successfully']);
                } else {
                    // Error response
                    echo json_encode(['status' => 'error', 'message' => 'Failed to add venue']);
                }

                break;

            case 'delete-venue':
                if (!isset ($_POST['venueId'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Artist ID not provided']);
                    exit;
                }

                $venueId = $_POST['venueId'];

                $result = $this->adminService->deleteVenueById($venueId);

                if ($result) {
                    $display_message = "venue deleted successfully!";
                    echo json_encode(['status' => 'success', 'message' => $display_message]);
                } else {
                    $display_message = "Failed to delete venue.";
                    echo json_encode(['status' => 'error', 'message' => $display_message]);
                }
                break;
            case 'edit-venue':
                // Check if all required parameters are provided
                if (!isset ($_POST['venueId'], $_POST['venueName'], $_POST['venueAddress'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
                    exit;
                }

                        // Image upload successful, now update artist data in the database
                        $venueId = $_POST['venueId'];
                        $venueName = $_POST['venueName'];
                        $venueAddress = $_POST['venueAddress'];

                        // Update artist data in the database
                        $result = $this->adminService->updateVenue($venueId, $venueName, $venueAddress);

                        if ($result) {
                            // Success response
                            echo json_encode(['status' => 'success', 'message' => 'Venue updated successfully']);
                        } else {
                            // Error response
                            echo json_encode(['status' => 'error', 'message' => 'Failed to update venue']);
                        }

                break;

            default:
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
                exit;
        }
    }
}