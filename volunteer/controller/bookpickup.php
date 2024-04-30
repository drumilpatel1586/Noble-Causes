<?php require("../config/db_connection.php");
require_once("../encrypt_decrypt.php");

$ISBN =  $_POST['isbnNoInput'];
echo $ISBN . '=>';
// $book_id = $_POST['book_id'];
$book_id = $_POST['bookid'];
echo $book_id . '=>';

// $book_id = $_GET["collect"];

$sql5 = "SELECT `user_id` FROM `donate_book` WHERE `book_id`=$book_id";
$result5 = mysqli_query($conn, $sql5);
$row5 = mysqli_fetch_array($result5);
$user_id = $row5['user_id'];

$sql54 = "SELECT * FROM `donate_book` WHERE `book_id`= $book_id";
$result54 = mysqli_query($conn, $sql54);
$row54 = mysqli_fetch_array($result54);

$book_id = $row54['book_id'];
$title = $row54['title'];
$author = $row54['author'];
$course = $row54['course'];
$book_quantity = $row54['book_quantity'];
$sub_course = $row54['sub_course'];
$image = $row54['image'];
$description = $row54['description'];

$sql = "INSERT INTO `pickedup_book`(`book_id`, `title`, `author`, `course`, `book_quantity`, `sub_course`, `image`, `description`) VALUES ('$book_id','$title','$author','$course','$book_quantity','$sub_course','$image','$description')";
$result = mysqli_query($conn, $sql);
echo "data inserted into `pickedup_book` =>";

$sql = "UPDATE `donate_book` SET `status` = 'collected' WHERE `donate_book`.`book_id` = $book_id;";
$result = mysqli_query($conn, $sql);
echo "data updated into donate book =>";  


$sql33 = "SELECT * FROM `user_donation_quantity_record` WHERE `user_id`='$user_id'";
$result33 = mysqli_query($conn, $sql33);
$row33 = mysqli_fetch_array($result33);

if ($result33->num_rows > 0) {
    $sql4 = "UPDATE `user_donation_quantity_record` SET `donation_quantity`=`donation_quantity`+1 WHERE `user_donation_quantity_record`.`user_id`='$user_id'  ";
    $result4 = mysqli_query($conn, $sql4);
    // echo 'q updated';
} else {

    $sql2 = "INSERT INTO `user_donation_quantity_record`(`user_id`) VALUES ('$user_id')";
    $result2 = mysqli_query($conn, $sql2);
    // echo 'q inserted';
}

$sql = "DELETE FROM `approved_book_req` WHERE `book_id` = $book_id";
$result = mysqli_query($conn, $sql);

$sql = "SELECT * FROM `book_record` WHERE `ISBN_No` = '$ISBN' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    echo "Isbn found =>";

    echo $ISBN . '=>';
    echo $book_id . '=>';

    $sql = "SELECT `book_quantity` FROM `pickedup_book` WHERE `book_id`= '$book_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $book_quantity = $row['book_quantity'];
    echo $book_quantity . '=>';
    echo $ISBN . '=>';

    $sql243 = " UPDATE `available_books` SET `book_quantity` = `book_quantity` + $book_quantity WHERE `ISBN_No` = '$ISBN'";
    $result243 = mysqli_query($conn, $sql243);
    echo "Book has been added to available books=>";
    header("Location:../manage_book_donation");

} else {

    echo 'no isbn found=>';
    echo $ISBN . '=>';
    echo $book_id . '=>';

    $sql = "SELECT  `title`, `author`, `course`, `sub_course`, `image`, `description`,`book_quantity` FROM `pickedup_book` WHERE `book_id`= '$book_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
    $author = $row['author'];
    $course = $row['course'];
    $sub_course = $row['sub_course'];
    $image = $row['image'];
    $description = $row['description'];
    $book_quantity = $row['book_quantity'];
    echo $book_quantity . '=>';
    echo $ISBN . '=>';

    $sql253 = "INSERT INTO `book_record`( `ISBN_No`, `title`, `author`, `course`, `sub_course`, `image`, `description`) VALUES ('$ISBN','$title','$author','$course','$sub_course','$image','$description')";
    $result253 = mysqli_query($conn, $sql253);
    echo "Book has been picked up successfully =>";

    $sql3 = "INSERT INTO `available_books`(`ISBN_No`, `book_quantity` , `course`, `sub_course`) VALUES ('$ISBN','$book_quantity','$course','$sub_course')";
    $result3 = mysqli_query($conn, $sql3);
    echo "Book has been added to available books";
    header("Location:../manage_book_donation");
}

$collect = true;