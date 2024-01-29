<?php
include "../z_db.php";
// $username = $_SESSION['username'];
?>
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <!-- <?php
                $rr = mysqli_query($con, "SELECT ufile FROM logo");
                $r = mysqli_fetch_row($rr);
                $ufile = $r[0];
                ?>

        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="uploads/logo/<?php print $ufile ?>" alt="" height="100">
            </span>
            <span class="logo-lg">
                <img src="uploads/logo/<?php print $ufile ?>" alt="" height="90">
            </span>
        </a> -->
        <!-- Light Logo-->
        <!-- <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="uploads/logo/<?php print $ufile ?>" alt="" height="100">
            </span>
            <span class="logo-lg">
                <img src="uploads/logo/<?php print $ufile ?>" alt="" height="90">
            </span>
        </a> -->
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link" data-key="t-analytics"> <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards"> Dashboard </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" role="button" aria-expanded="true" aria-controls="sidebarLanding" href="rules-regulation.php" class="nav-link" data-key="t-one-page">
                        <i class="ri-file-list-3-line"></i> <span data-key="t-landing">Terms and Conditions</span>
                    </a>
                </li>
                <li class="nav-item" id="profile-menu">
                    <a class="nav-link menu-link" role="button" aria-expanded="true" aria-controls="sidebarLanding" href="profile_add_edit.php" class="nav-link" data-key="t-one-page">
                        <i class="ri-account-box-line"></i> <span data-key="t-landing">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" role="button" aria-expanded="true" aria-controls="sidebarLanding" href="stall_booking.php">
                        <i class="ri-checkbox-multiple-line"></i> <span data-key="t-landing">Stall Booking</span>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" role="button" aria-expanded="true" aria-controls="sidebarLanding" href="publisher-report.php" class="nav-link" data-key="t-one-page">
                        <i class="ri-file-list-3-line"></i> <span data-key="t-landing">Report</span>
                    </a>
                </li> -->
                
                <li class="nav-item">
                    
                    <a class="nav-link menu-link" href="#sidebarEvent" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarLanding">
                        <i class="ri-profile-fill"></i> <span data-key="t-landing">Event Proposal</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarEvent">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="publisher_bookrelease.php" class="nav-link" data-key="t-one-page"> Book Release </a>
                            </li>
                            <li class="nav-item">
                                <a href="publisher_bookdiscussion.php" class="nav-link" data-key="t-nft-landing"> Book Discussion </a>
                            </li>
                            <li class="nav-item">
                                <a href="special_event_proposal.php" class="nav-link" data-key="t-nft-landing"> Special Event Proposal </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" role="button" aria-expanded="true" aria-controls="sidebarLanding" href="#sidebarReport" data-bs-toggle="collapse">
                        <i class="ri-file-list-3-line"></i> <span data-key="t-landing">Report</span>
                    </a>
                    <!-- <a class="nav-link menu-link" href="#sidebarPot" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarLanding">
                        <i class="ri-profile-fill"></i> <span data-key="t-landing">Event Proposal</span>
                    </a> -->
                    <div class="menu-dropdown collapse" id="sidebarReport">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="publisher-report.php" class="nav-link" data-key="t-one-page"> Profile Report </a>
                            </li>
                            <li class="nav-item">
                                <a href="publisher_bookrelease_report.php" class="nav-link" data-key="t-nft-landing"> Book Release Proposal Report </a>
                            </li>
                            <li class="nav-item">
                                <a href="publisher_book_discussion_report.php" class="nav-link" data-key="t-nft-landing"> Book Discussion Proposal Report </a>
                            </li>
                            <li class="nav-item">
                                <a href="publisher_special_event_proposal_report.php" class="nav-link" data-key="t-nft-landing"> Special Event Proposal Report </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarLanding">
                        <i class="ri-checkbox-multiple-line"></i> <span data-key="t-landing">Manage Services</span>
                    </a>
                </li>


                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPot" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarLanding">
                        <i class="ri-rhythm-fill"></i> <span data-key="t-landing">Manage Gallery</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarPot" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="add-gallery.php" class="nav-link" data-key="t-one-page"> Add New </a>
                            </li>
                            <li class="nav-item">
                                <a href="gallery.php" class="nav-link" data-key="t-nft-landing"> Gallery List </a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSl" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarLanding">
                        <i class="ri-image-fill"></i> <span data-key="t-landing">Manage Slider</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarSl" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="add-slider.php" class="nav-link" data-key="t-one-page"> Add New </a>
                            </li>
                            <li class="nav-item">
                                <a href="sliderlist.php" class="nav-link" data-key="t-nft-landing"> Sliders List </a>
                            </li>
                            <li class="nav-item">
                                <a href="static-home.php" class="nav-link" data-key="t-nft-landing"> Static Sliders</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarX" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarLanding">
                        <i class="ri-chrome-fill"></i> <span data-key="t-landing">Manage Social</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarX" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="add-social.php" class="nav-link" data-key="t-one-page"> Add New </a>
                            </li>
                            <li class="nav-item">
                                <a href="social-links.php" class="nav-link" data-key="t-nft-landing">Social List </a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarT" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarLanding">
                        <i class="ri-message-line"></i> <span data-key="t-landing">Manage Testimony</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarT" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="add-testimony.php" class="nav-link" data-key="t-one-page">New Testimony</a>
                            </li>
                            <li class="nav-item">
                                <a href="testimonylist.php" class="nav-link" data-key="t-nft-landing"> All Testimonies </a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarW" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarLanding">
                        <i class="ri-rocket-line"></i> <span data-key="t-landing"> Why Choose Us</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarW" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="add-why.php" class="nav-link" data-key="t-one-page"> Add New </a>
                            </li>
                            <li class="nav-item">
                                <a href="why-us.php" class="nav-link" data-key="t-nft-landing"> All lists </a>
                            </li>
                        </ul>
                    </div>
                </li> -->


                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarK" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarLanding">
                        <i class="ri-tools-fill"></i> <span data-key="t-landing"> Site Configuration </span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarK" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="site-settings.php" class="nav-link" data-key="t-one-page"> Site Settings </a>
                            </li>
                            <li class="nav-item">
                                <a href="section-title.php" class="nav-link" data-key="t-nft-landing"> Section Titles </a>
                            </li>
                            <li class="nav-item">
                                <a href="updatelogo.php" class="nav-link" data-key="t-nft-landing"> Update Logo </a>
                            </li>
                            <li class="nav-item">
                                <a href="updatecontact.php" class="nav-link" data-key="t-nft-landing"> Update Contact </a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarX" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarLanding">
                        <i class="ri-file-list-3-line"></i> <span data-key="t-landing">Report</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarX" style="">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="stall_booking_report.php" class="nav-link" data-key="t-nft-landing">Stall Booking </a>
                            </li>
                            <li class="nav-item">
                                <a href="quiz_reg_report.php" class="nav-link" data-key="t-nft-landing">Quiz Contest Report </a>
                            </li>
                            <li class="nav-item">
                                <a href="queue_report.php" class="nav-link" data-key="t-nft-landing">Virtual Queue Report </a>
                            </li>
                        </ul>
                    </div>
                </li> -->











            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>