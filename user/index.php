<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <!-- CSS Link -->
    <link rel="stylesheet" href="index.css?v=3">
    <link rel="stylesheet" href="nav.css?v=2">


</head>

<body>
    <?php
    session_start();
    ?>
    <!-- link for PHP file -->
    <div class="nav">
        <?php include("navbar2.php");
        ?>
    </div>


    <!-- FIRST SECTION -->
    <?php
    require("../admin/config/db_connection.php");
    $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '1'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) { ?>

        <div class="container-fluid millionClass" style="background-image: url('../Admin/NC_Images/<?php echo $row['hp_image']; ?>');">
                <div class="counter">
                    <div class="content">
                        <span id="count-food">0</span>
                        <p class="hungry">PEOPLE SLEEPS <br><mark data-text="HUNGRY">HUNGRY</mark> IN INDIA</p>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>


        <!-- Front Home -->
        <div class="container-fluid whatWeDo">

            <?php
            require("../admin/config/db_connection.php");
            $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '2'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) { ?>
                <!-- WHAT WE DO? -->
                <div class="container pt-5 pb-3 text-center"><span class="h1 highlight"> <?php echo $row['hp_title']; ?></span> </div>

                <div class="container col-9 lh-base text-center">
                    <span> <?php echo $row['hp_description']; ?></span>
                </div>
            <?php } ?>

            <div class="album pt-4">
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                        <div class="col">
                            <div class="card-body whatWeDoImg mx-auto">

                                <?php
                                require("../admin/config/db_connection.php");
                                $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '3'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <img class="bd-img card-img-top rounded" src="../Admin/NC_Images/<?php echo $row['hp_image']; ?>" role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <p class="card-text"> <?php echo $row['hp_title']; ?></p>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col">
                        <div>
                            <div class="card-body whatWeDoImg mx-auto">
                                <?php
                                require("../admin/config/db_connection.php");
                                $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '4'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <img class="bd-img card-img-top rounded" src="../Admin/NC_Images/<?php echo $row['hp_image']; ?>" role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <p class="card-text"><?php echo $row['hp_title']; ?></p>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            <div class="card-body whatWeDoImg mx-auto">
                                <?php
                                require("../admin/config/db_connection.php");
                                $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '5'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <img class="bd-img card-img-top rounded" src="../Admin/NC_Images/<?php echo $row['hp_image']; ?>" role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <p class="card-text"> <?php echo $row['hp_title']; ?></p>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    </div>
                </div>



                <!-- Second part what we do.. -->
                <?php
                require("../admin/config/db_connection.php");
                $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '6'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) { ?>

                    <!-- HOW YOU CAN HELP? -->
                    <div class="container pt-5 pb-3 text-center mt-5"><span class="h1 highlight2"> <?php echo $row['hp_title']; ?></span> </div>

                    <div class="container col-9 lh-base text-center">
                        <span> <?php echo $row['hp_description']; ?></span>
                    </div>
                <?php } ?>

                <div class="container-fluid whatWeDo">

                    <div class="album pt-4">
                        <div class="container">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                                <div class="col">
                                    <div class="card-body whatWeDoImg mx-auto">
                                        <?php
                                        require("../admin/config/db_connection.php");
                                        $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '7'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) { ?>
                                            <img class="bd-img card-img-top rounded" src="../Admin/NC_Images/<?php echo $row['hp_image']; ?>" role="img" preserveAspectRatio="xMidYMid slice" focusable="false">

                                            <!-- <div style="background-color: #d7edf5;" class="card-body"> -->
                                            <p class="card-text"> <?php echo $row['hp_title']; ?> </p>
                                    </div>
                                <?php } ?>
                                </div>

                                <div class="col">
                                    <div>
                                        <div class="card-body whatWeDoImg mx-auto mb-5">
                                            <?php
                                            require("../admin/config/db_connection.php");
                                            $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '8'";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_array($result)) { ?>
                                                <img class="bd-img card-img-top rounded" src="../Admin/NC_Images/<?php echo $row['hp_image']; ?>" role="img" preserveAspectRatio="xMidYMid slice" focusable="false">

                                                <p class="card-text"> <?php echo $row['hp_title']; ?> </p>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>

                                <div class="col">
                                    <div>
                                        <div class="card-body whatWeDoImg mx-auto">
                                            <?php
                                            require("../admin/config/db_connection.php");
                                            $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '9'";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_array($result)) { ?>
                                                <img class="bd-img card-img-top rounded" src="../Admin/NC_Images/<?php echo $row['hp_image']; ?>" role="img" preserveAspectRatio="xMidYMid slice" focusable="false">

                                                <p class="card-text"> <?php echo $row['hp_title']; ?> </p>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container col-10 rounded mx-auto">
                <p class="text-center fs-2 b pt-3 showSupport">Yes, I Want to Donate Food!</p>

                <!-- Donate Button -->
                <div class="container d-flex justify-content-around knowMoreBottomSpace">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                        <div class="card-body">
                            <a href="foodDonateform">
                                <button class="donateNowBtn mx-3 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#AAAAAA" width="22" height="22" class="bi bi-bag-heart-fill sparkle" viewBox="0 0 16 16">
                                        <path d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                                    </svg>
                                    <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                    </path>

                                    <span class="text">Donate Now</span>
                                </button>
                            </a>
                        </div>
                        <!-- KNOW MORE Button -->
                        <div class="card-body">
                            <a href="food">
                                <button class="knowMoreBtn mx-3 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-info-circle-fill sparkle" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                    </svg>
                                    <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                    </path>
                                    <span class="text2">Know More</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--*******
        Book Donatin Part
    *******  -->


        <div class="container-fluid">
            <div class="row">
                <!-- Left div with image -->
                <div class="col-md-6 p-0">
                    <?php
                    require("../admin/config/db_connection.php");
                    $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '10'";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <img src="../admin/NC_Images/<?php echo $row['hp_image']; ?>" class="img-fluid" alt="Book Donation">
                </div>
                <!-- Right div with text -->
                <div class="col-md-6 bookDonationText">
                    <div class="container p-5 bookDonation2">
                        <div class="container-fluid">
                            <p class="fs-1 bookDonation3"> <?php echo $row['hp_title']; ?></p>
                        </div>

                        <?php
                        require("../admin/config/db_connection.php");
                        $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '15'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <div class="container bookDonation4 mt-4" style="text-align: justify !important;">
                                <p> <?php echo $row['hp_description']; ?> </p>
                            </div>
                        <?php } ?>

                        <?php
                        require("../admin/config/db_connection.php");
                        $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '16'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <div class="container bookDonation4 mt-4" style="text-align: justify !important;">
                                <p> <?php echo $row['hp_description']; ?> </p>
                            </div>
                        <?php } ?>

                        <?php
                        require("../admin/config/db_connection.php");
                        $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '17'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <div class="container bookDonation4 mt-4" style="text-align: justify !important;">
                                <p> <?php echo $row['hp_description']; ?> </p>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid whatWeDo2">
            <?php
            require("../admin/config/db_connection.php");
            $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '11'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) { ?>

                <!-- Importance of Book Donation -->
                <div class="container pt-5 pb-3 text-center"><span class="h1 highlight3"> <?php echo $row['hp_title']; ?></span> </div>

                <!-- Three Book's Box -->
                <div class="album pt-4">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                            <div class="col">
                                <?php
                                require("../admin/config/db_connection.php");
                                $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '12'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <div class="card-body whatWeDoImg mx-auto">
                                        <img class="bd-img card-img-top rounded" src="../Admin/NC_Images/<?php echo $row['hp_image']; ?>" role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    </div>
                                    <!-- <div style="background-color: #d7edf5;" class="card-body"> -->
                                    <div class="container">
                                        <p class="pt-3 fw-bold text-center my-1"> <?php echo $row['hp_title']; ?> </p>
                                        <p class="text-center"> <?php echo $row['hp_description']; ?> </p>
                                    </div>
                            </div>
                        <?php } ?>

                        <div class="col">
                            <div>
                                <?php
                                require("../admin/config/db_connection.php");
                                $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '13'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <div class="card-body whatWeDoImg mx-auto">
                                        <img class="bd-img card-img-top rounded" src="../Admin/NC_Images/<?php echo $row['hp_image']; ?>" role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    </div>
                                    <!-- <div style="background-color: #d7edf5;" class="card-body"> -->
                                    <div class="container">
                                        <p class="pt-3 fw-bold text-center my-1"> <?php echo $row['hp_title']; ?> </p>
                                        <p class="text-center"> <?php echo $row['hp_description']; ?> </p>
                                    </div>
                            </div>
                        <?php } ?>
                        </div>

                        <div class="col">
                            <div>
                                <?php
                                require("../admin/config/db_connection.php");
                                $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '14'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <div class="card-body whatWeDoImg mx-auto">
                                        <img class="bd-img card-img-top rounded" src="../Admin/NC_Images/<?php echo $row['hp_image']; ?>" role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    </div>
                                    <!-- <div style="background-color: #d7edf5;" class="card-body"> -->
                                    <div class="container">
                                        <p class="pt-3 fw-bold text-center my-1"> <?php echo $row['hp_title']; ?> </p>
                                        <p class="text-center"> <?php echo $row['hp_description']; ?> </p>
                                    </div>
                            </div>
                        <?php } ?>
                        </div>

                    <?php } ?>
                        </div>
                    </div>

                    <div class="container col-10 rounded donateContainer mx-auto">
                        <p class="text-center fs-2 pt-3 showSupport">Want To Donate Book?</p>

                        <!-- Donate Button -->
                        <div class="container pb-3 d-flex justify-content-around">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                                <div class="card-body">
                                    <a href="bookDonateform">
                                        <button class="donateNowBtn2 mx-3 mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#AAAAAA" width="22" height="22" class="bi bi-bag-heart-fill sparkle" viewBox="0 0 16 16">
                                                <path d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                                            </svg>
                                            <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                            </path>

                                            <span class="text">Donate Now</span>
                                        </button>
                                    </a>
                                </div>
                                <!-- KNOW MORE Button -->
                                <div class="card-body">
                                    <a href="education">
                                        <button class="knowMoreBtn mx-3 mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-info-circle-fill sparkle" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                            </svg>
                                            <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                            </path>
                                            <span class="text2">Know More</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="footer">
            <?php include "footer.php"; ?>
        </div>

        <!-- Show the toast when the document is ready -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var loginSuccessToast = new bootstrap.Toast(document.getElementById('loginSuccessToast'));
                loginSuccessToast.show();

                // Close the toast after 3 seconds
                setTimeout(function() {
                    loginSuccessToast.hide();
                }, 3000);
            });
        </script>
        <script type="text/javascript">
            document.getElementById("myButton").onclick = function() {
                location.href = "food";
            };
        </script>
        <script type="text/javascript">
            document.getElementById("myButton2").onclick = function() {
                location.href = "education";
            };
        </script>

        <script src="navbar.js"></script>
        <script src="index.js"></script>

</body>

</html>