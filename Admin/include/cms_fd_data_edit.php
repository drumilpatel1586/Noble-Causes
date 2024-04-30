<?php
require("../config/db_connection.php");



    $insert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                            $title = $_POST["title"];
                            $description = $_POST["description"];
                            $cms_fd_id = $_GET['cms_fd_id'];
    
                            $sql = "UPDATE `cms_fd` SET `fd_title`='$title',`fd_image`='$new_img_name',`fd_description`='$description' WHERE `cms_fd`.`cms_fd_id` = '$cms_fd_id'";
                            $result = mysqli_query($conn, $sql);
                            header("Location:cms_food_donation_page");
                        }
                    }
                }
            }
        }
    }
    
    ?>
    
    <head>
        <link rel="stylesheet" href="../css/cms_hp_edit.css">
    </head>
    <section class="container">
        <header>Update Data</header>
        <form action="#" class="form" method="POST" id="prog" enctype="multipart/form-data">
            <?php
            require("../config/db_connection.php");
            $cms_fd_id = $_GET['cms_fd_id'];
            $query = "SELECT * FROM cms_fd WHERE `cms_fd`.`cms_fd_id` = $cms_fd_id";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) { ?>
                <div class="input-box">
                    <label><i class="fa fa-book" aria-hidden="true"></i>Title:</label>
                    <input type="text" name="title" value="<?php echo $row['fd_title']; ?> " required />
                </div>
                <div class="column">
                    <div class="image-box">
                        <label><i class="fa fa-picture-o" aria-hidden="true"></i> Upload Image:</label>
                        <input type="file" name="image" required />
                    </div>
                </div>
                <div class="input-box">
                    <label> <i class="fa fa-edit"></i>Description:</label>
                    <input type="textarea" name="description" value="<?php echo $row['fd_description']; ?>" required />
                </div>
    
    
                <button type="submit" name="submit">Update</button>
            <?php } ?>
        </form>
    </section>

