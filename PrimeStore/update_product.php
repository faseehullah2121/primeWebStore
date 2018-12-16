<?php
/**
 * Created by PhpStorm.
 * User: Ahtasham
 * Date: 11/16/2018
 * Time: 1:56 PM
 */
require_once("connection.php");
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

    <title>Document</title>
</head>
<body>

<?php

if (isset($_GET["ID"])) {
    $p_id = $_GET["ID"];

}

if (isset($_REQUEST['update'])) {

    $p_id = $_REQUEST['id'];
    $p_title = $_REQUEST['title'];
    $p_price = $_REQUEST['price'];
    $p_description = $_REQUEST['description'];
    $p_data_added = $_REQUEST['date_added'];
    $p_status = $_REQUEST['status'];

    $query1 = "select user_id,category_id from products where id=$p_id";
    $result1 = mysqli_query($conn, $query1);
    if (!$result1) {
        echo "error in updating product.";
    } else {
        while ($row1 = mysqli_fetch_array($result1)) {
            $user_id = $row1["user_id"];
            $category_id = $row1["category_id"];
        }
    }

    echo "user_id" . $user_id, "user_id" . $category_id;

    $query = "UPDATE products SET id='$p_id', title= '$p_title', price='$p_price', description='$p_description', date_added='$p_data_added', status='$p_status', user_id='$user_id', category_id='$category_id'  WHERE id = $p_id";
    echo $query;
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<h1>Updated!!!</h1>";
        header("location:seller_dashboard1.php");

    } else {
        echo "FAILED!!!" . mysqli_error($conn);
    }

}

?>

<div class="card" style="border: 1px solid black ; margin-left: 200px ; margin-right: 200px">
    <div class="card-body">
        <form action="update_product.php" method="POST">
            <h2 style="text-align: center">Product Form</h2>
            <br>
            Product_ID:<br> <input type="text" name="id" value="<?= $p_id ?>" required class="form-control" > <br>
            Title:<br> <input type="text" name="title" placeholder="Enter Title" class="form-control" required> <br>
            Price:<br> <input type="number" name="price" placeholder="Enter Price" class="form-control" required> <br>
            Date&Time:<br> <input type="datetime-local" name="date_added" placeholder="Date and time" class="form-control" required> <br>
            Description:<br><textarea name="description" placeholder="Enter Description" rows="10" cols="40" required></textarea>
            <br> <input type="hidden" name="status" value="<?= 0; ?>" placeholder="Enter status" class="form-control">
            <br>
            <br>
            <button type="submit" name="update" value="submit" class="btn btn-dark">Update</button>
        </form>
    </div>
</div>

</body>
</html>

