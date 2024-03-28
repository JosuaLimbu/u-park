<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "operator") {
    header("Location: http://localhost/u-park");
}
?>