<?php

require_once __DIR__ . '/../services/orderservice.php';
require_once __DIR__ . '/../services/personalprogramservice.php';
require_once __DIR__ . '/../controllers/controller.php';
require '../vendor/autoload.php';

use Mollie\Api\MollieApiClient;

class PaymentController extends Controller
{
    private $orderService;
    private $personalProgramService;
    private $mollie;

    public function __construct()
    {
        $this->orderService = new \App\Services\OrderService();
        $this->personalProgramService = new \App\Services\PersonalProgramService();
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("test_MGHU4tVxF8S8yB8KrfjmxBz55jaaQt");
    }

    public function index()
    {      
       
    }

    public function pay()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->orderService->createOrder(1);
            $result = json_decode($result, true);

            $payment = $this->mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => number_format($result['totalPrice'], 2)
                ],
                "description" => "Haarlem Festival Ticket",
                "redirectUrl" => "http://localhost/order-confirmation?id={$result['orderId']}"
            ]);

            $this->orderService->setPaymentId($result['orderId'], $payment->id);
            
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
