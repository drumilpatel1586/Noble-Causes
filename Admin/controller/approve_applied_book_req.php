<?php require_once('../config/db_connection.php');
require_once('../include/encrypt_decrypt.php');

$ab_id = decrypt_number(32, $_POST['available_book_id']);

$sql1 = "SELECT * FROM `applied_book` WHERE `applied_book`.`ab_id` = '$ab_id'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1);
$user_id = $row1['user_id'];
$ISBN_No = $row1['ISBN_No'];

if (isset($_POST['approve'])) {


    $sql2 = "SELECT * FROM `user_login` WHERE `user_login`.`user_id` = '$user_id'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    $street = $row2['street'];
    $city = $row2['city'];
    $zip_code = $row2['zip_code'];

    $sql3 = "SELECT `v_id`, `v_name` FROM `volunteers`  WHERE `volunteers`.`assigned_zip_code` = '$zip_code'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3->num_rows > 0) {
        $sql34 = "SELECT * FROM `volunteers`  WHERE `volunteers`.`assigned_street` = '$street'";
        $result34 = mysqli_query($conn, $sql34);
        if ($result34->num_rows > 0) {
            echo 'street found_';
            $row34 = mysqli_fetch_array($result34);
            $v_id = $row34['v_id'];
            $v_name = $row34['v_name'];
            echo $v_id;
            echo $v_name;
            // adding volunteer requierd area
            $sql = "INSERT INTO `approved_applied_book_req`(`ab_id`,`user_id`, `v_id`, `v_name`, `ISBN_No`, `status`) VALUES ('$ab_id','$user_id','$v_id','$v_name','$ISBN_No','approved') ";
            $result = mysqli_query($conn, $sql);
            echo 'data inserted_ in approved_applied_book_req =>';

            // changing status 
            $sql = "UPDATE `applied_book` SET `status` = 'approved' WHERE `applied_book`.`ab_id` = '$ab_id'";
            $result = mysqli_query($conn, $sql);
            echo 'status changed approved in db=>';
            header("location: ../include/requested_book");
        } else {
            echo 'zip found_';
            $row3 = mysqli_fetch_array($result3);
            $v_id = $row3['v_id'];
            $v_name = $row3['v_name'];
            echo $v_id;
            echo $v_name;

            $sql = "INSERT INTO `approved_applied_book_req`(`ab_id`,`user_id`, `v_id`, `v_name`, `ISBN_No`, `status`) VALUES ('$ab_id','$user_id','$v_id','$v_name','$ISBN_No','approved') ";
            $result = mysqli_query($conn, $sql);
            echo 'data inserted_ into approved_applied_book_req =>';

            // changing status 
            $sql = "UPDATE `applied_book` SET `status` = 'approved' WHERE `applied_book`.`ab_id` = '$ab_id'";
            $result = mysqli_query($conn, $sql);
            echo 'status changed approved in db=>';
            header("location: ../include/requested_book");
        }
    } else {
        echo 'no found_';
        // adding volunteer requierd area
        $sql11 = "SELECT * FROM v_required_area WHERE `v_required_zip_code`=$zip_code";
        $result11 = mysqli_query($conn, $sql11);

        if ($result11->num_rows > 0) {

            $sql = "UPDATE `v_required_area` SET `total_user_req`=`total_user_req`+1 ";
            $result = mysqli_query($conn, $sql);
            echo 'total req + 1 in to v_required_area ';

            // changing status pendding-volunteer_requierd
            $sql = "UPDATE `applied_book` SET `status` = 'pendding:v' WHERE `applied_book`.`ab_id` = $ab_id";
            $result = mysqli_query($conn, $sql);
            echo 'status pendding-volunteer_requierd =>';
            header("location: ../include/volunteer_required_area");
        } else {

            $sql = "INSERT INTO `v_required_area`(`ab_id`, `v_required_street`, `v_required_city`, `v_required_zip_code`, `v_requsted_user_id`) VALUES ('$ab_id','$street','$city','$zip_code','$user_id')";
            $result = mysqli_query($conn, $sql);
            echo 'pendding-volunteer_req inserted =>';

            // changing status pendding-volunteer_requierd
            $sql = "UPDATE `applied_book` SET `status` = 'pendding:v' WHERE `applied_book`.`ab_id` = '$ab_id'";
            $result = mysqli_query($conn, $sql);
            echo ' changing status pendding-volunteer_requierd=>';

            header("location: ../include/volunteer_required_area");
        }
    }
}

if (isset($_POST["delete"])) {
    echo $ab_id . '=>';
    echo $ISBN_No . 'ISBN No->'; 

    $sql9 = "UPDATE `user_book_applied_record` SET `user_book_applied_record`.`req_book_quantity` = `req_book_quantity` - 1 WHERE `user_book_applied_record`.`user_id`= $user_id ";
    $result9 = mysqli_query($conn, $sql9);
    echo 'req_book_quantity updated into user_book_applied_record=>';

    $sql7 = "UPDATE `available_books` SET `available_books`.`book_quantity` = `book_quantity` + 1  WHERE `ISBN_No`= '$ISBN_No' ";
    $result7 = mysqli_query($conn, $sql7);
    echo 'book_quantity updated into available_books=>';

    $sql = "UPDATE `applied_book` SET `status` = 'cancelled' WHERE `applied_book`.`ab_id` = '$ab_id'";
    $result = mysqli_query($conn, $sql);
    echo 'status changed cancelled in applied_book=>';

    // header("location: ../include/requested_book");
}
