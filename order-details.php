<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        .detail {
            margin-left: 30%;
            margin-right: 30%;
            text-align: center;
            margin-top: 10%;
            border: 5px #333 solid;
        }

        .detail .order-information>ul,
        .ticket-information>ul,
        .total-information>ul {
            margin-left: 0px;
            text-align: left;
        }
    </style>
</head>

<body>
    <?php
    include 'connect.php';
    $orders = mysqli_query($conn, "SELECT `order`.`name`, `order`.`address`, `order`.`phone`, `order-detail`.*, `concert`.`band` AS concert_band, `concert`.`places` AS concert_places FROM `order` INNER JOIN `order-detail` ON `order`.`id`=`order-detail`.`order_id` INNER JOIN `concert` ON `concert`.`id`=`order-detail`.`ticket_id` WHERE  `order`.`id`= " . $_GET['id'] . ";");

    $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
    ?>
    <div class="detail">
        <div class="order-information">
            <h2>Order information</h2>
            <ul style="list-style-type: none;">
                <li>Name: <?php echo $orders[0]['name'] ?></li>
                <li>Phone Number: <?php echo $orders[0]['phone'] ?></li>
                <li>Address: <?php echo $orders[0]['address'] ?></li>
            </ul>
            <hr>
        </div>
        <div class="ticket-information">
            <h2>Ticket information</h2>
            <ul style="list-style-type: none;">
                <?php
                $totalQuantity = 0;
                $totalMoney = 0;
                foreach ($orders as $row) { ?>
                    <li>Band: <?php echo $row['concert_band'] ?></li>
                    <li>Place: <?php echo $row['concert_places'] ?></li>
                    <li>Quantity: <?php echo $row['quantity'] ?> tickets</li>
                    <br>
                <?php
                    $totalMoney += ($row['price'] * $row['quantity']);
                    $totalQuantity += $row['quantity'];
                } ?>
            </ul>
            <hr>
        </div>
        <div class="total-information">
            <h2>Total</h2>
            <ul style="list-style-type: none;">
                <li>Total quantity: <?php echo $totalQuantity ?> tickets</li>
                <li>Total Price: <?php echo number_format($totalMoney, 0, ".", ".") ?> VND</li>
            </ul>
        </div>
    </div>
</body>

</html>