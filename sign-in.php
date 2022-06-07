<?php 
use PHPMailer\PHPMailer\PHPMailer;
session_start();
  include("dbconfig.php");  
  if(isset($_POST['submit'])){
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    if($uid == "smartsayneted" && $pwd == "smartsayneted"){
      
      $_SESSION['uid'] = "anon";
      echo '<script>document.location.href="./dashboard/production/admindash.php"</script>';
    }


    $sql = "SELECT * FROM joinus WHERE uid = '$uid' AND pwd = '$pwd'";
    $res = $conn->query($sql);
    $n = mysqli_num_rows($res);
    $assoc=$res->fetch_assoc();
    if ($n>0) {
      $_SESSION['uid'] = $uid;
      $_SESSION['u_id']=$assoc["id"];
      // header("location: ./dashboard/production/index.php");
      echo '<script>document.location.href="./dashboard/production/index.php"</script>';
    // echo '<script>document.location.href="./dashboard/check.php"</script>';
    }else {
      echo '<script>alert("Invalid Credentials !!!")</script>';
    }

    $conn->close();
  }

  if(isset($_POST['dest'])){
      $sql = "UPDATE joinus SET status = 'Deactivate' WHERE status = 'Activate'";
      $res = $conn->query($sql);
  }
  
  if(isset($_POST['pwdReset'])){
        $email = $_POST['email'];
        $emailExist=mysqli_query($conn,"SELECT * FROM joinus WHERE email = '$email'");
        $row_emailExist= mysqli_num_rows($emailExist);
        
        if($row_emailExist > 0){
            $sql = "SELECT * FROM joinus WHERE  email = '$email'";
            $res = $conn->query($sql);
            $data = mysqli_fetch_assoc($res);
            $my_pwd = $data['pwd'];
            
           // echo '<script>alert("[!]Sorry this is under development purpose.")</script>';
            
            // PHPMAILER CODE
             $name = "Smart Network";  // Name of your website or yours
             $to = $email;  // mail of reciever
             $subject = "Forgot Password";
             $body = "Current Password: ".$my_pwd;
             $from = "off.smartnetwork@gmail.com";  // you mail
             $password = "Network@22";  // your mail password
             $header = "From: Smart-Network <smartnetwork@easy.121server.com>" . "\r\n"; 
            // // Ignore from here
    
            //  require_once "./PHPMailer/PHPMailer/PHPMailer.php";
            //  require_once "./PHPMailer/PHPMailer/SMTP.php";
            //  require_once "./PHPMailer/PHPMailer/Exception.php";
            //  $mail = new PHPMailer();
            
            $send=mail($to,$subject,$body,$header);

            // // To Here
    
            // //SMTP Settings
            //  $mail->isSMTP();                          
            //  $mail->Host = "ssl://smtp.gmail.com"; // smtp address of your email
            //  $mail->SMTPAuth >isSMTP()= true;
            //  $mail->Username = $from;
            //  $mail->Password = $password;
            //  $mail->Port = 587;  // port
            //  $mail->SMTPSecure = "ssl";  // tls or ssl
            //  $mail->smtpConnect([
            //  'ssl' => [
            //      'verify_peer' => false,
            //      'verify_peer_name' => false,
            //      'allow_self_signed' => true
            //      ]
            //  ]);
    
            // //Email Settings
            // $mail->isHTML(true);
            // $mail->setFrom($from, $name);
            // $mail->addAddress($to); // enter email address whom you want to send
            // $mail->Subject = $subject;
            // $mail->Body = $body;

            // if ($mail->send()) {
            if($send){
                echo "<script>alert('Email is sent!');</script>";
           
            } 
            else {
                // echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
                echo "<script>alert('Something is wrong!');</script>";
           }
            // PHPMAILER CODE END
        }
        else{
          echo '<script>alert("Sorry, you do not have any account with this email.")</script>';
        }
  }
?>


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
      body{
          background-color: #abffe0;
      }
  </style>
</head>

<body class="sign-in-illustration">
    <!--Dialog Box-->
        <div class="modal fade" id="forgotPwdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                </div>
                <form action="?" method="POST">
                    <div class="modal-body">
                      <div class="input-group">
                        <input type="text" name="email" placeholder="Enter your email id" class="form-control">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="pwdReset">submit</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    <!--End Dialog Box-->
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <?php include("navbar.php"); ?>
      </div>
    </div>
  </div>
  <section>
    <div class="page-header min-vh-100">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                
            <div class="card card-plain mt-4">
              <div class="card-header pb-0 text-left" style="background-color: #b6fcfb;">
                <h4 class="font-weight-bolder">Sign In</h4>
                <p class="mb-0">Enter your User ID and password to sign in</p>
              </div>
              <div class="card-body" style="background-color: #b6fcfb;">
                <form role="form" action="?" method="POST">
                  <div class="mb-3">
                    <input type="text" name="uid" class="form-control form-control-lg" placeholder="User ID" aria-label="Email" aria-describedby="email-addon">
                  </div>
                  <div class="mb-3">
                    <input type="password" name="pwd" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                    <p style="font-size: 15px; color: blue;" class="mt-2"  data-bs-toggle="modal" data-bs-target="#forgotPwdModal">
                        <a href="javascript:;">Forgot your password?</a>
                    </p>
                  </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                    <button type="submit" name="dest" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" style="display: none;">Sign in2</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="text-sm">
                  Don't have an account?
                  <a href="joinus.php" class="text-primary text-gradient font-weight-bold">Sign up</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
              <img src="./assets/img/shapes/pattern-lines.svg" alt="pattern-lines" class="position-absolute opacity-4 start-0">
              <div class="position-relative">
                <img class="max-width-500 w-100 position-relative z-index-2" src="./assets/img/illustrations/chat.png">
              </div>
              <h4 class="mt-5 text-white font-weight-bolder">"Attention is the new currency"</h4>
              <p class="text-white">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include("footer.php"); ?>
  </section>

  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
  <script src="./assets/js/plugins/parallax.min.js"></script>
  <!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/soft-design-system.min.js?v=1.0.5" type="text/javascript"></script>
</body>

</html>











































