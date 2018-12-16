<?php
/**
 * Created by PhpStorm.
 * User: Ahtasham
 * Date: 11/19/2018
 * Time: 7:22 PM
 */

require_once("connection.php");

if (isset($_GET['p_id'])) {
    echo "approve";
    $p_id = $_GET['p_id'];
    $query = "update products set status=1 where id = $p_id ";
    $result = mysqli_query($conn, $query);
    if (!$result)
        "status updated";
    header("location:admin_dashboard.php");
} else {
    echo "no records";
}

?>