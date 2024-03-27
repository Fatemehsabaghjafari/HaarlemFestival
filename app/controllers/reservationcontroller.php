<?php

require_once __DIR__ . '/../services/yummyservice.php';
require_once __DIR__ . '/controller.php';

class Reservationcontroller extends Controller
{
    private $yummiService;


    public function __construct()
    {
        $this->yummiService = new \App\Services\YummyService();

    }

    public function index()
    {      
        $restaurant = $this->yummiService->getRestaurantById(1);
        $dates = [ '2024-07-26', '2024-07-27', '2024-07-28', '2024-07-29' ];
        $timeslots = array();
        $startTime = strtotime($restaurant->firstSession); // Convert start time to Unix timestamp
        $duration = $restaurant->duration * 3600; // Convert duration to seconds
        $sessions = intval($restaurant->sessions); // Number of sessions
        for ($i = 0; $i < $sessions; $i++) {
            $timeslots[] = date('H:i:s', $startTime); // Add current timeslot to array
            $startTime += $duration; // Increment start time by duration
        }
    
        print_r($timeslots); // Print available timeslots
        include '../views/reservation.php'; // Include view
    }
}
