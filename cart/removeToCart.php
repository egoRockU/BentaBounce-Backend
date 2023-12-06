<?php 

require '../connection.php';

$input = json_decode(file_get_contents('php://input'));
$cartId = $input->cart_id;

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $sql = "DELETE FROM cart_items WHERE id=$cartId";

    if ($conn->query($sql) === TRUE){
        $response = "Item remove successfully";
    } else {
        $response = "sql query failed";
    }
    
    echo $response;
    $conn->close();
}

?>