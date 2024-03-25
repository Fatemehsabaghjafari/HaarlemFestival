<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/adminrepository.php';

class AdminService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\AdminRepository();
    }

    public function getAllEvents(){
        return $this->repository->getAllEvents();
    }

    public function getAllVenues(){
        return $this->repository->getAllVenues();
    }

    public function getAllArtists(){
        return $this->repository->getAllArtists();
    }

    public function deleteArtistById($artistId) {
        return $this->repository->deleteArtistById($artistId);
    }

    public function addArtist($artistName, $style, $imagePath){
        return $this->repository->addArtist($artistName, $style, $imagePath);
    }

    public function updateArtist($artistId, $artistName, $style, $imagePath){
        return $this->repository->updateArtist($artistId, $artistName, $style, $imagePath);
    }
}
