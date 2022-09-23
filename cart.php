<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        body {
            margin: 5% 5% 0 5%;
            min-height: 500px;
            border: 5px #333 solid;

        }

        .header {

            margin-top: 10px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            border-bottom: 5px #333 solid;

        }

        .header a {
            text-decoration: none;
            font-size: 20px;
            font-weight: 800;
            color: #333;
            padding: 5px;
            background-color: #ccc;
            border-radius: 50px;

        }

        .header h1 {
            margin-top: 5px;
            margin-bottom: 0px;
        }

        .cart {
            display: block;

        }

        .cart .cart-detail {
            width: 100%;
            margin-left: 20px;
        }

        .cart .cart-detail .id {
            text-align: center;
            margin-top: 5px;
        }

        .cart .cart-detail a {
            display: block;
            text-align: center;
            margin-bottom: 5px;
            width: 100%;

        }

        .cart .cart-detail .content {
            display: flex;
        }

        .cart-detail .content .detail {
            margin-left: 5px;
        }

        .update input {
            font-size: 20px;
        }

        .update {
            padding-left: 10px;
            display: block;
        }

        .update button,
        p {
            margin-top: 10px;
        }

        .buyer {
            border-top: 5px #333 solid;
            padding: 5px;
            margin-left: -5px;
            width: 99.5%;
        }

        .buyer p {
            margin-left: 15px;
        }
    </style>
</head>

<body>

    <?php
    include 'connect.php';
    session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    $error = false;
    if (isset($_GET['action'])) {

        function update_cart($add = false)
        {
            foreach ($_POST['quantity'] as $id => $quantity) {
                if ($quantity == 0) {
                    unset($_SESSION["cart"][$id]);
                } else {
                    if ($add) {
                        $_SESSION["cart"][$id] += $quantity;
                    } else {
                        $_SESSION["cart"][$id] = $quantity;
                    }
                }
            }
        }
        switch ($_GET['action']) {
            case "add":
                update_cart(true);
                header("location:cart.php");

                break;

            case "delete":
                if (isset($_GET['id'])) {

                    unset($_SESSION["cart"][$_GET['id']]);
                    header("location:cart.php");
                }
                break;
            case "submit":

                if (isset($_POST['update'])) {
                    update_cart();
                    header("location:cart.php");
                } elseif ($_POST['order']) {
                    if (empty($_POST['name'])) {
                        $error = "Nhap ten";
                    } elseif (empty($_POST['phone'])) {
                        $error = "Nhap sdt";
                    } elseif (empty($_POST['address'])) {
                        $error = "Nhap dia chi";
                    }
                    if ($error == false && !empty($_POST['quantity'])) {

                        $products = mysqli_query($conn, "SELECT * FROM `concert` WHERE `id` IN (" . implode(",", array_keys($_POST['quantity'])) . ")");
                        $total = 0;
                        $orderProducts = array();
                        while ($row = mysqli_fetch_array($products)) {
                            $orderProducts[] = $row;
                            $total += $row['price'] * $_POST['quantity'][$row['id']];
                        }
                        $insertOrder = mysqli_query($conn, "INSERT INTO `order` (`id`, `name`, `phone`, `address`, `total`, `note`) 
                        VALUES (NULL, '" . $_POST['name'] . "', '" . $_POST['phone'] . "', '" . $_POST['address'] . "', '" . $total . "', '');
                        ");
                        $orderID = $conn->insert_id;
                        $insertString = "";
                        foreach ($orderProducts as $key => $product) {
                            $insertString .= "(NULL, '" . $orderID . "', '" . $product['id'] . "', '" . $_POST['quantity'][$product['id']] . "', '" . $product['price'] . "')";
                            if ($key != count($orderProducts) - 1) {
                                $insertString .= ",";
                            }
                        }
                        $insertOrder = mysqli_query($conn, "INSERT INTO `order-detail` (`id`, `order_id`, `ticket_id`, `quantity`, `price`) VALUES " . $insertString . ";");
                        unset($_SESSION['cart']);
                    }
                }
                break;
        }
    }

    if (!empty($_SESSION['cart'])) {


        $result = mysqli_query($conn, "SELECT * FROM `concert` WHERE `id` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
    }
    ?>
    <?php if (!empty($error)) { ?>
        <div class="notify">
            <?php
            echo $error;
            ?> <a href="javascript:history.back()">Back to cart</a>
        </div>
    <?php } else { ?>
        <div class="header">
            <?php
            session_start();
            $username = $_SESSION['username'];
            ?>
            <h1>Cart of <?php echo $username ?></h1>
            <a href="ticket.php">Buy more</a>
        </div>

        <form id="cart-form" action="cart.php?action=submit" method="post">

            <div class=" detail">
                <?php
                session_start();
                $error = "Fail";
                $total = 0;
                $num = 1;
                while ($row = mysqli_fetch_array($result)) { ?>

                    <div class="cart">
                        <div class="cart-detail">
                            <p class="id"><?php echo $num ?></p>

                            <div class="content">
                                <div class="image"><img style="width: 100px; height: 130px" src="img/concert/<?php echo $row['image'] ?>" alt=""></div>
                                <div class="detail">
                                    <p>Band <?php echo $row['band'] ?></p>
                                    <p>Place <?php echo $row['places'] ?></p>
                                    <p>Date <?php echo $row['date'] ?></p>
                                    <p>In Stock <?php echo $row['stock'] ?></p>


                                </div>
                            </div>
                            <p>Price <?php echo number_format($row['price'], 0, ".", ".") ?> VND </p>
                            Quantity<input type="text" value="<?php echo $_SESSION["cart"][$row['id']] ?>" name="quantity[<?php echo $row['id'] ?>]">


                            <p>Total <?php echo number_format($row['price'] * $_SESSION["cart"][$row['id']], 0, ".", ".") ?> VND </p>
                            <a class="delete" href="cart.php?action=delete&id=<?= $row['id'] ?>">Delete</a>
                            <hr style="margin-left: -20px; width: 99.85%; height: 4px; color: #ccc; background-color: #ccc">
                        </div>


                    <?php
                    $total += $row['price'] * $_SESSION["cart"][$row['id']];
                    $num++;
                } ?>
                    </div>


            </div>



            <div class=" update">

                <input required style="font-size: 20px; padding: 10px; background-color: #ccc" type="submit" name="update" value="Update">

                <h2>Total: <?php echo number_format($total, 0, ".", ".") ?> VND </h2>

            </div>


            <div class="buyer">
                <p>Name <input type="text" name="name" value="<?php echo $username ?>"> </p>
                <p>Phone number <input type="text" name="phone"> </p>
                <p>Address <input type="text" name="address"> </p>
                <input style="font-size: 50px; padding: 10px; background-color: #ccc" type="submit" name="order" value="Buy">

            </div>
        </form>


    <?php } ?>

</body>

</html>