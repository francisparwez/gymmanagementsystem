<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
}

include '../db.php';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DASHBOARD :: Gym Management System</title>
        <?php include '../css/style.php'; ?>
    </head>

    <body>
        <?php include '../loader.php'; ?>

        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                <?php include '../nav.php'; ?>

                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <?php include '../sidebar.php'; ?>
                        <div class="pcoded-content">
                            <!-- Page-header start -->
                            <div class="page-header">
                                <div class="page-block">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="page-header-title">
                                                <h5 class="m-b-10">Dashboard</h5>
                                                <p class="m-b-0">For Gym Administrator</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Page-header end -->
                            <div class="pcoded-inner-content">
                                <!-- Main-body start -->
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <!-- Page-body start -->
                                        <div class="page-body">
                                            <div class="row">
                                                <!-- task, page, download counter  start -->
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="card">
                                                        <div class="card-block">
                                                            <div class="row align-items-center">
                                                                <div class="col-8">
                                                                    <h4 class="text-c-purple">Rs. 32000</h4>
                                                                    <h6 class="text-muted m-b-0">Staff Salaries Pending</h6>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    <i class="fa fa-bar-chart f-28"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="../salaries/viewAll.php">
                                                            <div class="card-footer bg-c-purple">
                                                                <div class="row align-items-center">
                                                                    <div class="col-9">
                                                                        <p class="text-white m-b-0">Go To Salaries</p>
                                                                    </div>
                                                                    <div class="col-3 text-right">
                                                                        <i class="fa fa-line-chart text-white f-16"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="card">
                                                        <div class="card-block">
                                                            <div class="row align-items-center">
                                                                <div class="col-8">
                                                                    <h4 class="text-c-green">Rs. 
                                                                            <?php
                                                                            $sql = "SELECT SUM(`packages`.`amount`) AS `totalPaymentPending` FROM `members`, `packages`, `payment` WHERE `members`.`packages` = `packages`.`id` AND `members`.`id` = `payment`.`members` AND `payment`.`isPaymentCleared` = 0;";
                                                                            $result = mysqli_query($conn, $sql);
                                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                                echo $row['totalPaymentPending'];
                                                                            }
                                                                        ?>
                                                                    </h4>
                                                                    <h6 class="text-muted m-b-0">Members Payments Pending</h6>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    <i class="fa fa-file-text-o f-28"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="../payment/viewAll.php">
                                                            <div class="card-footer bg-c-green">
                                                                <div class="row align-items-center">
                                                                    <div class="col-9">
                                                                        <p class="text-white m-b-0">Go To Payment</p>
                                                                    </div>
                                                                    <div class="col-3 text-right">
                                                                        <i class="fa fa-line-chart text-white f-16"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="card">
                                                        <div class="card-block">
                                                            <div class="row align-items-center">
                                                                <div class="col-8">
                                                                    <h4 class="text-c-red">
                                                                        <?php
                                                                        $sql = "SELECT COUNT(*) AS `count` FROM `members`";
                                                                        $result = mysqli_query($conn, $sql);
                                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                                            echo $row['count'];
                                                                        }
                                                                        ?>
                                                                    </h4>
                                                                    <h6 class="text-muted m-b-0">Total Members</h6>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    <i class="fa fa-calendar-check-o f-28"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="../members/viewAll.php">
                                                            <div class="card-footer bg-c-red">
                                                                <div class="row align-items-center">
                                                                    <div class="col-9">
                                                                        <p class="text-white m-b-0">Go To Members</p>
                                                                    </div>
                                                                    <div class="col-3 text-right">
                                                                        <i class="fa fa-line-chart text-white f-16"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Page-body end -->
                                    </div>
                                    <div id="styleSelector"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php include '../js/scripts.php'; ?>
</html>