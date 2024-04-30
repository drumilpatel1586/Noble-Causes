<?php
ob_start();
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
    <title>Volunteer - Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
        .dbox--color-2 {
            background: rgb(252, 190, 27);
            background: -moz-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
            background: -webkit-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
            background: linear-gradient(to bottom, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#fcbe1b', endColorstr='#f85648', GradientType=0);
        }

        .dbox--color-2 .dbox__icon:after {
            background: #fee036;
            background: rgba(254, 224, 54, 0.81);
        }

        .dbox--color-2 .dbox__icon:before {
            background: #fee036;
            background: rgba(254, 224, 54, 0.64);
        }

        .dbox--color-2 .dbox__icon>i {
            background: #fb9f28;
        }

        .dbox--color-3 {
            background: rgb(183, 71, 247);
            background: -moz-linear-gradient(top, rgba(183, 71, 247, 1) 0%, rgb(83, 195, 220) 100%);
            background: -webkit-linear-gradient(top, rgba(183, 71, 247, 1) 0%, rgb(83, 186, 220) 100%);
            background: linear-gradient(to bottom, rgba(183, 71, 247, 1) 0%, rgb(83, 179, 220) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b747f7', endColorstr='#6c53dc', GradientType=0);
        }

        .dbox--color-3 .dbox__icon:after {
            background: #b446f5;
            background: rgba(180, 70, 245, 0.76);
        }

        .dbox--color-3 .dbox__icon:before {
            background: #e284ff;
            background: rgba(226, 132, 255, 0.66);
        }

        .dbox--color-3 .dbox__icon>i {
            background: #8150e4;
        }

        .dbox--color-4 {
            background: rgb(71, 232, 247);
            background: -moz-linear-gradient(top, rgb(71, 235, 247) 0%, rgb(83, 88, 220) 100%);
            background: -webkit-linear-gradient(top, rgb(71, 241, 247) 0%, rgb(83, 83, 220) 100%);
            background: linear-gradient(to bottom, rgb(71, 229, 247) 0%, rgb(83, 104, 220) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b747f7', endColorstr='#6c53dc', GradientType=0);
        }

        .dbox--color-4 .dbox__icon:after {
            background: #46dbf5;
            background: rgba(70, 219, 245, 0.76);
        }

        .dbox--color-4 .dbox__icon:before {
            background: #84ccff;
            background: rgba(132, 255, 255, 0.66);
        }

        .dbox--color-4 .dbox__icon>i {
            background: #50b8e4;
        }

        .dbox--color-5 {
            background: rgb(232, 247, 71);
            background: -moz-linear-gradient(top, rgb(200, 247, 71) 0%, rgb(245, 149, 31) 100%);
            background: -webkit-linear-gradient(top, rgb(241, 247, 71) 0%, rgb(255, 194, 26) 100%);
            background: linear-gradient(to bottom, rgb(229, 247, 71) 0%, rgb(242, 129, 15) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b747f7', endColorstr='#6c53dc', GradientType=0);
        }

        .dbox--color-5 .dbox__icon:after {
            background: #ffcb77;
            background: rgb(255, 185, 35);
        }

        .dbox--color-5 .dbox__icon:before {
            background: #ffde84;
            background: rgb(240, 208, 139);
        }

        .dbox--color-5 .dbox__icon>i {
            background: #e4b550;
        }

        .box-g {
            display: flex;
            flex-direction: row;
            margin-top: -20px;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include("navbar.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">Home</li>

                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
        
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box dbox--color-2">
                                <div class="inner">
                                    <h1 style="color:aliceblue"><b>
                                            <?php
                                            include("../connection.php");
                                            $query = "SELECT COUNT(*) AS total_entries FROM approved_book_req  where `approved_book_req`.`status`='approved' AND `approved_book_req`.`v_id`= '$v_id'";
                                            $result = $conn->query($query);

                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                echo $row['total_entries'];
                                            } else {
                                                echo "0";
                                            }

                                            $conn->close();
                                            ?>
                                        </b>
                                    </h1>

                                    <p style="color:aliceblue"><b>Remaining Book Donations</b></p>
                                </div>
                                <div class="icon">
                                    <i class="ionicons ion-ios-book-outline"></i>
                                </div>
                                <a href="manage_book_donation" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box dbox--color-4">
                                <div class="inner">
                                    <h1 style="color:aliceblue"><b>
                                            <?php
                                            include("../connection.php");
                                            $query = "SELECT COUNT(*) AS total_entries FROM approved_food_req  where `approved_food_req`.`status`='approved' AND `approved_food_req`.`v_id`= '$v_id' AND DATE(`time`) <= CURDATE() AND `v_id`='$v_id'";
                                            $result = $conn->query($query);

                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                echo $row['total_entries'];
                                            } else {
                                                echo "0";
                                            }


                                            $conn->close();
                                            ?>
                                        </b>
                                    </h1>

                                    <p style="color:aliceblue"><b>Remaining Food Donations</b></p>
                                </div>
                                <div class="icon">
                                    <i class="ionicons ion-android-restaurant"></i>
                                </div>
                                <a href="manage_food_donation" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box dbox--color-5">
                                <div class="inner">
                                    <h1 style="color:aliceblue"><b>
                                            <?php
                                            include("../connection.php");
                                            $query = "SELECT COUNT(*) AS total_entries FROM approved_applied_book_req  where `approved_applied_book_req`.`status`='approved' AND `approved_applied_book_req`.`v_id`= '$v_id'";
                                            $result = $conn->query($query);

                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                echo $row['total_entries'];
                                            } else {
                                                echo "0";
                                            }

                                            $conn->close();
                                            ?>
                                        </b>
                                    </h1>

                                    <p style="color:aliceblue"><b>Remaining Req Book Delivery</b></p>
                                </div>
                                <div class="icon">
                                    <i class="ionicons ion-ios-book-outline"></i>
                                </div>
                                <a href="manage_requested_book_donation" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box dbox--color-3">
                                <div class="inner">
                                    <h1 style="color:aliceblue"><b>
                                            <?php
                                            include("../connection.php");
                                            $query = "SELECT COUNT(*) AS total_entries FROM delivered_book  where `delivered_book`.`v_id`= '$v_id' AND DATE(`deadline_for_book`) <= CURDATE()";
                                            $result = $conn->query($query);

                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                echo $row['total_entries'];
                                            } else {
                                                echo "0";
                                            }


                                            $conn->close();
                                            ?>
                                        </b>
                                    </h1>

                                    <p style="color:aliceblue"><b>Remaining Req Book Pick Up</b></p>
                                </div>
                                <div class="icon">
                                    <i class="ionicons ion-ios-book-outline"></i>
                                </div>
                                <a href="manage_requested_book_pickup" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>



                    </div>
                </div>




                <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="index">D_J_Patel</a>.</strong> All rights
            reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
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
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
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