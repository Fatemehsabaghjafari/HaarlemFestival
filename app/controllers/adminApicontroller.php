<?php

require_once __DIR__ . '/../services/adminservice.php';
require_once __DIR__ . '/controller.php';

class AdminApiController extends Controller
{
    private $adminService;

    public function __construct()
    {
        $this->adminService = new \App\Services\AdminService();
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $artists = $this->adminService->getAllArtists();
            $myJSON = json_encode($artists);
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

            case 'delete-artist':
                if (!isset ($_POST['artistId'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Artist ID not provided']);
                    exit;
                }

                $artistId = $_POST['artistId'];

                $result = $this->adminService->deleteArtistById($artistId);

                if ($result) {
                    $display_message = "artist deleted successfully!";
                    echo json_encode(['status' => 'success', 'message' => $display_message]);
                } else {
                    $display_message = "Failed to delete artist.";
                    echo json_encode(['status' => 'error', 'message' => $display_message]);
                }
                break;
            case 'add-artist':
                // Check if image file is uploaded
                if (isset ($_FILES['img'])) {
                    $image = $_FILES['img'];
                    $uploadPath = __DIR__ . '/../public/img/';
                    $filename = $image['name'];
                    $targetPath = $uploadPath . basename($filename);

                    // Move uploaded file to desired directory
                    if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                        // Image upload successful, now insert artist data into database
                        $artistName = $_POST['artistName'];
                        $style = $_POST['style'];

                        // Insert artist data into the database
                        $result = $this->adminService->addArtist($artistName, $style, "/img/" . $filename);

                        if ($result) {
                            // Success response
                            echo json_encode(['status' => 'success', 'message' => 'Artist added successfully']);
                        } else {
                            // Error response
                            echo json_encode(['status' => 'error', 'message' => 'Failed to add artist']);
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
            case 'edit-artist':
                // Check if all required parameters are provided
                if (!isset ($_POST['artistId'], $_POST['artistName'], $_POST['style'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
                    exit;
                }

                // Check if image file is uploaded
                if (isset ($_FILES['img'])) {
                    $image = $_FILES['img'];
                    $uploadPath = __DIR__ . '/../public/img/';
                    $filename = $image['name'];
                    $targetPath = $uploadPath . basename($filename);

                    // Move uploaded file to desired directory
                    if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                        // Image upload successful, now update artist data in the database
                        $artistId = $_POST['artistId'];
                        $artistName = $_POST['artistName'];
                        $style = $_POST['style'];

                        // Update artist data in the database
                        $result = $this->adminService->updateArtist($artistId, $artistName, $style, "/img/" . $filename);

                        if ($result) {
                            // Success response
                            echo json_encode(['status' => 'success', 'message' => 'Artist updated successfully']);
                        } else {
                            // Error response
                            echo json_encode(['status' => 'error', 'message' => 'Failed to update artist']);
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
