<?php
session_start();
if (isset($_SESSION['uid'])) {
include("../../dbconfig.php");
$uid = $_POST['userid'] ;

$sql = "select * from joinus where uid='$uid'" ;
$result = $conn->query($sql) ;
$row = mysqli_fetch_assoc($result) ;
$ref_code = $row['ref_code'] ;

// $sql = "update joinus set pwd='$uid' where uid='$uid'";
// $result = $conn->query($sql) ;

$sql = "update `joinus-data` set wallet=wallet+'45' where ref_code='$ref_code'";
          $conn->query($sql);
          $sql = "update `joinus` set wallet=wallet+'45' where uid='$uid'";
          $conn->query($sql);

$sql = "select * from `joinus-data` where my_ref_code='$ref_code'";
        $result = $conn->query($sql);
        $i = 1;
        while($result->num_rows!=0){
          if($i==1){
            $inc = 5;
          }elseif($i==2){
            $inc = 2;
          }else{
            $inc = 1;
          }
          $sql = "update `joinus-data` set wallet=wallet+'$inc' where my_ref_code='$ref_code'";
          $conn->query($sql);
          $sql = "update `joinus` set wallet=wallet+'$inc' where my_ref_code='$ref_code'";
          $conn->query($sql);
          $i++;
          $sql = "select * from `joinus-data` where my_ref_code = '$ref_code'" ;
          $result = $conn->query($sql);
          if($result->num_rows!=0){
            $row = $result->fetch_assoc();
            $ref_code = $row['ref_code'];
          }

        }
    } else {
        // header("Location: ../../pages/sign-in.php");
        echo '<script>document.location.href="../../sign-in.php"</script>';
      }



?>