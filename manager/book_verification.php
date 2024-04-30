<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Manager - Book Verification</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="modal.css">
</head>

<body class="hold-transition sidebar-mini">
    <?php
    ob_start();
    session_start();
    if (isset($_SESSION['m_loggedin']) && $_SESSION['m_loggedin'] == true) {
        $v_id = $_SESSION['m_id'];
    } else {
        header("Location: manager_login");
        include "../connection.php";
    } ?>




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
                            <h1>Todays Picked Up Book</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active">Manage Todays Picked Up Book</li>
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Book Title</th>
                                                <th>Book Author</th>
                                                <th>Book Quantity</th>
                                                <th>Book Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include "../connection.php";
                                            $i = 0;
                                            $currentDate = date('Y-m-d'); // Format: Year-Month-Day
                                            $sql = "SELECT * FROM `pickedup_book` WHERE pickedup_book.pickedup_date = '$currentDate'";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $i = $i + 1;
                                                echo "<tr>
                                                <td>" . $i . "</td>
                                                <td>" . ucfirst($row['title']) . "</td>
                                                <td>" . $row['author'] . "</td>
                                                <td>" . $row['book_quantity'] . "</td>
                                                <td>" . $row['description'] . "</td>
                                                <td>
                                                
                                                <button class='view btn btn-sm btn-info' onclick='showUserDetails(\"" . $i . "\", \"" . ucfirst($row['title']) . "\", \"" . $row['author'] . "\", \"" . $row['course'] . "\",\"" . $row['sub_course'] . "\",\"" . $row['book_quantity'] . "\")'>View</button> 
                                                
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
            <!-- /.content -->
        </div>



        <div id="userModal" class="modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="userDetails"></div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="https://adminlte.io">D_J_Patel</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script>
        // Function to show user details in modal
        function showUserDetails(title, author, course, sub_course, description, book_quantity) {
            // Prepare the user details HTML
            var userDetailsHtml = "<h2>Book Details</h2>" +
                "<p><strong>Book Title:</strong> " + title + "</p>" +
                "<p><strong>Book Author:</strong> " + author + "</p>" +
                "<p><strong>Book Course:</strong> " + course + "</p>" +
                "<p><strong>Book Sub Course:</strong> " + sub_course + "</p>" +
                "<p><strong>Description:</strong> " + description + "</p>" +
                "<p><strong>Total Quantity:</strong> " + book_quantity + "</p>";

            // Display the user details in the modal
            document.getElementById("userDetails").innerHTML = userDetailsHtml;

            // Show the modal
            document.getElementById("userModal").style.display = "block";
        }

        // Close the modal when the close button is clicked
        document.getElementsByClassName("close")[0].onclick = function() {
            document.getElementById("userModal").style.display = "none";
        }

        // Close the modal when the user clicks outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById("userModal")) {
                document.getElementById("userModal").style.display = "none";
            }
        }
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
    <!-- Page specific script -->
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
</body>

</html>