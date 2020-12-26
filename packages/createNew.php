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
        
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        
        if (isset($name) && isset($amount) && isset($description)) {
            
            $query = "INSERT INTO `packages`(`name`, `amount`, `description`) VALUES ('$name', $amount, '$description')";
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
        <title>CREATE NEW PACKAGES :: Gym Management System</title>
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
                                                <h5 class="m-b-10">Packages</h5>
                                                <p class="m-b-0">Create A New One</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <?php
                                if ($insert) {
                                    echo "<div id='addSuccess' class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>SUCCESS! </strong>NEW PACKAGE SUCCESSFULLY
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
                                                            <h5>Enter Package Information</h5>
                                                        </div>
                                                        <div class="card-block">
                                                            <form class="form-material" action="createNew.php" method="POST">
                                                                <div class="form-group form-default">
                                                                    <input type="text" class="form-control" required="" name="name" >
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Package Name</label>
                                                                </div>
                                                                <div class="form-group form-default">
                                                                    <input type="number" class="form-control" required="" name="amount">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Package Amount</label>
                                                                </div>                                                                
                                                                <div class="form-group form-default">
                                                                    <textarea class="form-control" required="" style="padding-top: 10px; box-sizing: border-box;" name="description"></textarea>
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Package Description</label>
                                                                </div>
                                                                <div>
                                                                    <button class="btn waves-effect waves-light hor-grd btn-grd-primary " type="submit">
                                                                        <i class="fas fa-plus"></i> Add Package
                                                                    </button>
                                                                    <a href="../packages/viewAll.php" class="btn waves-effect waves-light hor-grd btn-grd-info" style="color:white;">
                                                                        <i class="fas fa-eye"></i> See All Package
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