<?php
// thai.php
include("../config/connect.php"); // Database connection

// Fetch all Thai concept parts
$query = "SELECT * FROM motorcycle_parts WHERE concept='Thai'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Motorcycle Custom Parts Catalog of Thai Concept</title>
<link rel="stylesheet" href="../css/conceptdesign.css">
<link rel="stylesheet" href="../css/thailand.css">
<style>
/* Modal styles */
#modal {
    display: none;
    position: fixed;
    z-index: 10;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.7);
    justify-content: center; align-items: center;
}
#modalContent {
    background: #1c1c3a;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    color: white;
}
#closeModal {
    margin-top: 10px;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    background-color: #dc2626;
    color: white;
    cursor: pointer;
}
</style>
</head>

<body>

<a href="concept.php" class="back-btn">← Back</a>

<div class="catalog-container">
    <h1>🏁 Motorcycle Parts of Thai Concept</h1>

    <table>
        <thead>
            <tr>
                <th>Part</th>
                <th>Concept</th>
                <th>Image</th>
                <th>Price (PHP)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) {
                $qtyId = 'qty' . $row['part_id'];
                ?>
                <tr>
                    <td><?php echo $row['part_name']; ?></td>
                    <td><?php echo $row['concept']; ?></td>
                    <td><img src="<?php echo $row['image_path']; ?>" class="item-img"></td>
                    <td>
                        ₱ <?php echo number_format($row['price'], 2); ?>
                        <span class="stock">Stock: <?php echo $row['stock']; ?></span>
                    </td>
                    <td>
                        <input type="number" class="qty-input" value="1" min="1" id="<?php echo $qtyId; ?>">
                        <button class="btn-order"
                            onclick="checkOrder('<?php echo $row['part_name']; ?>','<?php echo $row['concept']; ?>',<?php echo $row['price']; ?>,<?php echo $row['stock']; ?>,'<?php echo $qtyId; ?>')">
                            Add to Order
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="stockModal">
    <div class="modal-content">
        <p id="modalMessage"></p>
        <button id="closeModal" onclick="closeModal()">OK</button>
    </div>
</div>

<script>
function checkStock(item, concept, price, stock, qtyInputId) {
    var qty = parseInt(document.getElementById(qtyInputId).value);
    var modal = document.getElementById('stockModal');
    var modalMessage = document.getElementById('modalMessage');

    if (stock <= 0) {
        modalMessage.textContent = '❌ Out of Stock!';
        modal.style.display = 'block';
    } else if (qty > stock) {
        modalMessage.textContent = '❌ Exceeding available stock!';
        modal.style.display = 'block';
    } else {
        // Proceed to checkout.php if quantity is valid
        window.location.href = 'checkout.php?item=' + encodeURIComponent(item) +
                               '&concept=' + encodeURIComponent(concept) +
                               '&price=' + price +
                               '&qty=' + qty;
    }
}

function closeModal() {
    document.getElementById('stockModal').style.display = 'none';
}
</script>

</body>
</html>
