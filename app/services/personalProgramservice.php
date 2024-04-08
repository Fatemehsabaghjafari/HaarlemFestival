<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/personalProgramrepository.php';

class PersonalProgramService
{
    private $repository;
    private $grouped = [];

    public function __construct()
    {
        $this->repository = new \App\Repositories\PersonalProgramRepository();
    }

    public function groupMusicTickets($musicTickets) {
        foreach ($musicTickets as $object) {
            $date = date('Y-m-d', strtotime($object->dateTime));
            $time = date('H:i', strtotime($object->dateTime));
        
            // Initialize group if not exists
            if (!isset($this->grouped[$date])) {
                $this->grouped[$date] = [];
            }
        
            // Check if ticket with same ticketId and type exists in grouped array
            $found = false;
            foreach ($this->grouped[$date] as &$group) {
                if ($group['ticketId'] === $object->ticketId && $group['type'] === 'music') {
                    $group['artists'][] = $object->artists;
                    $found = true;
                    break;
                }
            }
        
            // If not found, add ticket information to the group
            if (!$found) {
                $this->grouped[$date][] = [
                    'ticketId' => $object->ticketId,
                    'venueName' => $object->venueName,
                    'artists' => [$object->artists],
                    'type' => 'music',
                    'oneDayAccessTicketQuantity' => 0,
                    'oneDayAccessPrice' => (float)$object->oneDayAccessPrice,
                    'allDaysAccessTicketQuantity' => 0,
                    'allDaysAccessPrice' => (float)$object->allDaysAccessPrice,
                    'quantity' => (int)$object->quantity,
                    'price' => (float)$object->price,
                    'isPurchased' => $object->isPurchased,
                    'isActive' => $object->isActive,
                    'time' => $time,
                    'duration' => $object->duration,
                    'image' => $object->image,
                ];
            }
        }
    }

    private function groupYummyTickets($yummyTickets) {
        foreach ($yummyTickets as $object) {
            $date = date('Y-m-d', strtotime($object->dateTime));
            $time = date('H:i', strtotime($object->dateTime));
        
            // Initialize group if not exists
            if (!isset($this->grouped[$date])) {
                $this->grouped[$date] = [];
            }
        
            // Check if ticket with same ticketId and type exists in grouped array
            $found = false;
            foreach ($this->grouped[$date] as &$group) {
                if ($group['ticketId'] === $object->ticketId && $group['type'] === 'yummy') {
                    $found = true;
                    break;
                }
            }
        
            // If not found, add ticket information to the group
            if (!$found) {
                $this->grouped[$date][] = [
                    'ticketId' => $object->ticketId,
                    'name' => $object->name,
                    'type' => 'yummy',
                    'kidsQuantity' => (int)$object->kidsQuantity,
                    'adultsQuantity' => (int)$object->adultsQuantity,
                    'price' => (float)$object->price,
                    'kidPrice' => (float)$object->kidPrice,
                    'adultPrice' => (float)$object->adultPrice,
                    'isPurchased' => $object->isPurchased,
                    'isActive' => $object->isActive,
                    'time' => $time,
                    'duration' => $object->duration,
                    'image' => $object->image,
                ];
            }
        }
    }

    private function groupHistoryTickets($historyTickets) {
        foreach ($historyTickets as $object) {
            $date = date('Y-m-d', strtotime($object->dateTime));
            $time = date('H:i', strtotime($object->dateTime));
        
            // Initialize group if not exists
            if (!isset($this->grouped[$date])) {
                $this->grouped[$date] = [];
            }
        
            // Check if ticket with same ticketId and type exists in grouped array
            $found = false;
            foreach ($this->grouped[$date] as &$group) {
                if ($group['ticketId'] === $object->ticketId && $group['type'] === 'history') {
                    $found = true;
                    break;
                }
            }
        
            // If not found, add ticket information to the group
            if (!$found) {
                $this->grouped[$date][] = [
                    'ticketId' => $object->ticketId,
                    'startLocation' => $object->startLocation,
                    'type' => 'history',
                    'singleTicketQuantity' => (int)$object->singleTicketQuantity,
                    'familyTicketQuantity' => (int)$object->familyTicketQuantity,
                    'singlePrice' => (float)$object->singlePrice,
                    'familyPrice' => (float)$object->familyPrice,
                    'isPurchased' => $object->isPurchased,
                    'isActive' => $object->isActive,
                    'time' => $time,
                    'duration' => "2.5",
                    'image' => $object->image,
                ];
            }
        }
    }

    public function getPersonalProgram($userId, $isActive = false, $isPurchased = false)
    {
        $musicTickets = $this->repository->getMusicTickets($userId, $isActive, $isPurchased);
        $yummyTickets = $this->repository->getYummyTickets($userId, $isActive, $isPurchased);
        $historyTickets = $this->repository->getHistoryTickets($userId, $isActive, $isPurchased);

        $this->groupMusicTickets($musicTickets);
        $this->groupYummyTickets($yummyTickets);
        $this->groupHistoryTickets($historyTickets);

        // Sort grouped tickets by time
        ksort($this->grouped);

        foreach ($this->grouped as &$tickets) {
            usort($tickets, function($a, $b) {
                return strtotime($a['time']) - strtotime($b['time']);
            });
        }

        return $this->grouped;
    }

    function updateTicketQuantity($userId, $ticketId, $eventType, $ticketType, $quantity) {
        $isValidTicketType = false;

        if ($eventType === 'music') {
            if ($ticketType === 'single') {
                $ticketType = 'quantity';
                $isValidTicketType = true;
            }
        } else if ($eventType === 'yummy') {
            if ($ticketType === 'adult') {
                $ticketType = 'adultsQuantity';
                $isValidTicketType = true;
            } else if ($ticketType === 'kid') {
                $ticketType = 'kidsQuantity';
                $isValidTicketType = true;
            }
        } else if ($eventType === 'history') {
            if ($ticketType === 'family') {
                $ticketType = 'familyTicketQuantity';
                $isValidTicketType = true;
            } else if ($ticketType === 'single') {
                $ticketType = 'singleTicketQuantity';
                $isValidTicketType = true;
            }
        }

        if (!$isValidTicketType) {
            return false;
        }

        return $this->repository->updateTicketQuantity($userId, $ticketId, $eventType, $ticketType, $quantity);
    }

    function deleteTicket($userId, $ticketId, $eventType) {
        return $this->repository->deleteTicket($userId, $ticketId, $eventType);
    }

    function setActiveStatus($userId, $ticketId, $eventType, $status) {
        return $this->repository->setActiveStatus($userId, $ticketId, $eventType, $status);
    }

    function setPurchasedStatus($userId, $events, $status) {
        foreach ($events as $event) {
            $ticketId = $event['ticketId'];
            $eventType = $event['eventType'];
            $this->repository->setPurchasedStatus($userId, $ticketId, $eventType, $status);
        }
    }
}
