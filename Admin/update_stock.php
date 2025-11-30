<?php
// update_stock.php
include("../config/connect.php");

if(isset($_POST['part_id'], $_POST['qty'], $_POST['action'])) {
    $part_id = intval($_POST['part_id']);
    $qty = intval($_POST['qty']);
    $action = $_POST['action'];

    // Get current stock
    $query = "SELECT stock FROM motorcycle_parts WHERE part_id = $part_id";
    $result = mysqli_query($conn, $query);
    if(!$result || mysqli_num_rows($result) == 0) {
        echo json_encode(['success' => false, 'error' => 'Part not found']);
        exit;
    }

    $row = mysqli_fetch_assoc($result);
    $currentStock = intval($row['stock']);

    if($action === 'add') {
        $newStock = $currentStock + $qty;
    } elseif($action === 'remove') {
        $newStock = $currentStock - $qty;
        if($newStock < 0) $newStock = 0; // Prevent negative stock
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
        exit;
    }

    // Update stock in DB
    $updateQuery = "UPDATE motorcycle_parts SET stock = $newStock WHERE part_id = $part_id";
    if(mysqli_query($conn, $updateQuery)) {
        echo json_encode(['success' => true, 'newStock' => $newStock]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update stock']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
