<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes - Manage Requested Book Pickup</title>

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
        $delivered_id = $_GET['delete'];

        $sql6 = "SELECT * FROM `delivered_book` WHERE `delivered_id`='$delivered_id'";
        $result6 = mysqli_query($conn, $sql6);
        $row6 = mysqli_fetch_array($result6);
        $user_id = $row6['user_id'];
        $ISBN_No = $row6['ISBN_No'];

        $sql = "UPDATE `delivered_book` SET `status` = 'pickupfailed' WHERE  `delivered_book`.`delivered_id` = $delivered_id;";
        $result = mysqli_query($conn, $sql);
        echo "status updated as  successfully from `delivered_book`";

        $delete = true;

        header('location:manage_requested_book_pickup');
    }
    if (isset($_GET["pickup"])) {
        $delivered_id = $_GET["pickup"];
        echo $delivered_id . '=>';

        $sql6 = "SELECT * FROM `delivered_book` WHERE `delivered_id`='$delivered_id'";
        $result6 = mysqli_query($conn, $sql6);
        $row6 = mysqli_fetch_array($result6);
        $user_id = $row6['user_id'];
        echo $user_id . '=>';
        $ISBN_No = $row6['ISBN_No'];
        echo $ISBN_No . '=>';

        $sql9 = " UPDATE `available_books` SET  `available_books`.`book_quantity`=`book_quantity` + 1 WHERE `ISBN_No` = '$ISBN_No'";
        $result9 = mysqli_query($conn, $sql9);
        echo "book quantity updated";

        $sql10 = "UPDATE `user_book_applied_record` SET `user_book_applied_record`.`req_book_quantity` = `req_book_quantity` - 1 WHERE `user_book_applied_record`.`user_id`= $user_id ";
        $result10 = mysqli_query($conn, $sql10);

        $sql7 = "DELETE FROM `delivered_book`  WHERE `delivered_book`.`delivered_id` = $delivered_id";
        $result7 = mysqli_query($conn, $sql7);
        echo "Record deleted successfully from `delivered_book =>";

        header('location:manage_requested_book_pickup');
    }
    if (isset($_GET["going_to"])) {
        $delivered_id =  $_GET["going_to"];
        echo $delivered_id;

        $sql4 = "SELECT * FROM `delivered_book` WHERE `status`='out_for_deliver'";
        $result4 = mysqli_query($conn, $sql4);
        if ($result4->num_rows > 0) {

            $err = "You must have to pickedup first previously selected donation";
            echo '<script>alert("' . $err . '")</script>';
        } else {

            $sql = "UPDATE `delivered_book` SET `status` = 'out_for_deliver' WHERE `delivered_book`.`delivered_id` = '$delivered_id'";
            $result = mysqli_query($conn, $sql);
            echo 'status updated into delivered_book=>';

            require('goingtodeliver.php');
            echo "mail sent successfully=>";

            $going_to = true;
            header('location:manage_requested_book_pickup');
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
                            <h1>Requested Book Pickup</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active">Manage Requested Book Pickup</li>
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
                                                <th>User Name</th>
                                                <th>Phone Number</th>
                                                <th>Book Title</th>
                                                <th>Book ISBN No.</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $sql = "SELECT * FROM `delivered_book` where `status`='out_for_deliver' AND `v_id`=$v_id LIMIT 1";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $ISBN_No = $row['ISBN_No'];
                                                $delivered_id = $row['delivered_id'];

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

                                            <button class='pickup center btn btn-sm btn-success' id='d" . $delivered_id . "'>Picked Up</button>
                                            <button class='delete center btn btn-sm btn-danger' id='d" .  $delivered_id  . "'>Delete</button>
                                           
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
                                                <th>User Name</th>
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
                                            $sql = "SELECT * FROM `delivered_book` where `status`='delivered' AND `v_id`=$v_id AND DATE(`deadline_for_book`) <= CURDATE() AND `v_id`='$v_id'";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $ISBN_No = $row['ISBN_No'];
                                                $delivered_id = $row['delivered_id'];

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
                                            <button class='going_to center btn btn-sm btn-success' id='d" .  $delivered_id . "'>Going To Pickup</button>
                                            
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
                    delivered_id = e.target.id.substr(1);

                    if (confirm("Are you sure you want to delete this user?")) {
                        console.log("yes");
                        window.location = `manage_requested_book_pickup?delete=${delivered_id}`;

                    } else {
                        console.log("no");
                    }
                })
            })
        </script>

        <script>
            pickup = document.getElementsByClassName('pickup');
            Array.from(pickup).forEach((element) => {
                element.addEventListener("click", (e) => {
                    delivered_id = e.target.id.substr(1);

                    if (confirm("Book delivered successfully?")) {
                        console.log("yes");
                        window.location = `manage_requested_book_pickup?pickup=${delivered_id}`;

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
                    delivered_id = e.target.id.substr(1);

                    if (confirm("Are you sure you want to go for this pick up?")) {
                        console.log("yes");
                        window.location = `manage_requested_book_pickup?going_to=${delivered_id}`;

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