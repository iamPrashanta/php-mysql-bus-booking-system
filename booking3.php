<?php
session_start();
require_once "./conection.php";
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $login = true;
} else {
    $login = false;
    header("location: ./login.php");
    exit;
}
if (!isset($_POST["bus_no"])) {
    header("location: ./");
    exit;
}
// get user details
$get_user_details = mysqli_query($conn, "SELECT * FROM `userdetails` WHERE `username` = '$username';");
if (mysqli_num_rows($get_user_details) > 0) {
    $get_user_data = mysqli_fetch_assoc($get_user_details);
    $role = $get_user_data["role"];
    $phone_no = $get_user_data["phone_no"];
    $email = $get_user_data["email"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/booking3.css">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</head>

<body>
    <header>
        <li><a href="./">Home</a></li>
        <li><a href="./pnr.php">PNR Search & Cancellaton</a></li>
        <li><a href="./feedback.php">Feedback</a></li>
        <?php
        if ($login) {
            echo '<li><a href="./logout.php">Logout</a></li>';
        } else {
            echo '<li><a href="./login.php">Login</a></li>';
        }
        ?>
    </header>
    <div class="blur"></div>
    <div class="photo"></div>
    <div class="backgraound"></div>
    <div class="content">
        <div class="logo"></div>
        <?php
        $bus_no =  $_POST["bus_no"];
        $total_persons = $_POST["total_persons"];

        // set status (upcoming, cancelled, rejected, completed)
        $status = "upcoming";

        $search_bus = mysqli_query($conn, "SELECT * FROM `bus_schedule` WHERE `bno` = '$bus_no';");
        if (mysqli_num_rows($search_bus) > 0) {
            $result_list = mysqli_fetch_assoc($search_bus);
            $source = $result_list["source"];
            $destination = $result_list["destination"];
            $date_of_journey = $result_list["doj"];
            $total_seat = $result_list["seat"];
            $price = $result_list["price"];
        }

        // generate pnr number
        $gen_pnr_no = rand(111111, 999999);
        $total_price = $total_persons * $price;
        // insert into database - bkbus
        $insert_q = "INSERT INTO `bkbus`(`pnr`, `username`, `mail`, `bno`, `source`, `destination`, `seats`, `doj`, `price`, `tot_price`, `status`) VALUES ('$gen_pnr_no', '$username', '$email', '$bus_no', '$source', '$destination', '$total_persons', '$date_of_journey', '$price', '$total_price', '$status');";
        $insert_bkbus = mysqli_query($conn, $insert_q);

        if ($insert_bkbus == 1) {
            if ($total_persons == 1) {
                $name1 = $_POST["name1"];
                $age1 = $_POST["age1"];
                $gen1 = $_POST["gen1"];

                // insert into database - pax_details
                $insert_pax_details = mysqli_query($conn, "INSERT INTO `pax_details`(`pnr`, `name1`, `age1`, `gen1`) VALUES ('$gen_pnr_no','$name1','$age1','$gen1')");
            }
            if ($total_persons == 2) {
                $name1 = $_POST["name1"];
                $age1 = $_POST["age1"];
                $gen1 = $_POST["gen1"];
                $name2 = $_POST["name2"];
                $age2 = $_POST["age2"];
                $gen2 = $_POST["gen2"];

                // insert into database - pax_details
                $insert_pax_details = mysqli_query($conn, "INSERT INTO `pax_details`(`pnr`, `name1`, `age1`, `gen1`, `name2`, `age2`, `gen2`) VALUES ('$gen_pnr_no','$name1','$age1','$gen1','$name2','$age2','$gen2')");
            }
            if ($total_persons == 3) {
                $name1 = $_POST["name1"];
                $age1 = $_POST["age1"];
                $gen1 = $_POST["gen1"];
                $name2 = $_POST["name2"];
                $age2 = $_POST["age2"];
                $gen2 = $_POST["gen2"];
                $name3 = $_POST["name3"];
                $age3 = $_POST["age3"];
                $gen3 = $_POST["gen3"];

                // insert into database - pax_details
                $insert_pax_details = mysqli_query($conn, "INSERT INTO `pax_details`(`pnr`, `name1`, `age1`, `gen1`, `name2`, `age2`, `gen2`, `name3`, `age3`, `gen3`) VALUES ('$gen_pnr_no','$name1','$age1','$gen1','$name2','$age2','$gen2','$name3','$age3','$gen3')");
            }
        }


        if ($insert_bkbus == 1 && $insert_pax_details == 1) {
            echo "<h3> Thank you for Booking with us </h3>";
        ?>
            <div class="bus_info">
                <table>
                    <tr>
                        <td>PNR No.</td>
                        <td><?php echo $gen_pnr_no; ?></td>
                    </tr>
                    <tr>
                        <td>Bus No.</td>
                        <td><?php echo $bus_no; ?></td>
                    </tr>
                    <tr>
                        <td>Source</td>
                        <td><?php echo $source; ?></td>
                    </tr>
                    <tr>
                        <td>Destination</td>
                        <td><?php echo $destination; ?></td>
                    </tr>
                    <tr>
                        <td>Date of Journey</td>
                        <td><?php echo $date_of_journey; ?></td>
                    </tr>
                    <tr>
                        <td>Seat</td>
                        <td><?php echo $total_persons; ?></td>
                    </tr>
                    <tr>
                        <td>Total Price</td>
                        <td><?php echo $total_price; ?></td>
                    </tr>
                    <tr>
                        <td>Passenger Name</td>
                        <td><?php
                            if ($total_persons == 1) {
                                echo "<b>" . $name1 . "</b>";
                            }
                            if ($total_persons == 2) {
                                echo "<b>" . $name1 . "</b>";
                                echo ", <b>" . $name2 . "</b>";
                            }
                            if ($total_persons  == 3) {
                                echo "<b>" . $name1 . "</b>";
                                echo ", <b>" . $name2 . "</b>";
                                echo ", <b>" . $name3 . "</b>";
                            }
                            ?></td>
                    </tr>
                </table>
            </div>
        <?php
        } else {
            echo $conn->error;
        }
        ?>
    </div>
</body>

</html>