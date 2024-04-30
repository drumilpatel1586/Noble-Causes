<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes - SignUp</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!---Custom CSS File--->
    <link rel="stylesheet" href="signUp.css" />

</head>

<body>
    <?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require ("connection.php");
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_pass = $_POST["confirm_pass"];
        $hash_pswd= password_hash($password , PASSWORD_DEFAULT);
        $gender = $_POST['gender'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $zip_code = $_POST['zip_code'];
        $check_email_sql = "SELECT * FROM user_login WHERE email = '$email'";
        $check_email_result = mysqli_query($conn, $check_email_sql);
        
        if(mysqli_num_rows($check_email_result) > 0) {
            echo "<script>alert('Email already exists. Please use a different email.');</script>";
        } else {
            if($password == $confirm_pass){
                $sql="INSERT INTO `user_login` (`name`, `phone`, `email`, `password`, `gender`, `street`, `city`, `zip_code`, `time`) VALUES ('$name', '$phone', '$email', '$hash_pswd','$gender', '$street', '$city', '$zip_code', current_timestamp())";
                $result = mysqli_query($conn,$sql);
                header('location:index');
            } else {
                echo "<script>alert('Passwords do not match.');</script>";
            }
        }

        // header('location:index');
    }
    

    ?>
    <div> <?php include ("navbar2.php");?></div>
    <section class="container">
        <header>Registration Form</header>
        <form action="#" method="POST" class="form">
        <?php
if (isset($_GET['source'])) {
    $source = $_GET['source'];

    if ($source == 'navbar') {?>
        <!-- <div class="select-box">
            <select name="role">
                <option hidden>Your Role</option>
                <option value="Volunteer" selected>Volunteer</option>
            </select>
        </div> -->
    <?php } elseif ($source == 'loginpage') { ?>
        <!-- <div class="select-box">
            <select name="role">
                <option hidden>Your Role</option>
                <option value="Donor">Donor</option>
                <option value="Receiver">Receiver</option>
            </select>
        </div> -->
    <?php } 
}
?>
            <div class="input-box">
                <label><i class="fa fa-user" aria-hidden="true"></i> Full Name</label>
                <input type="text" name="name" placeholder="Enter full name" required />
            </div>



            <div class="column">
                <div class="input-box">
                    <label><i class="fa fa-phone-square" aria-hidden="true"></i> Phone Number</label>
                    <input type="tel" maxlength="10" name="phone" placeholder="Enter phone number" required />
                </div>
                <div class="input-box">
                    <label><i class="fa fa-envelope" aria-hidden="true"></i> Email Address</label>
                    <input type="text" name="email" placeholder="Enter email address" required />
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
                <h3><i class="fa fa-mars" aria-hidden="true"></i> Gender</h3>
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
                <label><i class="fa fa-address-card" aria-hidden="true"></i> Address</label>
                <input type="text" name="street" placeholder="Enter street address" required />

                <div class="column">
                    <input type="text" name="city" placeholder="Enter your city" required />
                    <input type="text" maxlength="6" name="zip_code" placeholder="Enter your Zip code" required />
                </div>

            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>

    <div class="sfooter">
        <?php include("footer.php") ?>
    </div>
</body>

</html>