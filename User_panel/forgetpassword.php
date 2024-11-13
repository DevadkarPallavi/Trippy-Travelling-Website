<?php

//forgetpassword.php (13) . For creating new random password.

include 'conn.php';
include 'recorddie.php';

$email = $_POST['email'];
$mobileno = $_POST['mobileno'];

$query = "SELECT id from logindata where email=? and mobile_no=?";
if (!$stmt = $link->prepare($query)) {
    recorddie(__LINE__, __FILE__, $query . ' ' . $link->error);
    die('SYSTEM ERROR. Could Not Get Information');
}

$stmt->bind_param('si', $email, $mobileno);

if (!$stmt->execute()) {
    recorddie(__LINE__, __FILE__, $stmt->error);
    die('SYSTEM ERROR. Error in database');
}

$stmt->bind_result($id);
$stmt->fetch();
$stmt->close();

if ($id == NULL) {
    die("User not found");
} else {

    $pin = rand(100000, 999999);
    $hashpin = password_hash($pin, PASSWORD_DEFAULT);

    $query = "UPDATE logindata set password=? where id=?";
    if (!$stmt = $link->prepare($query)) {
        recorddie(__LINE__, __FILE__, $query . ' ' . $link->error);
        die('SYSTEM ERROR. Could Not Get Information');
    }

    $stmt->bind_param('si', $hashpin,$id);

    if (!$stmt->execute()) {
        recorddie(__LINE__, __FILE__, $stmt->error);
        die('SYSTEM ERROR. Error in database');
    }

    $stmt->close();

    echo json_encode("Your New Password is $pin");
}
