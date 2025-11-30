<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Motorcycle Concept Shop</title>
<link rel="stylesheet" href="../css/motorcycle_concept_shop.css">

<style>
    .logout-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: #ff4d4d;
        color: white;
        padding: 10px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
    }

    .logout-btn:hover {
        background-color: #cc0000;
    }
</style>

</head>
<body>

<!-- Logout Button -->
<a href="../logout.php" class="logout-btn">Logout</a>

<div class="container">

    <h1>Select a Concept</h1>

    <div class="concepts">
        <div class="concept-box" onclick="window.location.href='admin_malaysian_con.php'">
            <img src="https://i.ibb.co/9vzGyxs/malaysian.jpg" alt="Malaysian Concept">
            <h3>Malaysian Concept</h3>
        </div>
        <div class="concept-box" onclick="window.location.href='admin_thailand_con.php'">
            <img src="https://i.ibb.co/Fm3J1FS/thai.jpg" alt="Thai Concept">
            <h3>Thai Concept</h3>
        </div>
        <div class="concept-box" onclick="window.location.href='admin_circuit_con.php'">
            <img src="https://i.ibb.co/3mBwnDv/circuit.jpg" alt="Circuit Concept">
            <h3>Circuit Concept</h3>
        </div>
        <div class="concept-box" onclick="window.location.href='admin_indo_con.php'">
            <img src="https://i.ibb.co/pPsTLFN/indo.jpg" alt="Indo Concept">
            <h3>Indo Concept</h3>
        </div>
    </div>
</div>

</body>
</html>
