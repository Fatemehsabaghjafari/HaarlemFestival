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
    public $artists;
    public $venueName;
    public $image;

    public function getTicketId() {
        return $this->ticketId;
    }

    public function getDateTime() {
        return $this->dateTime;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function getOneDayAccessTicketQuantity(): int{
        return $this->oneDayAccessTicketQuantity;
    }

    public function getOneDayAccessPrice(): int {
        return $this->oneDayAccessPrice;
    }

    public function getAllDaysAccessTicketQuantity(): int {
        return $this->allDaysAccessTicketQuantity;
    }

    public function getAllDaysAccessPrice(): int {
        return $this->allDaysAccessPrice;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function getPrice(): int {
        return $this->price;
    }

    public function getIsPurchased() {
        return $this->isPurchased;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    public function getArtistName() {
        return str_replace(',', ', ', $this->artists);
    }

    public function getVenueName() {
        return $this->venueName;
    }

    public function getImage() {
        return $this->image;
    }

    public function getTotalPrice() {
        return ($this->quantity * $this->price) + ($this->oneDayAccessTicketQuantity * $this->oneDayAccessPrice) + ($this->allDaysAccessTicketQuantity * $this->allDaysAccessPrice);
    }

    public function getEventType() {
        return "music";
    }
}