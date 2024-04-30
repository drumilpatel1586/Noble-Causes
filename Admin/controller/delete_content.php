<?php
require_once('../config/db_connection.php');

$delete_from=$_GET['delete_from'];
if($delete_from=='fd'){

    $cms_fd_id = $_GET['cms_fd_id'];
    if ($cms_fd_id == 1) {
        $alert = 'You Can not delete page main image';
        echo '<script>alert("' . $alert . '")</script>';
        header("Location:../include/cms_food_donation_page");
    } else {
        $sql = "DELETE FROM `cms_fd`  WHERE `cms_fd`.`cms_fd_id` = '$cms_fd_id'";
        $result = mysqli_query($conn, $sql);
        $alert = 'content deleted';
        echo '<script>alert("' . $alert . '")</script>';
        header("Location:../include/cms_food_donation_page");
    }
}
else{
    if($delete_from=='bd'){

        $cms_bd_id = $_GET['cms_bd_id'];
        if ($cms_bd_id == 1) {
            $alert = 'You Can not delete page main image';
            echo '<script>alert("' . $alert . '")</script>';
            header("Location:../include/cms_book_donation");
        } else {
            $sql = "DELETE FROM `cms_bd`  WHERE `cms_bd`.`cms_bd_id` = '$cms_bd_id'";
            $result = mysqli_query($conn, $sql);
            $alert = 'content deleted';
            echo '<script>alert("' . $alert . '")</script>';
            header("Location:../include/cms_book_donation");
        }
    }
}
