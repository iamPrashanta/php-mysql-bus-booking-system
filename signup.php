<?php
session_start();
require_once "./conection.php";
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $login = true;
    if (isset($_GET["bno"])) {
        $bus_no = $_GET["bno"];
        header("location:./booking1.php?bno=$bus_no");
        exit;
    } else {
        header("location:./");
        exit;
    }
} else {
    $login = false;
    if (isset($_GET["bno"])) {
        $bus_no = $_GET["bno"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/login.css?id=10?id=10">

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
        <h2>Create new Account</h2>
        <?php
        if (isset($_POST["signup"])) {
            $user_name = $_POST['user_name'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            echo "INSERT INTO `userdetails`(`username`, `pswd`, `role`, `phone_no`, `email`) VALUES ('$user_name', '$password', 'user', '$phone', '$email');";
            $create_account = mysqli_query($conn, "INSERT INTO `userdetails`(`username`, `pswd`, `role`, `phone_no`, `email`) VALUES ('$user_name', '$password', 'user', '$phone', '$email');");

            if ($create_account) {
                echo "<h3 style='text-align:center;'>Account Created Successful";
                echo "<a href='./login.php'>Go to Login page</a>";
                echo "</h3>";
                exit;
            } else {
                echo "<h3 style='text-align:center;'>Login Failed to Create New Account</h3>";
                exit;
            }
        }
        ?>
        <form method="POST">
            <div class="input-cont">
                <input type="text" name="user_name" required value="">
                <label>Full name</label>
                <div class="border1"></div>
            </div>
            <div class="input-cont">
                <input type="number" name="phone" required value="">
                <label>Phone</label>
                <div class="border1"></div>
            </div>
            <div class="input-cont">
                <input type="email" name="email" required value="">
                <label>Email</label>
                <div class="border1"></div>
            </div>
            <div class="input-cont">
                <input type="password" name="password" required value="">
                <label>Password</label>
                <div class="border2"></div>
            </div>
            <div class="clear"></div>
            <input type="submit" name="signup" value="Sign Up">
        </form>
        <a href="./login.php">Log In Now</a>
        <a href="./admin-login.php">Admin Panel</a>
    </div>
</body>

</html>