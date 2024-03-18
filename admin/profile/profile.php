<?php
session_start();
if (!isset ($_SESSION["username"]) || !isset ($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: http://localhost/upark");
}
$page = ''; //buat page aktif di sidebar
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" type="image/png" href="../../img/U-Park.png">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>
<style>
    :root {
        --blue: #04A6B5;
    }

    a {
        text-decoration: none;
    }
</style>

<body style="background-color: #eee;">
    <?php include '../components/sidebar/sidebar.php'; ?>
    <!-- CONTENT -->
    <section id="content">
        <!-- Include navbar -->
        <?php include '../components/navbar/navbar.php'; ?>
        <!-- MAIN -->
        <main>
            <!-- Main content -->
            <div class="head-title">
                <div class="left" style="font-family: 'Montserrat', sans-serif; font-weight: 600">
                    <p>Profile</p>

                </div>

            </div>
            <br>
            <br>
            <br>
            <?php

            if (!isset ($_SESSION["username"])) {

                header("Location: login.php");
                exit;
            }

            function connectToDatabase()
            {

                $servername = "localhost";
                $username = "root";
                $password = "limbujosua23";
                $dbname = "db_upark";

                // Buat koneksi
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Periksa koneksi
                if ($conn->connect_error) {
                    die ("Connection failed: " . $conn->connect_error);
                }

                return $conn;
            }

            // Fungsi untuk mendapatkan kata sandi pengguna dari database
            function getPasswordFromDatabase($username)
            {
                // Buat koneksi ke database
                $conn = connectToDatabase();

                // Lakukan query ke database
                $sql = "SELECT password FROM tbl_account WHERE username = '$username'";
                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    // Ambil baris pertama hasil query
                    $row = $result->fetch_assoc();
                    // Ambil kolom password
                    $password = $row["password"];
                } else {
                    // Jika tidak ada hasil, set password ke null
                    $password = null;
                }

                // Tutup koneksi database
                $conn->close();

                return $password;
            }

            // Fungsi untuk mendapatkan tanggal pembuatan pengguna
            function getCreateDate($username)
            {
                // Buat koneksi ke database
                $conn = connectToDatabase();

                // Lakukan query ke database
                $sql = "SELECT create_at FROM tbl_account WHERE username = '$username'";
                $result = $conn->query($sql);

                // Periksa hasil query
                if ($result->num_rows > 0) {
                    // Ambil baris pertama hasil query
                    $row = $result->fetch_assoc();
                    // Ambil kolom create_date
                    $createDate = $row["create_at"];
                } else {
                    // Jika tidak ada hasil, set create_date ke null
                    $createDate = null;
                }

                // Tutup koneksi database
                $conn->close();

                return $createDate;
            }

            // Ambil informasi pengguna dari sesi
            $username = $_SESSION["username"];
            $role = $_SESSION["role"]; // Misalnya, role disimpan di sesi
            ?>

    <div class="container">
        <div class="profile">
            <div class="profile-info">
                <!--panggile image profile-->
                <img src="Profile.jpg" alt="">
                <!-- Tampilkan informasi pengguna -->
                <h2>Username : <?php echo $username; ?></h2>
                <h2>Role: <?php echo $role; ?></h2>
                <h2><?php echo "Password: " . getPasswordFromDatabase($username); ?></h2>
                <h2><?php echo "Create Date: " . getCreateDate($username); ?></h2>
                
            </div>
            <div class="profile-actions">
            
                
            </div>
        </div>
    </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="../components/js/script.js"></script>
    <script src="../components/js/datetime.js"></script>
    <script src="../components/js/dropdown.js"></script>
</body>

</html>