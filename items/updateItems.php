<?php 

require '../connection.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_FILES)){
        // $image = $_FILES['image']['tmp_name'];
        // $binaryImage = addslashes(file_get_contents($image));
        
        $name = $_POST["name"];
        $details = $_POST["description"];
        $category_id = $_POST["category"];
        $stocks = $_POST["stocks"];
        $price = $_POST["price"];
        $itemId = $_POST["itemId"];

        if (isset($_FILES['image'])){
            $image = $_FILES['image']['tmp_name'];
            $binaryImage = addslashes(file_get_contents($image));
            $sql = "UPDATE items SET name='$name', details='$details', category_id=$category_id, 
            stocks=$stocks, price=$price, image='$binaryImage' WHERE id=$itemId";
        } else {
            $sql = "UPDATE items SET name='$name', details='$details', category_id=$category_id, 
            stocks=$stocks, price=$price WHERE id=$itemId";
        }

        if ($conn->query($sql) === TRUE){
            $response = "Item Updated successfully";
        } else {
            $response = "sql query failed";
        }

        echo $response;
        $conn->close();
    }
}

?>