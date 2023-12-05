<?php 

require '../connection.php';

$input = json_decode(file_get_contents('php://input'));
$user_id = $input->user_id;

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $sql = "SELECT id, username, email, photo, bio FROM users WHERE id=$user_id LIMIT 1";

    if ($result = $conn->query($sql)) {
        if ($data = $result->fetch_all(MYSQLI_ASSOC)) {
            $response = ["username"=>$data[0]["username"], "email"=>$data[0]["email"], "photo"=>base64_encode($data[0]["photo"]), "bio"=>$data[0]["bio"], "id"=>$data[0]["id"]];
        } else {
            $response = ["message"=>"User Not Found", "status"=>"failed"];
        }
     } else {
        $response = $conn->error;
     }
     echo json_encode($response);
     $conn->close();
}

?>