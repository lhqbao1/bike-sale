<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="themify-icons/themify-icons.css">

    <style>
        #main-products {
            display: inline-block;
            margin-left: 35px;
        }

        #main-products .first-main-product {
            display: inline-block;
            line-height: 10px;
            border: 5px solid;
            border-color: #333;
            margin-bottom: 10px;

        }

        .search-btn .search-form {
            width: 100%;
            background-color: #ccc;
            padding: 10px;
            margin-left: -10px;
            margin-top: -5px;
        }

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

        #products .products-header,
        .news-header {
            font-size: 30px;
            font-weight: 900;
            margin-left: 30px;
        }

        #main-products {
            display: inline-block;
            margin-left: 20px;
        }

        #main-products .first-main-product {
            display: inline-block;
            border: 5px solid;
            border-color: #333;
        }

        #main-news {
            display: inline-block;
            margin-left: 20px;
        }

        #main-news .news-content {
            width: 500px;

            margin-left: 100px;
            padding: 10px;
        }

        #contact {
            display: flex;
            background-color: #ccc;
            width: 100%;
            height: 100px;
            align-items: center;
            justify-content: space-around;
        }

        #contact>a {
            text-decoration: none;
            color: #333;
            font-weight: 400;
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
            </ul>
        </div>
        <div class="search-btn">
            <a href="search.php">
                <i style="margin-right: 20px;" class="search-icon ti-search"></i>
            </a>
        </div>
    </div>
    <div class="search-btn">
        <form action="" method="post">
            <p class="search-form">
                <input style="margin-left: 600px; border-color: #fff; border-radius: 10px; padding: 5px 10px 5px 10px;" type="text" name="noidung">
                <button style="padding: 10px; border-radius: 10px; border: none; background-color: #fff" type="submit" name="btn">Search</button>
            </p>
        </form>
    </div>

    <?php
    include "connect.php";

    $sql = "SELECT * FROM concert WHERE places LIKE 'Da Nang'";
    $result = mysqLi_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div id="main-products">
            <div style="width: 300px; height: 450px" class="first-main-product">
                <img width="300px" height="300px" src="img/concert/<?php echo $row['image'] ?>" alt="">
                <h1 style="text-align: center;"> <?php echo $row['band'] ?></h1>
                <h5 style="margin-left: 5px;"> <?php echo $row['places'] ?> City</h5>
                <h6 style="margin-left: 5px;"> Price: <?php echo $row['price'] ?></h6>
                <h5 style="color: brown; margin-left: 5px;"> Date: <?php echo $row['date'] ?></h5>
            </div>
        </div>
    <?php } ?>


</body>

</html>