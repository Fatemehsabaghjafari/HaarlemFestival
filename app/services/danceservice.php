<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/dancerepository.php';

class DanceService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\DanceRepository();
    }

    public function getAllTickets(){
        return $this->repository->getAllTickets();
    }

    public function getAllVenues(){
        return $this->repository->getAllVenues();
    }

    public function getAllArtists(){
        return $this->repository->getAllArtists();
    }

    public function getAllTicketsOfPersonalProgram(){
        return $this->repository->getAllTicketsOfPersonalProgram();
    }
    
    public function getTicketsByArtist($artistId){
        return $this->repository->getTicketsByArtist($artistId);
    }

    public function getAllTicketsForArtist($artistId){
        return $this->repository->getAllTicketsForArtist($artistId);
    }

    public function getAllTicketsForDateAndVenue($date, $venueId){
        return $this->repository->getAllTicketsForDateAndVenue($date, $venueId);
    }

    public function buyTicket($ticketId) {
        return $this->repository->buyTicket($ticketId);
    }

    public function addNewTicketForLoggedInUser($eventId, $quantity){
        return $this->repository->addNewTicketForLoggedInUser($eventId, $quantity);
    }

    public function addNewOneDayTicketForLoggedInUser($eventId){
        return $this->repository->addNewOneDayTicketForLoggedInUser($eventId);
    }

    public function addNewAllDaysTicketForLoggedInUser($eventId){
        return $this->repository->addNewAllDaysTicketForLoggedInUser($eventId);
    }

}
