<?php
require("../config/db_connection.php");

$insert = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add']) && isset($_FILES['image'])) {
        
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
                            $align = $_POST['align'];
                            $add_to=$_GET['add_to'];
                            if($add_to=='bd'){

                                $sql = "INSERT INTO `cms_bd` (`bd_title`, `bd_image`, `bd_description`,`bd_align`) VALUES ('$title','$new_img_name', '$description','$align');";
                                $result = mysqli_query($conn, $sql);

                                header("Location:../include/cms_book_donation");
                            }else{
                                if($add_to=='fd'){
                                    $sql = "INSERT INTO `cms_fd` (`fd_title`, `fd_image`, `fd_description`,`fd_align`) VALUES ('$title','$new_img_name', '$description','$align');";
                                    $result = mysqli_query($conn, $sql);
                
                                    header("Location:../include/cms_food_donation_page");
                                }
                            }
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
    <header>Add Content</header>
    <form action="#" class="form" method="POST" id="prog" enctype="multipart/form-data">
        <div class="input-box">
            <label><i class="fa fa-book" aria-hidden="true"></i>Title:</label>
            <input type="text" name="title" value=" " required />
        </div>
        <div class="column">
            <div class="image-box">
                <label><i class="fa fa-picture-o" aria-hidden="true"></i> Upload Image:</label>
                <input type="file" name="image" required />
            </div>
        </div>
        <div class="input-box">
            <label> <i class="fa fa-edit"></i>Description:</label>
            <input type="textarea" name="description" value=" " required />
        </div>
        
        <div class="align-box">
                    <i class="fa fa-dot-circle-o" aria-hidden="true">Align Style</i>
                    <div class="type-option">
                        <div class="align">
                            <input type="radio" id="check-CI" name="align" value="CI" />
                            <label for="check-CI">Content => Image</label>
                        </div>
                        <div class="align">
                            <input type="radio" id="check-IC" name="align" value="IC" />
                            <label for="check-IC">Image => Content</label>
                        </div>
                    </div>
                </div>
                

        <button type="submit" name="add">ADD Content</button>
    </form>
</section>