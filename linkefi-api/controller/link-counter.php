<?php

// require_once ('../dbconnect.php');

if(isset($_GET['sl']) and $_GET['sl'] != null){
    $data = $_GET['sl'];
    $userip = getUserIpAddr();

    $sql = "SELECT `id`,`long_link`,`short_link` FROM `links` WHERE `short_link` = '$data'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $long_link_id = $row['id'];
            $redirect_link = $row['long_link'];
            break;
        }
    }

    $sql = "INSERT INTO `links_visitor_counter` (`visitor_ip`,`long_link_id`) VALUES('$userip',$long_link_id);";
    $queryStatus = mysqli_query($conn, $sql);
    if($queryStatus){
        header("Location:".$redirect_link);
    }
    mysqli_close($conn);
}


function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
