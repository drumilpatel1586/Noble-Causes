<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes - Add Needy Place</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!---Custom CSS File--->
    <link rel="stylesheet" href="../css/addvolunteer.css" />
    <link rel="stylesheet" href="../css/view_details.css" />
    <link rel="stylesheet" href="../css/addvolunteerform.css">
    <style>
        .food_donate_req_content {
            margin-top: 0;
        }
    </style>

</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require("../config/db_connection.php");

        $n_street = $_POST['n_street'];
        $n_city = $_POST['n_city'];
        $n_zip_code = $_POST['n_zip_code'];
        $day = $_POST['day'];

        $sql = "SELECT * FROM `sug_needy_place` WHERE  `needy_street`='$n_street' AND `needy_city`='$n_city' AND `needy_zip`='$n_zip_code'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            echo "<script>alert('This needy place already exists');</script>";
            echo "<script>window.location.href='needy_place';</script>";
        } else {

            $sql = "INSERT INTO `needy_place`(`street`, `city`, `zip_code`,`days_to_reach`) VALUES ('$n_street','$n_city','$n_zip_code','$day')";
            $result = mysqli_query($conn, $sql);

            $sql = "SELECT `needy_place_id`,`zip_code` FROM `needy_place` WHERE `street`='$n_street' AND `city`='$n_city' AND `zip_code`='$n_zip_code' ";
            $result4 = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result4);
            $package_id = $row['needy_place_id'];
            $zip_code = $row['zip_code'];

            $sql = "UPDATE `needy_place` SET `package_id` = $package_id WHERE `needy_place_id` =  $package_id";
            $result5 = mysqli_query($conn, $sql);
            echo "package id update from `needy_place`=>";

            $sql = "SELECT assigned_zip_code FROM `volunteers` WHERE assigned_zip_code = '$zip_code'";
            $result6 = mysqli_query($conn, $sql);
            if ($result6->num_rows > 0) {

                if ($result) {

                    echo "<script>alert('Place Added Successfully');</script>";
                    echo "<script>window.location.href='needy_place';</script>";
                } else {

                    echo "<script>alert('Something went wrong');</script>";
                    echo "<script>window.location.href='needy_place';</script>";
                }
            }else {
                
                echo "<script>alert('Place Added Successfully');</script>";
                
                echo "<script>alert('Volunteer Required in this area');</script>";
                echo "<script>window.location.href='needy_place';</script>";
            }
        }
    }


    ?>
    <div class="food_donate_req">

        <div class="navbar">
            <?php include("../include/sidebar.php"); ?>
        </div>
        <div class="food_donate_req_content">
            <header>
                <div class="food_donate_req_content_title">
                    <h1>Needy Places</h1>
                    <ul class="navigation">
                        <li class="navigation-item">
                            <a href="../include/dashboard">Dashboard</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                        <li class="navigation-item">
                            <a href="../include/needy_place">Needy Places</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                    </ul>
                </div>
            </header>

            <section class="container">
                <header>Add Needy Place</header>
                <form action="add_needy_place" method="POST" class="form">
                    <div class="form_content">

                        <div class="input-box address">
                            <label><i class="fa fa-address-card" aria-hidden="true"></i> Needy Place</label>

                            <div class="column">
                                <input type="text" name="n_street" placeholder="Enter needy street" required />
                                <input type="text" name="n_city" placeholder="Enter needy city" required />
                            </div>
                            <div class="column">
                                <input type="int" name="n_zip_code" maxlength="6" placeholder="Enter needy Zip code" required />
                                <input type="int" name="day" maxlength="1" placeholder="Enter days to reach place from warehouse" required />
                            </div>

                        </div>

                        <button type="submit" name="submit">Submit</button>

                    </div>
                </form>
            </section>
        </div>
    </div>

</body>

</html>