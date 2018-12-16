<?php
/**
 * Created by PhpStorm.
 * User: Ahtasham
 */

require_once("connection.php");
session_start();
//session_destroy();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        thead {
            background-color: #4caf50;
        }

        a {
            color: white;
        }

        a:hover {
            color: #EF3B3A;
            text-decoration: none;
        }

        button {
            background-color: black;
            color: white;
        }
    </style>
    <title>Document</title>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Online Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">

                    <a class="nav-link"
                       href="http://localhost/PrimeStore/product_detail.php?p_id=<?= $_SESSION['p_id'] ?>">Back</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<p>.</p>
<p>.</p>
<table class="table table-bordered table-dark">
    <thead>
    <tr>
        <td>
            IMG
        </td>
        <td>
            Product Name
        </td>
        <td>
            Product Quantity
        </td>
        <td>
            Product Price
        </td>
        <td>

        </td>
    </tr>
    </thead>
    <?php

    if (isset($_REQUEST['del'])) {
        $product_id = $_REQUEST['del'];
        $_SESSION["cart"]["$product_id"] = $_SESSION["cart"]["$product_id"] - 1;
    }

    foreach ($_SESSION as $key => $val) {

        if (is_array($val) || is_object($val)) {

            foreach ($val as $k => $v) {

                $query = "select * from products where id=$k";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);

                ?>
                <tbody>
                <tr>
                    <td>
                    </td>
                    <td>
                        <?= $row['title'] ?>
                    </td>
                    <td>
                        <?= $v ?>
                    </td>
                    <td>
                        <?= $row['price']; ?>
                    </td>
                    <td>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="c_val" value="<?= $v ?>">
                            <button type="submit" name="del" value="<?= $k ?>">Delete</button>
                        </form>


                    </td>
                </tr>

                </tbody>

                <?php

            }
        }

        ?>

        <?php

    }

    ?>
</table>
</body>
</html>
