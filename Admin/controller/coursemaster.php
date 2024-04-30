<?php
require("../config/db_connection.php");

$action = $_GET['action'];
if ($action === 'jasndussjb') {
    echo "C:Course Name Updated";
    $course_id = $_POST['courseIdDisplay'];
    echo $course_id;
    $courseTitleInput = $_POST['courseTitleInput'];
    echo $courseTitleInput;

    $sql = "UPDATE `courses` SET `course_name`= '$courseTitleInput'  WHERE `courses`.`course_id`= '$course_id'";
    $result = $conn->query($sql);

    $_SESSION['message'] = 'Course Name Updated';
    header('location:../include/bdform_coursemaster');
} elseif ($action === 'bduhshuhs') {
    echo "C:";

    $sub_course_name = $_POST['subCourseIdDisplay2'];
    echo $sub_course_name;


    $subCourseIdDisplay = $_POST['subcourseTitleInput'];
    echo $subCourseIdDisplay;

    $sql = "UPDATE `sub_courses` SET `sub_course_name`= '$subCourseIdDisplay'  WHERE `sub_courses`.`sub_course_name`= '$sub_course_name'";
    $result = $conn->query($sql);

    $_SESSION['message'] = 'Sub Course Name Updated';
    header('location:../include/bdform_coursemaster');
} elseif ($action === 'aljsdhioshdh') {

    $course_id = $_POST['courseIdDisplay3'];
    echo $course_id;

    $sql = "DELETE FROM `sub_courses`  WHERE `sub_courses`.`course_id`= $course_id";
    $result = $conn->query($sql);

    $sql = "DELETE FROM `courses`  WHERE `courses`.`course_id`= $course_id";
    $result = $conn->query($sql);


    echo 'Course Deleted';
    $_SESSION['message'] = 'Sub Course Name Updated';
    header('location:../include/bdform_coursemaster');
} elseif ($action === 'sjlhuhs') {

    echo 'delete sub courses';

    $sub_course_name = $_POST['subCourseIdDisplay4'];
    echo $sub_course_name;

    $sql = "DELETE FROM `sub_courses`  WHERE `sub_courses`.`sub_course_name`= '$sub_course_name'";
    $result = $conn->query($sql);


    $_SESSION['message'] = 'Sub Course Name Deleted ';
    header('location:../include/bdform_coursemaster');
}
