<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `user_login` WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="container bootstrap snippets bootdey-fluid ">
        <div class="row">
            <div class="profile-nav col-md-3">
                <div class="panel">

                    <div class="user-heading round">
                        <?php if ($row['gender'] == 'male') { ?>
                            <a href="#">
                                <img src="avatarboy.png" alt="Profile Pic">
                            </a>
                        <?php } else { ?>
                            <a href="#">
                                <img src="avatargirl.png" alt="Profile Pic">
                            </a>
                        <?php } ?>
                        <h1>
                            <?php echo '' . $row['name'] . '' ?>
                        </h1>
                        <p>
                            <?php echo '' . $row['email'] . '' ?>
                        </p>
                    </div>

                    <ul class="nav nav-pills nav-stacked mt-3">
                        <li class="col-md-12"><a href="profile"> <i class="fa fa fa-user"></i><b> Profile </b></a></li>
                        <li class="col-md-12"><a href="activity"> <i class="fa fa fa-box"></i> <b>My Donations
                                </b><span class="label label-warning pull-right r-activity"></span></a></li>
                        <li class="col-md-12"><a href="applied_books"> <i class="fa fa fa-book"></i> <b>Applied Books
                                </b><span class="label label-warning pull-right r-activity"></span></a></li>
                        <li class="col-md-12"><a href="editProfile"><i class="fa fa fa-edit"></i><b> Edit
                                    profile</b></a></li>
                        <li class="col-md-12"><a href="changePassword"><i class="fa fa-solid fa fa-lock"></i></i><b> Change
                                    Password</b></a>
                        </li>
                        <li class="col-md-12"><a href="logout"> <i class="fa fa fa-sign-out" aria-hidden="true"></i></i><b>
                                    Logout </b></a></li>
                    </ul>
                </div>
            </div>
        <?php } ?>