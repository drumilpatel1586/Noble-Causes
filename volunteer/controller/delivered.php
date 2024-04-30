<?php
require_once('../config/db_connection.php');
require_once('../include/encrypt_decrypt.php');


if(isset($_POST['delivered'])){   
    // $id = $_POST['food_id'];
    // echo $id;
    $food_id =decrypt_number(32, $_POST['food_id']);
   

    $sql = "SELECT * FROM `pickedup_food` WHERE `pickedup_food`.`food_id` = '$food_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $food_id = $row['food_id'];
    echo $food_id.'=>';
    $v_id = $row['v_id'];
    echo $v_id.'=>';
    $donate_to = $row['donate_to'];
    echo $donate_to.'=>';
    $validity = $row['validity'];
    echo $validity.'=>';

    $sql = "INSERT INTO `reached_food`(`food_id`, `v_id`, `donate_to`, `validity`) VALUES ('$food_id','$v_id','$donate_to','$validity')";
    $result = mysqli_query($conn, $sql);
    echo 'records inserted successfully ';

    $sql = "DELETE FROM `pickedup_food` WHERE `food_id` = '$food_id'";
    $result = mysqli_query($conn, $sql);
    echo 'deleted successfully from `pickedup_food`';

  
    header('location:../pickedup_food_donations');
}

if(isset($_POST['deliveredall'])){
    // echo 'delivered all =>';

    while (true) {
        // Step 1: Select a row from `pickedup_food`
        $sql = "SELECT * FROM `pickedup_food` LIMIT 1";
        $result = mysqli_query($conn, $sql);
    
        // Check if there are any rows left to process
        if (mysqli_num_rows($result) == 0) {
            break; // Exit the loop if no more rows
        }
    
        // Fetch the selected row
        $row = mysqli_fetch_array($result);
        
        // Step 2: Insert the selected row into `reached_food`
        $food_id = $row['food_id'];
        $v_id = $row['v_id'];
        $donate_to = $row['donate_to'];
        // echo $donate_to.'=>';
        $validity = $row['validity'];
    
        $sql = "INSERT INTO `reached_food`(`food_id`, `v_id`, `donate_to`, `validity`) VALUES ('$food_id','$v_id','$donate_to','$validity')";
        $result = mysqli_query($conn, $sql);
    
        // Step 3: Delete the selected row from `pickedup_food`
        $sql = "DELETE FROM `pickedup_food` WHERE `food_id` = '$food_id'";
        $result = mysqli_query($conn, $sql);
    }
    
    // Close the database connection
    mysqli_close($conn);
    
    // echo 'All records moved successfully!'; 
    echo'    
    <script>
    if (confirm("All Food Delivered successfully!")) {
        console.log("yes");
        window.location = `../pickedup_food_donations`;

    }</script>';

}
    
    