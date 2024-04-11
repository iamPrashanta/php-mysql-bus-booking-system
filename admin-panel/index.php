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
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../style/admin-feedback.css">
</head>

<body>
    <div class="photo"></div>
    <div class="container">

        <header>
            <div class="logo"></div>
            <nav>
                <!-- <li><a href="./">Home</a></li> -->
                <li><a href="./search-booking.php">Bookings</a></li>
                <li><a href="./feedback.php">Feedback</a></li>
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

            $get_bookings = mysqli_query($conn, "SELECT * FROM `userdetails` WHERE `role` = 'user';");

            if (mysqli_num_rows($get_bookings) > 0) {
                echo "<table width='auto' class=''>";
                echo "<tr class='tr-1'>";
                echo "<th>NO</th>";
                echo "<th>USERNAME</th>";
                echo "<th>PASSWORD</th>";
                echo "<th>PHONE</th>";
                echo "<th>MAIL</th>";
                echo "<th>ACTION</th>";
                echo "</tr>";

                while ($result_list = mysqli_fetch_assoc($get_bookings)) {
                    $username = $result_list["username"];
                    $pswd = $result_list["pswd"];
                    $phone_no = $result_list["phone_no"];
                    $email = $result_list["email"];

                    echo "<tr class='tr-2'>";
                    echo "<td>$no</td>";
                    echo "<td>$username</td>";
                    echo "<td>$pswd</td>";
                    echo "<td>$phone_no</td>";
                    echo "<td>$email</td>";
                    echo "<td><a href='./edit-members.php?username=$username&phone=$phone_no'><button class='update_btn'>Edit</button></a></td>";
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