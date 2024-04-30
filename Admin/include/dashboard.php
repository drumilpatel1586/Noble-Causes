<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes - Admin</title>
</head>
<?php  
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

}else{
  header("Location: admin_login");
}?>
<body>
    <div class="dashboard">
        <div class="navbar">
            <?php include("sidebar.php"); ?>
        </div>

        <div class="content">
            <?php include("dashboard_content.php"); ?>
        </div>
        
    </div>
</body>

</html>