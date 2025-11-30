<?php
include("../config/connect.php");

// Get POST data
$part_name = $_POST['part_name'] ?? '';
$concept = $_POST['concept'] ?? '';
$image_path = $_POST['image_path'] ?? '';
$price = $_POST['price'] ?? 0;
$stock = $_POST['stock'] ?? 0;

$response = ['success' => false];

if($part_name && $concept) {
    $price = floatval($price);
    $stock = intval($stock);

    $query = "INSERT INTO motorcycle_parts (part_name, concept, image_path, price, stock) VALUES ('$part_name','$concept','$image_path',$price,$stock)";
    if(mysqli_query($conn, $query)) {
        $response['success'] = true;
        $response['part_id'] = mysqli_insert_id($conn);
    } else {
        $response['error'] = mysqli_error($conn);
    }
} else {
    $response['error'] = "Invalid part name or concept.";
}

echo json_encode($response);
?>
