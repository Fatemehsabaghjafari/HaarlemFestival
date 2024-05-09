<?php

require_once __DIR__ . '/../services/danceArtistAdminservice.php';
require_once __DIR__ . '/controller.php';

class DanceArtistAdminApiController extends Controller
{
    private $adminService;

    public function __construct()
    {
        $this->adminService = new \App\Services\DanceArtistAdminService();
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
        $artists = $this->adminService->getAllArtists();
        $myJSON = json_encode($artists);
        echo $myJSON;
    }

    private function handlePostRequest()
    {
        if (!isset($_POST['action'])) {
            $this->sendErrorResponse('Invalid request data');
        }

        switch ($_POST['action']) {
            case 'delete-artist':
                $this->deleteArtist();
                break;
            case 'add-artist':
                $this->addArtist();
                break;
            case 'edit-artist':
                $this->editArtist();
                break;
            default:
                $this->sendErrorResponse('Invalid action');
                break;
        }
    }

    private function deleteArtist()
    {
        if (!isset($_POST['artistId'])) {
            $this->sendErrorResponse('Artist ID not provided');
        }

        $artistId = $_POST['artistId'];
        $result = $this->adminService->deleteArtistById($artistId);

        if ($result) {
            $this->sendSuccessResponse('Artist deleted successfully!');
        } else {
            $this->sendErrorResponse('Failed to delete artist.');
        }
    }

    private function addArtist()
    {
        if (!isset($_FILES['img'])) {
            $this->sendErrorResponse('No image uploaded');
        }

        $image = $_FILES['img'];
        $uploadPath = __DIR__ . '/../public/img/';
        $filename = $image['name'];
        $targetPath = $uploadPath . basename($filename);

        if (move_uploaded_file($image['tmp_name'], $targetPath)) {
            $artistName = $_POST['artistName'];
            $style = $_POST['style'];
            $result = $this->adminService->addArtist($artistName, $style, "/img/" . $filename);

            if ($result) {
                $this->sendSuccessResponse('Artist added successfully');
            } else {
                $this->sendErrorResponse('Failed to add artist');
            }
        } else {
            $this->sendErrorResponse('Failed to upload image');
        }
    }

    private function editArtist()
    {
        if (!isset($_POST['artistId'], $_POST['artistName'], $_POST['style'])) {
            $this->sendErrorResponse('Missing required parameters');
        }

        if (!isset($_FILES['img'])) {
            $this->sendErrorResponse('No image uploaded');
        }

        $image = $_FILES['img'];
        $uploadPath = __DIR__ . '/../public/img/';
        $filename = $image['name'];
        $targetPath = $uploadPath . basename($filename);

        if (move_uploaded_file($image['tmp_name'], $targetPath)) {
            $artistId = $_POST['artistId'];
            $artistName = $_POST['artistName'];
            $style = $_POST['style'];
            $result = $this->adminService->updateArtist($artistId, $artistName, $style, "/img/" . $filename);

            if ($result) {
                $this->sendSuccessResponse('Artist updated successfully');
            } else {
                $this->sendErrorResponse('Failed to update artist');
            }
        } else {
            $this->sendErrorResponse('Failed to upload image');
        }
    }

    private function sendErrorResponse($message)
    {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => $message]);
        exit;
    }

    private function sendSuccessResponse($message)
    {
        echo json_encode(['status' => 'success', 'message' => $message]);
        exit;
    }
}
