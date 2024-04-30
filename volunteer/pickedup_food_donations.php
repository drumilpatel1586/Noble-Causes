<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes - Pickedup FoodDonation</title>

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
        .deliveredall{
            display: flex !important;
            flex-direction: row;
            justify-content: space-around !important;
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
                            <h1>Picked Up Food Donations</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active">Picked Up Food Donations</li>
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
                                    <table class="table table-bordered text-center table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Food Name</th>
                                                <th>Food Validity</th>
                                                <th>Status</th>
                                                <th class="deliveredall">Delivered To Warehouse <form method='POST' action='controller/delivered'><input type='hidden' name='food_id' ><input type='submit' name='deliveredall' value='Delivered All'></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include "../connection.php";
                                            include "encrypt_decrypt.php";
                                            $i = 0;

                                            $todayDate = date('Y-m-d');

                                            $query = "SELECT * FROM `pickedup_food` WHERE DATE(`pickedup_time`) = '$todayDate' AND `v_id`='$v_id' AND `status`='picked_up' ORDER BY `food_id` ASC";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $food_id23 = encrypt_number(32, $row['food_id']);
                                                // $food_id23 = $row['food_id'];
                                                // $e_u_id23 = $row['user_id'];
                                                $i = $i + 1;
                                                echo "<tr>
                                            <td>" . $i . "</td>
                                            <td>" . $row['food_type'] . "</td>
                                            <td>" . $row['validity'] . "</td>
                                            <td>" . $row['status'] . "</td>
                                            <td> <form method='POST' action='controller/delivered'><input type='hidden' name='food_id' value=' " . $food_id23 . "'><input type='submit' name='delivered' value='Delivered'>  </td>
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
            <div id="foodModal" class="modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div id="foodDetails"></div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

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
            function showFoodDetails(food_id, name, phone, email, gender, foodname, validity, freq_of_donation, food_type,
                specifications, street, city,
                zip_code) {
                // Prepare the user details HTML
                var foodDetailsHtml = "<h2>Donation Details</h2>" +
                    "<p><strong>No:</strong> " + food_id + "</p>" +
                    "<p><strong>Donor Name:</strong> " + name + "</p>" +
                    "<p><strong>Donor Phone:</strong> " + phone + "</p>" +
                    "<p><strong>Donor Email:</strong> " + email + "</p>" +
                    "<p><strong>Donor Gender:</strong> " + gender + "</p>" +
                    "<p><strong>Food Name:</strong> " + foodname + "</p>" +
                    "<p><strong>Food Validity:</strong> " + validity + "</p>" +
                    "<p><strong>Frequency Donation:</strong> " + freq_of_donation + "</p>" +
                    "<p><strong>Food Type:</strong> " + food_type + "</p>" +
                    "<p><strong>Specifications:</strong> " + specifications + "</p>" +
                    "<p><strong>Address:</strong> " + street + "," + city + "," + zip_code + "</p>";

                // Display the user details in the modal
                document.getElementById("foodDetails").innerHTML = foodDetailsHtml;

                // Show the modal
                document.getElementById("foodModal").style.display = "block";
            }

            // Close the modal when the close button is clicked
            document.getElementsByClassName("close")[0].onclick = function() {
                document.getElementById("foodModal").style.display = "none";
            }

            // Close the modal when the user clicks outside of it
            window.onclick = function(event) {
                if (event.target == document.getElementById("foodModal")) {
                    document.getElementById("foodModal").style.display = "none";
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
            <strong>Copyright &copy; 2024 <a href="https://adminlte.io">D_J_Patel</a>.</strong> All rights
            reserved.
        </footer>

</body>

</html>