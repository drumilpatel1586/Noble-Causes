<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/book_donate_req.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes-Cancelled Book Pickup</title>
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
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
    header("Location: admin_login");
} ?>

<body>
    <div class="book_donate_req">

        <div class="navbar">
            <?php include("../include/sidebar.php"); ?>
        </div>

        <div class="book_donate_req_content">
            <header>
                <div class="book_donate_req_content_title">
                    <h1>Cancelled Book Donation</h1>
                    <ul class="navigation">
                        <li class="navigation-item">
                            <a href="../include/dashboard">Dashboard</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                        <li class="navigation-item">
                            <a href="../include/cancelled_book_pickup">Cancelled Book Pickup</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                    </ul>
                </div>
            </header>

            <div class="title">
                <h3>Cancelled Book Donation Pickup By Volunteer</h3>
            </div>
            <table class="table align-middle mb-0 bg-white" cellspacing="30%" cellpadding="0" row-gap-sm-2>
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <!-- <th>Book_Image</th> -->
                        <th>Book Title</th>
                        <th>Book Author</th>
                        <th>Course</th>
                        <th>Cancelled By</th>
                        <th>Cancelled Date</th>
                        <th>View</th>
                        <th>Delete</th>

                    </tr>
                </thead>
                <?php
                ?>
                <?php
                require('../config/db_connection.php');
                require('../include/encrypt_decrypt.php');
                $int = 1;
                $query = "SELECT * FROM approved_book_req WHERE `approved_book_req`.`status` = 'pickupfailed' ORDER BY book_id ASC";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) {
                    $book_id = encrypt_number(32, $row['book_id']);
                    $b_id = $row['book_id'];
                    $sql3 = "SELECT `v_name` FROM approved_book_req WHERE `approved_book_req`.`book_id`='$b_id'";
                    $result3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_array($result3);
                    $i = $int++ ?>
                    <tbody>

                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <!-- <td><?php echo $row['image']; ?></td> -->
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['author']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row3['v_name']; ?></td>
                            <td><?php echo $row['pickup_date']; ?></td>
                            <td>
                                <form action="../controller/view_details?view=cabdsd&id=<?php echo $book_id; ?>" method="POST">
                                    <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                                    <input type="submit" name="view" value="view">
                                </form>
                            </td>
                            <td>
                                <form action="../controller/approve_book_req" method="POST">
                                <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                                    <input type="submit" name="Delete" value="Delete">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>


    </div>
    </div>
</body>

</html>