<?php
$conn = new mysqli('localhost', 'root', '', 'trippy');
$query = "SELECT * FROM user_contact"; // Added "FROM user_contact" to specify the table
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Users Messages</title>
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

        #title {
            text-align: center;
            color: blue;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 id="title">Users messages</h2>
                    </div>
                    <div class="card-body">
                        <table id="tablestyle">
                            <tr id="heading">
                                <td>name</td>
                                <td>email</td>
                                <td>phone</td>
                                <td>message</td>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['phone'] ?></td>
                                    <td><?php echo $row['message'] ?></td>
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
