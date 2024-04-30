<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cms_fd_page.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes-CMS-Food Donation Page</title>
</head>

<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
    header("Location: admin_login");
} ?>

<body>
    <div class="navbar">
        <?php include_once("sidebar.php"); ?>
    </div>
    <div class="cms_food_donation_page_content">
        <div class="header">
            <header>
                <div class="cms_food_donation_page_title">
                    <h1>Noble Causes - Food Donation Page</h1>
                    <ul class="navigation">
                        <li class="navigation-item">
                            <a href="../include/dashboard">Dashboard</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                        <li class="navigation-item">
                            <a href="../include/cms_home_page">Home Page</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                    </ul>
                </div>
            </header>
            <div class="fd_Buttons"><br>
                <a href="../controller/add_content?add_to=fd"><i href="#">Add content</i></a>
            </div>
        </div>
        <?php
        require("../config/db_connection.php");
        $query = "SELECT * FROM cms_fd ";
        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) { ?>
                <div class="cms_fd_page_main">
                    <div class="fd_page_image">
                        <div class="title">
                            <h3><?php echo $row['fd_title']; ?></h3>
                        </div>
                    </div>
                    <div class="container">
                        <div class="card1">
                            <img class="cms_fd_img" src="../NC_Images/<?php echo $row['fd_image']; ?>" alt="<?php echo $row['fd_image']; ?>">
                        </div>
                        <div class="card2">
                            <div class="input-box">
                                <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['fd_title']; ?></label>
                            </div>
                            <div class="input-box">
                                <label> <i class="lable_title"></i><br>Description:</label>
                                <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['fd_description'] ?></label>
                            </div>
                            <div class="form_button">
                                <form action="../include/cms_fd_data_edit?cms_fd_id=<?php echo $row['cms_fd_id']; ?>" class="form" method="POST">
                                    <div class="input-box"><br>
                                        <button type="submit" name="update">Update</button>
                                    </div>
                                </form>
                                <form method="POST" action="../controller/delete_content?delete_from=fd&cms_fd_id=<?php echo $row['cms_fd_id']; ?>">
                                <div class="input-box"><br>
                                    <button type="submit" name="delete">Delete</button>
                                </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
        <?php }
        } ?>
</body>