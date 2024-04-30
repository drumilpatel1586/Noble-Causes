<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes-Donate Food</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="food.css">
</head>

<body>
    <?php
    session_start();

    if (isset($_SESSION['fd_message'])) {
        // Output the toast message and script
        echo '<a href="food">
        <div id="foodDonationToast" class="toast align-items-center justify-content-center text-light border-0 position-fixed top-30 start-50 translate-middle" role="alert" aria-live="assertive" aria-atomic="true" style="width: 300px; z-index: 1; border-radius: 10px; background: linear-gradient(135deg, #4CAF50, #FFC107);">
                <div class="toast-body" style="padding: 15px;">
                    ' . $_SESSION['fd_message'] . '
                </div>
            </div></a>';

        // Unset the session variable after displaying the toast
        unset($_SESSION['fd_message']);
    }
    ?>
    <div class="navb">
        <?php include("navbar2.php"); ?>
    </div>

    <!-- New IMAGE -->
    <?php
    require("../admin/config/db_connection.php");
    $query = "SELECT * FROM cms_fd WHERE `cms_fd`.`cms_fd_id` = '1'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) { ?>
        <div class="container-fluid millionClass" style="background-image: url('../Admin/NC_Images/<?php echo $row['fd_image']; ?>');">
        <?php } ?>
        <div class="content">
            <p class="mainImageText">Food Donation</p>
            <p class="mainImageText2">Take a bite out of hunger</p>
        </div>
        </div>

        <!-- button -->

        <div class="container-fluid bookdonate m-0 px-5">
            <div class="button-container col-12">

                <!-- Donate Button -->
                <div class="container d-flex justify-content-around knowMoreBottomSpace">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                        <div class="card-body">
                            <a href="foodDonateform" id="blueLink">
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
                    </div>
                </div>
            </div>
        </div>

        <?php
        require("../Admin/config/db_connection.php");
        $query = "SELECT * FROM cms_fd ";
        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $align = $row['fd_align'];
                if ($align == 'CI') { ?>
                    <div class="box-container">

                        <div class="box-description">
                            <h2> <?php echo $row['fd_title']; ?> </h2>
                            <p><?php echo $row['fd_description']; ?></p>
                        </div>
                        <img class="box-image" src="../Admin/NC_Images/<?php echo $row['fd_image']; ?>" alt="<?php echo $row['fd_image']; ?>">
                    </div>

                    <?php } else {
                    if ($align == 'IC') { ?>

                        <div class="box-container">
                            <div class="food_con_img">

                                <img class="box-image" src="../Admin/NC_Images/<?php echo $row['fd_image']; ?>" alt="<?php echo $row['fd_image']; ?>">
                            </div>
                            <div class="box-description">
                                <h2> <?php echo $row['fd_title']; ?> </h2>
                                <p><?php echo $row['fd_description']; ?></p>
                            </div>
                        </div>

        <?php }
                }
            }
        } ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var foodDonationToast = new bootstrap.Toast(document.getElementById('foodDonationToast'));
                foodDonationToast.show();

                // Close the toast after 2 seconds
                setTimeout(function() {
                    foodDonationToast.hide();
                }, 2000);
            });
        </script>

        <script type="text/javascript">
            document.getElementById("myButton").onclick = function() {
                location.href = "foodDonateform";
            };
        </script>
        <footer>
            <?php include("footer.php") ?>
        </footer>
</body>

</html>