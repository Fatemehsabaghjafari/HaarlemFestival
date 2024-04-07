<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Haarlem</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ced7be0a6d.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/personalProgram.css">
</head>

<body>
    <?php
        include __DIR__ . '/header.php';
        include '../components/ProgramListViewItem.php';
        include '../components/ProgramAgendaViewItem.php';
    ?>

    <script>
        const personalProgram = <?php echo json_encode($personalProgram); ?>;
    </script>
    
    <div class="title">
        <a class="checkout-button" href="/checkout">
            <div>
                <i class="fa-solid fa-cart-shopping"></i> Checkout Program
            </div>
            <div>
                <div class="total-price">€0</div>
            </div>
        </a>

        <h1>PERSONAL PROGRAM</h1>
    </div>

    <div class="program-settings">
        <div class="color-legend">
            <div class="color-legend-item">
                <div class="color-legend-circle color-blue"></div>
                <p>A Stroll Through History</p>
            </div>
            <!-- <div class="color-legend-item">
                <div class="color-legend-circle color-yellow"></div>
                <p>Haarlem Jazz</p>
            </div> -->
            <div class="color-legend-item">
                <div class="color-legend-circle color-green"></div>
                <p>Yummy!</p>
            </div>
            <div class="color-legend-item">
                <div class="color-legend-circle color-red"></div>
                <p>Music!</p>
            </div>
        </div>

        <div class="switch-views">
            <div class="btn-list-view view-active">List View</div>
            <div class="btn-agenda-view">Agenda View</div>
        </div>

        <div class="list-view">
            <?php foreach ($personalProgram as $date => $events): ?>
                <div class="day">
                    <div class="date"><?php echo date('d F l', strtotime($date)); ?></div>
                    <?php if (empty($events)): ?>
                        <div class="no-event">
                            <div>You don’t have any events booked on <?php echo date('d F l', strtotime($date)); ?></div>
                            <a href="">View Festival Overview</a>
                        </div>
                    <?php else: ?>
                        <?php foreach ($events as $event): ?>
                            <?php
                                $data = $event;
                                $html = (new ProgramListViewItem())->render($date, $data);
                                echo $html;
                            ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="agenda-view">
            <div class="time-slots">
                <div class="time">10:00</div>
                <div class="time">11:00</div>
                <div class="time">12:00</div>
                <div class="time">13:00</div>
                <div class="time">14:00</div>
                <div class="time">15:00</div>
                <div class="time">16:00</div>
                <div class="time">17:00</div>
                <div class="time">18:00</div>
                <div class="time">19:00</div>
                <div class="time">20:00</div>
                <div class="time">21:00</div>
                <div class="time">22:00</div>
                <div class="time">23:00</div>
                <div class="time">00:00</div>
            </div>
            <div class="time-seperators">
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>
                <div class="time-seperator"></div>

            </div>
            <div class="days">
                <?php $agendaViewItem = new ProgramAgendaViewItem($personalProgram); ?>
                <?php echo $agendaViewItem->render(); ?>
            </div>
        </div>
    </div>
   
    <script>
        const agendaView = document.querySelector('.agenda-view');
        const timeSeperators = agendaView.querySelector('.time-seperators');
        const scrollWidth = agendaView.scrollWidth;
        timeSeperators.style.width = scrollWidth + 'px';
    </script>

    <script src="/javascript/personalProgram.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

