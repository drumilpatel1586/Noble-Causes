<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">

    <!-- CSS Links -->
    <link rel="stylesheet" href="../css/cms_about_us.css">
    <link rel="stylesheet" href="../css/sidebar.css">

    <title>Noble Causes-CMS-ContactUs Page</title>

    <?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    } else {
        header("Location: admin_login");
    } ?>

</head>

<body>

    <div class="navbar">
        <?php include_once("sidebar.php"); ?>
    </div>
    <div class="cms_home_page_content">
        <div class="header">
            <header>
                <div class="cms_home_page_title">
                    <h1>Noble Causes - About Us</h1>
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
        </div>

        <!-- Page Start -->
        <div class="cms_aboutUs_main">
            <div class="aboutUs_image">
                <div class="title">
                    <h3>About Us heading Image</h3>
                </div>

                <div class="container">
                    <?php
                    require("../config/db_connection.php");
                    $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = '1'";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="card1">
                            <img class="cms_au_img" src="../NC_Images/<?php echo $row['au_image']; ?>" alt="<?php echo $row['au_image']; ?>">
                        </div>
                        <div class="card2">
                            <form action="../include/cms_au_data_edit?cms_au_id=1" class="form" method="POST">
                                <div class="input-box">
                                    <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                    <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['au_title']; ?></label>
                                </div>
                                <div class="input-box">
                                    <label> <i class="lable_title"></i><br>Description:</label>
                                    <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['au_description'] ?></label>
                                </div>
                                <div class="input-box"><br>
                                    <button type="submit" name="update">Update</button>
                                </div>
                            </form>
                        <?php } ?>

                        </div>
                </div>
            </div>
        </div>

        <div class="cms_home_page_main">
            <div class="home_page_card_header">

                <!-- Container-2 -->
                <div class="home_page_image">
                    <div class="title">
                        <h3>Our Mission Image</h3>
                    </div>

                    <div class="container">
                        <?php
                        require("../config/db_connection.php");
                        $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = '2'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) { ?>

                            <div class="card1">
                                <img class="cms_au_img" src="../NC_Images/<?php echo $row['au_image']; ?>" alt="<?php echo $row['au_title'] ?>">
                            </div>
                            <div class="card2">
                                <form action="../include/cms_au_data_edit?cms_au_id=2" class="form" method="POST">
                                    <div class="input-box">
                                        <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                        <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['au_title']; ?></label>
                                    </div>
                                    <div class="input-box">
                                        <label> <i class="lable_title"></i><br>Description:</label>
                                        <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['au_description'] ?></label>
                                    </div>
                                    <div class="input-box"><br>
                                        <button type="submit" name="update">Update</button>
                                    </div>
                                </form>
                            <?php } ?>
                            </div>
                    </div>
                </div>

                <!-- Container-3 -->
                <div class="cms_home_page_main">
                    <div class="home_page_image">
                        <div class="title">
                            <h3>Our Mission</h3>
                        </div>

                        <div class="container">
                            <?php
                            require("../config/db_connection.php");
                            $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = '3'";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) { ?>

                                <div class="card1">
                                    <img class="cms_au_img" src="../NC_Images/<?php echo $row['au_image']; ?>" alt="<?php echo $row['au_title'] ?>">
                                </div>
                                <div class="card2">
                                    <form action="../include/cms_au_content_edit?cms_au_id=3" class="form" method="POST">
                                        <div class="input-box">
                                            <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['au_title']; ?></label>
                                        </div>
                                        <div class="input-box">
                                            <label> <i class="lable_title"></i><br>Description:</label>
                                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['au_description'] ?></label>
                                        </div>
                                        <div class="input-box"><br>
                                            <button type="submit" name="update">Update</button>
                                        </div>
                                    </form>
                                <?php } ?>
                                </div>
                        </div>

                    </div>
                </div>

                <!-- Container-4 -->
                <div class="cms_home_page_main">
                    <div class="home_page_image">
                        <div class="title">
                            <h3>Food Donation</h3>
                        </div>

                        <div class="container">
                            <?php
                            require("../config/db_connection.php");
                            $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = '4'";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) { ?>

                                <div class="card1">
                                    <img class="cms_au_img" src="../NC_Images/<?php echo $row['au_image']; ?>" alt="<?php echo $row['au_title'] ?>">    
                                </div>
                                <div class="card2">
                                    <form action="../include/cms_au_content_edit?cms_au_id=4" class="form" method="POST">
                                        <div class="input-box">
                                            <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['au_title']; ?></label>
                                        </div>
                                        <div class="input-box">
                                            <label> <i class="lable_title"></i><br>Description:</label>
                                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['au_description'] ?></label>
                                        </div>
                                        <div class="input-box"><br>
                                            <button type="submit" name="update">Update</button>
                                        </div>
                                    </form>
                                <?php } ?>
                                </div>
                        </div>

                    </div>
                </div>

                <!-- Container-5 -->
                <div class="cms_home_page_main">
                    <div class="home_page_image">
                        <div class="title">
                            <h3>Volunteer</h3>
                        </div>

                        <div class="container">
                            <?php
                            require("../config/db_connection.php");
                            $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = '5'";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) { ?>

                                <div class="card1">
                                    <img class="cms_au_img" src="../NC_Images/<?php echo $row['au_image']; ?>" alt="<?php echo $row['au_title'] ?>">
                                </div>
                                <div class="card2">
                                    <form action="../include/cms_au_content_edit?cms_au_id=5" class="form" method="POST">
                                        <div class="input-box">
                                            <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['au_title']; ?></label>
                                        </div>
                                        <div class="input-box">
                                            <label> <i class="lable_title"></i><br>Description:</label>
                                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['au_description'] ?></label>
                                        </div>
                                        <div class="input-box"><br>
                                            <button type="submit" name="update">Update</button>
                                        </div>
                                    </form>
                                <?php } ?>
                                </div>
                        </div>

                    </div>
                </div>

                <!-- Container-6 -->
                <div class="cms_home_page_main">
                    <div class="home_page_image">
                        <div class="title">
                            <h3>Book Donation</h3>
                        </div>

                        <div class="container">
                            <?php
                            require("../config/db_connection.php");
                            $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = '6'";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) { ?>

                                <div class="card1">
                                    <img class="cms_au_img" src="../NC_Images/<?php echo $row['au_image']; ?>" alt="<?php echo $row['au_title'] ?>">
                                </div>
                                <div class="card2">
                                    <form action="../include/cms_au_content_edit?cms_au_id=6" class="form" method="POST">
                                        <div class="input-box">
                                            <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['au_title']; ?></label>
                                        </div>
                                        <div class="input-box">
                                            <label> <i class="lable_title"></i><br>Description:</label>
                                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['au_description'] ?></label>
                                        </div>
                                        <div class="input-box"><br>
                                            <button type="submit" name="update">Update</button>
                                        </div>
                                    </form>
                                <?php } ?>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>