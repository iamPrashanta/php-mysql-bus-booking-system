<?php
require_once "../conection.php";
$pnr_num =  $_POST["pnr_num"];
$delete_pax = mysqli_query($conn, "DELETE FROM `pax_details` WHERE `pnr` = '$pnr_num';");
$delete_bkbus = mysqli_query($conn, "DELETE FROM `bkbus` WHERE `pnr` = '$pnr_num';");

if ($delete_pax && $delete_bkbus) {
    echo "success";
} else {
    echo "error";
}
