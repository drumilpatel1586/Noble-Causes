<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/manage.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes-Manage Volunteer</title>
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

        .title h3 {
            color: #000000c2;
            border-radius: 30px;
            width: 96%;
            background: var(--highlight-color);
            text-align: center;
        }

        .x {
            margin-right: 50px;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            width: auto !important;
        }

        form {
            margin-left: 30%;
            margin-bottom: 15px;
        }

        .search-input {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-right: 10px;
        }

        .search-button {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: ;
        }

        .search-button:hover {
            background-color: var(--highlight-color);
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media screen and (max-width: 600px) {
            .book_donate_req_content {
                padding: 10px;
            }
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
                    <h1>Manage Volunteer</h1>
                    <ul class="navigation">
                        <li class="navigation-item">
                            <a href="../include/dashboard">Dashboard</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                    </ul>
                </div>
            </header>

            <div class="v_Buttons"><br>
                <a href="addvolunteer"><i href="#">Add Volunteer</i></a>
            </div>

            <div class="title">
                <h3>Manage Volunteer</h3>
            </div>
            <!-- Search Form -->
            <form action="" method="GET" class="search-form">
                <input type="text" name="search_query" class="search-input" placeholder="Search...">
                <input type="submit" name="search" value="Search" class="search-button">
            </form>

            <table class="table align-middle mb-0 bg-white" cellspacing="20%" cellpadding="0">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Volunteer Name</th>
                        <th>Volunteer email</th>
                        <th>Assigned Street</th>
                        <th>Phone No.</th>
                        <th>view</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require('../config/db_connection.php');
                    $int = 1;
                    if (isset($_GET['search'])) {
                        $search_query = $_GET['search_query'];
                        $query = "SELECT * FROM volunteers WHERE v_name LIKE '%$search_query%' OR v_email LIKE '%$search_query%'";
                    } else {
                        $query = "SELECT * FROM volunteers ";
                    }
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        require_once('encrypt_decrypt.php');
                        $e_v_id = encrypt_number(16, $row['v_id']);
                        $i = $int++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $row['v_name']; ?></td>
                            <td><?php echo $row['v_email']; ?></td>
                            <td><?php echo $row['assigned_street']; ?></td>
                            <td><?php echo $row['v_phone']; ?></td>
                            <td>
                                <form action="../controller/view_details?view=asdfghjkl&v_id=<?php echo $e_v_id; ?>" method="POST">
                                    <input type="hidden" name="v_id" value="<?php echo $e_v_id; ?>">
                                    <input class="x" type="submit" name="View" value="View">
                                </form>
                            </td>
                            <td>
                                <form action="../controller/manage_volunteer" method="POST">
                                    <input type="hidden" name="v_id" value="<?php echo $e_v_id; ?>">
                                    <input class="x" type="submit" name="delete" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>


        </div>

    </div>
</body>

</html>