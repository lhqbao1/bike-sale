<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <style>
        body {
            margin: 10% 20% 0 20%;
            height: 500px;
            border: 5px #333 solid;

        }

        h2 {
            margin-left: 20px;
            margin-right: 20px;
            border-bottom: 2px #333 solid;
        }

        .content {
            display: flex;
            justify-items: center;
        }

        .content .image {
            height: 300px;
            margin-left: 20px;
            width: 40%;
        }

        .content .image img {
            width: 100%;
            height: 114%;
        }

        .content .detail button {
            padding: 17px 20px 17px 20px;
        }

        .content .detail button p {
            font-size: 20px;

        }

        .content .detail {
            width: 60%;
        }
    </style>
</head>

<body>
    <?php
    include 'connect.php';
    $quantity = 0;

    session_start();


    $sql = "SELECT * FROM concert WHERE id = " . $_GET['id'];

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) { ?>

        <h2>Ticket Detail</h2>
        <div class="content">
            <div class="image">
                <img src="img/concert/<?php echo $row['image'] ?>" alt="">
            </div>
            <div class="detail">
                <ul>
                    <li>
                        <h1>Band: <?php echo $row['band'] ?></h1>
                    </li>
                    <li>
                        <h3>Place: <?php echo $row['places'] ?> City</h3>
                    </li>
                    <li>
                        <h3>Date: <?php echo $row['date'] ?></h3>
                    </li>
                    <li>
                        <h3>Price: <?php echo $row['price'] ?></h3>
                    </li>
                    <li>
                        <h3>In stock: <?php echo $row['stock'] ?></h3>

                    </li>
                    <li>
                        <form id="get-ticket" method="post" action="cart.php?action=add">
                            <input type="text" value="<?php echo $quantity ?>" name="quantity[<?php echo $row['id'] ?>]">
                            <input type="submit" value="Get ticket">


                        </form>
                    </li>
                </ul>
            </div>
        </div>

    <?php } ?>
</body>

</html>