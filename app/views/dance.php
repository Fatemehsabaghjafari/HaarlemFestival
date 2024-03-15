<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Haarlem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dance.css">
    <link rel="stylesheet" href="/css/home.css">
  
</head>

<body>
  <div>
    <?php
    include __DIR__ . '/header.php';
    ?>
    <img class="headPic" src="/img/dance.png" alt="Museum">

    <h1 class="danceHead">Harmony in Motion </h1>

    <p class="danceHeadP"> 
        Celebrating the Rhythm of Dance at Unleashed Beats Festival
    </p>
    
    <p class="danceHeadP"> 
    Get ready to groove to the hottest tunes spun by top DJs at our dance festival, a night of
    non-stop beats and unforgettable vibes!
    </p>

    <div class="top-djs">

     <div class="djHead" >Our DJs</div>

     <div class="navigation-cards">
         <div class="dj">Nicky Romero</div>
         <div class="dj">Martin Garrix</div>
         <div class="dj">Hardwell</div>
    </div>

     <div class="navigation-cards">
      <a href="/nicky">
        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/d1.png');">

        </div>
      </a>
     </div>

        <div class="navigation-card-container">
        <a href="/martin">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/d2.jpg');">

            </div>
        </a>
        </div>

        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/d3.jpg');">

            </div>
        </div>
        <div class="navigation-cards">
        <div class="dj" >Tiëtso</div>
        <div class="dj" >Armin van Buuren</div>
        <div class="dj" >Afrojack</div>
        </div>

        <div class="navigation-cards">
        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/d4.jpg');">

            </div>
        </div>

        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/d5.jpg');">

            </div>
        </div>

        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/d6.jpg');">

            </div>
        </div>
    </div>
    
   
    </div>

    </div>


    <h1 class="danceHeadT">Tickets overview </h1>

<!-- Slideshow Container -->
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php $isFirst = true; ?>
        <?php foreach ($danceArtists as $artist): ?>
            <div class="carousel-item <?php echo $isFirst ? 'active' : ''; ?>">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="djName"><?php echo $artist['artistName']; ?> (<?php echo $artist['style']; ?>)</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <img class="djImg" src="<?php echo $artist['img']; ?>" alt="Image">
                        </div>
                        <div class="col-md-6">
                            <table class="table t">
                                <thead class=tH>
                                    <tr class="tHRow">
                                        <th class="tHData">Date</th>
                                        <th class="tHData">Time</th>
                                        <th class="tHData">Venue</th>
                                        <th class="tHData">Price</th>
                                        <th>     </th>
                                    </tr>
                                </thead>
                                <tbody class="tB">
                                <?php foreach ($ticketsByArtist[$artist['artistId']] as $ticket): ?>

                                    <tr>
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
                                        <td><a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($ticket['venueName']); ?>" target="_blank"><?php echo $ticket['venueName']; ?></a></td>

                                        <td class="tBData">
                                            €<?php echo number_format($ticket['price'], 0, '.', ''); ?>
                                        </td>
                                        <td class="tBData"> <button class="btn btn-primary add-to-cart" type="button" data-ticket-id="<?php echo $ticket['eventId']; ?>">Add to program</button></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php $isFirst = false; ?>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="allAccessInfo1">
All-Access pass for Friday €125,00,  Saturday or Sunday €150,00

</div>
<div class="allAccessInfo2">

All-Access pass for Friday, Saturday and Sunday €250,00

</div>
<div class="allAccessInfo3">

Going for the deal? Select all tickets for the day, and an automatic discount will be applied.
</div>

<h1 class="danceHeadT">Venues overview </h1>
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
        <td><a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($ticket['venueName']); ?>" target="_blank"><?php echo $ticket['venueName']; ?></a></td>
        <td>
    <?php foreach ($ticketsByVenueAndDate[$venue['venueId']]['26 July'] as $ticket): ?>
        <!-- Display ticket information -->
        <p>Artists: <?php echo $ticket['artistNames']; ?></p>
       Time: <?php echo date('H:i', strtotime($ticket['time'])); ?> <!-- Format time without seconds -->
       <p>Price: €<?php echo number_format($ticket['price'], 0, '.', ''); ?> <!-- Format price without decimals --></p>
       <button class="btn btn-primary add-to-cart" type="button" data-ticket-id="<?php echo $ticket['eventId']; ?>" data-ticket="">Add to program</button>
    <?php endforeach; ?>
</td>
<td>
    <?php foreach ($ticketsByVenueAndDate[$venue['venueId']]['27 July'] as $ticket): ?>
        <!-- Display ticket information -->
        <p>Artists: <?php echo $ticket['artistNames']; ?></p>
       Time: <?php echo date('H:i', strtotime($ticket['time'])); ?> <!-- Format time without seconds -->
       <p>Price: €<?php echo number_format($ticket['price'], 0, '.', ''); ?>
        <button class="btn btn-primary add-to-cart" type="button" data-ticket-id="<?php echo $ticket['eventId']; ?>" data-ticket="">Add to program</button>
    <?php endforeach; ?>
</td>
<td>
    <?php foreach ($ticketsByVenueAndDate[$venue['venueId']]['28 July'] as $ticket): ?>
        <!-- Display ticket information -->
        <p>Artists: <?php echo $ticket['artistNames']; ?></p>
       Time: <?php echo date('H:i', strtotime($ticket['time'])); ?> <!-- Format time without seconds -->
       <p>Price: €<?php echo number_format($ticket['price'], 0, '.', ''); ?>
        <button class="btn btn-primary add-to-cart" type="button" data-ticket-id="<?php echo $ticket['eventId']; ?>" data-ticket="">Add to program</button>
    <?php endforeach; ?>
</td>

    </tr>
<?php endforeach; ?>
                           
        </tbody>
    </table>
</div>

    <h1 class="danceHeadT">Other festivals to enjoy </h1>
    <div class="navigation-cards">
        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/art_culture_card.png');">
                <h3>HAARLEM JAZZE</h3>
            </div>
        </div>

        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/foodies_card.png');">
                <h3>YUMMI!</h3>
            </div>
        </div>
        
        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/history_card.png');">
                <h3>A STROLL THROUGH HISTORY</h3>
            </div>
        </div>

      <!--  <div class="kid">
            <img src="img/kid.png" alt="Image">
        </div> -->



        
    <?php
    include __DIR__ . '/footer.php';
    ?>  
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="/javascript/script.js"></script>
</body>

</html>


