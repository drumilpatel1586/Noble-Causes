<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/manage.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes-Volunteer Required Area</title>
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
                    <h1>Volunteer Required Area</h1>
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
                <h3>Volunteer Required Area</h3>
            </div>

            <table class="table align-middle mb-0 bg-white" cellspacing="30%" cellpadding="0">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>Zip Code</th>
                        <th>Add Volunteer</th>
                        <th>view</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php
                require('../config/db_connection.php');
                require('encrypt_decrypt.php');
                $int = 1;
                $query = "SELECT * FROM v_required_area";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) {
                    $_ = $row['v_required_id'];
                    $v_req_area = encrypt_number(32, $_);
                    $i = $int++ ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $row['v_required_street']; ?></td>
                            <td><?php echo $row['v_required_city']; ?></td>
                            <td><?php echo $row['v_required_zip_code']; ?></td>
                            <td>
                                <form action="add_r_volunteer" method="POST">
                                    <input type="hidden" name="v_required_id" value="<?php echo $row['v_required_id']; ?>">
                                    <input type="submit" name="add_volunteer" value="add_volunteer">
                                </form>
                            </td>
                            <td>

                                <form action="../controller/view_details?view=sddfbyg&v_required_id=<?php echo $v_req_area; ?>" method="POST">
                                    <input type="hidden" name="v_required_id" value="<?php echo $v_req_area; ?>">
                                    <input type="submit" name="View" value="View">
                                </form>
                            </td>
                            <td>
                                <form action="../controller/manage_volunteer" method="POST">
                                    <input type="hidden" name="v_required_id" value="<?php echo  $v_req_area; ?>">
                                    <input type="submit" name="Delete" value="Delete">
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