/*
Template Name: apiLogin Page
*/
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
    $imei = $_POST['imei'];
    $roll = $_POST['roll'];
    $sql = "SELECT * FROM student WHERE imei='$imei' AND roll='$roll'";
    $result = $mysql->query($sql);
    if(mysqli_num_rows($result) == 1){
        $response["MESSAGE"] = "You're logged in";
        $response["STATUS"] = 200;
    }
    else{
        echo json_encode($sql);
        $response["MESSAGE"] = "wrong username/password combination";
        $response["STATUS"] = 404;
    }
   
}

echo json_encode($response);

?>