<?php 

require '../connection.php';

$input = json_decode(file_get_contents('php://input'));
$itemId = $input->itemId;


if ($_SERVER['REQUEST_METHOD']=='POST'){

    $sql = "DELETE FROM items WHERE id=$itemId";

    if ($conn->query($sql) === TRUE){
        $response = "Item deleted successfully";
    } else {
        $response = "sql query failed";
    }
    
    echo $response;
    $conn->close();
}

?>