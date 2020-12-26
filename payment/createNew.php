<?php
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
    }
    if (!isset($_SESSION['username'])) {
        header('location: ../login.php');
    }
    include '../db.php'; 
    $insert = false;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {        
        $members = mysqli_real_escape_string($conn, $_POST["member"]);
        $paymentOfMonth = mysqli_real_escape_string($conn, $_POST["paymentOfMonth"]);
        $isPaymentCleared = mysqli_real_escape_string($conn, $_POST["isPaymentCleared"]);
        $paymentDate = mysqli_real_escape_string($conn, $_POST["paymentDate"]);
        
        if (isset($members) && isset($paymentOfMonth) && isset($isPaymentCleared) && isset($paymentDate)) {
            
            $query = "INSERT INTO `payment` (`members`, `paymentOfMonth`, `isPaymentCleared`, `paymentDate`) VALUES ($members, '$paymentOfMonth', $isPaymentCleared, '$paymentDate')";
            
            $result = mysqli_query($conn, $query);            
            if ($result) 
            {
                $insert = true;
            } 
            else
            {
                echo '<script language="javascript"> alert(' . mysqli_error($conn) . ') </script>';
            }            
        }      
    }
    

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>CREATE NEW PAYMENT :: Gym Management System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="icon" href="../img/gym-icon.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
        <link href="../css/waves.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/themify-icons.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Langar&display=swap" rel="stylesheet">
        <link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>        
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        
        <style>
            label {
                font-size: 16px !important;
            }
        </style>
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
                                                <h5 class="m-b-10">Payment</h5>
                                                <p class="m-b-0">Enter Payments That Were Made</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <?php
                                if ($insert) {
                                    echo "<div id='addSuccess' class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <strong>SUCCESS! </strong>NEW PAYMENT SUCCESSFULLY
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                          <span aria-hidden='true'>×</span>
                                        </button>
                                      </div>";
                                }
                                ?>
                            <div class="pcoded-inner-content">
                                <!-- Main-body start -->
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <!-- Page-body start -->
                                        <div class="page-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Enter Payment's Information</h5>
                                                        </div>
                                                        <div class="card-block">
                                                            <form class="form-material" action="createNew.php" method="POST">
                                                                
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Member</label>
                                                                    <div class="col-sm-10">
                                                                        <select name="member" id="select" class="form-control">
                                                                            <option value="0">Select Member</option>
                                                                            <?php 
                                                                                $sql = "SELECT * FROM `members`";
                                                                                $result = mysqli_query($conn, $sql);
                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                    echo '<option value="' . $row['id'] . '">' . $row['firstName'] . ' ' . $row['lastName'] . '</option>';
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Payment Of Month</label>
                                                                    <div class="col-sm-10">
                                                                        <select name="paymentOfMonth" id="month" class="form-control">
                                                                            <option value="0">Select Month</option>
                                                                            <option value="January">January</option>
                                                                            <option value="February">February</option>
                                                                            <option value="March">March</option>
                                                                            <option value="April">April</option>
                                                                            <option value="May">May</option>
                                                                            <option value="June">June</option>
                                                                            <option value="July">July</option>
                                                                            <option value="August">August</option>
                                                                            <option value="September">September</option>
                                                                            <option value="October">October</option>
                                                                            <option value="November">November</option>
                                                                            <option value="December">December</option>
                                                                        </select>
                                                                    </div>
                                                                </div>                                                               
                                                                
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Payment Date</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" placeholder="Select Member's Join Date" name="paymentDate" onfocus="(this.type = 'date')" onblur="(this.type = 'text')" required="This Field Is Mandatory">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Is Payment Cleared</label>
                                                                    <div class="col-sm-10">
                                                                        <label class="radio-inline"><input type="radio" id="memYes" name="isPaymentCleared" value="1">&nbsp;YES</label>
                                                                        <label class="radio-inline"><input type="radio" id="memNo" name="isPaymentCleared" value="0">&nbsp;NO</label>
                                                                    </div>
                                                                </div> 
                                                                
                                                                <div>
                                                                    <button class="btn waves-effect waves-light hor-grd btn-grd-success " type="submit">
                                                                        <i class="fas fa-plus"></i> Add Payment
                                                                    </button>
                                                                    <a href="../payment/viewAll.php" class="btn waves-effect waves-light hor-grd btn-grd-info" style="color:white;">
                                                                        <i class="fas fa-eye"></i> See All Payments
                                                                    </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="../js/jquery.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../js/popper.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/excanvas.js" type="text/javascript"></script>
        <script src="../js/waves.min.js" type="text/javascript"></script>
        <script src="../js/jquery.slimscroll.js" type="text/javascript"></script>
        <script src="../js/modernizr.js" type="text/javascript"></script>
        <script src="../js/SmoothScroll.js" type="text/javascript"></script>
        <script src="../js/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
        <script src="../js/Chart.js" type="text/javascript"></script>
        <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
        <script src="../js/gauge.js" type="text/javascript"></script>
        <script src="../js/serial.js" type="text/javascript"></script>
        <script src="../js/light.js" type="text/javascript"></script>
        <script src="../js/pie.min.js" type="text/javascript"></script>
        <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
        <script src="../js/pcoded.min.js" type="text/javascript"></script>
        <script src="../js/vertical-layout.min.js" type="text/javascript"></script>
        <script src="../js/custom-dashboard.js" type="text/javascript"></script>    
        <script src="../js/script_1.js" type="text/javascript"></script>
        
        <script type="text/javascript">

            $(document).ready(function () {

                window.setTimeout(function() {
                    $("#addSuccess").fadeTo(1000, 0).slideUp(1000, function(){
                        $(this).remove(); 
                    });
                }, 3000);

            });
            
        </script>
    </body>
</html>