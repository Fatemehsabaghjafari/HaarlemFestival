<?php

require_once __DIR__ . '/../services/danceservice.php';
require_once __DIR__ . '/controller.php';

class DanceController extends Controller
{
    private $danceService;

    public function __construct()
    {
        $this->danceService = new \App\Services\DanceService();

    }

    public function index()
    {      
        //$danceTickets = $this->danceService->getAllTickets();
        $danceArtists= $this->danceService->getAllArtists();
        $danceVenues= $this->danceService->getAllVenues();

        $ticketsByArtist = [];
        // Fetch tickets for each artist
        foreach ($danceArtists as $artist) {
            $ticketsByArtist[$artist['artistId']] = $this->danceService->getAllTicketsForArtist($artist['artistId']);
        }



        $ticketsByVenueAndDate = [];

        // Fetch tickets for each venue and date
        foreach ($danceVenues as $venue) {
            $ticketsByVenueAndDate[$venue['venueId']] = [
                '26 July' => $this->danceService->getAllTicketsForDateAndVenue('2024-07-26', $venue['venueId']),
                '27 July' => $this->danceService->getAllTicketsForDateAndVenue('2024-07-27', $venue['venueId']),
                '28 July' => $this->danceService->getAllTicketsForDateAndVenue('2024-07-28', $venue['venueId']),
            ];
        }
            
    
        include '../views/dance.php';
    }

    public function nicky()
    {  
        $artistTickets = $this->danceService->getTicketsByArtist(1);          
        include '../views/nicky.php';
    }

    public function martin()
    {            
        $artistTickets = $this->danceService->getTicketsByArtist(5);     
        include '../views/martin.php';
    }
}
