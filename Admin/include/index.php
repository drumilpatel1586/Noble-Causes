<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes - Admin</title>
 
</head>

<body>
<?php  
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    if (isset($_SESSION['login_message']) && !empty($_SESSION['login_message'])) {
        // Output JavaScript to display the alert
        echo "<script>alert('{$_SESSION['login_message']}');</script>";
        // Unset the session variable
        unset($_SESSION['login_message']);
    }
}else{
  header("Location: admin_login");
}?>
    <div class="admin-home">
        <div class="navbar">
            <?php include("sidebar.php"); ?>
        </div>

        <div class="content">
            <?php include("dashboard_content.php"); ?>
        </div>

    </div>
</body>

</html>