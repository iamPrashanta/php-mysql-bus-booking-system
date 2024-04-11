<?php
session_start();
require_once "./conection.php";
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $login = true;
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
    <title>Document</title>
    <link rel="stylesheet" href="./style/feedback.css">
</head>

<body>
    <header>
        <li><a href="./">Home</a></li>
        <li><a href="./pnr.php">PNR Search & Cancellaton</a></li>
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
    <div class="background"></div>
    <div class="content">
        <h2>Feedback Form</h2>
        <form action="feedback2.php" method="POST">
            <table>
                <tr>
                    <td>Email :</td>
                    <td><input type="email" name="email" id="email" required></td>
                </tr>
                <tr>
                    <td>Full Name : </td>
                    <td><input type="text" name="f_name" id="f_name" required></td>
                </tr>
                <tr>
                    <td>Phone no : </td>
                    <td><input type="number" name="phone" id="phone" required></td>
                </tr>
                <tr>
                    <td>Feedback Note : </td>



            </table>
            <textarea id="remark" name="remark" rows="5" cols="25" required maxlength="50"></textarea>


            <button type="submit" name="submit_feedback">Submit</button>
        </form>
    </div>
</body>

</html>