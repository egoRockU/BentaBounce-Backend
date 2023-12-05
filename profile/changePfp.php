<?php 

require '../connection.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_FILES)){
        $filename = $_FILES['image']['name'];
        $image = $_FILES['image']['tmp_name'];
        $userId = $_POST['user_id'];
        
        $binaryImage = addslashes(file_get_contents($image));

        $sql = "UPDATE users SET photo='$binaryImage' WHERE id='$userId'";

        if ($conn->query($sql) === TRUE){
            $response = "Image uploaded successfully";
        } else {
            $response = "sql query failed";
        }

        echo $response;
        $conn->close();

    }
}

?>