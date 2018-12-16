<?php
/**
 * Created by PhpStorm.
 * User: Ahtasham
 * Date: 11/16/2018
 * Time: 1:56 PM
 */
require_once("connection.php");

if (isset($_GET["cart_id"])) {
    echo "cart data deleted";
} elseif (isset($_GET["ID"])) {
    $product_id = $_GET["ID"];

    $query1 = "DELETE FROM `pictures` WHERE product_id= $product_id";
    echo $query1;
    $result1 = mysqli_query($conn, $query1);
    if ($result1) {
        $query = "DELETE FROM `products` WHERE `products`.`id` = $product_id ";
        echo $query;
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "   deleted";
            header("location:seller_dashboard1.php");
        } else {
            echo "<br>";
            echo "Error in Deleting Product";
        }

    } else {
        echo "error";
    }


}


?>