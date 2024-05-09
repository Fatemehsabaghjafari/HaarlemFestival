<!-- Slideshow Container -->
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php $isFirst = true; ?>
        <?php foreach ($danceArtists as $artist): ?>
            <div class="carousel-item <?php echo $isFirst ? 'active' : ''; ?>">
                <div class="carousel-caption d-md-block">
                    <h5 class="djName">
                        <?php echo $artist['artistName']; ?> (
                        <?php echo $artist['style']; ?>)
                    </h5>
                    <div class="c">
                        <img class="djImg" src="<?php echo $artist['img']; ?>" alt="Image">
                        <table class="table t">
                            <thead class=tH>
                                <tr class="tHRow">
                                    <th class="tHData">Date</th>
                                    <th class="tHData">Time</th>
                                    <th class="tHData">Venue</th>
                                    <th class="tHData">Price</th>
                                    <th class="tHData">Add to Program</th> <!-- Single button here -->
                                </tr>
                            </thead>
                            <tbody class="tB">
                                <?php foreach ($ticketsByArtist[$artist['artistId']] as $ticket): ?>
                                    <tr class="tBData">
                                        <td class="tBData">
                                            <?php
                                            $timestamp = strtotime($ticket['date']);
                                            $weekDay = date('l', $timestamp); // Full textual representation of the day of the week
                                            $month = date('F', $timestamp); // Full textual representation of the month
                                            $dayNumber = date('j', $timestamp); // Day of the month without leading zeros
                                            echo $weekDay . ', ' . $month . ' ' . $dayNumber;
                                            ?>
                                        </td>
                                        <td class="tBData">
                                            <?php
                                            $time = date('H:i', strtotime($ticket['time'])); // Format time as 'hour:minute'
                                            echo $time;
                                            ?>
                                        </td>
                                        <td><a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($ticket['venueName']); ?>"
                                                target="_blank">
                                                <?php echo $ticket['venueName']; ?>
                                            </a></td>
                                        <td class="tBData">
                                            €
                                            <?php echo number_format($ticket['price'], 0, '.', ''); ?>
                                        </td>
                                        <td class="tBData">
                                            <button class="btn btn-primary open-modal" type="button"
                                                data-ticket-id="<?php echo $ticket['eventId']; ?>">Add to
                                                program
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php $isFirst = false; ?>
        <?php endforeach; ?>
    </div>

    <!-- Carousel controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add to Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <button class="btn btn-primary add-to-cart" type="button"
                    data-ticket-id="<?php echo $ticket['eventId']; ?>">Add event</button>
                <button class="btn btn-primary add-oneDay-to-cart" type="button"
                    data-ticket-id="<?php echo $ticket['eventId']; ?>">Day access</button>
                <button class="btn btn-primary add-allDays-to-cart" type="button"
                    data-ticket-id="<?php echo $ticket['eventId']; ?>">All access</button>

            </div>
        </div>
    </div>
</div>