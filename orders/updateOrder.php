<?php 

require '../connection.php';

$input = json_decode(file_get_contents('php://input'));
$id = $input->id;
$seller_id = $input->sellerId;
$amount = $input->amount;
$shipping = $input->shipping;

echo $amount;

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $orders_array = array();

    $sql_update_wallet = "UPDATE users SET wallet=wallet+$amount WHERE id=$seller_id";
    $sql_update_status = "UPDATE orders SET deliver_status=1 WHERE id=$id";
    $sql_update_admin = "UPDATE admin SET income=income+$shipping WHERE id=1";

    if ($conn->query($sql_update_wallet) === TRUE && $conn->query($sql_update_status) === TRUE && $conn->query($sql_update_admin)){
        $response = "Order has been delivered";
    } else {
        $response = "sql query failed";
    }

    echo $response;
    $conn->close();
}

?>