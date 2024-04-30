<!-- css -->
<link rel="stylesheet" href="../css/dashboard.css">
<!-- boxicon icon -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<!-- pia char  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div class="dashboard">
    <div class="header">
        <header>
            <div class="content_title">
                <h1>Dashboard</h1>
                <ul class="navigation">
                    <li class="navigation-item">
                        <a href="../include/dashboard">Dashboard</a>
                    </li>
                    <li class="navigation-icon">
                        <i class="bx bx-chevron-right dropdown"> </i>
                    </li>
                </ul>
            </div>
        </header>
    </div>
    <div class="main">
        <main>
            <!-- <P>Lorem ipsum dolor sit amet, consectetur adipisicing elits. Eligendi laudantium voluptates saepe delectus voluptatibus pariatur aspernatur blanditiis fuga non! Molestias modi enim et, dolor exercitationem minus voluptate. Sapiente fugiat, quidem, iusto placeat itaque nihil aperiam, porro adipisci soluta officia sed! Accusantium amet doloribus perspiciatis molestiae voluptate, inventore ratione quis. Eos rem quaerat dolore facilis veritatis et, enim esse suscipit minima alias qui earum quo cupiditate dignissimos. Sint magni odit possimus illo. Quo eos deserunt facere ullam dicta ducimus! Iure, maxime eveniet. Nulla ab sed nam unde! At perferendis enim nesciunt explicabo error tenetur ipsam, quas cumque, cum ullam deserunt dolorem.</P> -->
            <div class="container">


                <div class="box-g">
                    <div class="boxs">
                        <div class="dbox dbox--color-1">
                            <div class="dbox__icon">
                                <i class="glyphicon glyphicon-cloud"></i>
                            </div>
                            <div class="dbox__body">
                                <span class="dbox__count">
                                    <?php require_once('../config/db_connection.php');
                                    $query = "SELECT COUNT(*) AS total_entries FROM `user_login`";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        echo $row['total_entries'];
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </span>
                                <span class="dbox__title">Total User</span>
                            </div>

                            <div class="dbox__action">
                                <a href="manage_user" class="dbox__action__btn">More Info</a>
                            </div>
                        </div>
                    </div>
                    <div class="boxs">
                        <div class="dbox dbox--color-2">
                            <div class="dbox__icon">
                                <i class="glyphicon glyphicon-download"></i>
                            </div>
                            <div class="dbox__body">
                                <span class="dbox__count">
                                    <?php require_once('../config/db_connection.php');
                                    $query = "SELECT COUNT(*) AS total_entries FROM `volunteers`";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        echo $row['total_entries'];
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </span>
                                <span class="dbox__title">Total Volunteer</span>
                            </div>

                            <div class="dbox__action">
                                <a href="manage_volunteer" class="dbox__action__btn">More Info</a>
                            </div>
                        </div>
                    </div>
                    <div class="boxs">
                        <div class="dbox dbox--color-5">
                            <div class="dbox__icon">
                                <i class="glyphicon glyphicon-cloud"></i>
                            </div>
                            <div class="dbox__body">
                                <span class="dbox__count">
                                    <?php require_once('../config/db_connection.php');
                                    $query = "SELECT COUNT(*) AS total_entries FROM `v_required_area`";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        echo $row['total_entries'];
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </span>
                                <span class="dbox__title">Volunteer Needy Place</span>
                            </div>

                            <div class="dbox__action">
                                <a href="volunteer_required_area" class="dbox__action__btn">More Info</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-g">
                    <div class="boxs">
                        <div class="dbox dbox--color-3">
                            <div class="dbox__icon">
                                <i class="glyphicon glyphicon-cloud"></i>
                            </div>
                            <div class="dbox__body">
                                <span class="dbox__count">
                                    <?php require_once('../config/db_connection.php');
                                    $query = "SELECT COUNT(*) AS total_entries FROM `donate_food` WHERE `donate_food`.`status` = 'pending'";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        echo $row['total_entries'];
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </span>
                                <span class="dbox__title">Food Donation Request</span>
                            </div>

                            <div class="dbox__action">
                                <a href="food_donate_req" class="dbox__action__btn">More Info</a>
                            </div>
                        </div>
                    </div>
                    <div class="boxs">
                        <div class="dbox dbox--color-2">
                            <div class="dbox__icon">
                                <i class="glyphicon glyphicon-download"></i>
                            </div>
                            <div class="dbox__body">
                                <span class="dbox__count">
                                    <?php require_once('../config/db_connection.php');
                                    $query = "SELECT COUNT(*) AS total_entries FROM `donate_book`WHERE `status` = 'pending'";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        echo $row['total_entries'];
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </span>
                                <span class="dbox__title">Book Donation Request</span>
                            </div>

                            <div class="dbox__action">
                                <a href="book_donate_req" class="dbox__action__btn">More Info</a>
                            </div>
                        </div>
                    </div>
                    <div class="boxs">
                        <div class="dbox dbox--color-4">
                            <div class="dbox__icon">
                                <i class="glyphicon glyphicon-cloud"></i>
                            </div>
                            <div class="dbox__body">
                                <span class="dbox__count">
                                    <?php require_once('../config/db_connection.php');
                                    $query = "SELECT COUNT(*) AS total_entries FROM `applied_book` WHERE `applied_book`.`status` = 'pending'";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        echo $row['total_entries'];
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </span>
                                <span class="dbox__title">Requested Book by user</span>
                            </div>

                            <div class="dbox__action">
                                <a href="volunteer_required_area" class="dbox__action__btn">More Info</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-g">
                    <div class="boxs">
                        <div class="dbox dbox--color-1">
                            <div class="dbox__icon">
                                <i class="glyphicon glyphicon-cloud"></i>
                            </div>
                            <div class="dbox__body">
                                <span class="dbox__count">
                                    <?php require_once('../config/db_connection.php');
                                    $query = "SELECT COUNT(*) AS total_entries FROM `donate_food`";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        echo $row['total_entries'];
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </span>
                                <span class="dbox__title">Total Food Donation</span>
                            </div>

                        </div>
                    </div>
                    <div class="boxs">
                        <div class="dbox dbox--color-2">
                            <div class="dbox__icon">
                                <i class="glyphicon glyphicon-download"></i>
                            </div>
                            <div class="dbox__body">
                                <span class="dbox__count">
                                    <?php require_once('../config/db_connection.php');
                                    $query = "SELECT COUNT(*) AS total_entries FROM `donate_book`";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        echo $row['total_entries'];
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </span>
                                <span class="dbox__title">Total Book Donation</span>
                            </div>

                        </div>
                    </div>
                    <div class="boxs">
                        <div class="dbox dbox--color-5">
                            <div class="dbox__icon">
                                <i class="glyphicon glyphicon-download"></i>
                            </div>
                            <div class="dbox__body">
                                <span class="dbox__count">
                                    <?php require_once('../config/db_connection.php');
                                    $query = "SELECT COUNT(*) AS total_entries FROM `donate_food` WHERE `donate_food`.`freq_of_donation`!='One time' AND `donate_food`.`status`='approved'";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        echo $row['total_entries'];
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </span>
                                <span class="dbox__title">Total Daily Food Donation</span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>
</div>