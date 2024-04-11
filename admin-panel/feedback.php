<?php
session_start();
require_once "../conection.php";
if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    $username = $_SESSION["username"];
    $role = $_SESSION["role"];

    if ($role == "Admin" || $role == "admin") {
        $login = true;
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
    <title>Users Feedback</title>
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
            $no = 1;

            $get_bookings = mysqli_query($conn, "SELECT * FROM `feedback` JOIN `userdetails` ON `feedback`.`email` = `userdetails`.`email` WHERE `role` = 'user';");

            if (mysqli_num_rows($get_bookings) > 0) {
                echo "<table width='auto' class=''>";
                echo "<tr class='tr-1'>";
                echo "<th>NO</th>";
                echo "<th>USERNAME</th>";
                echo "<th>PHONE</th>";
                echo "<th>MAIL</th>";
                echo "<th>FULL NAME</th>";
                echo "<th>REMARK (NOTE)</th>";
                // echo "<th>STATUS</th>";
                echo "</tr>";

                while ($result_list = mysqli_fetch_assoc($get_bookings)) {
                    $email = $result_list["email"];
                    $fname = $result_list["fname"];
                    $phone = $result_list["phone"];
                    $remark = $result_list["remark"];
                    // $status = $result_list["status"];
                    $username = $result_list["username"];
                    $phone_no = $result_list["phone_no"];

                    echo "<tr class='tr-2'>";
                    echo "<td>$no</td>";
                    echo "<td>$username</td>";
                    echo "<td>$phone_no</td>";
                    echo "<td>$email</td>";
                    echo "<td>$fname</td>";
                    echo "<td>$remark</td>";
                    // echo "<td>$status</td>";
                    echo "</tr>";
                    $no++;
                }

                echo "</table>";
            }
            ?>
        </div>
    </div>
</body>

</html>