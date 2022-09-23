<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #header .search-icon {
            color: #333;
            line-height: 46px;
            padding: 0 20px;
            font-size: 20px;
            font-weight: 600;
            float: right;
            margin-top: -80px;
            padding: 29px 35px 29px 35px;
            margin-right: 300px;
        }

        #header {
            height: 100px;
            right: 0;
            left: 0;
            top: 0;
            z-index: 1;
            position: relative;

        }

        #header .header-image {
            display: inline-block;
            position: absolute;
            margin-top: -16px;

        }

        #header .header-nav .nav {
            margin-left: 200px;
        }


        .header-nav .nav>li {
            display: inline-block;
            margin: 0px 0px 0px 0px;
            margin-top: 25px;

        }

        .nav>li>a {
            text-decoration: none;
            color: #333;
            width: 30px;
            padding: 40px;

        }


        #header .nav>li:hover>a {
            color: #fff;
            background-color: #ccc;
        }

        #header .search-form {
            float: right;
            margin-right: -350px;
            margin-top: -40px;
        }

        .order {
            display: flex;
            justify-content: space-around;
        }



        .order ul li {
            list-style-type: none;
        }
    </style>
</head>

<body>


    <div id="header">
        <div class="header-image">
            <img width="240px" height="100px" src="https://img.freepik.com/free-vector/black-mic-loudspeakers-vector-illustration-vintage-promotional-logo-concert-music-festival_74855-10591.jpg" alt="">
        </div>
        <div class="header-nav">
            <ul class="nav">
                <li><a href="index.php">HOME</a></li>
                <li><a href="city.php">CITY</a></li>
                <li><a href="ticket.php">TICKET</a></li>
                <li><a href="register.php">SIGN UP</a></li>
                <li><a href="logout.php">LOG OUT</a></li>
                <li><a href="user-order.php">CART</a></li>
                <?php
                session_start();
                $username = $_SESSION['username'];
                ?>
                <li>Xin chao <?php echo $username  ?></li>

            </ul>
        </div>
        <div class="search-btn">
            <a href="ticket.php">
                <i style="margin-right: 20px;" class="search-icon ti-search"></i>
            </a>
        </div>
    </div>
    <h1>YOUR ORDER</h1>
    <div class="order">
        <?php
        $num = 1;
        include 'connect.php';
        session_start();
        $username = $_SESSION['username'];

        $sql = "SELECT `order`.`name`, `order-detail`.*, `concert`.* FROM `order` LEFT JOIN `order-detail` ON `order-detail`.`order_id` = `order`.`id` AND `order`.`name` LIKE '" . $username . "' LEFT JOIN `concert` ON `order-detail`.`ticket_id` = `concert`.`id` AND `order`.`name` LIKE '" . $username . "';";

        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) { ?>

            <ul>
                <li style="text-align: center; font-weight: 900">
                    <?php echo $num ?>
                </li>
                <li>
                    <p>Band: <?php echo $row['band'] ?></p>
                </li>
                <li>
                    <p><?php echo $row['quantity'] ?> tickets</p>
                </li>
                <li>
                    <p>Total price: <?php echo $row['price'] ?></p>
                </li>
                <li>
                    <p>Date: <?php echo $row['date'] ?></p>
                </li>
            </ul>
        <?php
            $num++;
        }

        ?>
    </div>
</body>

</html>