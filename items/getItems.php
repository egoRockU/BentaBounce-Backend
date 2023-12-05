<?php 

require '../connection.php';

$input = json_decode(file_get_contents('php://input'));
$category = $input->category;


if ($_SERVER['REQUEST_METHOD']=='POST'){
    $items_array = array();

    switch($category){
        case 'all':
            $sql = "SELECT * FROM items";

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
            break;

        case 'user':
            $userId = $input->userId;
            $sql = "SELECT * FROM items WHERE user_id=$userId";

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
            break;
        default:
            echo "Invalid Category";

    }
}

?>