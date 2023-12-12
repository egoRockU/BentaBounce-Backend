<?php 

require '../connection.php';

$input = json_decode(file_get_contents('php://input'));
$userId = $input->user_id;

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $items_array = array();

    $sql = "SELECT 
            cart_items.id AS cart_id, 
            items.id AS item_id, 
            items.user_id AS seller_id,
            users.username AS seller_name,
            items.name, 
            items.details, 
            items.price, 
            items.image, 
            items.stocks, 
            cart_items.quantity
            FROM cart_items 
            JOIN items ON cart_items.item_id=items.id 
            JOIN users ON items.user_id=users.id
            WHERE cart_items.user_id = $userId";

    if ($result = $conn->query($sql)){
        while($row = mysqli_fetch_assoc($result))
        {
            if (isset($row['image'])) {
                $row['image'] = base64_encode($row['image']);
            }
            $items_array[] = $row;
        }
        echo json_encode($items_array);
        $conn->close();
    } else {
        echo "sql query failed";
    }

}

?>