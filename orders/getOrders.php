<?php 

require '../connection.php';

if ($_SERVER['REQUEST_METHOD']=='GET'){
    $orders_array = array();

    $sql = "SELECT orders.id, orders.user_id, users.username, orders.items, orders.amount, orders.address, orders.recipient, orders.shipping, orders.deliver_status FROM orders
    INNER JOIN users ON orders.user_id=users.id WHERE orders.deliver_status=0";

    if ($result = $conn->query($sql)){
        while($row = mysqli_fetch_assoc($result))
        {
            $orders_array[] = $row;
        }
        echo json_encode($orders_array);
    } else {
        echo "sql query failed";
    }

}

?>