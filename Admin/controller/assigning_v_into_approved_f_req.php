<?php
require_once('../config/db_connection.php');
 //adding approved food req into approved_food_req

 $food_id= $_GET['fid'];

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

 $sql8 = "SELECT * FROM `volunteers` WHERE `volunteers`.`assigned_street` = '$pickup_street'";
 $result8 = mysqli_query($conn, $sql8);
 $row8 = mysqli_fetch_array($result8);
 $v_id = $row8['v_id'];
 echo $v_id;
 $v_name = $row8['v_name'];
 echo $v_name;

 $sql7 = "INSERT INTO `approved_food_req`(`food_id`, `user_id`, `v_id`, `v_name`, `freq_of_donation`, `donate_to`, `food_type`, `pickup_street`, `validity`, `specifications`, `status`, `time`, `pickup_city`, `pickup_zip_code`) VALUES ('$food_id','$user_id','$v_id','$v_name','$freq','$donate_to','$food_type','$pickup_street','$validity','$specifications','approved','$time','$pickup_city','$pickup_zip_code') ";
 $result7 = mysqli_query($conn, $sql7);
 echo 'all completed ';

 header("location:../include/volunteer_required_area");




