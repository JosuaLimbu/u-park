<?php
include '../../dabaseconnect/connect.php';
if ($con->connect_error) {
    die ("Koneksi gagal: " . $con->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "UPDATE `tbl_account` SET username='$username', password='$password' WHERE id='$id'";
    $result = mysqli_query($con, $sql);

    // Periksa apakah kueri berhasil dieksekusi
    if ($result) {
        echo "Data berhasil diperbarui.";
    } else {
        // Kirim pesan kesalahan jika kueri gagal dieksekusi
        echo "Gagal memperbarui data!";
    }

    // Tutup koneksi database
    mysqli_close($con);
} else {
    // Kirim pesan kesalahan jika metode permintaan tidak diizinkan
    echo "Metode tidak diizinkan!";
}
?>