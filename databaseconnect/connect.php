<?php
$con = new mysqli('localhost', 'root', 'limbujosua23', 'db_upark');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    //echo "Connection successful";
}
?>