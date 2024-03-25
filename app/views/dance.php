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

        <p class="danceHeadP">Celebrating the Rhythm of Dance at Unleashed Beats Festival</p>

        <p class="danceHeadP">
            Get ready to groove to the hottest tunes spun by top DJs at our dance festival, a night of
            non-stop beats and unforgettable vibes!
        </p>

        <div class="top-djs">

            <div class="djHead">Our DJs</div>


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

    <?php
    include __DIR__ . '/slideshow.php';
    ?>
    <div class="allAccessInfo1">
        All-Access pass for Friday €125,00, Saturday or Sunday €150,00

    </div>
    <div class="allAccessInfo2">

        All-Access pass for Friday, Saturday and Sunday €250,00

    </div>

    <h1 class="danceHeadT">Venues overview </h1>
    <?php
    include __DIR__ . '/danceVenue.php';
    ?>

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

       <!-- <?php
        include __DIR__ . '/footer.php';
        ?> -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
        <script src="/javascript/script.js"></script>
        <script src="/javascript/slideshow.js"></script>
</body>

</html>