<?php
include 'connection.php';

$name = $_POST['name'];
$plate_number = $_POST['plate_number'];
$date = date('j F Y');
date_default_timezone_set('Asia/Singapore');
$entryTime = date('h:i:s A');

// Cek apakah ada plate_number yang sudah ada dengan exit_time yang masih kosong
$sqlCheckExitStatus = "SELECT * FROM tbl_vehicleentry WHERE plate_number = '$plate_number' AND exit_time IS NULL";
$resultCheckExitStatus = $conn->query($sqlCheckExitStatus);

if ($resultCheckExitStatus->num_rows == 0) {
    // Jika tidak ada yang exit_time masih kosong, lakukan insert baru
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