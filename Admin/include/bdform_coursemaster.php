<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bdform_coursemaster.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes-Course Master</title>
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .modal-title {
            text-align: center;
            background-color: var(--highlight-color);
        }

        .modal-body {
            text-align: center;
        }

        .input-box {
            margin-top: 3%;
        }

        .btn-action {
            margin-top: 2%;

        }

        .close {
            color: #aaa;
            float: right;
            font-size: 20px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .subclose {
            color: #aaa;
            float: right;
            font-size: 20px;
            font-weight: bold;
        }

        .subclose:hover,
        .subclose:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .modal-header,
        .modal-footer {
            background-color: #f2f2f2;
            padding: 10px 20px;
        }

        .modal-body {
            padding: 20px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .input-box {
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>


<body>
    <?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    } else {
        header("Location: admin_login");
    } ?>
    <div class="bdform_coursemaster">

        <div class="navbar">
            <?php include("../include/sidebar.php"); ?>
        </div>

        <div class="bdform_coursemaster_content">
            <header>
                <div class="bdform_coursemaster_title">
                    <h1>Book Donation Form - Course Master</h1>
                    <ul class="navigation">
                        <li class="navigation-item">
                            <a href="../include/dashboard">Dashboard</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                        </li>
                    </ul>
                </div>
            </header>
            <!-- <form action="../controller/coursemaster" method="POST"> -->

            <div class="title">
                <h3>Book Donation Form - Course Master</h3>
            </div>
            <!-- <form action="#" method="POST"> -->
            <div class="boxs">

                <div class="select-box">
                    <label><i class="fa fa-chevron-circle-down lable" aria-hidden="true"></i> Select a
                        Course:</label>
                    <select name="course" id="course" onchange="getSubCourses()">
                        <?php require('../config/db_connection.php');

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch courses from database
                        $sql = "SELECT course_id, course_name FROM courses";
                        $result = $conn->query($sql);

                        // Output options for each course
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["course_id"] . "' data-subcourses='" . getSubCourses($row["course_id"]) . "'>" . $row["course_name"] . "</option>";
                            }
                        } else {
                            echo "0 results";
                        }

                        // Function to fetch sub-courses for a given course
                        function getSubCourses($courseId)
                        {

                            // Connect to MySQL database
                            require('../config/db_connection.php');
                            // Fetch sub-courses for the given course from database
                            $sql = "SELECT sub_course_name FROM sub_courses WHERE course_id = $courseId";
                            $result = $conn->query($sql);

                            // Store the sub-courses in an array
                            $subCourses = array();
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $subCourses[] = $row["sub_course_name"];
                                    // echo "<option value='" . $row["sub_course_id"] . "'" . $row["course_name"] . "</option>";

                                }
                            }

                            // Return the sub-courses as a JSON-encoded string
                            return json_encode($subCourses);
                        }
                        ?>
                    </select>
                </div>
                <div class="select-box2">

                    <label class="lable" for="sub_course">Select a Sub-Course:</label>
                    <select name="sub_course" id="sub_course">
                        <!-- Sub-courses will be populated dynamically based on the selected course -->

                    </select>

                </div>
                <div class="buttons">

                    <button type="button" class="btn btn-info" id="myaddcourse4">Add Course</button>
                    <button type="button" class="btn btn-info" id="addSubCourse2">Add Sub Course</button>
                    <button type="button" class="btn btn-info" id="updatecourse">Update Course</button>
                    <button type="button" class="btn btn-info" id="updatesubcourse">Update Sub Course</button>
                    <button type="button" class="btn btn-info" id="deletecourse">Delete Course</button>
                    <button type="button" class="btn btn-info" id="subcoursedelete">Delete Sub Course</button>

                </div>

            </div>
        </div>
    </div>

    <!-- add coure modal-->
    <div class="modal update_course" id="addCourse" tabindex="-1" aria-labelledby="addCourse" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="addcourseLabel">Add Course</h3>
                    <button type="button" class="close43" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Input fields and content here -->
                    <form id="courseForm">
                        <div class="input-box">
                            <label for="courseName">Enter Course Name:</label>
                            <input type="text" id="courseName" placeholder="Course Name" required>
                        </div>
                        <div class="input-box">
                            <label for="subcourseName">Enter Sub Course Name:</label>
                            <input type="text" id="subcourseName" placeholder="Sub Course Name" required>
                        </div>
                        <div class="input-box">
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" placeholder="Quantity" required>
                        </div>
                        <!-- Add more input fields or content here if needed -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="submitCourse" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get the modal element
        var add_course = document.getElementById("myaddcourse4");

        // Get the button that opens the modal
        var btn = document.getElementById("addCourse");

        // Get the close button
        var closeBtn = document.getElementsByClassName("close43")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            add_course.style.display = "block";

            // Get the selected course ID and sub-course ID
            var courseId = document.getElementById("course").value; // Get course ID from course dropdown
            var subCourseId = document.getElementById("sub_course").value; // Get sub-course ID from sub-course dropdown

            // Set the course ID and sub-course ID in the modal
            document.getElementById("courseIdDisplay").value = courseId;
            document.getElementById("subCourseIdDisplay").innerText = subCourseId;

            // Set the course title input field value (if needed)
            var courseTitle = document.getElementById("course").options[document.getElementById("course").selectedIndex].text;
            document.getElementById("courseTitleInput").value = courseTitle;
        }

        // When the user clicks on the close button, close the modal
        closeBtn.onclick = function() {
            add_course.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


    <!-- update course modal -->
    <div class="modal update_course" id="myupdatecourse" tabindex="-1" aria-labelledby="myupdatecourse" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-footer">
                    <button type="button" class="close7" data-bs-dismiss="modal"><i class="close bx bx-x-circle"></i></button>
                </div>
                <div class="modal-header">
                    <h3 class="modal-title" id="myupdatecourse">Update Course</h3>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form action="../controller/coursemaster?action=jasndussjb" method="POST">
                            <div class="input-box">
                                <label><i class="fa fa-book" aria-hidden="true"></i>Course Title:</label>
                                <input type="text" name="courseTitleInput" value="" id="courseTitleInput" required />
                            </div>
                            <input type="hidden" id="courseIdDisplay" name="courseIdDisplay" value="">
                            <input type="hidden" id="subCourseIdDisplay" name="subCourseIdDisplay" value="">
                            <button type="submit" class="btn-action" name="Update">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get the modal element
        var update_course = document.getElementById("myupdatecourse");

        // Get the button that opens the modal
        var btn = document.getElementById("updatecourse");

        // Get the close button
        var closeBtn = document.getElementsByClassName("close7")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            update_course.style.display = "block";

            // Get the selected course ID and sub-course ID
            var courseId = document.getElementById("course").value; // Get course ID from course dropdown
            var subCourseId = document.getElementById("sub_course").value; // Get sub-course ID from sub-course dropdown

            // Set the course ID and sub-course ID in the modal
            document.getElementById("courseIdDisplay").value = courseId;
            document.getElementById("subCourseIdDisplay").innerText = subCourseId;

            // Set the course title input field value (if needed)
            var courseTitle = document.getElementById("course").options[document.getElementById("course").selectedIndex].text;
            document.getElementById("courseTitleInput").value = courseTitle;
        }

        // When the user clicks on the close button, close the modal
        closeBtn.onclick = function() {
            update_course.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


    <!-- update subcourse modal -->
    <div class="modal sub_course " id="myupdatesubcourse" tabindex="-1" aria-labelledby="updatesubcourse" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-footer">
                    <button type="button" class="subclose" data-bs-dismiss="modal"><i class="close bx bx-x-circle"></i></button>
                </div>
                <div class="modal-header">
                    <h3 class="modal-title" id="updatesubcourse">Update Sub Course</h3>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form action="../controller/coursemaster?action=bduhshuhs" method="POST">
                            <div class="input-box">
                                <label><i class="fa fa-book" aria-hidden="true"></i>Sub Course Title:</label>
                                <input type="text" name="subcourseTitleInput" value="" id="subcourseTitleInput" required />
                            </div>
                            <!-- <p>Course ID: <span id="courseIdDisplay2"></span></p> -->
                            <!-- <p>Sub-Course ID: <span id="subCourseIdDisplay2"></span></p> -->
                            <input type="hidden" id="courseIdDisplay2" name="courseIdDisplay2" value="">
                            <input type="hidden" id="subCourseIdDisplay2" name="subCourseIdDisplay2" value="">
                            <button type="submit" class="btn-action" name="Update">Update</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Get the modal element
        var sub_course = document.getElementById("myupdatesubcourse");

        // Get the button that opens the sub_course
        var btn = document.getElementById("updatesubcourse");

        // Get the close button
        var closeBtn = document.getElementsByClassName("subclose")[0];

        // When the user clicks the button, open the sub_course
        btn.onclick = function() {
            sub_course.style.display = "block";

            // Get the selected course ID and sub-course ID
            var courseId = document.getElementById("course").value; // Get course ID from course dropdown
            var subCourseId = document.getElementById("sub_course").value; // Get sub-course ID from sub-course dropdown

            // Set the course ID and sub-course ID in the sub_course
            document.getElementById("courseIdDisplay2").value = courseId;
            document.getElementById("subCourseIdDisplay2").value = subCourseId;

            // Set the course title input field value (if needed)
            var courseTitle = document.getElementById("sub_course").options[document.getElementById("sub_course").selectedIndex].text;
            document.getElementById("subcourseTitleInput").value = courseTitle;
        }

        // When the user clicks on the close button, close the sub_course
        closeBtn.onclick = function() {
            sub_course.style.display = "none";
        }

        // When the user clicks anywhere outside of the sub_course, close it
        window.onclick = function(event) {
            if (event.target == sub_course) {
                sub_course.style.display = "none";
            }
        }
    </script>

    <!-- delete course modal -->
    <div class="modal delete_course" id="mydeletecourse" tabindex="-1" aria-labelledby="mydeletecourse" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-footer">
                    <button type="button" class="close3" data-bs-dismiss="modal"><i class="close bx bx-x-circle"></i></button>
                </div>
                <div class="modal-header">
                    <h3 class="modal-title" id="mydeletecourse">Delete Course</h3>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form action="../controller/coursemaster?action=aljsdhioshdh" method="POST">
                            <div class="input-box">
                                <label><i class="fa fa-book" aria-hidden="true"></i>Course Title:</label>
                                <input type="text" name="courseTitleInput3" value="" id="courseTitleInput3" required />
                            </div>
                            <!-- <p>Course ID: <span id="courseIdDisplay"></span></p>
                        <p>Sub-Course ID: <span id="subCourseIdDisplay"></span></p> -->
                            <input type="hidden" id="courseIdDisplay3" name="courseIdDisplay3" value="">
                            <input type="hidden" id="subCourseIdDisplay3" name="subCourseIdDisplay3" value="">
                            <button type="submit" class="btn-action" name="Delete">Delete</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the modal element
        var modal = document.getElementById("mydeletecourse");

        // Get the button that opens the modal
        var btn = document.getElementById("deletecourse");

        // Get the close button
        var closeBtn = document.getElementsByClassName("close3")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";

            // Get the selected course ID and sub-course ID
            var courseId = document.getElementById("course").value; // Get course ID from course dropdown
            var subCourseId = document.getElementById("sub_course").value; // Get sub-course ID from sub-course dropdown

            // Set the course ID and sub-course ID in the modal
            document.getElementById("courseIdDisplay3").value = courseId;
            document.getElementById("subCourseIdDisplay3").innerText = subCourseId;

            // Set the course title input field value (if needed)
            var courseTitle = document.getElementById("course").options[document.getElementById("course").selectedIndex].text;
            document.getElementById("courseTitleInput3").value = courseTitle;
        }

        // When the user clicks on the close button, close the modal
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <!-- delete subcourse modal -->
    <div class="modal delete_s_course" id="delete_s_course" tabindex="-1" aria-labelledby="deletesubcourse" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-footer">
                    <button type="button" class="close4" data-bs-dismiss="modal"><i class="close bx bx-x-circle"></i></button>
                </div>
                <div class="modal-header">
                    <h3 class="modal-title" id="deletesubcourse">Delete Sub Course</h3>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form action="../controller/coursemaster?action=sjlhuhs" method="POST">
                            <div class="input-box">
                                <label><i class="fa fa-book" aria-hidden="true"></i>Course Title:</label>
                                <input type="text" name="courseTitleInput3" value="" id="courseTitleInput4" required />
                            </div>
                            <!-- <p>Course ID: <span id="cid"></span></p>
                        <p>Sub-Course ID: <span id="scid"></span></p> -->
                            <input type="hidden" id="courseIdDisplay4" name="courseIdDisplay4" value="">
                            <input type="hidden" id="subCourseIdDisplay4" name="subCourseIdDisplay4" value="">
                            <button type="submit" class="btn-action" name="Delete_sub_courses">Delete</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the modal element
        var delete_s_course = document.getElementById("delete_s_course");

        // Get the button that opens the modal
        var btn = document.getElementById("subcoursedelete");

        // Get the close button
        var closeBtn = document.getElementsByClassName("close4")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            delete_s_course.style.display = "block";

            // Get the selected course ID and sub-course ID
            var courseId = document.getElementById("course").value; // Get course ID from course dropdown
            var subCourseId = document.getElementById("sub_course").value; // Get sub-course ID from sub-course dropdown

            // Set the course ID and sub-course ID in the modal
            document.getElementById("courseIdDisplay4").value = courseId;
            document.getElementById("subCourseIdDisplay4").value = subCourseId;

            // Set the course title input field value (if needed)
            var courseTitle = document.getElementById("sub_course").options[document.getElementById("sub_course").selectedIndex].text;
            document.getElementById("courseTitleInput4").value = courseTitle;
        }

        // When the user clicks on the close button, close the modal
        closeBtn.onclick = function() {
            delete_s_course.style.display = "none";
        }

        // When the user clicks anywhere outside of the deletesubcourse, close it
        window.onclick = function(event) {
            if (event.target == deletesubcourse) {
                deletesubcourse.style.display = "none";
            }
        }
    </script>



</body>

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

</html>