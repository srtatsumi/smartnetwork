<?php
session_start();
include("../../dbconfig.php");
$uid = $_SESSION['uid'];
$u_id=$_SESSION['u_id'];
if(empty($_REQUEST['bank_details'])){
	echo '<script>document.location.href="./"</script>';
}else{
    $sql = "update `joinus-data` set bank_details='$_REQUEST[bank_details]' where u_id='$u_id'";
    $update=$conn->query($sql);
    if($update){
        echo "<script>alert('Updated');document.location.href='./'</script>";
    }else{
        echo "<script>alert('Not Updated');document.location.href='./'</script>";;
    }
}

