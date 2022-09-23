<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order</title>
    <style>
        body {
            margin: 0px;
        }

        .header {
            background-color: #ccc;
            padding: 10px;
            text-align: center;
        }

        .list-order {
            margin-left: 20%;
            margin-right: 20%;
            text-align: center;
        }

        ul>li {
            list-style-type: none;
            display: flex;
            justify-content: space-around;
            border: 1px #ccc solid;

        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Hello admin</h1>
    </div>

    <div class="list-order">
        <h2>Order management</h2>
        <ul>
            <li>
                <div>ID</div>
                <div>Name</div>
                <div>Address</div>
                <div>Phone number</div>
                <div>Details</div>
            </li>
            <?php
            include 'connect.php';

            $sql = "SELECT * FROM `order`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <li>
                    <div><?php echo $row['id'] ?></div>
                    <div><?php echo $row['name'] ?></div>
                    <div><?php echo $row['address'] ?></div>
                    <div><?php echo $row['phone'] ?></div>
                    <div><a href="order-details.php?id=<?php echo $row['id'] ?>">Details</a></div>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>

</html>