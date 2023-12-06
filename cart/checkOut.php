<?php 

require '../connection.php';

$input = json_decode(file_get_contents('php://input'));
$cartId = $input->cart_id;
$itemId = $input->item_id;
$count = $input->count;
$stocks = $input->stocks;

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $sql_delete = "DELETE FROM cart_items WHERE id=$cartId";
    $sql_update = "UPDATE items SET stocks=stocks-$count WHERE id=$itemId";

    $sql_delete_item = "DELETE FROM items WHERE id=$itemId";

    if ($conn->query($sql_delete) === TRUE){
        $response = "Cart checked out successfully";
    } else {
        $response = "sql_delete query failed";
    }

    if (intval($count) === intval($stocks)){
        if ($conn->query($sql_delete_item) === TRUE){
            $response = $response . " Item out of stock, item deleted";
        } else {
            $response = $response . " sql_delete_item query failed";
        }
    } else {
        if ($conn->query($sql_update) === TRUE){
            $response = $response . " Item updated successfully";
        } else {
            $response = $response . " sql_update query failed";
        }
    }
    
    echo $response;
    $conn->close();

}


?>