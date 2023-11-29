<?php 

require '../connection.php';

$signupInput = json_decode(file_get_contents('php://input'));

$username = $signupInput->username;
$email = $signupInput->email;
$password = $signupInput->password;

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $sql_select = "SELECT * FROM users WHERE username='$username' AND email='$email' LIMIT 1";

    if ($result = $conn->query($sql_select)) {
        if ($result->fetch_all(MYSQLI_ASSOC)) {
            $response = ["message"=>"User already registered", "status"=>"failed"];
        } else {
            $response = insertUser($conn, $username, $email, $password);
        }
     } else {
        $response = $conn->error;
     }

    echo json_encode($response);
    $conn->close();
}

function insertUser($db_conn, $username, $email, $password){
    
    $sql_insert = "INSERT INTO users(id, username, email, password, photo) VALUES (null, '$username', '$email', '$password', null)";

    if ($db_conn->query($sql_insert) === TRUE){
        return ["message"=>"User has been successfully registered", "status"=>"success"];
    } else {
        return ["message"=>"User has NOT been successfully registered. SQL query failed", "status"=>"failed"];
    }

}

?>