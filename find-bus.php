<?php
session_start();
require_once "./conection.php";
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $login = true;
} else {
    $login = false;
}
if (!isset($_POST["source"])) {
    header("location: ./");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/find-bus.css">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <div class="photo"></div>
    <div class="blur"></div>
    <div class="background"></div>
    <div class="container">
        <header>
            <?php
            if ($login) {
                echo '<li class="login"><a href="./logout.php">Logout</a></li>';
            } else {
                echo '<li class="login"><a href="./login.php">Login</a></li>';
            }
            ?>
        </header>
        <?php

        $no = 1;
        $search_source =  $_POST["source"];
        $search_destination = $_POST["destination"];

        $search_month = $_POST["month"];
        $search_date = $_POST["date"];
        $search_year = $_POST["year"];
        echo "<div class='a'>";
        echo "Showing Search result of";
        echo "</div>";
        // <b> $search_source - $search_destination </b>;

        // search bus
        $search_bus = mysqli_query($conn, "SELECT * FROM `bus_schedule` WHERE `source` = '$search_source' AND `destination` = '$search_destination' AND `doj` = '$search_year-$search_month-$search_date';");
        $result = mysqli_num_rows($search_bus);
        echo "<div class='b'>";
        echo " - " . $result . " result found";
        echo "</div>";
        if ($result > 0) {
            echo "<table width='auto' class=''>";
            echo "<tr class='tr-1'>";
            echo "<th>NO</th>";
            echo "<th>BUS NO</th>";
            echo "<th>SOURCE</th>";
            echo "<th>DESTINATION</th>";
            echo "<th>DATE OF JOURNEY</th>";
            echo "<th>TOTAL SEAT</th>";
            echo "<th>PRICE</th>";
            echo "<th>ACTION</th>";
            echo "</tr>";

            while ($result_list = mysqli_fetch_assoc($search_bus)) {
                $bus_no = $result_list["bno"];
                $source = $result_list["source"];
                $destination = $result_list["destination"];
                $date_of_journey = $result_list["doj"];
                $total_seat = $result_list["seat"];
                $price = $result_list["price"];


                echo "<tr class='tr-2'>";
                echo "<td>$no</td>";
                echo "<td>$bus_no</td>";
                echo "<td>$source</td>";
                echo "<td>$destination</td>";
                echo "<td>$date_of_journey</td>";
                echo "<td>$total_seat</td>";
                echo "<td>$price</td>";
                if ($login) {
                    echo "<td class='btn'><a href='booking1.php?bno=$bus_no'>Book</a></td>";
                } else {
                    echo "<td class='btn'><a href='login.php?bno=$bus_no'>Book</a></td>";
                }
                echo "</tr>";
                $no++;
            }

            echo "</table>";
        }
        ?>
    </div>
</body>

</html>