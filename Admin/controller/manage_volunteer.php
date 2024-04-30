<?php
require("../config//db_connection.php");
require("../include/encrypt_decrypt.php");

if (isset($_POST["approved"])) {
    $v_id = decrypt_number(16,$_POST["v_id"]);
    echo $v_id;
    $sql = "DELETE FROM `volunteers`  WHERE `volunteers`.`v_id` = $v_id";
    $result = mysqli_query($conn, $sql);
    header("location: ../include/manage_Volunteer");
}

if (isset($_POST["Delete"])) {
    $v_required_id = decrypt_number(32,$_POST["v_required_id"]);
    echo $v_required_id;
    $sql = "DELETE FROM `v_required_area`  WHERE `v_required_area`.`v_required_id` = $v_required_id";
    $result = mysqli_query($conn, $sql);
    echo'v_required_ deleted';
    $sql2 = "UPDATE `donate_food` SET `status`='cancelled'";
    $result2 = mysqli_query($conn , $sql2);
    echo'v_required_ cancelled';
    header("location: ../include/volunteer_required_area");

}

if (isset($_POST["delete"])) {
    $v_id = decrypt_number(16,$_POST["v_id"]);
    echo $v_id;
    $sql = "DELETE FROM `volunteers`  WHERE `volunteers`.`v_id` = $v_id";
    $result = mysqli_query($conn, $sql);
    header("location: ../include/manage_Volunteer");
}