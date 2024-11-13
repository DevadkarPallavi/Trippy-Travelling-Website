<?php

//loginUser.php (13) . For login page, User Email & Password will be verified here.

include 'conn.php';
include 'recorddie.php';

$email = $_POST['email'];

$query = "UPDATE logindata SET status = 0 WHERE email = ?";
if (!$stmt = $link->prepare($query)) {
    recorddie(__LINE__, __FILE__, $query . ' ' . $link->error);
    die('SYSTEM ERROR. Could Not Get Information');
}

$stmt->bind_param('s', $email);

if (!$stmt->execute()) {
    recorddie(__LINE__, __FILE__, $stmt->error);
    die('SYSTEM ERROR. Error in database');
}

$stmt->close();

echo json_encode("Successfully logged out");
