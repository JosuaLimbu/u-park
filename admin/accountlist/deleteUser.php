<?php
$conn = mysqli_connect("localhost", "root", "limbujosua23", "db_upark");

if (isset ($_POST["action"])) {
    if ($_POST["action"] == "delete") {
        delete();
    }
}

function delete()
{
    global $conn;

    $id = $_POST["id"];

    // Lakukan penghapusan data dengan query SQL DELETE
    $query = "DELETE FROM tbl_account WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        // Jika penghapusan berhasil, kirim respons 1
        echo 1;
    } else {
        // Jika terjadi kesalahan, kirim respons 0
        echo 0;
    }
}
?>