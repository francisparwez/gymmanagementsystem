<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                <i class="fa fa-bars"></i>
            </a>

            <a href="../dashboard/dashboard.php" style="font-family: 'Shadows Into Light', cursive; font-weight: bold; font-size: 15px;">
                Gym Management System
            </a>
            <a class="mobile-options waves-effect waves-light">
                <i class="fas fa-dot-circle"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                        <i class="fa fa-window-maximize"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="header-notification">
                    <a href="#!" class="waves-effect waves-light">
                        <i class="fa fa-bell"></i>
                        <span class="badge bg-c-red"></span>
                    </a>
                    <ul class="show-notification">
                        <li>
                            <h6>Notifications</h6>
                            <label class="label label-danger">New</label>
                        </li>
                        <li class="waves-effect waves-light">
                            <div class="media">
                                <img class="d-flex align-self-center img-radius" src="assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="notification-user">John Doe</h5>
                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                    <span class="notification-time">30 minutes ago</span>
                                </div>
                            </div>
                        </li>
                        <li class="waves-effect waves-light">
                            <div class="media">
                                <img class="d-flex align-self-center img-radius" src="assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="notification-user">Joseph William</h5>
                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                    <span class="notification-time">30 minutes ago</span>
                                </div>
                            </div>
                        </li>
                        <li class="waves-effect waves-light">
                            <div class="media">
                                <img class="d-flex align-self-center img-radius" src="assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="notification-user">Sara Soudein</h5>
                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                    <span class="notification-time">30 minutes ago</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="user-profile header-notification">
                    <a href="#!" class="waves-effect waves-light">
                        <span><?php echo $_SESSION['username']; ?></span>
                        <i class="fa fa-user"></i>
                    </a>
                    <ul class="show-notification profile-notification">
                        <li class="waves-effect waves-light">
                            <a href="../admin/profile.php" style="color: #448aff;">
                                <i class="fa fa-user-circle"></i> View Profile
                            </a>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="../admin/addNewAdministrator.php" style="color: #448aff;">
                                <i class="fas fa-user-plus"></i> Add New Administrator
                            </a>
                        </li>
                        <li class="waves-effect waves-light">
                            <a href="../logout.php" style="color: #448aff;">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>