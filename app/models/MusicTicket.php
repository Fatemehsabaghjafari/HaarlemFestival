<?php
namespace App\Models;

class MusicTicket {
    public $ticketId;
    public $dateTime;
    public $duration;
    public $oneDayAccessTicketQuantity;
    public $oneDayAccessPrice;
    public $allDaysAccessTicketQuantity;
    public $allDaysAccessPrice;
    public $quantity;
    public $price;
    public $isPurchased;
    public $isActive;
    public $artistName;
    public $venueName;
    public $image;

    function getTicketId() {
        return $this->ticketId;
    }

    function getTotalPrice() {
        return ($this->quantity * $this->price) + ($this->oneDayAccessTicketQuantity * $this->oneDayAccessPrice) + ($this->allDaysAccessTicketQuantity * $this->allDaysAccessPrice);
    }

    function getEventType() {
        return "music";
    }
}