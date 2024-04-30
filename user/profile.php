<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap link -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- CSS Link -->
    <link rel="stylesheet" href="profile.css?v=7">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes-Profile</title>
</head>

<body>

<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
    header("Location:login");
}
?>
    <div class="backtohome mt-4 ml-5">
        <li class="col-md-12"><a href="index"> <i class='fas fa-angle-left' style='font-size:15px'></i>
                <b> Back To Home </b>
            </a></li>
    </div>
    <?php
    require '../Admin/config/db_connection.php';
    include "profile_navbar.php";

    $user_id = $_SESSION['user_id'];
    // $sql = "SELECT * FROM user_login WHERE user_id='$user_id'";
    $sql = "SELECT * FROM user_login WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="profile-info col-md-9">
                    <div class="panel">
                        <div class="bio-graph-heading">
                            <h5>“Help others without any reason and give without the expectation of receiving anything in
                                return.”</h5>
                        </div>
                        <div class="panel-body bio-graph-info my-4">
                            <h1 class="ml-4"><b>Your Profile</b></h1>
                            <div class="row mx-4">

                                <div class="bio-row">
                                    <p><span>Full Name </span>: <?php echo '' . $row['name'] . '' ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Email </span>: <?php echo '' . $row['email'] . '' ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Mobile </span>: <?php echo '' . $row['phone'] . '' ?></p>
                                </div>

                                <div class="bio-row">
                                    <p><span>Address </span>:
                                        <?php echo '' . $row['street'] . ', ' . $row['city'] . ', ' . $row['zip_code'] . '' ?></p>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>
                    <div class="panel-body bio-graph-info my-4">
                        <h1 class="ml-4"><b>Your Total Donation:</b></h1>
                        <div class="row mx-4">

                            <div class="bio-row">
                                <?php
                                include("../Admin/config/db_connection.php");
                                $query1 = "SELECT * FROM `user_donation_quantity_record` WHERE `user_id`='$user_id'";
                                $result1 = mysqli_query($conn, $query1);
                                $row1 = mysqli_fetch_assoc($result1);
                                if ($row1 > 0) {
                                    echo '<h3>' . $row1['donation_quantity'] . '</h3>';
                                } else {
                                    echo '<h3>0</h3>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <?php
            include("footer.php");
            ?>

</body>

</html>