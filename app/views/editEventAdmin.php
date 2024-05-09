<div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editEventForm">
                    <input type="hidden" id="editEventId" name="editEventId">
                    <div class="form-group">
                        <label for="editDateTime">Date & Time:</label>
                        <input type="datetime-local" class="form-control" id="editDateTime" name="editDateTime"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="editVenueName">Venue Name:</label>
                        <select id="editVenueName" class="form-control" name="editVenueName" required>
                            <?php foreach ($venueNames as $venueName): ?>
                                <option value="<?php echo $venueName['venueName']; ?>">
                                    <?php echo $venueName['venueName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="editSession">Session:</label>
                        <select id="editSession" class="form-control" name="editSession" required>
                            <option value="Back2Back">Back2Back</option>
                            <option value="Club">Club</option>
                            <option value="Tietso world">Tietso world</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editDuration">Duration:</label>
                        <input type="text" class="form-control" id="editDuration" name="editDuration" required>
                    </div>
                    <div class="form-group">
                        <label for="editTicketsAvailable">Available Tickets:</label>
                        <input type="text" class="form-control" id="editTicketsAvailable" name="editTicketsAvailable"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="editPrice">Price:</label>
                        <input type="text" class="form-control" id="editPrice" name="editPrice" required>
                    </div>
                    <div class="form-group">
                        <label for="editAllDaysAccessPrice">All Days Access Price:</label>
                        <input type="text" class="form-control" id="editAllDaysAccessPrice"
                            name="editAllDaysAccessPrice" required>
                    </div>
                    <div class="form-group">
                        <label for="editOneDayAccessPrice">One Day Access Price:</label>
                        <input type="text" class="form-control" id="editOneDayAccessPrice" name="editOneDayAccessPrice"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="editDate">Date:</label>
                        <input type="date" class="form-control" id="editDate" name="editDate" required>
                    </div>
                    <div class="form-group">
                        <label for="editTime">Time:</label>
                        <input type="time" class="form-control" id="editTime" name="editTime" required>
                    </div>
                    <div class="form-group">
                        <label for="editImage">Upload Image:</label>
                        <input type="file" class="form-control-file" id="editImage" name="editImage" accept="image/*"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>