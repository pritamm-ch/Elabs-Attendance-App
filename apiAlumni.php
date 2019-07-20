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
    $sql = "SELECT * FROM alumni";
    $result = $mysql->query($sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result))
        {
            array_push($response,array("id"=>$row['id'],"Name"=>$row['fname'],"Phone"=>$row['fnumber'],"Year of Passing"=>$row['yop'],"Email"=>$row['email'],"LinkedIn"=>$row['linkedin'],"Facebook"=>$row['facebook'],"Company"=>$row['company'],"Message"=>$row['fmessage'],"Photo"=>"www.kiitelabs.com/wp-content/uploads/palumni/".$row['photo']));
        }
    }
        
        }
        
   


echo json_encode(array("server_response"=>$response));

?>