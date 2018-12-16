<!--product-detail.php page shall display all product information i.e. product ID, category name, title, price, description,-->
<!--all uploaded images, product added date, seller shop title and-->
<!--all reviews (rating, comments, customer name, review-date) posted for that product.-->
<!--Also display average rating of the product.-->
<!--This page shall open when user click the product image or title at index.php.-->

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

        button {
            margin-left: 70%;
        }

        div {
            /*border: 1px solid black;*/
        }

    </style>
    <title>Document</title>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Ahmad
 * Date: 11/17/2018
 * Time: 3:48 AM
 */
require_once("connection.php");
session_start();

?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="margin-bottom: 5%">
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
                <?php
                //                echo $_SESSION['id'];
                if (!isset($_SESSION['id'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Sign In</a>
                    </li>

                    <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="signout.php">Sign Out</a>
                    </li>
                    <?php
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">View Cart</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<br>
<br>
<br>


<?php


if (isset($_REQUEST['p_id'])) {
    $product_id = $_REQUEST['p_id'];
    $_SESSION['p_id'] = $product_id;

    if (isset($_REQUEST['cart'])) {

        $_SESSION["cart"]["$product_id"] = $_SESSION["cart"]["$product_id"] + 1;
        $count = $_SESSION["cart"]["$product_id"];
        echo $count . "Product added to cart.";

    }


    $query1 = "select * from products where id = $product_id";
    $result1 = mysqli_query($conn, $query1);
    if (!$result1) {
        echo "no records are found";
    } else {
        while ($row1 = mysqli_fetch_array($result1)) {
            $p_title = $row1['title'];
            $p_price = $row1['price'];
            $p_description = $row1['description'];
            $p_date_added = $row1['date_added'];
            $p_user_id = $row1['user_id'];
            $p_category_id = $row1['category_id'];
        }
        ?>

        <div style="margin-top: 0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header bg-dark">
                                <h2 style="color: white">Product Information</h2>
                            </div>
                            <div class="card-body">
                                <h4>Product ID:</h4>
                                <p><?= $product_id ?></p>

                                <div class="card" style="width: 400px; float: right">
                                    <?php
                                    $query = "select * from pictures where product_id=$product_id";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_array($result);
                                    $pic_src = $row['picture_file_name'];
                                    ?>
                                    <a href="product_detail.php?p_id=<?= $product_id ?>"><?php echo "<img src=\"Images/" . $pic_src . ".jpg\" style=\"width: 100%\">"; ?></a>

                                </div>

                                <h4>Product Title: </h4>
                                <p><?= $p_title ?></p>
                                <h4>Product Price:</h4>

                                <p><?= $p_price ?></p>
                                <h4>Product Description:</h4>
                                <p><?= $p_description ?></p>
                                <h4>Product Added_Date:</h4>
                                <p><?= $p_date_added ?></p>
                                <h4>Shop Title:</h4>
                                <p><?php
                                    $query2 = "select * from users where id = $p_user_id";
                                    $result2 = mysqli_query($conn, $query2);
                                    $row2 = mysqli_fetch_array($result2);
                                    $shop_title = $row2['shop_title'];
                                    echo $shop_title;

                                    ?>
                                </p>
                                <h4>Category_Name:</h4>
                                <p><?php
                                    $query3 = "select * from categories where id = $p_category_id";
                                    $result3 = mysqli_query($conn, $query3);
                                    $row3 = mysqli_fetch_array($result3);
                                    $c_name = $row3['name'];
                                    echo $c_name;
                                    ?>
                                </p>
                                <form action="product_detail.php" method="post">
                                    <input type="hidden" value="<?= $product_id ?>" name="p_id">
                                    <button class="btn btn-dark " type="submit" name="cart" value="Add to Cart"> Add to Cart</button>

                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <h5 style="color: white">Reviews
                                                <span style="float: right;color: white">Average Rating
                                                    <?php
                                                    $query6 = "select avg(rating) from reviews where product_id=$product_id";
                                                    $result6 = mysqli_query($conn, $query6);
                                                    $row6 = mysqli_fetch_array($result6);
                                                    echo $row6['avg(rating)'];
                                                    ?>
                                            </span>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            $query5 = "select comments from reviews where product_id=$product_id";
                                            $result5 = mysqli_query($conn, $query5);
                                            if ($result5) {
                                                while ($row5 = mysqli_fetch_array($result5)) {
                                                    ?>
                                                    <ul>
                                                        <li>
                                                            <?= $row5['comments'] ?>
                                                        </li>
                                                    </ul>
                                                    <?php
                                                }
                                            }

                                            ?>
                                        </div>
                                        <div class="card-footer">

                                        </div>
                                    </div>

                                </form>

                            </div>
                            <div class="card-footer bg-dark">
                                <?php
                                if (isset($_SESSION['id'])) {
                                    $u_id = $_SESSION['id'];
                                    $query4 = "select id from reviews where user_id=$u_id AND product_id=$product_id";
                                    $result4 = mysqli_query($conn, $query4);
                                    $row4 = mysqli_fetch_array($result4);
                                    if (!$row4['id']) {
                                        ?>
                                        <form action="add_review.php" method="Post">
                                            <input type="hidden" name="product_id" value="<?= $product_id ?>">
                                            <input type="radio" name="rate" value="1"><span
                                                    style="font-size: 20px ;color: white;margin-right: 1%">Poor</span>
                                            <input type="radio" name="rate" value="2"><span
                                                    style="font-size: 20px;color: white;margin-right: 1%">Satisfactory</span>
                                            <input type="radio" name="rate" value="3"><span
                                                    style="font-size: 20px;color: white;margin-right: 1%">Good</span>
                                            <input type="radio" name="rate" value="4""><span
                                                    style="font-size: 20px;color: white;margin-right: 1%">Very Good</span>
                                            <input type="radio" name="rate" value="5"><span
                                                    style="font-size: 20px;color: white;margin-right: 1%">Excellent</span><br>
                                            <span style="font-size: 25px;color: white">Comments:</span> <br><textarea
                                                    name="comment" rows="10" cols="40"
                                                    placeholder="Add Comments..."></textarea>
                                            <button class="btn btn-success " name="submit_rating" value="submit_rating">
                                                Submit
                                            </button>

                                        </form>
                                        <?php
                                    }

                                } else {
                                    echo "<h4 style='color: white'>Please Sign In first to Rate this product and add Comments.</h4>";
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <?php

    }

}
?>


</body>
</html>



