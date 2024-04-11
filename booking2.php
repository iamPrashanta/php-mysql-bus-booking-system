<?php
session_start();
require_once "./conection.php";
$username = $_SESSION["username"];
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/booking2.css">
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
    <div class="background"></div>
    <div class="content">
        <h2>Enter Passenger Details</h2>
        <?php
        $bus_no =  $_POST["bus_no"];
        $total_persons = $_POST["total_persons"];

        $search_bus = mysqli_query($conn, "SELECT * FROM `bus_schedule` WHERE `bno` = '$bus_no';");
        if (mysqli_num_rows($search_bus) > 0) {
            $result_list = mysqli_fetch_assoc($search_bus);
            $bus_no = $result_list["bno"];
            $source = $result_list["source"];
            $destination = $result_list["destination"];
            $date_of_journey = $result_list["doj"];
            $total_seat = $result_list["seat"];
            $price = $result_list["price"];
        }
        ?>
        <div class="pax_from">
            <form action="booking3.php" method="POST">
                <table>
                    <input type="hidden" name="bus_no" value="<?php echo $bus_no; ?>">
                    <input type="hidden" name="total_persons" value="<?php echo $total_persons; ?>">
                    <?php
                    if ($total_persons == 1) {
                    ?>
                        <tr>
                            <td>Passenger 1</td>
                            <td><input class="name" type="text" name="name1" value="" required></td>
                            <td>Age</td>
                            <td><input class="age" type="number" name="age1" value="" required></td>
                            <td>Gender</td>
                            <td>
                                <select name="gen1" id="gen1" required>
                                    <option value="">select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </td>
                        </tr>
                    <?php
                    }
                    if ($total_persons == 2) {
                    ?>
                        <tr>
                            <td>Passenger 1</td>
                            <td><input class="name" type="text" name="name1" value="" required></td>
                            <td>Age</td>
                            <td><input class="age" type="number" name="age1" value="" required></td>
                            <td>Gender</td>
                            <td>
                                <select name="gen1" id="gen1" required>
                                    <option value="">select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Passenger 2</td>
                            <td><input class="name" type="text" name="name2" value="" required></td>
                            <td>Age</td>
                            <td><input class="age" type="number" name="age2" value="" required></td>
                            <td>Gender</td>
                            <td>
                                <select name="gen2" id="gen2" required>
                                    <option value="">select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </td>
                        </tr>
                    <?php
                    }
                    if ($total_persons == 3) {
                    ?>
                        <tr>
                            <td>Passenger 1</td>
                            <td><input class="name" type="text" name="name1" value="" required></td>
                            <td>Age</td>
                            <td><input class="age" type="number" name="age1" value="" required></td>
                            <td>Gender</td>
                            <td>
                                <select name="gen1" id="gen1" required>
                                    <option value="">select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Passenger 2</td>
                            <td><input class="name" type="text" name="name2" value="" required></td>
                            <td>Age</td>
                            <td><input class="age" type="number" name="age2" value="" required></td>
                            <td>Gender</td>
                            <td>
                                <select name="gen2" id="gen2" required>
                                    <option value="">select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Passenger 3</td>
                            <td><input class="name" type="text" name="name3" value="" required></td>
                            <td>Age</td>
                            <td><input class="age" type="number" name="age3" value="" required></td>
                            <td>Gender</td>
                            <td>
                                <select name="gen3" id="gen3" required>
                                    <option value="">select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <input class="btn" type="submit" name="submit_form" value="Submit Details">
            </form>
        </div>
    </div>
</body>

</html>