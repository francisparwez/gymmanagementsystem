<?php

    if (session_status() == PHP_SESSION_NONE) {
            session_start();
    }
    if (!isset($_SESSION['username'])) {
        header('location: ../login.php');
    }

    include '../db.php';    
    $insert = false;
    $usernameExists = false;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) 
    {
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        $usernameQuery = "SELECT * FROM admin WHERE username='$username'";
        $result = mysqli_query($conn, $usernameQuery);
        
        $usernameCount = mysqli_num_rows($result);
        
        if ($usernameCount > 0) 
        {
            $usernameExists = true;
        }
        else
        {
            $insertQuery = "INSERT INTO admin (username, firstName, lastName, password) VALUES ('$username', '$firstName', '$lastName', '$encryptedPassword')";
            
            $insertResult = mysqli_query($conn, $insertQuery);
            
            if ($insertResult) 
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
        <title>ADD A NEW ADMINISTRATOR :: Gym Management System</title>
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
                            
                            <div class="page-header">
                                <div class="page-block">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="page-header-title">
                                                <h5 class="m-b-10">
                                                    Administrator
                                                </h5>
                                                <p class="m-b-0">Add A New One</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php
                                if ($insert) {
                                    echo 
                                    "<div id='insertAlert' class='alert alert-info alert-dismissible fade show' role='alert'>
                                        <strong>SUCCESS!</strong> NEW ADMIN HAS BEEN ADDED
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                          <span aria-hidden='true'>×</span>
                                        </button>
                                      </div>";
                                }
                                if ($usernameExists) {
                                    echo 
                                    "<div id='usernameAlert' class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong>WARNING!</strong> USERNAME ALREADY REGISTERED
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
                                                            <h5>Enter New Admin's Information</h5>
                                                        </div>
                                                        <div class="card-block">
                                                            <form class="form-material" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                                                                <div class="form-group form-default">
                                                                    <input type="text" name="firstName" class="form-control" required="">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">First Name</label>
                                                                </div>
                                                                <div class="form-group form-default">
                                                                    <input type="text" name="lastName" class="form-control" required="">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Last Name</label>
                                                                </div>
                                                                <div class="form-group form-default">
                                                                    <input type="text" name="username" class="form-control" required="">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Username</label>
                                                                </div>
                                                                <div class="form-group form-default">
                                                                    <input type="text" name="password" class="form-control" required="" onfocus="(this.type = 'password')">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Password</label>
                                                                </div>
                                                                <div>
                                                                    <button class="btn waves-effect waves-light hor-grd btn-grd-info " type="submit" name="submit">
                                                                        <i class="fas fa-plus"></i> Add Administrator
                                                                    </button>
<!--                                                                    <a href="../members/viewAll.php" class="btn waves-effect waves-light hor-grd btn-grd-info" style="color:white;">
                                                                        <i class="fas fa-eye"></i> See All Member
                                                                    </a>-->
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
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
    <script type="text/javascript">
            $(document).ready(function () {
            window.setTimeout(function() {
                $("#insertAlert").fadeTo(1000, 0).slideUp(1000, function(){
                    $(this).remove(); 
                });
            }, 3000);
            });
            
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
            window.setTimeout(function() {
                $("#usernameAlert").fadeTo(1000, 0).slideUp(1000, function(){
                    $(this).remove(); 
                });
            }, 3000);
            });            
        </script>
    
</html>