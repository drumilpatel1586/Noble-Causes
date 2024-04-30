<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/food_donate_req.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">  
    <title>Noble Causes-Cancelled Food Pickup</title>
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
    <div class="food_donate_req">

        <div class="navbar">
            <?php include("../include/sidebar.php"); ?>
        </div>

        <div class="food_donate_req_content">
            <header>
                <div class="food_donate_req_content_title">
                    <h1>Cancelled Food Donation</h1>
                    <ul class="navigation">
                        <li class="navigation-item">
                            <a href="../include/dashboard">Dashboard</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                        <li class="navigation-item">
                            <a href="../include/cancelled_food_pickup">Cancelled Food Pickup</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                    </ul>
                </div>
            </header>

            <div class="title">
                <h3>Cancelled Food Donation Pickup By Volunteer</h3>
            </div>
            <table class="table align-middle mb-0 bg-white" cellspacing="35%" cellpadding="0">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Food Type</th>
                        <th>Specification</th>
                        <th>Cancelled By</th>
                        <th>Area</th>
                        <th>View</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php
                require('../config/db_connection.php');
                require('encrypt_decrypt.php');  
                
                $int = 1;
                $query2 = "SELECT * FROM approved_food_req WHERE `approved_food_req`.`status` = 'cancelled' ORDER BY food_id ASC";
                $result2 = mysqli_query($conn, $query2);
                while ($row = mysqli_fetch_array($result2)) { 
                    $user_id1 = encrypt_number(32,$row['user_id']);
                    $food_id1 = encrypt_number(32,$row['food_id']);
                    $i = $int++?>
                    <?php require('../config/db_connection.php');
                    $food_id=$row['food_id'];
                     $sql3 = "SELECT `v_name` FROM approved_food_req WHERE `approved_food_req`.`food_id`='$food_id'";
                     $result3 = mysqli_query($conn, $sql3);
                     $row3 = mysqli_fetch_array($result3); ?>

                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $row['food_type']; ?></td>
                            <td><?php echo $row['specifications']; ?></td>
                            <td><?php echo $row3['v_name']; ?></td>
                            <td><?php echo $row['pickup_street']; ?>,<br><?php echo $row['pickup_city']; ?></td>
                            <td>
    
                                <form action="../controller/view_details?view=dadfdsd&id=<?php echo $food_id1; ?>" method="POST">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id1; ?>">
                                    <input type="hidden" name="food_id" value="<?php echo $food_id1; ?>">
                                    <input type="submit" name="View" value="View">
                                </form>
                            </td>
                          
                            <td>
                                <form action="../controller/approve_food_req" method="POST">
                                    <input type="hidden" name="food_id" value="<?php echo $food_id1; ?>">
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