<?php

include 'conn.php';
include 'recorddie.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT id, password, status FROM logindata WHERE email=?";
if (!$stmt = $link->prepare($query)) {
    recorddie(__LINE__, __FILE__, $query . ' ' . $link->error);
    die('SYSTEM ERROR. Could Not Get Information');
}

$stmt->bind_param('s', $email);

if (!$stmt->execute()) {
    recorddie(__LINE__, __FILE__, $stmt->error);
    die('SYSTEM ERROR. Error in database');
}

$stmt->bind_result($id, $storedPassword, $status);
$stmt->fetch();
$stmt->close();

if (!$id) {
    die("User not found");
} else {
    if (!password_verify($password, $storedPassword)) {
        die("Incorrect Password");
    }

    if ($status == 1) {
        die("Your Account is already logged in on another device!");
    }

    $query = "UPDATE logindata SET status=1 WHERE id=?";
    if (!$stmt = $link->prepare($query)) {
        recorddie(__LINE__, __FILE__, $query . ' ' . $link->error);
        die('SYSTEM ERROR. Could Not Get Information');
    }

    $stmt->bind_param('i', $id);

    if (!$stmt->execute()) {
        recorddie(__LINE__, __FILE__, $stmt->error);
        die('SYSTEM ERROR. Error in database');
    }
    $stmt->close();

    echo json_encode("Successfully loggedin");
}
