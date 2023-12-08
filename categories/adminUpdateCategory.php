<?php 

require '../connection.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $catId = $_POST["catId"];
    $catName = $_POST["categoryName"];

    $sql = "UPDATE categories SET category_name='$catName' WHERE id=$catId";

    if ($conn->query($sql) === TRUE){
        $response = "Item Updated successfully";
    } else {
        $response = "sql query failed";
    }

    echo $response;
    $conn->close();
}

?>