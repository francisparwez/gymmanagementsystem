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

if (isset($_POST['btnSubmitDetails'])) {
    $firstNameEdit = mysqli_real_escape_string($conn, $_POST['firstNameEdit']);
    $lastNameEdit = mysqli_real_escape_string($conn, $_POST['lastNameEdit']);
    $usernameEdit = mysqli_real_escape_string($conn, $_POST['usernameEdit']);

    if (!empty($firstNameEdit) || !empty($lastNameEdit) || !empty($usernameEdit)) {
        $username_ = $_SESSION['username'];
        $updateQuery = "UPDATE `admin` SET `username` = '$usernameEdit', `firstName` = '$firstNameEdit', `lastName` = '$lastNameEdit' WHERE `username` = '$username_'";
        $result = mysqli_query($conn, $updateQuery);
        if ($result) {
            header('location: ../logout.php');
        } else {
            echo '<script language="javascript"> alert(' . mysqli_error($conn) . ') </script>';
        }
    }
} else if (isset($_POST['btnSubmitPassword'])) {
    $currentPasswordEdit = mysqli_real_escape_string($conn, $_POST['currentPasswordEdit']);
    $newPasswordEdit = mysqli_real_escape_string($conn, $_POST['newPasswordEdit']);
    $confirmPasswordEdit = mysqli_real_escape_string($conn, $_POST['confirmPasswordEdit']);

    if (!empty($currentPasswordEdit) || !empty($newPasswordEdit) || !empty($confirmPasswordEdit)) {
        if ($newPasswordEdit === $confirmPasswordEdit) {
            $username_ = $_SESSION['username'];
            $sqlUsername = "SELECT * FROM admin WHERE username='$username_'";
            $result = mysqli_query($conn, $sqlUsername);
            $usernameCount = mysqli_num_rows($result);
            if ($usernameCount > 0) {
                $usernamePassword = mysqli_fetch_assoc($result);
                $dbPass = $usernamePassword['password'];

                $passDecode = password_verify($currentPasswordEdit, $dbPass);

                if ($passDecode) {
                    $encryptedNewPassword = password_hash($newPasswordEdit, PASSWORD_BCRYPT);
                    $updateQuery = "UPDATE `admin` SET `password` = '$encryptedNewPassword' WHERE `username` = '$username_'";
                    $result = mysqli_query($conn, $updateQuery);
                    if ($result) {
                        header('location: ../logout.php');
                    } else {
                        echo '<script language="javascript"> alert(' . mysqli_error($conn) . ') </script>';
                    }
                } else {
                    echo '<script language="javascript"> alert("Couldn\t Verify Password") </script>';
                }
            } else {
                echo '<script language="javascript"> alert("User Not Found") </script>';
            }
        } else {
            echo '<script language="javascript"> alert("New Password & Confirm Password Fields Don\'t Match") </script>';
        }
    } else {
        echo '<script language="javascript"> alert("No Field Should Be Empty") </script>';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);

    $usernameQuery = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $usernameQuery);

    $usernameCount = mysqli_num_rows($result);

    if ($usernameCount > 0) {
        $usernameExists = true;
    } else {
        $insertQuery = "INSERT INTO admin (username, firstName, lastName, password) VALUES ('$username', '$firstName', '$lastName', '$encryptedPassword')";

        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            $insert = true;
        } else {
            echo '<script language="javascript"> alert(' . mysqli_error($conn) . ') </script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>ADMINISTRATOR'S PROFILE :: Gym Management System</title>
<?php include '../css/style.php'; ?>
    </head>

    <body>
<?php include '../loader.php'; ?>

        <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailstModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailsModalLabel">Edit Admin's Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="detailsEdit" id="detailsEdit">

                            <div class="form-group">
                                <label for="firstNameEdit">First Name</label>
                                <input type="text" class="form-control" id="firstNameEdit" name="firstNameEdit" value="<?php echo $_SESSION['firstName']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="lastNameEdit">Last Name</label>
                                <input type="text" class="form-control" id="lastNameEdit" name="lastNameEdit" value="<?php echo $_SESSION['lastName']; ?>">
                            </div>


                            <div class="form-group">
                                <label for="usernameEdit">Username</label>
                                <input type="text" class="form-control" id="usernameEdit" name="usernameEdit" value="<?php echo $_SESSION['username']; ?>">
                            </div>

                        </div>
                        <div class="modal-footer d-block mr-auto">
                            <button type="button" class="btn waves-effect waves-light hor-grd btn-grd-info" data-dismiss="modal">Close</button>
                            <button type="submit" name="btnSubmitDetails" class="btn waves-effect waves-light hor-grd btn-grd-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordModalLabel">Change Admin's Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="passwordEdit" id="detailsEdit">

                            <div class="form-group">
                                <label for="currentPasswordEdit">Current Password</label>
                                <input type="text" class="form-control" id="currentPasswordEdit" name="currentPasswordEdit" onfocus="(this.type = 'password')">
                            </div>

                            <div class="form-group">
                                <label for="newPasswordEdit">New Password</label>
                                <input type="text" class="form-control" id="newPasswordEdit" name="newPasswordEdit" onfocus="(this.type = 'password')">
                            </div>

                            <div class="form-group">
                                <label for="confirmPasswordEdit">Confirm Password</label>
                                <input type="text" class="form-control" id="confirmPasswordEdit" name="confirmPasswordEdit" onfocus="(this.type = 'password')">
                            </div>

                        </div>
                        <div class="modal-footer d-block mr-auto">
                            <button type="button" class="btn waves-effect waves-light hor-grd btn-grd-info" data-dismiss="modal">Close</button>
                            <button type="submit" name="btnSubmitPassword" class="btn waves-effect waves-light hor-grd btn-grd-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                                                <p class="m-b-0">Profile Details</p>
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
                                            <div class="row m-t-0">
                                                <div class="col-8">

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
                                                <div class="col-4">
                                                    <div class="auth-box card">
                                                        <div class="card-block">
                                                            <div class="row m-b-15">
                                                                <div class="col-md-12">
                                                                    <h3 class="text-center txt-primary"><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?></h3>
                                                                </div>
                                                                <hr>
                                                                <div class="col-md-12">
                                                                    <h5 class="text-center txt-primary"><?php echo $_SESSION['username']; ?></h5>
                                                                </div>
                                                                <hr>
                                                                <div class="col-md-12">
                                                                    <h6 class="text-center txt-primary">Administrator</h6>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <button class="btn" id="btnDetails" style="width:100%; border-radius: 20px; background-color: #448aff; color:white;">Change User Details</button>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <button class="btn btn-info password" id="btnPass" style="width:100%; border-radius: 20px;">Change Password</button>
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
            window.setTimeout(function () {
                $("#insertAlert").fadeTo(1000, 0).slideUp(1000, function () {
                    $(this).remove();
                });
            }, 3000);
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            window.setTimeout(function () {
                $("#usernameAlert").fadeTo(1000, 0).slideUp(1000, function () {
                    $(this).remove();
                });
            }, 3000);
        });
    </script>

    <script>
        $('#btnDetails').click(function () {
            $('#detailsModal').modal('toggle');
        });

        $('#btnPass').click(function () {
            $('#passwordModal').modal('toggle');
        });
    </script>

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