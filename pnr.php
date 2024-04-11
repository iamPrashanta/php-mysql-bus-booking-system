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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/pnr.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <header>
        <li><a href="./">Search Bus</a></li>
        <li><a href="./feedback.php">Feedback</a></li>
        <?php
        if ($login) {
            echo '<li><a href="./logout.php">Logout</a></li>';
        } else {
            echo '<li><a href="./login.php">Login</a></li>';
        }
        ?>
    </header>
    <div class="photo"></div>
    <div class="content">
        <div class="background"></div>
        <div class="userform">
            <form id="search_pnr_form" name="search_pnr_form" method="post" action="">
                <table>
                    <tr>
                        <td><label for="pnr">PNR :</label></td>
                        <td><input type="number" name="pnr_num" id="pnr_num" value="" placeholder="PNR Number"></td>
                    </tr>
                </table>

                <input type="submit" name="search_pnr" id="search_pnr" value="Search Details">


            </form>
        </div>
        <?php
        if (isset($_POST["search_pnr"])) {
            $pnr_num = $_POST["pnr_num"];
            if (strlen($pnr_num) == 6) {
                $search_q = mysqli_query($conn, "SELECT *
            FROM `bkbus`
            JOIN `pax_details`
            ON `bkbus`.`pnr` = `pax_details`.`pnr`
            WHERE `bkbus`.`pnr` = '$pnr_num';");
                if (mysqli_num_rows($search_q) > 0) {
                    $pnr_data = mysqli_fetch_assoc($search_q);
                    $username = $pnr_data["username"];
                    $mail = $pnr_data["mail"];
                    $bus_no = $pnr_data["bno"];
                    $source = $pnr_data["source"];
                    $destination = $pnr_data["destination"];
                    $seats = $pnr_data["seats"];
                    $date_of_journey = $pnr_data["doj"];
                    $price = $pnr_data["price"];
                    $total_price = $pnr_data["tot_price"];
                    $status = $pnr_data["status"];

                    $name1 = $pnr_data["name1"];
                    $age1 = $pnr_data["age1"];
                    $gen1 = $pnr_data["gen1"];

                    $name2 = $pnr_data["name2"];
                    $age2 = $pnr_data["age2"];
                    $gen2 = $pnr_data["gen2"];

                    $name3 = $pnr_data["name3"];
                    $age3 = $pnr_data["age3"];
                    $gen3 = $pnr_data["gen3"];

                    echo "<div class='background1'></div>
                        <div class='result'>
                        <table>
                        <tr>
                        <td>PNR :</td>
                        <td>$pnr_num</td>
                        </tr>
                        <tr>
                        <td>UserName :</td>
                        <td>$username</td>
                        </tr>
                        <tr>
                        <td>Email :</td>
                        <td>$mail</td>
                        </tr>
                        <tr>
                        <td>bus_no :</td>
                        <td>$bus_no</td>
                    </tr>
                    <tr>
                        <td>source :</td>
                        <td>$source</td>
                    </tr>
                    <tr>
                        <td>destination :</td>
                        <td>$destination</td>
                    </tr>
                    <tr>
                        <td>seats :</td>
                        <td>$seats</td>
                    </tr>
                    <tr>
                        <td>date_of_journey :</td>
                        <td>$date_of_journey</td>
                    </tr>
                    <tr>
                        <td>total_price :</td>
                        <td>$total_price</td>
                    </tr>
                    <tr>
                        <td>status :</td>
                        <td>$status</td>
                    </tr>";
                    echo "</table>";
                    echo "<table>";

                    if ($seats == 1) {
                        echo "<tr>
                        <td>Passenger 1 :</td>
                        <td>$name1</td>
                        <td>$age1,$gen1</td>
                        </tr>
                        ";
                    } else if ($seats == 2) {
                        echo "<tr>
                    <td>Passenger 1 :</td>
                    <td>$name1</td>
                    <td>$age1,$gen1</td>
                    </tr>
                    <td>Passenger 2 :</td>
                    <td>$name2</td>
                    <td>$age2,$gen2</td>
                    </tr>
                    ";
                    } else if ($seats == 3) {
                        echo "<tr>
                    <td>Passenger 1 :</td>
                    <td>$name1</td>
                    <td>$age1,$gen1</td>
                    </tr>
                    <td>Passenger 2 :</td>
                    <td>$name2</td>
                    <td>$age2,$gen2</td>
                    </tr>
                    <td>Passenger 3 :</td>
                    <td>$name3</td>
                    <td>$age3,$gen3</td>
                    </tr>
                    ";
                    }
                    echo "<tr>
                        <td>Acton :</td>
                        <td><p id='status_of_booking'><button id='cancel_btn' data-pnr='$pnr_num'>Cancel Booking</button></p></td>
                    </tr></table></div>
                    </div>";
                } else {
                    echo "<div class='background1'></div>
                    <div class='result'>No data found</div>
                    </div>";
                }
            } else {
                echo "<div class='background1'></div>
                <div class='result'>Wrong pnr number</div>
                </div>";
            }
        }
        ?>
        <script>
            $("#cancel_btn").on("click", function() {
                let pnr_num = $(this).data("pnr");
                console.log(pnr_num);
                $.ajax({
                    type: 'POST',
                    url: './js/cancel_bokings.php',
                    data: {
                        pnr_num: pnr_num
                    },
                    // beforeSend: function() {
                    //     $("#loader").show();
                    // },
                    success: function(response) {
                        // $("#loader").hide();
                        if (response == "success") {
                            console.log("Your Booking was Canceled..");
                            $("#status_of_booking").html("<td conspan='3'>Your Booking was Canceled..</td>");
                        } else {
                            console.log(response);
                            $("#status_of_booking").html(`<td conspan='3'> ${response} , try again</td>`);
                        }
                    },
                    error: function() {
                        //$("#loader").show();
                        alert("error occured");
                    }
                });

            });
        </script>
</body>

</html>