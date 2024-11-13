<?php

$con = mysqli_connect("localhost","root","","trippy");

if(!$con){
    die("connection error");
}

$query = "select * from bookingtable";
$result = mysqli_query($con,$query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>fetch booking data</title>
    <style>
        #tablestyle {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #tablestyle td {
            border: 2px solid black;
            padding: 8px;
            text-align: center;
        }
        #heading {
            background-color: lightblue;
            font-weight: bold;
        }
        #title{
            text-align:center;
            color:blue;
            font-weight: bold;
        }
        
    
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body class="bg-dark">
    <div class="conainer">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 id="title">Booking Data</h2>
                    </div>
                    <div class="card-body">
                        <table id="tablestyle">
                            <tr id="heading">
                                <td>name</td>
                                <td>email</td>
                                <td>phone</td>
                                <td>address</td>
                                <td>location</td>
                                <td>guests</td>
                                <td>arrivals</td>
                                <td>leaving</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                            <tr>
                                <?php

                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                     ?>
                                     <td><?php echo $row['name']?></td>
                                     <td><?php echo $row['email']?></td>
                                     <td><?php echo $row['phone']?></td>
                                     <td><?php echo $row['address']?></td>
                                     <td><?php echo $row['location']?></td>
                                     <td><?php echo $row['guests']?></td>
                                     <td><?php echo $row['arrivals']?></td>
                                     <td><?php echo $row['leaving']?></td>
                                     <td><a href="#" class="btn btn-primary" id="editBookingAdmin">Edit</a></td>
                                     <td><a href="#" class="btn btn-danger">Delete</a></td>
                                      
                                     </tr>
                                     <?php
                                    }
                                    
                                ?>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>