<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes-Needy Place</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="needy_place.css">

</head>


<body>
    <?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    } else {
        header("Location: login");
    } ?>
    <?php include("navbar2.php"); ?>
    <?php

    require("connection.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Retrieve form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $street = $_POST["street"];
        $city = $_POST["city"];
        $zip_code = $_POST["zip_code"];

        $sql = "SELECT * FROM sug_needy_place WHERE needy_city = '$city' AND needy_street = '$street' AND needy_zip = '$zip_code' ";
        $result = mysqli_query($conn, $sql);

        $sql2 = "SELECT * FROM needy_place WHERE city = '$city' AND street = '$street' AND zip_code = '$zip_code' ";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2->num_rows > 0) {

            echo "<script>window.location.href='needy_place?source=needyplaceexist'</script>";
        } else if ($result->num_rows > 0) {

            echo "<script>window.location.href='needy_place?source=needyplaceexist'</script>";
        } else {

            $sql = "INSERT INTO `sug_needy_place`(`user_name`, `user_mail`, `user_phone`, `needy_street`, `needy_city`, `needy_zip`) VALUES ('$name','$email','$phone','$street','$city','$zip_code')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // User successfully registered, show toaster message and redirect
                echo '<script>window.location.href = "needy_place?source=needyplace";</script>';
            }
        }
    }


    ?>

    <!-- ******
        HTML 
    *******  -->

    <?php

    if (isset($_GET['source'])) {
        $source = $_GET['source'];
        if ($source == 'needyplace') {
            echo '<div id="needyplace" class="toast d-flex align-items-center justify-content-center text-light border-0 position-fixed top-50 start-50 translate-middle" role="alert" aria-live="assertive" aria-atomic="true" style="width: auto; height: auto; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 1; z-index: 100; border-radius: 10px; background: linear-gradient(135deg, #4CAF50, #FFC107);">
            <a href="needy_place" style="text-decoration: none; color: inherit; text-align: center; display: block;">
                        <div class="toast-body" style="padding: 15px;">
                           <i class="fas fa-check-circle me-2"></i>
                           Thank You For Suggest needy place.
                        </div>
                    </div>
                   ';
            echo "<div class='alert alert-danger' role='alert'></div>";
        } else if ($source == 'needyplaceexist') {
            echo '<div id="needyplaceexist" class="toast d-flex align-items-center justify-content-center text-light border-0 position-fixed top-50 start-50 translate-middle" role="alert" aria-live="assertive" aria-atomic="true" style="width: auto; height: auto; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 1; z-index: 100; border-radius: 10px; background: linear-gradient(135deg, #4CAF50, #FFC107);">
            <a href="needy_place" style="text-decoration: none; color: inherit; text-align: center; display: block;">
                <div class="toast-body" style="padding: 15px;">
                   <i class="fas fa-check-circle me-2"></i>
                   This location is already taken, Thank You for your suggestion.
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

    <div class="container">
        <div class="row featurette mt-5">
            <div class="col-md-5 order-md-1 order-sm-1 d-flex justify-content-center">
                <img src="needy_place.jpg" class="img-fluid rounded volimg mb-5" style="margin-top:90px;" alt="Centered Image">
            </div>
            <div class="col-md-7 order-md-2 order-sm-2 mt-4 part1" style="text-align: justify !important;">
                <h2 class="featurette-heading fw-normal lh-1 howhelp" style="margin-top:50px;">Needy Places To Donate </h2>
                <p class="part1p">At Noble Causes, we believe in the power of giving back to communities in need. With
                    your generous support, we strive to make a meaningful difference in the lives of those facing
                    hardship. Our mission extends beyond borders, reaching out to needy places where basic necessities
                    like food are scarce.</p>
                <h4 style="color: darkslateblue; font-weight: 470;">Why Donate to Needy Places?</h4>

                <p class="part1p">In many parts of the world, poverty and hunger are stark realities. Families struggle
                    to put food on the table, and children go to bed hungry each night. By donating to needy places, you
                    can help alleviate suffering and provide hope for a brighter future.</p>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="row form-container pb-4">
            <!-- <div class="col-md-6 image-container">
                <img src="vol1.jpg" alt="Image" class="img-fluid" />
            </div> -->
            <div class="col-md-6 form-content">
                <h4 class="text-center"><b>Suggest Us Where Should We Donate?</b></h4>
                <form method="POST">
                    <div class="form-group m-0">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your Name" required />
                    </div>

                    <div class="form-group m-0">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your Email" required />
                    </div>

                    <div class="form-group m-0">
                        <label for="phone">Phone:</label>
                        <input type="phone" id="phone" maxlength="10" name="phone" class="form-control" placeholder="Enter your Phone number" required />
                    </div>

                    <div class="gender-box m-2">
                        <div class="gender-option" style="display: flex; gap: 20px">
                        </div>
                    </div>

                    <div class="form-group m-0">
                        <label for="address">Needy Place Address:</label>
                        <input type="text" id="street" name="street" class="form-control" placeholder="Enter Needy Place Street" required />
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="city" class="form-control" placeholder="Enter Needy Place city" required />
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="zip_code" maxlength="6" class="form-control" placeholder="Enter Needy Place Zip code" required />
                        </div>
                    </div>

                    <button type="submit" class="m-0">Submit</button>
                </form>
            </div>
        </div>
    </div>


    <?php include("footer.php"); ?>

    <!-- Bootstrap JS and Popper.js (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>