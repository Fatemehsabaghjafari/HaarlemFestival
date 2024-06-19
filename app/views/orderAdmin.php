<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/dance.css">
</head>

<body>

    <?php include __DIR__ . '/adminHeader.php'; ?>

    <div class="container mt-5">
        <h1>Orders</h1>
        
        <form method="post" action="/exportCsv">
            <label for="columns">Select columns to export:</label>
            <input type="checkbox" name="columns[]" value="orderId"> Order ID
            <input type="checkbox" name="columns[]" value="eventType"> Event Type
            <input type="checkbox" name="columns[]" value="ticketId"> Ticket ID
            <input type="checkbox" name="columns[]" value="username"> Username
            <input type="checkbox" name="columns[]" value="paymentId"> Payment ID
            <button type="submit">Export to CSV</button>
        </form>


        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Event Type</th>
                    <th>Ticket ID</th>
                    <th>Username</th>
                    <th>Payment ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['orderId']); ?></td>
                        <td><?php echo htmlspecialchars($order['eventType']); ?></td>
                        <td><?php echo htmlspecialchars($order['ticketId']); ?></td>
                        <td><?php echo htmlspecialchars($order['username']); ?></td>
                        <td><?php echo htmlspecialchars($order['paymentId']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
