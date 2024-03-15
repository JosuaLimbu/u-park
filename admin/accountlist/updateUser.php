<?php
include '../../dabaseconnect/connect.php';

if ($con->connect_error) {
    die ("Koneksi gagal: " . $con->connect_error);
}

if (isset ($_POST['submit'])) {
    $id = $_GET['updateid'];
    $id = $_POST['id'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //$create_at = $_POST('create_at');

    $sql = "UPDATE `tbl_account` SET role='$role', username='$username', password='$password' WHERE id='$id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Data berhasil diperbarui.";
    } else {
        // Kirim pesan kesalahan jika data yang diperlukan tidak diterima dari permintaan
        echo "Missing required data!";
    }

    // Tutup koneksi database
    mysqli_close($con);
} else {
    // Kirim pesan kesalahan jika metode permintaan tidak diizinkan
    echo "Method not allowed!";
}
?>