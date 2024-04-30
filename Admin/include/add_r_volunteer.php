<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Add Volunteer</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <!---Custom CSS File--->
    <link rel="stylesheet" href="../css/addvolunteer.css" />

</head>

<body>
    <?php
    require("../config/db_connection.php");

    if (isset($_POST['add_r_v'])) {
        $food_id = $_POST['food_id'];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_pass = $_POST["confirm_pass"];
        $hash_pswd = password_hash($password, PASSWORD_DEFAULT);
        $gender = $_POST['gender'];
        $street = $_POST['street'];
        $v_street = $_POST['v_street'];
        $v_city = $_POST['v_city'];
        $city = $_POST['city'];
        $v_zip_code = $_POST['v_zip_code'];
        $zip_code = $_POST['zip_code'];
        if ($password == $confirm_pass) {
            // inserting volunteer
            $sql = "INSERT INTO `volunteers`(`v_name`, `v_email`, `v_phone`, `v_gender`, `assigned_area`,`assigned_street`, `assigned_zip_code`, `v_password`,`v_street`, `v_city`, `v_zip`) VALUES ('$name', '$email','$phone', '$gender','$v_city','$v_street','$v_zip_code', '$hash_pswd', '$street', '$city', '$zip_code')";
            $result = mysqli_query($conn, $sql);
        
            // updating status at donat_food
            $sql1 = "UPDATE `donate_food` SET `status`='approved' WHERE `donate_food`.`food_id`='$food_id'";
            $result1 = mysqli_query($conn, $sql1);

            // deleting data from v_required_area 
            $sql3 = "DELETE FROM `v_required_area` WHERE `v_required_area`.`food_id`='$food_id'";
            $result3 = mysqli_query($conn, $sql3);

            header("location:../controller/assigning_v_into_approved_f_req?fid=$food_id");
        }
    }

    ?>
    <section class="container">
        <header>Add Volunteer</header>
        <form action="#" method="POST" class="form">

            <div class="input-box">
                <label><i class="fa fa-user" aria-hidden="true"></i>Volunteer Name</label>
                <input type="text" name="name" placeholder="Enter full name" required />
            </div>



            <div class="column">
                <div class="input-box">
                    <label><i class="fa fa-phone-square" aria-hidden="true"></i> Phone Number</label>
                    <input type="phone" name="phone" placeholder="Enter phone number" required />
                </div>
                <div class="input-box">
                    <label><i class="fa fa-envelope" aria-hidden="true"></i> Email Address</label>
                    <input type="mail" name="email" placeholder="Enter email address" required />
                </div>
            </div>
            <div class="column">
                <div class="input-box">
                    <label><i class="fa fa-lock" aria-hidden="true"></i> Password</label>
                    <input type="Password" name="password" placeholder="Enter Password" required />
                </div>
                <div class="input-box">
                    <label><i class="fa fa-lock" aria-hidden="true"></i> Confirm Password</label>
                    <input type="password" name="confirm_pass" placeholder="Confirm Password" required />
                </div>
            </div>

            </div>
            <div class="gender-box">
                <i class="fa fa-mars" aria-hidden="true">Gender</i>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="check-male" name="gender" value="male" />
                        <label for="check-male">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-female" name="gender" value="female" />
                        <label for="check-female">Female</label>
                    </div>
                </div>
            </div>
            <div class="input-box address">
                <label><i class="fa fa-address-card" aria-hidden="true"></i> Volunteer Address</label>
                <input type="text" name="street" placeholder="Enter street address" required />

                <div class="column">
                    <input type="text" name="city" placeholder="Enter your city" required />
                    <input type="text" name="zip_code" placeholder="Enter your Zip code" required />
                </div>

            </div>
            <?php require_once('../config/db_connection.php');
            $v_required_id = $_POST['v_required_id'];
            $sql2 = "SELECT * FROM `v_required_area` WHERE `v_required_area`.`v_required_id`=$v_required_id ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($result2); {
            ?>
                <div class="input-box address">
                    <label><i class="fa fa-address-card" aria-hidden="true"></i> Assigned Area</label>

                    <div class="column">
                        <input type="text" name="v_street" value="<?php echo $row2['v_required_street'] ?>" required />
                        <input type="text" name="v_city" value="<?php echo $row2['v_required_city'] ?>" required />
                        <input type="text" name="v_zip_code" value="<?php echo $row2['v_required_zip_code'] ?>" required />
                        <input type="text" style="display: none" name="food_id" value="<?php echo $row2['food_id'] ?>" required />
                    </div>
                <?php } ?>

                </div>
                <button type="submit" name="add_r_v">Add Volunteer</button>
        </form>
    </section>

</body>

</html>