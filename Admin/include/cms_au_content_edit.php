<?php
require("../config/db_connection.php");

$insert = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $cms_hp_id = $_GET['cms_au_id'];
        // $cms_hp_id = 1;

        $sql = "UPDATE `cms_au` SET `au_title`='$title',`au_image`='$new_img_name',`au_description`='$description' WHERE `cms_au`.`cms_au_id` = $cms_hp_id";
        $result = mysqli_query($conn, $sql);
        // echo 'updated';
        header("Location:cms_about_us");
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
                 $cms_hp_id=$_GET['cms_au_id'];
                 $query = "SELECT * FROM cms_au WHERE `cms_au`.`cms_au_id` = $cms_hp_id";
                 $result = mysqli_query($conn, $query);
                 while ($row = mysqli_fetch_array($result)) { ?>
        <div class="input-box">
            <label><i class="fa fa-book" aria-hidden="true"></i>Title:</label>
            <input type="text" name="title" value="<?php echo $row['au_title']; ?> " required />
        </div>
        <div class="input-box">
            <label> <i class="fa fa-edit"></i>Description:</label>
            <input type="textarea" name="description" value="<?php echo $row['au_description']; ?>" required />
        </div>


        <button type="submit" name="submit">Update</button>
        <?php }?>
    </form>
</section>