<?php
include '../connection.php';

// Periksa apakah data 'plate_number' tersedia dalam permintaan POST
if (isset($_POST['plate_number'])) {
    $plate_number = $_POST['plate_number'];
    date_default_timezone_set('Asia/Singapore');

    $exit_time = date('h:i:s A');

    // Buat dan jalankan query untuk memperbarui exit_time
    $sqlUpdateExitTime = "UPDATE tbl_vehicleentry SET exit_time = '$exit_time' WHERE plate_number = '$plate_number' AND exit_time = ''";

    if ($conn->query($sqlUpdateExitTime) === TRUE) {
        echo "Exit time updated successfully";
    } else {
        echo "Error: " . $sqlUpdateExitTime . "<br>" . $conn->error;
    }
} else {
    echo "Error: plate_number is not provided in the POST request.";
}

// Tutup koneksi ke database
$conn->close();
?>