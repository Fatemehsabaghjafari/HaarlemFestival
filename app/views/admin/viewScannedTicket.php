<?php
$stylesheets = [
    'css/home.css',
    'css/scanTicket.css'
];
$title = 'View Ticket';
include __DIR__ . '/../adminHeader.php';

?>
    <main>
        <div class="scan-ticket centered-container">
            <div class="ticket">
                <h1>Ticket Details</h1>

                <div class="ticket-details">
                    <?php if ($order['isScanned']): ?>
                        <div class="alert alert-warning" role="alert">
                            <strong>Warning!</strong> This ticket has already been scanned.
                        </div>
                    <?php endif; ?>
                    <div>Name: <?php echo $user["firstName"] . " " . $user["lastName"]; ?></div>
                    <?php if ($order['eventType'] == "music"): ?>
                        <div>Event: <?php echo $ticket->venueName ?></div>
                        <div>Artists: <?php echo $ticket->artists ?></div>
                        <div>Venue: <?php echo $ticket->venueName ?></div>

                        <?php if ($ticket->allDaysAccessTicketQuantity > 0): ?>
                            <div>All Days Access Ticket Quantity: <?php echo $ticket->allDaysAccessTicketQuantity ?></div>
                        <?php elseif ($ticket->oneDayAccessTicketQuantity > 0): ?>
                            <div>One Day Ticket Quantity: <?php echo $ticket->oneDayAccessTicketQuantity ?></div>
                        <?php else: ?>
                            <div>Quantity: <?php echo $ticket->quantity ?></div>
                        <?php endif; ?>

                    <?php endif; ?>

                    <div>Date & Time <?php echo $ticket->dateTime; ?></div>
                </div>
                <a href="/scan" class="button">Scan Another Ticket</a>

            </div>
        </div>
    </main>



<?php
    include __DIR__ . '/footer.php';
?>