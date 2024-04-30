<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include database connection
require_once('connection.php');
require_once('encrypt_decrypt.php');
    

// Define the number of items per page
$itemsPerPage = 3;

// Get the current page number from the URL, default to page 1
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset based on the current page
$offset = ($currentPage - 1) * $itemsPerPage;
// Check if the course and sub-course are set in the POST request
if (isset($_POST['course']) && isset($_POST['sub_course'])) {
    // Sanitize input
    $course = $_POST['course'];
    // echo $course;
    $subCourse = $_POST['sub_course'];
    // echo $subCourse;


    // Prepare SQL query to fetch book records based on the selected course and sub-course
    $sql = "SELECT * FROM `available_books` WHERE `available_books`.`course` = '$course' AND `available_books`.`sub_course` = '$subCourse' AND `available_books`.`book_quantity` > 0";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_array($result);

        $ISBN = $row['ISBN_No'];
        $available_book_no = encrypt_number(32,$row['available_book_no']);
        // echo $ISBN . '=>';


        $sql1 = "SELECT * FROM `book_record` WHERE `book_record`.`ISBN_No`= '$ISBN'";
        $result1 = mysqli_query($conn, $sql1);


        // Check if there are any matching records
        if ($result1->num_rows > 0) {
            echo '<div class="container">';
            echo '    <div class="row">';
            // Output data of each row
            while ($row1 = $result1->fetch_array()) {
                
                echo '        <div class="col-md-4">';
                echo '            <div class="card book-card"  style="width: 100%; height: auto; object-fit: fill;" >';
                echo '                <img class="card-img-top img-fluid" style="width: 100%; height: 250px; object-fit: fill;"  src="BookImage/' . $row1['image'] . '" alt="' . $row1['title'] . '">';
                echo '                <div class="card-body">';
                echo '                    <h4 class="card-title text-center mt-3" style="width: 100%; height: 50px; object-fit: fill;">' . $row1['title'] . '</h5>';
                echo '                    <h6 class="card-text text-center mt-3" style="width: 100%; height: 50px; object-fit: fill;">By ' . $row1['author'] . '</h6>';
                echo '                    <h6 class="card-text text-center mt-2" style="width: 100%; height: 50px; object-fit: fill;">Course: <b>' . $row1['course'] . '</b></h6>';

                echo ' <form id="applyForm" action="applyForBook" method="POST">
                        <input type="hidden" name="available_book_no" value="'.$available_book_no.'" />
                        <button type="submit" id="applyBtn" class="btn btn-info " style="width: 100%" data-bs-dismiss="modal">Apply For this Book</button>
                    </form>';
                echo '                </div>';
                echo '            </div>';
                echo '        </div>';
            }
            // Calculate the total number of pages outside the loop
            $sqlCount = "SELECT COUNT(*) AS count FROM donate_book";
            $resultCount = $conn->query($sqlCount);
            $rowCount = $resultCount->fetch_assoc()['count'];
            $totalPages = ceil($rowCount / $itemsPerPage);

            // Set the maximum number of visible pages
            $maxVisiblePages = 1;
            echo '<ul class="pagination">';

            // Output "Previous" button
            echo '<li class="page-item ' . ($currentPage == 1 ? 'disabled' : '') . '">';
            echo '<a class="page-link" href="?page=' . ($currentPage - 1) . '" tabindex="-1" aria-disabled="true">Previous</a>';
            echo '</li>';

            // Output page links with ellipsis
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $currentPage || $i <= $maxVisiblePages || $i > $totalPages - $maxVisiblePages || ($i >= $currentPage - floor($maxVisiblePages / 2) && $i <= $currentPage + floor($maxVisiblePages / 2))) {
                    echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '">';
                    echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
                    echo '</li>';
                } elseif (($i == $maxVisiblePages + 1 || $i == $totalPages - $maxVisiblePages) && $maxVisiblePages < $totalPages) {
                    echo '<li class="ellipsis">...</li>';
                }
            }

            // Output "Next" button
            echo '<li class="page-item ' . ($currentPage == $totalPages ? 'disabled' : '') . '">';
            echo '<a class="page-link" href="?page=' . ($currentPage + 1) . '">Next</a>';
            echo '</li>';
            echo '</ul>';
        } else {
            // No matching records found
            echo "<div class='col-12'><p>No books found for the selected course and sub-course.</p></div>";
        }

        // Close prepared statement and database connection
    } else {
        // Error occurred
        echo "<div class='col-12'><p>No books found for the selected course and sub-course.</p></div>";
    }
}
