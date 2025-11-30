<?php
include("../config/connect.php");

$part_id = intval($_POST['part_id'] ?? 0);
$response = ['success' => false];

if($part_id > 0) {
    $query = "DELETE FROM motorcycle_parts WHERE part_id = $part_id";
    if(mysqli_query($conn, $query)) {
        $response['success'] = true;
    } else {
        $response['error'] = mysqli_error($conn);
    }
} else {
    $response['error'] = "Invalid part ID.";
}

echo json_encode($response);
?>
