<?php
require_once('../config/db_connection.php');
require_once('../include/encrypt_decrypt.php');

if (isset($_POST['goingto'])) {
    echo 'goingto =>';

    $package_id = decrypt_number(32, $_POST['e_package_id']);
    echo 'goingto delivered  ' . $package_id . ' package  =>';

    $sql4 = "SELECT * FROM `verified_food_at_w` WHERE `status`='going_to'";
    $result4 = mysqli_query($conn, $sql4);
    if ($result4->num_rows > 0) {

        echo ' <script> if (confirm("You must have to pickedup first previously selected donation")) {
            console.log("yes");
            window.location = `../food_delivery`;

        }else{
            console.log("cancelled");
            window.location = `../food_delivery`;

        }</script>';
    } else {

        $sql = "UPDATE `verified_food_at_w` SET `status`='going_to' WHERE `verified_food_at_w`.`package_id`=$package_id";
        $result = mysqli_query($conn, $sql);
        echo 'status updated into verified_food_at_w =>';

        header('location:../food_delivery');
    }
}

if (isset($_POST['delivered'])) {

    $package_id = decrypt_number(32, $_POST['e_package_id']);
    echo 'going to deliver ' . $package_id . ' package =>';

    $sql = "SELECT `food_id`, `needy_place_id` FROM `verified_food_at_w` WHERE `package_id` = '$package_id' AND `status`='going_to' ";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $food_id = $row['food_id'];
        $needy_place_id = $row['needy_place_id'];

        // Retrieve needy place details
        $needy_sql = "SELECT `street`, `city`, `zip_code` FROM `needy_place` WHERE `needy_place_id`= '$needy_place_id'";
        $needy_result = mysqli_query($conn, $needy_sql);
        $needy_row = mysqli_fetch_array($needy_result);
        $street = $needy_row['street'];
        $city = $needy_row['city'];
        $zip_code = $needy_row['zip_code'];

        // Update donate_food table
        $update_sql = "UPDATE `donate_food` SET `status`='delivered', `delivered_place`='$street, $city, $zip_code' WHERE `food_id`='$food_id'";
        $update_result = mysqli_query($conn, $update_sql);

        if ($update_result) {
            echo 'Status updated for food_id ' . $food_id . ' in donate_food table<br>';
        } else {
            echo 'Error updating status for food_id ' . $food_id . '<br>';
        }

        $set_sql = "UPDATE `needy_place` SET `total_donation`=0 WHERE `needy_place_id`=$needy_place_id";
        $set_result = mysqli_query($conn, $set_sql);

        // Delete from verified_food_at_w table
        $delete_sql = "DELETE FROM `verified_food_at_w` WHERE `food_id` = '$food_id'";
        $delete_result = mysqli_query($conn, $delete_sql);

        if ($delete_result) {
            echo 'Deleted from verified_food_at_w for food_id ' . $food_id . '<br>';
        } else {
            echo 'Error deleting from verified_food_at_w for food_id ' . $food_id . '<br>';
        }
    }

    echo 'All food_ids processed';



    header('location:../food_delivery');
}

if(isset($_POST['delivered_cows'])) {

    echo 'Delivered to cows';

    $package_id = 'cows';
    echo 'going to deliver ' . $package_id . ' package =>';

    $sql = "SELECT `food_id`, `needy_place_id` FROM `verified_food_at_w` WHERE `package_id` = '$package_id' AND `status`='going_to' ";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $food_id = $row['food_id'];
        $cow_shed_id = $row['needy_place_id'];

        // Retrieve needy place details
        $needy_sql = "SELECT `street`, `city`, `zip_code` FROM `cow_shed` WHERE `cow_shed_id`= '$cow_shed_id'";
        $needy_result = mysqli_query($conn, $needy_sql);
        $needy_row = mysqli_fetch_array($needy_result);
        $street = $needy_row['street'];
        $city = $needy_row['city'];
        $zip_code = $needy_row['zip_code'];

        // Update donate_food table
        $update_sql = "UPDATE `donate_food` SET `status`='delivered', `delivered_place`='$street, $city, $zip_code' WHERE `food_id`='$food_id'";
        $update_result = mysqli_query($conn, $update_sql);

        if ($update_result) {
            echo 'Status updated for food_id ' . $food_id . ' in donate_food table<br>';
        } else {
            echo 'Error updating status for food_id ' . $food_id . '<br>';
        }

        // Delete from verified_food_at_w table
        $delete_sql = "DELETE FROM `verified_food_at_w` WHERE `food_id` = '$food_id'";
        $delete_result = mysqli_query($conn, $delete_sql);

        if ($delete_result) {
            echo 'Deleted from verified_food_at_w for food_id ' . $food_id . '<br>';
        } else {
            echo 'Error deleting from verified_food_at_w for food_id ' . $food_id . '<br>';
        
        }
        $set_sql = "UPDATE `cow_shed` SET `total_assigned_donation`=0";
        $set_result = mysqli_query($conn, $set_sql);

        if ($set_result) {
            echo 'Set from verified_food_at_w for food_id ' . $food_id . '<br>';
        } else {
            echo 'Error deleting from verified_food_at_w for food_id ' . $food_id . '<br>';
        }
    }

    echo 'All food_ids processed';



    header('location:../food_delivery');




}
