<?php 

require '../connection.php';

$input = json_decode(file_get_contents('php://input'));
$userId = $input->user_id;
$order_name = $input->order_name;
$amount = $input->amount;
$address = $input->address;
$recipient = $input->recipient;
$shipping = $input->shipping;
$itemsToUpdate = $input->itemsToUpdate;

// echo $userId;
// echo $amount;
// echo $address;
// echo $recipient;
// echo $shipping;
// //print_r($itemsToUpdate);

// foreach($itemsToUpdate as $item){
//     echo $item->cart_id;
//     echo $item->item_id;
//     echo $item->quantity;
// }

if ($_SERVER['REQUEST_METHOD']=='POST'){
    
    $sql_insert = "INSERT INTO orders (id, user_id, items, amount, address, recipient, shipping) 
    VALUES (null, $userId, '$order_name', $amount, '$address', '$recipient', $shipping)";

    if ($conn->query($sql_insert) === TRUE){
        $response = "Order created added successfully";

        foreach($itemsToUpdate as $item){
            $cartId = $item->cart_id;
            $itemId = $item->item_id;
            $quantity = $item->quantity;

            $sql_cart_delete = "DELETE FROM cart_items WHERE id=$cartId";
            $sql_item_update = "UPDATE items SET stocks=stocks-$quantity WHERE id=$itemId";

            if ($conn->query($sql_cart_delete) === TRUE && $conn->query($sql_item_update) === TRUE){
                $response = $response . " Items and Cart updated";
            } else {
                $response = $response . " Items and Cart update Failed";
            }
        }

    } else {
        $response = "sql query failed";
    }

    echo $response;
    $conn->close();

}

?>