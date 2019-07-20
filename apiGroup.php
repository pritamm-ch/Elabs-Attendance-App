<?php

header("Content-Type: application/json; charset=UTF-8");

define("server", "localhost");
define("user", "kiitelab_root");
define("password", "SagnikPaul 28");
define("db", "kiitelab_db");

$response= array();
$mysql = new mysqli(server,user,password,db);

if( $mysql->connect_error)
{
    $response["MESSAGE"] = "INTERNAL SERVER ERROR";
    $response["STATUS"] = 500;
}
else{
    $subject = $_POST['subject'];
    $sql = "SELECT * FROM contact_us WHERE subject='$subject'";
    $result = $mysql->query($sql);
    if(mysqli_num_rows($result) == 1){
        $row = $result->fetch_assoc();
        $response["Whatsapp Group"] = $row['wgroup'];
        $response["STATUS"] = 200;
        }
        
    
    else{
        //echo json_encode($sql);
        $response["MESSAGE"] = "Subject not found";
        $response["STATUS"] = 404;
    }
   
}

echo json_encode($response);

?>