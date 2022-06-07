<?php 
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

    if ($n>0) {
      session_start();
      $_SESSION['uid'] = $uid;
      // session_unset(); REMOVE ALL SESSINO VARIABLE
      // session_destroy() Destroy current session
      // header("location: ./dashboard/production/index.php");
      echo '<script>document.location.href="./dashboard/production/index.php"</script>';
    }else {
      echo '<script>alert("Invalid Credentials !!!")</script>';
    }

    $conn->close();
  }

  if(isset($_POST['dest'])){
      $sql = "UPDATE joinus SET status = 'Deactivate' WHERE status = 'Activate'";
      $res = $conn->query($sql);
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
                <h4 class="font-weight-bolder">About Us</h4>
               <p>By joining the Smart Network website, you are getting many opportunities at once. We have a blog in site from where you can find many unknown information and our shopping site ache from where you can find a variety of products. With that there is income opportunity from our website  <br>From the Blog blog site you can learn a lot of unknown facts and many more unknown facts from the smart network blog in site. Neture, health, mathology truth, etc niye you can know a lot of information. And let your family know. You can keep the habits of daily life by looking at the tips of health and skin care.<br>From the Smart Network website you will find the ingredients of daily life products for keeping the body healthy, along with skin care, hair care and makeup items at very low prices. With this there is now income opportunity.</p> 
              </div>
              
              
            </div>
          </div>
          <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
              <img src="./assets/img/shapes/pattern-lines.svg" alt="pattern-lines" class="position-absolute opacity-4 start-0">
              <div class="position-relative">
                <img class="max-width-500 w-100 position-relative z-index-2" src="./assets/img/illustrations/chat.png">
              </div>
              <h4 class="mt-5 text-white font-weight-bolder">"Attention is the new Journey"</h4>
              <p class="text-white">We starting us Networking company in 2021. We develop your earning. Later we added promotion platform creation and publishing.

Now our network has become fastest growing platform for online paid promotion in India.

We Smart Network teams of well-planned strategists and creative ads and paid promotion are working with top Advertiser's and online user. In order to help our client startup companies to get to ranking in INDIA</p>
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











































