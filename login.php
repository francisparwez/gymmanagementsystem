<?php
if (session_status() == PHP_SESSION_NONE) {
        session_start();
}
if (isset($_SESSION['username'])) {
    header('location: ./dashboard/dashboard.php');
}

include './db.php';

$incorrectUsername = false;
$incorrectPassword = false;

if (isset($_POST['btnSubmit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($username) || !empty($password)) {
        $sqlUsername = "SELECT * FROM admin WHERE username='$username'";
        $result = mysqli_query($conn, $sqlUsername);
        $usernameCount = mysqli_num_rows($result);
        if ($usernameCount) {
            $usernamePassword = mysqli_fetch_assoc($result);
            $dbPass = $usernamePassword['password'];

            $_SESSION['username'] = $usernamePassword['username'];
            $_SESSION['firstName'] = $usernamePassword['firstName'];
            $_SESSION['lastName'] = $usernamePassword['lastName'];

            $passDecode = password_verify($password, $dbPass);
            if ($passDecode) {
                ?>
                <script>
                    location.replace("dashboard/dashboard.php");
                </script>
                <?php
            } else {
                echo '<script language="javascript"> alert("Incorrect Password") </script>';
                $incorrectPassword = true;
            }
        } else {
            echo '<script language="javascript"> alert("Unknown Username") </script>';
            $incorrectUsername = true;
        }
    } else {
            echo '<script language="javascript"> alert("Any Of The Fields Shouldn\'t Be Empty") </script>';
            $incorrectUsername = true;
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/gym-icon.png" type="image/x-icon">	
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Langar&display=swap" rel="stylesheet">
        <title>LOGIN :: Gym Management System</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <section class="Form mx-5">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-5">
                        <img src="img/login-gym.jpeg" class="img-fluid" alt=""/>
                    </div>
                    <div class="col-lg-7 px-5 pt-5">
                        <h2 class="font-weight-bold py-3 text-center">Gym Management System</h2>
                        <h4 class="text-center">Sign Into Your Account</h4>
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <input type="text" name="username" placeholder="Enter Username" class="form-control my-3 p-4"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <input type="text" name="password" placeholder="Enter Password" class="form-control my-3 p-4" onfocus="(this.type = 'password')" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <button type="submit" name="btnSubmit" class="btn-login mt-3 mb-5">Login</button>
                                </div>
                            </div>
                            <a href="#"> <p class="text-center"> Forget Password? </p> </a>
                        </form>
                    </div>
                </div>            
            </div>

        </section>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    </body>
</html>