<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/manage.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <title>Noble Causes-User Question</title>
    <style>
    .btn {
        display: block;
        display: flex;
        justify-content: center;
        flex-direction: row;
        margin-left: 4px;
        align-content: space-around;
    }

    .ru {
        margin-left: 4px;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .book_donate_req {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .navbar {
        flex: 0 0 auto;
    }

    .book_donate_req_content {
        flex: 1 0 auto;
        padding: 20px;
    }

    .title {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 90%;
        border-collapse: collapse;
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }
    .title h3{
    color: #000000c2; 
    border-radius: 30px;
    width: 96%;
    background: var(--highlight-color);
    text-align: center;
}

table th{
    text-align: center;
}
table td{
    text-align: center;
}
    .table-responsive {
        overflow-x: auto;
    }

    @media screen and (max-width: 600px) {
        .book_donate_req_content {
            padding: 10px;
        }
    }
</style>
</head>
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
} else {
    header("Location: admin_login");
} ?>

<?php
    require_once("../config/db_connection.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $q_id = $_POST['id'];
        echo $q_id;
        $sql = "DELETE FROM contact_us WHERE q_id = '$q_id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: contact_us");
        } else {
            echo "Error: ". $sql. "<br>". mysqli_error($conn);
        }
    }
?>

<body>
    <div class="food_donate_req">

        <div class="navbar">
            <?php include("../include/sidebar.php"); ?>
        </div>

        <div class="food_donate_req_content">
            <header>
                <div class="food_donate_req_content_title">
                    <h1>User Question</h1>
                    <ul class="navigation">
                        <li class="navigation-item">
                            <a href="../include/dashboard">Dashboard</a>
                        </li>
                        <li class="navigation-icon">
                            <i class="bx bx-chevron-right dropdown"> </i>
                    </ul>
                </div>
            </header>

            <div class="title">
                <h3>Question From Users</h3>
            </div>

            <table class="table align-middle mb-0 bg-white" cellspacing="30%" cellpadding="0">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>email</th>
                        <th>Question</th>
                        <th>Reply</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php
                require('../config/db_connection.php');
                require('encrypt_decrypt.php');
                $int = 1;
                $query = "SELECT * FROM contact_us";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) {
                    $U = $row['u_id'];
                    $u_mail = $row['u_email'];
                    $i = $int++ ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $row['u_name']; ?></td>
                            <td><?php echo $row['u_email']; ?></td>
                            <td><?php echo $row['u_message']; ?></td>
                            <td>
                                <button class='reply center btn btn-sm btn-info' data-email=<?php echo $u_mail; ?>>Reply</button>
                            </td>
                            <td>
                            <form action="#" class="form" method="POST" id="prog" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $row['q_id']; ?>" /> 
                                <button type="submit" class='delete center btn btn-sm btn-info' data-email=<?php $u; ?>>Delete</button>
                            </form>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>

    </div>
</body>
<script>
    $(document).ready(function() {
        $('.reply').click(function() {
            var emailAddress = $(this).data('email');
            window.location.href = "mailto:" + emailAddress;
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('.delete').click(function() {
            $delete = true;
            window.location.href = "contact_us";
        });

    });
</script>

</html>