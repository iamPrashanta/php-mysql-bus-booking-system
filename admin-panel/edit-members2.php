<?php
session_start();
require_once "../conection.php";
if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    $username = $_SESSION["username"];
    $role = $_SESSION["role"];

    if ($role == "Admin" || $role == "admin") {
        $login = true;

        // get data from url
        if (isset($_GET["username"])) {
            $username = $_GET["username"];
        } else {
            $username = "";
        }
        if (isset($_GET["phone"])) {
            $phone_no = $_GET["phone"];
        } else {
            $phone_no = "";
        }
    } else {
        $login = false;
        header("location:../admin-login.php");
    }
} else {
    $login = false;
    header("location:../admin-login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <link rel="stylesheet" href="../style/admin-feedback.css">
</head>

<body>
    <div class="photo"></div>
    <div class="blur"></div>
    <div class="background"></div>
    <div class="container">
        <header>
            <div class="logo"></div>
            <nav>
                <li><a href="./">Home</a></li>
                <li><a href="./feedback.php">Feedback</a></li>
                <li><a href="./search-booking.php">Bookings</a></li>
                <?php
                if ($login) {
                    echo '<li><a href="./logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="../admin-login.php">Login</a></li>';
                }
                ?>
            </nav>
        </header>

        <div id="table_data">
            <?php
            // main
            $username =  $_POST["username"];

            // changed
            $pswd =  $_POST["password"];
            $email = $_POST["email"];
            $phone_no = $_POST["phone_no"];
            $update_profile = mysqli_query($conn, "UPDATE `userdetails` SET `pswd` = '$pswd' , `phone_no` = '$phone_no' , `email` = '$email' WHERE `username` = '$username';");

            if ($update_profile == 1) {
                echo "Profile Update Succesfully <br>";
                echo "View <a href='edit-members.php?username=$username&phone=$phone_no'>Profile</a>";
            } else {
                echo "Error Updating Profile" . $conn->error;
            }
            ?>
        </div>
    </div>
</body>

</html>