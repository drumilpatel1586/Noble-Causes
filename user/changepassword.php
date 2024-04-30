<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Noble Causes- Change Password</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!---Custom CSS File--->
    <link rel="stylesheet" href="profile.css?v=7">
    <style> 
.box {
  position: relative;
  margin: auto;
  background: #fff;
  padding: 25px;
  border-radius: 8px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}
.fa{
    margin-right: 10px;
}
.box header {
  font-size: 1.5rem;
  color: #333;
  font-weight: 500;
  text-align: center;
}
.box .form {
  margin-top: 30px;
}
.form .input-box {
  width: 100%;
  margin-top: 20px;
}
.input-box label {
  color: #333;
}
.form :where(.input-box input) {
  position: relative;
  height: 50px;
  width: 100%;
  outline: none;
  font-size: 1rem;
  color: #707070;
  margin-top: 8px;
  border: 1px solid #ddd;
  border-radius: 6px;
  padding: 0 15px;
}
.input-box input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}
.form .column {
  display: flex;
  column-gap: 15px;
}
.form button {
    height: 55px;
    width: 100%;
    color: #fff;
    font-size: 1rem;
    font-weight: 400;
    margin-top: 30px;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    background: #3E8DA8;
  }
  .form button:hover {
    background: #62b1cb;
  }
  .login-link{
    margin-top: 20px;
    
    text-align: center;
  }
  .login-link a{
    color: #3E8DA8;
    font-size: 20px;
    font-weight: 500;
  }
</style>

</head>

<body>
    <div class="backtohome mt-4 ml-5">
        <li class="col-md-12"><a href="profile"> <i class='fas fa-angle-left' style='font-size:15px'></i>
                <b> Back To Profile </b>
            </a></li>
    </div>
    <?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    } else {
        header("Location:login");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo 'if';
        require('connection.php');
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT `password` FROM `user_login` WHERE `user_login`.`user_id`=$user_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $password = $_POST['pswd'];
        $newpassword = $_POST['newpswd'];
        $h_password = password_hash($newpassword, PASSWORD_DEFAULT);
        $cpassword = $_POST['cpswd'];

        if ($newpassword == $cpassword) {
            echo 'lhs = rhs';
            if (password_verify($password, $row['password']) == 1) {
                echo 'pasword correct';
                $sql = "UPDATE `user_login` SET `password`='$h_password' WHERE `user_login`.`user_id`=$user_id";
                $result = mysqli_query($conn, $sql);
                session_start();
                session_unset();
                session_destroy();

                header("location: index");
                exit;
            }
        } else {
            echo 'enter same new password';
        }
    }
    ?>
    <?php
        
    
    require('connection.php');
    include "profile_navbar.php";?>
    <div class="profile-info col-md-9">
        <div class="panel">
            <section class="box">
                <header>Change Password</header>
                <form action="#" method="POST" class="form">
                    <div class="input-box">
                        <label><i class="fa fa-lock" aria-hidden="true"></i>Enter Password</label>
                        <input type="Password" placeholder="Enter old password" name="pswd" required />
                    </div>
                    <div class="input-box">
                        <label><i class="fa fa-lock" aria-hidden="true"></i>Enter New Password</label>
                        <input type="Password" placeholder="Enter new Password" name="newpswd" required />
                    </div>
                    <div class="input-box">
                        <label><i class="fa fa-lock" aria-hidden="true"></i>Confirm Password</label>
                        <input type="Password" placeholder="Confirm Password" name="cpswd" required />
                    </div>

                    <button type="changepassword">Change Password</button>

                </form>
            </section>
        </div>
    </div>
    <div>
        <?php include("footer.php") ?>
    </div>
</body>