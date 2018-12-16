<?php
/**
 * Created by PhpStorm.
 * User: Ahtasham
 * Date: 11/16/2018
 * Time: 1:56 PM
 */
require_once("connection.php");

if (isset($_GET["p_id"])) {
    $product_id = $_GET["p_id"];

    $query1 = "DELETE FROM `pictures` WHERE product_id= $product_id";
    echo $query1;
    $result1 = mysqli_query($conn, $query1);

    $query = "DELETE FROM `products` WHERE `products`.`id` = $product_id";
    echo $query;
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "   deleted";
        header("location:admin_dashboard.php");
    } else {
        echo "<br>";
        echo "Error in Deleting Product";
    }

}
