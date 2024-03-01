<?php
require __DIR__ . '/../../services/danceservice.php';

class DanceapiController {
    private $danceService;

    public function __construct() {
        $this->danceService = new \App\Services\DanceService();
    }

    public function index() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest();           
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
                $product_quantity = 1;
                $product_name = $postData['product_name'];
                $product_price = $postData['product_price'];
        
            
               if ($this->danceService->isProductInCart($product_name)) {
                $display_message = "Item is already in the cart.";
                echo json_encode(['status' => 'success', 'message' => $display_message]);
                } 
                else {      
                $this->danceService->insertToCart($product_quantity, $product_name, $product_price);
                $display_message = "Item added to cart!";
                echo json_encode(['status' => 'success', 'message' => $display_message]);
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
