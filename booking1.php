<?php
session_start();
require_once "./conection.php";
if (isset($_GET["bno"])) {
    $bus_no = $_GET["bno"];
    if (!empty($bus_no)) {
        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
            $login = true;
        } else {
            $login = false;
            header("location: ./login.php?bno=$bus_no");
            exit;
        }

        // get bus details
        $search_bus = mysqli_query($conn, "SELECT * FROM `bus_schedule` WHERE `bno` = '$bus_no';");
        if (mysqli_num_rows($search_bus) > 0) {
            $result_list = mysqli_fetch_assoc($search_bus);
            $bus_no = $result_list["bno"];
            $source = $result_list["source"];
            $destination = $result_list["destination"];
            $date_of_journey = $result_list["doj"];
            $total_seat = $result_list["seat"];
            $price = $result_list["price"];
        } else {
            header("location: ./");
            exit;
        }
    } else {
        header("location: ./");
        exit;
    }
} else {
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/booking1.css">

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
    <div class="backgraound"></div>
    <div class="content">
        <div class="bus_info">
            <table>
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
                    <td><?php echo $total_seat; ?></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><?php echo $price; ?></td>
                </tr>
            </table>
        </div>
        <div class="userform">
            <form id="user_info" name="user_info" method="POST" action="booking2.php">
                <table>
                    <tr>
                        <td><input type="hidden" name="bus_no" value="<?php echo $bus_no; ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of Persons :</td>
                        <td>
                            <select name="total_persons" id="total_persons" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="seet_choice" value="Next">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>