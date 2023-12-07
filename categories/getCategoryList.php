<?php 

require '../connection.php';

if ($_SERVER['REQUEST_METHOD']=='GET'){
    $category_array = array();

    $sql = "SELECT id, category_name FROM categories";

    if ($result = $conn->query($sql)){
        while($row = mysqli_fetch_assoc($result))
            {
                $category_array[] = $row;
            }
            echo json_encode($category_array);
            $conn->close();
    }

}

?>