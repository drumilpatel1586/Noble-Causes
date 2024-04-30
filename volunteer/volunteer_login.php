<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Volunteer Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="volunteer_login.css" />

</head>

<body>
    <?php
    require ('../connection.php');
    $login = false;
    $showError = false;
    $email = '';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `volunteers` WHERE v_email ='$email';";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num==1){
            while($row=mysqli_fetch_assoc($result)){
                if(password_verify($password , $row['v_password'])==1){
                    $login = true;
                    session_start();
                    $_SESSION['v_loggedin'] = true;
                    $_SESSION['v_email'] = $email;
                    $_SESSION['v_id'] = $row['v_id'];
                    header("location: index");
                }
                else{
                    $showError = "invalid credentials";
                }
            }
        }
    }   
    ?>
    <section class="container">
        <header>Volunteer Login</header>
        <form action="#" method="POST" class="form">
            <div class="input-box">
                <label><i class="fa fa-envelope" aria-hidden="true"></i> Email Address</label>
                <input class="input" type="text" placeholder="Enter email address" name="email" required/>
            </div>
            <div class="input-box">
                <label><i class="fa fa-lock" aria-hidden="true"></i> Password</label>
                <input class="input" type="Password" placeholder="Enter Password" name="password" required />
            </div>

            <button type="submit">Login</button>
        </form>
    </section>
</body>

</html>