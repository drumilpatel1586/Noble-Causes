<?php
require("../config//db_connection.php");
require("../include/encrypt_decrypt.php");

$place_id = decrypt_number(32, $_POST["place_id"]);


if (isset($_POST["approved"])) {

    // echo $place_id.'=>';

    $days = $_POST['days'];
    echo $days . '=>';

    $sql = "SELECT * FROM sug_needy_place WHERE place_id = '$place_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $needy_street = $row['needy_street'];
    $needy_city = $row['needy_city'];
    $needy_zip = $row['needy_zip'];

    $sql = "INSERT INTO `needy_place`(`street`, `city`, `zip_code`,`days_to_reach`) VALUES ('$needy_street','$needy_city','$needy_zip','$days')";
    $result3 = mysqli_query($conn, $sql);
    echo "recored insert into `needy_place`=>";

    $sql = "SELECT `needy_place_id`,`zip_code` FROM `needy_place` WHERE `street`='$needy_street' AND `city`='$needy_city' AND `zip_code`='$needy_zip' ";
    $result4 = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result4);
    $package_id = $row['needy_place_id'];
    $zip_code = $row['zip_code'];

    $sql = "UPDATE `needy_place` SET `package_id` = $package_id WHERE `needy_place_id` =  $package_id";
    $result5 = mysqli_query($conn, $sql);
    echo "package id update from `needy_place`=>";

    $sql = "DELETE FROM `sug_needy_place`  WHERE `place_id` = '$place_id'";
    $result = mysqli_query($conn, $sql);
    echo "recored delete from `sug_needy_place`=>";

    $sql = "SELECT assigned_zip_code FROM `volunteers` WHERE assigned_zip_code = '$zip_code'";
    $result6 = mysqli_query($conn, $sql);

    if ($result3) {

        echo '<script>';
        echo 'alert("Needy Place Added");';
        echo 'window.location.href = "../include/needy_place"';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Fail to Add Needy Place");';
        echo 'window.location.href = "../include/needy_place"';
        echo '</script>';
    }


    // header("location: ../include/manage_needy_place");
}

if (isset($_POST["Delete"])) {

    $sql = "DELETE FROM `sug_needy_place`  WHERE `place_id` = $place_id";
    $result = mysqli_query($conn, $sql);

    echo '<script>';
    echo 'alert("Recored Deleted");';
    echo 'window.location.href = "../include/needy_place"';
    echo '</script>';
}
if (isset($_POST["delete"])) {

    $sql = "DELETE FROM `needy_place`  WHERE `needy_place_id` = $place_id";
    $result = mysqli_query($conn, $sql);

    echo '<script>';
    echo 'alert("Recored Deleted");';
    echo 'window.location.href = "../include/needy_place"';
    echo '</script>';
}
