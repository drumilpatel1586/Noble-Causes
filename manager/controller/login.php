<?php
    require('../../connection.php');
    $login = false;
    $showError = false;
    $email = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `manager` WHERE m_email ='$email';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $num = mysqli_num_rows($result);
        if ($password == $row['m_password']) {
            $login = true;
            session_start();
            $_SESSION['v_loggedin'] = true;
            $_SESSION['m_email'] = $email;
            $_SESSION['m_id'] = $row['m_id'];
            header("location: ../index");
        } else {
            $showError = "invalid credentials";
        }
    }
    ?>