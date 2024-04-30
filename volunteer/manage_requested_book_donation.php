<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes -Requested Book Donations</title>

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
    require "../connection.php";
    require("encrypt_decrypt.php");
    $update = false;
    $delete = false;
    $collect = false;
    if (isset($_GET['delete'])) {
        $aabr_id = $_GET['delete'];

        $sql6 = "SELECT * FROM `approved_applied_book_req` WHERE `aabr_id`='$aabr_id'";
        $result6 = mysqli_query($conn, $sql6);
        $row6 = mysqli_fetch_array($result6);
        $user_id = $row6['user_id'];
        $ISBN_No = $row6['ISBN_No'];
        $ab_id = $row6['ab_id'];

        $sql7 = "DELETE FROM `approved_applied_book_req`  WHERE `approved_applied_book_req`.`aabr_id` = $aabr_id";
        $result7 = mysqli_query($conn, $sql7);
        echo "Record deleted successfully from `approved_applied_book_req =>";

        $sql9 = "UPDATE `user_book_applied_record` SET `user_book_applied_record`.`req_book_quantity` = `req_book_quantity` - 1 WHERE `user_book_applied_record`.`user_id`= $user_id ";
        $result9 = mysqli_query($conn, $sql9);
        echo 'req_book_quantity updated into user_book_applied_record=>';

        $sql7 = "UPDATE `available_books` SET `available_books`.`book_quantity` = `book_quantity` + 1  WHERE`available_books`.`ISBN_No`='$ISBN_No' ";
        $result7 = mysqli_query($conn, $sql7);
        echo 'book_quantity updated into available_books=>';


        $sql = "UPDATE `applied_book` SET `status` = 'pickupfailed' WHERE  `applied_book`.`ab_id` = $ab_id;";
        $result = mysqli_query($conn, $sql);
        echo "status updated into applied_book=>";

        $delete = true;

        header('location:manage_requested_book_donation');
    }
    if (isset($_GET["deliver"])) {
        $aabr_id = $_GET["deliver"];
        echo $aabr_id . '=>';

        $sql6 = "SELECT * FROM `approved_applied_book_req` WHERE `aabr_id`='$aabr_id'";
        $result6 = mysqli_query($conn, $sql6);
        $row6 = mysqli_fetch_array($result6);
        $user_id = $row6['user_id'];
        echo $user_id . '=>';
        $ISBN_No = $row6['ISBN_No'];
        echo $ISBN_No . '=>';
        $ab_id = $row6['ab_id'];
        echo $ab_id . '=>';

        // Get the current date
        $currentDate = new DateTime();

        // Add 6 months
        $currentDate->add(new DateInterval('P6M'));

        // Format the date as needed
        $deadline_date = $currentDate->format('Y-m-d');

        echo $deadline_date .'=>';

        $sql = "INSERT INTO `delivered_book`(`user_id`,`v_id`, `ISBN_No`, `deadline_for_book`) VALUES ('$user_id','$v_id','$ISBN_No','$deadline_date')";
        $result = mysqli_query($conn, $sql);
        echo "insert into `delivered_book` successfully =>";

        $sql9 = " UPDATE `applied_book` SET `status`='delivered' WHERE `ab_id` = '$ab_id'";
        $result9 = mysqli_query($conn, $sql9);
        echo "status updated as delivered into applied_book=>";

        $sql7 = "DELETE FROM `approved_applied_book_req`  WHERE `approved_applied_book_req`.`aabr_id` = $aabr_id";
        $result7 = mysqli_query($conn, $sql7);
        echo "Record deleted successfully from `approved_applied_book_req =>";

        include("book_delivered_mail.php");
        echo "mail sent successfully=>";

        header('location:manage_requested_book_donation');
    }
    if (isset($_GET["going_to"])) {
        $aabr_id = decrypt_number(32,$_GET["going_to"]) ;
        // echo $aabr_id;

        $sql4 = "SELECT * FROM `approved_applied_book_req` WHERE `status`='out_for_deliver'";
        $result4 = mysqli_query($conn, $sql4);
        if ($result4->num_rows > 0) {

            echo' <script> if (confirm("You must have to pickedup first previously selected donation.")) {
                console.log("yes");
                window.location = `manage_requested_book_donation`;

            } else {
                console.log("no");
            }</script>';

        } else {

            $sql6 = "SELECT * FROM `approved_applied_book_req` WHERE `aabr_id`='$aabr_id'";
            $result6 = mysqli_query($conn, $sql6);
            $row6 = mysqli_fetch_array($result6);
            $user_id = $row6['user_id'];
            $ISBN_No = $row6['ISBN_No'];
            $ab_id = $row6['ab_id'];


            $sql = "UPDATE `applied_book` SET `status` = 'out_for_deliver' WHERE `applied_book`.`ab_id` = '$ab_id'; ";
            $result = mysqli_query($conn, $sql);
            echo 'status updated into applied_book=>';

            $sql = "UPDATE `approved_applied_book_req` SET `status` = 'out_for_deliver' WHERE `approved_applied_book_req`.`aabr_id` = $aabr_id;";
            $result = mysqli_query($conn, $sql);
            echo 'status updated into approved_applied_book_req=>';

            // require('goingtodeliver.php');

            $going_to = true;
            header('location:manage_requested_book_donation');
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
                            <h1>Requested Book Donations</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active">Manage Requested Book</li>
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
                                    <table class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Requested By</th>
                                                <th>Phone Number</th>
                                                <th>Book Title</th>
                                                <th>Book ISBN No.</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $sql = "SELECT * FROM `approved_applied_book_req` where `status`='out_for_deliver' AND `v_id`=$v_id LIMIT 1";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $ISBN_No = $row['ISBN_No'];
                                                $aabr_id = $row['aabr_id'];

                                                $sql5 = "SELECT * FROM `book_record` where `ISBN_No`='$ISBN_No'";
                                                $result5 = mysqli_query($conn, $sql5);
                                                $row5 = mysqli_fetch_assoc($result5);

                                                $i = $i + 1;
                                                $user_id = $row['user_id'];
                                                $sql2 = "SELECT * FROM `user_login` where `user_id`='$user_id'";
                                                $result2 = mysqli_query($conn, $sql2);
                                                $row2 = mysqli_fetch_assoc($result2);
                                                echo "<tr>
                                            <td>" . $i . "</td>
                                            <td>" . ucfirst($row2['name']) . "</td>
                                            <td>" . $row2['phone'] . "</td>
                                            <td>" . $row5['title'] . "</td>
                                            <td>" . $row5['ISBN_No'] . "</td>
                     
                                            <td>

                                            <button class='deliver center btn btn-sm btn-success' id='d" . $aabr_id . "'>Delivered</button>
                                            <button class='delete center btn btn-sm btn-danger' id='d" .  $aabr_id  . "'>Delete</button>
                                           
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
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Requested By</th>
                                                <th>Phone Number</th>
                                                <th>Book Title</th>
                                                <th>Book ISBN No.</th>
                                                <!-- <th>Status</th> -->
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $sql = "SELECT * FROM `approved_applied_book_req` where `status`='approved' AND `v_id`=$v_id";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $ISBN_No = $row['ISBN_No'];
                                                $aabr_id = $row['aabr_id'];
                                                $aabr_id_e = encrypt_number(32,$row['aabr_id']);

                                                $sql5 = "SELECT * FROM `book_record` where `ISBN_No`='$ISBN_No'";
                                                $result5 = mysqli_query($conn, $sql5);
                                                $row5 = mysqli_fetch_assoc($result5);

                                                $i = $i + 1;
                                                $user_id = $row['user_id'];
                                                $sql2 = "SELECT * FROM `user_login` where `user_id`='$user_id'";
                                                $result2 = mysqli_query($conn, $sql2);
                                                $row2 = mysqli_fetch_assoc($result2);
                                                echo "<tr class='details'>
                                            <td>" . $i . "</td>
                                            <td>" . ucfirst($row2['name']) . "</td>
                                            <td>" . $row2['phone'] . "</td>
                                            <td>" . $row5['title'] . "</td>
                                            <td>" . $row5['ISBN_No'] . "</td>
                                            <td>
                                            <button class='going_to center btn btn-sm btn-success' id='d" .  $aabr_id_e . "'>Going To Pickup</button>
                                            
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
                    aabr_id = e.target.id.substr(1);

                    if (confirm("Are you sure you want to delete this user?")) {
                        console.log("yes");
                        window.location = `manage_requested_book_donation?delete=${aabr_id}`;

                    } else {
                        console.log("no");
                    }
                })
            })
        </script>

        <script>
            deliver = document.getElementsByClassName('deliver');
            Array.from(deliver).forEach((element) => {
                element.addEventListener("click", (e) => {
                    aabr_id = e.target.id.substr(1);

                    if (confirm("Book delivered successfully?")) {
                        console.log("yes");
                        window.location = `manage_requested_book_donation?deliver=${aabr_id}`;

                    } else {
                        console.log("no");
                    }
                })
            })
        </script>

        <script>
            going_to_pickup = document.getElementsByClassName('going_to');
            Array.from(going_to_pickup).forEach((element) => {
                element.addEventListener("click", (e) => {
                    aabr_id = e.target.id.substr(1);

                    if (confirm("Are you sure you want to go for this pick up?")) {
                        console.log("yes");
                        window.location = `manage_requested_book_donation?going_to=${aabr_id}`;

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
        <!-- <script>
            // Function to show user details in modal
            function showBookDetails(aabr_id, name, phone, email, gender, title, author, course, description, street, city,
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
        </script> -->
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