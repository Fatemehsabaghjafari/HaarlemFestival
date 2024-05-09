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
            $this->handleGetRequest();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest();
        }
    }

    private function handleGetRequest()
    {
        $events = $this->adminService->getAllEvents();
        $myJSON = json_encode($events);
        echo $myJSON;
    }

    private function handlePostRequest()
    {
        if (!isset($_POST['action'])) {
            $this->sendErrorResponse(400, 'Invalid request data');
        }

        switch ($_POST['action']) {
            case 'delete-event':
                $this->deleteEvent();
                break;
            case 'add-event':
                $this->addEvent();
                break;
            case 'edit-event':
                $this->editEvent();
                break;
            default:
                $this->sendErrorResponse(400, 'Invalid action');
                break;
        }
    }

    private function deleteEvent()
    {
        if (!isset($_POST['eventId'])) {
            $this->sendErrorResponse(400, 'Event ID not provided');
        }

        $eventId = $_POST['eventId'];
        $result = $this->adminService->deleteMusicEventById($eventId);

        $this->sendResponse($result, 'Event deleted successfully!', 'Failed to delete event.');
    }

    private function addEvent()
    {
        $this->validateRequiredParameters(['dateTime', 'venueName', 'session', 'duration', 'ticketsAvailable', 'price', 'allDaysAccessPrice', 'oneDayAccessPrice', 'date', 'time']);

        if (!isset($_FILES['image'])) {
            $this->sendErrorResponse(400, 'No image uploaded');
        }

        $image = $_FILES['image'];
        $filename = $this->uploadFile($image);
        $this->insertEventData($filename);
    }

    private function editEvent()
    {
        $this->validateRequiredParameters(['eventId', 'dateTime', 'venueName', 'session', 'duration', 'ticketsAvailable', 'price', 'allDaysAccessPrice', 'oneDayAccessPrice', 'date', 'time']);

        if (!isset($_FILES['image'])) {
            $this->sendErrorResponse(400, 'No image uploaded');
        }

        $image = $_FILES['image'];
        $filename = $this->uploadFile($image);
        $this->updateEventData($filename);
    }

    private function validateRequiredParameters($params)
    {
        foreach ($params as $param) {
            if (!isset($_POST[$param])) {
                $this->sendErrorResponse(400, 'Missing required parameters');
            }
        }
    }

    private function uploadFile($image)
    {
        $uploadPath = __DIR__ . '/../public/img/';
        $targetPath = $uploadPath . basename($image['name']);

        if (!move_uploaded_file($image['tmp_name'], $targetPath)) {
            $this->sendErrorResponse(500, 'Failed to upload image');
        }

        return $targetPath;
    }

    private function insertEventData($filename)
    {
        // Insert event data into the database
        $result = $this->adminService->addMusicEvent(
            $_POST['dateTime'],
            $_POST['venueName'],
            $_POST['session'],
            $_POST['duration'],
            $_POST['ticketsAvailable'],
            $_POST['price'],
            $_POST['allDaysAccessPrice'],
            $_POST['oneDayAccessPrice'],
            date('Y-m-d', strtotime($_POST['date'])),
            date('H:i:s', strtotime($_POST['time'])),
            "/img/" . basename($filename)
        );

        $this->sendResponse($result, 'Event added successfully', 'Failed to add event');
    }

    private function updateEventData($filename)
    {
        // Update event data in the database
        $result = $this->adminService->updateMusicEvent(
            $_POST['eventId'],
            $_POST['dateTime'],
            $_POST['venueName'],
            $_POST['session'],
            $_POST['duration'],
            $_POST['ticketsAvailable'],
            $_POST['price'],
            $_POST['allDaysAccessPrice'],
            $_POST['oneDayAccessPrice'],
            date('Y-m-d', strtotime($_POST['date'])),
            date('H:i:s', strtotime($_POST['time'])),
            "/img/" . basename($filename)
        );

        $this->sendResponse($result, 'Event updated successfully', 'Failed to update event');
    }

    private function sendResponse($result, $successMessage, $errorMessage)
    {
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => $successMessage]);
        } else {   
           echo json_encode(['status' => 'error', 'message' => $errorMessage]);
        }
    }

    private function sendErrorResponse($code, $message)
    {
        http_response_code($code);
        echo json_encode(['status' => 'error', 'message' => $message]);
        exit;
    }
}
?>
