<?php 

require '../connection.php';

if ($_SERVER['REQUEST_METHOD']=='GET'){
    $items_array = array();

    $sql = "SELECT items.id, items.name, items.details, items.price, items.stocks, categories.category_name, users.username FROM items 
    INNER JOIN categories ON items.category_id=categories.id
    INNER JOIN users ON items.user_id=users.id";

    if ($result = $conn->query($sql)){
        while($row = mysqli_fetch_assoc($result))
        {
            $items_array[] = $row;
        }
        echo json_encode($items_array);
    } else {
        echo "sql query failed";
    }

}

?>