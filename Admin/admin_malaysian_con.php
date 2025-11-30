<?php
// admin_malaysia.php
include("../config/connect.php"); // DB connection

// Fetch Malaysian parts from DB
$query = "SELECT * FROM motorcycle_parts WHERE concept='Malaysian'";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Malaysian Motorcycle Parts</title>
     <link rel="stylesheet" href="../css/admin_malaysian_con.css">
    <script>
        // Add stock via AJAX
        function addToCart(partName, rowId, partId) {
            const quantityInput = document.getElementById('qty-' + rowId);
            const quantityToAdd = parseInt(quantityInput.value, 10);
            if (isNaN(quantityToAdd) || quantityToAdd <= 0) {
                alert("Please enter a valid quantity for " + partName + ".");
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_stock.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var resp = JSON.parse(xhr.responseText);
                    if (resp.success) {
                        document.getElementById('current-stock-' + rowId).textContent = "Current Stock: " + resp.newStock;
                        quantityInput.value = 1;
                        alert(`✅ Added ${quantityToAdd} of ${partName} to stock!`);
                    } else {
                        alert("❌ Error updating stock: " + resp.error);
                    }
                }
            };
            xhr.send("part_id=" + partId + "&qty=" + quantityToAdd + "&action=add");
        }

        // Remove stock via AJAX
        function removeStock(partName, rowId, partId) {
            const quantityInput = document.getElementById('qty-' + rowId);
            const quantityToRemove = parseInt(quantityInput.value, 10);
            if (isNaN(quantityToRemove) || quantityToRemove <= 0) {
                alert("Please enter a valid quantity to remove for " + partName + ".");
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_stock.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var resp = JSON.parse(xhr.responseText);
                    if (resp.success) {
                        document.getElementById('current-stock-' + rowId).textContent = "Current Stock: " + resp.newStock;
                        quantityInput.value = 1;
                        alert(`✅ Removed ${quantityToRemove} of ${partName} from stock!`);
                    } else {
                        alert("❌ Error updating stock: " + resp.error);
                    }
                }
            };
            xhr.send("part_id=" + partId + "&qty=" + quantityToRemove + "&action=remove");
        }

        // Remove part via AJAX
        function removeItem(rowId, partId, partName) {
            if (!confirm(`Are you sure you want to remove "${partName}"?`)) return;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "remove_part.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var resp = JSON.parse(xhr.responseText);
                    if (resp.success) {
                        document.getElementById(rowId).remove();
                        alert(`✅ "${partName}" removed successfully!`);
                    } else {
                        alert("❌ Error removing item: " + resp.error);
                    }
                }
            };
            xhr.send("part_id=" + partId);
        }

        // Add custom part via AJAX
        function addCustomItem() {
            const partName = prompt("Enter Custom Part Name:", "New Custom Part");
            if (!partName) return;
            const concept = prompt("Enter Concept:", "Malaysian");
            if (!concept) return;
            const imagePath = prompt("Enter Image Path or URL:", "https://via.placeholder.com/80");
            if (!imagePath) return;
            let priceInput = prompt("Enter Price:", "5000.00");
            if (!priceInput) return;
            const price = parseFloat(priceInput).toFixed(2);
            let stockInput = prompt("Enter Initial Stock:", "1");
            if (!stockInput) return;
            const stock = parseInt(stockInput, 10);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_part.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var resp = JSON.parse(xhr.responseText);
                    if (resp.success) {
                        const tbody = document.querySelector('table tbody');
                        const newRowId = 'row-' + resp.part_id;
                        const newRow = document.createElement('tr');
                        newRow.id = newRowId;
                        newRow.classList.add('part-row');
                        newRow.innerHTML = `
                    <td>${partName}</td>
                    <td>${concept}</td>
                    <td><img src="${imagePath}" alt="${partName}" class="item-img"></td>
                    <td>
                        <span class="price-info">₱ ${price}</span>
                        <span class="current-stock-qty" id="current-stock-${newRowId}">Current Stock: ${stock}</span>
                    </td>
                    <td class="action-cell">
                        <input type="number" id="qty-${newRowId}" class="qty-input" value="1" min="1">
                        <button class="add-qty-btn" onclick="addToCart('${partName}', '${newRowId}', ${resp.part_id})">Add Stock</button>
                        <button class="remove-stock-btn" onclick="removeStock('${partName}', '${newRowId}', ${resp.part_id})">Remove Stock</button>
                        <button class="remove-btn" onclick="removeItem('${newRowId}', ${resp.part_id}, '${partName}')">Remove Part</button>
                    </td>
                `;
                        tbody.appendChild(newRow);
                        alert("✅ Custom part added successfully!");
                    } else {
                        alert("❌ Error adding part: " + resp.error);
                    }
                }
            };
            xhr.send("part_name=" + encodeURIComponent(partName) + "&concept=" + encodeURIComponent(concept) + "&image_path=" + encodeURIComponent(imagePath) + "&price=" + price + "&stock=" + stock);
        }
    </script>
</head>

<body>
    <button onclick="location.href='motorcycle_concept_shop.php'"
        style="padding: 10px 20px; background-color: #1e3a8a; color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; margin-bottom: 15px;">⬅️
        Back</button>
    <div class="catalog-container">
        <h1>🏁 Malaysian Motorcycle Parts</h1>

        <table>
            <thead>
                <tr>
                    <th>Part</th>
                    <th>Concept</th>
                    <th>Image</th>
                    <th>Price & Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="part-row" id="row-<?php echo $row['part_id']; ?>">
                        <td><?php echo $row['part_name']; ?></td>
                        <td><?php echo $row['concept']; ?></td>
                        <td><img src="<?php echo $row['image_path']; ?>" class="item-img"
                                alt="<?php echo $row['part_name']; ?>"></td>
                        <td>
                            <span class="price-info">₱ <?php echo number_format($row['price'], 2); ?></span>
                            <span class="current-stock-qty" id="current-stock-row-<?php echo $row['part_id']; ?>">Current
                                Stock: <?php echo $row['stock']; ?></span>
                        </td>
                        <td class="action-cell">
                            <input type="number" id="qty-row-<?php echo $row['part_id']; ?>" class="qty-input" value="1"
                                min="1">
                            <button class="add-qty-btn"
                                onclick="addToCart('<?php echo $row['part_name']; ?>','row-<?php echo $row['part_id']; ?>', <?php echo $row['part_id']; ?>)">Add
                                Stock</button>
                            <button class="remove-stock-btn"
                                onclick="removeStock('<?php echo $row['part_name']; ?>','row-<?php echo $row['part_id']; ?>', <?php echo $row['part_id']; ?>)">Remove
                                Stock</button>
                            <button class="remove-btn"
                                onclick="removeItem('row-<?php echo $row['part_id']; ?>', <?php echo $row['part_id']; ?>, '<?php echo $row['part_name']; ?>')">Remove
                                Part</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <button id="add-custom-btn" onclick="addCustomItem()">➕ ADD CUSTOM ITEM</button>
    </div>
</body>

</html>