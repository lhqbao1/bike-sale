<?php
session_start();

if (!isset($_SESSION['mySession'])) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="themify-icons/themify-icons.css">
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
    <?php
    session_start();
    $username = $_SESSION['username'];
    ?>
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

                <li>Xin chao <?php echo $username ?></li>

            </ul>
        </div>
        <div class="search-btn">
            <a href="ticket.php">
                <i style="margin-right: 20px;" class="search-icon ti-search"></i>
            </a>
        </div>
    </div>
    <div id="slider">
        <img style="margin-left: -10px; height:300px; width: 101.5%" src="https://sukienachau.com/wp-content/uploads/2021/09/concert-la-gi.jpg" alt="">
    </div>
    <div id="products">
        <div class="products-header">
            <p style="color: #333;">CITY</p>
            <?php
            include "connect.php";

            $sql = "SELECT * FROM places";
            $result = mysqLi_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div id="main-products">
                    <div style="width: 400px; min-height: 500px" class="first-main-product">
                        <img width="100%" height="300px" src="img/places/<?php echo $row['image'] ?>" alt="">
                        <h3 style="text-align: center;"> <?php echo $row['name'] ?></h3>
                        <h6 style="margin-left: 5px;"> <?php echo $row['content'] ?></h6>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div id="news">
        <p style="color: #333;" class="news-header">BAND</p>
        <?php
        include "connect.php";

        $sql = "SELECT * FROM band";
        $result = mysqLi_query($conn, $sql);

        while ($row = mysqli_fetch_array($result)) {
        ?>
            <div id="main-news">
                <div class="news-content">
                    <img width="100%" height="300px" src="img/band/<?php echo $row['image'] ?>" alt="">
                    <h3><?php echo $row['name'] ?></h3>
                    <p><?php echo $row['member'] ?>
                        <br>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
    <div id="contact">
        <a href="https://www.facebook.com/baoo.luong.33/">FACEBOOK
            <br>
            <br>
            <br>
            <span style="padding: 10px; font-size: 20px; background-color: #fff" class="ti-facebook icon"></span>
        </a>
        <a href="https://www.instagram.com/lhqbao/">INSTAGRAM
            <br>
            <br>
            <br>
            <span style="padding: 10px; font-size: 20px; background-color: #fff" class="ti-instagram icon"></span>
        </a>
    </div>
</body>

</html>