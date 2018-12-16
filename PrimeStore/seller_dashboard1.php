<?php
require_once("connection.php");
session_start();
if (isset($_SESSION['id'])) {
    if ($_SESSION['type'] == 'seller') {
        ?>

        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
                  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
                  crossorigin="anonymous">
            <style>
                th {
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
                }
            </style>
            <title>Document</title>
        </head>
        <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Seller Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="add_product.php">Add New Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signout.php">Sign Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <br>
        <br>
        <br>
        <table class="table table-bordered table-dark">
            <thead>
            <tr>
                <th>Picture</th>
                <th>Title</th>
                <th>Price</th>
                <th>Status</th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <?php

            $user_id = $_SESSION["id"];

            $query1 = "select * from products where user_id = $user_id";
            $result1 = mysqli_query($conn, $query1);
            if (!$result1) {
                echo "no records found:";
            } else {
                while ($row = mysqli_fetch_array($result1)) {
                    $product_id = $row["id"];
                    ?>

                    <tbody>
                    <tr>
                        <td>
                            <?php
                            $query = "select * from pictures where product_id=$product_id";
                            $result = mysqli_query($conn, $query);
                            $row1 = mysqli_fetch_array($result);
                            $pic_src = $row1['picture_file_name'];
                            ?>
                            <a href="product_detail.php?p_id=<?= $product_id ?>"><?php echo "<img src=\"Images/" . $pic_src . ".jpg\" style=\"width: 40%\"; height=\"160px\">"; ?></a>
                        </td>
                        <td>
                            <br>
                            <br>
                            <br>
                            <br>
                            <?php echo $row["title"] ?>
                        </td>
                        <td>
                            <br>
                            <br>
                            <br>
                            <br>
                            <?php echo $row["price"] ?>
                        </td>
                        <td>
                            <br>
                            <br>
                            <br>
                            <br>
                            <?php echo $row["status"] ?>
                        </td>
                        <td>
                            <br>
                            <br>
                            <br>
                            <br>
                            <button><a href="delete_product.php?ID=<?= $product_id ?> "> Remove</a></button>
                        </td>
                        <td>
                            <br>
                            <br>
                            <br>
                            <br>
                            <button><a href="update_product.php?ID=<?= $product_id ?>">Update</a></button>
                        </td>
                    </tr>

                    </tbody>

                    <?php
                }
            } ?>

        </table>

        </body>
        </html>
        <?php
    } else {
        header("location:http://localhost/PrimeStore/login.php?message=login first to get access to seller_dashboard", true, 301);

    }
} else {
    header("location:http://localhost/PrimeStore/login.php?message=login first to get access to seller_dashboard", true, 301);
}

?>

