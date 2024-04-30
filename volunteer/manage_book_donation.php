<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes - Manage BookDonation</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="modal.css">
    <style>
        .modal-backdrop {
            z-index: 0;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <?php
    session_start();
    if (isset($_SESSION['v_loggedin']) && $_SESSION['v_loggedin'] == true) {
        $v_id = $_SESSION['v_id'];
    } else {
        header("Location: volunteer_login");
    }
    include "../connection.php";
    $update = false;
    $delete = false;
    $collect = false;
    if (isset($_GET['delete'])) {
        $book_id = $_GET['delete'];

        $sql = "UPDATE `approved_book_req` SET `status` = 'pickupfailed' WHERE `approved_book_req`.`book_id` = '$book_id';";
        $result = mysqli_query($conn, $sql);

        $sql = "UPDATE `donate_book` SET `status` = 'pickupfailed' WHERE `donate_book`.`book_id` = '$book_id';";
        $result = mysqli_query($conn, $sql);

        $delete = true;
        header('location:manage_book_donation');
    }
    if (isset($_GET["collect"])) {
        $book_id = $_GET["collect"];

        $sql5 = "SELECT `user_id` FROM `donate_book` WHERE `book_id`=$book_id";
        $result5 = mysqli_query($conn, $sql5);
        $row5 = mysqli_fetch_array($result5);
        $user_id = $row5['user_id'];

        $sql54 = "SELECT * FROM `donate_book` WHERE `book_id`= $book_id";
        $result54 = mysqli_query($conn, $sql54);
        $row54 = mysqli_fetch_array($result54);

        $book_id = $row54['book_id'];
        $title = $row54['title'];
        $author = $row54['author'];
        $course = $row54['course'];
        $book_quantity = $row54['book_quantity'];
        $sub_course = $row54['sub_course'];
        $image = $row54['image'];
        $description = $row54['description'];

        $sql = "INSERT INTO `pickedup_book`(`book_id`, `title`, `author`, `course`, `book_quantity`, `sub_course`, `image`, `description`) VALUES ('$book_id','$title','$author','$course','$book_quantity','$sub_course','$image','$description')";
        $result = mysqli_query($conn, $sql);

        $sql = "UPDATE `donate_book` SET `status` = 'collected' WHERE `donate_book`.`book_id` = $book_id;";
        $result = mysqli_query($conn, $sql);


        $sql33 = "SELECT * FROM `user_donation_quantity_record` WHERE `user_id`='$user_id'";
        $result33 = mysqli_query($conn, $sql33);
        $row33 = mysqli_fetch_array($result33);

        if ($result33->num_rows > 0) {
            $sql4 = "UPDATE `user_donation_quantity_record` SET `donation_quantity`=`donation_quantity`+1 WHERE `user_donation_quantity_record`.`user_id`='$user_id'  ";
            $result4 = mysqli_query($conn, $sql4);
            // echo 'q updated';
        } else {

            $sql2 = "INSERT INTO `user_donation_quantity_record`(`user_id`) VALUES ('$user_id')";
            $result2 = mysqli_query($conn, $sql2);
            // echo 'q inserted';
        }

        $sql = "DELETE FROM `approved_book_req` WHERE `book_id` = $book_id";
        $result = mysqli_query($conn, $sql);

        $collect = true;
        header('location:manage_book_donation');
    }
    if (isset($_GET["going_to"])) {
        $book_id = $_GET["going_to"];

        $sql4 = "SELECT `title` FROM `approved_book_req` WHERE `status`='out_for_pickup'";
        $result4 = mysqli_query($conn, $sql4);
        if ($result4->num_rows > 0) {

            $err = "You must have to pickedup first previously selected donation";
            echo '<script>alert("' . $err . '")</script>';
        } else {

            $sql = "UPDATE `donate_book` SET `status` = 'out_for_pickup' WHERE `donate_book`.`book_id` = $book_id;";
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE `approved_book_req` SET `status` = 'out_for_pickup' WHERE `approved_book_req`.`book_id` = $book_id;";
            $result = mysqli_query($conn, $sql);
            // require('goingtomailsender.php');
            $going_to = true;

            header('location:manage_book_donation');
        }
    }
    ?>

    <div class="wrapper">
        <!-- Navbar -->
        <?php include("navbar.php"); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Book Donations</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active">Manage BookDonation</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Donor Name</th>
                                                <th>Donor Phone</th>
                                                <th>Book Title</th>
                                                <th>Book Author</th>
                                                <!-- <th style="display: none;">Status</th> -->
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $sql = "SELECT * FROM `approved_book_req` where `status`='out_for_pickup' AND `v_id`=$v_id LIMIT 1";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $i = $i + 1;
                                                $user_id = $row['user_id'];
                                                $sql2 = "SELECT * FROM `user_login` where `user_id`='$user_id'";
                                                $result2 = mysqli_query($conn, $sql2);
                                                $row2 = mysqli_fetch_assoc($result2);
                                                echo "<tr>
                                            <td>" . $i . "</td>
                                            <td>" . ucfirst($row2['name']) . "</td>
                                            <td>" . $row2['phone'] . "</td>
                                            <td>" . $row['title'] . "</td>
                                            <td>" . $row['author'] . "</td>
                                            <td class='bookid' style='display: none;'>" . $row['book_id'] . "</td>;
                                            <td>
                                            <button type='button' class='btn btn-info statusBtn' data-bs-toggle='modal' data-bs-target='#bookcollect' data-book-id=" . $row['book_id'] . ">Pick Up</button>

                                            <button class='delete center btn btn-sm btn-danger' id='d" . $row['book_id'] . "'>Delete</button>
                                             <button class='view btn btn-sm btn-info' onclick='showBookDetails( \"" . ucfirst($row2['name']) . "\",\"" . ($row2['phone']) . "\",\"" . ($row2['email']) . "\",\"" . ($row['title']) . "\",\"" . ucfirst($row['author']) . "\", \"" . $row['course'] . "\",\"" . $row['description'] . "\",\"" . $row['pickup_street'] . "\",\"" . $row['pickup_city'] . "\", \"" . $row['pickup_zip_code'] . "\")'>View</button> 
                                            </td>
                                          </tr>";
                                          echo "<script>
                                          document.addEventListener('DOMContentLoaded', function() {
                                              var bookId = " . $row['book_id'] . ";
                                              document.getElementById('modal-bookid').value = bookId;
                                          });
                                      </script>";
                                            }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Donor Name</th>
                                                <th>Donor Phone</th>
                                                <th>Book Title</th>
                                                <th>Book Author</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $sql = "SELECT * FROM `approved_book_req` where `status`='approved' AND `v_id`=$v_id";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $i = $i + 1;
                                                $user_id = $row['user_id'];
                                                $sql2 = "SELECT * FROM `user_login` where `user_id`='$user_id'";
                                                $result2 = mysqli_query($conn, $sql2);
                                                $row2 = mysqli_fetch_assoc($result2);
                                                echo "<tr class='details'>
                                            <td>" . $i . "</td>
                                            <td>" . ucfirst($row2['name']) . "</td>
                                            <td>" . $row2['phone'] . "</td>
                                            <td>" . $row['title'] . "</td>
                                            <td>" . $row['author'] . "</td>
                                            <td><button class='going_to center btn btn-sm btn-success' id='d" . $row['book_id'] . "'>Going To Pickup</button>
                                             <button class='view btn btn-sm btn-info' onclick='showBookDetails( \"" . ucfirst($row2['name']) . "\",\"" . ($row2['phone']) . "\",\"" . ($row2['email']) . "\",\"" . ($row['title']) . "\",\"" . ucfirst($row['author']) . "\", \"" . $row['course'] . "\",\"" . $row['description'] . "\",\"" . $row['pickup_street'] . "\",\"" . $row['pickup_city'] . "\", \"" . $row['pickup_zip_code'] . "\")'>View</button> 
                                            </td>
                                          </tr>";
                                            }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Modal -->
            <form action="controller/bookpickup" method="POST">
                <div class="modal" id="bookcollect" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Enter ISBN No.</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <!-- Table inside modal -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ISBN No</th>
                                            <th>#</th>
                                            <th style="display: none;">Book ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Enter ISBN no</td>
                                            <td><input type="text" class="form-control" maxlength="13"  name="isbnNoInput" id="isbnNoInput"></td>
                                            <td><input type="number" style="display: none;" class="modal-bookid" name="bookid" id="modal-bookid" value=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">

                                <!-- Collect Button -->
                                <button type="submit" class="btn btn-primary">Collect</button>

                                <!-- Close Button -->
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>

                        </div>
                    </div>
                </div>
            </form>


            <div id="bookModal" class="modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div id="bookDetails"></div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var deleteToast = new bootstrap.Toast(document.getElementById('deleteToast'));
                    deleteToast.show();

                    // Close the toast after 3 seconds
                    setTimeout(function() {
                        deleteToast.hide();
                    }, 30000);
                });
            </script>

            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <script>
            deletes = document.getElementsByClassName('delete');
            Array.from(deletes).forEach((element) => {
                element.addEventListener("click", (e) => {
                    book_id = e.target.id.substr(1);

                    if (confirm("Are you sure you want to delete this user?")) {
                        console.log("yes");
                        window.location = `manage_book_donation?delete=${book_id}`;

                    } else {
                        console.log("no");
                    }
                })
            })
        </script>
        <!-- <script>
            $('#bookcollect').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var bookID = button.closest('.details').find('.book_id').text();

                var modal = $(this);
                modal.find('.modal-body .bookIdColumn').text(bookID);


                // Function to populate input field and third column in modal with button value
                document.addEventListener('DOMContentLoaded', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('bookcollect'));

                    // Event listener when modal is about to be shown
                    myModal.addEventListener('show.bs.modal', function(event) {

                        // Button that triggered the modal
                        var button = event.relatedTarget;

                        // Extract value from data-book-id attribute
                        var book_Id = button.getAttribute('data-book-id');

                        // Populate the input field with the book ID
                        var isbnInput = document.getElementById('isbnNoInput');
                        isbnInput.value = bookId;

                        // Populate the third column with the book ID
                        var bookIdColumn = document.getElementById('bookIdColumn');
                        bookIdColumn.innerText = book_Id;

                        // Set the data-book-id attribute of the Collect button
                        var collectButton = document.getElementById('collectButton');
                        collectButton.setAttribute('data-book-id', bookId);
                    });
                });
            });
        </script> -->





        <!-- jQuery -->
        <script>
            going_to_pickup = document.getElementsByClassName('going_to');
            Array.from(going_to_pickup).forEach((element) => {
                element.addEventListener("click", (e) => {
                    book_id = e.target.id.substr(1);

                    if (confirm("Are you sure you want to go for this pick up?")) {
                        console.log("yes");
                        window.location = `manage_book_donation?going_to=${book_id}`;

                    } else {
                        console.log("no");
                    }
                })
            })
        </script>


        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="plugins/jszip/jszip.min.js"></script>
        <script src="plugins/pdfmake/pdfmake.min.js"></script>
        <script src="plugins/pdfmake/vfs_fonts.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <script>
            // Function to show user details in modal
            function showBookDetails(name, phone, email, title, author, course, description, street, city,
                zip_code) {
                // Prepare the user details HTML
                var bookDetailsHtml = "<h2>Donation Details</h2>" +
                    "<p><strong>Donor Name:</strong> " + name + "</p>" +
                    "<p><strong>Donor Phone:</strong> " + phone + "</p>" +
                    "<p><strong>Donor Email:</strong> " + email + "</p>" +
                    "<p><strong>Book Title:</strong> " + title + "</p>" +
                    "<p><strong>Book Author:</strong> " + author + "</p>" +
                    "<p><strong>Book Course:</strong> " + course + "</p>" +
                    "<p><strong>Book Description:</strong> " + description + "</p>" +
                    "<p><strong>Address:</strong> " + street + "," + city + "," + zip_code + "</p>";

                // Display the user details in the modal
                document.getElementById("bookDetails").innerHTML = bookDetailsHtml;

                // Show the modal
                document.getElementById("bookModal").style.display = "block";
            }

            // Close the modal when the close button is clicked
            document.getElementsByClassName("close")[0].onclick = function() {
                document.getElementById("bookModal").style.display = "none";
            }

            // Close the modal when the user clicks outside of it
            window.onclick = function(event) {
                if (event.target == document.getElementById("bookModal")) {
                    document.getElementById("bookModal").style.display = "none";
                }
            }
        </script>
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 D_J_Patel</a>.</strong> All rights
            reserved.
        </footer>

</body>

</html>