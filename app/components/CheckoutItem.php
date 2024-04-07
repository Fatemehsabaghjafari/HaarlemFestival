<?php 
class CheckoutItem {
    public function render($date, $data) {
        $html = '';
        $type = $data['type'];

        if ($type === 'music') {
            $html = $this->renderMusic($date, $data);
        } else if ($type === 'yummy') {
            $html = $this->renderYummy($date, $data);
        } else if ($type === 'history') {
            $html = $this->renderHistory($date, $data);
        }

        return $html;
    }

    private function renderMusic($date, $data) {
        $ticketId = $data['ticketId'];
        $time = $data['time'];
        $artists = implode(', ', $data['artists']);
        $venueName = rtrim($data['venueName']);
        // $allDaysAccessTicketQuantity = $data['allDaysAccessTicketQuantity'];
        // $oneDayAccessTicketQuantity = $data['oneDayAccessTicketQuantity'];
        $quantity = $data['quantity'];
        $allDaysAccessPrice = $data['allDaysAccessPrice'];
        $oneDayAccessPrice = $data['oneDayAccessPrice'];
        $price = $data['price'];
        $totalPrice = ($quantity * $price);

        $html = "";

        if (!$data['isPurchased'] && $data['isActive']) {
            $html = 
            "
            <div class='event color-red' data-ticket-id='$ticketId' data-event-type='music' data-single-quantity='$quantity' data-single-price='$price'>
                <div class='left'>
                    <div class='time'>$time</div>
                    <div class='name'>
                        $artists
                        ($venueName)
                    </div>
                </div>
                <div class='right'>
                    <div class='amount-selector' data-ticket-type='single'>
                        <div class='amount'><span class='ticket-amount'>$quantity</span> Ticket</div>
                    </div>
                    <div class='price'>€$totalPrice</div>
                    <i class='fa-solid fa-trash-can'></i>
                </div>
            </div>
            ";
        }

        return $html;
    }

    private function renderYummy($date, $data) {
        $ticketId = $data['ticketId'];
        $time = $data['time'];
        $name = $data['name'];
        $kidsQuantity = $data['kidsQuantity'];
        $adultsQuantity = $data['adultsQuantity'];
        $kidPrice = $data['kidPrice'];
        $adultPrice = $data['adultPrice'];
        $totalPrice = ($kidsQuantity * $kidPrice) + ($adultsQuantity * $adultPrice);

        $html = "";

        if (!$data['isPurchased'] && $data['isActive']) {
            $html = 
            "
            <div class='event color-green' data-ticket-id='$ticketId' data-event-type='yummy' data-adult-quantity='$adultsQuantity' data-adult-price='$adultPrice' data-kid-quantity='$kidsQuantity' data-kid-price='$kidPrice'>
                <div class='left'>
                    <div class='time'>$time</div>
                    <div class='name'>$name</div>
                </div>
                <div class='right'>
                    <div class='amount-selector' data-ticket-type='adult'>
                        <div class='amount'><span class='ticket-amount'>$adultsQuantity</span> Adults</div>
                    </div>
                    <div class='amount-selector' data-ticket-type='kid'>
                        <div class='amount'><span class='ticket-amount'>$kidsQuantity</span> Kids</div>
                    </div>
                    <div class='price'>€$totalPrice</div>
                    <i class='fa-solid fa-trash-can'></i>
                </div>
            </div>
            ";
        }
        
        return $html;
    }

    private function renderHistory($date, $data) {
        $ticketId = $data['ticketId'];
        $time = $data['time'];
        $startLocation = $data['startLocation'];
        $singleTicketQuantity = $data['singleTicketQuantity'];
        $familyTicketQuantity = $data['familyTicketQuantity'];
        $singlePrice = $data['singlePrice'];
        $familyPrice = $data['familyPrice'];
        $totalPrice = ($singleTicketQuantity * $singlePrice) + ($familyTicketQuantity * $familyPrice);

        $html = "";

        if (!$data['isPurchased'] && $data['isActive']) {
            $html = 
            "
            <div class='event color-blue' data-ticket-id='$ticketId' data-event-type='history' data-single-quantity='$singleTicketQuantity' data-single-price='$singlePrice' data-family-quantity='$familyTicketQuantity' data-family-price='$familyPrice'>
                <div class='left'>
                    <div class='time'>$time</div>
                    <div class='name'>$startLocation</div>
                </div>
                <div class='right'>
                    <div class='amount-selector' data-ticket-type='family'>
                        <div class='amount'><span class='ticket-amount'>$familyTicketQuantity</span> Family Ticket</div>
                    </div>
                    <div class='amount-selector' data-ticket-type='single'>
                        <div class='amount'><span class='ticket-amount'>$singleTicketQuantity</span> Regular Ticket</div>
                    </div>
                    <div class='price'>€$totalPrice</div>
                    <i class='fa-solid fa-trash-can'></i>
                </div>
            </div>
            ";
        }

        return $html;
    }
}