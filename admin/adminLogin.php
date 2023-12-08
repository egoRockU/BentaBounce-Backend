<?php 

require '../connection.php';

$loginInput = json_decode(file_get_contents('php://input'));

$user = $loginInput->adminName;
$password = $loginInput->adminPass;


if ($_SERVER['REQUEST_METHOD']=='POST'){

    $sql_select = "SELECT * FROM admin WHERE username='$user' AND password='$password' LIMIT 1";

    if ($result = $conn->query($sql_select)) {
        if ($data = $result->fetch_all(MYSQLI_ASSOC)) {
            $response = ["message"=>"Log in Success!", "status"=>"success", "data"=> $data];
        } else {
            $response = ["message"=>"Incorrect Admin name or password.", "status"=>"failed"];
        }
     } else {
        $response = $conn->error;
     }
     echo json_encode($response);
     $conn->close();
}



?>