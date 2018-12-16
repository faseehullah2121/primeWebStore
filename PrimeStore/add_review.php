<?php
/**
 * Created by PhpStorm.
 * User: Ahtasham
 * Date: 11/9/2018
 * Time: 2:09 AM
 */
require_once("connection.php");
session_start();
if (isset($_REQUEST['submit_rating'])) {

    $user_id = $_SESSION['id'];
    $p_id = $_REQUEST['product_id'];
    $rating = $_REQUEST['rate'];
    $comments = $_REQUEST['comment'];

    echo $query = "insert into reviews values (' ','$user_id' , '$p_id', '$rating', '$comments', NOW() )";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "done";
        header("location:product_detail.php?p_id=$p_id");
    } else {
        "error";
    }

}
?>