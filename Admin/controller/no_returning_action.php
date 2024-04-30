<?php
require_once('../config/db_connection.php');
require_once('../include/encrypt_decrypt.php');


    $user_id = decrypt_number(32,$_POST['user_id']);
    // echo $user_id.'=>';

    
    $book_title = $_POST['book_title'];
    // echo $book_title.'=>';
    
    $deadline_date = $_POST['deadline_for_book'];
    // echo $deadline_date.'=>';

    $ISBN_No = $_POST['isbn_no'];
    // echo $ISBN_No.'=>';

    // echo $user_id .'=>'; 
    if($action = 'bsdibadjbsib'){
        echo 'get send warning=>';

        require('../include/remainder.php'); 

        echo' <script> if (confirm("Remainder mail sent.")) {
            console.log("yes");
            window.location = `../include/not_return_book.php`;

        }else{
            console.log("cancelled");
            window.location = `../include/not_return_book.php`;

        }</script>';     

    } elseif($action == 'asnofhsdsdsd') {
        echo 'remove user =>';

        $query = "DELETE FROM `user_login` WHERE `user_id` = '$user_id'";
        $result = mysqli_query($conn, $query);

        echo' <script> if (confirm("User removed.")) {
            console.log("yes");
            window.location = `../include/not_return_book.php`;

        }else{
            console.log("cancelled");
            window.location = `../include/not_return_book.php`;

        }</script>'; 

    }
