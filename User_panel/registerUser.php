<?php
//registerUser.php (13) . For registering new user details in database.

include 'conn.php';
include 'recorddie.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$userName = $_POST['userName'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$password = $_POST['password'];
$password = password_hash($password, PASSWORD_DEFAULT);
$query = "SELECT id from logindata where email=?";
if (!$stmt = $link->prepare($query)) {
    recorddie(__LINE__, __FILE__, $query . ' ' . $link->error);
    die('SYSTEM ERROR. Could Not Get Information');
}

$stmt->bind_param('s', $email);

if (!$stmt->execute()) {
    recorddie(__LINE__, __FILE__, $stmt->error);
    die('SYSTEM ERROR. Error in database');
}

$stmt->bind_result($id);
$stmt->fetch();
$stmt->close();
if ($id === null) {

    $query = "INSERT INTO `logindata` (name, surname, email, mobile_no, password, status) VALUES (?, ?, ?, ?, ?, 0)";


    if ($stmt = $link->prepare($query)) {
        $stmt->bind_param('sssss', $firstName, $lastName, $email, $phoneNumber, $password);
        if ($stmt->execute()) {
        } else {
            recorddie(__LINE__, __FILE__, $stmt->error);
            die('SYSTEM ERROR. Error in database');
        }
        $stmt->close();
    } else {
        recorddie(__LINE__, __FILE__, $query . ' ' . $link->error);
        die('SYSTEM ERROR. Could not prepare statement');
    }

    $link->close();
    echo json_encode("Successfully Registred");
} else {
    die("User with this email Already exist!");
}
