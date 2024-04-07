<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/orderrepository.php';

class OrderService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\OrderRepository();
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
}
