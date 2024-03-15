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

    <?php
    include __DIR__ . '/header.php';
    ?>
    <img class="headPic" src="/img/nicky.png" alt="nicky">
    <div class="orange">Nicky Romero</div>
    <h1 class="nickyHead">Dance Experience with Nicky Romero! </h1>
    <p class="artCultureHeadP"> Embark on an exhilarating musical journey with Nicky Romero's chart-topping hits, where infectious beats and electrifying melodies converge to create an unforgettable experience—immerse yourself in the pulsating world of his popular tracks and let the music transport you.</p> 
    <h1 class="nickyTopHead">Top tracks of Nicky</h1>

    <div class="topSongContainer">
        <div class="eventH">Toulouse</div>
        <div class="content">
            <img src="img/Toulouse.png" alt="Image">
        </div>
    </div>

    <div class="topSongContainer">
        <div class="eventH">Symphonica</div>
        <div class="content">
            <img src="img/symphonica.png" alt="Image">
        </div>
    </div>
    <h1 class="nickyTopHead"> Nicky’s schedule in festival</h1>
    <div class="scheduleContainer">
    <?php foreach ($artistTickets as $t): ?>
        <div class="eventH"> 
            <?php 
                $timestamp = strtotime($t['date']);
                $weekDay = date('l', $timestamp); // Full textual representation of the day of the week
                $month = date('F', $timestamp); // Full textual representation of the month
                $dayNumber = date('j', $timestamp); // Day of the month without leading zeros
                echo $weekDay . ', ' . $month . ' ' . $dayNumber;
            ?>
        </div>
      
        <div class="eventContainer">

             <div class="eventDetailContainer">
                <p class="eventDetail"> Time: <?php echo date('H:i', strtotime($t['time'])); ?></p>
                <p class="eventDetail"> Venue: <?php echo $t['venueName']; ?></p>
                <p class="eventDetail"> Price: €<?php echo number_format($t['price'], 0, '.', ''); ?></p> <!-- Format price without decimals -->
                <p class="eventDetail">All-Access pass for this day €<?php echo number_format($t['oneDayAccessPrice'], 0, '.', ''); ?></p> <!-- Format price without decimals -->
                <p class="eventDetail"><?php echo $t['session']; ?> session</p>
                <a class="eventLocation" href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($t['venueName']); ?>" target="_blank">📍location</a>

             </div>
             <button class="btn btn-primary add-to-cart add-to-cartNicky" type="button"  data-ticket-id="<?php echo $t['eventId']; ?>">Add to program</button>

        </div>
        <?php endforeach; ?>

        <div class="scheduleDP">
            <p class="scheduleP">All-Access pass for Friday, Saturday and Sun  €250,00</p>
            <p class="scheduleP">Going for the deal? Select all tickets for the day, and an automatic discount will be applied.</p>
        </div>
    </div>
    <h1 class="nickyTopHead"> Career Highlights</h1>
    <div class="topSongContainer">
        <div class="content">
            <img class="highlightsImg" src="img/nickyHighlights.png" alt="Image">
            <p class="highlightsP">Protocol Recordings Founder: Nicky Romero established Protocol Recordings, a renowned EDM label, demonstrating his commitment to fostering emerging talent. A-List Collaborations:  Romero has partnered with music giants like Rihanna, David Guetta, and Calvin Harris, solidifying his position as a sought-after producer.Top-charting Singles: With hits like "Toulouse," "I Could Be the One" (with Avicii), and "Legacy" (with Krewella), Romero consistently delivers chart-topping singles that resonate globally.
            </p>
        </div>
    </div>
    <?php
    include __DIR__ . '/footer.php';
    ?>  
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="/javascript/script.js"></script>
</body>

</html>