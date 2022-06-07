<?php
session_start();
if (isset($_SESSION['uid'])) {
    include("../../dbconfig.php");
    $uid = $_SESSION['uid'];
    
    // echo $uid;

    // GET USER DATA FOR NOW NAME ONLY.
    $sql = "SELECT * FROM joinus WHERE uid = '$uid'";
    $res = $conn->query($sql);
    $data = mysqli_fetch_assoc($res);
    $my_ref_code = $data['my_ref_code'];
    $fname = $data['fname'];
    $lname = $data['lname'];
    $name = $fname . " " . $lname;
    $my_ref = $data['my_ref_code'];
    $status = $data['status'];
    // END OF USER DATA COLLECTION FORM DB

    // GET MY TEAM.
    $sql = "SELECT * FROM joinus WHERE ref_code = '$my_ref_code' AND status = 'Activate'";
    $res = $conn->query($sql);
    $n = mysqli_num_rows($res);
    $my_joining = $n . "+";
    // END OF MY TEAM

    // GET TOTAL TEAM
    $sql = "SELECT * FROM joinus WHERE status = 'Activate'";
    $res = $conn->query($sql);
    $n = mysqli_num_rows($res);
    $total_team = $n . "+";
    // END OF TOTAL TEAM


    // GET REQUESTED MEMBER
    $sql = "SELECT * FROM joinus WHERE status = 'Deactivate'";
    $res = $conn->query($sql);
    $n = mysqli_num_rows($res);
    $total_req_member = $n . "+";
    // END OF GET REQUESTED MEMBER
    
    
    if(isset($_SESSION['uid'])){
        include("../../dbconfig.php");
        $uid = $_SESSION['uid'];
        if(isset($_POST['wal_sub'])){
          $ref = $_POST['ref'];
          
          $sql_prev = "SELECT * FROM joinus WHERE my_ref_code = '$ref'";
          $res_prev = $conn->query($sql_prev);
          
          $data = mysqli_fetch_assoc($res_prev);
          
          $exist_price = $data['wallet'];
          
          $wal_val = $_POST['wal_val'];
          $total_price = (int)$wal_val + (int)$exist_price;
          $sql = "UPDATE joinus SET wallet = '$total_price' WHERE my_ref_code = '$ref'";
          
          $res = $conn->query($sql);
          if($res == true){
            echo '<script>alert("Successfully, updated !!!")</script>';
          }else{
            echo '<script>alert("Oops! Something went wrong...")</script>';
          }
        }
    }

} else {
    // header("Location: ../../pages/sign-in.php");
    echo '<script>document.location.href="../../sign-in.php"</script>';
}
?>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Smart Network</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    
    <!-- Bootstrap for modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="javascript:;" class="site_title"><i class="fa fa-paw"></i> <span>Admin Panel</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $name; ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->
                    
                    <br />

                    <!-- sidebar menu -->
                    <?php include("adminsidebar.php"); ?>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <?php include("admintopnav.php"); ?>
            <!-- /top navigation -->
            
            <!--Wallet Modal-->
            <div class="modal fade" id="exampleModalMoney" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Update Wallet</h5>
                    </div>
                    <form action="?" method="POST">
                        <div class="modal-body">
                          <div class="input-group">
                            <input type="text" name="ref" placeholder="Enter the referal code" class="form-control">
                            <input type="text" name="wal_val" placeholder="Enter the amount" class="form-control">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="wal_sub">submit</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>

            <!-- HAAT MAT LAGAO -->
            <div class="right_col" role="main">
                <div class="tile_count">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="tile_count">
                                <div class="row x_title">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- HAT MAT LAGAO END -->

                <!-- Header Count Sayed -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="tile_count">
                            <div class="row x_title">
                                <div class="col-sm-4 tile_stats_count">
                                    <a href="admintotalteam.php">
                                        <span class="count_top" style="color: black;"><i class="fa fa-user"></i> Total Team Members</span>
                                        <div class="count green"><?php echo $total_team; ?></div>
                                    </a>
                                </div>
                                <div class="col-sm-4 tile_stats_count">
                                    <a href="adminmyteam.php">
                                        <span class="count_top" style="color: black;"><i class="fa fa-clock-o"></i> My Joining (Direct Join)</span>
                                        <div class="count"><?php echo $my_joining; ?></div>
                                    </a>
                                </div>
                                <div class="col-sm-4 tile_stats_count">
                                    <a href="ReqMemList.php">
                                        <span class="count_top" style="color: black;"><i class="fa fa-user"></i> Requested Member</span>
                                        <div class="count red"><?php echo $total_req_member; ?></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header Count Sayed End-->


                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="dashboard_graph">

                            <div class="row x_title">
                                <div class="col-md-6">
                                    <h3>Network Activities <small>Graph title sub-title</small></h3>
                                </div>
                                <div class="col-md-6">
                                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9 col-sm-9 ">
                                <div id="chart_plot_01" class="demo-placeholder"></div>
                            </div>
                            <div class="col-md-3 col-sm-3  bg-white">
                                <div class="x_title">
                                    <h2>Top Campaign Performance</h2>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="col-md-12 col-sm-12 ">
                                    <div>
                                        <p>Facebook Campaign</p>
                                        <div class="">
                                            <div class="progress progress_sm" style="width: 76%;">
                                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p>Twitter Campaign</p>
                                        <div class="">
                                            <div class="progress progress_sm" style="width: 76%;">
                                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 ">
                                    <div>
                                        <p>Conventional Media</p>
                                        <div class="">
                                            <div class="progress progress_sm" style="width: 76%;">
                                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p>Bill boards</p>
                                        <div class="">
                                            <div class="progress progress_sm" style="width: 76%;">
                                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <br />
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        All rights reserved. Copyright © <script>
                            document.write(new Date().getFullYear())
                        </script> Smart Network by <a>Healing Buddy Technologies</a>. </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="../vendors/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="../vendors/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="../vendors/Flot/jquery.flot.js"></script>
        <script src="../vendors/Flot/jquery.flot.pie.js"></script>
        <script src="../vendors/Flot/jquery.flot.time.js"></script>
        <script src="../vendors/Flot/jquery.flot.stack.js"></script>
        <script src="../vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="../vendors/DateJS/build/date.js"></script>
        <!-- JQVMap -->
        <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../vendors/moment/min/moment.min.js"></script>
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>

</body>

</html>