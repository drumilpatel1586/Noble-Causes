<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes- Contact Us </title>
    <link rel="stylesheet" href="contactUs.css?v=2">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $id = $_SESSION['user_id'];
    } else {
        header("Location:login?source=contact_us");
    } ?>



    <div> <?php include("navbar2.php") ?></div>


    <div class="b">
        <?php
        require_once 'connection.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // echo "if pass =>";

            $u_name = $_POST['name'];
            // echo " $u_name.'=>'";
            $u_email = $_POST['email'];
            // echo " $u_email.'=>'";
            $u_message = $_POST['message'];
            echo " $u_message.'=>'";

            $sql = "INSERT INTO `contact_us`(`u_id`, `u_name`, `u_email`, `u_message`) VALUES ('$id','$u_name','$u_email','$u_message')";
            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) {

                // User successfully registered, show toaster message and redirect
                echo "<script>window.location.href='contactUs?source=message'</script>";
            }
        }
        ?>

        <?php

        if (isset($_GET['source'])) {
            $source = $_GET['source'];
            if ($source == 'message') {
                echo '<div id="contactus" class="toast d-flex align-items-center justify-content-center text-light border-0 position-fixed translate-middle" role="alert" aria-live="assertive" aria-atomic="true" style="width: 300px; height: auto; opacity: 1; top: 50vh; z-index: 1; border-radius: 10px; background: linear-gradient(135deg, #4CAF50, #FFC107);">
        <a href="contactUs" style="text-decoration: none; color: inherit; text-align: center; display: block;">
            <div class="toast-body" style="padding: 15px;">
                <i class="fas fa-check-circle me-2"></i>
                Message Sent Successfully...We will reply to your message via email.
            </div>
        </a>
    </div>';
                echo "<div class='alert alert-danger' role='alert'></div>";
            }
        }; ?>

        <div class="container">
            <div class="content">
                <div class="left-side">
                    <div class="address details">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="topic">Address</div>
                        <div class="text-one"><iframe style="width:200px" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAfqJHFi3ghTFSuuW5pIudu9Fq2pvoJzwc&maptype=satellite&zoom=15&q='.strtolower(Shakti 404 Shakti Complex, Shakti 404, 2nd Floor, Shakti 404, Sarkhej - Gandhinagar Hwy, opp. New Gurudwara, Thaltej).','.Ahmedabad, Gujarat 380054.'" class="map" allowfullscreen></iframe></div>

                    </div>
                    <div class="phone details">
                        <i class="fa-solid fa-phone"></i>
                        <div class="topic">Phone</div>
                        <div class="text-one">+91 9106091255</div>

                    </div>
                    <div class="email details">
                        <i class="fas fa-envelope"></i>
                        <div class="topic">Email</div>
                        <div class="text-one">naublecausesamd@gmail.com</div>

                    </div>
                </div>
                <div class="right-side">
                    <div class="topic-text">Send us a message</div>
                    <form action="#" method="POST">
                        <div class="input-box">
                            <input type="text" name="name" placeholder="Enter your name">
                        </div>
                        <div class="input-box">
                            <input type="text" name="email" placeholder="Enter your email">
                        </div>
                        <div class="input-box message-box">
                            <input type="textarea" name="message" placeholder="Enter your message">
                        </div>
                        <div class="button">
                            <input class="button" type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="sfooter">
            <?php include("footer.php") ?>
        </div>
    </div>
</body>

</html>