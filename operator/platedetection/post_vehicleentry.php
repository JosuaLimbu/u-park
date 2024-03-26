<?php
include 'db_connection.php';

$name = $_POST['name'];
$plateNumber = $_POST['plateNumber'];
$date = $_POST['date'];
$entryTime = $_POST['entryTime'];

$sql = "INSERT INTO tbl_vehicleentry (name, plate_number, date, entry_time) VALUES ('$name', '$plateNumber', '$date', '$entryTime')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>