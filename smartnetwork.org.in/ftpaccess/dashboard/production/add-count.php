<?php
session_start();
if (isset($_SESSION['uid'])) {
    include("../../dbconfig.php");
    $uid = $_POST['userid'];
    $length = $_POST['length'];
    $addno = $_POST['addno'];

    $sql = "select * from joinus where uid='$uid'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $today =  date("Y-m-d");
    $last_redeemed = $row['last_redeemed'];
    $redeemed = $row['redeemed'];
    if($last_redeemed!=$today){
        $arr = array_fill(0, $length, 0);
        $add_count = implode("", $arr);
        $sql = "update joinus set add_count='$add_count' where uid='$uid'";
        $conn->query($sql);
        $sql = "select * from joinus where uid='$uid'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
    }
    $add_count = $row['add_count'];
    $level = $row['level'];
    $ref_code = $row['ref_code'];

    // checking whether array exist or not
    if ($add_count == NULL || $add_count == "NULL" || $add_count == "") {
        $arr = array_fill(0, $length, 0);
    } else {
        $arr = str_split($add_count);
    }

    // set 1 on addno watched
    $arr[$addno - 1] = 1;


    // $x = $arr[1] ;

    // converting array into string for storing into database
    $add_count = implode("", $arr);


    $sql = "update joinus set add_count='$add_count' where uid='$uid'";
    $conn->query($sql);

    $flag = true;
    for ($i = 0; $i < $length; $i++) {
        if ($arr[$i] == 0) {
            $flag = false;
            // break;
        }
    }
    if ($flag) {

        if (($last_redeemed != $today || $last_redeemed=="" || $last_redeemed==NULL)) {
            $last_redeemed = $today;
            $redeemed = 1 ;

            $sql = "update joinus set last_redeemed='$last_redeemed' where uid='$uid'" ;
            $conn->query($sql);

            $sql = "update `joinus-data` set wallet=wallet+'45' where ref_code='$ref_code'";
            $conn->query($sql);
            $sql = "update `joinus` set wallet=wallet+'45' where uid='$uid'";
            $conn->query($sql);

            $sql = "select * from `joinus-data` where my_ref_code='$ref_code'";
            $result = $conn->query($sql);
            $i = 1;
            while ($result->num_rows != 0) {
                if ($i == 1) {
                    $inc = 5;
                } elseif ($i == 2) {
                    $inc = 2;
                } else {
                    $inc = 1;
                }
                $sql = "update `joinus-data` set wallet=wallet+'$inc' where my_ref_code='$ref_code'";
                $conn->query($sql);
                $sql = "update `joinus` set wallet=wallet+'$inc' where my_ref_code='$ref_code'";
                $conn->query($sql);
                $i++;
                $sql = "select * from `joinus-data` where my_ref_code = '$ref_code'";
                $result = $conn->query($sql);
                if ($result->num_rows != 0) {
                    $row = $result->fetch_assoc();
                    $ref_code = $row['ref_code'];
                }
            }
        }
    }
} else {
    // header("Location: ../../pages/sign-in.php");
    echo '<script>document.location.href="../../sign-in.php"</script>';
}
