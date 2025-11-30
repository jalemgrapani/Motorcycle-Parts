<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Concepts</title>
  <link rel="stylesheet" href="../css/concept.css">

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

  <div id="modelPage" class="container">

    <h1>Conceptz.</h1>

    <div class="navbar">
      <a href="#">Home</a>
      <a href="#">About</a>
      <a href="#">Contact</a>
      <a href="#">Support</a>
      <a href="#search" class="search-icon">🔍</a>
    </div>

    <h3>Choose a Concept</h3>

    <div class="concepts">

      <a href="malaysian.php" class="concept-link">
        <div class="concept-box">
          <img src="images/malaysian concept.jpg" alt="Malaysian Concept">
          <h3>Malaysian Concept</h3>
        </div>
      </a>

      <a href="thailand.php" class="concept-link">
        <div class="concept-box">
          <img src="images/thai concept.jpg" alt="Thai Concept">
          <h3>Thai Concept</h3>
        </div>
      </a>

      <a href="circuit_concept.php" class="concept-link">
        <div class="concept-box">
          <img src="images/circuit concept.jpg" alt="Circuit Concept">
          <h3>Circuit Concept</h3>
        </div>
      </a>

      <a href="indo_con.php" class="concept-link">
        <div class="concept-box">
          <img src="images/indo concept.jpg" alt="Indo Concept">
          <h3>Indo Concept</h3>
        </div>
      </a>

    </div>

  </div>

</body>

</html>
