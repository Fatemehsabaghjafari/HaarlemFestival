<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/orderrepository.php';
require_once __DIR__ . '/../repositories/userrepository.php';
require_once __DIR__ . '/../repositories/personalProgramrepository.php';
require_once __DIR__ . '/emailservice.php';
require '../vendor/autoload.php';

use chillerlan\QRCode\QRCode;

class OrderService
{
    private $repository;
    private $myProgramRepository;
    private $userRepository;
    private $emailService;

    public function __construct()
    {
        $this->repository = new \App\Repositories\OrderRepository();
        $this->myProgramRepository = new \App\Repositories\PersonalProgramRepository();
        $this->userRepository = new \App\Repositories\UserRepository();
        $this->emailService = new \App\Services\EmailService();
    }

    public function createOrder($userId) {
        return $this->repository->createOrder($userId);
    }
    
    public function setPaymentId($orderId, $paymentId) {
        return $this->repository->setPaymentId($orderId, $paymentId);
    }

    public function getOrderItems($orderId) {
        return $this->repository->getOrderItems($orderId);
    }

    public function generateTickets($orderId) {
        
    }

    function processMusicTicket($ticketItem, &$items, &$totalAmount) {
        $price = 0;
        $quantity = 0;
        $dateTime = $ticketItem->getDateTime();
        $name = "";
    
        if ($ticketItem->getOneDayAccessTicketQuantity() > 0) {
            $price = $ticketItem->getOneDayAccessPrice();
            $quantity = $ticketItem->getOneDayAccessTicketQuantity();
            $dateTime = date('d-m-Y', strtotime($ticketItem->getDateTime()));
        } else if ($ticketItem->getAllDaysAccessTicketQuantity() > 0) {
            $price = $ticketItem->getAllDaysAccessPrice();
            $quantity = $ticketItem->getAllDaysAccessTicketQuantity();
            $dateTime = "All Days Access";
        } else {
            $price = $ticketItem->getPrice();
            $quantity = $ticketItem->getQuantity();
            $name = $ticketItem->getArtistName() . " - " . $ticketItem->getVenueName();
            $dateTime = date('d-m-Y H:i', strtotime($ticketItem->getDateTime()));
        }
    
        $items[] = [
            'dateTime' => $dateTime,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'total' => $price * $quantity
        ];
    
        $totalAmount += $price * $quantity;
    }

    public function generateInvoice($order) {
        $mpdf = new \Mpdf\Mpdf();
        ob_start();
        $user = $this->userRepository->getUserById($order[0]['userId']);
        $invoiceNumber = $order[0]['orderId'];
        $firstName = $user['firstName'];
        $lastName = $user['lastName'];
        $email = $user['email'];
        $phone = $user['phone'];
        $address = $user['address'];
        date_default_timezone_set('Europe/Amsterdam');
        $invoiceDate = date('d-m-Y H:i');
        $totalAmount = 0;
        $items = [];
    
        foreach ($order as $orderItem) {
            if ($orderItem['eventType'] == "music") {
                $ticketItem = $this->myProgramRepository->getMusicTicketById($orderItem['ticketId']);
                $this->processMusicTicket($ticketItem, $items, $totalAmount);
            }
        }
    
        $vat = $totalAmount * 0.21;
        $totalAmount += $vat;
    
        include __DIR__ . '/../views/invoiceTemplate.php';
    
        $html = ob_get_contents();
    
        ob_end_clean();
    
        $mpdf->AddPage();
        $mpdf->WriteHTML($html);
        $invoiceContent = $mpdf->Output('', 'S');
        //$this->emailService->sendEmail("ugursay05@gmail.com", $invoiceDate . " Invoice Haarlem Festival", $invoiceContent);
        $this->emailService->sendEmail($user['email'], $invoiceDate . " Invoice Haarlem Festival", $invoiceContent);
    }

    public function generateTicket($orderId, $ticketId) {
        $mpdf = new \Mpdf\Mpdf();

        ob_start();

        $order = $this->repository->getOrderItem($orderId, $ticketId);
        $user = $this->userRepository->getUserById($order['userId']);
        $ticket = $this->myProgramRepository->getMusicTicketById($order['ticketId']);
        
        $firstName = $user['firstName'];
        $lastName = $user['lastName'];
        $eventType = $order['eventType'];
        $eventName = $ticket->getArtistName() . " - " . $ticket->getVenueName();
        $dateTime = date('d-m-Y H:i', strtotime($ticket->getDateTime()));
        $qrCode = $order['qrCode'];

        include __DIR__ . '/../views/ticketTemplate.php';
        $html = ob_get_contents();

        ob_end_clean();

        $mpdf->AddPage();
        $mpdf->WriteHTML($html);
        $ticketContent = $mpdf->Output('', 'S');

        $this->emailService->sendEmail($user['email'], $eventName . " Event Ticket", $ticketContent);
        //$this->emailService->sendEmail("ugursay05@gmail.com", $eventName . " Event Ticket", $ticketContent);
    }

    public function createQRCodeHashes($orderId) {
        $orders = $this->repository->getOrderItems($orderId);

        foreach ($orders as $order) {
            $data = $order['ticketId'] . "/" . $order['eventType'] . "/" . $order['orderId'] . "/" . $order['userId'];
            $data = hash('sha512', $data);
            $this->repository->setQRCodeHash($order['id'], $data);
        }
    }
}
