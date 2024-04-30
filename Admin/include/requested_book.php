<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/requested_book.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes-Requested Book</title>
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
        width: 100%;
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
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
    header("Location: admin_login");
} ?>

<body>
    <div class="requested_book">
        <div class="navbar">
            <?php include("../include/sidebar.php"); ?>
        </div>

        <div class="requested_book_content">
            <header>
                <div class="requested_book_content_title">
                    <h1>Requested Book by User</h1>
                    <ul class="navigation">
                        <li class="navigation-item">
                            <a href="../include/dashboard">Dashboard</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                        <li class="navigation-item">
                            <a href="../include/requested_book">Requested Book</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                    </ul>
                </div>
            </header>

            
            <div class="title">
                <h3>Food Donation Request</h3>
            </div>

            <table class="table align-middle mb-0 bg-white" cellspacing="30%" cellpadding="0" row-gap-sm-2 style ="text-align:center">
                <thead class="bg-light">
                    <tr>
                        <th>No.</th>
                        <th>Request By</th>
                        <th>Book Title</th>
                        <th>Book Author</th>
                        <th>Course</th>
                        <th>Available Book</th>
                        <th>Applied Date</th>
                        <th>Approve</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    require('../config/db_connection.php');
                    require('../include/encrypt_decrypt.php');
                    $int = 1;
                    $query = "SELECT * FROM `applied_book` WHERE `applied_book`.`status`='pendding'  ORDER BY `applied_book`.`ab_id` ASC";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {

                        $ab_id = encrypt_number(32, $row['ab_id']);
                        $user_id = $row['user_id'];
                        $ISBN = $row['ISBN_No'];
                        // echo $ISBN;

                        $sql2 = "SELECT * FROM `book_record` WHERE `book_record`.`ISBN_No`='$ISBN'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_array($result2);
                        
                        $sql45 = "SELECT `book_quantity` FROM `available_books` WHERE `available_books`.`ISBN_No`='$ISBN'";
                        $result45 = mysqli_query($conn, $sql45);
                        $row45 = mysqli_fetch_array($result45);

                        $sql3 = "SELECT `name` FROM `user_login` WHERE `user_login`.`user_id`='$user_id'";
                        $result3 = mysqli_query($conn, $sql3);
                        $row3 = mysqli_fetch_array($result3);

                        $i = $int++ ?>

                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $row3['name']; ?></td>
                            <td><?php echo $row2['title']; ?></td>
                            <td><?php echo $row2['author']; ?></td>
                            <td><?php echo $row2['course']; ?></td>
                            <td><?php echo $row45['book_quantity'] + 1 ; ?></td>
                            <td><?php echo $row['applied_date']; ?></td>
                         
                            <td>
                                <form action="../controller/approve_applied_book_req" method="POST">
                                    <input type="hidden" name="available_book_id" value="<?php echo $ab_id; ?>">
                                    <input type="submit" name="approve" value="approve">
                                </form>
                            </td>
                            <td>
                                <form action="../controller/approve_applied_book_req" method="POST">
                                    <input type="hidden" name="available_book_id" value="<?php echo $ab_id; ?>">
                                    <input type="submit" name="delete" value="delete">
                                </form>
                            </td>
                        </tr>
                </tbody>
            <?php } ?>
            </table>

        </div>

    </div>
</body>

</html>