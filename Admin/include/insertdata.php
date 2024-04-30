<?php
require("../config/db_connection.php");

$insert = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST["title"];
    $cms_bd_id = $_POST["cms_bd_id"];
    $description = $_POST["description"];
    if (isset($_POST['submit']) && isset($_FILES['image'])) {

        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        if ($error === 0) {
            if ($img_size < 5000000) { {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
                    $allowed_exs = array("jpg", "jpeg", "png");

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("CMS-IMG-", true) . '.' . $img_ex_lc;
                        $img_upload_path = '../NC_Images/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        // $sql = "INSERT INTO `cms_bd` (`cms_bd_id`,`bd_title`, `bd_image`, `bd_description`) VALUES ('$cms_bd_id','$title','$new_img_name', '$description');";
                        // $sql = "INSERT INTO `cms_fd` (`cms_fd_id`,`fd_title`, `fd_image`, `fd_description`) VALUES ('$cms_bd_id','$title','$new_img_name', '$description');";

                        // food donation form 
                        // $sql = "INSERT INTO `cms_fdf`(`fdf_id`, `fdf_img`, `fdf_description`, `fdf_path`) VALUES ('$cms_bd_id','$new_img_name','$description','$title')";


                        // book donation form
                        // $sql = "INSERT INTO `cms_bdf`(`bdf_id`, `bdf_img`, `bdf_description`, `bdf_path`) VALUES ('$cms_bd_id','$new_img_name','$description','$title')";



                        $result = mysqli_query($conn, $sql);
                        echo 'inserted';
                        header('location:insertdata');
                    } else {
                        $em = "You can't upload files of this type";
                        echo '<script>alert("' . $em . '")</script>';
                    }
                }
            } else {
                $em = "Sorry, your file is too large.";
                echo '<script>alert("' . $em . '")</script>';
            }
        } else {
            $em = "unknown error occurred in file upload!";
            echo '<script>alert("' . $em . '")</script>';
        }
    }
}


?>

<section class="container">
    <header>insert</header>
    <form action="#" class="form" method="POST" id="prog" enctype="multipart/form-data">

        <div class="input-box">
            <label><i class="fa fa-book" aria-hidden="true"></i>CMS-fd-id</label>
            <input type="int" name="cms_bd_id" placeholder="Enter ID" required />
        </div>
        <div class="input-box">
            <label><i class="fa fa-book" aria-hidden="true"></i>Title</label>
            <input type="text" name="title" placeholder="Enter Title" required />
        </div>
        <div class="column">
            <div class="image-box">
                <label><i class="fa fa-picture-o" aria-hidden="true"></i> Upload Book Image</label>
                <input type="file" name="image" />
            </div>
        </div>
        <div class="input-box">
            <label> <i class="fa fa-edit"></i> Book Description</label>
            <input type="textarea" name="description" placeholder="Enter Description" required />
        </div>


        <button type="submit" name="submit">insert</button>
    </form>
</section>