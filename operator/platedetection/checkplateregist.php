<?php
include 'connection.php';

$platedetect = $_POST['platedetect'];

// Mengambil data terakhir berdasarkan waktu pemeriksaan terakhir
$sql = "SELECT * FROM tbl_plateregist WHERE plate_number = '$platedetect' ORDER BY last_checked_time DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'name' => $row['name'],
        'plate_number' => $row['plate_number'],
        'date' => date('j F Y H:i:s', strtotime($row['last_checked_time'])), // Ubah format tanggal sesuai yang diminta
        'entry_time' => date('h:i:s A')
    );

    // Update waktu terakhir cek
    $update_time_sql = "UPDATE tbl_detectin SET last_checked_time = NOW() WHERE plate_number = '$platedetect'";
    $conn->query($update_time_sql);

    echo json_encode($data);
} else {
    echo "not_found";
}
$conn->close();
?>