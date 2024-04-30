<?php
require("../config//db_connection.php");
require("../include/encrypt_decrypt.php");

if (isset($_POST["approve"])) {
    $food_id = decrypt_number(32,$_POST['food_id']);
    // $sql = "UPDATE `donate_food` SET `status` = 'approved' WHERE `donate_food`.`food_id` = $food_id";
    // $result = mysqli_query($conn, $sql);
    // echo "data aprroved";

    //adding data in to approved_food_req
    $sql1 = "SELECT * FROM `donate_food` WHERE `donate_food`.`food_id` = $food_id";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);
    $user_id = $row1['user_id'];
    $freq = $row1['freq_of_donation'];
    $donate_to = $row1['donate_to'];
    $food_type = $row1['food_type'];
    $validity = $row1['validity'];
    $status = $row1['status'];
    $time = $row1['time'];
    $specifications = $row1['specifications'];
    $pickup_street = $row1['pickup_street'];
    $pickup_city = $row1['pickup_city'];
    $pickup_zip_code = $row1['pickup_zip_code'];

    $sql3 = "SELECT `v_id`, `v_name` FROM `volunteers`  WHERE `volunteers`.`assigned_zip_code` = '$pickup_zip_code'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3->num_rows > 0) {
        $sql34 = "SELECT `v_id`, `v_name` FROM `volunteers`  WHERE `volunteers`.`assigned_street` = '$pickup_street'";
        $result34 = mysqli_query($conn, $sql34);
        if ($result34->num_rows > 0) {
            echo 'street found_';
            $row34 = mysqli_fetch_array($result34);
            $v_id = $row34['v_id'];
            $v_name = $row34['v_name'];
            // adding volunteer requierd area
            $sql = "INSERT INTO `approved_food_req`(`food_id`, `user_id`, `v_id`, `v_name`, `freq_of_donation`, `donate_to`, `food_type`, `pickup_street`, `validity`, `specifications`, `status`, `time`, `pickup_city`, `pickup_zip_code`) VALUES ('$food_id','$user_id','$v_id','$v_name','$freq','$donate_to','$food_type','$pickup_street','$validity','$specifications','approved','$time','$pickup_city','$pickup_zip_code')";
            $result = mysqli_query($conn, $sql);
            echo 'data inserted_';

            // changing status 
            $sql = "UPDATE `donate_food` SET `status` = 'approved' WHERE `donate_food`.`food_id` = $food_id";
            $result = mysqli_query($conn, $sql);
            echo 'status approved';
            header("location: ../include/food_donate_req");
        } else {
            echo 'zip found_';
            $row3 = mysqli_fetch_array($result3);
            $v_id = $row3['v_id'];
            $v_name = $row3['v_name'];

            $sql = "INSERT INTO `approved_food_req`(`food_id`, `user_id`, `v_id`, `v_name`, `freq_of_donation`, `donate_to`, `food_type`, `pickup_street`, `validity`, `specifications`, `status`, `time`, `pickup_city`, `pickup_zip_code`) VALUES ('$food_id','$user_id','$v_id','$v_name','$freq','$donate_to','$food_type','$pickup_street','$validity','$specifications','approved','$time','$pickup_city','$pickup_zip_code')";
            $result = mysqli_query($conn, $sql);
            echo 'data inserted_';

            // changing status 
            $sql = "UPDATE `donate_food` SET `status` = 'approved' WHERE `donate_food`.`food_id` = $food_id";
            $result = mysqli_query($conn, $sql);
            echo 'status approved';
            header("location: ../include/food_donate_req");
        }
    } else {
        echo 'no found_';
        // adding volunteer requierd area
        $sql11 = "SELECT * FROM v_required_area WHERE `v_required_zip_code`=$pickup_zip_code";
        $result11 = mysqli_query($conn, $sql11);

        if ($result11->num_rows > 0) {

            $sql = "UPDATE `v_required_area` SET `total_user_req`=`total_user_req`+1 WHERE `v_required_zip_code`=$pickup_zip_code" ;
            $result = mysqli_query($conn, $sql);

            // changing status pendding-volunteer_requierd
            $sql = "UPDATE `donate_food` SET `status` = 'pendding:v' WHERE `donate_food`.`food_id` = $food_id";
            $result = mysqli_query($conn, $sql);

            header("location: ../include/food_donate_req");

        } else {

            $sql = "INSERT INTO `v_required_area`(`food_id`, `v_required_street`, `v_required_city`, `v_required_zip_code`, `v_requsted_user_id`) VALUES ('$food_id','$pickup_street','$pickup_city','$pickup_zip_code','$user_id')";
            $result = mysqli_query($conn, $sql);

            // changing status pendding-volunteer_requierd
            $sql = "UPDATE `donate_food` SET `status` = 'pendding:v' WHERE `donate_food`.`food_id` = $food_id";
            $result = mysqli_query($conn, $sql);
            // header("location: ../include/food_donate_req");

            header("location: ../include/volunteer_required_area");
        }
    }
}


if (isset($_POST["delete"])) {
    $food_id = decrypt_number(32,$_POST['food_id']);
    echo $food_id;

    $sql = "UPDATE `donate_food` SET `status` = 'cancelled' WHERE `donate_food`.`food_id` = $food_id";
    $result = mysqli_query($conn, $sql);
    header("location: ../include/food_donate_req");
}

if (isset($_POST["Delete"])) {
    $food_id = decrypt_number(32, $_POST["food_id"]);
    echo $food_id;
    $sql = "DELETE FROM `approved_food_req`  WHERE `food_id` = $food_id";
    $result = mysqli_query($conn, $sql);

    $sql = "UPDATE `donate_food` SET `status` = 'cancelled' WHERE `donate_food`.`food_id` = $food_id";
    $result = mysqli_query($conn, $sql);
    echo "data cancelled by you";

    header("location: ../include/cancelled_food_pickup");
}
