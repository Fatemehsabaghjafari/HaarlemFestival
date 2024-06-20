<?php

require_once __DIR__ . '/../services/orderservice.php';
require_once __DIR__ . '/../services/personalprogramservice.php';
require_once __DIR__ . '/../services/userAdminservice.php';
require_once __DIR__ . '/../controllers/controller.php';
require_once __DIR__ . '/../models/user.php';
require '../vendor/autoload.php';

use Mollie\Api\MollieApiClient;

class PaymentController extends Controller
{
    private $orderService;
    private $personalProgramService;
    private $userService;
    private $mollie;

    public function __construct()
    {
        $this->orderService = new \App\Services\OrderService();
        $this->personalProgramService = new \App\Services\PersonalProgramService();
        $this->userService = new \App\Services\UserAdminservice();
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("test_MGHU4tVxF8S8yB8KrfjmxBz55jaaQt");
    }

    public function index()
    {      
       
    }

    public function pay()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
    
            $userId = $_SESSION['user']->id;
            $result = $this->orderService->createOrder($userId);
            $result = json_decode($result, true);
            $price = $result['totalPrice'];
            $vat = $result['totalPrice'] * 0.21;
            $totalPrice = number_format($result['totalPrice'] + $vat, 2);
            $firstName = htmlspecialchars($_POST['firstName']);
            $lastName = htmlspecialchars($_POST['lastName']);
            $address = htmlspecialchars($_POST['address']);
            $phone = htmlspecialchars($_POST['phone']);

            $payment = $this->mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $totalPrice
                ],
                "description" => "Haarlem Festival Ticket",
                "redirectUrl" => "http://localhost/order-confirmation?id={$result['orderId']}"
            ]);

            $this->orderService->setPaymentId($result['orderId'], $payment->id);
            $order = $this->orderService->getOrderItems($result['orderId']);
            $this->userService->setUserDetails($order[0]['userId'], $firstName, $lastName, $address, $phone);
            
            header("Location: " . $payment->getCheckoutUrl(), true, 303);
        }
    }

    public function orderConfirmation() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $orderId = $_GET['id'];

            try {
                $isOrderCompleted = false;
                $order = $this->orderService->getOrderItems($orderId);
                
                if (count($order) === 0) {
                    throw new Exception("Order not found");
                }

                $payment = $this->mollie->payments->get($order[0]["paymentId"]);

                if ($payment->isPaid())
                {
                    $isOrderCompleted = true;
                    $this->personalProgramService->setPurchasedStatus(1, $order, true);
                    $this->orderService->createQRCodeHashes($orderId);

                    $order = $this->orderService->getOrderItems($orderId);
                    $this->orderService->createQRCodeHashes($orderId);
                    $this->orderService->generateInvoice($order);

                    for ($i = 0; $i < count($order); $i++) {
                        $ticket = $order[$i];
                        $this->orderService->generateTicket($ticket['orderId'], $ticket['ticketId']);
                    }
                } else {
                    throw new Exception("Payment is not completed");
                }

            } catch (Exception $exception) {
                $isOrderCompleted = false;
            }

            include '../views/orderConfirmation.php';
        }
    }
}
