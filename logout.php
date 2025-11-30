<?php
session_start();

// Clear all session data
$_SESSION['username'] = "";
$_SESSION['password'] = "";
$_SESSION['userID'] = "";
$_SESSION['userlevel'] = "";

// Destroy the session
session_unset();
session_destroy();

// Redirect back to login page
header("Location: login.php");
exit();
?>
