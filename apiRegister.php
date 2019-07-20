/*
Template Name: apiRegister Page
*/
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
    $jsonData = file_get_contents('php://input');
    $jsonDecode = json_decode($jsonData,true);

    if( is_array($jsonDecode)){


        foreach ($jsonDecode as $key => $value) {
            $_POST[$key] = $value;
        }
    }
      $rmobile = $_POST['mobile'];
      $rimei = $_POST['imei'];
      $rroll = $_POST['roll'];
      $rtoken = $_POST['token'];
      if(isset($rmobile) && isset($rimei) && isset($rroll) && isset($rtoken))
      {
       $sql = "INSERT INTO student(mobile,imei,roll,token) VALUES('$rmobile','$rimei','$rroll','$rtoken')";

       if($mysql->query($sql)){
        
        $response["MESSAGE"] = "DATA SAVED";
        $response["STATUS"] = 200;
       }
       else{
        echo json_encode($sql);
        $response["MESSAGE"] = "SAVE DATA FAILED";
        $response["STATUS"] = 500;
       }
    }
    else{
        $response["MESSAGE"] = "INVALID REQUEST";
        $response["STATUS"] = 400;

    }
      }
    echo json_encode($response);

?>