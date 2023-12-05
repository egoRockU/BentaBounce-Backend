<?php 

require '../connection.php';

$input = json_decode(file_get_contents('php://input'));
$userId = $input->user_id;
$bio = $input->bio;

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $sql = "UPDATE users SET bio='$bio' WHERE id='$userId'";

    if ($conn->query($sql) === TRUE){
        $response = "Bio updated successfully";
    } else {
        $response = "sql query failed";
    }

    echo $response;
    $conn->close();
}

?>