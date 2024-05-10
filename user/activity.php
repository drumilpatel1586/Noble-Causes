<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap link -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- CSS Link -->
    <link rel="stylesheet" href="../user/profile.css">
    <style>
        .book-card img {
            width: 100%;
            height: 230px;
            object-fit: fill;
        }

        .card {
            margin-top: 20px;
        }

        
        @media screen and (max-width: 480px) {

            .table-author,
            .author {
                display: none;
            }

            .table-course,
            .course {
                display: none;
            }   

            .type {
                display: none;
            }
        }
    </style>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes-User Activity</title>
</head>

<body>

    <!-- Bcak to home button -->
    <div class="backtohome mt-4 ml-5">
        <a href="index"> <i class='fas fa fa-angle-left' style='font-size:15px'></i>
                <b> Back To Home </b>
            </a>
    </div>

    <?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $user_id = $_SESSION['user_id'];
    } else {
        header("Location:login");
    }
    ?>
    <?php
    require 'connection.php';
    include "profile_navbar.php";
    

    $sql = "SELECT * FROM user_login WHERE user_id= '$user_id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="profile-info col-md-9">
                    <div class="panel">
                        <!-- <div class="bio-graph-heading">
            <h5>“Help others without any reason and give without the expectation of receiving anything in return.”</h5>
        </div> -->

                        <h4 class="text-center mt-2">Donated Book</h4>
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th class="author">Author</th>
                                    <th class="course">Course</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_id = $_SESSION['user_id'];
                                $sql = "SELECT * FROM donate_book WHERE user_id = $user_id limit 5";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr class="details">';
                                        echo '    <td><img class="table-image" src="BookImage/' . $row['image'] . '" alt="' . $row['title'] . '" height="50" width="50"></td>';
                                        echo '    <td class="table-title">' . $row['title'] . '</td>';
                                        echo '    <td class="table-author">' . $row['author'] . '</td>';
                                        echo '    <td class="table-course">' . $row['course'] . '</td>';
                                        echo '    <td class="table-status" style="display: none">' . $row['status'] . '</td>';
                                        echo '    <td class="table-time" style="display: none">' . $row['time'] . '</td>';
                                        echo '    <td><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#bookModal"> View </button></td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="5">No books found</td></tr>';
                                }
                             } ?>
                            </tbody>
                        </table>

                            



                        <!-- Modal -->
                        <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookModalLabel">Book Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="" class="img-fluid mx-auto" alt="" style="height: 400px; width: 350px;">
                                        <table class="table mt-3">
                                            <tbody>
                                                <tr>
                                                    <td>Title:</td>
                                                    <td class="modal-title"></td>
                                                </tr>
                                                <tr>
                                                    <td>Author:</td>
                                                    <td class="modal-author"></td>
                                                </tr>
                                                <tr>
                                                    <td>Course:</td>
                                                    <td class="modal-course"></td>
                                                </tr>

                                                <tr>
                                                    <td>Status:</td>
                                                    <td class="modal-status"></td>
                                                </tr>
                                                <tr>
                                                    <td>Donation Date:</td>
                                                    <td class="modal-time"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <script>
                            $('#bookModal').on('show.bs.modal', function(event) {

                                var button = $(event.relatedTarget); // Button that triggered the modal
                                var bookImage = button.closest('.details').find('.table-image').attr('src');
                                var bookTitle = button.closest('.details').find('.table-title').text();
                                var bookAuthor = button.closest('.details').find('.table-author').text();
                                var bookCourse = button.closest('.details').find('.table-course').text();
                                var bookStatus = button.closest('.details').find('.table-status').text();
                                var bookDate = button.closest('.details').find('.table-time').text();

                                var modal = $(this);
                                modal.find('.modal-body img').attr('src', bookImage);
                                modal.find('.modal-body .modal-title').text(bookTitle);
                                modal.find('.modal-body .modal-author').text(bookAuthor);
                                modal.find('.modal-body .modal-course').text(bookCourse);
                                modal.find('.modal-body .modal-status').text(bookStatus);
                                modal.find('.modal-body .modal-time').text(bookDate);
                            });
                        </script>


                        <h4 class="text-center mt-2">Donated Food</h4>
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>Frequency</th>
                                    <th class="type">Type</th>
                                    <th>Validity</th>
                                    <th>Specification</th>
                                    <th>Date</th>
                                    <th class="status" style="display: none">status</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_id = $_SESSION['user_id'];
                                $sql = "SELECT * FROM donate_food WHERE user_id = $user_id ORDER BY `time` DESC  LIMIT 10";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $food_id = $row['food_id'];
                                        echo '<tr class="fooddetails">';

                                        echo '    <td class="freq_of_donation">' . $row['freq_of_donation'] . '</td>';
                                        echo '    <td class="type">' . $row['food_type'] . '</td>';
                                        echo '    <td class="validity">' . $row['validity'] . '</td>';
                                        echo '    <td class="specifications">' . $row['specifications'] . '</td>';
                                        echo '    <td class="time">' . $row['time'] . '</td>';
                                        echo '    <td class="status"  style="display: none"  >' . $row['status'] . '</td>';
                                        $sql53 = "SELECT * FROM donate_food WHERE `donate_food`.`food_id` = $food_id AND `donate_food`.`status`='pickuped'";
                                        $result53 = $conn->query($sql53);
                                        if ($result53->num_rows > 0) {

                                            echo '    <td><button type="button" class="btn btn-info statusBtn" data-bs-toggle="modal" data-bs-target="#foodModal2"> Status</button></td>';
                                        } else {
                                            $sql253 = "SELECT * FROM donate_food WHERE `donate_food`.`food_id` = $food_id AND `donate_food`.`status`='cancelled'";
                                            $result253 = $conn->query($sql253);
                                            if ($result253->num_rows > 0) {

                                                echo '    <td><button type="button" class="btn btn-info statusBtn" data-bs-toggle="modal" data-bs-target="#foodModal2"> Status</button></td>';
                                            } else {
                                                $sql243 = "SELECT * FROM donate_food WHERE `donate_food`.`food_id` = $food_id AND (`donate_food`.`status`='approved' OR `donate_food`.`status`='pendding:v' )";
                                                $result243 = $conn->query($sql243);
                                                if ($result243->num_rows > 0) {

                                                    echo '    <td><button type="button" class="btn btn-info statusBtn" data-bs-toggle="modal" data-bs-target="#foodModal"> Status</button></td>';
                                                } else {
                                                    $sql243 = "SELECT * FROM donate_food WHERE `donate_food`.`food_id` = $food_id AND `donate_food`.`status`='delivered'";
                                                    $result243 = $conn->query($sql243);
                                                    if ($result243->num_rows > 0) {
                                                        echo '    <td class="delivered_place" style="display: none"  >' . $row['delivered_place'] . '</td>';
                                                        echo '    <td><button type="button" class="btn btn-info statusBtn" data-bs-toggle="modal" data-bs-target="#foodModal21"> Status</button></td>';
                                                    }else{
                                                        echo '    <td class="delivered_place" style="display: none"  >' . $row['delivered_place'] . '</td>';
                                                        echo '    <td><button type="button" class="btn btn-info statusBtn" data-bs-toggle="modal" data-bs-target="#foodModal21"> Status</button></td>';
                                                    }
                                                }
                                            }

                                            $sql2 = "SELECT * FROM approved_food_req WHERE `approved_food_req`.`food_id` = $food_id ";
                                            $result2 = $conn->query($sql2);
                                            $row2 = mysqli_fetch_array($result2);
                                            if ($row2 > 0) {
                                                echo '    <td class="volunteer_name"    style="display: none">' . $row2['v_name'] . '</td>';
                                            } else {
                                                echo '<td class="volunteer_name"    style="display: none">We will assigned volunteer soon</td>';
                                            }
                                            echo '</tr>';
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                        <!--food Modal -->
                        <div class="modal fade" id="foodModal" tabindex="-1" aria-labelledby="foodModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookModalLabel">Donated Food Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <table class=table>
                                            <thead>
                                                <th>#</th>
                                                <th>Status</th>
                                            </thead>
                                            <tr>
                                                <td><b class="mt-3">Donation Status:</b></td>
                                                <td class=".text-success">
                                                    <P1 class="text-black-50"></p1>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>Assigned Volunteer:</b></p>
                                                </td>
                                                <td>
                                                    <P2 class="text-black-50"></P2>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $('#foodModal').on('show.bs.modal', function(event) {
                                var button = $(event.relatedTarget); // Button that triggered the modal

                                var FOODVALIDITY = button.closest('.fooddetails').find('.status').eq(0).text();
                                var volunteer_name = button.closest('.fooddetails').find('.volunteer_name').eq(0).text();


                                var modal = $(this);
                                modal.find('.modal-body p1').eq(0).text(FOODVALIDITY);
                                modal.find('.modal-body p2').eq(0).text(volunteer_name);

                            });
                        </script>

                        <!--food21 Modal -->
                        <div class="modal fade" id="foodModal21" tabindex="-1" aria-labelledby="foodModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookModalLabel">Donated Food Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <table class=table>
                                            <thead>
                                                <th>#</th>
                                                <th>Status</th>
                                            </thead>
                                            <tr>
                                                <td><b class="mt-3">Donation Status:</b></td>
                                                <td class=".text-success">
                                                    <P1 class="text-black-50"></p1>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>Delivered At:</b></p>
                                                </td>
                                                <td>
                                                    <P2 class="text-black-50"></P2>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $('#foodModal21').on('show.bs.modal', function(event) {
                                var button = $(event.relatedTarget); // Button that triggered the modal

                                var FOODVALIDITY = button.closest('.fooddetails').find('.status').eq(0).text();
                                var delivered_place = button.closest('.fooddetails').find('.delivered_place').eq(0).text();


                                var modal = $(this);
                                modal.find('.modal-body p1').eq(0).text(FOODVALIDITY);
                                modal.find('.modal-body p2').eq(0).text(delivered_place);

                            });
                        </script>
                        <!-- //food2 Modal -->
                        <div class="modal pc" id="foodModal2" tabindex="-1" aria-labelledby="foodModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookModalLabel">Donated Food Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <table class=table>
                                            <thead>
                                                <th>#</th>
                                                <th>Status</th>
                                            </thead>
                                            <tr>
                                                <td><b class="mt-3">Donation Status:</b></td>
                                                <td class=".text-success">
                                                    <P1 class="text-black-50"></p1>
                                                </td>
                                            </tr>


                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $('#foodModal2').on('show.bs.modal', function(event) {
                                var button = $(event.relatedTarget); // Button that triggered the modal

                                var FOODVALIDITY = button.closest('.fooddetails').find('.status').eq(0).text();
                                var volunteer_name = button.closest('.fooddetails').find('.volunteer_name').eq(0).text();


                                var modal = $(this);
                                modal.find('.modal-body p1').eq(0).text(FOODVALIDITY);
                                modal.find('.modal-body p2').eq(0).text(volunteer_name);

                            });
                        </script>





                    </div>
                </div>





            </div>
        </div>

        <!-- Profile div is finish -->

        <!-- <?php
                include("footer.php");
                ?> -->

</body>

</html>