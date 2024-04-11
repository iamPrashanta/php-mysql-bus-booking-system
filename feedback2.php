<?php
if (isset($_POST["email"])) {
    session_start();
    require_once "./conection.php";
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
        $login = true;
    } else {
        $login = false;
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
    <link rel="stylesheet" href="./style/feedback2.css">
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
        <li><a href="./find-bus.php">Search Bus</a></li>
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
    <div class="content">
        <?php
        $no = 1;
        $email =  $_POST["email"];
        $f_name = $_POST["f_name"];
        $phone = $_POST["phone"];
        $remark = $_POST["remark"];
        $status = "Pending";

        // search bus
        $submit_feedback = mysqli_query($conn, "INSERT INTO `feedback`(`email`, `fname`, `phone`, `remark`, `status`) VALUES ('$email', '$f_name', '$phone', '$remark', '$status');");
        if ($submit_feedback) {
            echo "<h2>Your Feedback Update Successfully</h2>";
        } else {
            echo "Error" . $conn->error;
        }
        ?>
        <div class="logo"></div>
    </div>
</body>

</html>