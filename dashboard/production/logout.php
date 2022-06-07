<?php 
  session_start();
  if(isset($_SESSION['uid'])){
    include("../../dbconfig.php");
    $uid = $_SESSION['uid'];
    session_unset();
    session_destroy();
    // header("Location: ../../pages/sign-in.php");
    echo '<script>document.location.href="../../sign-in.php"</script>';
  }else{
    // header("Location: ../../pages/sign-in.php");
    echo '<script>document.location.href="../../sign-in.php"</script>';
  }
?>