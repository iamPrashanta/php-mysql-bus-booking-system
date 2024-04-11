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
    <title>Bookings</title>
    <link rel="stylesheet" href="../style/find-bus.css">
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

            $get_bookings = mysqli_query($conn, "SELECT * FROM `pax_details` JOIN `bkbus` ON `pax_details`.`pnr` = `bkbus`.`pnr`;");

            if (mysqli_num_rows($get_bookings) > 0) {
                echo "<table width='auto' class=''>";
                echo "<tr class='tr-1'>";
                echo "<th>NO</th>";
                echo "<th>PNR</th>";
                echo "<th>USERNAME</th>";
                echo "<th>MAIL</th>";
                echo "<th>BUS NO</th>";
                echo "<th>SOURCE</th>";
                echo "<th>DESTINATION</th>";
                echo "<th>BOOKED SEAT</th>";
                echo "<th>DOJ</th>";
                echo "<th>TOTAL PRICE</th>";
                echo "<th>STATUS</th>";
                echo "<th>PASSENRGER(S)</th>";
                echo "</tr>";

                while ($result_list = mysqli_fetch_assoc($get_bookings)) {
                    $pnr = $result_list["pnr"];
                    $username = $result_list["username"];
                    $mail = $result_list["mail"];
                    $bno = $result_list["bno"];
                    $source = $result_list["source"];
                    $destination = $result_list["destination"];
                    $total_seat = $result_list["seats"];
                    $date_of_journey = $result_list["doj"];
                    // $price = $result_list["price"];
                    $tot_price = $result_list["tot_price"];
                    $status = $result_list["status"];

                    $name1 = $result_list["name1"];
                    $age1 = $result_list["age1"];
                    $gen1 = $result_list["gen1"];

                    $name2 = $result_list["name2"];
                    $age2 = $result_list["age2"];
                    $gen2 = $result_list["gen2"];

                    $name3 = $result_list["name3"];
                    $age3 = $result_list["age3"];
                    $gen3 = $result_list["gen3"];

                    echo "<tr class='tr-2'>";
                    echo "<td>$no</td>";
                    echo "<td>$pnr</td>";
                    echo "<td>$username</td>";
                    echo "<td>$mail</td>";
                    echo "<td>$bno</td>";
                    echo "<td>$source</td>";
                    echo "<td>$destination</td>";
                    echo "<td>$total_seat</td>";
                    echo "<td>$date_of_journey</td>";
                    echo "<td>$tot_price</td>";
                    echo "<td>$status</td>";

                    if ($total_seat == 1) {
                        echo "<td>
            $name1 $age1 $gen1
            </td>";
                    } else if ($total_seat == 2) {
                        echo "<td>
                $name1 $age1 $gen1 |
                $name2 $age2 $gen2
                </td>";
                    } else {
                        echo "<td>
            $name1 $age1 $gen1 |
            $name2 $age2 $gen2 |
            $name3 $age3 $gen3
            </td>";
                    }
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