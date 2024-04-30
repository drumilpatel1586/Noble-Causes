<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/manage.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes-Manage Daily Donated Food</title>
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
                    <h1>Manage Daily Donated Food</h1>
                    <ul class="navigation">
                        <li class="navigation-item">
                            <a href="../include/dashboard">Dashboard</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                    </ul>
                </div>
            </header>

            <!-- <table class="table align-middle mb-0 bg-white" cellspacing="50%" cellpadding="0">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>User_Name</th>
                        <th>User_email</th>
                        <th>Phone No.</th>
                        <th>view</th>   
                        <th>Delete</th>
                    </tr>
                </thead>
                    <?php
                    require('../config/db_connection.php');
                    $query = "SELECT * FROM user_login";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) { ?>
                <tbody>                    
                    <tr>
                        <th scope="row"><?php echo $row['user_id']; ?></th>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td>
                            <form action="../controller/view_details?view=mu&id=<?php echo $row['user_id']; ?>" method="POST">                            
                            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                            <input type="submit" name="View" value="View">                           
                        </form>
                    </td>                        
                        <td><form action="../controller/manage_user" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                            <input type="submit" name="delete" value="delete">                           
                        </form></td>                        
                    </tr>
                </tbody>
                   <?php } ?>
            </table> -->
            <div class="title">
                <h3>Daily Donated Food</h3>
                <table class="table align-middle mb-0 bg-white" cellspacing="40%" cellpadding="0">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Doner Name</th>
                            <th>Food_Type</th>
                            <th>Validity</th>
                            <th>Specification</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <?php
                    require('../config/db_connection.php');
                    $int = 1;
                    $query = "SELECT * FROM approved_food_req WHERE `freq_of_donation`='Daily - evening'OR `freq_of_donation`='Daily - afternoon'OR  `freq_of_donation`='Daily - morning'  ORDER BY food_id ASC";
                    $result = mysqli_query($conn, $query);
                    if ($result->num_rows > 0) {
                            
                        while ($row = mysqli_fetch_array($result)) {
                            $user_id =$row['user_id'];
                            $sql2 = "SELECT `name` FROM `user_login` WHERE `user_id`='$user_id'";
                            $result2 = mysqli_query($conn,$sql2);
                            $row2 = mysqli_fetch_array($result2);
                            require_once('encrypt_decrypt.php'); 
                            $e_f_id= encrypt_number(16,$row['food_id']);
                            $e_u_id= encrypt_number(16,$row['food_id']);
                            $i = $int++
                            ?>
                            <tbody>
                                <tr>

                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $row2['name']; ?></td>
                                    <td><?php echo $row['food_type']; ?></td>
                                    <td><?php echo $row['validity']; ?></td>
                                    <td><?php echo $row['specifications']; ?></td>
                                    <td>

                                        <form action="../controller/view_details?view=asddfbyg&id=<?php echo $e_f_id; ?>" method="POST">
                                            <input type="hidden" name="food_id" value="<?php echo $e_f_id; ?>">
                                            <input type="submit" name="View" value="View">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="../controller/approve_food_req" method="POST">
                                            <input type="hidden" name="food_id" value="<?php echo $e_f_id; ?>">
                                            <input type="submit" name="Delete" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                
                                <?php }
                    } else {
                        echo '<td>no record found</td>';
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html>