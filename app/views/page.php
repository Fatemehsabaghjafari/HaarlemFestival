<?php
    /**
     * @var Page $page
     */
    $stylesheets = [
        '/css/dance.css',
        '/css/home.css',
    ];

    $title = $page->getTitle();
    include __DIR__ . '/header.php';
?>

<main>
    <div class="centered-container">
        <?php echo $page->getBody(); ?>
    </div>
</main>

<?php
    include __DIR__ . '/footer.php';
?>