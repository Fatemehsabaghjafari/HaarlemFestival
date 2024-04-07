<div class="venue">

    <table class="table venueTable">
        <thead class=tH>
            <tr>
                <th>Venues</th>
                <th>26 July, Friday</th>
                <th>27 July, Saturday</th>
                <th>28 July, Sunday</th>
            </tr>
        </thead>
        <tbody class="tB">
            <?php foreach ($danceVenues as $venue): ?>
                <tr>
                    <td><a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($ticket['venueName']); ?>"
                            target="_blank">
                            <?php echo $ticket['venueName']; ?>
                        </a></td>
                    <td>
                        <?php foreach ($ticketsByVenueAndDate[$venue['venueId']]['26 July'] as $ticket): ?>
                            <!-- Display ticket information -->
                          <!--  <button class="btn btn-primary add-oneDay-to-cart" type="button"
                                data-ticket-id="<?php echo $ticket['eventId']; ?>">one day</button>
                            <button class="btn btn-primary add-allDays-to-cart" type="button"
                                data-ticket-id="<?php echo $ticket['eventId']; ?>">All days</button> -->
                            <p>Artists:
                                <?php echo $ticket['artistNames']; ?>
                            </p>
                            Time:
                            <?php echo date('H:i', strtotime($ticket['time'])); ?> <!-- Format time without seconds -->
                            <p>Price: €
                                <?php echo number_format($ticket['price'], 0, '.', ''); ?>
                                <!-- Format price without decimals -->
                            </p>
                            <button class="btn btn-primary add-to-cart" type="button"
                                data-ticket-id="<?php echo $ticket['eventId']; ?>" data-ticket="">Add to program</button>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php foreach ($ticketsByVenueAndDate[$venue['venueId']]['27 July'] as $ticket): ?>
                            <!-- Display ticket information -->
                          <!--  <button class="btn btn-primary add-oneDay-to-cart" type="button"
                                data-ticket-id="<?php echo $ticket['eventId']; ?>">one day</button>
                            <button class="btn btn-primary add-allDays-to-cart" type="button"
                                data-ticket-id="<?php echo $ticket['eventId']; ?>">All days</button> -->
                            <p>Artists:
                                <?php echo $ticket['artistNames']; ?>
                            </p>
                            Time:
                            <?php echo date('H:i', strtotime($ticket['time'])); ?> <!-- Format time without seconds -->
                            <p>Price: €
                                <?php echo number_format($ticket['price'], 0, '.', ''); ?>
                                <button class="btn btn-primary add-to-cart" type="button"
                                    data-ticket-id="<?php echo $ticket['eventId']; ?>" data-ticket="">Add to
                                    program</button>
                            <?php endforeach; ?>
                    </td>
                    <td>
                        <?php foreach ($ticketsByVenueAndDate[$venue['venueId']]['28 July'] as $ticket): ?>
                            <!-- Display ticket information -->
                           <!-- <button class="btn btn-primary add-oneDay-to-cart" type="button"
                                data-ticket-id="<?php echo $ticket['eventId']; ?>">one day</button>
                            <button class="btn btn-primary add-allDays-to-cart" type="button"
                                data-ticket-id="<?php echo $ticket['eventId']; ?>">All days</button> -->
                            <p>Artists:
                                <?php echo $ticket['artistNames']; ?>
                            </p>
                            Time:
                            <?php echo date('H:i', strtotime($ticket['time'])); ?> <!-- Format time without seconds -->
                            <p>Price: €
                                <?php echo number_format($ticket['price'], 0, '.', ''); ?>
                                <button class="btn btn-primary add-to-cart" type="button"
                                    data-ticket-id="<?php echo $ticket['eventId']; ?>" data-ticket="">Add to
                                    program</button>
                            <?php endforeach; ?>
                    </td>

                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>