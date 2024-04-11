<?php
session_start();
require_once "../conection.php";
if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    $username = $_SESSION["username"];
    $role = $_SESSION["role"];

    if ($role == "Admin" || $role == "admin") {
        $login = true;

        // get data from url
        if (isset($_GET["username"])) {
            $username = $_GET["username"];
        } else {
            $username = "";
        }
        if (isset($_GET["phone"])) {
            $phone_no = $_GET["phone"];
        } else {
            $phone_no = "";
        }
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
    <title>Edit User Profile</title>
    <link rel="stylesheet" href="../style/admin-feedback.css">
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
                <li><a href="./search-booking.php">Bookings</a></li>
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

            $get_bookings = mysqli_query($conn, "SELECT * FROM `userdetails` WHERE `role` = 'user' AND `username` = '$username';");

            if (mysqli_num_rows($get_bookings) > 0) {
                $result_list = mysqli_fetch_assoc($get_bookings);
                $pswd = $result_list["pswd"];
                $email = $result_list["email"];
                $phone_no = $result_list["phone_no"];

                // echo $pswd;
                // echo $email;
                // echo $phone_no;

            ?>
                <form action="edit-members2.php" method="post" id="update_profile_form">
                    <input type="hidden" name="username" id="username" value="<?php echo $username; ?>">
                    <table>
                        <tr>
                            <td>
                                <label for="">Password</label>
                            </td>
                            <td>:</td>
                            <td>
                                <input type="text" value="<?php echo $pswd; ?>" name="password" id="password">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Email</label>
                            </td>
                            <td>:</td>
                            <td><input type="text" value="<?php echo $email; ?>" name="email" id="email">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Phone Number</label>
                            </td>
                            <td>:</td>
                            <td><input type="text" value="<?php echo $phone_no; ?>" name="phone_no" id="phone_no"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><input type="submit" class="update_btn" value="Update Profile"></td>
                        </tr>
                    </table>
                </form>


            <?php
            } else {
                echo "No data found";
            }
            ?>
        </div>
    </div>
</body>

</html>