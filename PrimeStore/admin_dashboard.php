<!--At admin dashboard, show list of non-approved products (i.e. products with false status). -->
<!--Each row shall contain product id, title, picture/s, price, description, approve and -->
<!--reject links (pointing to approve.php and reject.php page). -->
<!--If the product is approved, its status shall be updated to true, if its rejected, it shall be deleted from products table. -->
<!--The approve.php and reject.php pages shall redirect to admin-dashboard.php-->

<?php

require_once("connection.php");
session_start();

if (isset($_SESSION['id'])) {
    if ($_SESSION['type'] == "admin") {

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
                }
            </style>
            <title>Document</title>
        </head>
        <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Admin Dashboard</a>
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
                <td>
                    <h5>IMG </h5>
                </td>
                <td>
                    <h5>Product Id</h5>
                </td>
                <td>
                    <h5>Product Title </h5>
                </td>
                <td>
                    <h5>Price</h5>
                </td>
                <td>
                    <h5>Description</h5>
                </td>
            </tr>
            </thead>


            <?php

            $query = "select * from products where status = 0";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                echo "no records";
            } else {

                while ($row = mysqli_fetch_array($result)) {
                    $product_id = $row['id'];
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
                            <h5><?= $row['id'] ?></h5>
                        </td>
                        <td>
                            <h5><?= $row['title'] ?></h5>
                        </td>
                        <td>
                            <h5><?= $row['price'] ?></h5>
                        </td>
                        <td>
                            <h5><?= $row['description'] ?></h5>
                        </td>
                        <td>
                            <button><a href="approve.php?p_id=<?= $row['id'] ?>">Approve</a></button>
                        </td>
                        <td>
                            <button><a href="reject.php?p_id=<?= $row['id'] ?>">Reject</a></button>
                        </td>
                    </tr>


                    </tbody>


                    <?php


                }
            }
            ?>

        </table>
        </body>
        </html>


        <?php
    } else {
        header("location:http://localhost/PrimeStore/login.php?message=login first to get access to admin_dashboard", true, 301);
    }
} else {
    header("location:http://localhost/PrimeStore/login.php?message=login first to get access to admin_dashboard", true, 301);
}


?>

