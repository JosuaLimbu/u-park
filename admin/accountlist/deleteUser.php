<?php
session_start();

// Pastikan metode pengiriman data adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file koneksi ke database
    include '../../dabaseconnect/connect.php';

    // Ambil ID pengguna yang akan dihapus dari formulir
    $id = $_POST["id"];

    // Query untuk menghapus pengguna dari database
    $sql = "DELETE FROM tbl_account WHERE id = '$id'";

    // Eksekusi query
    if (mysqli_query($con, $sql)) {
        // Jika query berhasil dijalankan, kirimkan respons berhasil ke client
        echo "Pengguna berhasil dihapus!";
    } else {
        // Jika query gagal dijalankan, kirimkan pesan kesalahan ke client
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Tutup koneksi ke database
    mysqli_close($con);
} else {
    // Jika tidak ada data yang dikirimkan dengan metode POST, kirimkan pesan error
    echo "Metode pengiriman data bukan POST!";
}
?>
