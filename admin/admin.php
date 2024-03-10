<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit;
}
echo "Welcome, " . $_SESSION["username"] . "! Ini halaman admin.";
// Tombol logout
echo "<br><br><a href='../logout.php'>Logout</a>";
?>
