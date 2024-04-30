<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Manager - Food Verification</title>

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
    <style>
        .verifiedall {
            display: flex !important;
            flex-direction: row;
            justify-content: space-around !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <?php
    ob_start();
    session_start();
    if (isset($_SESSION['m_loggedin']) && $_SESSION['m_loggedin'] == true) {
        $v_id = $_SESSION['m_id'];
        require_once('encrypt_decrypt.php');
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
                            <h1>Todays Picked Up Food</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active">Manage Todays Picked Up Food</li>
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
                                                <th>Food Specifications</th>
                                                <th>Food Type</th>
                                                <th>Food Validity</th>
                                                <th class="verifiedall">Verified </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include "../connection.php";
                                            $sql = "SELECT rf.food_id, df.specifications, df.food_type, rf.validity FROM reached_food rf INNER JOIN donate_food df ON rf.food_id = df.food_id";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            $int = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $food_id = $row['food_id'];
                                                $e_food_id = encrypt_number(32,$food_id);
                                                $specifications = $row['specifications'];
                                                $food_type = $row['food_type'];
                                                $validity = $row['validity'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $int; ?></td>
                                                    <td><?php echo $specifications; ?></td>
                                                    <td><?php echo $food_type; ?></td>
                                                    <td><?php echo $validity; ?></td>
                                                    <td>
                                                        <form method='POST' action='controller/verified'>
                                                            <input type='hidden' name='food_id' value='<?php echo htmlspecialchars($e_food_id); ?>'>
                                                            <button type='submit' name='verified' class='btn btn-primary'>Verify</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php
                                                $int++;
                                            }
                                            $stmt->close();
                                            $conn->close();
                                            ?>
                                        </tbody>
                                    </table>


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

</body>

</html>