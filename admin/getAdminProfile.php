<?php 

require '../connection.php';

if ($_SERVER['REQUEST_METHOD']=='GET'){
    $category_array = array();

    $sql = "SELECT * FROM admin";

    if ($result = $conn->query($sql)){
        echo json_encode(mysqli_fetch_assoc($result));
        $conn->close();
    } else {
        echo "sql query failed";
    }

}

?>