<?php
session_start();
if (isset($_SESSION['uid'])) {
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
  $status = $data['status'];
  $txn = $data['txn_id'];
  $my_ref = $data['my_ref_code'];
  $wallet = $data['wallet'];
  $level = $data['level'];

  $sql = "select * from `joinus-data` where u_id='$uid'";
  $result = $conn->query($sql);
  $row = mysqli_fetch_assoc($result);


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
} else {
  // header("Location: ../../pages/sign-in.php");
  echo '<script>document.location.href="../../sign-in.php"</script>';
}

if (isset($_SESSION['uid'])) {
  include("../../dbconfig.php");
  $uid = $_SESSION['uid'];
  if (isset($_POST['txn_submit'])) {
    $new_txn_id = $_POST['txn'];
    $sql = "UPDATE joinus SET txn_id = '$new_txn_id' WHERE uid = '$uid'";
    $res = $conn->query($sql);
    if ($res == true) {
      echo '<script>alert("Successfully, updated !!!")</script>';
    } else {
      echo '<script>alert("Oops! Something went wrong...")</script>';
    }
  }
}
?>
<html lang="en">

<head>
  <!----Adcash---->
  <meta name="a.validate.02" content="SI0TObMK7C-3NYaqsUL4pbw2VKByhdZtQkGa" />
  <!----close---->
  <!-----adsence---->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7556331893650213" crossorigin="anonymous"></script>
  <!-----close---->
  <!----APropellerd---->
  <meta name="propeller" content="6c8c91f781ed644c464550bffce71a63">
  <!----close---->

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />
  <link rel="stylesheet" href="style.css">

  <title>Smart Network</title>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


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
  <!---BlockCode--->
  <style>
    html,
    body {
      padding: 0;
      position: absolute;
      left: 0;
      right: 0;

      font-size: 16px;
    }

    p {
      margin-block: 0.5em;
    }

    a {
      color: red;
    }

    .gallery {
      position: relative;
      max-width: 800px;
      padding: 0 10px;
      margin-block: 10px;
    }

    .gallery_scroller {
      /* snap mandatory on horizontal axis  */
      scroll-snap-type: x mandatory;

      overflow-x: scroll;
      overflow-y: hidden;

      display: flex;
      align-items: center;
      height: 30vh;

      /* Enable Safari touch scrolling physics which is needed for scroll snap */
      -webkit-overflow-scrolling: touch;
    }


    .gallery_scroller.no_snap {
      scroll-snap-type: none;
    }

    .gallery_scroller div {
      /* snap align center  */
      scroll-snap-align: center;
      margin: 10px;
      position: relative;
    }

    .gallery_scroller img {
      border-radius: 10px;
    }

    .gallery_scroller div.colored_card {
      min-width: 100%;
      min-height: 95%;
      border-radius: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .gallery_scroller div.colored_card>p {
      font-size: 10em;
      margin: 0;
      padding: 0;
    }


    .gallery div.note {
      position: absolute;

      /* vertically align center */
      top: 50%;
      transform: translateY(-50%);
      left: 0;
      right: 0;

      background: rgba(0, 0, 0, 0.6);
      padding: 20px;
      position: absolute;

      font-size: 4em;
      color: white;
    }


    .gallery .btn {
      position: absolute;

      top: 50%;
      transform: translateY(-50%);

      height: 30px;
      width: 30px;

      border-radius: 2px;
      background-color: rgba(0, 0, 0, 0.5);
      background-position: 50% 50%;
      background-repeat: no-repeat;

      z-index: 1;
    }

    .gallery .btn.next {
      background-image: url('data:image/svg+xml;charset=utf-8,<svg width="18" height="18" viewBox="0 0 34 34" xmlns="http://www.w3.org/2000/svg"><title>Shape</title><path d="M25.557 14.7L13.818 2.961 16.8 0l16.8 16.8-16.8 16.8-2.961-2.961L25.557 18.9H0v-4.2z" fill="%23FFF" fill-rule="evenodd"/></svg>');
      right: 10px;
    }

    .gallery .btn.prev {
      background-image: url('data:image/svg+xml;charset=utf-8,<svg width="18" height="18" viewBox="0 0 34 34" xmlns="http://www.w3.org/2000/svg"><title>Shape</title><path d="M33.6 14.7H8.043L19.782 2.961 16.8 0 0 16.8l16.8 16.8 2.961-2.961L8.043 18.9H33.6z" fill="%23FFF" fill-rule="evenodd"/></svg>');
      left: 10px;
    }

    .gallery_scroller>div.colored_card:nth-of-type(1) {
      background-color: #e8eaf6;
    }

    .gallery_scroller>div.colored_card:nth-of-type(2) {
      background-color: #c5cae9;
    }

    .gallery_scroller>div.colored_card:nth-of-type(3) {
      background-color: #9fa8da;
    }

    .gallery_scroller>div.colored_card:nth-of-type(4) {
      background-color: #7986cb;
    }

    .gallery_scroller>div.colored_card:nth-of-type(5) {
      background-color: #5c6bc0;
    }

    .gallery_scroller>div.colored_card:nth-of-type(6) {
      background-color: #3f51b5;
    }

    .gallery_scroller>div.colored_card:nth-of-type(7) {
      background-color: #3949ab;
    }

    .gallery_scroller>div.colored_card:nth-of-type(8) {
      background-color: #303f9f;
    }

    .gallery_scroller>div.colored_card:nth-of-type(9) {
      background-color: #283593;
    }

    .gallery_scroller>div.colored_card:nth-of-type(10) {
      background-color: #1a237e;
    }

    .gallery_scroller>div.colored_card:nth-of-type(11) {
      background-color: #827717;
    }

    .gallery_scroller>div.colored_card:nth-of-type(12) {
      background-color: #9E9D24;
    }

    .gallery_scroller>div.colored_card:nth-of-type(13) {
      background-color: #AFB42B;
    }

    .gallery_scroller>div.colored_card:nth-of-type(14) {
      background-color: #C0CA33;
    }

    .gallery_scroller>div.colored_card:nth-of-type(15) {
      background-color: #CDDC39;
    }

    .gallery_scroller>div.colored_card:nth-of-type(16) {
      background-color: #D4E157;
    }

    .gallery_scroller>div.colored_card:nth-of-type(17) {
      background-color: #DCE775;
    }

    .gallery_scroller>div.colored_card:nth-of-type(18) {
      background-color: #E6EE9C;
    }

    .gallery_scroller>div.colored_card:nth-of-type(19) {
      background-color: #F0F4C3;
    }

    .gallery_scroller>div.colored_card:nth-of-type(20) {
      background-color: #F9FBE7;
    }
  </style>
  <!---BlockCodeClose--->
</head>

<body class="nav-md">

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Your Transaction ID</h5>
        </div>
        <form action="?" method="POST">
          <div class="modal-body">
            <div class="input-group">
              <input type="text" name="txn" class="form-control" value="<?php echo $txn ?>">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="txn_submit">submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--Wallet Modal-->
  <div class="modal fade" id="exampleModalMoney" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="text-align: center;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">&nbsp;Your Current Balance:</h5>
        </div>
        <form>
          <div class="modal-body">
            <h3><?php echo $wallet; ?>.0/-</h3>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Payment Modal -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <form>
            <script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_JFyJlA9o2cYeQI" async> </script>
          </form>
        </div>
        <!-- <form>
              <div class="modal-body">
             <form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_JFyJlA9o2cYeQI" async> </script> </form>
              </div>
            </form>-->
      </div>
    </div>
  </div>

  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Network Earning</span></a>
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
          <?php include("sidebarmenu.php"); ?>
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
      <?php include("topnav.php"); ?>
      <!-- /top navigation -->

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
                <div class="col-sm-6 tile_stats_count">
                  <a href="usertotalteam.php">
                    <span class="count_top" style="color: black;"><i class="fa fa-user"></i> Team Members</span>
                    <!--<div class="count green"><?php echo $total_team; ?></div>-->
                    <div class="count green"><i class="fa fa-eye" aria-hidden="true"></i></div>
                  </a>
                </div>
                <div class="col-sm-6 tile_stats_count">
                  <a href="myteam.php">
                    <span class="count_top" style="color: black;"><i class="fa fa-clock-o"></i> My Joining</span>
                    <div class="count"><?php echo $my_joining; ?></div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Header Count Sayed End-->
        <!----AdBlock---->
        <div id="paginated_gallery" class="gallery">

          <!--   <span class="btn prev"></span>
  <span class="btn next"></span> -->
        </div>


        <div id="paginated_gallery" class="gallery">
          <div class="gallery_scroller no_snap">
            <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
            <div class="colored_card">
              <p></p> <a href="//zikroarg.com/4/5051836" target="_blank" data-value="1" class="addlink" onclick="seeadd(this);">ClickToSeeAd</a>
            </div>
            <div class="colored_card">
              <p></p> <a href="//zikroarg.com/4/5051836" target="_blank" data-value="2" class="addlink" onclick="seeadd(this);">ClickToSeeAd</a>
            </div>
            <div class="colored_card">
              <p></p> <a href="//zikroarg.com/4/5051836" target="_blank" data-value="3" class="addlink" onclick="seeadd(this);">ClickToSeeAd</a>
            </div>
            <div class="colored_card">
              <p></p> <a href="//zikroarg.com/4/5051836" target="_blank" data-value="4" class="addlink" onclick="seeadd(this);">ClickToSeeAd</a>
            </div>
            <div class="colored_card">
              <p></p> <a href="//zikroarg.com/4/5051836" target="_blank" data-value="5" class="addlink" onclick="seeadd(this);">ClickToSeeAd</a>
            </div>
            <div class="colored_card">
              <p></p> <a href="//zikroarg.com/4/5051836" target="_blank" data-value="6" class="addlink" onclick="seeadd(this);">ClickToSeeAd</a>
            </div>
            <div class="colored_card">
              <p></p> <a href="//zikroarg.com/4/5051836" target="_blank" data-value="7" class="addlink" onclick="seeadd(this);">ClickToSeeAd</a>
            </div>
            <div class="colored_card">
              <p></p> <a href="//zikroarg.com/4/5051836" target="_blank" data-value="8" class="addlink" onclick="seeadd(this);">ClickToSeeAd</a>
            </div>
            <div class="colored_card">
              <p></p> <a href="//zikroarg.com/4/5051836" target="_blank" data-value="9" class="addlink" onclick="seeadd(this);">ClickToSeeAd</a>
            </div>
            <!------adsence----->
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7556331893650213" crossorigin="anonymous"></script>
            <!----close---->
          </div>
        </div>

        <!----AdBlock special---->
        <br><br>
        <!------AdBlock specialclose---->
        <div class="row">
          <div class="col-md-4 col-sm-6 ">
            <div class="x_panel fixed_height_320">
              <div class="x_title">
                <h2>App Devices <small>Sessions</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Settings 1</a>
                      <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <h4>App Versions</h4>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>1.5.2</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>123k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>1.5.3</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>53k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>1.5.4</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>23k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>1.5.5</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>3k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>0.1.5.6</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>1k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>

              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-6 ">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2>Daily users <small>Sessions</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Settings 1</a>
                      <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table class="" style="width:100%">
                  <tr>
                    <th style="width:37%;">
                      <p>Top 5</p>
                    </th>
                    <th>
                      <div class="col-lg-7 col-md-7 col-sm-7 ">
                        <p class="">Device</p>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5 ">
                        <p class="">Progress</p>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                    </td>
                    <td>
                      <table class="tile_info">
                        <tr>
                          <td>
                            <p><i class="fa fa-square blue"></i>IOS </p>
                          </td>
                          <td>30%</td>
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square green"></i>Android </p>
                          </td>
                          <td>10%</td>
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square purple"></i>Blackberry </p>
                          </td>
                          <td>20%</td>
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square aero"></i>Symbian </p>
                          </td>
                          <td>15%</td>
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square red"></i>Others </p>
                          </td>
                          <td>30%</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-6 ">
            <div class="x_panel fixed_height_320">
              <div class="x_title">
                <h2>Profile Settings <small>Sessions</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Settings 1</a>
                      <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="dashboard-widget-content">
                  <ul class="quick-list">
                    <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a></li>
                    <li><i class="fa fa-thumbs-up"></i><a href="#">Favorites</a></li>
                    <li><i class="fa fa-calendar-o"></i><a href="#">Activities</a></li>
                    <li><i class="fa fa-cog"></i><a href="#">Settings</a></li>
                    <li><i class="fa fa-area-chart"></i><a href="#">Logout</a></li>
                  </ul>

                  <div class="sidebar-widget">
                    <h4>Profile Completion</h4>
                    <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
                    <div class="goal-wrapper">
                      <span id="gauge-text" class="gauge-value gauge-chart pull-left">0</span>
                      <span class="gauge-value pull-left">%</span>
                      <span id="goal-text" class="goal-value pull-right">100%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-6  widget_tally_box">
            <div class="x_panel">
              <div class="x_title">
                <h2>User Uptake</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Settings 1</a>
                      <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div id="graph_bar" style="width:100%; height:200px;"></div>

                <div class=" bg-white progress_summary">

                  <div class="row">
                    <div class="progress_title">
                      <span class="left">Escudor Wireless 1.0</span>
                      <span class="right">This sis</span>
                      <div class="clearfix"></div>
                    </div>

                    <div class="">
                      <span>SSD</span>
                    </div>
                    <div class="">
                      <div class="progress progress_sm">
                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="89"></div>
                      </div>
                    </div>
                    <div class=" more_info">
                      <span>89%</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="progress_title">
                      <span class="left">Mobile Access</span>
                      <span class="right">Smart Phone</span>
                      <div class="clearfix"></div>
                    </div>

                    <div class="">
                      <span>App</span>
                    </div>
                    <div class="">
                      <div class="progress progress_sm">
                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="79"></div>
                      </div>
                    </div>
                    <div class=" more_info">
                      <span>79%</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="progress_title">
                      <span class="left">WAN access users</span>
                      <span class="right">Total 69%</span>
                      <div class="clearfix"></div>
                    </div>

                    <div class="">
                      <span>Usr</span>
                    </div>
                    <div class="">
                      <div class="progress progress_sm">
                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="69"></div>
                      </div>
                    </div>
                    <div class=" more_info">
                      <span>69%</span>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <!-- start of weather widget -->
          <div class="col-md-4 col-sm-6 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>Today's Weather <small>Sessions</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Settings 1</a>
                      <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="temperature"><b>Monday</b>, 07:30 AM
                      <span>F</span>
                      <span><b>C</b>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="weather-icon">
                      <span>
                        <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                      </span>

                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="weather-text">
                      <h2>Texas
                        <br><i>Partly Cloudy Day</i>
                      </h2>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="weather-text pull-right">
                    <h3 class="degrees">23</h3>
                  </div>
                </div>
                <div class="clearfix"></div>


                <div class="row weather-days">
                  <div class="col-sm-2">
                    <div class="daily-weather">
                      <h2 class="day">Mon</h2>
                      <h3 class="degrees">25</h3>
                      <span>
                        <canvas id="clear-day" width="32" height="32">
                        </canvas>

                      </span>
                      <h5>15
                        <i>km/h</i>
                      </h5>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="daily-weather">
                      <h2 class="day">Tue</h2>
                      <h3 class="degrees">25</h3>
                      <canvas height="32" width="32" id="rain"></canvas>
                      <h5>12
                        <i>km/h</i>
                      </h5>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="daily-weather">
                      <h2 class="day">Wed</h2>
                      <h3 class="degrees">27</h3>
                      <canvas height="32" width="32" id="snow"></canvas>
                      <h5>14
                        <i>km/h</i>
                      </h5>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="daily-weather">
                      <h2 class="day">Thu</h2>
                      <h3 class="degrees">28</h3>
                      <canvas height="32" width="32" id="sleet"></canvas>
                      <h5>15
                        <i>km/h</i>
                      </h5>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="daily-weather">
                      <h2 class="day">Fri</h2>
                      <h3 class="degrees">28</h3>
                      <canvas height="32" width="32" id="wind"></canvas>
                      <h5>11
                        <i>km/h</i>
                      </h5>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="daily-weather">
                      <h2 class="day">Sat</h2>
                      <h3 class="degrees">26</h3>
                      <canvas height="32" width="32" id="cloudy"></canvas>
                      <h5>10
                        <i>km/h</i>
                      </h5>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>

          </div>
          <!-- end of weather widget -->

          <div class="col-md-4 col-sm-6 ">
            <div class="x_panel fixed_height_320">
              <div class="x_title">
                <h2>Incomes <small>Sessions</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Settings 1</a>
                      <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="dashboard-widget-content">
                  <ul class="quick-list">
                    <li><i class="fa fa-bars"></i><a href="#">Subscription</a></li>
                    <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                    <li><i class="fa fa-support"></i><a href="#">Help Desk</a> </li>
                    <li><i class="fa fa-heart"></i><a href="#">Donations</a> </li>
                  </ul>

                  <div class="sidebar-widget">
                    <h4>Goal</h4>
                    <canvas width="150" height="80" id="chart_gauge_02" class="" style="width: 160px; height: 100px;"></canvas>
                    <div class="goal-wrapper">
                      <span class="gauge-value pull-left">$</span>
                      <span id="gauge-text2" class="gauge-value pull-left">3,200</span>
                      <span id="goal-text2" class="goal-value pull-right">$5,000</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

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

    <script>
      document.getElementsByClassName("addlink").addEventListener("click", function(event) {
        event.preventDefault()
      });

      function getCookie(user) {
        var cookieArr = document.cookie.split(";");
        for (var i = 0; i < cookieArr.length; i++) {
          var cookiePair = cookieArr[i].split("=");
          if (user == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
          }
        }
        return null;
      }

      function addSeen(arr, length, uid) {
        for (var i = 1; i <= length; i++) {
          if (arr[i] == 0) {
            return;
          }
        }
        if (arr[0] == 0) {

          $.post('changewallet.php', {
            userid: uid
          })
          arr[0] = 1;
          var d = new Date();
          var length = 9;
          d.setDate(d.getDate() + 1);
          const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
          let day = days[d.getDay()];
          const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
          let month = months[d.getMonth()];
          document.cookie = uid + "=" + arr + "; expires=" + day + ", " + d.getDate() + month + d.getFullYear() + "00:00:00 UTC";
        }
      }

      function seeadd(d) {
        var addno = $(d).data('value');
        var uid = document.getElementById('uid').value;
        var d = new Date();
        var length = 9;
        $.post('add-count.php', {
            userid: uid ,
            length : length ,
            addno : addno
          })
        d.setDate(d.getDate() + 1);
        const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        let day = days[d.getDay()];
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        let month = months[d.getMonth()];
        if (!getCookie(uid)) {
          var arr = [];
          for (var i = 0; i <= length; i++) {
            arr[i] = 0;
          }
          document.cookie = uid + "=" + arr + "; expires=" + day + ", " + d.getDate() + month + d.getFullYear() + "00:00:00 UTC";
        }
        var mycookie = getCookie(uid);
        var arr = mycookie.split(',');

        arr[addno] = 1;

        document.cookie = uid + "=" + arr + "; expires=" + day + ", " + d.getDate() + month + d.getFullYear() + "00:00:00 UTC";
        console.log(arr);

        // addSeen(arr, length, uid);

      }
    </script>

</body>

</html>