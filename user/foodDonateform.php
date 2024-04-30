    <!DOCTYPE html>

    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
        <title>Noble Causes-Donate Food</title>
        <!-- <link rel="stylesheet" href="../user/foodDonationform2.css" /> -->
        <link rel="stylesheet" href="<?php
                                        require_once('connection.php');
                                        $sql = "SELECT * FROM cms_fdf WHERE fdf_set = 1";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $path = $row['fdf_path'];
                                        echo $path;
                                        ?>" />

    </head>

    <body>
        <?php
        session_start();
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $id = $_SESSION['user_id'];
            $email = $_SESSION['email'];
        } else {
            header("Location:login?source=food");
        } ?>

        <div> <?php include("navbar2.php"); ?></div>

        <?php
        require("../Admin/config/db_connection.php");
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['donate'])) {
                $_SESSION['fd_message'] = "Thank You for donating food to needy person!!";
                $frequency = $_POST['frequency'];
                $food_type = $_POST['type'];
                $donate_to = $_POST['donate_to'];
                $food_validity = $_POST['food_validity'];
                $food_specificaton = $_POST['food_speci'];
                $street = $_POST['street'];
                $city = $_POST['city'];
                $zip_code = $_POST['zip_code'];

                // adding donation data
                $sql = "INSERT INTO `donate_food`(`user_id`, `freq_of_donation`, `donate_to`, `food_type`, `validity`, `specifications`, `pickup_street`, `pickup_city`, `pickup_zip_code`) VALUES ('$id','$frequency','$donate_to','$food_type','$food_validity','$food_specificaton','$street','$city','$zip_code')";
                $result = mysqli_query($conn, $sql);


                //sending gratitude mail
                // require('mailsender.php');


                // adding pickup add into db
                $sql2 = "SELECT `street`,`city`,`zip_code` FROM `pickup_address` WHERE `pickup_address`.`user_id` = '$id'; ";
                $result2 = mysqli_query($conn, $sql2);
                if (($row = mysqli_fetch_array($result2)) > 0) {

                    $sql3 = "UPDATE `pickup_address` SET `street`='$street',`city`='$city',`zip_code`='$zip_code' WHERE `pickup_address`.`user_id` = '$id'; ";
                    $result = mysqli_query($conn, $sql3);
                    header('location:food');
                } else {
                    $sql4 = "INSERT INTO `pickup_address`(`user_id`, `street`, `city`, `zip_code`) VALUES ('$id','$street','$city','$zip_code')";
                    $result = mysqli_query($conn, $sql4);
                    header('location:food');
                }
            }
        }
        ?>

        <div class="container-fluid p-0">
            <div class="foodfirst col-12 mt-4">


                <section class="container">
                    <header>Donate Food</header>
                    <form action="#" class="form" method="POST">
                        <!-- <div class="column"> -->
                        <div class="food-box">
                            <label><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Food Type</label>
                            <div class="type-option">
                                <div class="type">
                                    <input type="radio" id="check-cook" name="type" value="Cooked" checked />
                                    <label for="check-cook">Cooked</label>
                                </div>
                                <div class="type">
                                    <input type="radio" id="check-raw" name="type" value="Raw" />
                                    <label for="check-raw">Raw</label>
                                </div>
                                <div class="type">
                                    <input type="radio" id="check-packed" name="type" value="Packed" />
                                    <label for="check-packed">Packed</label>
                                </div>
                            </div>
                        </div>
                        <div class="food-box">
                            <label><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Donate-to</label>
                            <div class="type-option">
                                <div class="type">
                                    <input type="radio" id="check-cows" name="donate_to" value="cows" />
                                    <label for="check-cows">Cows</label>
                                </div>
                                <div class="type">
                                    <input type="radio" id="check-peoples" name="donate_to" value="peoples" />
                                    <label for="check-peoples">Peoples</label>
                                </div>
                                <div class="type">
                                    <input type="radio" id="check-any" name="donate_to" value="any" checked />
                                    <label for="check-any">Any</label>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <div class="select-box">
                            <label><i class="fa fa-chevron-circle-down" aria-hidden="true"></i><b> Food Validity</b></label>
                            <select name="food_validity">
                                <option>One Day</option>
                                <option>Two-Three Days</option>
                                <option>One Week</option>
                                <option>More than Week</option>
                            </select>
                        </div>
                        <div class="select-box">
                            <label><i class="fa fa-chevron-circle-down" aria-hidden="true"></i><b> Frequency of Donation</b></label>
                            <select name="frequency">
                                <option>One time</option>
                                <option>Daily - morning</option>
                                <option>Daily - afternoon</option>
                                <option>Daily - evening</option>
                            </select>
                        </div>


                        <div class="input-box">
                            <label> <i class="fa fa-edit"></i><b> Specifications</b></label>
                            <input type="textarea" name="food_speci" placeholder="food specification" required />
                        </div>
                        <?php
                        require_once('connection.php');

                        $sql2 = "SELECT `street`,`city`,`zip_code` FROM `pickup_address` WHERE `pickup_address`.`user_id` = '$id'; ";
                        $result2 = mysqli_query($conn, $sql2);
                        if (($row = mysqli_fetch_array($result2)) > 0) {
                            echo '
                <div class="input-box address">
                <label><i class="fa fa-address-card" aria-hidden="true"></i><b> Pickup_Address(Change if not this)</b></label>
                <input type="text" name="street" value="' . $row['street'] . '" required />

                <div class="column">
                    <input type="text" name="city" value="' . $row['city'] . '" required />
                    <input type="text" maxlength="6" name="zip_code" value="' . $row['zip_code'] . '" required />
                </div>

            </div>
            <button type="submit" name="donate">Donate</button>
        </form>';
                        } else {
                            echo '
                <div class="input-box address">
                <label><i class="fa fa-address-card" aria-hidden="true"></i><b> Pickup_Address(Change if not this)</b></label>
                <input type="text" name="street" placeholder="Enter street address" required />

                <div class="column">
                    <input type="text" name="city" placeholder="Enter your city" required />
                    <input type="text" name="zip_code" maxlength="6" placeholder="Enter your Zip code" required />
                </div>

            </div>
            <button type="submit" name="donate">Donate</button>
        </form>';
                        }
                        ?>

                </section>
            </div>
        </div>

        <div class="sfooter">
            <?php include("footer.php") ?>
        </div>

    </body>

    </html>