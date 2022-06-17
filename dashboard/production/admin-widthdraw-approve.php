<?php
include("../../dbconfig.php");
date_default_timezone_set('Asia/Kolkata');
if ($_POST['name'] == "approve") {
    $id = $_POST['id'];
    $sql = "select * from `joinus-data` where id='$id'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $money = $row['widthdraw'];
    $u_id = $row['u_id'];
    $sql = "update `joinus-data` set wallet=wallet-'$money' , widthdraw=0 where u_id='$id'";
    $conn->query($sql);
    $timestmp = date('m/d/Y h:i:s a', time());
    $sql = "INSERT INTO `transactions`(`u_id`,`date`, `mode`, `amount`) VALUES ('$u_id','$timestmp','0','$money')";
    $conn->query($sql);
    
}
if ($_POST['name'] == "decline") {
    $id = $_POST['id'];
    $sql = "select * from `joinus-data` where id='$id'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $money = $row['widthdraw'];
    $sql = "update `joinus-data` set widthdraw=0 where u_id='$id'";
    $conn->query($sql);
}
