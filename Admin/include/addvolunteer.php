<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Add Volunteer</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!---Custom CSS File--->
    <link rel="stylesheet" href="../css/addvolunteer.css" />
    <link rel="stylesheet" href="../css/view_details.css" />
    <link rel="stylesheet" href="../css/addvolunteerform.css">


</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require("../config/db_connection.php");
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
            $sql = "INSERT INTO `volunteers`(`v_name`, `v_email`, `v_phone`, `v_gender`, `assigned_area`,`assigned_street`, `assigned_zip_code`, `v_password`,`v_street`, `v_city`, `v_zip`) VALUES ('$name', '$email','$phone', '$gender','$v_city','$v_street','$v_zip_code', '$hash_pswd', '$street', '$city', '$zip_code')";
            $result = mysqli_query($conn, $sql);

            header('location:manage_Volunteer');
        }
    }

    ?>
    <div class="food_donate_req">

        <div class="navbar">
            <?php include("../include/sidebar.php"); ?>
        </div>
        <div class="food_donate_req_content">
            <section class="container">
                <header>Registration Form</header>
                <form action="#" method="POST" class="form">
                    <div class="form_content">
                        <div class="input-box">
                            <label><i class="fa fa-user" aria-hidden="true"></i>Volunteer Name</label>
                            <input type="text" name="name" placeholder="Enter full name" required />
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label><i class="fa fa-phone-square" aria-hidden="true"></i> Phone Number</label>
                                <input type="phone" name="phone" maxlength="10" placeholder="Enter phone number" required />
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
                                <input type="text" name="zip_code" maxlength="6" placeholder="Enter your Zip code" required />
                            </div>

                        </div>
                        <div class="input-box address">
                            <label><i class="fa fa-address-card" aria-hidden="true"></i> Assigned Area</label>

                            <div class="column">
                                <input type="text" name="v_street" placeholder="Enter assigned street" required />
                                <input type="text" name="v_city" placeholder="Enter assigned city" required />
                                <input type="text" name="v_zip_code" maxlength="6" placeholder="Enter assigned Zip code" required />
                            </div>

                        </div>
                        <button type="submit" name="submit">Add Volunteer</button>
                    </div>
                </form>
            </section>

</body>

</html>