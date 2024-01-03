<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Access-Control-Allow-Headers, Authorization, Access-Control-Allow-Origin');

// require_once ('../dbconnect.php');

$data = json_decode(file_get_contents('php://input'),true);

$result="";

if(isset($data['link']) and $data['link'] != null){

    $long_link = $data['link'];
    $short_url = generateRandomAlphabet();

    $sql = "INSERT INTO `links` (`long_link`, `short_link`,`link_active_status`) VALUES ('$long_link', '$short_url', 1);";
    $queryStatus = mysqli_query($conn, $sql);

    if($queryStatus){
        $result = [
            'status' => 200,
            'shortlink' => $short_url,
            'message' => 'Success to Generate link'
        ];
    
        echo json_encode($result);
    }else{
        $result = [
            'status' => 500,
            'message' => 'Server Error'
        ];
    
        echo json_encode($result);
    }

    mysqli_close($conn);
}else{
    $result = [
        'status' => 404,
        'message' => 'Failed to Generate link'
    ];

    echo json_encode($result);
}



function generateRandomAlphabet() {
    $length = rand(4, 6); // Generate a random length between 4 to 6

    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomAscii = rand(97, 122); // ASCII range for lowercase alphabets (a to z)
        $randomChar = chr($randomAscii);
        $randomString .= $randomChar;
    }

    return $randomString;
}