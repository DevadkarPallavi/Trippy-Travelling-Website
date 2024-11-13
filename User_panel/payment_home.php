<?php
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="trippy";

    $conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    if(!$conn){
        die("could not connect to the database".mysqli_connect_error());
    }
    $msg="";
    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
        $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
        $package_price = mysqli_real_escape_string($conn, $_POST['package_price']);

        $sql = "INSERT INTO payment (name, phone_number, package_name, package_price) VALUES ('$name', '$phone_number', '$package_name', '$package_price')";

        if(mysqli_query($conn, $sql)){
            $msg = "Booking Details added successfully!";
        }
        else{
            $msg = "Failed to add booking details!";
        }   
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-info">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-light mt-5 rounded">
            <h2 class="text-center p-2">Booking Details for Payment</h2>
            <form action="payment_success.php" method="post" class="p-2" enctype="multipart/form-data" id="form-box">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                </div>
                <!-- Add some space between the inputs -->
                <div style="margin-bottom: 10px;"></div>
                <div class="form-group">
                    <input type="tel" name="phone_number" class="form-control" placeholder="Enter your Phone Number" required>
                </div>
                <!-- Add some space between the inputs -->
                <div style="margin-bottom: 10px;"></div>
                <div class="form-group">
                    <input type="text" name="package_name" class="form-control" placeholder="Enter your package name" required>
                </div>

                <div style="margin-bottom: 10px;"></div>
                <div class="form-group">
                    <input type="text" name="package_price" class="form-control" placeholder="Enter your package price" required>
                </div>

                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-danger btn-block" value="Submit">
                </div>
                <div class="form-group">
                    <h4 class="text-center"><?= $msg; ?></h4>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 mt-3 p-4 bg-light rounded">
        <a href="home.html" class="btn btn-warning btn-block btn-lg">Go to Home page</a>
        </div>
    </div>
</div>
</body>
</html>
