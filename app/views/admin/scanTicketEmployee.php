<?php
    $stylesheets = [
        'css/home.css',
        'css/scanTicket.css'
    ];
    $title = 'Scan Ticket';
    include __DIR__ . '/../adminHeader.php';

?>
<main>
    <h1>Scan Ticket</h1>
    <div class="scan-ticket centered-container">
        <div class="qr-scanner">
            <form id="qr-form" method="POST" action="/scan">
                <input type="hidden" id="qrCodeInput" name="qrCode" value="">
            </form>
            <div id="reader"></div>
            <div class="spinner-border text-success" id="loading" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</main>

<?php
    $scripts = [
        ['src' => '/javascript/html5-qrcode.js'],
        ['src' => '/javascript/scanTicket.js']
    ];
    include __DIR__ . '/footer.php';
?>