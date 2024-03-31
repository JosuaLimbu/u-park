<?php
include '../connection.php';

$platedetect2 = $_POST['platedetect2'];

// Ambil data terakhir berdasarkan waktu pemeriksaan terakhir
$sql = "SELECT * FROM tbl_plateregist WHERE plate_number = '$platedetect2' ORDER BY last_checked_time DESC LIMIT 1";
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
    $update_time_sql = "UPDATE tbl_detectout SET last_checked_time = NOW() WHERE plate_number = '$platedetect2'";
    $conn->query($update_time_sql);

    // Mengembalikan data dalam bentuk JSON
    echo json_encode($data);
} else {
    // Mengembalikan pesan error jika nomor plat tidak ditemukan
    echo json_encode(array('error' => 'Nomor plat tidak ditemukan'));
}
$conn->close();
?>