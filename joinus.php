<?php
include("dbconfig.php");
if (isset($_POST['submit'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phno = $_POST['phno'];
  $uid = $_POST['uid'];
  $ref_code = $_POST['ref_code'];
  $address = $_POST['address'];
  $pwd = $_POST['pwd'];
  $cpwd = $_POST['cpwd'];

  $checkAlrExist = mysqli_query($conn, "SELECT * FROM joinus WHERE uid = '$uid'");
  $row_checkAlrExist = mysqli_num_rows($checkAlrExist);

  $emailExist = mysqli_query($conn, "SELECT * FROM joinus WHERE email = '$email'");
  $row_emailExist = mysqli_num_rows($emailExist);

  $phExist = mysqli_query($conn, "SELECT * FROM joinus WHERE phno = '$phno'");
  $row_phExist = mysqli_num_rows($phExist);

  if ($row_checkAlrExist > 0) {
    echo '<script>alert("This UserId already exist... Please try with another...")</script>';
  } else if ($row_emailExist > 0) {
    echo '<script>alert("[!]This email already exist! Please try with another...")</script>';
  } else if ($row_phExist > 0) {
    echo '<script>alert("[!]Your contact number already exist! Please try with another...")</script>';
  } else {
    if ($pwd == $cpwd) {
      $result = mysqli_query($conn, "SELECT count(*) as total from joinus");
      $data = mysqli_fetch_assoc($result);
      $lastid = $data['total'];
      $r = rand(10, 99);
      $my_ref_id = "YNE" . "$lastid" . "$r";


      // Retrieving the id of its parent from joinus table
      $sql = "select * from joinus where my_ref_code='$ref_code'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      // Retrieving the id of user from joinus table
      // $sql = "select * from joinus where uid='$uid'";
      // $result = $conn->query($sql);
      // $row = $result->fetch_assoc();
      $level = $row['level']+1;


      $sql = "INSERT INTO joinus (fname, lname, email, phno, uid, ref_code, my_ref_code, address, pwd, txn_id, status,level)
        VALUES ('$fname', '$lname', '$email', '$phno', '$uid', '$ref_code', '$my_ref_id', '$address', '$pwd', 'None', 'Deactivate','$level')";
      if ($conn->query($sql)) {

        // Retrieving the id of user from joinus table
      $sql = "select * from joinus where uid='$uid'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $uid = $row['id'];


        // Retrieving the id of its parent from joinus table
        $sql = "select * from joinus where my_ref_code='$ref_code'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $p_id = $row['id'];
        // Incrementing the level of current user by 1 of its parent's level
        $level = $row['level'] + 1;
        
        // Inserting the data into joinus-data table
        $sql = "INSERT INTO `joinus-data`(`u_id`, `p_id`, `ref_code`, `my_ref_code`, `level`) VALUES ('$uid','$p_id','$ref_code','$my_ref_id','$level')";
        $conn->query($sql);

 
        // $sql = "select * from `joinus-data` where my_ref_code='$ref_code'";
        // $result = $conn->query($sql);
        // $i = 1;
        // while($result->num_rows!=0){
        //   if($i==1){
        //     $inc = 30;
        //   }elseif($i==2){
        //     $inc = 15;
        //   }elseif($i==3 || $i==4){
        //     $inc = 10;
        //   }else{
        //     $inc = 5;
        //   }
        //   $sql = "update `joinus-data` set wallet=wallet+'$inc' where my_ref_code='$ref_code'";
        //   $conn->query($sql);
        //   $sql = "update `joinus` set wallet=wallet+'$inc' where my_ref_code='$ref_code'";
        //   $conn->query($sql);
        //   $i++;
        //   $sql = "select * from `joinus-data` where my_ref_code = '$ref_code'" ;
        //   $result = $conn->query($sql);
        //   if($result->num_rows!=0){
        //     $row = $result->fetch_assoc();
        //     $ref_code = $row['ref_code'];
        //   }

        // }

        echo '<script>alert("Registration Successfull..")</script>';
        echo '<script>location.replace("https://rzp.io/l/8usToKi")</script>';
        // echo '<script>document.location.replace="https://rzp.io/l/8usToKi"</script>';

        // header("Location: ./sign-in.php");
      } else {
        echo '<script>alert("Ooops!!! Something went wrong, try again...")</script>';
      }
    } else {
      echo '<script>alert("Password and confirm password are not same.")</script>';
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Smart Network
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/soft-design-system.css?v=1.0.5" rel="stylesheet" />

  <style>
    body {
      background-color: #ed85ff;
    }
  </style>
</head>

<body class="contact-us">

  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <?php include('navbar.php'); ?>
      </div>
    </div>
  </div>

  <!-- -------- Join Us Form ------- -->
  <header>
    <div class="page-header min-vh-85">
      <div>
        <img class="position-absolute fixed-top ms-auto w-50 h-100 z-index-0 d-none d-sm-none d-md-block border-radius-section border-top-end-radius-0 border-top-start-radius-0 border-bottom-end-radius-0" src="./assets/img/curved-images/curved8.jpg" alt="image">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-7 d-flex justify-content-center flex-column">
            <div class="card d-flex blur justify-content-center p-4 shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
              <div class="text-center">
                <h3 class="text-gradient text-primary">Join us</h3>
                <p class="mb-0">
                  Let's join together and do something really big.
                </p>
              </div>
              <form id="contact-form" action="?" method="POST" autocomplete="on">
                <div class="card-body pb-2">
                  <div class="row">
                    <div class="col-md-6">
                      <label>First Name</label>
                      <div class="input-group mb-4">
                        <input required class="form-control" placeholder="First Name" name="fname" aria-label="First Name" type="text">
                      </div>
                    </div>
                    <div class="col-md-6 ps-md-2">
                      <label>Last Name</label>
                      <div class="input-group">
                        <input required type="text" class="form-control" placeholder="Last Name" name="lname">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <label>Email</label>
                      <div class="input-group mb-4">
                        <input required class="form-control" placeholder="example@gmail.com" aria-label="Email" name="email" type="email">
                      </div>
                    </div>
                    <div class="col-md-6 ps-md-2">
                      <label>Contact Number</label>
                      <div class="input-group">
                        <input required type="tel" class="form-control" placeholder="Contact Number" name="phno">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <label>User ID</label>
                      <div class="input-group mb-4">
                        <input required class="form-control" placeholder="User ID" aria-label="User ID" name="uid" type="text">
                      </div>
                    </div>
                    <div class="col-md-6 ps-md-2">
                      <label>Refferal Code</label>
                      <div class="input-group">
                        <input required type="text" class="form-control" placeholder="Refferal Code" name="ref_code">
                      </div>
                    </div>
                  </div>

                  <div class="form-group mb-0 mt-md-0 mt-4">

                    <label>Full Address</label>
                    <textarea required name="address" class="form-control mb-4" id="address" rows="6" placeholder="Enter Your Full Address"></textarea>

                    <div class="row">
                      <div class="col-md-6">
                        <label>Password</label>
                        <div class="input-group mb-4">
                          <input required class="form-control" placeholder="Password" aria-label="Password" name="pwd" type="Password">
                        </div>
                      </div>
                      <div class="col-md-6 ps-md-2">
                        <label>Confirm Password</label>
                        <div class="input-group">
                          <input required type="password" class="form-control" placeholder="Confirm Password" name="cpwd">
                        </div>
                      </div>
                    </div>


                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <button name="submit" type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Join With Us</button>

                      <div class="card-footer text-center pt-0 px-lg-2 px-1 mt 3 ">
                        <p class="mb-4 text-sm mx-auto mt-3">
                          Already have an account?
                          <a href="sign-in.php" class="text-primary text-gradient font-weight-bold">Sign in</a>
                        </p>
                      </div>

                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- -------- END HEADER 8 w/ card over right bg image ------- -->

  <?php include("footer.php"); ?>

  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
  <script src="./assets/js/plugins/parallax.min.js"></script>
  <!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
  <script src="./assets/js/soft-design-system.min.js?v=1.0.5" type="text/javascript"></script>
</body>

</html>