<?php
require("../config//db_connection.php");
require("../include/encrypt_decrypt.php");

if (isset($_POST["delete"])) {
    $user_id = decrypt_number(32,$_POST["user_id"]);
    echo $user_id;
    $sql = "DELETE FROM `user_login`  WHERE `user_login`.`user_id` = $user_id";
    $result = mysqli_query($conn, $sql);
    $sql2 = "DELETE FROM `approved_food_req`  WHERE `approved_food_req`.`user_id` = $user_id";
    $result2 = mysqli_query($conn, $sql2);
    $sql3 = "DELETE FROM `approved_book_req`  WHERE `approved_book_req`.`user_id` = $user_id";
    $result3 = mysqli_query($conn, $sql3);
    $sql4 = "DELETE FROM `donate_food`  WHERE `donate_food`.`user_id` = $user_id";
    $result4 = mysqli_query($conn, $sql4);
    $sql5 = "DELETE FROM `donate_book`  WHERE `donate_book`.`user_id` = $user_id";
    $result5 = mysqli_query($conn, $sql5);
    header("location: ../include/manage_user");
}
