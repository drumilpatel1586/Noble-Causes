<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">  
    <title>Noble Causes - Available Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="availableBooks.css?v=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
    <?php
   session_start();
   if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
   } else {
       header("Location:login");
   } ?>

    <div class="nav">
        <?php include('navbar2.php'); ?>

    </div>

    <div class="course">

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

        <!-- Add Search Button -->
        <button id="searchBtn" class="search btn btn-info select-box">Search</button>

    </div>


    </div>
    </div>

    <div class="container" id="search-results">
        <div class="container">
            <div class="row">
                <!-- Search results will be displayed here -->

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

                    // Search button click event
                    $('#searchBtn').click(function() {
                        var courseId = $('#course').val();
                        var subCourse = $('#sub_course').val();

                        // Perform search
                        $.ajax({
                            url: 'bookSearch.php',
                            method: 'POST',
                            data: {
                                course: courseId,
                                sub_course: subCourse
                            },
                            success: function(data) {
                                $('#search-results').html(data);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error performing search:', error);
                            }
                        });
                    });
                </script>

            </div>

            <script>
                $(document).ready(function() {
                    // Function to populate sub-courses based on the selected course
                    $('#course').change(function() {
                        var courseId = $(this).val();
                        $.ajax({
                            url: 'getSubCourses.php',
                            method: 'POST',
                            data: {
                                course_id: courseId
                            },
                            success: function(data) {
                                $('#sub_course').html(data);
                            }
                        });
                    });

                });
            </script>

        </div>
    </div>
</body>

<?php include('footer.php'); ?>

</html>