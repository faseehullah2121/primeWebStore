<?php
/**
 * Created by PhpStorm.
 * User: Ahtasham
 * Date: 11/12/2018
 * Time: 5:35 PM
 */

$server_name = "localhost";
$username = "root";
$password = "";
$db = "primestore";
$conn = new mysqli($server_name, $username, $password, $db);
if ($conn->connect_error) {
    echo "Connection Faled:";
} else {
//    echo "Connected Successfully:";
}
?>
<br>
