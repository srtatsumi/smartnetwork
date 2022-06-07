<?php 
  session_start();
  if(isset($_POST['chngSt'])){
    include("../../dbconfig.php");
    $uid = $_SESSION['uid'];

    $memberId = $_GET['id'];

    $sql = "UPDATE joinus SET status='Activate' WHERE id=$memberId";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Successfully Updated!!!")</script>';
    } else {
        echo '<script>alert("Something went wrong!!!")</script>';
    }
  }

  if(isset($_SESSION['uid'])){
    include("../../dbconfig.php");
    $uid = $_SESSION['uid'];

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
    $sql1 = "SELECT * FROM joinus WHERE status = 'Deactivate'";
    $res1 = $conn->query($sql1);
    // END OF MY TEAM
  }else{
    // header("Location: ../../pages/sign-in.php");
    echo '<script>document.location.href="../../sign-in.php"</script>';
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Smart Network</title>

    <!-- Bootstrap -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->

    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Smart Network</span></a>
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

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Total Team</h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box table-responsive">
                                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Upline</th>
                                                            <th>Wallet</th>
                                                            <th>Ref. code</th>
                                                            <th>1st</th>
                                                            <th>2nd</th>
                                                            <th>3rd</th>
                                                            <th>4th</th>
                                                            <th>5th</th>
                                                            <th>6th</th>
                                                            <th>7th</th>
                                                            <th>8th</th>
                                                            <th>9th</th>
                                                            <th>10th</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $sql = "SELECT * FROM joinus WHERE status = 'Activate'";
                                                            $res = $conn->query($sql);
                                                            while($row = mysqli_fetch_assoc($res)){
                                                                // Calculate the first level
                                                                    $first_level_ref_code = array();
                                                                    $my_ref_code_val = $row['my_ref_code'];
                                                                    $sql1 = "SELECT * FROM joinus WHERE status = 'Activate' AND ref_code = '".$my_ref_code_val."'";
                                                                    $res1 = $conn->query($sql1);
                                                                    while($row1 = mysqli_fetch_assoc($res1)){
                                                                        array_push($first_level_ref_code, $row1['my_ref_code']);
                                                                    }
                                                                    $first = mysqli_num_rows($res1);
                                                                // End of first level

                                                                // Calculate the second level
                                                                    $second = 0;
                                                                    $sec_level_ref_code = array();
                                                                    foreach ($first_level_ref_code as $first_level_ref_code_value) {
                                                                        $sql2 = "SELECT * FROM joinus WHERE status = 'Activate' AND ref_code = '".$first_level_ref_code_value."'";
                                                                        $res2 = $conn->query($sql2);
                                                                        while($row2 = mysqli_fetch_assoc($res2)){
                                                                            array_push($sec_level_ref_code, $row2['my_ref_code']);
                                                                        }
                                                                        $second = $second + mysqli_num_rows($res2);
                                                                    }
                                                                // End of second level

                                                                // Calculate the third level
                                                                    $third = 0;
                                                                    $third_level_ref_code = array();
                                                                    foreach ($sec_level_ref_code as $sec_level_ref_code_value) {
                                                                        $sql3 = "SELECT * FROM joinus WHERE status = 'Activate' AND ref_code = '".$sec_level_ref_code_value."'";
                                                                        $res3 = $conn->query($sql3);
                                                                        while($row3 = mysqli_fetch_assoc($res3)){
                                                                            array_push($third_level_ref_code, $row3['my_ref_code']);
                                                                        }
                                                                        $third = $third + mysqli_num_rows($res3);
                                                                    }
                                                                // End of third level

                                                                // Calculate the fourth level
                                                                    $fourth = 0;
                                                                    $fourth_level_ref_code = array();
                                                                    foreach ($third_level_ref_code as $third_level_ref_code_value) {
                                                                        $sql4 = "SELECT * FROM joinus WHERE status = 'Activate' AND ref_code = '".$third_level_ref_code_value."'";
                                                                        $res4 = $conn->query($sql4);
                                                                        while($row4 = mysqli_fetch_assoc($res4)){
                                                                            array_push($fourth_level_ref_code, $row4['my_ref_code']);
                                                                        }
                                                                        $fourth = $fourth + mysqli_num_rows($res4);
                                                                    }
                                                                // End of fourth level

                                                                // Calculate the fifth level
                                                                    $fifth = 0;
                                                                    $fifth_level_ref_code = array();
                                                                    foreach ($fourth_level_ref_code as $fourth_level_ref_code_value) {
                                                                        $sql5 = "SELECT * FROM joinus WHERE status = 'Activate' AND ref_code = '".$fourth_level_ref_code_value."'";
                                                                        $res5 = $conn->query($sql5);
                                                                        while($row5 = mysqli_fetch_assoc($res5)){
                                                                            array_push($fifth_level_ref_code, $row5['my_ref_code']);
                                                                        }
                                                                        $fifth = $fifth + mysqli_num_rows($res5);
                                                                    }
                                                                // End of fifth level

                                                                // Calculate the sixth level
                                                                    $sixth = 0;
                                                                    $sixth_level_ref_code = array();
                                                                    foreach ($fifth_level_ref_code as $fifth_level_ref_code_value) {
                                                                        $sql6 = "SELECT * FROM joinus WHERE status = 'Activate' AND ref_code = '".$fifth_level_ref_code_value."'";
                                                                        $res6 = $conn->query($sql6);
                                                                        while($row6 = mysqli_fetch_assoc($res6)){
                                                                            array_push($sixth_level_ref_code, $row6['my_ref_code']);
                                                                        }
                                                                        $sixth = $sixth + mysqli_num_rows($res6);
                                                                    }
                                                                // End of sixth level

                                                                // Calculate the seventh level
                                                                    $seventh = 0;
                                                                    $seventh_level_ref_code = array();
                                                                    foreach ($sixth_level_ref_code as $sixth_level_ref_code_value) {
                                                                        $sql7 = "SELECT * FROM joinus WHERE status = 'Activate' AND ref_code = '".$sixth_level_ref_code_value."'";
                                                                        $res7 = $conn->query($sql7);
                                                                        while($row7 = mysqli_fetch_assoc($res7)){
                                                                            array_push($seventh_level_ref_code, $row7['my_ref_code']);
                                                                        }
                                                                        $seventh = $seventh + mysqli_num_rows($res7);
                                                                    }
                                                                // End of seventh level

                                                                // Calculate the eight level
                                                                    $eight = 0;
                                                                    $eight_level_ref_code = array();
                                                                    foreach ($seventh_level_ref_code as $seventh_level_ref_code_value) {
                                                                        $sql8 = "SELECT * FROM joinus WHERE status = 'Activate' AND ref_code = '".$seventh_level_ref_code_value."'";
                                                                        $res8 = $conn->query($sql8);
                                                                        while($row8 = mysqli_fetch_assoc($res8)){
                                                                            array_push($eight_level_ref_code, $row8['my_ref_code']);
                                                                        }
                                                                        $eight = $eight + mysqli_num_rows($res8);
                                                                    }
                                                                // End of eight level

                                                                // Calculate the nine level
                                                                    $nine = 0;
                                                                    $nine_level_ref_code = array();
                                                                    foreach ($eight_level_ref_code as $eight_level_ref_code_value) {
                                                                        $sql9 = "SELECT * FROM joinus WHERE status = 'Activate' AND ref_code = '".$eight_level_ref_code_value."'";
                                                                        $res9 = $conn->query($sql9);
                                                                        while($row9 = mysqli_fetch_assoc($res9)){
                                                                            array_push($nine_level_ref_code, $row9['my_ref_code']);
                                                                        }
                                                                        $nine = $nine + mysqli_num_rows($res9);
                                                                    }
                                                                // End of nine level

                                                                // Calculate the ten level
                                                                    $ten = 0;
                                                                    $ten_level_ref_code = array();
                                                                    foreach ($nine_level_ref_code as $nine_level_ref_code_value) {
                                                                        $sql10 = "SELECT * FROM joinus WHERE status = 'Activate' AND ref_code = '".$nine_level_ref_code_value."'";
                                                                        $res10 = $conn->query($sql10);
                                                                        while($row10 = mysqli_fetch_assoc($res10)){
                                                                            array_push($ten_level_ref_code, $row10['my_ref_code']);
                                                                        }
                                                                        $ten = $ten + mysqli_num_rows($res10);
                                                                    }
                                                                // End of ten level
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row['fname']." ".$row['lname'];?></td>
                                                            <td><?php echo $row['ref_code'];?></td>
                                                            <td><?php echo $row['wallet'];?></td>
                                                            <td><?php echo $row['my_ref_code'];?></td>
                                                            <td><?php echo $first;?></td>
                                                            <td><?php echo $second;?></td>
                                                            <td><?php echo $third;?></td>
                                                            <td><?php echo $fourth;?></td>
                                                            <td><?php echo $fifth;?></td>
                                                            <td><?php echo $sixth;?></td>
                                                            <td><?php echo $seventh;?></td>
                                                            <td><?php echo $eight;?></td>
                                                            <td><?php echo $nine;?></td>
                                                            <td><?php echo $ten;?></td>
                                                        </tr>
                                                        <?php } ?>
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
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

</body>

</html>