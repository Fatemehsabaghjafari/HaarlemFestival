<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice {
            margin: 20px;
        }
        .invoice-header {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            margin: 0;
        }
        .invoice-info {
            margin-bottom: 20px;
        }
        .invoice-info p {
            margin: 5px 0;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .invoice-table th {
            background-color: #f2f2f2;
        }
        .invoice-total {
            margin-top: 20px;
            float: right;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <img src="img/Logo.png" alt="Logo" class="logo" height="60px">
            <h1>Invoice</h1>
        </div>
        <div class="invoice-info">
            <p>Invoice Number: <?php echo $invoiceNumber; ?></p>
            <p>Date: <?php echo $invoiceDate; ?></p>
            <p>Name: <?php echo $firstName . " " . $lastName; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>Phone: <?php echo $phone; ?></p>
            <p>Address: <?php echo $address; ?></p>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Event</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through items and display them -->
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo $item['dateTime']; ?></td>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>€<?php echo $item['price']; ?></td>
                        <td>€<?php echo $item['quantity'] * $item['price']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="invoice-total">
            <p>VAT (21%): €<?php echo $vat; ?></p>
            <p>Total: €<?php echo $totalAmount; ?></p>
        </div>
    </div>
</body>
</html>
