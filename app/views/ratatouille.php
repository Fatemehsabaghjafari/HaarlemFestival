<?php
    $stylesheets = [
        'css/ratatouille.css',
    ];
    $title = 'Toujours';
    include __DIR__ . '/header.php';
?>

<div class="container">
    <img src="/img/Ratatouille food & wine.png" class="main_img" alt="">
</div>
<div class="container">
    <div>
        <i class="fa-sharp fa-solid fa-star" style="color: #FFD43B;"></i>
        <i class="fa-sharp fa-solid fa-star" style="color: #FFD43B;"></i>
        <i class="fa-sharp fa-solid fa-star" style="color: #FFD43B;"></i>
        <i class="fa-sharp fa-solid fa-star" style="color: #FFD43B;"></i>
        <i><img src="/img/pet-friendly.jpg" class="logo" alt=""></i>
        <i><img src="/img/halal-logo.jpg" class="logo" alt=""></i>
        <i><img src="/img/vegan.jpg" class="logo" alt=""></i>
        <i><img src="/img/disabled-access.jpg" class="logo" alt=""></i>
        
    </div>
</div>
<div class="container text_center">
    <p>
    Ratatouille Food & Wine in Haarlem, Netherlands, offers a unique dining experience with modern French cuisine. 
    Known for creative dishes and an extensive wine list, the restaurant has a warm, stylish atmosphere. 
    The menu features popular items like ratatouille, beef bourguignon, and crème brûlée, complemented by a diverse selection of French and international wines. 
    Open for lunch and dinner, reservations are recommended for a delightful dining experience.
    </p>
</div>
<div class="container">
    <img src="/img/image 22.png" class="img_extrapage" alt="">
    <img src="/img/image 23.png" class="img_extrapage" alt="">
</div>
<div class="container">
    <div class="text_T">
        <p>
        Experience stylish dining at Ratatouille, where our elegant space accommodates 52 guests. 
        Indulge in our signature dishes that seamlessly combine the finesse of French cuisine with the freshness of seafood, all enhanced with a European twist.

        Price Range
        Savor our exquisite offerings, with prices beginning at €45. 
        Younger guests under 12 can delight in the same experience at a reduced rate of €22.50.
        Discover the perfect fusion of flavor and value at Ratatouille.</p>
    </div>
</div>

<div class="container-fuild ">
    <div class="text_contact">
        <p>CONTACT INFORMATION</p>
        <p>Phone Number: <?php echo $Restaurant->phoneNumber; ?></p>   
        <p>E-mail: <?php echo $Restaurant->email; ?></p>
        <p>Address: <?php echo $Restaurant->address; ?></p> 
        <p>Festival opening Hours: <?php 
            echo date('H:i', strtotime($Restaurant->firstSession)); ?>
        </p> 
    </div>
</div>

<div class="container text-center">
    <button type="button" class="btn btn-primary mb-4">Book A Table</button>
    <div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2435.543775498968!2d4.634927276183602!3d52.37869204668252!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5ef6bd9e573fb%3A0x8c3546c16902f0f2!2sRatatouille%20Food%20%26%20Wine!5e0!3m2!1sen!2snl!4v1709894678969!5m2!1sen!2snl" width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <button type="button" class="btn btn-primary mb-4">Back to Prevoius Page</button>
</div>

<?php
    include __DIR__ . '/footer.php';
?>