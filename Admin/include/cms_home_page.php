<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/cms_home_page.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
  <title>Noble Causes-CMS-Home Page</title>
</head>

<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
  header("Location: admin_login");
} ?>

<body>
  <div class="navbar">
    <?php include_once("sidebar.php"); ?>
  </div>
  <div class="cms_home_page_content">
    <div class="header">
      <header>
        <div class="cms_home_page_title">
          <h1>Noble Causes - Home Page</h1>
          <ul class="navigation">
            <li class="navigation-item">
              <a href="../include/dashboard">Dashboard</a>
            </li>
            <li class="navigation-icon">
              <i class="bx bx-chevron-right dropdown"> </i>
            </li>
            <li class="navigation-item">
              <a href="../include/cms_home_page">Home Page</a>
            </li>
            <li class="navigation-icon">
              <i class="bx bx-chevron-right dropdown"> </i>
            </li>
          </ul>
        </div>
      </header>
    </div>
    <div class="cms_home_page_main">
      <div class="home_page_image">
        <div class="title">
          <h3>Home Page Main Image</h3>
        </div>

        <div class="container">
          <?php
          require("../config/db_connection.php");
          $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '1'";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_array($result)) { ?>
            <div class="card1">
              <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_image']; ?>">
            </div>
            <div class="card2">
              <form action="../include/cms_data_edit?cms_hp_id=1" class="form" method="POST">
                <div class="input-box">
                  <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                </div>
                <div class="input-box">
                  <label> <i class="lable_title"></i><br>Description:</label>
                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                </div>
                <div class="input-box"><br>
                  <button type="submit" name="update">Update</button>
                </div>
              </form>
            <?php } ?>

            </div>
        </div>

      </div>
    </div>
    <div class="cms_home_page_main">
      <?php
      require("../config/db_connection.php");
      $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '2'";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($result)) { ?>
        <div class="home_page_card_header">
          <div class="title">
            <h3>Home Page 1st Cards Header</h3>
          </div>

          <div class="container">
            <div class="card1">
              <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_title'] ?>">
            </div>
            <div class="card2">
              <form action="../include/cms_content_edit?cms_hp_id=2" class="form" method="POST">
                <div class="input-box">
                  <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                </div>
                <div class="input-box">
                  <label> <i class="lable_title"></i><br>Description:</label>
                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                </div>
                <div class="input-box"><br>
                  <button type="submit" name="update">Update</button>
                </div>
              </form>
            <?php } ?>
            </div>
          </div>
          <div class="cms_home_page_main">
            <div class="home_page_image">
              <div class="title">
                <h3>1st Cards</h3>
              </div>
        
              <div class="container">
                <?php
                require("../config/db_connection.php");
                $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '3'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) { ?>
                  <div class="card1">
                    <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_image']; ?>">
                  </div>
                  <div class="card2">
                    <form action="../include/cms_data_edit?cms_hp_id=3" class="form" method="POST">
                      <div class="input-box">
                        <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                        <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                      </div>
                      <div class="input-box">
                        <label> <i class="lable_title"></i><br>Description:</label>
                        <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                      </div>
                      <div class="input-box"><br>
                        <button type="submit" name="update">Update</button>
                      </div>
                    </form>
                  <?php } ?>

                  </div>
              </div>

            </div>
          </div>
          <div class="cms_home_page_main">
            <div class="home_page_image">
              <div class="title">
                <h3>2nd Cards</h3>
              </div>

              <div class="container">
                <?php
                require("../config/db_connection.php");
                $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '4'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) { ?>
                  <div class="card1">
                    <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_image']; ?>">
                  </div>
                  <div class="card2">
                    <form action="../include/cms_data_edit?cms_hp_id=4" class="form" method="POST">
                      <div class="input-box">
                        <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                        <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                      </div>
                      <div class="input-box">
                        <label> <i class="lable_title"></i><br>Description:</label>
                        <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                      </div>
                      <div class="input-box"><br>
                        <button type="submit" name="update">Update</button>
                      </div>
                    </form>
                  <?php } ?>

                  </div>
              </div>

            </div>
          </div>
          <div class="cms_home_page_main">
            <div class="home_page_image">
              <div class="title">
                <h3>3rd Cards</h3>
              </div>

              <div class="container">
                <?php
                require("../config/db_connection.php");
                $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '5'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) { ?>
                  <div class="card1">
                    <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_image']; ?>">
                  </div>
                  <div class="card2">
                    <form action="../include/cms_data_edit?cms_hp_id=5" class="form" method="POST">
                      <div class="input-box">
                        <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                        <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                      </div>
                      <div class="input-box">
                        <label> <i class="lable_title"></i><br>Description:</label>
                        <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                      </div>
                      <div class="input-box"><br>
                        <button type="submit" name="update">Update</button>
                      </div>
                    </form>
                  <?php } ?>

                  </div>
              </div>

            </div>
          </div>
          <div class="cms_home_page_main">
            <div class="home_page_card_header">
              <div class="title">
                <h3>Home Page 2nd Cards Header</h3>
              </div>

              <div class="container">
                <?php
                require("../config/db_connection.php");
                $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '6'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) { ?>
                  <div class="card1">
                    <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_title'] ?>">
                  </div>
                  <div class="card2">
                    <form action="../include/cms_content_edit?cms_hp_id=6" class="form" method="POST">
                      <div class="input-box">
                        <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                        <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                      </div>
                      <div class="input-box">
                        <label> <i class="lable_title"></i><br>Description:</label>
                        <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                      </div>
                      <div class="input-box"><br>
                        <button type="submit" name="update">Update</button>
                      </div>
                    </form>
                  <?php } ?>
                  </div>
              </div>
              <div class="cms_home_page_main">
                <div class="home_page_image">
                  <div class="title">
                    <h3>1st Cards</h3>
                  </div>

                  <div class="container">
                    <?php
                    require("../config/db_connection.php");
                    $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '7'";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) { ?>
                      <div class="card1">
                        <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_image']; ?>">
                      </div>
                      <div class="card2">
                        <form action="../include/cms_data_edit?cms_hp_id=7" class="form" method="POST">
                          <div class="input-box">
                            <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                          </div>
                          <div class="input-box">
                            <label> <i class="lable_title"></i><br>Description:</label>
                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                          </div>
                          <div class="input-box"><br>
                            <button type="submit" name="update">Update</button>
                          </div>
                        </form>
                      <?php } ?>

                      </div>
                  </div>

                </div>
              </div>
              <div class="cms_home_page_main">
                <div class="home_page_image">
                  <div class="title">
                    <h3>2nd Cards</h3>
                  </div>

                  <div class="container">
                    <?php
                    require("../config/db_connection.php");
                    $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '8'";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) { ?>
                      <div class="card1">
                        <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_image']; ?>">
                      </div>
                      <div class="card2">
                        <form action="../include/cms_data_edit?cms_hp_id=8" class="form" method="POST">
                          <div class="input-box">
                            <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                          </div>
                          <div class="input-box">
                            <label> <i class="lable_title"></i><br>Description:</label>
                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                          </div>
                          <div class="input-box"><br>
                            <button type="submit" name="update">Update</button>
                          </div>
                        </form>
                      <?php } ?>

                      </div>
                  </div>

                </div>
              </div>
              <div class="cms_home_page_main">
                <div class="home_page_image">
                  <div class="title">
                    <h3>3rd Cards</h3>
                  </div>

                  <div class="container">
                    <?php
                    require("../config/db_connection.php");
                    $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '9'";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) { ?>
                      <div class="card1">
                        <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_image']; ?>">
                      </div>
                      <div class="card2">
                        <form action="../include/cms_data_edit?cms_hp_id=9" class="form" method="POST">
                          <div class="input-box">
                            <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                          </div>
                          <div class="input-box">
                            <label> <i class="lable_title"></i><br>Description:</label>
                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                          </div>
                          <div class="input-box"><br>
                            <button type="submit" name="update">Update</button>
                          </div>
                        </form>
                      <?php } ?>

                      </div>
                  </div>

                </div>
              </div>
              <div class="cms_home_page_main">
                <?php
                require("../config/db_connection.php");
                $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '10'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) { ?>
                  <div class="home_page_donation_header">
                    <div class="title">
                      <h3>Home Page Donation Header</h3>
                    </div>

                    <div class="container">
                      <div class="card1">
                        <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_title'] ?>">
                      </div>
                      <div class="card2">
                        <form action="../include/cms_content_edit?cms_hp_id=10" class="form" method="POST">
                          <div class="input-box">
                            <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                          </div>
                          <div class="input-box">
                            <label> <i class="lable_title"></i><br>Description:</label>
                            <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                          </div>
                          <div class="input-box"><br>
                            <button type="submit" name="update">Update</button>
                          </div>
                        </form>
                      <?php } ?>
                      </div>
                    </div>
                    <div class="cms_home_page_main">
                      <?php
                      require("../config/db_connection.php");
                      $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '11'";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="home_page_card_header">
                          <div class="title">
                            <h3><?php echo $row['hp_title']; ?> </h3>
                          </div>

                          <div class="container">
                            <div class="card1">
                              <!-- <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_title'] ?>"> -->
                              <div class="col-md-5 mx-auto mb-4 card" style="background-color: #f5dfd7;">

                                <p class="text-center mb-3" style="text-align: justify !important;">
                                <h2 class="text-center"><b><?php echo $row['hp_title']; ?> </b></h2>
                                <ul>
                                  <p><?php echo $row['hp_description']; ?></p>
                                </ul>
                              </div>
                            </div>

                            <div class="card2">
                              <form action="../include/cms_content_edit?cms_hp_id=11" class="form" method="POST">
                                <div class="input-box">
                                  <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                                </div>
                                <div class="input-box">
                                  <label> <i class="lable_title"></i><br>Description:</label>
                                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                                </div>
                                <div class="input-box"><br>
                                  <button type="submit" name="update">Update</button>
                                </div>
                              </form>
                            </div>
                            <?php } ?>
                          </div>
                            <div class="cms_home_page_main">
                      <?php
                      require("../config/db_connection.php");
                      $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '12'";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="home_page_card_header">
                          <div class="title">
                            <h3><?php echo $row['hp_title']; ?> </h3>
                          </div>

                          <div class="container">
                            <div class="card1">
                              <!-- <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_title'] ?>"> -->
                              <div class="col-md-5 mx-auto mb-4 card" style="background-color: #f5dfd7;">

                                <p class="text-center mb-3" style="text-align: justify !important;">
                                <h2 class="text-center"><b><?php echo $row['hp_title']; ?> </b></h2>
                                <ul>
                                  <p><?php echo $row['hp_description']; ?></p>
                                </ul>
                              </div>
                            </div>

                            <div class="card2">
                              <form action="../include/cms_content_edit?cms_hp_id=11" class="form" method="POST">
                                <div class="input-box">
                                  <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                                </div>
                                <div class="input-box">
                                  <label> <i class="lable_title"></i><br>Description:</label>
                                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                                </div>
                                <div class="input-box"><br>
                                  <button type="submit" name="update">Update</button>
                                </div>
                              </form>
                            </div>
                            <?php } ?>
                          </div>
                          <div class="cms_home_page_main">
                      <?php
                      require("../config/db_connection.php");
                      $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '13'";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="home_page_card_header">
                          <div class="title">
                            <h3><?php echo $row['hp_title']; ?> </h3>
                          </div>

                          <div class="container">
                            <div class="card1">
                              <!-- <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_title'] ?>"> -->
                              <div class="col-md-5 mx-auto mb-4 card" style="background-color: #f5dfd7;">

                                <p class="text-center mb-3" style="text-align: justify !important;">
                                <h2 class="text-center"><b><?php echo $row['hp_title']; ?> </b></h2>
                                <ul>
                                  <p><?php echo $row['hp_description']; ?></p>
                                </ul>
                              </div>
                            </div>

                            <div class="card2">
                              <form action="../include/cms_content_edit?cms_hp_id=11" class="form" method="POST">
                                <div class="input-box">
                                  <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                                </div>
                                <div class="input-box">
                                  <label> <i class="lable_title"></i><br>Description:</label>
                                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                                </div>
                                <div class="input-box"><br>
                                  <button type="submit" name="update">Update</button>
                                </div>
                              </form>
                            </div>
                            <?php } ?>
                            </div>
                            <div class="cms_home_page_main">
                      <?php
                      require("../config/db_connection.php");
                      $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '14'";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="home_page_card_header">
                          <div class="title">
                            <h3><?php echo $row['hp_title']; ?> </h3>
                          </div>

                          <div class="container">
                            <div class="card1">
                              <!-- <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_title'] ?>"> -->
                              <div class="col-md-5 mx-auto mb-4 card" style="background-color: #ebd7f5;">

                                <p class="text-center mb-3" style="text-align: justify !important;">
                                <h2 class="text-center"><b><?php echo $row['hp_title']; ?> </b></h2>
                                <ul>
                                  <p><?php echo $row['hp_description']; ?></p>
                                </ul>
                              </div>
                            </div>

                            <div class="card2">
                              <form action="../include/cms_content_edit?cms_hp_id=11" class="form" method="POST">
                                <div class="input-box">
                                  <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                                </div>
                                <div class="input-box">
                                  <label> <i class="lable_title"></i><br>Description:</label>
                                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                                </div>
                                <div class="input-box"><br>
                                  <button type="submit" name="update">Update</button>
                                </div>
                              </form>
                            </div>
                            <?php } ?>
                            </div>
                            <div class="cms_home_page_main">
                      <?php
                      require("../config/db_connection.php");
                      $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '15'";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="home_page_card_header">
                          <div class="title">
                            <h3><?php echo $row['hp_title']; ?> </h3>
                          </div>

                          <div class="container">
                            <div class="card1">
                              <!-- <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_title'] ?>"> -->
                              <div class="col-md-5 mx-auto mb-4 card" style="background-color: #ebd7f5;">

                                <p class="text-center mb-3" style="text-align: justify !important;">
                                <h2 class="text-center"><b><?php echo $row['hp_title']; ?> </b></h2>
                                <ul>
                                  <p><?php echo $row['hp_description']; ?></p>
                                </ul>
                              </div>
                            </div>

                            <div class="card2">
                              <form action="../include/cms_content_edit?cms_hp_id=11" class="form" method="POST">
                                <div class="input-box">
                                  <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                                </div>
                                <div class="input-box">
                                  <label> <i class="lable_title"></i><br>Description:</label>
                                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                                </div>
                                <div class="input-box"><br>
                                  <button type="submit" name="update">Update</button>
                                </div>
                              </form>
                            </div>
                            <?php } ?>
                            </div>
                            <div class="cms_home_page_main">
                      <?php
                      require("../config/db_connection.php");
                      $query = "SELECT * FROM cms_hp WHERE `cms_hp`.`cms_hp_id` = '16'";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="home_page_card_header">
                          <div class="title">
                            <h3><?php echo $row['hp_title']; ?> </h3>
                          </div>

                          <div class="container">
                            <div class="card1">
                              <!-- <img class="cms_hp_img" src="../NC_Images/<?php echo $row['hp_image']; ?>" alt="<?php echo $row['hp_title'] ?>"> -->
                              <div class="col-md-5 mx-auto mb-4 card" style="background-color: #ebd7f5;">

                                <p class="text-center mb-3" style="text-align: justify !important;">
                                <h2 class="text-center"><b><?php echo $row['hp_title']; ?> </b></h2>
                                <ul>
                                  <p><?php echo $row['hp_description']; ?></p>
                                </ul>
                              </div>
                            </div>

                            <div class="card2">
                              <form action="../include/cms_content_edit?cms_hp_id=11" class="form" method="POST">
                                <div class="input-box">
                                  <label><i class="lable_title" aria-hidden="true"></i><br>Title:</label>
                                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_title']; ?></label>
                                </div>
                                <div class="input-box">
                                  <label> <i class="lable_title"></i><br>Description:</label>
                                  <label><i class="lable_item" aria-hidden="true"></i><?php echo $row['hp_description'] ?></label>
                                </div>
                                <div class="input-box"><br>
                                  <button type="submit" name="update">Update</button>
                                </div>
                              </form>
                            </div>
                            <?php } ?>
                            </div>

</body>

</html>