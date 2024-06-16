<?php
    $stylesheets = [
        'css/personalProgram.css',
        'css/checkout.css',
    ];
    $title = 'Checkout';
    include __DIR__ . '/header.php';
    include '../components/CheckoutItem.php';
?>

<script>
    const personalProgram = <?php echo json_encode($personalProgram); ?>;
</script>

<?php if (!empty($personalProgram)): ?>
    <div class="checkout-container">
        <div class="order-items list-view">
            <?php foreach ($personalProgram as $date => $events): ?>
                <div class="days">
                    <div class="date"><?php echo date('d F l', strtotime($date)); ?></div>
                    <?php if (empty($events)): ?>
                        <div class="no-event">
                            <div>You don’t have any events booked on <?php echo date('d F l', strtotime($date)); ?></div>
                            <a href="">View Personal Program</a>
                        </div>
                    <?php else: ?>
                        <?php $checkoutItem = new CheckoutItem() ?>
                        <?php foreach ($events as $event): ?>
                            <?php
                                $data = $event;
                                $html = $checkoutItem->render($date, $data);
                                echo $html;
                            ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="checkout-form">
            <h2>Personal Information</h2>
            <form action="/pay" method="post">
                <div class="personal-info-row">
                    <div>
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstName">
                    </div>
                    <div>
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastName">
                    </div>
                </div>
                <div class="personal-info-row">
                    <div>
                        <label for="address">Address</label>
                        <input type="address" id="address" name="address">
                    </div>
                    <div>
                        <label for="tel">Phone</label>
                        <input type="tel" id="tel" placeholder="+31 6 12 34 56 78" name="phone">
                    </div>
                </div>
                
                <button type="submit" class="btn-pay">Pay <span class="pay-amount"></span></button>
            </form>
        </div>
    </div>
<?php else: ?>
    <div class="checkout-container">
        <div class="order-items list-view">
            <div class="no-event">
                <div>You don’t have any events booked</div>
                <a href="/personalProgram">View Personal Program</a>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
    $scripts = [
        ['src' => '/javascript/personalProgram.js' ]
    ];

    include __DIR__ . '/footer.php';
?>