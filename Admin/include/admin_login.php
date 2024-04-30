
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/admin_login.css" />

</head>
<style>
    .error {
        color: red;
    }
</style>

<?php
// Start session
session_start();

// Check if user is already logged in, redirect to dashboard if true
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: index");
    exit;
}

// Include the database connection file
require_once('../config/db_connection.php');

// Initialize variables
$email = $password = "";
$emailErr = $passwordErr = "";
$showError = false;
$loginError = false;
// Validate form data on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_email = $_POST['email'];
    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $showError = true;
    } else {
        $email = test_input($_POST["email"]);
        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $showError = true;
        }
    }
    
    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $showError = true;
    } else {
        $password = test_input($_POST["password"]);
    }
    
    // If form data is valid, attempt login
    if (!$showError) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `admin_login` WHERE admin_email ='$email';";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num==1){
            while($row=mysqli_fetch_assoc($result)){
                if($password==$row['admin_pswd']){
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['admin_email'] = $email;
                    $_SESSION['admin_id'] = $admin_id;
                    $_SESSION['login_message'] = "Login successful";

                    header("location: index");
                }
                else{
                    $loginError = true;
                    $loginError = "invalid credentials";
                }
            }
        }
    }   
}


// Function to sanitize form input
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<body>
<section class="container">
        <header>Admin Login</header>
        <form action="#" method="POST" class="form">
            <div class="input-box">
                <label><i class="fa fa-envelope" aria-hidden="true"></i> Email Address</label>
                <input class="input" type="text" placeholder="Enter email address" name="email" />
                <span class="error"><?php echo $emailErr; ?></span>
            </div>
            <div class="input-box">
                <label><i class="fa fa-lock" aria-hidden="true"></i> Password</label>
                <input class="input" type="Password" placeholder="Enter Password" name="password"  />
                <span class="error"><?php echo $passwordErr; ?></span>
    </div>
            </div>

            <button type="submit">Login</button>
        </form>
    </section>
    <?php
    if ($loginError) {
        echo '<script>alert("Invalid email or password. Please try again.")</script>';
    }
    ?>

</body>

</html>