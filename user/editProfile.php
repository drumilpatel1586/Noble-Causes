<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap link -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- CSS Link -->
    <link rel="stylesheet" href="profile.css?v=4">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes-Edit Profile</title>
    <style>
    /*  CSS for Button (Save changes)  */

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

<body>


    <!-- back to home button -->
    <div class="backtohome mt-4 ml-5">
        <li class="col-md-12"><a href="index"> <i class='fas fa-angle-left' style='font-size:15px'></i>
                <b> Back To Home </b>
            </a></li>
    </div>
    <?php  
session_start();
// echo $_SESSION['user_id'];
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

}else{
  header("Location:login");
}

?>
    <?php
require 'connection.php';
include "profile_navbar.php";

$update = false;
$user_id=$_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = mysqli_real_escape_string ($conn,$_POST['nameEdit']);
    $email = mysqli_real_escape_string ($conn,$_POST['emailEdit']);
    $phone = mysqli_real_escape_string ($conn,$_POST['phoneEdit']);
    $street = mysqli_real_escape_string ($conn,$_POST['streetEdit']);
    $city = mysqli_real_escape_string ($conn,$_POST['cityEdit']);
    $zip_code = mysqli_real_escape_string ($conn,$_POST['zip_codeEdit']);
    $sql = "UPDATE `user_login` SET `name` = '$name', `phone` = '$phone', `email` = '$email', `street` = '$street', `city` = '$city', `zip_code` = '$zip_code' WHERE `user_login`.`user_id` = $user_id;";
    $result = mysqli_query($conn, $sql);
    header("Location:profile");
    if($result){
      $update = true;
  }
  else{
      echo "We are not able to update your profile";
  }
}
?>
    <?php
       $user_id=$_SESSION['user_id'];
        $sql = "SELECT * FROM `user_login` WHERE user_id='$user_id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)){ ?>
            
            <div class="profile-info col-md-9">
                <div class="panel">
                    <!-- <div class="bio-graph-heading">
                        <h5>“Help others without any reason and give without the expectation of receiving anything in
                            return.”</h5>
                    </div> -->
                    <div class="card col-md-12 my-4">
                        <h3 class="mt-3 ml-3">Change Your Details</h3>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <h6>Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary"> <input type="text" class="form-control"
                                            name="nameEdit" value='<?php echo ''.$row['name'].''?>'></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <h6>Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary"> <input type="text" class="form-control"
                                            name="emailEdit" value='<?php echo ''.$row['email'].''?>'></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <h6>Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary"> <input type="text" class="form-control"
                                            name="phoneEdit" value='<?php echo ''.$row['phone'].''?>'></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <h6>Street</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="streetEdit" class="form-control"
                                            value='<?php echo ''.$row['street'].''?>'>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <h6>City</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="cityEdit" class="form-control"
                                            value='<?php echo ''.$row['city'].''?>'>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <h6>Zip Code</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="zip_codeEdit" class="form-control"
                                            value='<?php echo ''.$row['zip_code'].''?>'>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 col-sm-3 mx-auto">
                                    <button class="editbtn col-sm-12" type="submit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>
    <?php
        include("footer.php");
        ?>

</body>

</html>