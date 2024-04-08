<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/danceVenueAdminrepository.php';

class DanceVenueAdminservice
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\DanceVenueAdminRepository();
    }
    public function getAllVenues(){
        return $this->repository->getAllVenues();
    }
    public function addVenue($venueName, $venueAddress){
        return $this->repository->addVenue($venueName, $venueAddress);
    }
    public function deleteVenueById($venueId) {
        return $this->repository->deleteVenueById($venueId);
    }
    public function updateVenue($venueId, $venueName, $venueAddress){
        return $this->repository->updateVenue($venueId, $venueName, $venueAddress);
    }
}
