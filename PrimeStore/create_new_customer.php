<!--create-shop.php page shall open when user click Create New Shop link given in footer. -->
<!--It shall contain a form. To create new shop, user shall enter email, user name, password, business address and shop title.-->
<!--When the form is submitted, it shall create a new seller account i.e. shop and redirect to homepage.-->


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>SignUp</title>
</head>
<body>

<?php
require_once("connection.php");

//Saving SignUp_Customer data in database
if (isset($_POST['submit'])) {
    echo "in db";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $type = "customer";

    $sql = "insert into users values (' ','$name','$email','$password','$address','$type',' ')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "ERROR!!" . mysqli_error($conn);
    } else {
        header("location:index.php");
    }

}


    ?>

<div class="card" style="border: 1px solid black ; margin-left: 200px ; margin-right: 200px">
    <div class="card-body">
        <form action="create_new_customer.php" method="POST">
            <h2 style="text-align: center">Product Form</h2>
            <br>
            Email:<br> <input type="email" name="email" placeholder="Enter email" class="form-control"> <br>
            Password:<br> <input type="password" name="password" placeholder="Enter password" class="form-control"> <br>
            Name:<br> <input type="text" name="name" placeholder="Enter name" class="form-control"> <br>
            Address:<br> <input type="text" name="address" placeholder="Enter address" class="form-control"> <br>
            <br>
            <button type="submit" name="submit" value="submit" class="btn btn-dark">Sumbit</button>
        </form>
    </div>
</div>


</body>
</html>
