<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes - Manage FoodDonation</title>

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
        $food_id = $_GET['delete'];
        $sql = "DELETE FROM `donate_food` WHERE `food_id` = $food_id";
        $result = mysqli_query($conn, $sql);
        $delete = true;
    }
    if (isset($_GET["collect"])) {
        $food_id = $_GET["collect"];
        $sql = "UPDATE `donate_food` SET `status` = 'collected' WHERE `donate_food`.`food_id` = $food_id;";
        $result = mysqli_query($conn, $sql);
        $collect = true;
    }

    if ($delete) {
        echo '<div id="deleteToast" class="toast align-items-center text-bg-danger border-0 position-fixed top-0 end-0 m-4" role="alert" aria-live="assertive" aria-atomic="true" style="margin-top: 15px; z-index: 1000000;">
        <div class="toast-body">
            Record deleted successfully!
        </div>
        </div>';
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
                            <h1>Food Donations</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active">Manage FoodDonation</li>
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
                                    <table  class="table table-bordered  text-center table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Donor Name</th>
                                                <th>Mobile No.</th>
                                                <th>Pickup Address</th>
                                                <th>Food Specification</th>
                                                <th>Food Type</th>
                                                <th>Picked Up</th>
                                                <th>Cancle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('config/db_connection.php');
                                            require_once('encrypt_decrypt.php');
                                            $i = 0;
                                            $sql23 = "SELECT * FROM `approved_food_req` WHERE `status`='going_to' ORDER BY `food_id`  ASC LIMIT 1";
                                            $result23 = $conn->query($sql23);
                                            if ($result23->num_rows > 0) {
                                                while ($row23 = mysqli_fetch_array($result23)) {
                                                    // Output data of each row
                                                    echo '<tr class="fooddetails">';
                                                    $user_id23 = $row23['user_id'];
                                                    $e_u_id23 = encrypt_number(32, $row23['user_id']);

                                                    $food_id23 = encrypt_number(32, $row23['food_id']);
                                                    $i++;
                                                    $sql33 = "SELECT * FROM user_login WHERE `user_login`.`user_id` = $user_id23 ";
                                                    $result33 = $conn->query($sql33);
                                                    $row33 = mysqli_fetch_array($result33);

                                                    echo '    <th class="name">' . $i . '</th>';
                                                    echo '    <td class="name">' . $row33['name'] . '</td>';
                                                    echo '    <td class="phone">' . $row33['phone'] . '</td>';
                                                    echo '    <td class="pickup_street">' . $row23['pickup_street'] . ',' . $row23['pickup_city'] . ',' . $row23['pickup_zip_code'] . '</td>';
                                                    echo '    <td class="specifications">' . $row23['specifications'] . '</td>';
                                                    echo '    <td class="food_type">' . $row23['food_type'] . '</td>';

                                                    echo '<td><form method="POST" action="controller/pickedup"><input type="hidden" name="f_id" value=" ' . $food_id23 . '"><input type="hidden" name="u_id" value=" ' .$e_u_id23 . '"><input type="submit" name="pickedupbtn" value="Picked Up"></td>';
                                                    echo '<td><form method="POST" action="controller/pickedup"><input type="hidden" name="f_id" value=" ' . $food_id23 . '"><input type="hidden" name="u_id" value=" ' .$e_u_id23 . '"><input type="submit" name="cancel" value="Cancel"></td>';
                                                    echo '</tr>';
                                                }
                                            } else {
                                                echo '<tr><td colspan="5">No record found</td></tr>';
                                            }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <!-- ############################### -->
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered  text-center table-striped">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>No.</th>
                                                <th>Donor Name</th>
                                                <th>Food</th>
                                                <th>Pickup Address</th>
                                                <th>Food Specification</th>
                                                <th>Food Type</th>
                                                <th>Going to Pick Up</th>

                                            </tr>
                                        </thead>
                                        <?php
                                        require('config/db_connection.php');
                                        $int = 1;
                                        $query = "SELECT * FROM `approved_food_req` WHERE DATE(`time`) <= CURDATE() AND `v_id`='$v_id' AND `status`='approved' ORDER BY `food_id` ASC ";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $u_id = $row['user_id'];
                                            $food_id = encrypt_number(32, $row['food_id']);
                                            $user_id = encrypt_number(32, $row['user_id']);

                                            $sql3 = "SELECT * FROM `user_login` WHERE `user_login`.`user_id` = '$u_id' ";
                                            $result3 = $conn->query($sql3);
                                            $row3 = mysqli_fetch_array($result3);

                                            $i = $int++ ?>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"><?php echo $i; ?></th>
                                                    <td><?php echo  $row3['name']; ?></td>
                                                    <td><?php echo $row3['phone']; ?></td>
                                                    <td><?php echo $row['pickup_street']; ?>,<?php echo $row['pickup_city']; ?>,<?php echo  $row['pickup_zip_code']; ?></td>
                                                    <td><?php echo $row['specifications']; ?></td>
                                                    <td><?php echo $row['food_type']; ?></td>
                                                    <td>

                                                        <form method="POST" action="controller/pickedup">
                                                            <input type="submit" class="center btn btn-sm btn-success" name="goingto" value="Going to PickUp">
                                                            <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                                                            <input type="hidden" name="user_id" value=" <?php echo $user_id; ?>">
                                                        </form>
                                                    </td>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        <?php } ?>
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
                    food_id = e.target.id.substr(1);

                    if (confirm("Are you sure you want to delete this user?")) {
                        console.log("yes");
                        window.location = `manage_food_donation?delete=${food_id}`;

                    } else {
                        console.log("no");
                    }
                })
            })
        </script>
        <script>
            collects = document.getElementsByClassName('collect');
            Array.from(collects).forEach((element) => {
                element.addEventListener("click", (e) => {
                    food_id = e.target.id.substr(1);

                    if (confirm("Are you sure you want to collect this donation?")) {
                        console.log("yes");
                        window.location = `manage_food_donation?collect=${food_id}`;

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
            <strong>Copyright &copy; 2024 D_J_Patel</a>.</strong> All rights
            reserved.
        </footer>

</body>

</html>