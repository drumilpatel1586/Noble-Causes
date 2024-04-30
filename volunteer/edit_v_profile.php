<?php
  session_start();
  if (isset($_SESSION['v_loggedin']) && $_SESSION['v_loggedin'] == true) {
    $v_id = $_SESSION['v_id'];
  } else {
    header("Location: volunteer_login");    
  } ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes - Edit Profile</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <style>
    .editbtn {
        justify-items: center;
        text-align: center;
    }

    .editbtn {
        background-color: #3e8da8;
        color: aliceblue;
        border: none;
        border-radius: 3px;
        height: 35px;
    }

    .editbtn:hover {
        background-color: #55abc8;
        color: aliceblue;
    }
    </style>
</head>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include ("navbar.php"); ?>

        <!-- Navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Change Your Details</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active">Edit Profile</li>
                            </ol>
                        </div><!-- /.col -->

                    </div>
                    <!-- /.content-header -->

                    <?php
                    // Start output buffering
                    
                    require '../connection.php';
                    $update = false;
                    $v_id = $_SESSION['v_id'];
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $v_name = mysqli_real_escape_string($conn, $_POST['nameEdit']);
                        $v_email = mysqli_real_escape_string($conn, $_POST['emailEdit']);
                        $v_phone = mysqli_real_escape_string($conn, $_POST['phoneEdit']);
                        $v_street = mysqli_real_escape_string($conn, $_POST['streetEdit']);
                        $v_city = mysqli_real_escape_string($conn, $_POST['cityEdit']);
                        $v_zip = mysqli_real_escape_string($conn, $_POST['zip_codeEdit']);
                        $sql = "UPDATE `volunteers` SET `v_name` = '$v_name', `v_phone` = '$v_phone', `v_email` = '$v_email', `v_street` = '$v_street', `v_city` = '$v_city', `v_zip` = '$v_zip' WHERE `volunteers`.`v_id` = $v_id;";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $update = true;
                            header("Location:v_profile");
                        } else {
                            echo "We are not able to update your profile";
                        }
                    }


                    $d_sql = "SELECT * FROM volunteers WHERE v_id='$v_id'";
                    $d_result = mysqli_query($conn, $d_sql);
                    while ($row = mysqli_fetch_assoc($d_result)) { ?>


                    <div class="profile-info col-md-12">
                        <div class="panel">
                            <div class="card col-md-12 my-4">

                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <h6>Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary"> <input type="text"
                                                    class="form-control" name="nameEdit"
                                                    value='<?php echo '' . $row['v_name'] . '' ?>'></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <h6>Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary"> <input type="text"
                                                    class="form-control" name="emailEdit"
                                                    value='<?php echo '' . $row['v_email'] . '' ?>'></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <h6>Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary"> <input type="text"
                                                    class="form-control" name="phoneEdit"
                                                    value='<?php echo '' . $row['v_phone'] . '' ?>'></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <h6>Street</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="streetEdit" class="form-control"
                                                    value='<?php echo '' . $row['v_street'] . '' ?>'>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <h6>City</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="cityEdit" class="form-control"
                                                    value='<?php echo '' . $row['v_city'] . '' ?>'>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <h6>Zip Code</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="zip_codeEdit" class="form-control"
                                                    value='<?php echo '' . $row['v_zip'] . '' ?>'>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 col-sm-3 mx-auto">
                                            <button class="editbtn col-sm-12" type="submit">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>




                <!-- /.content -->
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2024 D_J_Patel</a>.</strong> All rights
        reserved.
    </footer>


    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>