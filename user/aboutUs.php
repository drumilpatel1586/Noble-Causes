<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- fa icon link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

    <link rel="stylesheet" href="about.css?v=2">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes - About US</title>
</head>

<body>
    <?php
    session_start();

    ?>
    <div class="navb">
        <?php include ("navbar2.php"); ?>
    </div>


     <!-- FIRST SECTION -->
    
    <div class="container">
        <div class="firstdiv col-md-12">
                <?php
                require("../admin/config/db_connection.php");
                $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = '1'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) { ?>
                    <!-- <img src="../admin/NC_Images/<?php echo $row['au_image']; ?>"  alt="data can't able to load"> -->
                
                    <p class="text-center aboutUS" style="margin-top:80px"><?php echo $row['au_title']; ?></p>
                                   
                <?php } ?>
        </div>
    </div>

    <!-- Our MIssion Image -->
    <div class="container">
        <div class="row d-flex justify-content-center">
            <?php
                require("../admin/config/db_connection.php");
                $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = '2'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) { ?>
                <div class="aboutUsImg">
                    <img src="../admin/NC_Images/<?php echo $row['au_image']; ?>"  class="img-fluid rounded" alt="About Us Image">
                </div>
                    <!-- <p class="text-center aboutUS" style="margin-top:80px"><?php echo $row['au_title']; ?></p> -->
                                   
            <?php } ?>
        </div>
    </div>

    <!-- Our MIssion Description -->
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3 text-center">
            <?php
                require("../admin/config/db_connection.php");
                $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = '3'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) { ?>
                
                    <h2 class="mission mt-5"><?php echo $row['au_title']; ?></h2>
                    <p class="mb-3 col-md-12 mx-auto mt-4" style="text-align: justify !important;"><?php echo $row['au_description']; ?></p>
                                   
            <?php } ?>

            </div>
        </div>
    </div>


    <!-- **** New added ******-->
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body threeBox text-center py-5">
                            <div class="icon-container roundbox my-5">
                                <i class="fa-solid fa-bowl-food iconHover mt-3"></i>
                            </div>
                            <?php
                                require("../admin/config/db_connection.php");
                                $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = '4'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) { ?>
                
                                <h2><?php echo $row['au_title']; ?></h2>
                                <p class="card-text mt-4 mb-5" style="text-align: justify !important;"><?php echo $row['au_description']; ?></p>  
                                  
                            <div class="d-flex justify-content-center pb-2">
                                <button class="button btn btn-primary text-center" id="myButton">Know More</button>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                


                <div class="col-lg-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body threeBox2 text-center py-5">

                            <div class="icon-container roundbox2 my-5">
                                <i class="fa-solid fa-ribbon iconHover-2 mt-3"></i>
                            </div>
                            
                            <?php
                                require("../admin/config/db_connection.php");
                                $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = '5'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) { ?>
                
                                <h2><?php echo $row['au_title']; ?></h2>
                                <p class="card-text mt-4 mb-5" style="text-align: justify !important;"><?php echo $row['au_description']; ?></p>  
                                  
                                <div class="d-flex justify-content-center pb-2">
                                    <button class="button btn btn-primary text-center" id="myButton">Know More</button>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body threeBox text-center py-5">

                            <div class="icon-container roundbox my-5">
                                <i class="fa-solid fa-book-open iconHover  mt-3"></i>
                            </div>

                            <?php
                                require("../admin/config/db_connection.php");
                                $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = '6'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) { ?>
                
                                <h2><?php echo $row['au_title']; ?></h2>
                                <p class="card-text mt-4 mb-5" style="text-align: justify !important;"><?php echo $row['au_description']; ?></p>  
                                  
                                <div class="d-flex justify-content-center pb-2">
                                    <button class="button btn btn-primary text-center" id="myButton">Know More</button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- **** New finish ***** -->


    <script type="text/javascript">
        document.getElementById("myButton").onclick = function () {
            location.href = "food";
        };
    </script>
    <script type="text/javascript">
        document.getElementById("myButton2").onclick = function () {
            location.href = "education";
        };
    </script>

    <footer>
        <?php include ("footer.php") ?>
    </footer>
</body>

</html>