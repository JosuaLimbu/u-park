<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../../dabaseconnect/connect.php';
    if (isset ($_POST["id"]) && isset ($_POST["username"])) {
        $id = $_POST["id"];
        $username = $_POST["username"];

        $sql = "DELETE FROM tbl_account WHERE id = $id";

        if (mysqli_query($con, $sql)) {
            echo "Pengguna dengan username $username berhasil dihapus!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
        mysqli_close($con);
    } else {
        echo "ID pengguna atau username tidak ditemukan!";
    }
} else {
    echo "Metode pengiriman data bukan POST! $username $id";
}
