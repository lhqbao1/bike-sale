<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/themify-icons/">
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
            background-color: green;
            padding: 10px;
            margin-left: -10px;
            margin-top: -5px;
        }
    </style>
</head>

<body>
    <div class="search-btn">
        <form action="" method="post">
            <i class="search-icon ti-search"></i>
            <p class="search-form">
                <input style="margin-left: 600px; border-color: #fff; border-radius: 10px; padding: 5px 10px 5px 10px;" type="text" name="noidung">
                <button style="padding: 10px; border-radius: 10px; border: none; background-color: #fff" type="submit" name="btn">Search</button>
                <a style="margin-left: 20px; text-decoration: none; color: #333; border-radius: 15px; background-color: #fff; padding: 10px" href="add.php">Add</a>
            </p>
        </form>
    </div>

    <?php
    if (isset($_POST['btn'])) {
        $noidung = $_POST['noidung'];
    } else {
        $noidung = false;
    }
    ?>

    <?php
    include 'connect.php';

    $sql = "SELECT * FROM concert WHERE band LIKE '%$noidung%' ";
    $result = mysqLi_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div id="main-products">
            <div class="first-main-product">
                <img width="300px" height="300px" src="img/concert/<?php echo $row['image'] ?>" alt="">
                <h1 style="text-align: center;"> <?php echo $row['band'] ?></h1>
                <h3 style="margin-left: 5px;"> <?php echo $row['places'] ?>
                    <span> <a style="float: right; margin-right: 20px; text-decoration:none; background-color: #ccc; color: $fff; padding: 10px" href="delete.php?this_id= <?php echo $row['id'] ?>"> Delete </a> </span>

                </h3>
                <h6 style="margin-left: 5px;"> Price: <?php echo $row['price'] ?>
                    <span> <a style="float: right; margin-right: 20px; margin-bottom: 10px; text-decoration:none; background-color: #ccc; color: $fff; padding: 10px 20px 10px 18px; font-size: 18px" href="edit.php?this_id= <?php echo $row['id'] ?>"> Edit </a> </span>

                </h6>
                <h5 style="color: brown; margin-left: 5px;"> Date: <?php echo $row['date'] ?></h5>
            </div>
        </div>
    <?php } ?>


</body>

</html>