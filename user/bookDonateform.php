<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes-Book Donate Form</title>
    <!-- <link rel="stylesheet" href="donateform2.css" /> -->
    <link rel="stylesheet" href=" 
    <?php require_once 'connection.php';
    $sql = "SELECT * FROM `cms_bdf` WHERE `bdf_set` = 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $path = $row['bdf_path'];
    echo $path;
    ?>
" />



</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $id = $_SESSION['user_id'];
    } else {
        header("Location:login?source=book");
    } ?>
    <?php
    require("connection.php");


    $insert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $title = $_POST["title"];
        $author = $_POST["author"];
        $course = $_POST["course"];
        $sub_course = $_POST["sub_course"];
        $quantity = $_POST["quantity"];
        $date = $_POST["date"];

        // Current date (date only)
        $currentDate = date("Y-m-d");

        // Check if the date is in the correct format
        if (DateTime::createFromFormat('Y-m-d', $date) !== false) {
            // Check if the date is today or in the future
            if ($date >= $currentDate || $date == $currentDate) {

                $description = $_POST["description"];
                $street = $_POST['street'];
                $city = $_POST['city'];
                $zip_code = $_POST['zip_code'];
                if (isset($_POST['submit']) && isset($_FILES['image'])) {

                    $img_name = $_FILES['image']['name'];
                    $img_size = $_FILES['image']['size'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $error = $_FILES['image']['error'];

                    if ($error === 0) {
                        if ($img_size > 5000000) {
                            $em = "Sorry, your file is too large.";
                            echo '<script>alert("' . $em . '")</script>';
                        } else {
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                            $img_ex_lc = strtolower($img_ex);

                            $allowed_exs = array("jpg", "jpeg", "png");

                            if (in_array($img_ex_lc, $allowed_exs)) {
                                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                                $img_upload_path = 'BookImage/' . $new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);

                                // //sending mail
                                require('mailsender.php');

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

                                $sql = "INSERT INTO `donate_book` (`user_id`,`title`, `author`, `course`,`sub_course`,`book_quantity`, `pickup_date`, `pickup_street`, `pickup_zip_code`, `pickup_city`,`image`, `description`) VALUES ('$id','$title', '$author', '$course', '$sub_course','$quantity','$date', '$street','$zip_code','$city','$new_img_name', '$description');";
                                $result = mysqli_query($conn, $sql);

                                $_SESSION['bookdonationMessage'] = 'Thank You for donating Book to Noble Causes';
                                header("Location:education");
                            } else {
                                $em = "You can't upload files of this type";
                                echo '<script>alert("' . $em . '")</script>';
                            }
                        }
                    } else {
                        $em = "unknown error occurred in file upload!";
                        echo '<script>alert("' . $em . '")</script>';
                    }
                }
            }
        } else {
            echo "<script>alert('The date is valid but is in the past');
            document.location.href = 'bookdonation';
            </script>";
        }
    }


    ?>
    <div> <?php include("navbar2.php") ?></div>

    <div class="container-fluid p-0">
        <div class="bookfirst col-12 mt-4">
            <section class="container">
                <header>Donate Book</header>
                <form action="#" class="form" method="POST" id="prog" enctype="multipart/form-data">

                    <div class="input-box">
                        <label><i class="fa fa-book" aria-hidden="true"></i> Book Title</label>
                        <input type="text" name="title" placeholder="Enter Book Title" required />
                    </div>
                    <div class="column">
                        <div class="input-box">
                            <label><i class="fa fa-user" aria-hidden="true"></i> Author Name</label>
                            <input type="text" name="author" placeholder="Enter Author Name" required />
                        </div>
                        <div class="select-box">
                            <label><i class="fa fa-chevron-circle-down" aria-hidden="true"></i> Select a Course:</label>
                            <select name="course" id="course" onchange="getSubCourses()">
                                <?php require('connection.php');

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Fetch courses from database
                                $sql = "SELECT course_id, course_name FROM courses";
                                $result = $conn->query($sql);

                                // Output options for each course
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["course_name"] . "' data-subcourses='" . getSubCourses($row["course_id"]) . "'>" . $row["course_name"] . "</option>";
                                    }
                                } else {
                                    echo "0 results";
                                }

                                // Function to fetch sub-courses for a given course
                                function getSubCourses($courseId)
                                {
                                    require('connection.php');
                                    $sql = "SELECT sub_course_name FROM sub_courses WHERE course_id = $courseId";
                                    $result = $conn->query($sql);

                                    $subCourses = array();
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $subCourses[] = $row["sub_course_name"];
                                        }
                                    }


                                    // Return the sub-courses as a JSON-encoded string
                                    return json_encode($subCourses);
                                }
                                ?>
                            </select>
                        </div>
                        <div class="select-box">

                            <label for="sub_course">Select a Sub-Course:</label>
                            <select name="sub_course" id="sub_course">
                                <!-- Sub-courses will be populated dynamically based on the selected course -->
                            </select>

                        </div>

                    </div>

                    <div class="column">
                        <div class="input-box">
                            <label><i class="fas fa-sort-amount-up" aria-hidden="true"></i> Quantity of Book</label>
                            <input type="number" name="quantity" placeholder="Enter quantity of book" value="1" required />
                        </div>
                        <div class="input-box">
                            <label><i class="fa fa-calendar" aria-hidden="true"></i> Pickup Date</label>
                            <input type="date" name="date" placeholder="Pickup Date" min=<?php echo date('Y-m-d'); ?> required />
                        </div>
                        <div class="image-box">
                            <label><i class="fa fa-picture-o" aria-hidden="true"></i> Upload Book Image</label>
                            <input type="file" name="image" required />
                        </div>
                    </div>
                    <div class="input-box">
                        <label> <i class="fa fa-edit"></i> Book Description</label>
                        <input type="textarea" name="description" placeholder="Enter Description" required />
                    </div>
                    <?php
                    require_once('connection.php');

                    $sql2 = "SELECT `street`,`city`,`zip_code` FROM `pickup_address` WHERE `pickup_address`.`user_id` = '$id'; ";
                    $result2 = mysqli_query($conn, $sql2);
                    if (($row = mysqli_fetch_array($result2)) > 0) {
                        echo '
                <div class="input-box address">
                <label><i class="fa fa-address-card" aria-hidden="true"></i> Pickup_Address(Change if not this)</label>
                <input type="text" name="street" value="' . $row['street'] . '" required />

                <div class="column">
                    <input type="text" name="city" value="' . $row['city'] . '" required />
                    <input type="text" name="zip_code" value="' . $row['zip_code'] . '" required />
                </div>

            </div>
            <button type="submit" name="submit">Donate</button>
        </form>';
                    } else {
                        echo '
                <div class="input-box address">
                <label><i class="fa fa-address-card" aria-hidden="true"></i> Pickup_Address(Change if not this)</label>
                <input type="text" name="street" placeholder="Enter street address" required />

                <div class="column">
                    <input type="text" name="city" placeholder="Enter your city" required />
                    <input type="text" name="zip_code" placeholder="Enter your Zip code" required />
                </div>
                <button type="submit" name="submit">Donate</button>
            </div>';
                    } ?>

                </form>
            </section>
            <script>
                // Function to show sub-courses for the selected course
                function showSubCourses() {
                    var courseSelect = document.getElementById("course");
                    var subCourseSelect = document.getElementById("sub_course");
                    var selectedCourse = courseSelect.options[courseSelect.selectedIndex];
                    var subCourses = JSON.parse(selectedCourse.getAttribute("data-subcourses"));

                    // Clear previous options
                    subCourseSelect.innerHTML = "";

                    // Add sub-courses options
                    subCourses.forEach(function(subCourse) {
                        var option = document.createElement("option");
                        option.text = subCourse;
                        subCourseSelect.add(option);
                    });
                }

                // Call the showSubCourses function when the page loads
                window.onload = showSubCourses;

                // Attach event listener to course select to show sub-courses when course is changed    
                document.getElementById("course").addEventListener("change", showSubCourses);
            </script>


            <div class="sfooter">
                <?php include("footer.php") ?>
            </div>
        </div>
    </div>
</body>


</html>