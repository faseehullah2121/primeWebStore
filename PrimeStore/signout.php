<?php
/**
 * Created by PhpStorm.
 * User: Ahtasham
 * Date: 11/18/2018
 * Time: 11:36 PM
 */
session_start();
session_destroy();
header("location:index.php");
?>