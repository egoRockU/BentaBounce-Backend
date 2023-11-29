<?php 

require '../connection.php';

$loginInput = json_decode(file_get_contents('php://input'));

$user = $loginInput->user;
$password = $loginInput->password;


if ($_SERVER['REQUEST_METHOD']=='POST'){

    $sql_select = "SELECT * FROM users WHERE (username='$user' OR email='$user') AND password='$password' LIMIT 1";

    if ($result = $conn->query($sql_select)) {
        if ($data = $result->fetch_all(MYSQLI_ASSOC)) {
            $response = ["message"=>"Log in Success!", "status"=>"success", "user_id"=> $data[0]["id"], "username"=>$data[0]["username"]];
        } else {
            $response = ["message"=>"Incorrect username or password.", "status"=>"failed"];
        }
     } else {
        $response = $conn->error;
     }
     echo json_encode($response);
     $conn->close();
}



?>