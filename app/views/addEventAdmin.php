<h2 class="addEvent">Add New Event</h2>
<!-- Form for adding new music event -->
<form id="addEventForm">
    <div class="form-group">
        <label for="dateTime">Date & Time:</label>
        <input type="datetime-local" class="form-control" id="dateTime" name="dateTime" required>
    </div>

    <div class="form-group">
        <label for="venueName">Venue Name:</label>
        <select class="form-control" id="venueName" name="venueName" required>
            <?php foreach ($venueNames as $venueName): ?>
                <option value="<?php echo $venueName['venueName']; ?>"><?php echo $venueName['venueName']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="session">Session:</label>
        <select class="form-control" id="session" name="session" required>
            <option value="Back2Back">Back2Back</option>
            <option value="Club">Club</option>
            <option value="Tietso world">Tietso world</option>
        </select>
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
        <input type="text" class="form-control" id="price" name="price" required min="0.01" step="0.01">
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