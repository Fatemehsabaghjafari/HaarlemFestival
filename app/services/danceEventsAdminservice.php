<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/danceEventsAdminrepository.php';

class DanceEventsAdminService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\DanceEventsAdminRepository();
    }

    public function getAllEvents(){
        return $this->repository->getAllEvents();
    }
    public function addMusicEvent($ticketsAvailable, $dateTime, $venueName, $sessionId, $duration, $price, $accessPrice, $oneDayAccessPrice, $date, $time, $image){
        return $this->repository->addMusicEvent($ticketsAvailable, $dateTime, $venueName, $sessionId, $duration, $price, $accessPrice, $oneDayAccessPrice, $date, $time, $image);
    }
    
    public function deleteMusicEventById($eventId) {
        return $this->repository->deleteMusicEventById($eventId);
    }
    
    public function updateMusicEvent($eventId, $dateTime, $venueName, $session, $duration, $ticketsAvailable, $price, $allDaysAccessPrice, $oneDayAccessPrice, $date, $time, $image) {
        return $this->repository->updateMusicEvent($eventId, $dateTime, $venueName, $session, $duration, $ticketsAvailable, $price, $allDaysAccessPrice, $oneDayAccessPrice, $date, $time, $image);
    }
    public function getVenueNames(){
        return $this->repository->getVenueNames();
    }
}
