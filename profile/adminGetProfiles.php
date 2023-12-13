<?php 

require '../connection.php';

if ($_SERVER['REQUEST_METHOD']=='GET'){
    $orders_array = array();

    $sql = "SELECT id, username, email, wallet FROM users";

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