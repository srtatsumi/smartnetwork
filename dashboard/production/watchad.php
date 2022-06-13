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
  $ref_code = $data['ref_code'];
  // $wallet = $data['wallet'];
  $level = $data['level'];
  $u_id = $data['id'];
  date_default_timezone_set('Asia/Kolkata');
  $sql = "select * from `joinus-data` where u_id='$u_id'";
  $result = $conn->query($sql);
  $row = mysqli_fetch_assoc($result);
  $today =  date("Y-m-d");
  
  $redeemed_date=date("Y-m-d",strtotime($row['last_redeemed']));


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
  if (isset($_POST['widthdraw-money'])) {
    $money = $_POST['money'];
    if ($money > $row['wallet']) {
      echo "<script>alert('You do not have enough amount in your wallet.');</script>";
    } else {
      $sql = "update `joinus-data` set widthdraw='$money' where u_id='$u_id'";
      if ($conn->query($sql)) {
        echo "<script>alert('Your money will be credited in an hour');</script>";
      } else
        echo "<script>alert('Server Down. Please try again later.');</script>";
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
        <form method="post">
          <div class="modal-body">
            <h3><span id="withdraw-amount"><?php echo $row['wallet']; ?></span>/-</h3>
            <span id="withdraw_notice"></span>
            <button class="btn btn-primary m-auto" id="widthdraw-button" onclick="widthdraw()">Widthdraw</button>
            <div id="widthdraw-form">

              <form action="" class="form">
                <input type="number" name="money" class="form-control" required placeholder="Enter Amount">
                <button class="btn btn-danger m-2" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success m-2" name="widthdraw-money">Submit</button>
              </form>
            </div>
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
   <!--Bank Details Modal-->
   <div class="modal fade" id="exampleBank" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="text-align: center;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">&nbsp;Add Bank Account</h5>
          </div>
          <div class="modal-body">
            <form action="./addbankdetails.php" class="form" method="post">
              <input type="text" name="bank_name" class="form-control" placeholder='Bank Name' required>
              <input type="text" name="bank_accnt_name" class="form-control" placeholder='Bank Account Holder Name' required>
              <input type="text" name="bank_accnt_num" class="form-control" placeholder='Bank Account Number' required>
              <input type="text" name="bank_ifsc_code" class="form-control" placeholder='Bank IFSC Code' required>
              <button class="btn btn-danger m-2" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success m-2" name="add_bank">Submit</button>
            </form>
          </div>
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
            
                <?php 
                    $adssql = "SELECT * FROM adds";
                    $adres = $conn->query($adssql);
                    if($adres->num_rows<1){
                        echo "No Ads found";
                    }
                    $i=1;
                ?>
            <div id="">
                <div class="row">
                <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
                <input type="hidden" name="adcount" id="adcount" value="<?php echo $adres->num_rows; ?>">
                <?php
                    
                    while($addata = mysqli_fetch_assoc($adres)):

                ?>
                    
                    <div class="colored_card col-md-2 col-sm-6">
                        <a href="<?php echo $addata["add_url"] ?>" target="_blank" data-value="<?php echo $i ?>" class="addlink" onclick="seeadd(this);"><?php echo $i ?> Click To See Ad</a>
                    </div>
                    
                <?php
                    $i++;
                    endwhile;
                ?>
                    <!------adsence----->
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7556331893650213" crossorigin="anonymous"></script>
                    <!----close---->
                </div>
            </div>
            
            <!-- Header Count Sayed End-->
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

      // function getCookie(user) {
      //   var cookieArr = document.cookie.split(";");
      //   for (var i = 0; i < cookieArr.length; i++) {
      //     var cookiePair = cookieArr[i].split("=");
      //     if (user == cookiePair[0].trim()) {
      //       return decodeURIComponent(cookiePair[1]);
      //     }
      //   }
      //   return null;
      // }

      // function addSeen(arr, length, uid) {
      //   for (var i = 1; i <= length; i++) {
      //     if (arr[i] == 0) {
      //       return;
      //     }
      //   }
      //   if (arr[0] == 0) {

      //     $.post('changewallet.php', {
      //       userid: uid
      //     })
      //     arr[0] = 1;
      //     var d = new Date();
      //     var length = 9;
      //     d.setDate(d.getDate() + 1);
      //     const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      //     let day = days[d.getDay()];
      //     const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      //     let month = months[d.getMonth()];
      //     document.cookie = uid + "=" + arr + "; expires=" + day + ", " + d.getDate() + month + d.getFullYear() + "00:00:00 UTC";
      //   }
      // }

      function seeadd(d) {
        var addno = $(d).data('value');
        var uid = document.getElementById('uid').value;
        var adcount = document.getElementById('adcount').value;
        // console.log(adcount);
        var d = new Date();
        var length = adcount;
        $.post('add-count.php', {
          userid: uid,
          length: length,
          addno: addno
        })
        // d.setDate(d.getDate() + 1);
        // const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        // let day = days[d.getDay()];
        // const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        // let month = months[d.getMonth()];
        // if (!getCookie(uid)) {
        //   var arr = [];
        //   for (var i = 0; i <= length; i++) {
        //     arr[i] = 0;
        //   }
        //   document.cookie = uid + "=" + arr + "; expires=" + day + ", " + d.getDate() + month + d.getFullYear() + "00:00:00 UTC";
        // }
        // var mycookie = getCookie(uid);
        // var arr = mycookie.split(',');

        // arr[addno] = 1;

        // document.cookie = uid + "=" + arr + "; expires=" + day + ", " + d.getDate() + month + d.getFullYear() + "00:00:00 UTC";
        // console.log(arr);

        // addSeen(arr, length, uid);

      }
    </script>
    <script>
    
      function amountCheck(){
          var amount=document.getElementById('withdraw-amount');
          if(amount.innerText<500){
              button.style.display = "none";
              document.getElementById('withdraw_notice').innerHTML="You Can withdraw after wllet balance is 500.0/-";
          }
      }
      var form = document.getElementById('widthdraw-form');
      var button = document.getElementById('widthdraw-button');
      
      
      
      form.style.display = "none";
      button.style.display = "block";
      document.getElementById("widthdraw-button").addEventListener("click", function(event) {
        event.preventDefault()
      });

      function widthdraw() {
        form.style.display = "block";
        button.style.display = "none";
        // alert("He,lo");
      }
    </script>

</body>

</html>