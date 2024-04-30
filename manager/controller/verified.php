<?php
require_once('../config/db_connection.php');
require_once('../include/encrypt_decrypt.php');

// if (isset($_POST['verifiedall'])) {
//     echo 'verified all =>';


//     while (true) {
//         // Step 1: Select a row from `reached_food`
//         $sql = "SELECT * FROM `reached_food` LIMIT 1";
//         $result = mysqli_query($conn, $sql);

//         // Check if there are any rows left to process
//         if (mysqli_num_rows($result) == 0) {
//             break; // Exit the loop if no more rows
//         }

//         // Fetch the selected row
//         $row = mysqli_fetch_array($result);

//         // Step 2: Insert the selected row into `reached_food`
//         $food_id = $row['food_id'];
//         echo 'food_id: ' . $food_id . '=>';

//         $donate_to = $row['donate_to'];
//         echo 'donate_to: ' . $donate_to . '=>';

//         $validity = $row['validity'];
//         echo 'validity: ' . $validity . '=>';

//         $sql253 = "SELECT * FROM reached_food WHERE `reached_food`.`food_id` = '$food_id' AND `reached_food`.`donate_to`='cows'";
//         $result253 = $conn->query($sql253);
//         if ($result253->num_rows > 0) {
//             echo 'donate to cows =>';

//             $sql = "SELECT * FROM `cow_shed`";
//             $result = mysqli_query($conn, $sql);
//             $row2 = mysqli_fetch_array($result);
//             $cow_shed_id = $row2['cow_shed_id'];
//             $zip_code = $row2['zip_code'];

//             $sql3 = "SELECT `v_id`, `v_name` FROM `volunteers`  WHERE `volunteers`.`assigned_zip_code` = '$zip_code'";
//             $result3 = mysqli_query($conn, $sql3);
//             $row3 = mysqli_fetch_array($result3);
//             $v_id = $row3['v_id'];
//             $v_name = $row3['v_name'];

//             $package_id = 'cows';

//             $sql = "INSERT INTO `verified_food_at_w`(`food_id`,`donate_to`, `v_id`, `v_name`, `needy_place_id`, `package_id`) VALUES ('$food_id','cows','$v_id','$v_name','$cow_shed_id','$package_id')";
//             $result = mysqli_query($conn, $sql);
//             echo 'data inserted successfully into `verified_food_at_w`=>';

//             $sql = "UPDATE cow_shed SET total_assigned_donation = `total_assigned_donation`+1 WHERE cow_shed_id = $cow_shed_id";
//             $result = mysqli_query($conn, $sql);
//             echo 'data updated successfully into cow_shed =>';

//             $sql = "DELETE FROM `reached_food` WHERE `food_id` = '$food_id'";
//             $result = mysqli_query($conn, $sql);
//             echo 'data deleted successfully from `reached_food`=>';

//             // header('location: ../manage_food_donation');
//             // exit();

//         } else {
//             $sql253 = "SELECT * FROM reached_food WHERE `reached_food`.`food_id` = $food_id AND `reached_food`.`donate_to`='peoples'";
//             $result253 = $conn->query($sql253);
//             if ($result253->num_rows > 0) {
//                 echo 'donate to  peoples =>';

//                 $row253 = mysqli_fetch_array($result253);
//                 $validity = $row253['validity'];

//                 if ($validity == 'One Day') {
//                     echo 'validity => one day =>';

//                     $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 1";
//                     $result = mysqli_query($conn, $sql);
//                     if ($result->num_rows > 0) {

//                         // $needy_place_ids = array();

//                         while ($row = mysqli_fetch_array($result)) {
//                             // Fetch needy_place_id and total_donation from the current row
//                             $needy_place_id = $row['needy_place_id'];
//                             $total_donation = $row['total_donation'];

//                             // Add needy_place_id as key and total_donation as value to the associative array
//                             $needy_place_donations[$needy_place_id] = $total_donation;
//                         }

//                         // Now $needy_place_donations contains needy_place_id as key and total_donation as value
//                         print_r($needy_place_donations);

//                         $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

//                         // Output the needy place ID with the minimum donation
//                         echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
//                     }
//                 } else if ($validity == 'Two-Three Days') {
//                     echo 'validity => two-three days =>';

//                     $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 2";
//                     $result = mysqli_query($conn, $sql);
//                     if ($result->num_rows > 0) {

//                         // $needy_place_ids = array();

//                         while ($row = mysqli_fetch_array($result)) {
//                             // Fetch needy_place_id and total_donation from the current row
//                             $needy_place_id = $row['needy_place_id'];
//                             $total_donation = $row['total_donation'];

//                             // Add needy_place_id as key and total_donation as value to the associative array
//                             $needy_place_donations[$needy_place_id] = $total_donation;
//                         }

//                         // Now $needy_place_donations contains needy_place_id as key and total_donation as value
//                         print_r($needy_place_donations);

//                         $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

//                         // Output the needy place ID with the minimum donation
//                         echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
//                     }
//                 } else if ($validity == 'One Week') {
//                     echo 'validity => one week =>';

//                     $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 7";
//                     $result = mysqli_query($conn, $sql);
//                     if ($result->num_rows > 0) {

//                         // $needy_place_ids = array();

//                         while ($row = mysqli_fetch_array($result)) {
//                             // Fetch needy_place_id and total_donation from the current row
//                             $needy_place_id = $row['needy_place_id'];
//                             $total_donation = $row['total_donation'];

//                             // Add needy_place_id as key and total_donation as value to the associative array
//                             $needy_place_donations[$needy_place_id] = $total_donation;
//                         }

//                         // Now $needy_place_donations contains needy_place_id as key and total_donation as value
//                         print_r($needy_place_donations);

//                         $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

//                         // Output the needy place ID with the minimum donation
//                         echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
//                     }
//                 } else if ($validity == 'More than Week') {
//                     echo 'validity =>More than Week=>';

//                     $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 7";
//                     $result = mysqli_query($conn, $sql);
//                     if ($result->num_rows > 0) {

//                         // $needy_place_ids = array();

//                         while ($row = mysqli_fetch_array($result)) {
//                             // Fetch needy_place_id and total_donation from the current row
//                             $needy_place_id = $row['needy_place_id'];
//                             $total_donation = $row['total_donation'];

//                             // Add needy_place_id as key and total_donation as value to the associative array
//                             $needy_place_donations[$needy_place_id] = $total_donation;
//                         }

//                         // Now $needy_place_donations contains needy_place_id as key and total_donation as value
//                         print_r($needy_place_donations);

//                         $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

//                         // Output the needy place ID with the minimum donation
//                         echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
//                     }
//                 }
//             } else {
//                 $sql253 = "SELECT * FROM reached_food WHERE `reached_food`.`food_id` = $food_id AND `reached_food`.`donate_to`='any'";
//                 $result253 = $conn->query($sql253);
//                 if ($result253->num_rows > 0) {
//                     echo 'donate to any =>';

//                     $sql = "SELECT * FROM needy_place WHERE total_donation = 0";
//                     $result = $conn->query($sql);
//                     if ($result->num_rows > 0) {
//                         echo " 0 donation to needy place =>";
//                         while ($row = mysqli_fetch_array($result)) {

//                             $needy_place_id = $row['needy_place_id'];
//                             $total_donation = $row['total_donation'];

//                             $needy_place_donations[$needy_place_id] = $total_donation;
//                         }
//                         // Now $needy_place_donations contains needy_place_id as key and total_donation as value
//                         print_r($needy_place_donations);

//                         $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

//                         // Output the needy place ID with the minimum donation
//                         echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";

//                         echo $min_donation_needy_place_id . '=>';

//                         $sql = "SELECT np.needy_place_id, np.zip_code, np.package_id, vol.v_id, vol.v_name 
//                                 FROM needy_place np 
//                                 INNER JOIN volunteers vol ON np.zip_code = vol.assigned_zip_code 
//                                 WHERE np.needy_place_id = $min_donation_needy_place_id";
//                         $result = $conn->query($sql);
//                         $row = $result->fetch_assoc();

//                         // $sql = "SELECT * FROM needy_place WHERE needy_place_id =  $min_donation_needy_place_id ";
//                         // $result = mysqli_query($conn, $sql);
//                         // $row = mysqli_fetch_array($result);

//                         $zip_code = $row['zip_code'];
//                         echo 'zip code: ' . $zip_code . '=>';

//                         // $sql = "SELECT * FROM volunteers WHERE assigned_zip_code = $zip_code";
//                         // $result = mysqli_query($conn, $sql);
//                         // $row2 = mysqli_fetch_array($result);

//                         $needy_place_id = $row['needy_place_id'];
//                         echo 'needy place id: ' . $needy_place_id . '=>';

//                         $package_id = $row['package_id'];
//                         echo 'package id: ' . $package_id . '=>';

//                         // $v_id = $row2['v_id'];
//                         // echo 'v_id:'.$v_id.'=>';

//                         // $v_name = $row2['v_name'];
//                         // echo 'v_name:'.$v_name.'=>';

//                         $v_id = $row['v_id'];
//                         echo 'v_id:' . $v_id . '=>';

//                         $v_name = $row['v_name'];
//                         echo 'v_name:' . $v_name . '=>';

//                         $sql = "INSERT INTO `verified_food_at_w`(`food_id`,`donate_to`, `v_id`, `v_name`, `needy_place_id`, `package_id`) VALUES ('$food_id','peoples','$v_id','$v_name','$needy_place_id','$package_id')";
//                         $result = mysqli_query($conn, $sql);
//                         echo 'data inserted successfully into `verified_food_at_w`=>';

//                         $sql = "UPDATE needy_place SET total_donation = `total_donation`+1 WHERE needy_place_id = $needy_place_id";
//                         $result = mysqli_query($conn, $sql);
//                         echo 'data updated successfully into needy place =>';

//                         $sql = "DELETE FROM `reached_food` WHERE `food_id` = '$food_id'";
//                         $result = mysqli_query($conn, $sql);
//                         echo 'data deleted successfully from `reached_food`=>';

//                         // header('Location:../manage_food_donation');
//                         // exit();
//                     } else {
//                         $sql = "SELECT * FROM cow_shed WHERE total_assigned_donation = 0";
//                         $result = $conn->query($sql);
//                         if ($result->num_rows > 0) {
//                             echo " 0 donations to cow shed => ";

//                             while ($row = mysqli_fetch_array($result)) {

//                                 $cow_shed_id = $row['cow_shed_id'];
//                                 $total_assigned_donation = $row['total_assigned_donation'];

//                                 $needy_place_donations[$cow_shed_id] = $total_assigned_donation;
//                             }

//                             // Now $needy_place_donations contains needy_place_id as key and total_donation as value
//                             print_r($needy_place_donations);

//                             $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

//                             // Output the needy place ID with the minimum donation
//                             echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";

//                             echo $min_donation_needy_place_id . '=>';

//                             $sql = "SELECT cs.cow_shed_id, cs.zip_code, vol.v_id, vol.v_name 
//                         FROM cow_shed cs 
//                         INNER JOIN volunteers vol ON cs.zip_code = vol.assigned_zip_code 
//                         WHERE cs.cow_shed_id = $min_donation_needy_place_id";
//                             $result = $conn->query($sql);
//                             $row = $result->fetch_assoc();

//                             // $sql = "SELECT * FROM needy_place WHERE needy_place_id =  $min_donation_needy_place_id ";
//                             // $result = mysqli_query($conn, $sql);
//                             // $row = mysqli_fetch_array($result);

//                             $zip_code = $row['zip_code'];
//                             echo 'zip code: ' . $zip_code . '=>';

//                             // $sql = "SELECT * FROM volunteers WHERE assigned_zip_code = $zip_code";
//                             // $result = mysqli_query($conn, $sql);
//                             // $row2 = mysqli_fetch_array($result);

//                             $cow_shed_id = $row['cow_shed_id'];
//                             echo 'cow_shed_id: ' . $cow_shed_id . '=>';

//                             $package_id = 'cows';
//                             echo 'package id: ' . $package_id . '=>';


//                             // $v_id = $row2['v_id'];
//                             // echo 'v_id:'.$v_id.'=>';

//                             // $v_name = $row2['v_name'];
//                             // echo 'v_name:'.$v_name.'=>';

//                             $v_id = $row['v_id'];
//                             echo 'v_id:' . $v_id . '=>';

//                             $v_name = $row['v_name'];
//                             echo 'v_name:' . $v_name . '=>';

//                             $sql = "INSERT INTO `verified_food_at_w`(`food_id`,`donate_to`, `v_id`, `v_name`, `needy_place_id`, `package_id`) VALUES ('$food_id','cows','$v_id','$v_name','$cow_shed_id','$package_id')";
//                             $result = mysqli_query($conn, $sql);
//                             echo 'data inserted successfully into `verified_food_at_w`=>';

//                             $sql = "UPDATE cow_shed SET total_assigned_donation = `total_assigned_donation`+1 WHERE cow_shed_id = $cow_shed_id";
//                             $result = mysqli_query($conn, $sql);
//                             echo 'data updated successfully into cow_shed =>';

//                             $sql = "DELETE FROM `reached_food` WHERE `food_id` = '$food_id'";
//                             $result = mysqli_query($conn, $sql);
//                             echo 'data deleted successfully from `reached_food`=>';

//                             // header('Location:../manage_food_donation');
//                             // exit();
//                         } else {
//                             echo 'all if denied =>';

//                                 $row253 = mysqli_fetch_array($result253);
//                                 $validity = $row253['validity'];

//                                 if ($validity == 'One Day') {
//                                     echo 'validity => one day =>';

//                                     $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 1";
//                                     $result = mysqli_query($conn, $sql);
//                                     if ($result->num_rows > 0) {

//                                         // $needy_place_ids = array();

//                                         while ($row = mysqli_fetch_array($result)) {
//                                             // Fetch needy_place_id and total_donation from the current row
//                                             $needy_place_id = $row['needy_place_id'];
//                                             $total_donation = $row['total_donation'];

//                                             // Add needy_place_id as key and total_donation as value to the associative array
//                                             $needy_place_donations[$needy_place_id] = $total_donation;
//                                         }

//                                         // Now $needy_place_donations contains needy_place_id as key and total_donation as value
//                                         print_r($needy_place_donations);

//                                         $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

//                                         // Output the needy place ID with the minimum donation
//                                         echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
//                                     }
//                                 } else if ($validity == 'Two-Three Days') {
//                                     echo 'validity => two-three days =>';

//                                     $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 2";
//                                     $result = mysqli_query($conn, $sql);
//                                     if ($result->num_rows > 0) {

//                                         // $needy_place_ids = array();

//                                         while ($row = mysqli_fetch_array($result)) {
//                                             // Fetch needy_place_id and total_donation from the current row
//                                             $needy_place_id = $row['needy_place_id'];
//                                             $total_donation = $row['total_donation'];

//                                             // Add needy_place_id as key and total_donation as value to the associative array
//                                             $needy_place_donations[$needy_place_id] = $total_donation;
//                                         }

//                                         // Now $needy_place_donations contains needy_place_id as key and total_donation as value
//                                         print_r($needy_place_donations);

//                                         $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

//                                         // Output the needy place ID with the minimum donation
//                                         echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
//                                     }
//                                 } else if ($validity == 'One Week') {
//                                     echo 'validity => one week =>';

//                                     $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 7";
//                                     $result = mysqli_query($conn, $sql);
//                                     if ($result->num_rows > 0) {

//                                         // $needy_place_ids = array();

//                                         while ($row = mysqli_fetch_array($result)) {
//                                             // Fetch needy_place_id and total_donation from the current row
//                                             $needy_place_id = $row['needy_place_id'];
//                                             $total_donation = $row['total_donation'];

//                                             // Add needy_place_id as key and total_donation as value to the associative array
//                                             $needy_place_donations[$needy_place_id] = $total_donation;
//                                         }

//                                         // Now $needy_place_donations contains needy_place_id as key and total_donation as value
//                                         print_r($needy_place_donations);

//                                         $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

//                                         // Output the needy place ID with the minimum donation
//                                         echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
//                                     }
//                                 } else if ($validity == 'More than Week') {
//                                     echo 'validity =>More than Week=>';

//                                     $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 7";
//                                     $result = mysqli_query($conn, $sql);
//                                     if ($result->num_rows > 0) {

//                                         // $needy_place_ids = array();

//                                         while ($row = mysqli_fetch_array($result)) {
//                                             // Fetch needy_place_id and total_donation from the current row
//                                             $needy_place_id = $row['needy_place_id'];
//                                             $total_donation = $row['total_donation'];

//                                             // Add needy_place_id as key and total_donation as value to the associative array
//                                             $needy_place_donations[$needy_place_id] = $total_donation;
//                                         }

//                                         // Now $needy_place_donations contains needy_place_id as key and total_donation as value
//                                         print_r($needy_place_donations);

//                                         $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

//                                         // Output the needy place ID with the minimum donation
//                                         echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
//                                     }
//                                 }

//                         }
//                     }
//                 }
//             }
//         }




//         echo $min_donation_needy_place_id . '=>';

//         $sql = "SELECT np.needy_place_id, np.zip_code, np.package_id, vol.v_id, vol.v_name 
//             FROM needy_place np 
//             INNER JOIN volunteers vol ON np.zip_code = vol.assigned_zip_code 
//             WHERE np.needy_place_id = $min_donation_needy_place_id";
//         $result = $conn->query($sql);
//         $row = $result->fetch_assoc();

//         // $sql = "SELECT * FROM needy_place WHERE needy_place_id =  $min_donation_needy_place_id ";
//         // $result = mysqli_query($conn, $sql);
//         // $row = mysqli_fetch_array($result);

//         $zip_code = $row['zip_code'];
//         echo 'zip code: ' . $zip_code . '=>';

//         // $sql = "SELECT * FROM volunteers WHERE assigned_zip_code = $zip_code";
//         // $result = mysqli_query($conn, $sql);
//         // $row2 = mysqli_fetch_array($result);

//         $needy_place_id = $row['needy_place_id'];
//         echo 'needy place id: ' . $needy_place_id . '=>';

//         $package_id = $row['package_id'];
//         echo 'package id: ' . $package_id . '=>';


//         // $v_id = $row2['v_id'];
//         // echo 'v_id:'.$v_id.'=>';

//         // $v_name = $row2['v_name'];
//         // echo 'v_name:'.$v_name.'=>';

//         $v_id = $row['v_id'];
//         echo 'v_id:' . $v_id . '=>';

//         $v_name = $row['v_name'];
//         echo 'v_name:' . $v_name . '=>';

//         $sql = "INSERT INTO `verified_food_at_w`(`food_id`,`donate_to`, `v_id`, `v_name`, `needy_place_id`, `package_id`) VALUES ('$food_id','peoples','$v_id','$v_name','$needy_place_id','$package_id')";
//         $result = mysqli_query($conn, $sql);
//         echo 'data inserted successfully into `verified_food_at_w`=>';

//         $sql = "UPDATE needy_place SET total_donation = `total_donation`+1 WHERE needy_place_id = $needy_place_id";
//         $result = mysqli_query($conn, $sql);
//         echo 'data updated successfully into needy place =>';

//         $sql = "DELETE FROM `reached_food` WHERE `food_id` = '$food_id'";
//         $result = mysqli_query($conn, $sql);
//         echo 'data deleted successfully from `reached_food`=>';

//         // echo '    
//         // <script>
//         // if (confirm("Food item Verfied")) {
//         //     console.log("yes");
//         //     window.location = `../manage_food_donation`;

//         // }</script>';

// }
// }


if (isset($_POST['verified'])) {

    echo ' if pass =>';
    // $id = $_POST['food_id'];
    // echo $id;
    $food_id = decrypt_number(32, $_POST['food_id']);
    echo $food_id . '=>';

    $sql253 = "SELECT * FROM reached_food WHERE `reached_food`.`food_id` = '$food_id' AND `reached_food`.`donate_to`='cows'";
    $result253 = $conn->query($sql253);
    if ($result253->num_rows > 0) {
        echo 'donate to cows =>';

        $sql = "SELECT * FROM `cow_shed`";
        $result = mysqli_query($conn, $sql);
        $row2 = mysqli_fetch_array($result);
        $cow_shed_id = $row2['cow_shed_id'];
        $zip_code = $row2['zip_code'];

        $sql3 = "SELECT `v_id`, `v_name` FROM `volunteers`  WHERE `volunteers`.`assigned_zip_code` = '$zip_code'";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_array($result3);
        $v_id = $row3['v_id'];
        $v_name = $row3['v_name'];

        $package_id = 'cows';

        $sql = "INSERT INTO `verified_food_at_w`(`food_id`,`donate_to`, `v_id`, `v_name`, `needy_place_id`, `package_id`) VALUES ('$food_id','cows','$v_id','$v_name','$cow_shed_id','$package_id')";
        $result = mysqli_query($conn, $sql);
        echo 'data inserted successfully into `verified_food_at_w`=>';

        $sql = "UPDATE cow_shed SET total_assigned_donation = `total_assigned_donation`+1 WHERE cow_shed_id = $cow_shed_id";
        $result = mysqli_query($conn, $sql);
        echo 'data updated successfully into cow_shed =>';

        $sql = "DELETE FROM `reached_food` WHERE `food_id` = '$food_id'";
        $result = mysqli_query($conn, $sql);
        echo 'data deleted successfully from `reached_food`=>';

        header('location: ../manage_food_donation');
        exit();
    } else {
        $sql253 = "SELECT * FROM reached_food WHERE `reached_food`.`food_id` = $food_id AND `reached_food`.`donate_to`='peoples'";
        $result253 = $conn->query($sql253);
        if ($result253->num_rows > 0) {
            echo 'donate to  peoples =>';

            $row253 = mysqli_fetch_array($result253);
            $validity = $row253['validity'];

            if ($validity == 'One Day') {
                echo 'validity => one day =>';

                $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 1";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {

                    // $needy_place_ids = array();

                    while ($row = mysqli_fetch_array($result)) {
                        // Fetch needy_place_id and total_donation from the current row
                        $needy_place_id = $row['needy_place_id'];
                        $total_donation = $row['total_donation'];

                        // Add needy_place_id as key and total_donation as value to the associative array
                        $needy_place_donations[$needy_place_id] = $total_donation;
                    }

                    // Now $needy_place_donations contains needy_place_id as key and total_donation as value
                    print_r($needy_place_donations);

                    $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

                    // Output the needy place ID with the minimum donation
                    echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
                }
            } else if ($validity == 'Two-Three Days') {
                echo 'validity => two-three days =>';

                $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 2";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {

                    // $needy_place_ids = array();

                    while ($row = mysqli_fetch_array($result)) {
                        // Fetch needy_place_id and total_donation from the current row
                        $needy_place_id = $row['needy_place_id'];
                        $total_donation = $row['total_donation'];

                        // Add needy_place_id as key and total_donation as value to the associative array
                        $needy_place_donations[$needy_place_id] = $total_donation;
                    }

                    // Now $needy_place_donations contains needy_place_id as key and total_donation as value
                    print_r($needy_place_donations);

                    $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

                    // Output the needy place ID with the minimum donation
                    echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
                }
            } else if ($validity == 'One Week') {
                echo 'validity => one week =>';

                $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 7";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {

                    // $needy_place_ids = array();

                    while ($row = mysqli_fetch_array($result)) {
                        // Fetch needy_place_id and total_donation from the current row
                        $needy_place_id = $row['needy_place_id'];
                        $total_donation = $row['total_donation'];

                        // Add needy_place_id as key and total_donation as value to the associative array
                        $needy_place_donations[$needy_place_id] = $total_donation;
                    }

                    // Now $needy_place_donations contains needy_place_id as key and total_donation as value
                    print_r($needy_place_donations);

                    $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

                    // Output the needy place ID with the minimum donation
                    echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
                }
            } else if ($validity == 'More than Week') {
                echo 'validity =>More than Week=>';

                $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 7";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {

                    // $needy_place_ids = array();

                    while ($row = mysqli_fetch_array($result)) {
                        // Fetch needy_place_id and total_donation from the current row
                        $needy_place_id = $row['needy_place_id'];
                        $total_donation = $row['total_donation'];

                        // Add needy_place_id as key and total_donation as value to the associative array
                        $needy_place_donations[$needy_place_id] = $total_donation;
                    }

                    // Now $needy_place_donations contains needy_place_id as key and total_donation as value
                    print_r($needy_place_donations);

                    $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

                    // Output the needy place ID with the minimum donation
                    echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
                }
            }
        } else {

            // donate to any

            $sql253 = "SELECT * FROM reached_food WHERE `reached_food`.`food_id` = $food_id AND `reached_food`.`donate_to`='any'";
            $result253 = $conn->query($sql253);
            if ($result253->num_rows > 0) {
                echo 'donate to any =>';

                $sql = "SELECT * FROM needy_place WHERE total_donation = 0";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo " 0 donation to needy place =>";
                    while ($row = mysqli_fetch_array($result)) {

                        $needy_place_id = $row['needy_place_id'];
                        $total_donation = $row['total_donation'];

                        $needy_place_donations[$needy_place_id] = $total_donation;
                    }
                    // Now $needy_place_donations contains needy_place_id as key and total_donation as value
                    print_r($needy_place_donations);

                    $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

                    // Output the needy place ID with the minimum donation
                    echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";

                    echo $min_donation_needy_place_id . '=>';

                    $sql = "SELECT np.needy_place_id, np.zip_code, np.package_id, vol.v_id, vol.v_name 
                            FROM needy_place np 
                            INNER JOIN volunteers vol ON np.zip_code = vol.assigned_zip_code 
                            WHERE np.needy_place_id = $min_donation_needy_place_id";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    // $sql = "SELECT * FROM needy_place WHERE needy_place_id =  $min_donation_needy_place_id ";
                    // $result = mysqli_query($conn, $sql);
                    // $row = mysqli_fetch_array($result);

                    $zip_code = $row['zip_code'];
                    echo 'zip code: ' . $zip_code . '=>';

                    // $sql = "SELECT * FROM volunteers WHERE assigned_zip_code = $zip_code";
                    // $result = mysqli_query($conn, $sql);
                    // $row2 = mysqli_fetch_array($result);

                    $needy_place_id = $row['needy_place_id'];
                    echo 'needy place id: ' . $needy_place_id . '=>';

                    $package_id = $row['package_id'];
                    echo 'package id: ' . $package_id . '=>';

                    // $v_id = $row2['v_id'];
                    // echo 'v_id:'.$v_id.'=>';

                    // $v_name = $row2['v_name'];
                    // echo 'v_name:'.$v_name.'=>';

                    $v_id = $row['v_id'];
                    echo 'v_id:' . $v_id . '=>';

                    $v_name = $row['v_name'];
                    echo 'v_name:' . $v_name . '=>';

                    $sql = "INSERT INTO `verified_food_at_w`(`food_id`,`donate_to`, `v_id`, `v_name`, `needy_place_id`, `package_id`) VALUES ('$food_id','peoples','$v_id','$v_name','$needy_place_id','$package_id')";
                    $result = mysqli_query($conn, $sql);
                    echo 'data inserted successfully into `verified_food_at_w`=>';

                    $sql = "UPDATE needy_place SET total_donation = `total_donation`+1 WHERE needy_place_id = $needy_place_id";
                    $result = mysqli_query($conn, $sql);
                    echo 'data updated successfully into needy place =>';

                    $sql = "DELETE FROM `reached_food` WHERE `food_id` = '$food_id'";
                    $result = mysqli_query($conn, $sql);
                    echo 'data deleted successfully from `reached_food`=>';

                    header('Location:../manage_food_donation');
                    exit();
                } else {
                    $sql = "SELECT * FROM cow_shed WHERE total_assigned_donation = 0";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo " 0 donations to cow shed => ";

                        while ($row = mysqli_fetch_array($result)) {

                            $cow_shed_id = $row['cow_shed_id'];
                            $total_assigned_donation = $row['total_assigned_donation'];

                            $needy_place_donations[$cow_shed_id] = $total_assigned_donation;
                        }

                        // Now $needy_place_donations contains needy_place_id as key and total_donation as value
                        print_r($needy_place_donations);

                        $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

                        // Output the needy place ID with the minimum donation
                        echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";

                        echo $min_donation_needy_place_id . '=>';

                        $sql = "SELECT cs.cow_shed_id, cs.zip_code, vol.v_id, vol.v_name 
                    FROM cow_shed cs 
                    INNER JOIN volunteers vol ON cs.zip_code = vol.assigned_zip_code 
                    WHERE cs.cow_shed_id = $min_donation_needy_place_id";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        // $sql = "SELECT * FROM needy_place WHERE needy_place_id =  $min_donation_needy_place_id ";
                        // $result = mysqli_query($conn, $sql);
                        // $row = mysqli_fetch_array($result);

                        $zip_code = $row['zip_code'];
                        echo 'zip code: ' . $zip_code . '=>';

                        // $sql = "SELECT * FROM volunteers WHERE assigned_zip_code = $zip_code";
                        // $result = mysqli_query($conn, $sql);
                        // $row2 = mysqli_fetch_array($result);

                        $cow_shed_id = $row['cow_shed_id'];
                        echo 'cow_shed_id: ' . $cow_shed_id . '=>';

                        $package_id = 'cows';
                        echo 'package id: ' . $package_id . '=>';


                        // $v_id = $row2['v_id'];
                        // echo 'v_id:'.$v_id.'=>';

                        // $v_name = $row2['v_name'];
                        // echo 'v_name:'.$v_name.'=>';

                        $v_id = $row['v_id'];
                        echo 'v_id:' . $v_id . '=>';

                        $v_name = $row['v_name'];
                        echo 'v_name:' . $v_name . '=>';

                        $sql = "INSERT INTO `verified_food_at_w`(`food_id`,`donate_to`, `v_id`, `v_name`, `needy_place_id`, `package_id`) VALUES ('$food_id','cows','$v_id','$v_name','$cow_shed_id','$package_id')";
                        $result = mysqli_query($conn, $sql);
                        echo 'data inserted successfully into `verified_food_at_w`=>';

                        $sql = "UPDATE cow_shed SET total_assigned_donation = `total_assigned_donation`+1 WHERE cow_shed_id = $cow_shed_id";
                        $result = mysqli_query($conn, $sql);
                        echo 'data updated successfully into cow_shed =>';

                        $sql = "DELETE FROM `reached_food` WHERE `food_id` = '$food_id'";
                        $result = mysqli_query($conn, $sql);
                        echo 'data deleted successfully from `reached_food`=>';

                        header('Location:../manage_food_donation');
                        exit();
                    } else {
                        echo 'all if denied =>';

                        $row253 = mysqli_fetch_array($result253);
                        $validity = $row253['validity'];

                        if ($validity == 'One Day') {
                            echo 'validity => one day =>';

                            $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 1";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {

                                // $needy_place_ids = array();

                                while ($row = mysqli_fetch_array($result)) {
                                    // Fetch needy_place_id and total_donation from the current row
                                    $needy_place_id = $row['needy_place_id'];
                                    $total_donation = $row['total_donation'];

                                    // Add needy_place_id as key and total_donation as value to the associative array
                                    $needy_place_donations[$needy_place_id] = $total_donation;
                                }

                                // Now $needy_place_donations contains needy_place_id as key and total_donation as value
                                print_r($needy_place_donations);

                                $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

                                // Output the needy place ID with the minimum donation
                                echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
                            }
                        } else if ($validity == 'Two-Three Days') {
                            echo 'validity => two-three days =>';

                            $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 2";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {

                                // $needy_place_ids = array();

                                while ($row = mysqli_fetch_array($result)) {
                                    // Fetch needy_place_id and total_donation from the current row
                                    $needy_place_id = $row['needy_place_id'];
                                    $total_donation = $row['total_donation'];

                                    // Add needy_place_id as key and total_donation as value to the associative array
                                    $needy_place_donations[$needy_place_id] = $total_donation;
                                }

                                // Now $needy_place_donations contains needy_place_id as key and total_donation as value
                                print_r($needy_place_donations);

                                $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

                                // Output the needy place ID with the minimum donation
                                echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
                            }
                        } else if ($validity == 'One Week') {
                            echo 'validity => one week =>';

                            $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 7";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {

                                // $needy_place_ids = array();

                                while ($row = mysqli_fetch_array($result)) {
                                    // Fetch needy_place_id and total_donation from the current row
                                    $needy_place_id = $row['needy_place_id'];
                                    $total_donation = $row['total_donation'];

                                    // Add needy_place_id as key and total_donation as value to the associative array
                                    $needy_place_donations[$needy_place_id] = $total_donation;
                                }

                                // Now $needy_place_donations contains needy_place_id as key and total_donation as value
                                print_r($needy_place_donations);

                                $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

                                // Output the needy place ID with the minimum donation
                                echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
                            }
                        } else if ($validity == 'More than Week') {
                            echo 'validity =>More than Week=>';

                            $sql = "SELECT * FROM needy_place WHERE `days_to_reach` = 7";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {

                                // $needy_place_ids = array();

                                while ($row = mysqli_fetch_array($result)) {
                                    // Fetch needy_place_id and total_donation from the current row
                                    $needy_place_id = $row['needy_place_id'];
                                    $total_donation = $row['total_donation'];

                                    // Add needy_place_id as key and total_donation as value to the associative array
                                    $needy_place_donations[$needy_place_id] = $total_donation;
                                }

                                // Now $needy_place_donations contains needy_place_id as key and total_donation as value
                                print_r($needy_place_donations);

                                $min_donation_needy_place_id = array_search(min($needy_place_donations), $needy_place_donations);

                                // Output the needy place ID with the minimum donation
                                echo "Needy place ID with the minimum donation: $min_donation_needy_place_id=>";
                            }
                        }
                    }
                }
            }
        }
    }




    echo $min_donation_needy_place_id . '=>';

    $sql = "SELECT np.needy_place_id, np.zip_code, np.package_id, vol.v_id, vol.v_name 
        FROM needy_place np 
        INNER JOIN volunteers vol ON np.zip_code = vol.assigned_zip_code 
        WHERE np.needy_place_id = $min_donation_needy_place_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // $sql = "SELECT * FROM needy_place WHERE needy_place_id =  $min_donation_needy_place_id ";
    // $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_array($result);

    $zip_code = $row['zip_code'];
    echo 'zip code: ' . $zip_code . '=>';

    // $sql = "SELECT * FROM volunteers WHERE assigned_zip_code = $zip_code";
    // $result = mysqli_query($conn, $sql);
    // $row2 = mysqli_fetch_array($result);

    $needy_place_id = $row['needy_place_id'];
    echo 'needy place id: ' . $needy_place_id . '=>';

    $package_id = $row['package_id'];
    echo 'package id: ' . $package_id . '=>';


    // $v_id = $row2['v_id'];
    // echo 'v_id:'.$v_id.'=>';

    // $v_name = $row2['v_name'];
    // echo 'v_name:'.$v_name.'=>';

    $v_id = $row['v_id'];
    echo 'v_id:' . $v_id . '=>';

    $v_name = $row['v_name'];
    echo 'v_name:' . $v_name . '=>';

    $sql = "INSERT INTO `verified_food_at_w`(`food_id`,`donate_to`, `v_id`, `v_name`, `needy_place_id`, `package_id`) VALUES ('$food_id','peoples','$v_id','$v_name','$needy_place_id','$package_id')";
    $result = mysqli_query($conn, $sql);
    echo 'data inserted successfully into `verified_food_at_w`=>';

    $sql = "UPDATE needy_place SET total_donation = `total_donation`+1 WHERE needy_place_id = $needy_place_id";
    $result = mysqli_query($conn, $sql);
    echo 'data updated successfully into needy place =>';

    $sql = "DELETE FROM `reached_food` WHERE `food_id` = '$food_id'";
    $result = mysqli_query($conn, $sql);
    echo 'data deleted successfully from `reached_food`=>';

    echo '    
    <script>
    if (confirm("Food item Verfied")) {
        console.log("yes");
        window.location = `../manage_food_donation`;

    }</script>';
}
