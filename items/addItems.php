<?php 

require '../connection.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_FILES)){
        $image = $_FILES['image']['tmp_name'];
        $binaryImage = addslashes(file_get_contents($image));
        
        $name = $_POST["name"];
        $details = $_POST["description"];
        $category_id = $_POST["category"];
        $stocks = $_POST["stocks"];
        $price = $_POST["price"];
        $user_id = $_POST["user_id"];

        $sql = "INSERT INTO items(id, name, details, category_id, stocks, price, image, user_id) 
        VALUES (null, '$name', '$details', $category_id, $stocks, $price, '$binaryImage', $user_id)";

        if ($conn->query($sql) === TRUE){
            $response = "Item added successfully";
        } else {
            $response = "sql query failed";
        }

        echo $response;
        $conn->close();


    }
}

?>