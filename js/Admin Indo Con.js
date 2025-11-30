let stockData = {
    'row-1': 0, 'row-2': 0, 'row-3': 0, 'row-4': 0, 
    'row-5': 0, 'row-6': 0, 'row-7': 0
};

function updateStockDisplay(rowId, newTotalStock) {
    const stockElement = document.getElementById('current-stock-' + rowId);
    if (stockElement) {
        stockElement.textContent = 'Current Stock: ' + newTotalStock;
    }
}

function addToCart(partName, rowId) {
    const quantityInput = document.getElementById('qty-' + rowId);
    const quantityToAdd = parseInt(quantityInput.value, 10);

    if (isNaN(quantityToAdd) || quantityToAdd <= 0) {
        alert("Please enter a valid quantity for " + partName + ".");
        return;
    }

    if (stockData[rowId] === undefined) stockData[rowId] = 0;

    stockData[rowId] += quantityToAdd;
    updateStockDisplay(rowId, stockData[rowId]);

    quantityInput.value = 1;
}

function removeItem(rowId, partName) {
    const row = document.getElementById(rowId);
    if (row && confirm(`Are you sure you want to remove "${partName}" from the catalog?`)) {
        row.remove();
        delete stockData[rowId];
    }
}

function addCustomItem() {
    const partName = prompt("Enter Custom Part Name:", "New Custom Part");
    if (!partName) return; 

    const concept = prompt("Enter Concept:", "Custom");
    if (!concept) return;

    const imagePath = prompt("Enter Image Path or URL:", "https://via.placeholder.com/80/0000FF/FFFFFF?text=Custom");
    if (!imagePath) return;

    let priceInput = prompt("Enter Price:", "5000.00");
    if (!priceInput) return; 

    const price = parseFloat(priceInput).toFixed(2);

    let initialQuantityInput = prompt("Enter Initial Stock Quantity:", "1");
    if (!initialQuantityInput) return;

    const initialStock = parseInt(initialQuantityInput, 10);
    const newRowId = 'custom-' + Date.now(); 
    stockData[newRowId] = initialStock;

    const tbody = document.querySelector('table tbody');
    const newRow = document.createElement('tr');
    newRow.id = newRowId;
    newRow.classList.add('part-row', 'concept-custom');

    newRow.innerHTML = `
        <td>${partName}</td>
        <td>${concept}</td>
        <td><img src="${imagePath}" alt="${partName}" class="item-img"></td>
        <td>
            <span class="price-info">₱ ${price}</span>
            <span class="current-stock-qty" id="current-stock-${newRowId}">Current Stock: ${initialStock}</span>
        </td>
        <td class="action-cell">
            <input type="number" id="qty-${newRowId}" class="qty-input" value="1" min="1">
            <button class="add-qty-btn" onclick="addToCart('${partName}', '${newRowId}')">ADD</button>
            <button class="remove-btn" onclick="removeItem('${newRowId}', '${partName}')">REMOVE</button>
        </td>
    `;

    tbody.appendChild(newRow);
}

// Back button without using location.href
document.getElementById('back-btn').addEventListener('click', function() {
    window.history.back();
});
