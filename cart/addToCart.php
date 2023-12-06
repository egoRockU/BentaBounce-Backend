<?php 

require '../connection.php';

$input = json_decode(file_get_contents('php://input'));
$userId = $input->user_id;
$itemId = $input->item_id;
$quantity = $input->quantity;

if ($_SERVER['REQUEST_METHOD']=='POST'){
    
    $sql = "INSERT INTO cart_items (id, user_id, item_id, quantity) VALUES (null, $userId, $itemId, $quantity)";

    if ($conn->query($sql) === TRUE){
        $response = "Cart Item added successfully";
    } else {
        $response = "sql query failed";
    }

    echo $response;
    $conn->close();

}

?>