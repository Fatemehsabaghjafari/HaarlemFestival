<?php

require_once __DIR__ . '/../services/danceEventsAdminservice.php';
require_once __DIR__ . '/controller.php';

class AdminDanceEventApiController extends Controller
{
    private $adminService;

    public function __construct()
    {
        $this->adminService = new \App\Services\DanceEventsAdminService();
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $events = $this->adminService->getAllEvents();
            $myJSON = json_encode($events);
            echo $myJSON;
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest();
        }
    }

    private function handlePostRequest()
    {
        //$postData = json_decode(file_get_contents("php://input"), true);

        if (!isset($_POST['action'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid request data']);
            exit;
        }

        switch ($_POST['action']) {

            case 'delete-event':
                if (!isset($_POST['eventId'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Event ID not provided']);
                    exit;
                }

                $eventId = $_POST['eventId'];

                $result = $this->adminService->deleteMusicEventById($eventId);

                if ($result) {
                    $display_message = "Event deleted successfully!";
                    echo json_encode(['status' => 'success', 'message' => $display_message]);
                } else {
                    $display_message = "Failed to delete event.";
                    echo json_encode(['status' => 'error', 'message' => $display_message]);
                }
                break;

            case 'add-event':
                // Check if all required parameters are provided
                if (!isset($_POST['dateTime'], $_POST['venueId'], $_POST['session'], $_POST['duration'], $_POST['ticketsAvailable'], $_POST['price'], $_POST['allDaysAccessPrice'], $_POST['oneDayAccessPrice'], $_POST['date'], $_POST['time'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
                    exit;
                }

                // Check if image file is uploaded
                if (isset($_FILES['image'])) {
                    $image = $_FILES['image'];
                    $uploadPath = __DIR__ . '/../public/img/';
                    $filename = $image['name'];
                    $targetPath = $uploadPath . basename($filename);

                    // Move uploaded file to desired directory
                    if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                        // Image upload successful, now insert event data into database
                        $ticketsAvailable = $_POST['ticketsAvailable'];
                        $dateTime = $_POST['dateTime'];
                        $venueId = $_POST['venueId'];
                        $sessionId = $_POST['session'];
                        $duration = $_POST['duration'];
                        $price = $_POST['price'];
                        $accessPrice = $_POST['allDaysAccessPrice'];
                        $oneDayAccessPrice = $_POST['oneDayAccessPrice'];
                        $date = date('Y-m-d', strtotime($_POST['date'])); // Format date as YYYY-MM-DD
                        $time = date('H:i:s', strtotime($_POST['time'])); // Format time as HH:MM:SS

                        // Insert event data into the database
                        $result = $this->adminService->addMusicEvent($dateTime, $venueId, $sessionId, $duration, $ticketsAvailable, $price, $accessPrice, $oneDayAccessPrice, $date, $time, "/img/" . $filename);

                        if ($result) {
                            // Success response
                            echo json_encode(['status' => 'success', 'message' => 'Event added successfully']);
                        } else {
                            // Error response
                            echo json_encode(['status' => 'error', 'message' => 'Failed to add event']);
                        }
                    } else {
                        // Error handling for file upload failure
                        echo json_encode(['status' => 'error', 'message' => 'Failed to upload image']);
                    }
                } else {
                    // Error handling for no image uploaded
                    echo json_encode(['status' => 'error', 'message' => 'No image uploaded']);
                }
                break;


            case 'edit-user':
                // Check if all required parameters are provided
                if (!isset($_POST['eventId'], $_POST['dateTime'], $_POST['venueId'], $_POST['session'], $_POST['duration'], $_POST['price'], $_POST['allDaysAccessPrice'], $_POST['oneDayAccessPrice'], $_POST['date'], $_POST['time'], $_POST['ticketsAvailable'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
                    exit;
                }

                // Check if image file is uploaded
                if (isset($_FILES['image'])) {
                    $image = $_FILES['image'];
                    $uploadPath = __DIR__ . '/../public/img/';
                    $filename = $image['name'];
                    $targetPath = $uploadPath . basename($filename);

                    // Move uploaded file to desired directory
                    if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                        // Image upload successful, now update event data in the database
                        $eventId = $_POST['eventId'];
                        $dateTime = $_POST['dateTime'];
                        $venueId = $_POST['venueId'];
                        $sessionId = $_POST['session'];
                        $duration = $_POST['duration'];
                        $price = $_POST['price'];
                        $accessPrice = $_POST['allDaysAccessPrice'];
                        $oneDayAccessPrice = $_POST['oneDayAccessPrice'];
                        $date = date('Y-m-d', strtotime($_POST['date'])); // Format date as YYYY-MM-DD
                        $time = date('H:i:s', strtotime($_POST['time'])); // Format time as HH:MM:SS
                        $ticketsAvailable = $_POST['ticketsAvailable'];

                        // Update event data in the database
                        $result = $this->adminService->updateMusicEvent($eventId, $dateTime, $venueId, $sessionId, $duration, $ticketsAvailable, $price, $accessPrice, $oneDayAccessPrice, $date, $time, "/img/" . $filename);

                        if ($result) {
                            // Success response
                            echo json_encode(['status' => 'success', 'message' => 'Event updated successfully']);
                        } else {
                            // Error response
                            echo json_encode(['status' => 'error', 'message' => 'Failed to update event']);
                        }
                    } else {
                        // Error handling for file upload failure
                        echo json_encode(['status' => 'error', 'message' => 'Failed to upload image']);
                    }
                } else {
                    // Error handling for no image uploaded
                    echo json_encode(['status' => 'error', 'message' => 'No image uploaded']);
                }
                break;



            default:
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
                exit;
        }
    }


}
