<?php
session_start();
require_once "./conection.php";
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $login = true;
    header("location:./admin-panel/");
    exit;
} else {
    $login = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/login.css">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <header>
            <div class="logo"></div>
            <nav>
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
            </nav>
        </header>
    </div>
    <div class="log">
        <h2>Admin Panel Login</h2>
        <?php
        if (isset($_POST["login"])) {
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $verify_login = mysqli_query($conn, "SELECT * FROM `userdetails` WHERE `phone_no` = '$phone' AND `pswd` = '$password' AND `role` = 'admin';");
            if (mysqli_num_rows($verify_login) > 0) {
                $get_user_data = mysqli_fetch_assoc($verify_login);
                $member_username = $get_user_data["username"];

                $_SESSION["username"] = $member_username;
                $_SESSION["role"] = "admin";

                echo "<h3 style='text-align:center;'>Login Successful";
                echo "</h3>";
                echo "<a href='./admin-panel/'>Go to Admin Panel</a>";
                exit;
            } else {
                echo "<h3 style='text-align:center;'>Login Failed";
                echo "</h3>";
                exit;
            }
        }
        ?>
        <form method="POST">
            <div class="input-cont">
                <input type="text" name="phone" required value="">
                <label>Phone</label>
                <div class="border1"></div>
            </div>
            <div class="input-cont">
                <input type="password" name="password" required value="">
                <label>Password</label>
                <div class="border2"></div>
            </div>
            <div class="clear"></div>
            <input type="submit" name="login" value="Log In">
        </form>
        <a href="./login.php">User Log In</a>
    </div>
</body>

</html>