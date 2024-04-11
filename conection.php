<?php
$mem_servername = "localhost";
$mem_username = "root";
$mem_password = "";
$mem_dbname = "bus_booking";

// Create connection
$conn = mysqli_connect($mem_servername, $mem_username, $mem_password, $mem_dbname);
if (!$conn) {
    echo "connection error";
    die();
}

// $_SESSION["username"] = "pras";
