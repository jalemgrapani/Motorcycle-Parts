<?php
session_start();

// Grab item data from URL
$item = isset($_GET['item']) ? $_GET['item'] : '';
$qty = isset($_GET['qty']) ? intval($_GET['qty']) : 1;
$price = isset($_GET['price']) ? floatval($_GET['price']) : 0;
$concept = isset($_GET['concept']) ? $_GET['concept'] : '';

// Calculate total
$total = $qty * $price;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout</title>
<link rel="stylesheet" href="../css/conceptdesign.css">
<link rel="stylesheet" href="../css/checkout.css">
</head>
<body>

<!-- Back Button OUTSIDE the container -->
<button onclick="history.back()" class="btn-back">← Back</button>

<div class="container">

    <h1>🛒 Checkout</h1>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Concept</th>
                <th>Quantity</th>
                <th>Price (PHP)</th>
                <th>Total (PHP)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $item; ?></td>
                <td><?php echo $concept; ?></td>
                <td><?php echo $qty; ?></td>
                <td>₱ <?php echo number_format($price, 2); ?></td>
                <td>₱ <?php echo number_format($total, 2); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="checkout-summary">
        <h4>Total Amount: ₱ <?php echo number_format($total, 2); ?></h4>
        <button class="btn-payment" onclick="openModal('paymentModal')">Proceed to Payment</button>
    </div>

</div>

<!-- Choose Payment Method Modal -->
<div class="modal" id="paymentModal">
    <div class="modal-dialog-box">
        <div class="modal-content-box">
            <div class="modal-header">
                <h5>Choose Payment Method</h5>
                <button class="btn-close" onclick="closeModal('paymentModal')">&times;</button>
            </div>
            <div class="modal-body">
                <button onclick="codOrder()">Cash on Delivery</button>
                <button onclick="onlinePayment()">Online Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- COD Success Modal -->
<div class="modal" id="codModal">
    <div class="modal-dialog-box">
        <div class="modal-content-box">
            <div class="modal-header">
                <h5>Order Successful</h5>
                <button class="btn-close" onclick="closeModal('codModal')">&times;</button>
            </div>
            <div class="modal-body">
                <p>Your order has been placed successfully with Cash on Delivery (COD)!</p>
                <button onclick="closeModal('codModal')">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Online Payment Options Modal -->
<div class="modal" id="onlineModal">
    <div class="modal-dialog-box">
        <div class="modal-content-box">
            <div class="modal-header">
                <h5>Online Payment Options</h5>
                <button class="btn-close" onclick="closeModal('onlineModal')">&times;</button>
            </div>
            <div class="modal-body">
                <button onclick="onlineConfirm('Credit/Debit Cards')">Credit/Debit Cards</button>
                <button onclick="onlineConfirm('E-Wallets / Mobile Payments')">E-Wallets / Mobile Payments</button>
                <button onclick="onlineConfirm('Bank Transfers')">Bank Transfers</button>
                <button onclick="onlineConfirm('Over-the-Counter / Cash Payments')">Over-the-Counter / Cash Payments</button>
                <button onclick="onlineConfirm('Cash on Delivery (COD)')">Cash on Delivery (COD)</button>
            </div>
        </div>
    </div>
</div>

<!-- Online Payment Success Modal -->
<div class="modal" id="onlineConfirmModal">
    <div class="modal-dialog-box">
        <div class="modal-content-box">
            <div class="modal-header">
                <h5>Order Successful</h5>
                <button class="btn-close" onclick="closeModal('onlineConfirmModal')">&times;</button>
            </div>
            <div class="modal-body">
                <p id="onlineMethodText"></p>
                <button onclick="closeModal('onlineConfirmModal')">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
function openModal(id){ document.getElementById(id).style.display = "block"; }
function closeModal(id){ document.getElementById(id).style.display = "none"; }

function codOrder(){
    closeModal('paymentModal');
    openModal('codModal');
}

function onlinePayment(){
    closeModal('paymentModal');
    openModal('onlineModal');
}

function onlineConfirm(method){
    closeModal('onlineModal');
    document.getElementById('onlineMethodText').innerText = "Your order has been placed successfully using: " + method + "!";
    openModal('onlineConfirmModal');
}
</script>

</body>
</html>
