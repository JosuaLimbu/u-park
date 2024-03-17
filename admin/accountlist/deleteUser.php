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
    $query = "DELETE FROM tbl_account WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo 1;
    } else {
        echo "ada yang salah";
    }
}