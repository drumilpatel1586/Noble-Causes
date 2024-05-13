<?php
require_once('../config/db_connection.php');
require_once('../include/encrypt_decrypt.php');



if (isset($_POST['pickedupbtn'])) {
    $food_id = decrypt_number(32, $_POST['f_id']);
    echo $food_id . '=>';
    $d_u_id = decrypt_number(32, $_POST['u_id']);
    echo $d_u_id . '=>';

    $sql73 = "SELECT `freq_of_donation` FROM `approved_food_req` WHERE `approved_food_req`.`food_id`=$food_id ";
    $result73 = mysqli_query($conn, $sql73);
    $row73 = mysqli_fetch_array($result73);
    $freq = $row73['freq_of_donation'];
    echo $freq;

    if ($freq != 'One time') {

        //adding data into picked up
        $sql6 = "SELECT * FROM `donate_food` WHERE `donate_food`.`food_id` = $food_id";
        $result6 = mysqli_query($conn, $sql6);
        $row6 = mysqli_fetch_array($result6);
        $user_id = $row6['user_id'];
        $freq = $row6['freq_of_donation'];
        $donate_to = $row6['donate_to'];
        $food_type = $row6['food_type'];
        $validity = $row6['validity'];
        $status = $row6['status'];
        $time = $row6['time'];
        $specifications = $row6['specifications'];
        $pickup_street = $row6['pickup_street'];
        $pickup_city = $row6['pickup_city'];
        $pickup_zip_code = $row6['pickup_zip_code'];
        $currentDateTime = date('Y-m-d H:i:s');
        //selecting volunteer data
        $sql8 = "SELECT * FROM `approved_food_req` WHERE `approved_food_req`.`food_id` = '$food_id'";
        $result8 = mysqli_query($conn, $sql8);
        $row8 = mysqli_fetch_array($result8);
        $v_id = $row8['v_id'];
        $v_name = $row8['v_name'];

        $sql = "INSERT INTO `pickedup_food`(`food_id`, `user_id`, `v_id`, `v_name`, `freq_of_donation`, `donate_to`, `food_type`, `pickup_street`, `pickup_city`, `pickup_zip_code`, `donated_time`, `validity`, `specifications`, `status`) VALUES ('$food_id','$user_id','$v_id','$v_name',' $freq','$donate_to','$food_type',' $pickup_street',' $pickup_city','$pickup_zip_code','$time','$validity',' $specifications','picked_up')";
        $result = mysqli_query($conn, $sql);
        echo 'data inserted into picked up';

        //updating date of donated up
        // date updating
        $currentDateAndTime = date('Y-m-d H:i:s');
        $date = new DateTime($currentDateAndTime);
        $date->modify('+1 day');
        $updatedDonatedDate = $date->format('Y-m-d H:i:s');
        echo $updatedDonatedDate;

        $sql111 = "UPDATE `approved_food_req` SET `pick_time`='$updatedDonatedDate'
        ,`time`='$updatedDonatedDate' 
         WHERE `approved_food_req`.`food_id`=$food_id";
        $result111 = mysqli_query($conn, $sql111);
        echo 'date updated in approved_food_req';

        //updating status going_to => approved
        $sql12 = "UPDATE `approved_food_req` SET `status` = 'approved' WHERE `approved_food_req`.`food_id` = $food_id";
        $result12 = mysqli_query($conn, $sql12);
        echo "status updated in afr";

        //chacking user pre donated
        $sql33 = "SELECT * FROM `user_donation_quantity_record` WHERE `user_id`=$user_id";
        $result33 = mysqli_query($conn, $sql33);
        $row33 = mysqli_fetch_array($result33);

        if ($result33->num_rows > 0) {
            $sql4 = "UPDATE `user_donation_quantity_record` SET `donation_quantity`=`donation_quantity`+1 WHERE `user_donation_quantity_record`.`user_id`='$user_id'  ";
            $result4 = mysqli_query($conn, $sql4);
            echo 'q updated';
        } else {

            $sql2 = "INSERT INTO `user_donation_quantity_record`(`user_id`) VALUES ('$user_id')";
            $result2 = mysqli_query($conn, $sql2);
            echo 'q inserted';
        }
        header('location:../manage_food_donation');
    } else {

        $sql12 = "UPDATE `donate_food` SET `status` = 'pickuped' WHERE `donate_food`.`food_id` = $food_id";
        $result12 = mysqli_query($conn, $sql12);
        echo "status updated in afr";

        // adding data into pickedup_food

        $sql6 = "SELECT * FROM `donate_food` WHERE `donate_food`.`food_id` = $food_id";
        $result6 = mysqli_query($conn, $sql6);
        $row6 = mysqli_fetch_array($result6);
        $user_id = $row6['user_id'];
        $freq = $row6['freq_of_donation'];
        $donate_to = $row6['donate_to'];
        $food_type = $row6['food_type'];
        $validity = $row6['validity'];
        $status = $row6['status'];
        $time = $row6['time'];
        $newTime = date('Y-m-d H:i:s', strtotime($time . ' +1 day'));
        $specifications = $row6['specifications'];
        $pickup_street = $row6['pickup_street'];
        $pickup_city = $row6['pickup_city'];
        $pickup_zip_code = $row6['pickup_zip_code'];
        //selecting volunteer data
        $sql8 = "SELECT * FROM `approved_food_req` WHERE `approved_food_req`.`food_id` = '$food_id'";
        $result8 = mysqli_query($conn, $sql8);
        $row8 = mysqli_fetch_array($result8);
        $v_id = $row8['v_id'];
        $v_name = $row8['v_name'];

        $sql = "INSERT INTO `pickedup_food`(`food_id`, `user_id`, `v_id`, `v_name`, `freq_of_donation`, `donate_to`, `food_type`, `pickup_street`, `pickup_city`, `pickup_zip_code`, `donated_time`, `validity`, `specifications`, `status`) VALUES ('$food_id','$user_id','$v_id','$v_name',' $freq','$donate_to','$food_type',' $pickup_street',' $pickup_city','$pickup_zip_code','$time','$validity',' $specifications','picked_up')";
        $result = mysqli_query($conn, $sql);
        echo 'data inserted into picked up';

        //chacking user pre donated
        $sql33 = "SELECT * FROM `user_donation_quantity_record` WHERE `user_id`=$user_id";
        $result33 = mysqli_query($conn, $sql33);
        $row33 = mysqli_fetch_array($result33);

        if ($result33->num_rows > 0) {
            $sql4 = "UPDATE `user_donation_quantity_record` SET `donation_quantity`=`donation_quantity`+1 WHERE `user_donation_quantity_record`.`user_id`='$user_id'  ";
            $result4 = mysqli_query($conn, $sql4);
            echo 'q updated';
        } else {

            $sql2 = "INSERT INTO `user_donation_quantity_record`(`user_id`) VALUES ('$user_id')";
            $result2 = mysqli_query($conn, $sql2);
            echo 'q inserted';
        }

        $sql5 = "DELETE FROM`approved_food_req` WHERE `approved_food_req`.`food_id`=$food_id ";
        $result5 = mysqli_query($conn, $sql5);
        echo "RECORD DELETED in afr";

        header('location:../manage_food_donation');
    }
}

if (isset($_POST['cancel'])) {
    $food_id = decrypt_number(32, $_POST['f_id']);
    echo $food_id . '=>';
    $d_u_id = decrypt_number(32, $_POST['u_id']);
    echo $d_u_id . '=>';

    $sql = "UPDATE `approved_food_req` SET `status`='cancelled' WHERE `approved_food_req`.`food_id`=$food_id";
    $result = mysqli_query($conn, $sql);
    echo 'status cancelled in afr';
    header('location:../manage_food_donation');
}

if (isset($_POST['goingto'])) {

    $food_id = decrypt_number(32, $_POST['food_id']);
    $d_u_id = decrypt_number(32, $_POST['user_id']);

    $sql4 = "SELECT * FROM `approved_food_req` WHERE `status`='going_to'";
    $result4 = mysqli_query($conn, $sql4);
    if ($result4->num_rows > 0) {

        echo ' <script> if (confirm("You must have to pickedup first previously selected donation")) {
            console.log("yes");
            window.location = `../manage_food_donation`;

        }else{
            console.log("cancelled");
            window.location = `../manage_food_donation`;

        }</script>';
    } else {

        $e_food_id = decrypt_number(32, $_POST['food_id']);
        echo $e_food_id;
        // $id = $_POST['food_id'];
        // echo $id;

        $sql = "UPDATE `approved_food_req` SET `status`='going_to' WHERE `approved_food_req`.`food_id`=$e_food_id";
        $result = mysqli_query($conn, $sql);
        // require('../goingtomailsender.php');
        echo 'mail sended';
        header('location:../manage_food_donation');
    }
}
