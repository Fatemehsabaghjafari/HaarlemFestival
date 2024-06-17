<?php
    $stylesheets = [
        'css/yummy_style.css',
    ];
    $title = 'Toujours - Yummy';
    include __DIR__ . '/ratatouille.php';
?>

<div class="container">
    <img src="/img/Toujours.png" class="main_img" alt="">
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
        Toujours Restaurant offers a unique blend of culinary innovation and cozy ambiance. 
        Known for its commitment to sustainability, the restaurant prides itself on sourcing locally produced, 
        organic ingredients, ensuring a fresh and environmentally conscious dining experience. 
        The interior reflects a modern and chic design, with an artistic flair that adds a touch of sophistication to the atmosphere.
    </p>
</div>
<div class="container">
    <img src="/img/image 18.png" class="img_extrapage" alt="">
    <img src="/img/image 20.png" class="img_extrapage" alt="">
</div>
<div class="container">
    <h2>Exquisite Culinary Fusion: Toujours' Diverse Menu</h2>
    <div class="text_T">
        <p>
            Toujours boasts a diverse menu that caters to various palates, featuring both Dutch specialties and globally inspired dishes. The chef's creative twists on traditional favorites and the ever-evolving seasonal menu keep patrons coming back for new and exciting flavor combinations. The wine list is curated to complement the menu, offering a selection of both local and international vintages.
        </p>
    </div>

</div>

<div class="container-fuild">
    <div class="text_contact">
        <p>CONTACT INFORMATION</p>
        <p>Phone Number: <?php echo $Restaurants->phoneNumber; ?></p>   
        <p>E-mail: <?php echo $Restaurants->email; ?></p>
        <p>Address: <?php echo $Restaurants->address; ?></p> 
        <p>Festival opening Hours: <?php 
            echo date('H:i', strtotime($Restaurants->firstSession)); ?>
        </p> 
    </div>
</div>


<div class="container text-center">
    <div>
        <button type="button" class="btn btn-primary mb-4">Book A Table</button>
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2435.4344941536597!2d4.634479976183698!3d52.38067334653618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5ef6bc6d98bef%3A0x8774b1a9247d531d!2sToujours!5e0!3m2!1sen!2snl!4v1709688504132!5m2!1sen!2snl" width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <button type="button" class="btn btn-primary mb-4">Back to Previous Page</button>
    </div>
</div>


<?php
    include __DIR__ . '/footer.php';
?>