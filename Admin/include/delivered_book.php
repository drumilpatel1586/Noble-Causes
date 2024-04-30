<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/book_donate_req.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes - Delivered Book Record</title>
    <style>
    .btn {
        display: block;
        display: flex;
        justify-content: center;
        flex-direction: row;
        margin-left: 4px;
        align-content: space-around;
    }

    .ru {
        margin-left: 4px;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .book_donate_req {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .navbar {
        flex: 0 0 auto;
    }

    .book_donate_req_content {
        flex: 1 0 auto;
        padding: 20px;
    }

    .title {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 90%;
        border-collapse: collapse;
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    .table-responsive {
        overflow-x: auto;
    }

    @media screen and (max-width: 600px) {
        .book_donate_req_content {
            padding: 10px;
        }
    }
</style>
</head>

<?php  
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

}else{
  header("Location: admin_login");
}?>

<body>
    <div class="book_donate_req">
        <div class="navbar">
            <?php include("../include/sidebar.php"); ?>
        </div>

        <div class="book_donate_req_content">
            <header>
                <div class="book_donate_req_content_title">
                    <h1>Delivered Book Record</h1>
                    <ul class="navigation">
                        <li class="navigation-item">
                            <a href="../include/dashboard">Dashboard</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                        <li class="navigation-item">
                            <a href="../include/delivered_book">Delivered Book Record</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                    </ul>
                </div>
            </header>

            <div class="title">
                <h3>Delivered Book Record</h3>
            </div>

            <table class="table align-middle mb-0 bg-white" cellspacing="30%" cellpadding="0" row-gap-sm-2>
                <thead class="bg-light">
                    <tr>
                        <th>No.</th>
                        <!-- <th>Book_Image</th> -->
                        <th>Book Title</th>
                        <th>Course</th>
                        <th>Sub Course</th>
                        <th>Delivered To</th>
                        <th>Deadline</th>
                    </tr>
                </thead>
                <?php 
                ?>
                    <?php
                    require('../config/db_connection.php');
                    require('../include/encrypt_decrypt.php');
                    $int = 1;
                    $query = "SELECT * FROM delivered_book WHERE `delivered_book`.`status` = 'delivered' ORDER BY delivered_id ASC";
                    $result=mysqli_query($conn,$query);
                    while($row = mysqli_fetch_array($result)){
                        $delivered_id = encrypt_number(32,$row['delivered_id']);
                        $ISBN_No = $row['ISBN_No'];
                        $deadline_for_book = $row['deadline_for_book'];
                        $user_id = $row['user_id'];

                        $sql3 = "SELECT * FROM user_login WHERE user_login.user_id = $user_id";
                        $result3=mysqli_query($conn,$sql3);
                        $row3 = mysqli_fetch_array($result3); 

                        $sql2 = "SELECT * FROM `book_record` WHERE `book_record`.`ISBN_No`='$ISBN_No'";
                        $result2=mysqli_query($conn,$sql2);
                        $row2 = mysqli_fetch_array($result2);
                        $book_title = $row2['title'];
                        $course = $row2['course'];
                        $sub_course = $row2['sub_course'];

                        $i = $int++?>
                <tbody>

                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <!-- <td><?php echo$row['image']; ?></td> -->
                        <td><?php echo $book_title ?></td>
                        <td><?php echo$course ?></td>
                        <td><?php echo$sub_course ?></td>
                        <td><?php echo$row3['name']; ?></td>
                        <td><?php echo$deadline_for_book ?></td>
                    </tr>
                </tbody>
                   <?php } ?>
            </table>
        </div>

    </div>
</body>

</html>