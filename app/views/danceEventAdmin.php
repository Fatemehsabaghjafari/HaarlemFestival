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
    <div class="container mt-5">
        <h2>Add New Event</h2>
        <!-- Form for adding new music event -->
        <form id="addEventForm">
            <div class="form-group">
                <label for="dateTime">Date & Time:</label>
                <input type="datetime-local" class="form-control" id="dateTime" name="dateTime" required>
            </div>
            <div class="form-group">
                <label for="venueId">Venue ID:</label>
                <input type="text" class="form-control" id="venueId" name="venueId" required>
            </div>
            <div class="form-group">
                <label for="session">Session:</label>
                <input type="text" class="form-control" id="session" name="session" required>
            </div>
            <div class="form-group">
                <label for="duration">Duration:</label>
                <input type="text" class="form-control" id="duration" name="duration" required>
            </div>
            <div class="form-group">
                <label for="ticketsAvailable">Available Tickets:</label>
                <input type="text" class="form-control" id="ticketsAvailable" name="ticketsAvailable" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="allDaysAsccessPrice">All Days Access Price:</label>
                <input type="text" class="form-control" id="allDaysAccessPrice" name="allDaysAccessPrice" required>
            </div>
            <div class="form-group">
                <label for="oneDayAccessPrice">One Day Access Price:</label>
                <input type="text" class="form-control" id="oneDayAccessPrice" name="oneDayAccessPrice" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>
            <div class="form-group uploadImg">
                <label for="image">Upload Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="img/*" required>
            </div>
            <button type="submit" class="btn btn-primary addArtist">Add Event</button>
        </form>

        <hr>
        <h2>All Events</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date & Time</th>
                    <th>Venue ID</th>
                    <th>Session ID</th>
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
                        <td>
                            <?php echo $event['eventId']; ?>
                        </td>
                        <td>
                            <?php echo $event['dateTime']; ?>
                        </td>
                        <td>
                            <?php echo $event['venueId']; ?>
                        </td>
                        <td>
                            <?php echo $event['session']; ?>
                        </td>
                        <td>
                            <?php echo $event['duration']; ?>
                        </td>
                        <td>
                            <?php echo $event['ticketsAvailable']; ?>
                        </td>
                        <td>
                            <?php echo $event['price']; ?>
                        </td>
                        <td>
                            <?php echo $event['allDaysAccessPrice']; ?>
                        </td>
                        <td>
                            <?php echo $event['oneDayAccessPrice']; ?>
                        </td>
                        <td>
                            <?php echo $event['date']; ?>
                        </td>
                        <td>
                            <?php echo $event['time']; ?>
                        </td>
                        <td>
                            <img class="djImg" src="<?php echo $event['image']; ?>" alt="Image">
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm mr-2 delete-event"
                                data-event-id="<?php echo $event['eventId']; ?>">Delete
                            </button>

                            <button class="btn btn-primary btn-sm edit-event"
                                data-event-id="<?php echo $event['eventId']; ?>"
                                data-date-time="<?php echo $event['dateTime']; ?>"
                                data-venue-id="<?php echo $event['venueId']; ?>"
                                data-session-id="<?php echo $event['session']; ?>"
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

        <div id="editEventModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="editEventForm">
                    <input type="hidden" id="editEventId" name="editEventId">
                    <label for="editDateTime">Date & Time:</label>
                    <input type="datetime-local" id="editDateTime" name="editDateTime" required>
                    <label for="editVenueId">Venue ID:</label>
                    <input type="text" id="editVenueId" name="editVenueId" required>
                    <label for="editSession">Session:</label>
                    <input type="text" id="editSession" name="editSession" required>
                    <label for="editDuration">Duration:</label>
                    <input type="text" id="editDuration" name="editDuration" required>
                    <label for="editTicketsAvailable">Available Tickets:</label>
                    <input type="text" id="editTicketsAvailable" name="editTicketsAvailable" required>
                    <label for="editPrice">Price:</label>
                    <input type="text" id="editPrice" name="editPrice" required>
                    <label for="editAllDaysAccessPrice">All Days Access Price:</label>
                    <input type="text" id="editAllDaysAccessPrice" name="editAllDaysAccessPrice" required>
                    <label for="editOneDayAccessPrice">One Day Access Price:</label>
                    <input type="text" id="editOneDayAccessPrice" name="editOneDayAccessPrice" required>
                    <label for="editDate">Date:</label>
                    <input type="date" id="editDate" name="editDate" required>
                    <label for="editTime">Time:</label>
                    <input type="time" id="editTime" name="editTime" required>
                    <label for="editImage">Upload Image:</label>
                    <input type="file" class="form-control-file" id="editimage" name="editimage" accept="img/*"
                        required>
                    <button type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="/javascript/adminDanceEvent.js"></script>
</body>

</html>