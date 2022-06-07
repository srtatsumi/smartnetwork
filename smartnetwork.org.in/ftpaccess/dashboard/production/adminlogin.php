<?php 
  include("../../dbconfig.php");
  if(isset($_POST['submit'])){
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT * FROM myadmin WHERE uid = '$uid' AND pwd = '$pwd'";
    $res = $conn->query($sql);
    $n = mysqli_num_rows($res);

    if ($n>0) {
      session_start();
      $_SESSION['uid'] = $uid;
      // session_unset(); REMOVE ALL SESSINO VARIABLE
      // session_destroy() Destroy current session
      echo '<script>alert("Valid Credentials !!!")</script>';
      echo '<script>document.location.href="./admindash.php"</script>';
     // header("Location: ./admindash.php");
    }else {
      echo '<script>alert("Invalid Credentials !!!")</script>';
    }
    $conn->close();
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

    <title>Smart Network | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="?" method="POST">
              <h1>Admin Login</h1>
              <div>
                <input type="text" class="form-control" name="uid" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="pwd" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" name="submit" class="btn btn-success">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <!-- <h1><i class="fa fa-paw"></i> Smart Network</h1> -->
                  All rights reserved. Copyright © <script>
                document.write(new Date().getFullYear())
              </script> Smart Network by <a>Healing Buddy Technologies</a>.
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Smart Network</h1>
                  <p>©2016 All Rights Reserved. Smart Network is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
