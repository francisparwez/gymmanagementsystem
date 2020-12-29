<?php     
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    $components = explode('/', $path);
    $directory = $components[2];
    $first_part = $components[3];
?>
<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">                                        
                <div class="user-details">
                    <span id="more-details" style="font-size: 25px;"><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?></span>
                    <span id="more-details" style="font-size: 15px;">Administrator</span>
                </div>
            </div>
        </div>
        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation"> </div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?php if ($first_part=="dashboard.php") {echo "active"; } else  {echo "pcoded-hasmenu";} ?>">
                <a href="../dashboard/dashboard.php" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            
            <li class="pcoded-hasmenu <?php if ($directory=="staff") {echo " pcoded-trigger active"; } else  {echo " ";} ?>">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fas fa-user"></i></span>
                    Staff
                    <i class="fas fa-angle-down" style="float: right; padding-top: 6px;"></i>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?php if ($directory=="staff" && $first_part=="viewAll.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../staff/viewAll.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"></span>
                            <span class="pcoded-mtext"><i class="fas fa-eye"></i>&nbsp;&nbsp;View All</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if ($directory=="staff" && $first_part=="createNew.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../staff/createNew.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"></i></span>
                            <span class="pcoded-mtext"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Create New</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if ($directory=="staff" && $first_part=="attendance.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../staff/attendance.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"></i></span>
                            <span class="pcoded-mtext"><i class="far fa-bell"></i>&nbsp;&nbsp;Attendance</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="pcoded-hasmenu <?php if ($directory=="salaries") {echo " pcoded-trigger active"; } else  {echo " ";} ?>">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fas fa-info"></i></span>
                    Salaries
                    <i class="fas fa-angle-down" style="float: right; padding-top: 6px;"></i>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?php if ($directory=="salaries" && $first_part=="viewAll.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../salaries/viewAll.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext"><i class="fas fa-eye"></i>&nbsp;&nbsp;View All</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if ($directory=="salaries" && $first_part=="createNew.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../salaries/createNew.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Create New</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li class="pcoded-hasmenu <?php if ($directory=="members") {echo " pcoded-trigger active"; } else  {echo " ";} ?>">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fas fa-user"></i></span>
                    Members
                    <i class="fas fa-angle-down" style="float: right; padding-top: 6px;"></i>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?php if ($directory=="members" && $first_part=="viewAll.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../members/viewAll.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"></span>
                            <span class="pcoded-mtext"><i class="fas fa-eye"></i>&nbsp;&nbsp;View All</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if ($directory=="members" && $first_part=="createNew.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../members/createNew.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"></i></span>
                            <span class="pcoded-mtext"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Create New</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if ($directory=="members" && $first_part=="attendance.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../members/attendance.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"></i></span>
                            <span class="pcoded-mtext"><i class="far fa-bell"></i>&nbsp;&nbsp;Attendance</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu <?php if ($directory=="membershipDetails") {echo " pcoded-trigger active"; } else  {echo " ";} ?>">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fas fa-info"></i></span>
                    Membership Details
                    <i class="fas fa-angle-down" style="float: right; padding-top: 6px;"></i>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?php if ($directory=="membershipDetails" && $first_part=="viewAll.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../membershipDetails/viewAll.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext"><i class="fas fa-eye"></i>&nbsp;&nbsp;View All</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if ($directory=="membershipDetails" && $first_part=="createNew.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../membershipDetails/createNew.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create New</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu <?php if ($directory=="payment") {echo " pcoded-trigger active"; } else  {echo " ";} ?>">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fas fa-money-check-alt"></i></span>
                    Payment
                    <i class="fas fa-angle-down" style="float: right; padding-top: 6px;"></i>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?php if ($directory=="payment" && $first_part=="viewAll.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../payment/viewAll.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext"><i class="fas fa-eye"></i>&nbsp;&nbsp;View All</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if ($directory=="payment" && $first_part=="createNew.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../payment/createNew.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext"><i class="fas fa-cart-plus"></i>&nbsp; &nbsp;Create New</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu <?php if ($directory=="packages") {echo " pcoded-trigger active"; } else  {echo " ";} ?>">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fas fa-box-open"></i></span>
                    Packages
                    <i class="fas fa-angle-down" style="float: right; padding-top: 6px;"></i>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?php if ($directory=="packages" && $first_part=="viewAll.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../packages/viewAll.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"></span>
                            <span class="pcoded-mtext"><i class="fas fa-eye"></i>&nbsp;&nbsp;View All</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if ($directory=="packages" && $first_part=="createNew.php") {echo "active"; } else  {echo "";} ?>">
                        <a href="../packages/createNew.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"></i></span>
                            <span class="pcoded-mtext"><i class="fas fa-folder-plus"></i>&nbsp; &nbsp;Create New</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>                                   
        </ul>
    </div>
</nav>