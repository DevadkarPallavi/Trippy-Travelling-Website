<?php $host = "localhost";
$root = "root";
$pass = "";
$database = "trippy";
$link = new mysqli($host, $root, $pass, $database);
if ($link->connect_error) {
    echo "Error in database connenction";
}
