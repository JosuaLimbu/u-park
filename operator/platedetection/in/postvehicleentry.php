<?php
include '../connection.php';

$name = $_POST['name'];
$plate_number = $_POST['plate_number'];
$date = date('j F Y');
date_default_timezone_set('Asia/Singapore');
$entryTime = date('h:i:s A');

$sqlCheckExitStatus = "SELECT * FROM tbl_vehicleentry WHERE plate_number = '$plate_number' AND exit_time IS NULL";
$resultCheckExitStatus = $conn->query($sqlCheckExitStatus);

if ($resultCheckExitStatus->num_rows == 0) {
    $sqlInsert = "INSERT INTO tbl_vehicleentry (name, plate_number, date, entry_time) VALUES ('$name', '$plate_number', '$date', '$entryTime')";
    if ($conn->query($sqlInsert) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    }
} else {
    echo "Ada plate_number dengan exit_time masih kosong";
}

$conn->close();
?>