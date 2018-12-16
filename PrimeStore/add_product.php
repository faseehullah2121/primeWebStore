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
/**
 * Created by PhpStorm.
 * User: Ahtasham
 * Date: 11/9/2018
 * Time: 2:09 AM
 */
require_once("connection.php");
session_start();

if (isset($_REQUEST['submit'])) {
    $title = $_REQUEST['title'];
    $price = $_REQUEST['price'];
    $description = $_REQUEST['description'];
    $date_added = $_REQUEST['date_added'];
    $status = $_REQUEST['status'];
    $user_id = $_SESSION['id'];
    $category_id = $_REQUEST['id'];
    $status = false;
    echo "(category_id_in_Products=>" . $category_id . ")";

    $query = "insert into products values ('','$title','$price','$description','$date_added','$status','$user_id','$category_id')";
    $result3 = mysqli_query($conn, $query);
    if (!$result3) {
        die("QUERY FAILED!!!" . mysqli_error($conn));
    } else {
        $prod_id;
        $query1 = "select * from products where category_id = $category_id";
        $result = mysqli_query($conn, $query1);
        while ($row = mysqli_fetch_array($result)) {
            echo $prod_id = $row["id"];
        }
        $folder_name = "Images";
        echo $folder_name;

        if (isset($_FILES['pictures'])) {
            $file_name = $_FILES['pictures']['name'];
            $file_type = $_FILES['pictures']['type'];
            $tmp_file_at_server = $_FILES['pictures']['tmp_name'];
            echo 'File Name : ' . $file_name . '<br/>';
            echo 'File Name : ' . $file_type . '<br/>';
            echo 'Temporarily location at : ' . $tmp_file_at_server . '<br/>';

        }


        if (file_exists($folder_name) && is_dir($folder_name)) {
            echo '<br/>' . $folder_name . ' named folder already exist';
        } else {
            mkdir($folder_name);
            echo '<br/> Folder created with name : ' . $folder_name;
        }

// So folder exists now ...
// To store file with different name, we need file extension, lets get file extension from the file_name
        if (isset($file_name)) {
            $file_extension = substr($file_name, strlen($file_name) - 3, 3);
            echo '<br/> File extension is: ' . $file_extension;

            $file_name_at_server = time() . "_" . $prod_id; // Generate a unique file name for the file, using some way e.g. time, random.
            echo "<br/> File name at server : $file_name_at_server <br/>";

            $new_file_path = $folder_name . '/' . $file_name_at_server . '.' . $file_extension;
            echo "<br/> File new path : $new_file_path  <br/>";
        }

        if (isset($tmp_file_at_server))
            if (is_uploaded_file($tmp_file_at_server)) {
                move_uploaded_file($tmp_file_at_server, $new_file_path);
                echo '<br/> File moved';
            }

        $is_main_pic = 1;

        if (isset($file_name))
            $query = "INSERT INTO pictures VALUES ('', $prod_id,'$file_name_at_server','$is_main_pic')";
        $result = mysqli_query($conn, $query);

        header("location: seller_dashboard1.php");

        ob_end_flush();

        echo "<h1>SUCCESSFUL!!!</h1>";
    }
}
?>


<?php
if (isset($_GET['category_id'])) {
    $c_id = $_GET['category_id'];
    ?>
    <div class="card" style="border: 1px solid black ; margin-left: 200px ; margin-right: 200px">
        <div class="card-body">
            <form action="add_product.php" method="post" enctype="multipart/form-data">
                <h2 style="text-align: center">Product Form</h2>
                <input type="hidden" name="id" value="<?= $c_id ?>">
                <br> Title:<br> <input type="text" name="title" placeholder="Enter Title" class="form-control" required> <br>
                Price:<br> <input type="number" name="price" placeholder="Enter Price" class="form-control" required> <br>
                Date&Time:<br> <input type="datetime-local" name="date_added" placeholder="Date and time" class="form-control" required> <br>
                Description:<br><textarea name="description" placeholder="Enter Description" rows="10" cols="40" required></textarea>
                <br> <input type="hidden" name="status" value="<?= 0; ?>" placeholder="Enter status" class="form-control"> <br>
                <br>
                <input type="file" class="form-control-file" name="pictures" value="pictures" required><br>
                <button type="submit" name="submit" value="submit" class="btn btn-dark">Sumbit</button>
            </form>
        </div>
    </div>
    <?php

} else {
    ?>

    <div class="row">
        <div class="col-lg-3">
            <h1 class="my-4">Categories</h1>
            <?php
            $query5 = "select * from categories";
            $result5 = mysqli_query($conn, $query5);
            if ($result5) {
                while ($row5 = mysqli_fetch_array($result5)) {
                    $cat_id = $row5["id"];
                    $cat_name = $row5["name"];
                    ?>
                    <div class="list-group">
                        <a href="add_product.php?category_id=<?= $cat_id ?>"
                           class="list-group-item"><?= $cat_name ?></a>
                    </div>
                    <?php
                }
            }
            ?>

        </div>
    </div>

    <?php
}
?>


</body>
</html>

<?php

//if(isset($_REQUEST['submit'])){
//    echo "category_id" .$_REQUEST['id'];
//echo "asfasd";
//
//     $title=$_REQUEST['title'];
//     $price=$_REQUEST['price'];
//     $description=$_REQUEST['description'];
//     $date_added=$_REQUEST['date_added'];
//     $status=$_REQUEST['status'];
//    session_start();
//     $user_id = $_SESSION["id"];
//    $category_id = $_REQUEST['id'];
//    echo "user_id_in_Products".$user_id;
//
//
//
//
//
//    $sql= "insert into products values ('','$title','$price','$description','$date_added','$status','$user_id','$category_id')";
//    $result=mysqli_query($conn,$sql);
//    if (!$result) {
//        echo "ERROR!!" . mysqli_error($conn);
//    }
//    else
//    {
//
//        header("location:seller_dashboard1.php");
//    }
//
//
//
//
//
//}
//?>


