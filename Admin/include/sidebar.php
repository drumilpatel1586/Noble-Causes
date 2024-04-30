<!-- css -->
<link rel="stylesheet" href="../css/sidebar.css">
<!-- boxicon icon -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<!-- jquery cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="../js/script.js"></script>

<nav class="sidebar">
    <header>
        <a  href="dashboard">
            <div class="admin_logo">
                <span class="image">
                    <img src="../image/logo-icon.png" alt="logo">
                </span>

                <div class="text admin_header_text">
                    <span class="portal_name">Noble Causes</span>
                    <span class="admin">Admin</span>
                </div>
            </div>
        </a>
    </header>
    <div class="menu">

        <div class="item"><a href="dashboard"><i>Dashboard</i></a></div>
        <!-- <div class="item"><a href="manage_user"><i>Manage User</i></a></div>
        <div class="item"><a href="manage_volunteer"><i>Manage Volunteer</i></a></div>
        <div class="item"><a href="manage_daily_donated_food"><i>Manage Daily Donated Food</i></a></div> -->
        <div class="item">
            <a class="sub_menu_btn"><i>Approve Request</i>
                <i class="bx bx-chevron-right dropdown"></i>
            </a>

            <div class="sub_menu">

                <div class="sub_menu_item">
                    <a href="food_donate_req"><i href="#">Donated Food</i></a>
                    <a href="book_donate_req"><i href="#">Donated Book</i></a>
                    <a href="requested_book"><i href="#">Requested Book</i></a>
                    <a href="needy_place"><i>Needy Place</i></a>
                </div>
            </div>

        </div>
        <div class="item">
            <a class="sub_menu_btn"><i>Cancelled Request</i>
                <i class="bx bx-chevron-right dropdown"></i>
            </a>
            <div class="sub_menu">
                <div class="sub_menu_item">
                    <a href="cancelled_food_pickup"><i href="#">Cancelled Food</i></a>
                    <a href="cancelled_book_pickup"><i href="#">Cancelled Book</i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <a class="sub_menu_btn"><i>Requested Book</i>
                <i class="bx bx-chevron-right dropdown"></i>
            </a>
            <div class="sub_menu">
                <div class="sub_menu_item">
                    <a href="delivered_book"><i href="#">Delivered Book</i></a>
                    <a href="not_return_book"><i href="#">Not Return Book</i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <a class="sub_menu_btn"><i>Manage</i>
                <i class="bx bx-chevron-right dropdown"></i>
            </a>
            <div class="sub_menu">
                <div class="sub_menu_item">
                    <a href="manage_daily_donated_food"><i href="#">Daily Donated Food</i></a>
                    <a href="manage_volunteer"><i href="#">Manage Volunteer</i></a>
                    <a href="manage_user"><i href="#">Manage User</i></a>
                    <a href="manage_needy_place"><i href="#">needy Place</i></a>
                    <a href="contact_us"><i href="#">User Question</i></a>
                    <a href="volunteer_required_area"><i href="#">Volunteer Req Area</i></a>
                    <!-- <a href="requested_book"><i href="#">Requested Book</i></a> -->
                </div>
            </div>
        </div>
        <div class="item">
            <a class="sub_menu_btn"><i>Masters</i>
                <i class="bx bx-chevron-right dropdown"></i>
            </a>
            <div class="sub_menu">
                <div class="sub_menu_item">
                    <a href="bdform_coursemaster"><i href="#">Course Master</i></a>
                    <!-- <a href="requested_book"><i href="#">Requested Book</i></a> -->
                </div>
            </div>
        </div>
        <div class="item"></div>
        <div class="item"><a class="sub_menu_btn"><i>CMS</i>
                <i class="bx bx-chevron-right dropdown"></i></a>
            <div class="sub_menu">
                <div class="item">
                    <a class="sub_menu_btn"><i>Pages</i>
                        <i class="bx bx-chevron-right dropdown"></i>
                    </a>
                    <div class="sub_menu">
                        <div class="sub_menu_item">
                            <a href="cms_home_page"><i href="#">Home Page</i></a>
                            <a href="cms_food_donation_page"><i href="#">Food Donate</i></a>
                            <a href="cms_book_donation"><i href="#">Book Donate</i></a>
                            <a href="cms_about_us"><i href="#">About US</i></a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <a class="sub_menu_btn"><i>Forms</i>
                        <i class="bx bx-chevron-right dropdown"></i>
                    </a>
                    <div class="sub_menu">
                        <div class="sub_menu_item">
                            <a href="cms_food_donation_form"><i href="#">Food Donation</i></a>
                            <a href="cms_book_donation_form"><i href="#">Book Donation</i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item"><a href="../calendar/calender"><i>Calender</i></a></div>
        <div class="item"><a href="admin_logout"><i>Logout</i></a></div>
    </div>

</nav>