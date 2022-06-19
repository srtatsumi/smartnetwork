<?php 
include("dbconfig.php");
$sql="SELECT * FROM `joinus-data`";
$res=$conn->query($sql);
while($row = $res->fetch_assoc()){

    if(!empty($row['add_count']) || $row['redeemed']!=0){
        $sql1="UPDATE `joinus-data` SET `redeemed`='0',`add_count`=NULL";
        $res1=$conn->query($sql1);
    }
}




die();
?>