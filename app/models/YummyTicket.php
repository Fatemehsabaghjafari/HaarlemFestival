<?php
namespace App\Models;

class YummyTicket {
    public $ticketId;
    public $dateTime;
    public $duration;
    public $kidsQuantity;
    public $adultsQuantity;
    public $isPurchased;
    public $isActive;
    public $notes;
    public $name;
    public $price;
    public $kidPrice;
    public $adultPrice;
    public $image;

    function getTicketId() {
        return $this->ticketId;
    }

    function getTotalPrice() {
        return ($this->kidsQuantity * $this->kidPrice) + ($this->adultsQuantity * $this->adultPrice);
    }

    function getEventType() {
        return "yummy";
    }
}