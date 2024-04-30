<?php
require_once '../config/db_connection.php';
echo 'function';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo 'function =>';
    
    if (isset($_POST['submit'])) {
        echo 'function =>';
        $option = $_POST['donate_to'];
        echo $option . ' =>';

        if($option == 1){

            $sql = "UPDATE cms_fdf SET fdf_set = 1 WHERE fdf_id = 1";
            $result = mysqli_query($conn, $sql);
            echo 'Food Donation form updated successfully =>';
            
            $sql = "UPDATE cms_fdf SET fdf_set = 0 WHERE fdf_id = 2";
            $result = mysqli_query($conn, $sql);
            echo 'Remove previous form successfully =>';

            header("Location:../include/cms_food_donation_form");

        }else if($option == 2){

             $sql = "UPDATE cms_fdf SET fdf_set = 0 WHERE fdf_id = 1";
            $result = mysqli_query($conn, $sql);
            echo 'Remove previous form successfully =>';

             $sql = "UPDATE cms_fdf SET fdf_set = 1 WHERE fdf_id = 2";
            $result = mysqli_query($conn, $sql);
            echo 'Food Donation form updated successfully =>';

            header("Location:../include/cms_food_donation_form");
        }
    }
    }
?>