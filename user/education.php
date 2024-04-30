<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="education.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes-Education</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['bookdonationMessage'])) {
        // Output the toast message and script
        echo '<div id="bookdonationMessage" class="toast align-items-center justify-content-center text-light border-0 position-fixed top-30 start-50 translate-middle" role="alert" aria-live="assertive" aria-atomic="true" style="width: 300px; z-index: 1; border-radius: 10px; background: linear-gradient(135deg, #4CAF50, #FFC107);">
            <div class="toast-body" style="padding: 15px;">
                ' . $_SESSION['bookdonationMessage'] . '
            </div>
        </div>';

        // Unset the session variable after displaying the toast
        unset($_SESSION['bookdonationMessage']);
    }
    ?>
    <div class="navb">
        <?php include("navbar2.php"); ?>
    </div>

    <!-- New IMAGE -->
    <?php
    require("../admin/config/db_connection.php");
    $query = "SELECT * FROM cms_bd WHERE `cms_bd`.`cms_bd_id` = '1'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) { ?>
        <div class="container-fluid millionClass" style="background-image: url('../Admin/NC_Images/<?php echo $row['bd_image']; ?>')">
        <?php } ?>
        <div class="content">
            <p class="mainImageText">Book Donation</p>
            <p class="mainImageText2">We work to give your items a second life</p>
        </div>
        </div>

        <!-- button -->

        <div class="container-fluid bookdonate m-0 px-5">
            <div class="button-container col-12">

                <!-- Donate Button -->
                <div class="container d-flex justify-content-around knowMoreBottomSpace">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                        <div class="card-body">
                            <a href="bookDonateform" id="blueLink">
                                <button class="donateNowBtn mx-3 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#AAAAAA" width="22" height="22" class="bi bi-bag-heart-fill sparkle" viewBox="0 0 16 16">
                                        <path d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                                    </svg>
                                    <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                    </path>

                                    <span class="text" style="text-decoration: none; !important">Donate Now</span>
                                </button>
                            </a>
                        </div>
                        <!-- Available Books Button -->
                        <div class="card-body">
                            <a href="availableBooks" id="blueLink2">
                                <button class="knowMoreBtn mx-3 mb-3">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22" height="22" fill="#ffffff"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                                    </svg>

                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                                    class="bi bi-info-circle-fill sparkle" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                </svg>
                                <path
                                    d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                </path> -->
                                    <span class="text2 px-2">Available Books</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require("../Admin/config/db_connection.php");
        $query = "SELECT * FROM cms_bd ";
        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $align = $row['bd_align'];
                if ($align == 'CI') { ?>
                    <div class="box-container">

                        <div class="box-description">
                            <h2> <?php echo $row['bd_title']; ?> </h2>
                            <p><?php echo $row['bd_description']; ?></p>
                        </div>
                        
                        <img class="box-image" src="../Admin/NC_Images/<?php echo $row['bd_image']; ?>" alt="<?php echo $row['bd_image']; ?>">
                        
                    </div>
                    <?php } else {
                    if ($align == 'IC') { ?>
                        <div class="box-container">
                            <img class="box-image" src="../Admin/NC_Images/<?php echo $row['bd_image']; ?>" alt="<?php echo $row['bd_image']; ?>">
                            <div class="box-description">
                                <h2> <?php echo $row['bd_title']; ?> </h2>
                                <p><?php echo $row['bd_description']; ?></p>
                            </div>
                        </div>
        <?php }
                }
            }
        } ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var bookdonationMessage = new bootstrap.Toast(document.getElementById('bookdonationMessage'));
                bookdonationMessage.show();

                // Close the toast after 2 seconds
                setTimeout(function() {
                    bookdonationMessage.hide();
                }, 2000);
            });
        </script>

        <script type="text/javascript">
            document.getElementById("myButton").onclick = function() {
                location.href = "bookDonateform";
            };
        </script>
        <script type="text/javascript">
            document.getElementById("myButton2").onclick = function() {
                location.href = "availableBooks";
            };
        </script>

        <footer>
            <?php include("footer.php") ?>
        </footer>
</body>

</html>