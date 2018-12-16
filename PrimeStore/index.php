<!DOCTYPE html>
<html lang="en">

<?php
require_once("connection.php");

?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Online Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
    <!--    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <link href="shop-homepage.css" rel="stylesheet">

    <style>
        div {
            /*border: 1px solid black;*/
        }

        a {
            color: deepskyblue;
            font-size: 22px;
        }

        a:hover {
            color: #EF3B3A;
            text-decoration: none;
        }

        p a {
            color: #b3b3b3;
        }

        p a:hover {
            color: white;
        }

    </style>
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
                    <a class="nav-link" href="#">About</a>
                </li>
                <?php
                session_start();
                //                echo $_SESSION['id'];
                if (!isset($_SESSION['id'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create_new_customer.php?submit_customer=submit">Sign Up</a>
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

            </ul>
        </div>
    </div>
</nav>


<!-- this page will open when user clicks on any shop title-->
<?php


if (isset($_GET['users_id'])){
    $user_id = $_GET['users_id'];

    $query2 = "select * from users where id= $user_id";
    $result2 = mysqli_query($conn, $query2);
    if (!$result2) {
        echo "no records found:";
    } else {
        while ($row2 = mysqli_fetch_array($result2)) {
            $shop_title = $row2['shop_title'];
        }
    }

    ?>

    <div class="col-lg-9">
        <h1 class="my-4">All Products Listed by <?= $shop_title; ?> </h1>
        <div class="row">

            <?php
            $query1 = "select * from products where user_id = $user_id AND status=1";
            $result1 = mysqli_query($conn, $query1);
            if (!$result1) {
                echo "no records found:";
            } else {
                while ($row1 = mysqli_fetch_array($result1)) {
                    $title = $row1["title"];
                    $price = $row1["price"];
                    $product_id = $row1["id"];

                    ?>

                    <div class="col-md-3">
                        <div class="card h-100">

                            <?php
                            $query = "select * from pictures where product_id=$product_id";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_array($result);
                            $pic_src = $row['picture_file_name'];
                            ?>
                            <a href="product_detail.php?p_id=<?= $product_id ?>"><?php echo "<img src=\"Images/" . $pic_src . ".jpg\" style=\"width: 100%\">"; ?></a>


                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"><?= $title ?></a>
                                </h4>
                                <h5><?= "RS." . $price ?></h5>
                                <br>
                                <h3 class="card-text"><a href="index.php?id=<?= $row1["user_id"] ?>"></a></h3>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.col-lg-9 -->

    <?php
}
//                         <!-- this page will open when user clicks on any category-->

elseif (isset($_GET["category_id"])) {

    $cat_id = $_GET['category_id'];
    $query6 = "select name from categories where id=$cat_id ";
    $result6 = mysqli_query($conn, $query6);
    if ($result6) {
        while ($row6 = mysqli_fetch_array($result6)) {
            $cat_name = $row6['name'];
        }
        ?>

        <div class="col-lg-9">
            <h1 class="my-4"><h1><?= $cat_name ?></h1></h1>
            <div class="row">

                <?php
                $query1 = "select * from products where category_id=$cat_id AND status=1";
                $result1 = mysqli_query($conn, $query1);

                if (!$result1) {
                    echo "no records found:";
                } else {
                    while ($row1 = mysqli_fetch_array($result1)) {
                        $title = $row1["title"];
                        $price = $row1["price"];
                        $user_id = $row1["user_id"];
                        $product_id = $row1["id"];
                        ?>

                        <div class="col-md-3">
                            <div class="card h-100">

                                <?php
                                $query = "select * from pictures where product_id=$product_id";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result);
                                $pic_src = $row['picture_file_name'];
                                ?>
                                <a href="product_detail.php?p_id=<?= $product_id ?>"><?php echo "<img src=\"Images/" . $pic_src . ".jpg\" style=\"width: 100%\">"; ?></a>


                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#"><?= $title ?></a>
                                    </h4>
                                    <h5><?= "RS." . $price ?></h5>
                                    <br>
                                    <h3 class="card-text"><a href="index.php?users_id=<?= $row1["user_id"] ?>"><?php
                                            $query2 = "select * from users where id= $user_id";
                                            $result2 = mysqli_query($conn, $query2);
                                            if (!$result2) {
                                                echo "no records found:";
                                            } else {
                                                while ($row2 = mysqli_fetch_array($result2)) {
                                                    $shop_title = $row2['shop_title'];
                                                }
                                            }
                                            echo $shop_title;
                                            ?></a></h3>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                }
                ?>


            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->


        <?php
    }

}
//                              Categories and recently added products Page
else{


?>


<!-- Page Content -->
<div class="container">

    <!-- /.col-lg-3 -->
    <div>
        <div class="carousel-item active">
            <img class="d-block img-fluid"
                 src="data:image/jpeg;base64,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"
                 alt="First slide" width="30%">
        </div>
    </div>

    <div class="row">

        <div class="col-lg-4">
            <h1 class="">Categories</h1>
            <?php
            $query5 = "select * from categories";
            $result5 = mysqli_query($conn, $query5);
            if ($result5) {
                while ($row5 = mysqli_fetch_array($result5)) {
                    $cat_id = $row5["id"];
                    $cat_name = $row5["name"];
                    ?>
                    <div class="list-group">
                        <a href="index.php?category_id=<?= $cat_id ?>" class="list-group-item"><?= $cat_name ?></a>
                    </div>
                    <?php
                }
            }
            ?>

        </div>

        <div class="col-md-8">
            <h1 class="my-4">Recently Added Products</h1>
            <div class="row ">

                <?php

                $page2 = 0;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page == "" || $page == "1") {
                        $page2 = 0;
                    } else {
                        $page2 = ($page * 4) - 4;
                    }
                }


                $query1 = "select * from products where status = 1 order by id desc LIMIT $page2, 4";
                $result1 = mysqli_query($conn, $query1);

                if (!$result1) {
                    echo "no records found:";
                } else {
//                    $count=-1;
//                    while($row1 = mysqli_fetch_array($result1)){
//                        $count++;
//                    }
//
//                    $result1->data_seek($count);
                    while ($row1 = $result1->fetch_array()) {
//                        $count--;
//                        if($count>=-1)
//                        {
//                            $result1->data_seek($count);
                        $title = $row1["title"];
                        $price = $row1["price"];
                        $user_id = $row1["user_id"];
                        $product_id = $row1['id'];
                        ?>
                        <div class="col-md-3">
                            <div class="card h-100">
                                <?php
                                $query = "select * from pictures where product_id=$product_id";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result);
                                $pic_src = $row['picture_file_name'];
                                ?>
                                <a href="product_detail.php?p_id=<?= $product_id ?>"><?php echo "<img src=\"Images/" . $pic_src . ".jpg\" style=\"width: 100%\"; height=\"120px\">"; ?></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="product_detail.php?p_id=<?= $product_id ?>"><?php echo $title; ?></a>
                                    </h4>
                                    <h5><?= "RS." . $price ?></h5>
                                    <br>
                                    <h3 class="card-text"><a href="index.php?users_id=<?= $row1["user_id"] ?>"><?php
                                            $query2 = "select * from users where id= $user_id";
                                            $result2 = mysqli_query($conn, $query2);
                                            if (!$result2) {
                                                echo "no records found:";
                                            } else {
                                                while ($row2 = mysqli_fetch_array($result2)) {
                                                    $shop_title = $row2['shop_title'];
                                                }
                                            }
                                            echo $shop_title;
                                            ?></a></h3>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                </div>
                            </div>
                        </div>
                        <?php
                    }


                }
                ?>


            </div>
            <!-- /.row -->
            <br>
            <br>
            <div style="margin-left: 18%">
                <?php

                $limit = 4;
                $t_no_of_products = 16;
                $total_pages = ceil($t_no_of_products / $limit);
                for ($count = 1; $count <= $total_pages; $count++) {
                    ?>

                    <div style="text-align: center">
                        <a style="float: left ; width: 20%;border: 1px solid deepskyblue"class="page-link" href="index.php?page=<?php echo $count; ?>"> <?php echo $count; ?></a>
                    </div>


                    <?php
                }


                ?>

            </div>

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>



<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class=" text-white" style="float: left">Copyright &copy;AhtashamSandhu Online Shoping 2018.</p>
        <p class="  text-white" style="float: right"><a href="create_shop.php?submit_seller=submit" style="">Create New
                Shop</a></p>

    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>


<?php
}
?>