<?php
require_once('../config/db_connection.php');
require_once('../include/encrypt_decrypt.php');

$view = $_GET['view'];

// manage user
if ($view == 'dfsdmufsdv') {

    $id = decrypt_number(32, $_POST['user_id']);
    $sql = "SELECT * FROM `user_login` WHERE user_id ='$id';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sql2 = "SELECT `donation_quantity` FROM `user_donation_quantity_record` WHERE user_id ='$id';";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    if ($result2->num_rows > 0) {
        $donation_quantity = $row2['donation_quantity'];
    } else {
        $donation_quantity = 0;
    }
    include("../include/sidebar.php"); 


    echo '
    <head>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes - View</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/view_details.css" />
    <link rel="stylesheet" href="../css/manage.css">
    </head>
    <body>
    <div class="food_donate_req">

        <div class="navbar">
            <?php include("../include/sidebar.php"); ?>
        </div>

        <div class="food_donate_req_content">
    <section class="container">
    <form action="../include/manage_user"><button type="submit"><i class="close bx bx-x-circle"></i></button></form>
    <header>User Details</header>
    <form action="#" method="POST" class="form">
    <table cellspacing=30%>
        <div class="input-box">
            <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> User Name:</td>
            <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['name'] . '</td></tr>
        </div>
        <div class="input-box">
        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> User Email:</td>
            <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['email'] . '</td></tr>
        </div>
        <div class="input-box">
        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Phone No.:</td>
            <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['phone'] . '</td></tr>
        </div>
        <div class="input-box">
        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Gender:</td>
            <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['gender'] . '</td><tr>
        </div>
        <div class="input-box">
        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Total Donation:</td>
            <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $donation_quantity . '</td><tr>
        </div>
        <div class="input-box">
        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Area:</td>
            <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['street'] . ',' . $row['city'] . ',' . $row['zip_code'] . '</td></tr>
        </div>
        </table>
    </form>
</section>
</body> ';
} else {
    if ($view == 'dadfdsd') {
        // $id = $_GET['id']; 
        $id = decrypt_number(32, $_POST['food_id']);
        // view food details
        $sql = "SELECT * FROM `donate_food` WHERE food_id ='$id';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $sql2 = "SELECT `name` FROM `user_login` WHERE user_id = '$row[user_id]';";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);



        include("../include/sidebar.php");
        echo '
        <head>
        
        <div class="food_donate_req_content">
        <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
        <title>Noble Causes - Donated Food View</title>
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/view_details.css" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/food_donate_req.css">
        <link rel="stylesheet" href="../css/sidebar.css">
        
        </head>
        <body>
        <div class="food_donate_req">

        <div class="navbar">

        </div>
        <section class="container">
        <form action="../include/food_donate_req"><button type="submit"><i class="close bx bx-x-circle"></i></button></form>
        <header>Food Donation Details</header>
        <form action="#" method="POST" class="form">
        <table cellspacing=10%>
            <div class="input-box">
                <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>Doner Name:</td>
                <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row2['name'] . '</td></tr>
            </div>
            <div class="input-box">
            <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>frequency of Donation:</td>
                <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['freq_of_donation'] . '</td></tr>
            </div>
            <div class="input-box">
            <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Food Type:</td>
                <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['food_type'] . '</td></tr>
            </div>
            <div class="input-box">
            <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Donate To:</td>
                <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['donate_to'] . '</td></tr>
            </div>
            <div class="input-box">
            <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Food validity:</td>
                <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['validity'] . '</td><tr>
            </div>
            <div class="input-box">
            <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Food Specification:</td>
                <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['specifications'] . '</td><tr>
            </div>
            <div class="input-box">
            <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Area:</td>
                <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['pickup_street'] . ',' . $row['pickup_city'] . ',' . $row['pickup_zip_code'] . '</td></tr>
            </div>
            </table>
        </form>
    </section>
    </body> ';
    } else {
        if ($view == 'cabdsd') {

            // $id = $_GET['id'];
            $id = decrypt_number(32, $_POST['book_id']);
            $sql = "SELECT * FROM `donate_book` WHERE book_id ='$id';";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $sql2 = "SELECT `name` FROM `user_login` WHERE user_id = '$row[user_id]';";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            include("../include/sidebar.php");

            echo '
            <head>
            <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
            <title>Noble Causes - View</title>
            <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../css/book_donate_req.css">   
            <link rel="stylesheet" href="../css/view_details.css" />
            <link rel="stylesheet" href="../css/sidebar.css">
            </head>
            <body>
            <div class="book_donate_req">
            <div class="navbar">
            </div>
    
            <div class="book_donate_req_content">
            <section class="container ">
            <form action="../include/book_donate_req"><button type="submit"><i class="close bx bx-x-circle"></i></button></form>
            <header>Book Donation Details</header>
            <div class="flex">
            <div class="card1">
            <form action="#" method="POST" class="form">
            <table cellspacing=10%>
            <div class="input-box">
            <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>Doner Name</td>
            <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' . $row2['name'] . '</td></tr>
            </div>
            <div class="input-box">
            <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>Book Title</td>
            <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' . $row['title'] . '</td></tr>
            </div>
            <div class="input-box">
            <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Book Author</td>
            <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' . $row['author'] . '</td></tr>
            </div>
                <div class="input-box">
                <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Course</td>
                <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' . $row['course'] . '</td></tr>
                </div>
                <div class="input-box">
                <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>Sub Course</td>
                <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' . $row['sub_course'] . '</td></tr>
                </div>
                <div class="input-box">
                <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Pickup Date</td>
                <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' . $row['pickup_date'] . '</td><tr>
                </div>
                <div class="input-box">
                <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Area</td>
                <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' . $row['pickup_street'] . ',' . $row['pickup_city'] . ',' . $row['pickup_zip_code'] . '</td></tr>
                </div>
                </div>
                </table>
            </form>
            </div>
            <div class="card2">
            <div class="input-box">
                <img class="img" src="../../user/BookImage/' . $row['image'] . '" alt="not found"></img>
                </div>
            </div>
        </section>
        </div>
        </body> ';
        } else {
            // volunteer view
            if ($view == 'asdfghjkl') {
                $id = $_POST['v_id'];
                // echo $id;
                $d_v_id = decrypt_number(16, $id);
                // echo $d_v_id;
                $sql = "SELECT * FROM `volunteers` WHERE v_id ='$d_v_id';";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                // $sql2 = "SELECT `name` FROM `user_login` WHERE user_id = '$row[user_id]';";
                // $result2 = mysqli_query($conn, $sql2);
                // $row2 = mysqli_fetch_assoc($result2);
                include("../include/sidebar.php"); 

                echo '
                <head>
                <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
                <title>Noble Causes - View</title>
                <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
                <link rel="stylesheet" href="../css/view_details.css" />
                <link rel="stylesheet" href="../css/manage.css">
                </head>
                <body>
                <div class="food_donate_req">

                    <div class="navbar">
                     </div>

        <div class="food_donate_req_content">
                <section class="container">
                <form action="../include/manage_volunteer"><button type="submit"><i class="close bx bx-x-circle"></i></button></form>
                <header>Volunteer Details</header>
                <form action="#" method="POST" class="form">
                <table cellspacing=10%>
                    <div class="input-box">
                        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>Volunteer Name:</td>
                        <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['v_name'] . '</td></tr>
                    </div>
                    <div class="input-box">
                    <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>Volunteer Email:</td>
                        <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['v_email'] . '</td></tr>
                    </div>
                    <div class="input-box">
                    <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>Phone No.:</td>
                        <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['v_phone'] . '</td></tr>
                    </div>
                    <div class="input-box">
                    <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Gender:</td>
                        <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['v_gender'] . '</td></tr>
                    </div>
                    <div class="input-box">
                    <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> assigned_area:</td>
                        <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['assigned_area'] . ',' . $row['assigned_zip_code'] . '</td><tr>
                    </div>
                    <div class="input-box">
                    <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Volunteer Address:</td>
                        <td><i class="a fa fa-envelope" aria-hidden="true"></i> ' . $row['v_street'] . ',' . $row['v_city'] . ',' . $row['v_zip'] . '</td></tr>
                    </div>
                    </table>
                </form>
            </section>
            </body> ';
            } else {
                //daily donated food view
                if ($view == 'asddfbyg') {
                    $id = decrypt_number(16, $_POST['food_id']);
                    // view food details
                    $sql = "SELECT * FROM `donate_food` WHERE food_id ='$id';";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $user_id = $row['user_id'];
                    $sql2 = "SELECT `name` FROM `user_login` WHERE user_id = '$user_id';";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $sql3 = "SELECT `pick_time` FROM `approved_food_req` WHERE food_id = '$id';";
                    $result3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_array($result3);
                    $pickedUp_date = $row3['pick_time'];
                    if ($pickedUp_date == NULL) {
                        $last_donated_date = 'Not donated yet';
                    } else {
                        $date = new DateTime($pickedUp_date);
                        $date->modify('-1 day');
                        $last_donated_date = $date->format('Y-m-d H:i:s');
                    }
                    include("../include/sidebar.php");
                    echo '
                    <head>
                    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
                    <title>Noble Causes - View</title>
                    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
                    <link rel="stylesheet" href="../css/view_details.css" />
                    <link rel="stylesheet" href="../css/manage.css">
                    <link rel="stylesheet" href="../css/sidebar.css">
                    
                    </head>
                    <body>
                    <div class="food_donate_req">

                    <div class="navbar">
                        <?php include("../include/sidebar.php"); ?>
                    </div>
            
                    <div class="food_donate_req_content">
                    <section class="container">
                    <form action="../include/manage_daily_donated_food"><button type="submit"><i class="close bx bx-x-circle"></i></button></form>
                    <header>Food Donation Details</header>
                    <form action="#" method="POST" class="form">
                    <table cellspacing=10%>
                        <div class="input-box">
                            <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>Doner Name</td>
                            <td><i class="a fa fa-envelope" aria-hidden="true"></i>  : ' . $row2['name'] . '</td></tr>
                        </div>
                        <div class="input-box">
                        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>frequency of Donation</td>
                            <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' . $row['freq_of_donation'] . '</td></tr>
                        </div>
                        <div class="input-box">
                        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>Last Donated On</td>
                            <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' .  $last_donated_date . '</td></tr>
                        </div>
                        <div class="input-box">
                        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Food Type</td>
                            <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' . $row['food_type'] . '</td></tr>
                        </div>
                        <div class="input-box">
                        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Donate To</td>
                            <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' . $row['donate_to'] . '</td></tr>
                        </div>
                        <div class="input-box">
                        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Food validity</td>
                            <td><i class="a fa fa-envelope" aria-hidden="true"></i>  : ' . $row['validity'] . '</td><tr>
                        </div>
                        <div class="input-box">
                        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Food Specification</td>
                            <td><i class="a fa fa-envelope" aria-hidden="true"></i>  : ' . $row['specifications'] . '</td><tr>
                        </div>
                        <div class="input-box">
                        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i> Area</td>
                            <td><i class="a fa fa-envelope" aria-hidden="true"></i>  : ' . $row['pickup_street'] . ',' . $row['pickup_city'] . ',' . $row['pickup_zip_code'] . '</td></tr>
                        </div>
                        </table>
                    </form>
                </section>
                </body> ';
                } elseif ($view == 'sddfbyg') {
                    //v_area_
                    $_id = $_POST['v_required_id'];
                    $v_req_area_id = decrypt_number(32, $_id);

                    $sql = "SELECT * FROM `v_required_area` WHERE `v_required_area`.`v_required_id`='$v_req_area_id' ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
                    include("../include/sidebar.php");
                    echo '
                    <head>
                    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
                    <title>Noble Causes - View</title>
                    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
                    <link rel="stylesheet" href="../css/view_details.css" />
                    <link rel="stylesheet" href="../css/manage.css">
                    <link rel="stylesheet" href="../css/sidebar.css">
                    </head>
                    <body>
                    <div class="food_donate_req">

                    <div class="navbar">
                        <?php include("../include/sidebar.php"); ?>
                    </div>
            
                    <div class="food_donate_req_content">
                    <section class="container">
                    <form action="../include/volunteer_required_area"><button type="submit"><i class="close bx bx-x-circle"></i></button></form>
                    <header>Volunteer Required Area Details</header>
                    <form action="#" method="POST" class="form">
                    <table cellspacing=10%>
                        <div class="input-box">
                            <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>Volunteer Required Zip</td>
                            <td><i class="a fa fa-envelope" aria-hidden="true"></i>  : ' . $row['v_required_zip_code'] . ' </td></tr>
                        </div>
                        <div class="input-box">
                        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>Volunteer Required City</td>
                            <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' . $row['v_required_city'] . '</td></tr>
                        </div>
                        <div class="input-box">
                        <tr><td><i class="data fa fa-envelope" aria-hidden="true"></i>Donation request from this area</td>
                            <td><i class="a fa fa-envelope" aria-hidden="true"></i> : ' .  $row['total_user_req'] . '</td></tr>
                        </div>
                        </table>
                    </form>
                </section>
                </body> ';
                }
            }
        }
    }
}
    