<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/manage.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes-Manage User</title>
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

        .title h3 {
            color: #000000c2;
            border-radius: 30px;
            width: 96%;
            background: var(--highlight-color);
            text-align: center;
        }

        table th {
            text-align: center;
        }

        table td {
            text-align: center;
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
    /* Style for the search form */
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
        background-color:  var(--highlight-color);
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
                    <h1>Manage User</h1>
                    <ul class="navigation">
                        <li class="navigation-item">
                            <a href="../include/dashboard">Dashboard</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                    </ul>
                </div>
            </header>

            <div class="searchuser">
                <div class="title">

                    <h3>Manage User</h3>

                </div>

                <form action="" method="GET">
                    <input type="text" name="search_query" class="search-input" placeholder="Search...">
                    <input type="submit" name="search" value="Search" class="search-button">
                </form>

                <table class="table align-middle mb-0 bg-white" cellspacing="50%" cellpadding="0">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>User Name</th>
                            <th>User email</th>
                            <th>Phone No.</th>
                            <th>view</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require('../config/db_connection.php');
                        require_once 'encrypt_decrypt.php';

                        if (isset($_GET['search'])) {
                            $search_query = $_GET['search_query'];
                            $query = "SELECT * FROM user_login WHERE `name` LIKE '%$search_query%' OR `email` LIKE '%$search_query%'";
                        } else {
                            $query = "SELECT * FROM user_login";
                        }

                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $int = 1;
                            while ($row = mysqli_fetch_array($result)) {
                                $e_user_id = encrypt_number(32, $row['user_id']);
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $int; ?></th>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td>
                                        <form action="../controller/view_details?view=dfsdmufsdv&id=<?php echo $e_user_id; ?>" method="POST">
                                            <input type="hidden" name="user_id" value="<?php echo $e_user_id; ?>">
                                            <input type="submit" name="View" value="View">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="../controller/manage_user" method="POST">
                                            <input type="hidden" name="user_id" value="<?php echo $e_user_id; ?>">
                                            <input type="submit" name="delete" value="delete">
                                        </form>
                                    </td>
                                </tr>
                        <?php
                                $int++;
                            }
                        } else {
                            echo "<tr><td colspan='6'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>

          
            </div>

        </div>
</body>

</html>