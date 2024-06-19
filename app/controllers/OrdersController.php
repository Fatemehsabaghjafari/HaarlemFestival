<?php

require_once __DIR__ . '/../services/personalProgramservice.php';
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../services/orderservice.php';
require_once __DIR__ . '/../services/userAdminservice.php';
require '../vendor/autoload.php';

class OrdersController extends Controller
{
    private $orderService;
    private $userAdminService;

    public function __construct()
    {
        $this->orderService = new \App\Services\OrderService();
        $this->userAdminService = new \App\Services\UserAdminService();
    }

    public function scan() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include '../views/admin/scanTicketEmployee.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $qrCode = $_POST['qrCode'];
            $order = $this->orderService->getOrderByQRCode($qrCode);
            $ticket = $this->orderService->getTicketByOrder($order);
            $this->orderService->setScannedStatus($order["orderId"]);

            $userId = $ticket->userId;
            $user = $this->userAdminService->getUserById($userId);

            include '../views/admin/viewScannedTicket.php';
        }
    }
}
