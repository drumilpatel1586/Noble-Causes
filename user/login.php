
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes - User Login</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!---Custom CSS File--->

    <link rel="stylesheet" href="login.css" />
   
</head>

<body>
<?php
require "../Admin/config/db_connection.php";
$login = false; 
$showError = false;
$email = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `user_login` WHERE email ='$email';";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num==1){
        while($row=mysqli_fetch_assoc($result)){
            if(password_verify($password , $row['password'])==1){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $row['user_id'];

                if ($_GET['source']=='food') {
                    
                    header('location:foodDonateform');
                    
                    exit();
                }
                if ($_GET['source']=='book') {
                    
                    header('location:bookDonateform');
                    
                    exit();
                }
                if ($_GET['source']=='contact_us') {
                    
                    header('location:contactUs');
                    
                    exit();
                }
                 
                header("location: index?source=loginpage");

                exit();
            }
            else{
                $showError = "invalid credentials";
            }
        }
    }
}   
?>
    
    <section class="container">
        <header>Login</header>
        <form action="#" method="POST" class="form">
            <div class="input-box">
                <label><i class="fa fa-envelope" aria-hidden="true"></i> Email Address</label>
                <input type="text" placeholder="Enter email address"  name="email"  value="<?=$email?>" />
            </div>
            <div class="input-box">
                <label><i class="fa fa-lock" aria-hidden="true"></i> Password</label>
                <input type="Password" placeholder="Enter Password" name="password" required />
            </div>

            <button type="submit">Submit</button>
           <div class="login-link">
             Don't have an account ? <a href="signUp?source=loginpage">Sign Up</a>
             </div>
        </form>
    </section>
    <div>
        <?php include("footer.php") ?>
    </div>
</body>

</html>