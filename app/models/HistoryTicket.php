<?php
namespace App\Models;

class HistoryTicket {
    public $ticketId;
    public $userId;
    public $dateTime;
    public $singleTicketQuantity;
    public $familyTicketQuantity;
    public $isPurchased;
    public $isActive;
    public $startLocation;
    public $singlePrice;
    public $familyPrice;
    public $image;

    function getTicketId() {
        return $this->ticketId;
    }

    function getTotalPrice() {
        return ($this->singleTicketQuantity * $this->singlePrice) + ($this->familyTicketQuantity * $this->familyPrice);
    }

    function getEventType() {
        return "History";
    }
}