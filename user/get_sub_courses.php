<?php require('connection.php');

if (isset($_GET["course_id"])) {
    // Sanitize the input to prevent SQL injection
    $courseId = intval($_GET["course_id"]);
    $sql = "SELECT sub_course_id, sub_course_name FROM sub_courses WHERE course_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $courseId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Store the results in an array
    $subCourses = array();
    while ($row = $result->fetch_assoc()) {
        $subCourses[] = $row;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();

    // Return the sub-courses as JSON data
    header('Content-Type: application/json');
    echo json_encode($subCourses);
} else {
    // If course_id parameter is not set, return an error message
    echo "Error: course_id parameter is required.";
}
?>