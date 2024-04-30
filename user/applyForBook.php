<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
    header("Location:login");
}
require_once("connection.php");
require_once("encrypt_decrypt.php");

// Check if the request is a POST request and if the book ID is set
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $user_id = $_SESSION['user_id'];
    $available_book_no = $_POST['available_book_no'];

    // Check if the applicant has already applied for three books
    $sql6 = "SELECT * FROM `user_book_applied_record` WHERE  `user_book_applied_record`.`user_id`=$user_id";
    $result6 = mysqli_query($conn, $sql6);
    if ($result6->num_rows > 0) {
        $row6 = mysqli_fetch_array($result6);
        $quantity = $row6['req_book_quantity'];
        $available_book_no = decrypt_number(32, $_POST['available_book_no']);

        // Limiting the number of books an applicant can apply for to three
        if ($quantity >= 3) {

          echo' 
          <script> if (confirm("You have already applied for three books. You cannot apply for more.")) {
                console.log("yes");
                window.location = `availableBooks`;

            } else {
                console.log("no");
                window.location = `availableBooks`;
            }</script>';

        } else {

            // echo 'req_book_quantity less then 3=>';
            $sql6 = "SELECT * FROM `available_books` WHERE `available_books`.`available_book_no` = '$available_book_no'";
            $result6 = mysqli_query($conn, $sql6);
            $row6 = mysqli_fetch_array($result6);
            $ISBN = $row6['ISBN_No'];

            $sql111 = "SELECT * FROM `applied_book` WHERE `applied_book`.`ISBN_No` = '$ISBN' AND `applied_book`.`user_id` = '$user_id' AND (`applied_book`.`status` = 'pendding' OR `applied_book`.`status` = 'approved')";

            $result111 = mysqli_query($conn, $sql111);

            if ($result111->num_rows > 0) {
                echo' <script> if (confirm("You have already applied for this books.")) {
                    console.log("yes");
                    window.location = `availableBooks`;
    
                } else {
                    console.log("no");
                    window.location = `availableBooks`;
                }</script>';

            } else {

                $sql = "INSERT INTO `applied_book`(`user_id`, `ISBN_No`,`status`) VALUES ('$user_id','$ISBN','pendding')";
                $result = mysqli_query($conn, $sql);
                // echo 'data inserted into applied_book=>';

                $sql7 = "UPDATE `available_books` SET `available_books`.`book_quantity` = `book_quantity` - 1  WHERE `available_book_no`= '$available_book_no' ";
                $result7 = mysqli_query($conn, $sql7);
                // echo 'book_quantity updated into available_books=>';

                $sql9 = "UPDATE `user_book_applied_record` SET `user_book_applied_record`.`req_book_quantity` = `req_book_quantity` + 1 WHERE `user_book_applied_record`.`user_id`= $user_id ";
                $result9 = mysqli_query($conn, $sql9);
                // echo 'req_book_quantity updated into user_book_applied_record=>';

                echo' <script> if (confirm("Successfully applied for book, You will get it by tomorrow or in 2 or 3 working days, For update please check your mail.")) {
                    console.log("yes");
                    window.location = `availableBooks`;
    
                } else {
                    console.log("no");
                    window.location = `availableBooks`;
                }</script>';
            }
        }
    } else {
        
        // echo 'first time book applied=>';
        $available_book_no = decrypt_number(32, $_POST['available_book_no']);
        // echo $available_book_no;
        
        $sql = "INSERT INTO `user_book_applied_record`( `user_id`, `req_book_quantity`) VALUES ('$user_id',1)";
        $result = mysqli_query($conn, $sql);
        // echo 'data inserted into user_book_applied_record=>';
        
        $sql6 = "SELECT * FROM `available_books` WHERE `available_books`.`available_book_no` = '$available_book_no'";
        $result6 = mysqli_query($conn, $sql6);
        $row6 = mysqli_fetch_array($result6);
        $ISBN = $row6['ISBN_No'];
        
        $sql = "INSERT INTO `applied_book`(`user_id`, `ISBN_No`,`status`) VALUES ('$user_id','$ISBN','pendding')";
        $result = mysqli_query($conn, $sql);
        // echo 'data inserted into applied_book=>';
        
        $sql7 = "UPDATE `available_books` SET `available_books`.`book_quantity` = `book_quantity` - 1  WHERE `available_book_no`= '$available_book_no' ";
        $result7 = mysqli_query($conn, $sql7);
        // echo 'book_quantity updated into available_books=>';
        
        echo' <script> if (confirm("Successfully applied for book, You will get it by tomorrow or in 2 or 3 working days, For update please check your mail.")) {
            console.log("yes");
            window.location = `availableBooks`;

        } else {
            console.log("no");
            window.location = `availableBooks`;
        }</script>';
        
    }
}
