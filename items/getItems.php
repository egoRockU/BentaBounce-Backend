<?php 

require '../connection.php';

$input = json_decode(file_get_contents('php://input'));
$category = $input->category;


if ($_SERVER['REQUEST_METHOD']=='POST'){
    $items_array = array();

    switch($category){
        case 'all':
            $sql = "SELECT * FROM items WHERE stocks > 0";

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

        case 'showItem':
            $itemId = $input->itemId;
            $sql = "SELECT items.*, categories.category_name FROM items
                    INNER JOIN categories ON items.category_id=categories.id WHERE items.id=$itemId LIMIT 1";

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

        case 'category':
            $categoryId = $input->category_id;
            $sql = "SELECT * FROM items WHERE category_id=$categoryId AND stocks > 0";

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

        case 'getCategory':
            $categoryId = $input->category_id;
            $sql = "SELECT category_name FROM categories WHERE id=$categoryId";

            if ($result = $conn->query($sql)){
                echo json_encode(mysqli_fetch_assoc($result));
                $conn->close();
            } else {
                echo "sql query failed";
            }
            break;

        case 'search':
            $searchItem = $input->searchItem;
            $sql = "SELECT * FROM items WHERE name LIKE '%$searchItem%'";

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