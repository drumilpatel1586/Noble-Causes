<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cms_bd_page.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes-CMS-Book Donation Form</title>
    <style>
        .type-option {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            flex-direction: row;
        }

        .option {
            text-align: center;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 400px;
            height: 400px;
        }

        .option img {
            width: 400px;
            height: 379px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;

        }

        .Buttons {
            text-align: center;
            color: var(--text-color);
            text-decoration: none;
            display: block;
            width: 20%;
            font-size: 18px;
            font-weight: 500;
            padding: 10px 25px;
            margin-left: 40%;
            border-radius: 10px;
            background: #e0e0e0;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        }

        input[type="radio"] {
            /* display: none;F */
        }

        img:hover {
            cursor: pointer;
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
    <div class="navbar">
        <?php include_once("sidebar.php"); ?>
    </div>
    <div class="cms_book_donation_page_content">
        <div class="header">
            <header>
                <div class="cms_book_donation_page_title">
                    <h1>Noble Causes - CMS Book Donation Page</h1>
                    <ul class="navigation">
                        <li class="navigation-item">
                            <a href="../include/dashboard">Dashboard</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                        <li class="navigation-item">
                            <a href="../include/cms_book_donation_form">CMS Book Donation Form</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                    </ul>
                </div>
            </header>

        </div>

        <?php
        require_once('../config/db_connection.php');
        $sql = "SELECT * FROM cms_bdf WHERE bdf_set = 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        
        if ($row['bdf_id']==1){?>

        <form action="../controller/cms_bdf" method="POST">
            <div class="option-container">


                <div class="option-container">

                    <div class="type-option">
                        <div class="option">
                            <input type="radio" id="check-fdf_form1" name="donate_to" value="1" checked/>
                            <label for="check-fdf_form1"><img src="../NC_Images/<?php
                                                                                require_once('../config/db_connection.php');
                                                                                $sql = "SELECT * FROM cms_bdf WHERE bdf_id = 1";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                $row = mysqli_fetch_assoc($result);
                                                                                $path = $row['bdf_img'];
                                                                                echo $path;
                                                                                ?>" alt="Option 1"></label>
                        </div>
                        <div class="option">
                            <input type="radio" id="check-peoples" name="donate_to" value="2" />
                            <label for="check-peoples"><img src="../NC_Images/<?php
                                                                                require_once('../config/db_connection.php');
                                                                                $sql = "SELECT * FROM cms_bdf WHERE bdf_id = 2";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                $row = mysqli_fetch_assoc($result);
                                                                                $path = $row['bdf_img'];
                                                                                echo $path;
                                                                                ?>" alt="Option 1"></label>
                        </div>

                    </div>
                </div>

            </div>
            <button class="Buttons" type="submit" name="submit">Change Form</button>
        </form>
    

             <?php }else{  ?>
        
        <form action="../controller/cms_bdf" method="POST">
            <div class="option-container">
        
        
                <div class="option-container">
        
                    <div class="type-option">
                        <div class="option">
                            <input type="radio" id="check-fdf_form1" name="donate_to" value="1" />
                            <label for="check-fdf_form1"><img src="../NC_Images/<?php
                                                                                require_once('../config/db_connection.php');
                                                                                $sql = "SELECT * FROM cms_bdf WHERE bdf_id = 1";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                $row = mysqli_fetch_assoc($result);
                                                                                $path = $row['bdf_img'];
                                                                                echo $path;
                                                                                ?>" alt="Option 1"></label>
                        </div>
                        <div class="option">
                            <input type="radio" id="check-peoples" name="donate_to" value="2" checked   />
                            <label for="check-peoples"><img src="../NC_Images/<?php
                                                                                require_once('../config/db_connection.php');
                                                                                $sql = "SELECT * FROM cms_bdf WHERE bdf_id = 2";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                $row = mysqli_fetch_assoc($result);
                                                                                $path = $row['bdf_img'];
                                                                                echo $path;
                                                                                ?>" alt="Option 1"></label>
                        </div>
                        
                    </div>
                </div>
        
            </div>
            <button class="Buttons" type="submit" name="submit">Change Form</button>
        </form>
            <?php }?>
    </div>
 
 
</body>