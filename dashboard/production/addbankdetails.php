<?php
session_start();
include("../../dbconfig.php");
$uid = $_SESSION['uid'];
$u_id=$_SESSION['u_id'];

$bank_name=$_REQUEST['bank_name'];
$acnt_num=$_REQUEST['bank_accnt_num'];
$acnt_name=$_REQUEST['bank_accnt_name'];
$acnt_ifsc=$_REQUEST['bank_ifsc_code'];

$bank_details=$bank_name.$acnt_name.$acnt_num.$acnt_ifsc;

// $_REQUEST['bank_details']

if(empty($bank_details)){
	echo '<script>document.location.href="./"</script>';
}else{
    $sql = "update `joinus-data` set bank_details='$bank_details' where u_id='$u_id'";
    $update=$conn->query($sql);
    if($update){
        echo "<script>alert('Updated');document.location.href='./'</script>";
    }else{
        echo "<script>alert('Not Updated');document.location.href='./'</script>";;
    }
}

