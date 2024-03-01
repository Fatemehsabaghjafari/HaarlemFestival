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
  
</head>

<body>

    <?php
    include __DIR__ . '/header.php';
    ?>
    
    <img class="headPic" src="/img/Museum.png" alt="Museum">
    
    <h1 class="artCultureHead"> The artistic soul of Haarlem </h1>
    <p class="artCultureHeadP"> Haarlem is a paradise for art lovers, with a wide range of museums, galleries and cultural events.
        Immerse yourself in the city's artistic offerings and witness the interplay between tradition and
        innovation. Arts and culture in Haarlem truly embrace and celebrate the spirit of creativity. Here is a
        glimpse of what this enchanting city has to offer.
    </p>
    <div class="container">
        <video controls style="width: 100%; height: 100%;">
            <source src="/video/ArtCulture.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    &nbsp;&nbsp;&nbsp;
    <div class="container">
        <div class="card mb-12 card_Frans" style="max-width: 1400px;">
            <div class="row g-0">
                <div class="col-md-8">
                    <img src="/img/Frans.png" class="img-fluid rounded-start Frans" alt="FransMuseum">
                </div>
                <div class="col-md-4">
                    <div class="card-body">
                        <h5 class="card-title Frans">Frans Hals Museum</h5>
                        <p class="card-text">The Frans Hals Museum in Haarlem, Netherlands, is a renowned art museum dedicated to the works of the Dutch Golden Age painter Frans Hals. <br /><br /><br />
                            It houses an impressive collection of Hals' masterpieces, showcasing his innovative and lively approach to portraiture, providing visitors with a captivating insight into 17th-century Dutch art.
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    &nbsp;&nbsp;&nbsp;
    <div class="container">
        <div class="card-group">
            <div class="card border-light">
                <img src="/img/Museum of the mind.png" class="card-img-top" alt="Museum of the mind">
                <div class="card-body">
                <h5 class="card-title">Museum of the mind</h5>
                </div>
            </div>
            &nbsp;&nbsp;&nbsp;
            <div class="card border-light">
                <img src="/img/Teylers Museum.png" class="card-img-top" alt="Teylers Museum">
                <div class="card-body">
                <h5 class="card-title">Teylers Museum</h5>
                </div>
            </div>
            &nbsp;&nbsp;&nbsp;
            <div class="card border-light">
                <img src="/img/Archaeological Museum.png" class="card-img-top" alt="Archaeological Museum">
                <div class="card-body">
                <h5 class="card-title">Archaeological Museum</h5>
                </div>
            </div>
        </div>
    </div>
    &nbsp;&nbsp;&nbsp;
    <div class="container">
        <div class="card">
        <div class="card-body">
            <h1 class="card-title">Exploring the Cultural Tapestry of Haarlem </h1>
            <h5>Music, Theater, Cinema, and Concert Halls</h5>
            <p class="card-text">Nestled in the heart of the Netherlands, Haarlem boasts a vibrant cultural scene enriched by its diverse array of music venues, theaters, cinemas, and concert halls.
                From the historic splendor of its concert halls hosting classical performances to the cutting-edge ambiance of its cinemas showcasing the latest films, Haarlem offers a dynamic tapestry of artistic experiences for locals and visitors alike.</p>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="/img/slide1.png" class="d-block w-100" alt="slide">
            </div>
            <div class="carousel-item">
            <img src="/img/slide2.png" class="d-block w-100" alt="slide">
            </div>
            <div class="carousel-item">
            <img src="/img/slide3.png" class="d-block w-100" alt="slide">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
        </div>
    </div>

    &nbsp;&nbsp;&nbsp;

    <div class="container">
        <div class="card-group">
            <div class="card">
                <img src="/img/round1.png" class="card-img-top round" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Draaiorgel museum</h5>
                </div>
            </div>
            <div class="card">
                <img src="/img/round2.png" class="card-img-top round" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Galerie art yard</h5>
                </div>
            </div>
            <div class="card">
                <img src="/img/round3.png" class="round card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Film Dome</h5>
                </div>
            </div>
        </div>
    </div>
    &nbsp;&nbsp;&nbsp;
    <div class="container">
        <div class="card mb-12 card_Frans" style="max-width: 1400px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <div class="card-body">
                        <h5 class="card-title Frans">Ruin Of Brederode</h5>
                        <p class="card-text">The Ruin of Brederode, a medieval castle
                            near Haarlem, Netherlands, dates back to 
                            the 13th century and reflects the historical significance of the Brederode family.
                            <br /> <br /><br />
                            This castle serves as a tangible connection
                            to the rich history and architectural heritage 
                            shared with Haarlem, offering insights into the region's medieval past and the influence of 
                            noble families like the Brederodes on the area's development.
                        </p>
                    </div>
                </div>
                <div class="col-md-8">
                    <img src="/img/Ruin Of Brederode.png" class="img-fluid  Frans" alt="uin Of Brederode">
                </div>
            </div>
        </div>
    </div>     
      
    <?php
    include __DIR__ . '/footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

