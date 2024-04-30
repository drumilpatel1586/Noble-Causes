<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes-Become Volunteer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="volunteer.css?v=2">
</head>
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
    header("Location: login");
} ?>

<body>

    <?php include("navbar2.php"); ?>

    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';
    require("connection.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // try {
        //     $mail = new PHPMailer(true);
        //     $mail->isSMTP();
        //     $mail->Host       = 'smtp.gmail.com';
        //     $mail->SMTPAuth   = true;
        //     $mail->Username   = 'noblecausesamd@gmail.com';
        //     $mail->Password   = 'nuou iaom zqyo svzp';
        //     $mail->SMTPSecure = 'tsl';
        //     $mail->Port       = 587;
        //     $mail->setFrom('noblecausesamd@gmail.com');
        //     $mail->addAddress($_POST['email']);

        //     $mail->isHTML(true);
        //     $mail->Subject = 'Thank You for become volunteer';
        //     $mail->Body    = 'Dear  user,
        //     <br>
        //     <p>I hope this email finds you well. I wanted to take a moment to express our heartfelt gratitude for your decision to volunteer with us.</p>
        //     <p> Your willingness to dedicate your time and energy to our cause is truly appreciated and valued,Volunteers like you play a crucial role in helping us achieve our mission and make a positive impact in our community. Your commitment to serving others is inspiring, and we are incredibly grateful to have you as part of our team.</p>';
        //     $mail->send();
        // } catch (Exception $e) {
        //     echo 'Email sending failed. Error: ', $mail->ErrorInfo;
        // }
    }
    ?>

    <?php
    require("connection.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $v_name = $_POST["name"];
        $v_phone = $_POST["phone"];
        $v_email = $_POST["email"];
        $v_gender = $_POST['gender'];
        $v_street = $_POST['street'];
        $v_city = $_POST['city'];
        $v_zip = $_POST['zip_code'];

        $sql = "SELECT * FROM `req_volunteers` WHERE `v_email` = '$v_email'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {

            echo '<div id="volunteer" class="toast d-flex align-items-center justify-content-center text-light border-0 position-fixed top-50 start-50 translate-middle" role="alert" aria-live="assertive" aria-atomic="true" style="width: 300px; height: 150px; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 1; z-index: 100; border-radius: 10px; background: linear-gradient(135deg, #4CAF50, #FFC107);">
            <a href="volunteer" style="text-decoration: none; color: inherit; text-align: center; display: block;">
                <div class="toast-body" style="padding: 15px;">
                    <i class="fas fa-check-circle me-2"></i>
                    You have already registered to become a volunteer. Click here to view details.
                </div>
            </a>
          </div>';
    
    
        } else {

            $sql = "INSERT INTO `req_volunteers` (`v_name`, `v_phone`, `v_email`,`v_gender`, `v_street`, `v_city`, `v_zip`, `v_time`) VALUES ('$v_name', '$v_phone', '$v_email', '$v_gender', '$v_street', '$v_city', '$v_zip', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            echo '<div id="volunteer2" class="toast d-flex align-items-center justify-content-center text-light border-0 position-fixed top-50 start-50 translate-middle" role="alert" aria-live="assertive" aria-atomic="true" style="width: 300px; height: 150px; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 1; z-index: 100; border-radius: 10px; background: linear-gradient(135deg, #4CAF50, #FFC107);">
            <a href="volunteer" style="text-decoration: none; color: inherit; text-align: center; display: block;">
                    <div class="toast-body" style="padding: 15px;">
                       <i class="fas fa-check-circle me-2"></i>
                        Thank You For Joining Us...please check your mail.
                    </div>
                </div>
               ';
        }
    }


    ?>
    <div class="container-fluid p-0">
        <div class="volfirst col-12 mt-4">

        </div>
    </div>

    <div class="container ">
        <div class="row">
            <div class="col-md-7 order-md-1 order-sm-2 mt-5 part1" style="text-align: justify !important;">
                <h2 class="featurette-heading fw-normal lh-1 howhelp headtext">How You Can Help? </h2>
                <p class="part1p">Become a vital part of our mission by volunteering your time and skills. Whether
                    you're passionate
                    about ensuring everyone has access to nutritious food or you believe in the power of literature to
                    transform lives, your contribution matters.</p>
                <h4 style="color: darkslateblue; font-weight: 470;">Volunteer Opportunities:</h4>

                <p class="part1p"><b>Food Distribution Team:</b> Assist in sorting, packing, and distributing food to
                    support individuals and families facing food insecurity in our community. Make a significant impact
                    on combating hunger.</p>

                <p class="part1p"><b>Book Drive Team:</b> Join efforts to collect, organize, and distribute books to
                    underserved communities, promoting literacy and a passion for learning.</p>
            </div>
            <div class="col-md-5 order-md-2 order-sm-1 mt-5 part1img">
                <img src="v1.jpg" class="img-fluid rounded volimg mb-5" alt="Volunteer Image">
            </div>
        </div>
    </div>


    <div class="row form-container">
        <div class="col-md-6 image-container">
            <img src="volunteer.jpg" alt="Image" class="img-fluid" />
        </div>
        <div class="col-md-6 form-content">
            <h3 class="text-center"><b>Join Our Team</b></h3>
            <form method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your Name" required />
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your Email" required />
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="phone" id="phone" maxlength="10" name="phone" class="form-control" placeholder="Enter your Phone number" required />
                </div>
                <div class="gender-box">
                    <h6><i class="fa fa-mars" aria-hidden="true"></i> Gender:</h6>
                    <div class="gender-option" style="display: flex; gap: 20px">
                        <div class="gender">
                            <input type="radio" id="check-male" name="gender" value="male"  required/>
                            <label for="check-male">Male</label>
                        </div>
                        <div class="gender">
                            <input type="radio" id="check-female" name="gender" value="female" required/>
                            <label for="check-female">Female</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="street" name="street" class="form-control" placeholder="Enter your Street" required />
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="city" class="form-control" placeholder="Enter your city" required />
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="zip_code" class="form-control" maxlength="6" placeholder="Enter your Zip code" required />
                    </div>
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    </div>


    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var volunteerJs = new bootstrap.Toast(document.getElementById("volunteer"));
            volunteerJs.show();

            // Close the toast after 2 seconds
            setTimeout(function() {
                volunteerJs.hide();
            }, 1000);
        });
    </script> -->

    <?php include("footer.php"); ?>
    <!-- Bootstrap JS and Popper.js (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>