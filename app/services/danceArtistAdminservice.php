<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/danceArtistAdminrepository.php';

class DanceArtistAdminservice
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\DanceArtistAdminRepository();
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
