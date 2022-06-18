<?php
session_start();
if($_SESSION['role'] !='admin'){
    echo '<script>document.location.href="adminlogin.php"</script>';
}

if (isset($_SESSION['uid'])) {
    include("../../dbconfig.php");
    $myrefid=$_REQUEST['refcd'];
    
    $delsql="DELETE FROM `joinus` WHERE `my_ref_code`='$myrefid'";
    $joinus = $conn->query($delsql);
    $delsql="DELETE FROM `joinus-data` WHERE `my_ref_code`='$myrefid'";
    $joinusdata = $conn->query($delsql);
    if($joinus && $joinusdata){
        echo '<script>alert("Deleted Successfully");document.location.href="admintotalteam.php"</script>'; 
    }else{
        echo '<script>alert("Not Deleted");document.location.href="admintotalteam.php"</script>'; 
    }
    var_dump($delsql);
}else {
    // header("Location: ../../pages/sign-in.php");
    echo '<script>document.location.href="adminlogin.php"</script>';
}
