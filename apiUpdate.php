
<?php

header("Content-Type: application/json; charset=UTF-8");

define("SERVER", "localhost");
define("USER", "kiitelab_root");
define("PASSWORD", "SagnikPaul 28");
define("DB", "kiitelab_db");

$response= array();
$mysql = new mysqli(SERVER,USER,PASSWORD,DB);

if( $mysql->connect_error)
{
    $response["MESSAGE"] = "INTERNAL SERVER ERROR";
    $response["STATUS"] = 500;
}
else{
//   $data = json_decode(file_get_contents('php://input'));
//   $rroll = $data->roll;
//   $rimei = $data->imei;
//   $rsubject = $data->subject;
      $rimei = $_POST['imei'];
      $rroll = $_POST['roll'];
      $rsubject = $_POST['subject'];
      
      
       $sql = "INSERT INTO i_update(roll,imei,subject) VALUES('$rimei','$rroll','$rsubject')";

       if($mysql->query($sql)){
        
        $response["MESSAGE"] = "DATA SAVED";
        $response["STATUS"] = 200;
       }
       else{
        //echo json_encode($sql);
        $response["MESSAGE"] = "SAVE DATA FAILED";
        $response["STATUS"] = 300;
       }
      
    // else{
    //     $response["MESSAGE"] = "INVALID REQUEST";
    //     $response["STATUS"] = 400;

    // }
}


    echo json_encode($response);

?>