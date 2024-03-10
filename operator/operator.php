<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "operator") {
    header("Location: login.php");
    exit;
}
echo "Welcome, " . $_SESSION["username"] . "! Ini halaman operator.";
// Tombol logout
echo "<br><br><a href='../logout.php'>Logout</a>";
?>
