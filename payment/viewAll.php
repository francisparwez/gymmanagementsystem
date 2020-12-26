<?php
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
    }
    if (!isset($_SESSION['username'])) {
        header('location: ../login.php');
    }
    include '../db.php'; 
    $update = false;   
    
    $delete = false;
    
    if (isset($_POST['deleteData'])) {
        
        $snoDelete = $_POST['snoDelete'];
        $sql = "DELETE FROM `payment` WHERE `id` = $snoDelete";
        $result = mysqli_query($conn, $sql);
        
        
        if ($result) 
        {
            $delete = true;
        } 
        else 
        {
            echo '<script language="javascript"> alert(' . mysqli_error($conn) . ') </script>';
        }
    
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['snoEdit'])) {
            $sno = $_POST["snoEdit"];
            $members = mysqli_real_escape_string($conn, $_POST["memberEdit"]);
            $paymentOfMonth = mysqli_real_escape_string($conn, $_POST["paymentOfMonth"]);
            $isPaymentCleared = mysqli_real_escape_string($conn, $_POST["isPaymentCleared"]);
            $paymentDate = mysqli_real_escape_string($conn, $_POST["paymentDate"]);
            
            $sql = "UPDATE `payment` SET `members` = $members, `paymentOfMonth` = '$paymentOfMonth', `isPaymentCleared` = $isPaymentCleared, `paymentDate` = '$paymentDate' WHERE `payment`.`id` = $sno";            
            
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $update = true;
            } else {
                echo '<script language="javascript"> alert(' . mysqli_error($conn) . ') </script>';
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>VIEW PAYMENT :: Gym Management System</title>
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
        <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Langar&display=swap" rel="stylesheet">
        <link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>        
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <?php include '../loader.php'; ?>
        
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit This Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="viewAll.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="snoEdit" id="snoEdit">
                            
                            <div class="form-group">
                                <label for="amount">Member</label>
                                <select name="memberEdit" id="select" class="form-control">
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
                            
                            <div class="form-group">
                                <label for="amount">Payment Of Month</label>
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
                            
                            <div class="form-group">
                                <label for="isPaymentCleared">Is Payment Cleared: &nbsp;</label> 
                                <label class="radio-inline"><input type="radio" id="memYes" name="isPaymentCleared" value="1">&nbsp;YES</label>
                                <label class="radio-inline"><input type="radio" id="memNo" name="isPaymentCleared" value="0">&nbsp;NO</label>
                            </div>                             
                            
                            <div class="form-group">
                                <label for="paymentDate">Payment Date</label>
                                <input type="text" class="form-control" id="paymentDate" name="paymentDate" onfocus="(this.type = 'date')" onblur="(this.type = 'text')">
                            </div>
                            
                        </div>
                        <div class="modal-footer d-block mr-auto">
                            <button type="button" class="btn waves-effect waves-light hor-grd btn-grd-info" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn waves-effect waves-light hor-grd btn-grd-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
<!--        DELETE MODAL-->
        
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">                        
                        <h5 class="modal-title" id="deleteModalLabel"> Are You Sure You Want To Delete This Payment?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="viewAll.php" method="POST">
                        <div class="modal-body">                            
                            <input type="hidden" name="snoDelete" id="snoDelete">                            
                        </div>
                        <div class="modal-footer d-block mr-auto">
                            <button type="button" class="btn waves-effect waves-light hor-grd btn-grd-info" data-dismiss="modal"> NO </button>
                            <button type="submit" name="deleteData" class="btn waves-effect waves-light hor-grd btn-grd-danger">YES!! Delete Payment</button>
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
                            <!-- Page-header start -->
                            <div class="page-header">
                                <div class="page-block">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="page-header-title">
                                                <h5 class="m-b-10">Payment</h5>
                                                <p class="m-b-0">View All Of Them</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                if ($update) {
                                    echo 
                                    "<div id='updateSuccess' class='alert alert-info alert-dismissible fade show' role='alert'>
                                        <strong>SUCCESS!</strong> PAYMENT UPDATES
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                          <span aria-hidden='true'>×</span>
                                        </button>
                                      </div>";
                                }
                                if ($delete) {
                                    echo 
                                    "<div id='deleteSuccess' class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong>SUCCESS!</strong> PAYMENT DELETED
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
                                                            <h5>Currently Existing Payments</h5>
<!--                                                            <span><code></code></span>-->
                                                            <div class="card-header-right">
                                                                <ul class="list-unstyled card-option">
                                                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="card-block table-border-style">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover" id="tblPayment">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>SNo</th>
                                                                            <th>Members</th>
                                                                            <th>Payment Of Month</th>
                                                                            <th>Is Payment Cleared</th>
                                                                            <th>Payment Date</th>
                                                                            <th style="display: none;">&nbsp;</th>
                                                                            <th style="display: none;">&nbsp;</th>
                                                                            <th>EDIT/DELETE</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $sql = "SELECT `payment`.`id`, `members`.`id` as `memberId`, CONCAT(`members`.`firstName`, ' ', `members`.`lastName`) as `memberName`, `payment`.`paymentOfMonth`, `payment`.`isPaymentCleared`, `payment`.`paymentDate`, DATE_FORMAT(`payment`.`paymentDate`, '%W %D %M %Y') AS `paymentDate_` FROM `payment` JOIN `members` ON `payment`.`members` = `members`.`id`;";
                                                                        $result = mysqli_query($conn, $sql);
                                                                        $sno = 0;
                                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                                            $sno = $sno + 1;
                                                                            $payment_ = $row['isPaymentCleared'] == 1 ? "YES" : "NO";
                                                                            echo "<tr>
                                                                                    <th scope='row'>" . $sno . "</th>
                                                                                    <td>" . $row['memberName'] . "</td>
                                                                                    <td>" . $row['paymentOfMonth'] . "</td>
                                                                                    <td>" . $payment_ . "</td>
                                                                                    <td>" . $row['paymentDate_'] . "</td>
                                                                                    <td style='display: none;'>" . $row['memberId'] . "</td>
                                                                                    <td style='display: none;'>" . $row['paymentDate'] . "</td>
                                                                                    <td> 
                                                                                    <button class='edit btn btn-sm waves-effect waves-light hor-grd btn-grd-warning' id=" . $row['id'] . " style='color: #20639B;'>"
                                                                                    . "<i class='far fa-edit'></i> EDIT"
                                                                                    . "</button>"
                                                                                    . "&nbsp;"
                                                                                 . "<button class='delete btn btn-sm waves-effect waves-light hor-grd btn-grd-danger' id=" . $row['id'] . ">
                                                                                     <i class='fas fa-trash'></i>
                                                                                     DELETE
                                                                                     </button>
                                                                                     </td>
                                                                                  </tr>";
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
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
        <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#tblPayment').DataTable();
                $('#packageID').hide();

            });
        </script>
        <script>
            edits = document.getElementsByClassName('edit');
            Array.from(edits).forEach((element) => {
                element.addEventListener("click", (e) => {
                    tr = e.target.parentNode.parentNode;
                    member = tr.getElementsByTagName("td")[4].innerText;
                    $('#select').val(member);
                    month = tr.getElementsByTagName("td")[1].innerText;
                    $('#month').val(month);
                    isPaymentCleared = tr.getElementsByTagName("td")[2].innerText;
                    if (isPaymentCleared.toString() === "YES") 
                    {
                        $('#memYes').prop("checked", true);                     
                    } 
                    else if (isPaymentCleared.toString() === "NO")
                    {
                        $('#memNo').prop("checked", true);; 
                    }
                    paymentDate = tr.getElementsByTagName("td")[5].innerText;
                    $("#paymentDate").val(paymentDate);
                    snoEdit.value = e.target.id;
                    $('#editModal').modal('toggle');
                });
            });
        </script>        
        <script>
            deletes = document.getElementsByClassName('delete');
            Array.from(deletes).forEach((element) => {
                element.addEventListener("click", (e) => {
                    tr = e.target.parentNode.parentNode;                    
                    snoDelete.value = e.target.id;
                    $('#deleteModal').modal('toggle');
                });
            });
        </script>
        
        <script type="text/javascript">
            $(document).ready(function () {
            window.setTimeout(function() {
                $("#updateSuccess").fadeTo(1000, 0).slideUp(1000, function(){
                    $(this).remove(); 
                });
            }, 3000);
            });
            
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
            window.setTimeout(function() {
                $("#deleteSuccess").fadeTo(1000, 0).slideUp(1000, function(){
                    $(this).remove(); 
                });
            }, 3000);
            });            
        </script>
    </body>
</html>