<?php
    $con = new mysqli('localhost', 'root', '', 'db-upark');

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    } else {
        //echo "Connection successful";
    }
?>
