<?php
require("../config//db_connection.php");
require_once("../include/encrypt_decrypt.php");


$book_id = decrypt_number(32, $_POST["book_id"]);
echo $book_id;
if (isset($_POST["approve"])) {
    // echo $book_id;
    
    $sql1 = "SELECT * FROM `donate_book` WHERE `donate_book`.`book_id` = $book_id";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);
    $user_id = $row1['user_id'];
    $book_id = $row1['book_id'];
    $title = $row1['title'];
    $author = $row1['author'];
    $course = $row1['course'];
    $sub_course = $row1['sub_course'];
    echo $sub_course;
    $image = $row1['image'];
    $status = 'approved';
    $time = $row1['time'];
    $pickup_date = $row1['pickup_date'];
    $pickup_street = $row1['pickup_street'];
    $pickup_city = $row1['pickup_city'];
    $pickup_zip_code = $row1['pickup_zip_code'];
    $description = $row1['description'];



    $sql3 = "SELECT `v_id`, `v_name` FROM `volunteers`  WHERE `volunteers`.`assigned_zip_code` = '$pickup_zip_code'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3->num_rows > 0) {
        $sql34 = "SELECT * FROM `volunteers`  WHERE `volunteers`.`assigned_street` = '$pickup_street'";
        $result34 = mysqli_query($conn, $sql34);
        if ($result34->num_rows > 0) {
            echo 'street found_';
            $row34 = mysqli_fetch_array($result34);
            $v_id = $row34['v_id'];
            $v_name = $row34['v_name'];
            echo $v_id;
            echo $v_name;
            // adding volunteer requierd area
            $sql = "INSERT INTO `approved_book_req`(`book_id`, `user_id`, `v_id`, `v_name`, `title`, `author`, `course`,`sub_course`, `pickup_date`, `pickup_street`, `pickup_zip_code`, `pickup_city`, `image`, `description`, `time`, `status`) VALUES ('$book_id','$user_id','$v_id','$v_name','$title','$author','$course','$sub_course','$pickup_date','$pickup_street','$pickup_zip_code','$pickup_city','$image','$description','$time','$status') ";
            $result = mysqli_query($conn, $sql);
            echo 'data inserted_ in abd =>';
            
            // changing status 
            $sql = "UPDATE `donate_book` SET `status` = 'approved' WHERE `donate_book`.`book_id` = '$book_id'";
            $result = mysqli_query($conn, $sql);
            echo 'status changed approved in db=>';
            header("location: ../include/book_donate_req");
        } else {
            echo 'zip found_';
            $row3 = mysqli_fetch_array($result3);
            $v_id = $row3['v_id'];
            $v_name = $row3['v_name'];
            echo $v_id;
            echo $v_name;

            $sql = "INSERT INTO `approved_book_req`(`book_id`, `user_id`, `v_id`, `v_name`, `title`, `author`, `course`,`sub_course`, `pickup_date`, `pickup_street`, `pickup_zip_code`, `pickup_city`, `image`, `description`, `time`, `status`) VALUES ('$book_id','$user_id','$v_id','$v_name','$title','$author','$course','$sub_course','$pickup_date','$pickup_street','$pickup_zip_code','$pickup_city','$image','$description','$time','$status') ";
            $result = mysqli_query($conn, $sql);
            echo 'data inserted_ into abd =>';

            // changing status 
            $sql = "UPDATE `donate_book` SET `status` = 'approved' WHERE `donate_book`.`book_id` = '$book_id'";
            $result = mysqli_query($conn, $sql);
            echo 'status changed approved in db=>';
            header("location: ../include/book_donate_req");
        }
    } else {
        echo 'no found_';
        // adding volunteer requierd area
        $sql11 = "SELECT * FROM v_required_area WHERE `v_required_zip_code`=$pickup_zip_code";
        $result11 = mysqli_query($conn, $sql11);
        
        if ($result11->num_rows > 0) {
            
            $sql = "UPDATE `v_required_area` SET `total_user_req`=`total_user_req`+1 ";
            $result = mysqli_query($conn, $sql);
            echo 'total req + 1 in to v_required_area ';
            
            // changing status pendding-volunteer_requierd
            $sql = "UPDATE `donate_book` SET `status` = 'pendding:v' WHERE `donate_book`.`book_id` = $book_id";
            $result = mysqli_query($conn, $sql);
            echo 'status pendding-volunteer_requierd =>';
            header("location: ../include/volunteer_required_area");
            // header("location: ../include/book_donate_req");
        } else {
            
            $sql = "INSERT INTO `v_required_area`(`book_id`, `v_required_street`, `v_required_city`, `v_required_zip_code`, `v_requsted_user_id`) VALUES ('$book_id','$pickup_street','$pickup_city','$pickup_zip_code','$user_id')";
            $result = mysqli_query($conn, $sql);
            echo 'pendding-volunteer_req inserted =>';
            
            // changing status pendding-volunteer_requierd
            $sql = "UPDATE `donate_book` SET `status` = 'pendding:v' WHERE `donate_book`.`book_id` = '$book_id'";
            $result = mysqli_query($conn, $sql);
            echo ' changing status pendding-volunteer_requierd=>';
            // header("location: ../include/book_donate_req");

            header("location: ../include/volunteer_required_area");
        }
    }


}


if (isset($_POST["delete"])) {
    $book_id = $_POST["book_id"];
    echo $book_id;

    $sql = "UPDATE `donate_book` SET `status` = 'cancelled' WHERE `donate_book`.`book_id` = '$book_id'";
    $result = mysqli_query($conn, $sql);
    echo ' changing status cancelled=>';
    
    header("location: ../include/book_donate_req");
}

if(isset($_POST['Delete'])){
    $sql = "DELETE FROM `approved_book_req`  WHERE `book_id` = $book_id";
    $result = mysqli_query($conn, $sql);
    
    echo ' record deleted from approve_book _req=>';
    
    header("location: ../include/cancelled_book_pickup");

}