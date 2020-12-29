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
        
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $joinDate = mysqli_real_escape_string($conn, $_POST['joinDate']);
        $contactNo = "+923" . mysqli_real_escape_string($conn, $_POST['contactNo']);
        $cnic = mysqli_real_escape_string($conn, $_POST['cnic']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);
        
        if (isset($firstName) && isset($lastName) && isset($joinDate) && isset($contactNo) && isset($cnic) && isset($salary)) {
            
            $query = "INSERT INTO `staff` (`firstName`, `lastName`, `joinDate`, `contactNo`, `cnic`, `salary`) VALUES ('$firstName', '$lastName', '$joinDate', '$contactNo', '$cnic', '$salary')"; 
            
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
        <title>CREATE NEW STAFF MEMBERS :: Gym Management System</title>
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
                                                <h5 class="m-b-10">Staff Members</h5>
                                                <p class="m-b-0">Create A New One</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <?php
                                if ($insert) {
                                    echo "<div id='addSuccess' class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <strong>SUCCESS! </strong>NEW MEMBERS SUCCESSFULLY
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
                                                            <h5>Enter Staff Members Information</h5>
                                                        </div>
                                                        <div class="card-block">
                                                            <form class="form-material" action="createNew.php" method="POST">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">First Name</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" name="firstName" class="form-control" placeholder="Enter Staff Member's First Name" required="This Field Is Mandatory">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Last Name</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" name="lastName" class="form-control" placeholder="Enter Staff Member's Last Name" required="This Field Is Mandatory">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Join Date</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" placeholder="Select Staff Member's Join Date" name="joinDate" onfocus="(this.type = 'date')" onblur="(this.type = 'text')" required="This Field Is Mandatory">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Contact No.</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text" style="color: white; background-color: black;padding: 7px 12px 7px 12px;border-top-left-radius: 15px;border-bottom-left-radius: 15px; font-size: 18px;">+923</span>
                                                                            <input type="text" style="padding-left: 10px;" class="form-control" id="contactNoEdit" placeholder="Enter Staff Member's Phone Number" name="contactNo" MaxLength="10" required="This Field Is Mandatory">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">CNIC</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="cnic" name="cnic" placeholder="Enter Staff Member's CNIC" MaxLength="15" required="This Field Is Mandatory">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Salary</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="salary" name="salary" placeholder="Enter Staff Member's Salary" MaxLength="5" required="This Field Is Mandatory">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div>
                                                                    <button class="btn waves-effect waves-light hor-grd btn-grd-primary " type="submit">
                                                                        <i class="fas fa-plus"></i> Add Staff Member
                                                                    </button>
                                                                    <a href="../staff/viewAll.php" class="btn waves-effect waves-light hor-grd btn-grd-success" style="color:white;">
                                                                        <i class="fas fa-eye"></i> See All Staff Member
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
                
                $("#joinDate").datepicker({ dateFormat: 'dd-mm-yyyy' });


            });
            
        </script>           
        <script type="text/javascript">
            $('input[name="contactNo"]').keydown(function () {    
    
                if (event.keyCode == 8 || event.keyCode == 9
                    || event.keyCode == 27 || event.keyCode == 13
                    || (event.keyCode == 65 && event.ctrlKey === true))
                    return;
                if ((event.keyCode < 48 || event.keyCode > 57))
                    event.preventDefault();

                var length = $(this).val().length;

                if (length == 2)
                    $(this).val($(this).val() + '-');

            });

            $('input[name="cnic"]').keydown(function () {    

                if (event.keyCode == 8 || event.keyCode == 9
                    || event.keyCode == 27 || event.keyCode == 13
                    || (event.keyCode == 65 && event.ctrlKey === true))
                    return;
                if ((event.keyCode < 48 || event.keyCode > 57))
                    event.preventDefault();

                var length = $(this).val().length;

                if (length == 5 || length == 13)
                    $(this).val($(this).val() + '-');

            });
            
            
            $('input[name="salary"]').keydown(function () {    

                if ( event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )
                    return;
                if ((event.keyCode < 48 || event.keyCode > 57))
                    event.preventDefault();

                var length = $(this).val().length;

                if (length == 5 || length == 13)
                    $(this).val($(this).val() + '-');

            });
            
            
        </script>
    </body>
</html>