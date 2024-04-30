<link rel="stylesheet" href="nav.css?v=2">
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

<nav>
    <div class="navbar">
        <i class='bx bx-menu'></i>
        <div class="logo"><a href="index"><img src="logo2.png" alt=""></div>
        <div class="nav-links">
            <div class="sidebar-logo">
                <i class='bx bx-x'></i>
            </div>
            <ul class="links">
                <li><a href="index">Home</a></li>
                <li><a href="aboutUs">About Us</a></li>
                <li>
                    <a href="#">Our Services</a>
                    <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
                    <ul class="htmlCss-sub-menu sub-menu">
                        <li><a href="food">Food Donation</a></li>
                        <li><a href="education">Book Donation</a></li>
                        <!-- <li><a href="#">Disaster Fund</a></li> -->
                    </ul>
                </li>
                
                <li><a href="volunteer">Be A Volunteer</a></li>

                <li><a href="contactUs">Contact Us</a></li>
                <?php if(isset($_SESSION['email'])){ ?>
                <li >
                    <a href="needy_place">Needy Place</a>
                </li>
                <li id="login">
                    <a href="logout">Logout</a>
                </li>
                <?php }else{?>
                <li id="login">
                    <a href="login">Login</a>
                </li>
                <?php }?>
            </ul>
        </div>
        <?php if(isset($_SESSION['email'])){ ?>
        <div class="search-box">
           <a href="profile"><i class='bx bx-user'></i></a>     
        </div>
        <?php }?>

    </div>
    <script src="navbar.js?v=2"></script>
</nav>