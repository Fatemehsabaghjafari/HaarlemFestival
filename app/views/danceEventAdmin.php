<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Haarlem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>

    <?php
    include __DIR__ . '/adminHeader.php';
    ?>

    <?php
    include __DIR__ . '/addEventAdmin.php';
    ?>


    <hr>
    <h2 class="addEvent">All Events</h2>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date & Time</th>
                    <th>Venue Name</th>
                    <th>Session</th>
                    <th>Duration</th>
                    <th>TicketsAvailable</th>
                    <th>Price</th>
                    <th>All Days Access Price</th>
                    <th>One Day Access Price</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP loop for displaying existing music events -->
                <?php foreach ($danceEvents as $event): ?>
                    <tr>
                        <td><?php echo $event['eventId']; ?></td>
                        <td><?php echo $event['dateTime']; ?></td>
                        <td><?php echo $event['venueName']; ?></td>
                        <td><?php echo $event['session']; ?></td>
                        <td><?php echo $event['duration']; ?></td>
                        <td><?php echo $event['ticketsAvailable']; ?></td>
                        <td><?php echo $event['price']; ?></td>
                        <td><?php echo $event['allDaysAccessPrice']; ?></td>
                        <td><?php echo $event['oneDayAccessPrice']; ?></td>
                        <td><?php echo $event['date']; ?></td>
                        <td><?php echo $event['time']; ?></td>
                        <td><img class="djImg" src="<?php echo $event['image']; ?>" alt="Image"></td>
                        <td>
                            <button class="btn btn-danger btn-sm mr-2 delete-event"
                                data-event-id="<?php echo $event['eventId']; ?>">Delete
                            </button>

                            <button class="btn btn-primary btn-sm edit-event"
                                data-event-id="<?php echo $event['eventId']; ?>"
                                data-date-time="<?php echo $event['dateTime']; ?>"
                                data-venue-name="<?php echo $event['venueName']; ?>"
                                data-session="<?php echo $event['session']; ?>"
                                data-duration="<?php echo $event['duration']; ?>"
                                data-tickets-Available="<?php echo $event['ticketsAvailable']; ?>"
                                data-price="<?php echo $event['price']; ?>"
                                data-access-price="<?php echo $event['allDaysAccessPrice']; ?>"
                                data-one-day-access-price="<?php echo $event['oneDayAccessPrice']; ?>"
                                data-date="<?php echo $event['date']; ?>" data-time="<?php echo $event['time']; ?>"
                                data-image="<?php echo $event['image']; ?>">Edit
                            </button>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>



    <?php
    include __DIR__ . '/editEventAdmin.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="/javascript/adminDanceEvent.js"></script>

</body>

</html>