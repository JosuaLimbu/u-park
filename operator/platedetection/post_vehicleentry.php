// post_vehicleentry.php

<?php
include 'db_connection.php';

$name = $_POST['name'];
$plate_number = $_POST['plate_number'];
$date = date('j F Y');

date_default_timezone_set('Asia/Singapore');

$entryTime = date('h:i:s A');

$sql = "INSERT INTO tbl_vehicleentry (name, plate_number, date, entry_time) VALUES ('$name', '$plate_number', '$date', '$entryTime')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>