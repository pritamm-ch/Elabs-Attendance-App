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
    $roll = $_POST['roll'];
    $dater = $_POST['date'];
    $sql = "SELECT * FROM attendance WHERE roll='$roll'";
    $result = $mysql->query($sql);
    if(mysqli_num_rows($result) == 1){
        $row = $result->fetch_assoc();
        $present = $row['present'];
        $present = $present + 1;
        $sql1 = "INSERT INTO attendance (present,dater) VALUES ('$present','$dater') WHERE roll='$roll'";
        // $response["Name"] = $row['name'];
        // $response["Email"] = $row['email'];
        // $response["Number"] = $row['number'];
        // $response["Subject"] = $row['course1'];
        $response["STATUS"] = 200;
        }
        
    }
    else{
        $sql2 = "INSERT INTO attendance (roll,present,dater) VALUES ('$roll',1,'$dater')";
        if ($mysql->query($sql2) === TRUE) {
            $response["MESSAGE"] = "Created successfully";
        } else {
            $response["MESSAGE"] = "Not created";
            $response["STATUS"] = 404;
        }
        
    }
   
}

echo json_encode($response);

?>